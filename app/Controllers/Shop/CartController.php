<?php

namespace App\Controllers\Shop;

use App\Controllers\BaseController;
use App\Models\CartModel;

class CartController extends BaseController
{
    /**
     * Handles adding both Products and Services to the unified cart.
     */
    public function add()
    {
        // 1. Authentication Check
        // Redirect to login if the user is not authenticated.
        if (!auth()->loggedIn()) { 
            return redirect()->to('login')->with('error', 'Please login to add items to your cart.');
        }

        $userId    = auth()->id();
        $productId = $this->request->getPost('product_id');
        $serviceId = $this->request->getPost('service_id');
        $quantity  = $this->request->getPost('quantity') ?? 1;

        $cartModel = new CartModel();
        $db = \Config\Database::connect();

        // 2. Ensure a Cart Header exists for this User (user_cart table)
        // This acts as the parent container for all mixed items.
        $cart = $cartModel->where('user_id', $userId)->first();
        
        if (!$cart) {
            $cartId = $cartModel->insert([
                'user_id' => $userId,
                'faktur_requested' => false
            ]);
        } else {
            $cartId = $cart->id;
        }

        // 3. Handle Mixed Combinations in user_cart_items
        // We check if the exact item (Product or Service) already exists to increment quantity
        $builder = $db->table('user_cart_items');
        
        $existingItem = $builder->where([
            'cart_id'    => $cartId,
            'product_id' => $productId ?: null,
            'service_id' => $serviceId ?: null,
        ])->get()->getRow();

        if ($existingItem) {
            // Update quantity if item is already in cart
            $builder->where('id', $existingItem->id)
                    ->update(['quantity' => $existingItem->quantity + $quantity]);
        } else {
            // Insert new mixed item
            $builder->insert([
                'cart_id'    => $cartId,
                'product_id' => $productId ?: null,
                'service_id' => $serviceId ?: null,
                'quantity'   => $quantity
            ]);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    /**
     * View the full cart with totals for both hardware and labor.
     */
    public function index()
    {
        if (!auth()->loggedIn()) {
            return redirect()->to('login');
        }

        $userId = auth()->id();
        $db = \Config\Database::connect();

        // Complex Join to get names and prices for both Products and Services
        $items = $db->table('user_cart_items as uci')
            ->select('uci.*, p.product_name, p.base_price as p_price, p.sale_price, s.service_title, s.base_price as s_price')
            ->join('user_cart as uc', 'uc.id = uci.cart_id')
            ->join('products as p', 'p.id = uci.product_id', 'left')
            ->join('services as s', 's.id = uci.service_id', 'left')
            ->where('uc.user_id', $userId)
            ->get()
            ->getResult();

        return view('shop/cart', [
            'title' => 'Your Shopping Cart',
            'items' => $items
        ]);
    }
}