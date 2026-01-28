<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- 1. COMPANY PROFILE (Home Folder) ---
$routes->group('/', ['namespace' => 'App\Controllers\Home'], static function ($routes) {
    $routes->get('', 'HomeController::index');
    // Placeholder for future profile pages
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
    
    // 1. Specific Routes FIRST (Hardcoded paths to avoid collision)
    $routes->get('services', 'ServiceController::index');
    
    $routes->group('cart', static function ($routes) {
        $routes->get('/', 'CartController::index');             // View Cart
        $routes->post('add', 'CartController::add');            // Add Item
        $routes->post('update', 'CartController::update');      // Update Qty & Config (Brand, Pipe, etc.)
        $routes->post('updateConfig', 'CartController::updateConfig'); // AJAX Auto-save (Schedule & Faktur)
        $routes->get('remove/(:num)', 'CartController::remove/$1'); // Remove Item
    });

    $routes->group('checkout', static function ($routes) {
        $routes->get('/', 'CheckoutController::index');
        $routes->post('process', 'CheckoutController::process');
    });

    // 2. Generic Slug Route LAST
    // Catches product details like /shop/daikin-1pk
    $routes->get('(:segment)', 'ShopController::detail/$1'); 
});

// --- 4. INTERNAL (Future Persistence/Forum Logic) ---
$routes->group('internal', ['namespace' => 'App\Controllers\Internal'], static function ($routes) {
    // Restricted to Admin, Tech, and Staff
    $routes->get('forum', 'ForumController::index');
    $routes->get('unit/history/(:segment)', 'InventoryController::timeline/$1');
});