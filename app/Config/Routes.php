<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('', ['filter' => 'noauth'], function ($routes) {
    $routes->get('/register', 'AuthController::register');
    $routes->post('/register', 'AuthController::processRegister');
    $routes->get('/login', 'AuthController::login');
    $routes->post('/login', 'AuthController::processLogin');
});

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->post('/logout', 'AuthController::logout');
});

// Route admin
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('users', 'Admin\AddUserController::index');
    $routes->post('users/store', 'Admin\AddUserController::store');
    $routes->get('users/edit/(:num)', 'Admin\AddUserController::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\AddUserController::update/$1');
    $routes->match(['get', 'post'], 'users/delete/(:num)', 'Admin\AddUserController::delete/$1');

    $routes->get('donations', 'Admin\DonationsController::index');
    $routes->post('donations/store', 'Admin\DonationsController::store');
    $routes->post('donations/update/(:num)', 'Admin\DonationsController::update/$1');
    $routes->match(['get', 'post'], 'donations/destroy/(:num)', 'Admin\DonationsController::destroy/$1');


    $routes->get('data_catalog', 'DataCatalogController::index');
    $routes->get('data_catalog/show/(:num)', 'DataCatalogController::show/$1');
    $routes->post('data_catalog/store', 'DataCatalogController::store');
    $routes->post('data_catalog/update/(:num)', 'DataCatalogController::update/$1');
    $routes->match(['get', 'post'], 'data_catalog/delete/(:num)', 'DataCatalogController::delete/$1');
}); // End of Admin Group

// Route user
$routes->group('user', ['filter' => 'user'], function ($routes) {
    $routes->get('dashboard', 'UserController::index');

    $routes->get('profile', 'UpdateProfileController::index');
    $routes->post('profile/update', 'UpdateProfileController::update');

    $routes->get('donations', 'DonationsController::index');
    $routes->post('donations/store', 'DonationsController::store');
    $routes->post('donations/update/(:num)', 'DonationsController::update/$1');
    $routes->match(['get', 'post'], 'donations/destroy/(:num)', 'DonationsController::destroy/$1');
    $routes->post('donations/import', 'DonationsController::importData');

    $routes->get('tracking-status', 'TrackingStatusController::index');
});
