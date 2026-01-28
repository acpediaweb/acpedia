<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- 1. COMPANY PROFILE (Home Folder) ---
$routes->group('/', ['namespace' => 'App\Controllers\Home'], static function ($routes) {
    $routes->get('', 'HomeController::index');
    $routes->get('about', 'HomeController::about'); 
    $routes->get('contact', 'HomeController::contact');
});

// --- 2. AUTHENTICATION (Auth Folder) ---
$routes->group('', ['namespace' => 'App\Controllers\Auth'], static function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login/attempt', 'AuthController::attemptLogin');
    $routes->get('register', 'AuthController::register');
    $routes->post('register/attempt', 'AuthController::attemptRegister');
    $routes->get('logout', 'AuthController::logout');
});

// --- 3. SHOP & SERVICES (Shop Folder) ---
$routes->group('shop', ['namespace' => 'App\Controllers\Shop'], static function ($routes) {
    
    // A. Main Catalog Index (This was missing!)
    $routes->get('', 'ShopController::index');

    // B. Specific Pages (Must come BEFORE generic segments)
    $routes->get('services', 'ServiceController::index');

    // C. Cart Operations
    $routes->group('cart', static function ($routes) {
        $routes->get('/', 'CartController::index');             // View Cart
        $routes->post('add', 'CartController::add');            // Add Item
        $routes->post('update', 'CartController::update');      // Update Qty & Config
        $routes->post('updateConfig', 'CartController::updateConfig'); // AJAX Auto-save
        $routes->get('remove/(:num)', 'CartController::remove/$1'); // Remove Item
    });

    // D. Checkout Flow
    $routes->group('checkout', static function ($routes) {
        $routes->get('/', 'CheckoutController::index');
        $routes->post('process', 'CheckoutController::process');
    });

    // E. Generic Product Detail (Catch-all for slugs)
    // Example: shop/daikin-1pk
    $routes->get('(:segment)', 'ShopController::detail/$1'); 
});

// --- 4. CUSTOMER DASHBOARD (For Order History) ---
$routes->group('customer', ['namespace' => 'App\Controllers\Customer'], static function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('orders', 'OrderController::index');
    $routes->get('profile', 'ProfileController::index');
});