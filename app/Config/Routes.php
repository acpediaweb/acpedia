<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Home routes
$routes->get('/', 'Home::index');
$routes->get('/tentang-kami', 'Home::about');
$routes->get('/layanan', 'Home::services');
$routes->get('/layanan/(:alpha)', 'Home::serviceDetail/$1');
$routes->get('/hubungi-kami', 'Home::contact');
$routes->post('/hubungi-kami', 'Home::contact');
$routes->get('/form-hvac', 'Home::hvacForm');
$routes->post('/form-hvac', 'Home::hvacForm');
$routes->get('/proyek', 'Home::projects');
$routes->get('/proyek/hvac-contact', 'Home::hvacContact');

// Shop routes
$routes->group('toko-kami', function($routes) {
    $routes->get('/', 'Shop::index');
    $routes->get('produk/(:num)', 'Shop::detail/$1');
    $routes->get('keranjang', 'Shop::cart');
    $routes->post('add-to-cart/(:num)', 'Shop::addToCart/$1');
    $routes->post('remove-from-cart/(:num)', 'Shop::removeFromCart/$1');
    $routes->post('update-cart/(:num)', 'Shop::updateCart/$1');
    $routes->get('checkout', 'Shop::checkout');
    $routes->post('process-checkout', 'Shop::processCheckout');
    $routes->get('order/(:num)', 'Shop::orderDetail/$1');
});

// Compare products route
$routes->get('/bandingkan', 'Shop::compare');

// ============================================
// AUTHENTICATION ROUTES
// ============================================
$routes->group('auth', function($routes) {
    $routes->post('login', 'Auth\AuthController::login');
    $routes->get('login', 'Auth\AuthController::login');
    $routes->post('register', 'Auth\AuthController::register');
    $routes->get('register', 'Auth\AuthController::register');
    $routes->get('logout', 'Auth\AuthController::logout');
    $routes->get('profile', 'Auth\AuthController::profile');
    $routes->post('update-profile', 'Auth\AuthController::updateProfile');
});

// ============================================
// IAM (User Management) ROUTES
// ============================================
$routes->group('users', function($routes) {
    $routes->get('/', 'IAM\UserController::index');
    $routes->get('create', 'IAM\UserController::create');
    $routes->post('store', 'IAM\UserController::store');
    $routes->get('(:num)/edit', 'IAM\UserController::edit/$1');
    $routes->post('(:num)/update', 'IAM\UserController::update/$1');
    $routes->get('(:num)', 'IAM\UserController::show/$1');
    $routes->get('(:num)/delete', 'IAM\UserController::delete/$1');
});

$routes->group('roles', function($routes) {
    $routes->get('/', 'IAM\RoleController::index');
    $routes->get('create', 'IAM\RoleController::create');
    $routes->post('store', 'IAM\RoleController::store');
    $routes->get('(:num)/edit', 'IAM\RoleController::edit/$1');
    $routes->post('(:num)/update', 'IAM\RoleController::update/$1');
    $routes->get('(:num)/delete', 'IAM\RoleController::delete/$1');
});

// ============================================
// CATALOG ROUTES
// ============================================
$routes->group('categories', function($routes) {
    $routes->get('/', 'Catalog\CategoryController::index');
    $routes->get('create', 'Catalog\CategoryController::create');
    $routes->post('store', 'Catalog\CategoryController::store');
    $routes->get('(:num)/edit', 'Catalog\CategoryController::edit/$1');
    $routes->post('(:num)/update', 'Catalog\CategoryController::update/$1');
    $routes->get('(:num)/delete', 'Catalog\CategoryController::delete/$1');
});

$routes->group('brands', function($routes) {
    $routes->get('/', 'Catalog\BrandController::index');
    $routes->get('create', 'Catalog\BrandController::create');
    $routes->post('store', 'Catalog\BrandController::store');
    $routes->get('(:num)/edit', 'Catalog\BrandController::edit/$1');
    $routes->post('(:num)/update', 'Catalog\BrandController::update/$1');
    $routes->get('(:num)/delete', 'Catalog\BrandController::delete/$1');
});

$routes->group('services', function($routes) {
    $routes->get('/', 'Catalog\ServiceController::index');
    $routes->get('create', 'Catalog\ServiceController::create');
    $routes->post('store', 'Catalog\ServiceController::store');
    $routes->get('(:num)/edit', 'Catalog\ServiceController::edit/$1');
    $routes->post('(:num)/update', 'Catalog\ServiceController::update/$1');
    $routes->get('(:num)/delete', 'Catalog\ServiceController::delete/$1');
});

// ============================================
// INVENTORY ROUTES
// ============================================
$routes->group('products', function($routes) {
    $routes->get('/', 'Inventory\ProductController::index');
    $routes->get('create', 'Inventory\ProductController::create');
    $routes->post('store', 'Inventory\ProductController::store');
    $routes->get('(:num)/edit', 'Inventory\ProductController::edit/$1');
    $routes->post('(:num)/update', 'Inventory\ProductController::update/$1');
    $routes->get('(:num)/delete', 'Inventory\ProductController::delete/$1');
    $routes->get('(:num)', 'Inventory\ProductController::show/$1');
});

$routes->group('inventory', function($routes) {
    $routes->get('/', 'Inventory\InventoryController::index');
    $routes->get('create', 'Inventory\InventoryController::create');
    $routes->post('store', 'Inventory\InventoryController::store');
    $routes->get('(:num)/edit', 'Inventory\InventoryController::edit/$1');
    $routes->post('(:num)/update', 'Inventory\InventoryController::update/$1');
    $routes->get('(:num)/delete', 'Inventory\InventoryController::delete/$1');
    $routes->get('(:num)', 'Inventory\InventoryController::show/$1');
});

// ============================================
// ORDER ROUTES
// ============================================
$routes->group('cart', function($routes) {
    $routes->get('/', 'Order\CartController::index');
    $routes->post('add-item', 'Order\CartController::addItem');
    $routes->get('remove-item/(:num)', 'Order\CartController::removeItem/$1');
    $routes->get('checkout', 'Order\CartController::checkout');
});

$routes->group('orders', function($routes) {
    $routes->get('/', 'Order\OrderController::index');
    $routes->post('store', 'Order\OrderController::store');
    $routes->get('(:num)', 'Order\OrderController::show/$1');
    $routes->get('(:num)/cancel', 'Order\OrderController::cancel/$1');
});

// ============================================
// OPERATIONS ROUTES
// ============================================
$routes->group('technician-work', function($routes) {
    $routes->get('/', 'Operations\TechnicianWorkController::index');
    $routes->post('clock-in/(:num)', 'Operations\TechnicianWorkController::clockIn/$1');
    $routes->get('clock-in/(:num)', 'Operations\TechnicianWorkController::clockIn/$1');
    $routes->post('clock-out/(:num)', 'Operations\TechnicianWorkController::clockOut/$1');
    $routes->get('clock-out/(:num)', 'Operations\TechnicianWorkController::clockOut/$1');
});

$routes->group('discussion', function($routes) {
    $routes->get('(:num)', 'Operations\DiscussionController::index/$1');
    $routes->post('(:num)/add-message', 'Operations\DiscussionController::addMessage/$1');
});

// ============================================
// COMMUNITY ROUTES
// ============================================
$routes->group('tickets', function($routes) {
    $routes->get('/', 'Community\TicketController::index');
    $routes->get('create', 'Community\TicketController::create');
    $routes->post('store', 'Community\TicketController::store');
    $routes->get('(:num)', 'Community\TicketController::show/$1');
    $routes->post('(:num)/add-response', 'Community\TicketController::addResponse/$1');
});

$routes->group('forum', function($routes) {
    $routes->get('/', 'Community\ForumController::index');
    $routes->get('create', 'Community\ForumController::create');
    $routes->post('store', 'Community\ForumController::store');
    $routes->get('(:num)', 'Community\ForumController::show/$1');
    $routes->post('(:num)/add-post', 'Community\ForumController::addPost/$1');
});

$routes->group('faq', function($routes) {
    $routes->get('/', 'Community\FAQController::index');
    $routes->get('category/(:num)', 'Community\FAQController::byCategory/$1');
    $routes->get('search', 'Community\FAQController::search');
    $routes->post('(:num)/vote', 'Community\FAQController::vote/$1');
});

// ============================================
// SYSTEM ROUTES
// ============================================
$routes->group('pages', function($routes) {
    $routes->get('/', 'System\PageController::index');
    $routes->get('create', 'System\PageController::create');
    $routes->post('store', 'System\PageController::store');
    $routes->get('(:num)/edit', 'System\PageController::edit/$1');
    $routes->post('(:num)/update', 'System\PageController::update/$1');
    $routes->get('(:num)/delete', 'System\PageController::delete/$1');
    $routes->get('view/(:any)', 'System\PageController::show/$1');
});

$routes->group('forms', function($routes) {
    $routes->post('hvac', 'System\FormController::submitHVACForm');
    $routes->get('hvac', 'System\FormController::submitHVACForm');
    $routes->post('contact', 'System\FormController::submitContactForm');
    $routes->get('contact', 'System\FormController::submitContactForm');
    $routes->get('hvac-submissions', 'System\FormController::viewHVACSubmissions');
    $routes->get('contact-submissions', 'System\FormController::viewContactSubmissions');
});

$routes->group('configuration', function($routes) {
    $routes->get('/', 'System\ConfigurationController::index');
    $routes->get('(:num)/edit', 'System\ConfigurationController::edit/$1');
    $routes->post('(:num)/update', 'System\ConfigurationController::update/$1');
});
