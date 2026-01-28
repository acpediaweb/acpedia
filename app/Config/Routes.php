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
    $routes->get('', 'ShopController::index');           // Product list
    $routes->get('(:segment)', 'ShopController::detail/$1'); // Product detail (slug)
    $routes->get('category/(:segment)', 'ShopController::category/$1'); // Filter by category
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