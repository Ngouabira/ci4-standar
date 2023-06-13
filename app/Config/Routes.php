<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('/logout', 'Auth\AuthController::logout', ['filter' => 'auth']);
$routes->post('/translate', 'LanguageController::index', ['filter' => 'auth']);

$routes->group('/', ['namespace' => 'App\Controllers\Auth', 'filter' => 'unauth'], function ($routes) {

    $routes->get('login', 'AuthController::login');
    $routes->get('register', 'AuthController::register');
    $routes->get('forgotpassword', 'AuthController::forgotPassword');
    $routes->get('resetpassword', 'AuthController::resetPassword');

    $routes->post('login', 'AuthController::attemptLogin');
    $routes->post('register', 'AuthController::attemptRegister');
    $routes->post('forgotpassword', 'AuthController::attemptForgotPassword');
    $routes->post('resetpassword', 'AuthController::attemptResetPassword');

});

$routes->group('admin', ['namespace' => 'App\Controllers\Admin', 'filter' => 'auth'], function ($routes) {

    $routes->get('role', 'RoleController::index');
    $routes->get('role/create', 'RoleController::create');
    $routes->post('role', 'RoleController::store');
    $routes->get('role/(:num)', 'RoleController::show/$1');
    $routes->get('role/(:num)/edit', 'RoleController::edit/$1');
    $routes->put('role/(:num)', 'RoleController::update/$1');
    $routes->delete('role/(:num)', 'RoleController::delete/$1');

    $routes->get('permission', 'PermissionController::index');
    $routes->get('permission/create', 'PermissionController::create');
    $routes->post('permission', 'PermissionController::store');
    $routes->get('permission/(:num)', 'PermissionController::show/$1');
    $routes->get('permission/(:num)/edit', 'PermissionController::edit/$1');
    $routes->put('permission/(:num)', 'PermissionController::update/$1');
    $routes->delete('permission/(:num)', 'PermissionController::delete/$1');

    $routes->get('user', 'UserController::index');
    $routes->get('user/create', 'UserController::create');
    $routes->post('user', 'UserController::store');
    $routes->get('user/(:num)', 'UserController::show/$1');
    $routes->get('user/(:num)/edit', 'UserController::edit/$1');
    $routes->put('user/(:num)', 'UserController::update/$1');
    $routes->delete('user/(:num)', 'UserController::delete/$1');

});

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('select-role', 'Admin\RoleController::select');
    $routes->get('select-permission', 'Admin\PermissionController::select');
    $routes->get('select-user', 'Admin\UserController::select');

});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
