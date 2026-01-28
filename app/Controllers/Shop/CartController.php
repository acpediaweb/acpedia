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

        // 3. PREPARE DATA FOR VIEW (Crucial Step)
        foreach ($items as $item) {
            // Default Values
            $item->service_config = [];
            $item->saved_pipe_id = '';
            $item->saved_addon_ids = [];

            // Fetch relations
            $savedAddons = $db->table('user_cart_item_addons')
                ->where('cart_item_id', $item->id)
                ->get()
                ->getResult();
                
            foreach ($savedAddons as $addon) {
                // A. Config JSON (Brand/Type/PK)
                if (!empty($addon->extra_data_json)) {
                    $item->service_config = json_decode($addon->extra_data_json, true);
                }
                
                // B. Pipe Selection (Single ID)
                if (!empty($addon->pipe_id)) {
                    $item->saved_pipe_id = (string)$addon->pipe_id;
                }

                // C. Addons (Array of Strings)
                if (!empty($addon->addon_id)) {
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

    // ... (add, update, updateConfig, remove methods remain exactly as provided previously)
    // I will include update() again just to be sure it matches the view's form logic
    
    public function update()
    {
        $db = \Config\Database::connect();
        $itemId = $this->request->getPost('item_id');
        $rawQty = (int)$this->request->getPost('qty');
        $qty = max(1, $rawQty);

        // Update Qty
        $db->table('user_cart_items')->where('id', $itemId)->update(['quantity' => $qty]);

        // Clear Old Configs
        $db->table('user_cart_item_addons')->where('cart_item_id', $itemId)->delete();

        // Save Config
        $configData = $this->request->getPost('config');
        if (!empty($configData)) {
            $db->table('user_cart_item_addons')->insert([
                'cart_item_id' => $itemId,
                'extra_data_json' => json_encode($configData),
                'quantity' => 1
            ]);
        }

        // Save Pipe
        $pipeId = $this->request->getPost('pipe_id');
        if (!empty($pipeId)) {
            $db->table('user_cart_item_addons')->insert([
                'cart_item_id' => $itemId,
                'pipe_id' => $pipeId,
                'quantity' => $qty
            ]);
        }

        // Save Addons
        $selectedAddons = $this->request->getPost('addons') ?? [];
        foreach ($selectedAddons as $addonId) {
            $db->table('user_cart_item_addons')->insert([
                'cart_item_id' => $itemId,
                'addon_id' => $addonId,
                'quantity' => $qty
            ]);
        }

        return redirect()->to('shop/cart')->with('success', 'Changes saved.');
    }

    // Include other methods if needed (add, remove, updateConfig) - referring to previous context they are fine.
    public function updateConfig() {
        $db = \Config\Database::connect();
        $userId = session()->get('user_id');
        $data = [
            'scheduled_datetime' => $this->request->getPost('scheduled_datetime'),
            'faktur_requested' => $this->request->getPost('faktur') ? 1 : 0
        ];
        $db->table('user_cart')->where('user_id', $userId)->update($data);
        return $this->response->setJSON(['status' => 'success']);
    }
    
    public function remove($id) {
        $db = \Config\Database::connect();
        $db->table('user_cart_items')->delete(['id' => $id]);
        return redirect()->back()->with('success', 'Item removed.');
    }
    
    public function add() {
        // Standard add logic
        if (!session()->get('isLoggedIn')) return redirect()->to('login');
        $userId = session()->get('user_id');
        $db = \Config\Database::connect();
        $cartModel = new CartModel();
        $cart = $cartModel->where('user_id', $userId)->first();
        $cartId = $cart ? $cart->id : $cartModel->insert(['user_id' => $userId]);
        $qty = $this->request->getPost('quantity') ? (int)$this->request->getPost('quantity') : 1;
        if($qty < 1) $qty = 1;
        $db->table('user_cart_items')->insert([
            'cart_id' => $cartId,
            'product_id' => $this->request->getPost('product_id') ?: null,
            'service_id' => $this->request->getPost('service_id') ?: null,
            'quantity' => $qty
        ]);
        return redirect()->back()->with('success', 'Added.');
    }
}