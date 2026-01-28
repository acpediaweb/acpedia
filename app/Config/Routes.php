<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Home routes
$routes->get('/', 'Home\HomeController::index');