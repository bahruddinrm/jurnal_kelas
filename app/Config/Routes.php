<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultController('login');
$routes->get('/', 'login::index');
$routes->get('/index.php/login', 'login::index');


// $routes->get('/user', 'user::index', ['filter' => 'auth']);

// $routes->get('/admin', 'admin::index', ['filter' => 'auth']);

// $routes->get('/guru', 'guru::index', ['filter' => 'auth']);

// $routes->get('/kepsek', 'kepsek::index', ['filter' => 'auth']);

