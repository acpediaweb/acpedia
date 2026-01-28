<?php

namespace App\Controllers\Shop;

use App\Controllers\BaseController;
use App\Models\CartModel;

class CartController extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('login');

        $userId = session()->get('user_id');
        $db = \Config\Database::connect();

        // 1. Fetch Cart Header
        $cart = $db->table('user_cart')->where('user_id', $userId)->get()->getRow();
        
        // 2. Fetch Items
        $items = $db->table('user_cart_items as uci')
            ->select('uci.*, p.product_name, p.base_price as p_price, p.sale_price, s.service_title, s.base_price as s_price')
            ->join('user_cart as uc', 'uc.id = uci.cart_id')
            ->join('products as p', 'p.id = uci.product_id', 'left')
            ->join('services as s', 's.id = uci.service_id', 'left')
            ->where('uc.user_id', $userId)
            ->get()
            ->getResult();

        // 3. Attach Saved Configs
        foreach ($items as $item) {
            $item->saved_addons = $db->table('user_cart_item_addons')
                ->where('cart_item_id', $item->id)
                ->get()
                ->getResult();
                
            $item->service_config = null;
            $item->saved_addon_ids = []; // Helper array for View
            
            foreach ($item->saved_addons as $addon) {
                // Parse Service JSON
                if (!empty($addon->extra_data_json)) {
                    $item->service_config = json_decode($addon->extra_data_json, true);
                }
                // Collect Addon IDs as STRINGS to match JS checkbox values
                if ($addon->addon_id) {
                    $item->saved_addon_ids[] = (string)$addon->addon_id;
                }
            }
        }

        // 4. Fetch Addresses
        $addresses = $db->table('users_addresses')
            ->where('user_id', $userId)
            ->orderBy('is_primary', 'DESC') 
            ->get()
            ->getResult();

        // 5. Data for View
        $data = [
            'title'         => 'Your Shopping Cart',
            'cart'          => $cart,
            'items'         => $items,
            'addresses'     => $addresses,
            'brands'        => $db->table('brands')->orderBy('brand_name', 'ASC')->get()->getResult(),
            'pk_categories' => $db->table('pk_categories')->orderBy('id', 'ASC')->get()->getResult(),
            'types'         => $db->table('types')->orderBy('type_name', 'ASC')->get()->getResult(),
            'pipes'         => $db->table('pipes')->get()->getResult(),
            'addons'        => $db->table('addons')->get()->getResult()
        ];

        return view('shop/cart', $data);
    }

    public function add()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('login');
        $userId = session()->get('user_id');
        $db = \Config\Database::connect();
        
        $cartModel = new CartModel();
        $cart = $cartModel->where('user_id', $userId)->first();
        $cartId = $cart ? $cart->id : $cartModel->insert(['user_id' => $userId]);

        // Default qty to 1 if missing
        $qty = $this->request->getPost('quantity') ? (int)$this->request->getPost('quantity') : 1;
        if($qty < 1) $qty = 1;

        $db->table('user_cart_items')->insert([
            'cart_id'    => $cartId,
            'product_id' => $this->request->getPost('product_id') ?: null,
            'service_id' => $this->request->getPost('service_id') ?: null,
            'quantity'   => $qty
        ]);

        return redirect()->back()->with('success', 'Item added to cart.');
    }

    /**
     * Update Quantity and Save Configurations
     */
    public function update()
    {
        $db = \Config\Database::connect();
        $itemId = $this->request->getPost('item_id');
        
        // 1. VALIDATE QTY: Force at least 1 (Fixes "Sets qty to zero")
        $rawQty = (int)$this->request->getPost('qty');
        $qty = max(1, $rawQty);

        // 2. Update Main Item
        $db->table('user_cart_items')->where('id', $itemId)->update([
            'quantity' => $qty
        ]);

        // 3. Clear Old Configs (Pipes/Addons/JSON)
        $db->table('user_cart_item_addons')->where('cart_item_id', $itemId)->delete();

        // 4. Save Service Config (JSON)
        $configData = $this->request->getPost('config');
        if (!empty($configData)) {
            $db->table('user_cart_item_addons')->insert([
                'cart_item_id'    => $itemId,
                'extra_data_json' => json_encode($configData),
                'quantity'        => 1 // Config metadata is singular
            ]);
        }

        // 5. Save Pipe (Matches Unit Qty)
        $pipeId = $this->request->getPost('pipe_id');
        if (!empty($pipeId)) {
            $db->table('user_cart_item_addons')->insert([
                'cart_item_id' => $itemId,
                'pipe_id'      => $pipeId,
                'quantity'     => $qty // Syncs with AC Unit Qty
            ]);
        }

        // 6. Save Addons (Matches Unit Qty)
        $selectedAddons = $this->request->getPost('addons') ?? [];
        foreach ($selectedAddons as $addonId) {
            $db->table('user_cart_item_addons')->insert([
                'cart_item_id' => $itemId,
                'addon_id'     => $addonId,
                'quantity'     => $qty // Syncs with AC Unit Qty (e.g., 3 Install Services for 3 ACs)
            ]);
        }

        return redirect()->to('shop/cart')->with('success', 'Cart updated.');
    }

    public function updateConfig()
    {
        $db = \Config\Database::connect();
        $userId = session()->get('user_id');

        $data = [
            'scheduled_datetime' => $this->request->getPost('scheduled_datetime'),
            'faktur_requested'   => $this->request->getPost('faktur') ? 1 : 0
        ];

        $db->table('user_cart')->where('user_id', $userId)->update($data);
        return $this->response->setJSON(['status' => 'success']);
    }

    public function remove($id)
    {
        $db = \Config\Database::connect();
        $db->table('user_cart_items')->delete(['id' => $id]);
        return redirect()->back()->with('success', 'Item removed.');
    }
}