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
$routes->get('/', 'Pages::login');
$routes->get('/pages', 'Pages::index');
$routes->post('/pages/beranda', 'Pages::klienberanda');
$routes->post('/pages/regis', 'Pages::regis');
$routes->post('/riwayatkonsul', 'Jadwal::riwayatkonsul');
$routes->post('/jadwal/create', 'Jadwal::create');
// $routes->get('/', 'pengguna::index');

// Rute untuk bagian klien
$routes->post('/klien', 'Klien::index');
$routes->post('/klien/create', 'Klien::create');
$routes->delete('/klien/(:num)', 'Klien::delete/$1');
$routes->add('/klien/edit/(:segment)', 'Klien::edit/$1');
$routes->get('/klien/(:num)', 'Klien::detail/$1');

// Rute untuk bagian konsul
$routes->add('/konsul/create/(:num)', 'Konsul::create/$1');
$routes->delete('/konsul/(:num)', 'Konsul::delete/$1');
$routes->add('/konsul/edit/(:segment)', 'Konsul::edit/$1');
$routes->get('/konsul/(:num)', 'Konsul::detail/$1');

// Rute untuk bagian user
$routes->post('/users', 'Users::index');
$routes->add('/users/create', 'Users::create');
$routes->post('/users/save', 'Users::save');
$routes->add('/users/editprofil/(:segment)', 'Users::editprofil/$1');
$routes->add('/users/edit/(:segment)', 'Users::edit/$1');

// Rute untuk jadwal
$routes->post('/jadwal', 'Jadwal::index');
$routes->add('/jadwal/create', 'Jadwal::create');
$routes->post('/jadwal/save', 'Jadwal::save');
$routes->add('/jadwal/edit/(:segment)', 'Jadwal::edit/$1');


// CALENDAR
// $routes->get("fullcalendar", "FullcalendarController::index");
// $routes->get("event", "FullcalendarController::loadData");
// $routes->post("eventAjax", "FullcalendarController::ajax");



// $routes->match(['get', 'post'], 'login', 'Users::login', ["filter" => "noauth"]);
// // Routes Admin
// $routes->group("admin", ["filter" => "auth"], function ($routes) {
//     $routes->get('/', 'Pages::index');
// });
// //  Routes Pegawai
// $routes->group("pegawai", ["filter" => "auth"], function ($routes) {
//     $routes->get('/', 'Pages::index');
// });
// $routes->get('logout', 'Users::logout');
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
