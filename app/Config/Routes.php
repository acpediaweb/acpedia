<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/toko-kami', 'Toko::index');
$routes->get('api/products', 'Toko::apiList');
