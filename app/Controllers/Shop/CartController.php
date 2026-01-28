<?php

namespace App\Controllers\Shop;

use App\Controllers\BaseController;
use App\Models\CartModel;

class CartController extends BaseController
{
    /**
     * View the full cart with detailed configuration options.
     */
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        $db = \Config\Database::connect();

        // 1. Fetch Cart Header (for schedule and faktur toggle)
        $cart = $db->table('user_cart')->where('user_id', $userId)->get()->getRow();
        
        // 2. Fetch Items with joined data for display
        $items = $db->table('user_cart_items as uci')
            ->select('uci.*, p.product_name, p.base_price as p_price, p.sale_price, s.service_title, s.base_price as s_price')
            ->join('user_cart as uc', 'uc.id = uci.cart_id')
            ->join('products as p', 'p.id = uci.product_id', 'left')
            ->join('services as s', 's.id = uci.service_id', 'left')
            ->where('uc.user_id', $userId)
            ->get()
            ->getResult();

        // 3. Fetch auxiliary data for service configuration dropdowns
        $brands = $db->table('brands')->get()->getResult();
        $types  = $db->table('product_types')->get()->getResult();

        return view('shop/cart', [
            'title'  => 'Your Shopping Cart',
            'cart'   => $cart,
            'items'  => $items,
            'brands' => $brands,
            'types'  => $types
        ]);
    }

    /**
     * Handles adding both Products and Services to the unified cart.
     */
    public function add()
    {
        if (!session()->get('isLoggedIn')) { 
            return redirect()->to('login')->with('error', 'Please login to add items to your cart.');
        }

        $userId    = session()->get('user_id');
        $productId = $this->request->getPost('product_id');
        $serviceId = $this->request->getPost('service_id');
        $quantity  = $this->request->getPost('quantity') ?? 1;

        $cartModel = new CartModel();
        $db = \Config\Database::connect();

        $cart = $cartModel->where('user_id', $userId)->first();
        $cartId = $cart ? $cart->id : $cartModel->insert(['user_id' => $userId, 'faktur_requested' => false]);

        $builder = $db->table('user_cart_items');
        $existingItem = $builder->where([
            'cart_id'    => $cartId,
            'product_id' => $productId ?: null,
            'service_id' => $serviceId ?: null,
        ])->get()->getRow();

        if ($existingItem) {
            $builder->where('id', $existingItem->id)->update(['quantity' => $existingItem->quantity + $quantity]);
        } else {
            $builder->insert([
                'cart_id'    => $cartId,
                'product_id' => $productId ?: null,
                'service_id' => $serviceId ?: null,
                'quantity'   => $quantity,
                'config'     => json_encode([]) // Initialize empty config
            ]);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    /**
     * Updates item quantity and JSON configuration (PK, Brand, Addons).
     */
    public function update()
    {
        $db = \Config\Database::connect();
        $itemId = $this->request->getPost('item_id');
        
        $data = [
            'quantity' => $this->request->getPost('qty'),
            'config'   => json_encode($this->request->getPost('config')) // Saves Brand, PK, Addons, etc.
        ];

        $db->table('user_cart_items')->where('id', $itemId)->update($data);
        
        return redirect()->to('shop/cart')->with('success', 'Item configuration updated.');
    }

    /**
     * Auto-save for Cart Header settings (Schedule & Faktur).
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
        
        return $this->response->setJSON(['status' => 'success', 'message' => 'Schedule saved.']);
    }

    /**
     * Remove an item from the cart.
     */
    public function remove($id)
    {
        $db = \Config\Database::connect();
        $db->table('user_cart_items')->delete(['id' => $id]);
        
        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}