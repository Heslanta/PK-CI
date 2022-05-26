<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// Rute ke Beranda
$routes->get('/', 'Pages::index');
// $routes->get('/', 'pengguna::index');
// Rute untuk bagian klien
$routes->get('/klien/create', 'Klien::create');
$routes->delete('/klien/(:num)', 'Klien::delete/$1');
$routes->get('/klien/edit/(:segment)', 'Klien::edit/$1');
$routes->get('/klien/(:num)', 'Klien::detail/$1');
// Rute untuk bagian konsul
$routes->get('/konsul/(:num)', 'Konsul::detail/$1');
$routes->get('/konsul/create', 'Konsul::create');
$routes->delete('/konsul/(:num)', 'Konsul::delete/$1');
// Rute untuk bagian user
$routes->get('/users', 'Users::index');
$routes->get('/users/create', 'Users::create');
$routes->get('/users/save', 'Users::save');


$routes->match(['get', 'post'], 'login', 'UserController::login', ["filter" => "noauth"]);
// Routes Admin
$routes->group("admin", ["filter" => "auth"], function ($routes) {
    $routes->get('/', 'Pages::index');
});
//  Routes Pegawai
$routes->group("pegawai", ["filter" => "auth"], function ($routes) {
    $routes->get('/', 'Pages::index');
});
$routes->get('logout', 'UserController::logout');
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
