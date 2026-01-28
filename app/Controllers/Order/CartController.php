<?php

namespace App\Controllers\Order;

use App\Controllers\BaseController;
use App\Models\Order\UserCartModel;
use App\Models\Order\UserCartItemModel;
use App\Models\Inventory\ProductModel;

class CartController extends BaseController
{
    protected $cartModel;
    protected $cartItemModel;
    protected $productModel;

    public function __construct()
    {
        $this->cartModel = new UserCartModel();
        $this->cartItemModel = new UserCartItemModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $cart = $this->cartModel->getByUserId($userId);

        if ($cart) {
            $items = $this->cartItemModel->getByCartId($cart->id);
        } else {
            $items = [];
        }

        return view('order/cart/index', ['cart' => $cart ?? null, 'items' => $items]);
    }

    public function addItem()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $cart = $this->cartModel->getByUserId($userId);

        if (!$cart) {
            $cartId = $this->cartModel->insert(['user_id' => $userId]);
            $cart = $this->cartModel->find($cartId);
        }

        $data = [
            'cart_id' => $cart->id,
            'product_id' => $this->request->getPost('product_id'),
            'quantity' => $this->request->getPost('quantity'),
        ];

        if ($this->cartItemModel->insert($data)) {
            return redirect()->back()->with('success', 'Item added to cart');
        }

        return redirect()->back()->with('error', 'Failed to add item to cart');
    }

    public function removeItem($itemId)
    {
        if ($this->cartItemModel->delete($itemId)) {
            return redirect()->back()->with('success', 'Item removed from cart');
        }

        return redirect()->back()->with('error', 'Failed to remove item from cart');
    }

    public function checkout()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('user_id');
        $cart = $this->cartModel->getByUserId($userId);

        if (!$cart) {
            return redirect()->to('/cart')->with('error', 'Cart is empty');
        }

        return view('order/cart/checkout', ['cart' => $cart]);
    }
}
