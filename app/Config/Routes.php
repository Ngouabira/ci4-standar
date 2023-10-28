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
$routes->get('/', 'Home::index', ['filter' => 'auth']);

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

    $routes->resource("user", [
        'filter' => 'auth',
        "controller" => "UserController",
    ]);

    $routes->resource("role", [
        'filter' => 'auth',
        "controller" => "RoleController",
    ]);

    $routes->resource("permission", [
        'filter' => 'auth',
        "controller" => "PermissionController",
    ]);

});

$routes->group('profile', ['filter' => 'auth'], function ($routes) {

    $routes->get('', 'Admin\UserController::profile');
    $routes->put('', 'Admin\UserController::updateProfile');
    $routes->put('photo', 'Admin\UserController::updatePhoto');

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
