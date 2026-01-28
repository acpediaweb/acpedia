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

// --- 2. SHOP FRONTEND (Shop Folder) ---
$routes->group('shop', ['namespace' => 'App\Controllers\Shop'], static function ($routes) {
    
    // Products & Services (Previously defined)
    $routes->get('product/(:segment)', 'ShopController::detail/$1');
    $routes->get('services', 'ServiceController::index');

    // Cart Management
    $routes->group('cart', static function ($routes) {
        $routes->get('/', 'CartController::index');             // View full cart (shop/cart.php)
        $routes->post('add', 'CartController::add');            // Add item (Product or Service)
        $routes->get('remove/(:num)', 'CartController::remove/$1'); // Remove item by ID
        $routes->post('update', 'CartController::update');      // Optional: Update quantities
    });

    // Checkout Flow
    $routes->group('checkout', static function ($routes) {
        $routes->get('/', 'CheckoutController::index');         // Address & Payment selection
        $routes->post('process', 'CheckoutController::process'); // Finalize order & Snapshot data
    });
});



// --- 3. SERVICES & BOOKING ---
$routes->group('services', ['namespace' => 'App\Controllers\Shop'], static function ($routes) {
    $routes->get('', 'ServiceController::index');
    $routes->get('book/(:num)', 'ServiceController::book/$1');
});

// --- 4. INTERNAL (Forum, Admin, Tech) ---
// Note: We will add 'filters' here later to restrict access
$routes->group('internal', ['namespace' => 'App\Controllers\Internal'], static function ($routes) {
    $routes->get('forum', 'ForumController::index');
    $routes->get('forum/thread/(:num)', 'ForumController::view/$1');
    
    // Inventory Unit Lifecycle (The Persistent History)
    $routes->get('inventory/unit/(:segment)', 'InventoryController::timeline/$1');
});

// --- 5. AUTHENTICATION ---
$routes->get('login', 'Auth\LoginController::index');
$routes->post('login/attempt', 'Auth\LoginController::attempt');
$routes->get('logout', 'Auth\LoginController::logout');