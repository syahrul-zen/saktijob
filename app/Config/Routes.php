<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/lowongan', 'Lowongan::index');
$routes->get('/lowongan/detail/(:num)', 'Lowongan::detail/$1');

// Auth routes
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::doLogin');

$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::doRegister');

// Register choice page
$routes->get('/daftar', 'AuthController::registerChoice');

$routes->get('/logout', 'AuthController::logout');


$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('dataperusahaan', 'Dataperusahaan::index');
    $routes->get('lowongan', 'Lowongan::index');
    $routes->post('dataperusahaan/verify/(:num)', 'Dataperusahaan::verify/$1');
    $routes->post('dataperusahaan/reject/(:num)', 'Dataperusahaan::reject/$1');
});

$routes->group('perusahaan', ['namespace' => 'App\\Controllers\\Perusahaan'], function($routes) {
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('profile', 'Profile::index');
    $routes->post('profile', 'Profile::submit');
    $routes->get('pending', 'Profile::pending');
    $routes->get('lowongan', 'Lowongan::index');
    $routes->get('lowongan/create', 'Lowongan::create');
    $routes->post('lowongan', 'Lowongan::store');
    $routes->get('lowongan/edit/(:num)', 'Lowongan::edit/$1');
    $routes->post('lowongan/update/(:num)', 'Lowongan::update/$1');
    $routes->post('lowongan/delete/(:num)', 'Lowongan::delete/$1');
    $routes->post('lowongan/publish/(:num)', 'Lowongan::publish/$1');
    $routes->post('lowongan/unpublish/(:num)', 'Lowongan::unpublish/$1');
});

$routes->group('user', ['namespace' => 'App\Controllers\User'], function($routes) {
    $routes->get('profile', 'Profile::index');
    $routes->get('profile/edit', 'Profile::edit');
    $routes->post('profile', 'Profile::submit');
    $routes->get('beranda', 'JobsLanding::index');
    $routes->post('save/(:num)', 'JobsLanding::save/$1');
});



service('auth')->routes($routes);
