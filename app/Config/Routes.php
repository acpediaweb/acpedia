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
    // Product Catalog
    $routes->get('', 'ShopController::index');
    $routes->get('(:segment)', 'ShopController::detail/$1'); // Detail view (lowercase file: detail.php)
    
    // Services (Mixed with products in cart)
    $routes->get('services', 'ServiceController::index'); // Lowercase file: services.php
    
    // Unified Cart Operations
    $routes->group('cart', static function ($routes) {
        $routes->get('/', 'CartController::index');        // Lowercase file: cart.php
        $routes->post('add', 'CartController::add');
        $routes->get('remove/(:num)', 'CartController::remove/$1');
    });

    // Checkout (Snapshot Logic)
    $routes->group('checkout', static function ($routes) {
        $routes->get('/', 'CheckoutController::index');
        $routes->post('process', 'CheckoutController::process');
    });
});

// --- 4. INTERNAL (Future Persistence/Forum Logic) ---
$routes->group('internal', ['namespace' => 'App\Controllers\Internal'], static function ($routes) {
    // Restricted to Admin, Tech, and Staff
    $routes->get('forum', 'ForumController::index');
    $routes->get('unit/history/(:segment)', 'InventoryController::timeline/$1');
});