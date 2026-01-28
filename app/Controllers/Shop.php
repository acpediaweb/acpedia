<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Shop extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $cartModel;

    public function __construct()
    {
        $this->productModel = new \App\Models\Inventory\ProductModel();
        $this->categoryModel = new \App\Models\Catalog\CategoryModel();
        $this->cartModel = new \App\Models\Order\UserCartModel();
    }

    /**
     * Display shop/e-commerce storefront
     * Route: /toko-kami
     */
    public function index()
    {
        $page = (int)($this->request->getGet('page') ?? 1);
        $perPage = 12;
        $category = $this->request->getGet('category');
        $search = $this->request->getGet('search');

        $query = $this->productModel->where('product_status', 'Available');

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($search) {
            $query->like('product_name', $search);
        }

        $products = $query->paginate($perPage, 'shop');
        $categories = $this->categoryModel->findAll();
        $pager = \Config\Services::pager();

        $data = [
            'title' => 'ACPedia - Toko Kami',
            'page' => 'shop',
            'products' => $products,
            'categories' => $categories,
            'pager' => $pager,
            'currentPage' => $page,
            'selectedCategory' => $category,
            'searchQuery' => $search,
        ];

        return view('shop/index', $data);
    }

    /**
     * Display product detail page
     * Route: /toko-kami/produk/{id}
     */
    public function detail($id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Produk tidak ditemukan');
        }

        // Get related products from same category
        $relatedProducts = $this->productModel
            ->where('category_id', $product->category_id)
            ->where('product_id !=', $id)
            ->limit(4)
            ->findAll();

        $data = [
            'title' => $product->product_name . ' - ACPedia',
            'page' => 'product_detail',
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ];

        return view('shop/detail', $data);
    }

    /**
     * Display shopping cart
     * Route: /toko-kami/keranjang
     */
    public function cart()
    {
        $userId = session('user_id');

        if (!$userId) {
            session()->setFlashdata('warning', 'Silakan login untuk melihat keranjang belanja Anda.');
            return redirect()->to('/auth/login');
        }

        $cart = $this->cartModel->where('user_id', $userId)->first();
        $cartItems = [];

        if ($cart) {
            $cartItemModel = new \App\Models\Order\UserCartItemModel();
            $cartItems = $cartItemModel->where('cart_id', $cart->id)->findAll();
        }

        $data = [
            'title' => 'ACPedia - Keranjang Belanja',
            'page' => 'cart',
            'cart' => $cart,
            'cartItems' => $cartItems,
        ];

        return view('shop/cart', $data);
    }

    /**
     * Add product to cart
     * Route: POST /toko-kami/add-to-cart/{productId}
     */
    public function addToCart($productId)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $userId = session('user_id');

        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Silakan login terlebih dahulu']);
        }

        $product = $this->productModel->find($productId);

        if (!$product) {
            return $this->response->setJSON(['success' => false, 'message' => 'Produk tidak ditemukan']);
        }

        // Get or create cart
        $cart = $this->cartModel->where('user_id', $userId)->first();

        if (!$cart) {
            $this->cartModel->insert(['user_id' => $userId, 'cart_status' => 'Active']);
            $cart = $this->cartModel->where('user_id', $userId)->first();
        }

        // Add item to cart
        $cartItemModel = new \App\Models\Order\UserCartItemModel();
        $quantity = (int)($this->request->getPost('quantity') ?? 1);

        // Check if product already in cart
        $existingItem = $cartItemModel->where('cart_id', $cart->id)
                                      ->where('product_id', $productId)
                                      ->first();

        if ($existingItem) {
            $cartItemModel->update($existingItem->id, [
                'quantity' => $existingItem->quantity + $quantity,
                'subtotal' => ($existingItem->quantity + $quantity) * $product->product_price,
            ]);
        } else {
            $cartItemModel->insert([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'subtotal' => $quantity * $product->product_price,
            ]);
        }

        return $this->response->setJSON(['success' => true, 'message' => 'Produk ditambahkan ke keranjang']);
    }

    /**
     * Remove product from cart
     * Route: POST /toko-kami/remove-from-cart/{cartItemId}
     */
    public function removeFromCart($cartItemId)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $userId = session('user_id');

        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Anda tidak memiliki akses']);
        }

        $cartItemModel = new \App\Models\Order\UserCartItemModel();
        $item = $cartItemModel->find($cartItemId);

        if (!$item) {
            return $this->response->setJSON(['success' => false, 'message' => 'Item tidak ditemukan']);
        }

        $cartItemModel->delete($cartItemId);

        return $this->response->setJSON(['success' => true, 'message' => 'Produk dihapus dari keranjang']);
    }

    /**
     * Update cart item quantity
     * Route: POST /toko-kami/update-cart/{cartItemId}
     */
    public function updateCart($cartItemId)
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $userId = session('user_id');

        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Anda tidak memiliki akses']);
        }

        $quantity = (int)($this->request->getPost('quantity') ?? 1);

        if ($quantity < 1) {
            return $this->response->setJSON(['success' => false, 'message' => 'Kuantitas tidak valid']);
        }

        $cartItemModel = new \App\Models\Order\UserCartItemModel();
        $item = $cartItemModel->find($cartItemId);

        if (!$item) {
            return $this->response->setJSON(['success' => false, 'message' => 'Item tidak ditemukan']);
        }

        // Get product price
        $product = $this->productModel->find($item->product_id);
        $subtotal = $quantity * $product->product_price;

        $cartItemModel->update($cartItemId, [
            'quantity' => $quantity,
            'subtotal' => $subtotal,
        ]);

        return $this->response->setJSON(['success' => true, 'message' => 'Keranjang diperbarui']);
    }

    /**
     * Display checkout page
     * Route: /toko-kami/checkout
     */
    public function checkout()
    {
        $userId = session('user_id');

        if (!$userId) {
            session()->setFlashdata('warning', 'Silakan login untuk melakukan checkout.');
            return redirect()->to('/auth/login');
        }

        $cart = $this->cartModel->where('user_id', $userId)->first();

        if (!$cart) {
            session()->setFlashdata('warning', 'Keranjang belanja Anda kosong.');
            return redirect()->to('/toko-kami');
        }

        $cartItemModel = new \App\Models\Order\UserCartItemModel();
        $cartItems = $cartItemModel->where('cart_id', $cart->id)->findAll();

        if (empty($cartItems)) {
            session()->setFlashdata('warning', 'Keranjang belanja Anda kosong.');
            return redirect()->to('/toko-kami');
        }

        // Get user address for shipping
        $userAddressModel = new \App\Models\IAM\UserAddressModel();
        $addresses = $userAddressModel->where('user_id', $userId)->findAll();

        $data = [
            'title' => 'ACPedia - Checkout',
            'page' => 'checkout',
            'cart' => $cart,
            'cartItems' => $cartItems,
            'addresses' => $addresses,
        ];

        return view('shop/checkout', $data);
    }

    /**
     * Process checkout and create order
     * Route: POST /toko-kami/process-checkout
     */
    public function processCheckout()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back();
        }

        $userId = session('user_id');

        if (!$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Anda harus login']);
        }

        $validationRules = [
            'address_id' => 'required|integer',
            'shipping_method' => 'required|in_list[Standard,Express,Same-Day]',
            'payment_method' => 'required|in_list[Bank Transfer,Credit Card,E-Wallet,Cash on Delivery]',
        ];

        if (!$this->validate($validationRules)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak valid']);
        }

        // Create order
        $orderModel = new \App\Models\Order\OrderModel();
        $cartItemModel = new \App\Models\Order\UserCartItemModel();

        $cart = $this->cartModel->where('user_id', $userId)->first();

        if (!$cart) {
            return $this->response->setJSON(['success' => false, 'message' => 'Keranjang tidak ditemukan']);
        }

        $cartItems = $cartItemModel->where('cart_id', $cart->id)->findAll();

        if (empty($cartItems)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Keranjang kosong']);
        }

        // Calculate total
        $totalAmount = 0;
        foreach ($cartItems as $item) {
            $totalAmount += $item->subtotal;
        }

        $orderData = [
            'user_id' => $userId,
            'address_id' => $this->request->getPost('address_id'),
            'shipping_method' => $this->request->getPost('shipping_method'),
            'payment_method' => $this->request->getPost('payment_method'),
            'total_amount' => $totalAmount,
            'order_status' => 'Pending',
        ];

        if ($orderId = $orderModel->insert($orderData)) {
            // Create order items
            $orderItemModel = new \App\Models\Order\OrderItemModel();

            foreach ($cartItems as $item) {
                $orderItemModel->insert([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'item_price' => $item->subtotal / $item->quantity,
                    'item_total' => $item->subtotal,
                ]);
            }

            // Clear cart
            $this->cartModel->update($cart->id, ['cart_status' => 'Completed']);
            $cartItemModel->where('cart_id', $cart->id)->delete();

            session()->setFlashdata('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.');
            return $this->response->setJSON(['success' => true, 'orderId' => $orderId, 'redirect' => '/toko-kami/order/' . $orderId]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal membuat pesanan']);
    }

    /**
     * Display order detail
     * Route: /toko-kami/order/{orderId}
     */
    public function orderDetail($orderId)
    {
        $userId = session('user_id');

        if (!$userId) {
            return redirect()->to('/auth/login');
        }

        $orderModel = new \App\Models\Order\OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order || $order->user_id != $userId) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Pesanan tidak ditemukan');
        }

        $orderItemModel = new \App\Models\Order\OrderItemModel();
        $orderItems = $orderItemModel->where('order_id', $orderId)->findAll();

        $data = [
            'title' => 'ACPedia - Detail Pesanan',
            'page' => 'order_detail',
            'order' => $order,
            'orderItems' => $orderItems,
        ];

        return view('shop/order_detail', $data);
    }

    /**
     * Display product comparison page
     * Route: /bandingkan
     */
    public function compare()
    {
        $data = [
            'title' => 'ACPedia - Bandingkan Produk',
            'page' => 'compare',
        ];

        return view('shop/compare', $data);
    }
}
