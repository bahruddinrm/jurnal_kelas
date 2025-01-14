<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultController('login');
$routes->get('/', 'login::index');
$routes->get('/index.php/login', 'login::index');
