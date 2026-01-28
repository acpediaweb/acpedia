<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- 0. FILE SERVING (Public uploads) ---
$routes->get('file/uploads/(:any)', 'FileController::uploads/$1');

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

// --- 4. USERS AREA (Users Folder) ---
$routes->group('users', ['namespace' => 'App\Controllers\Users'], static function ($routes) {
    
    // A. Profile Management
    $routes->get('profile', 'UserProfile::index');
    $routes->post('profile/update', 'UserProfile::updateProfile');
    $routes->post('profile/update-picture', 'UserProfile::updateProfilePicture');
    $routes->post('profile/change-password', 'UserProfile::changePassword');

    // B. Address Management
    $routes->get('address', 'UserAddress::index');
    $routes->get('address/create', 'UserAddress::create');
    $routes->post('address/store', 'UserAddress::store');
    $routes->get('address/edit/(:num)', 'UserAddress::edit/$1');
    $routes->post('address/update/(:num)', 'UserAddress::update/$1');
    $routes->get('address/set-primary/(:num)', 'UserAddress::setPrimary/$1');
    $routes->get('address/delete/(:num)', 'UserAddress::delete/$1');

    // C. Order Management
    $routes->get('orders', 'UserOrders::list');
    $routes->get('orders/(:num)', 'UserOrders::detail/$1');

    // D. Notifications
    $routes->get('notification', 'UserNotif::index');
    $routes->get('notification/mark-read/(:num)', 'UserNotif::markAsRead/$1');

    // E. User Units (Inventory)
    $routes->get('units', 'UserUnits::list');
    $routes->get('units/(:num)', 'UserUnits::detail/$1');
});

// --- 5. ADMIN PANEL (Admin Folder) ---
$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'adminfilter'], static function ($routes) {
    
    // A. Dashboard
    $routes->get('', 'Dashboard::index');
    $routes->get('dashboard', 'Dashboard::index');

    // B. Orders Management
    $routes->get('orders', 'Orders::index');
    $routes->get('orders/(:num)', 'Orders::show/$1');
    $routes->post('orders/(:num)/update-status', 'Orders::updateStatus/$1');

    // C. Products Management
    $routes->get('products', 'Products::index');
    $routes->get('products/create', 'Products::edit');
    $routes->get('products/(:num)/edit', 'Products::edit/$1');
    $routes->post('products/save', 'Products::save');
    $routes->post('products/(:num)/delete', 'Products::delete/$1');

    // D. Inventory Management
    $routes->get('inventory', 'Inventory::index');
    $routes->get('inventory/(:num)', 'Inventory::show/$1');
    $routes->post('inventory/(:num)/bind', 'Inventory::bind/$1');
    $routes->post('inventory/(:num)/unbind', 'Inventory::unbind/$1');

    // E. Timeline/Logs
    $routes->get('timeline', 'Timeline::index');
    $routes->get('timeline/(:num)', 'Timeline::show/$1');

    // F. Employee Management
    $routes->get('employee', 'Employee::index');
    $routes->get('employee/(:num)', 'Employee::show/$1');

    // G. Forum Management
    $routes->get('forum', 'Forum::index');
    $routes->get('forum/(:num)', 'Forum::show/$1');
    $routes->get('forum/create', 'Forum::create');
    $routes->post('forum/save', 'Forum::save');
    $routes->post('forum/(:num)/close', 'Forum::closeThread/$1');
    $routes->post('forum/(:num)/reopen', 'Forum::reopenThread/$1');
    $routes->post('forum/(:num)/reply', 'Forum::reply/$1'); // 

    // H. Users Management
    $routes->get('users', 'Users::index');
    $routes->get('users/create', 'Users::edit');
    $routes->get('users/(:num)/edit', 'Users::edit/$1');
    $routes->post('users/save', 'Users::save');
    $routes->post('users/(:num)/delete', 'Users::delete/$1');

    // I. Site Configuration
    $routes->get('config', 'SiteConfig::index');
    $routes->post('config/save', 'SiteConfig::save');
});