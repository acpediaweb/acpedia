<?php

namespace App\Controllers\Shop;

use App\Controllers\BaseController;
use App\Models\CartModel;

class CartController extends BaseController
{
    public function add()
    {
        // 1. Check Authentication
        if (!auth()->loggedIn()) { // Assuming you use a library or session check
            return redirect()->to('login')->with('error', 'Please login to add items to your cart.');
        }

        $userId    = auth()->id();
        $productId = $this->request->getPost('product_id');
        $serviceId = $this->request->getPost('service_id');
        $qty       = $this->request->getPost('quantity') ?? 1;

        $cartModel = new CartModel();

        // 2. Get or Create User Cart
        $cart = $cartModel->where('user_id', $userId)->first();
        if (!$cart) {
            $cartId = $cartModel->insert(['user_id' => $userId]);
        } else {
            $cartId = $cart->id;
        }

        // 3. Save Item to user_cart_items
        $db = \Config\Database::connect();
        $db->table('user_cart_items')->insert([
            'cart_id'    => $cartId,
            'product_id' => $productId ?: null,
            'service_id' => $serviceId ?: null,
            'quantity'   => $qty
        ]);

        return redirect()->back()->with('success', 'Item added to cart!');
    }
}