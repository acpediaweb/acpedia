<?php

namespace App\Controllers\Shop;

use App\Controllers\BaseController;
use App\Models\CartModel;

class CartController extends BaseController
{
    /**
     * Display the cart with data pulled from specific schema tables.
     */
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        $db = \Config\Database::connect();

        // 1. Fetch Cart Header
        $cart = $db->table('user_cart')->where('user_id', $userId)->get()->getRow();
        
        // 2. Fetch Cart Items with joined Product/Service details
        $items = $db->table('user_cart_items as uci')
            ->select('uci.*, p.product_name, p.base_price as p_price, p.sale_price, s.service_title, s.base_price as s_price')
            ->join('user_cart as uc', 'uc.id = uci.cart_id')
            ->join('products as p', 'p.id = uci.product_id', 'left')
            ->join('services as s', 's.id = uci.service_id', 'left')
            ->where('uc.user_id', $userId)
            ->get()
            ->getResult();

        // 3. Attach "Addons/Config" data to each item for the View
        foreach ($items as $item) {
            $item->saved_addons = $db->table('user_cart_item_addons')
                ->where('cart_item_id', $item->id)
                ->get()
                ->getResult();
                
            // Helper to extract specific config from the rows
            $item->service_config = null;
            foreach ($item->saved_addons as $addon) {
                if (!empty($addon->extra_data_json)) {
                    $item->service_config = json_decode($addon->extra_data_json, true);
                    break; 
                }
            }
        }

        // 4. Fetch Dropdown Data from Schema
        $data = [
            'title'         => 'Your Shopping Cart',
            'cart'          => $cart,
            'items'         => $items,
            'brands'        => $db->table('brands')->orderBy('brand_name', 'ASC')->get()->getResult(),
            'pk_categories' => $db->table('pk_categories')->orderBy('id', 'ASC')->get()->getResult(), // From schema
            'types'         => $db->table('types')->orderBy('type_name', 'ASC')->get()->getResult(),   // From schema
            'pipes'         => $db->table('pipes')->get()->getResult(),
            'addons'        => $db->table('addons')->get()->getResult()
        ];

        return view('shop/cart', $data);
    }

    /**
     * Add Item to Cart (Basic Entry)
     */
    public function add()
    {
        if (!session()->get('isLoggedIn')) return redirect()->to('login');

        $userId = session()->get('user_id');
        $db = \Config\Database::connect();
        
        // Get or Create Cart
        $cartModel = new CartModel();
        $cart = $cartModel->where('user_id', $userId)->first();
        $cartId = $cart ? $cart->id : $cartModel->insert(['user_id' => $userId]);

        // Add Item
        $db->table('user_cart_items')->insert([
            'cart_id'    => $cartId,
            'product_id' => $this->request->getPost('product_id') ?: null,
            'service_id' => $this->request->getPost('service_id') ?: null,
            'quantity'   => $this->request->getPost('quantity') ?? 1
        ]);

        return redirect()->back()->with('success', 'Item added to cart.');
    }

    /**
     * Update Quantity and Save Complex Configurations
     */
    public function update()
    {
        $db = \Config\Database::connect();
        $itemId = $this->request->getPost('item_id');
        
        // 1. Update Base Quantity
        $db->table('user_cart_items')->where('id', $itemId)->update([
            'quantity' => $this->request->getPost('qty')
        ]);

        // 2. Clear previous configs/addons for this item (simplest way to sync)
        $db->table('user_cart_item_addons')->where('cart_item_id', $itemId)->delete();

        // 3. Save Service Configuration (Brand, PK, Type)
        $configData = $this->request->getPost('config'); // Array from form
        if (!empty($configData)) {
            // We store this as a JSON row in user_cart_item_addons
            $db->table('user_cart_item_addons')->insert([
                'cart_item_id'    => $itemId,
                'extra_data_json' => json_encode($configData),
                'quantity'        => 1
            ]);
        }

        // 4. Save Selected Pipe
        $pipeId = $this->request->getPost('pipe_id');
        if (!empty($pipeId)) {
            $db->table('user_cart_item_addons')->insert([
                'cart_item_id' => $itemId,
                'pipe_id'      => $pipeId,
                'quantity'     => $this->request->getPost('qty') // Pipe length usually matches unit qty
            ]);
        }

        // 5. Save Selected Addons (Checkbox Array)
        $selectedAddons = $this->request->getPost('addons') ?? [];
        foreach ($selectedAddons as $addonId) {
            $db->table('user_cart_item_addons')->insert([
                'cart_item_id' => $itemId,
                'addon_id'     => $addonId,
                'quantity'     => 1
            ]);
        }

        return redirect()->to('shop/cart')->with('success', 'Cart updated.');
    }

    /**
     * Auto-Save Schedule & Faktur
     */
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