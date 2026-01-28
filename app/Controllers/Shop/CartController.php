<?php

namespace App\Controllers\Shop;

use App\Controllers\BaseController;
use App\Models\CartModel;

class CartController extends BaseController
{
    /**
     * Display the full cart page with configuration options.
     */
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        $db = \Config\Database::connect();

        // 1. Fetch Cart Header (Schedule & Faktur)
        $cart = $db->table('user_cart')->where('user_id', $userId)->get()->getRow();
        
        // 2. Fetch Items with joined Product/Service data
        $items = $db->table('user_cart_items as uci')
            ->select('uci.*, p.product_name, p.base_price as p_price, p.sale_price, s.service_title, s.base_price as s_price')
            ->join('user_cart as uc', 'uc.id = uci.cart_id')
            ->join('products as p', 'p.id = uci.product_id', 'left')
            ->join('services as s', 's.id = uci.service_id', 'left')
            ->where('uc.user_id', $userId)
            ->get()
            ->getResult();

        // 3. Fetch data for Mandatory Configurations and Addons
        $brands     = $db->table('brands')->get()->getResult();
        $categories = $db->table('categories')->get()->getResult();
        
        // Fetch low-cost services typically used as addons (Pipe, Installation, etc.)
        $addons = $db->table('services')
            ->where('base_price <', 1000000) 
            ->get()
            ->getResult();

        return view('shop/cart', [
            'title'      => 'Manage Your Cart',
            'cart'       => $cart,
            'items'      => $items,
            'brands'     => $brands,
            'categories' => $categories,
            'addons'     => $addons
        ]);
    }

    /**
     * Add a product or service to the cart.
     */
    public function add()
    {
        if (!session()->get('isLoggedIn')) { 
            return redirect()->to('login')->with('error', 'Please login to add items.');
        }

        $userId    = session()->get('user_id');
        $productId = $this->request->getPost('product_id');
        $serviceId = $this->request->getPost('service_id');
        $quantity  = $this->request->getPost('quantity') ?? 1;

        $cartModel = new CartModel();
        $db = \Config\Database::connect();

        // Get or Create Cart Header
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
                'config'     => json_encode([]) // Start with empty JSON config
            ]);
        }

        return redirect()->back()->with('success', 'Added to cart!');
    }

    /**
     * Update individual item configuration (PK, Brand, Addons) and Qty.
     */
    public function update()
    {
        $db = \Config\Database::connect();
        $itemId = $this->request->getPost('item_id');
        
        // This takes the 'config' array from the form and stores it as JSON
        $data = [
            'quantity' => $this->request->getPost('qty'),
            'config'   => json_encode($this->request->getPost('config')) 
        ];

        $db->table('user_cart_items')->where('id', $itemId)->update($data);
        
        return redirect()->to('shop/cart')->with('success', 'Cart updated.');
    }

    /**
     * Auto-save Cart Header settings (Schedule & Faktur) via AJAX.
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

    /**
     * Remove item from cart.
     */
    public function remove($id)
    {
        $db = \Config\Database::connect();
        $db->table('user_cart_items')->delete(['id' => $id]);
        
        return redirect()->back()->with('success', 'Item removed.');
    }
}