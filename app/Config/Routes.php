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
$routes->get('/pages/home', 'Pages::home');

// Rute ke Login
$routes->get('/', 'Pages::login', ['filter' => 'noauth']);
$routes->get('/konsul/generate/(:num)', 'Konsul::generate/$1');
// $routes->get('/klien/laporan/(:num)', 'Klien::generate/$1');
$routes->get('/klien/laporan/(:num)', 'Klien::laporan/$1');


// Rute ke Beranda admin dan pegawai
$routes->match(['get', 'post'], '/pages', 'Pages::index', ['filter' => 'authadminpegawai']);
$routes->match(['get', 'post'], '/pages/index', 'Pages::index', ['filter' => 'authadminpegawai']);

// Rute ke Beranda klien
$routes->match(['get', 'post'], '/pages/beranda', 'Pages::klienberanda', ['filter' => 'authcheck']);
$routes->match(['get', 'post'], '/pages/klienberanda', 'Pages::klienberanda', ['filter' => 'authcheck']);
$routes->match(['get', 'post'], '/pages/bantuan', 'Pages::bantuan', ['filter' => 'authcheck']);
$routes->match(['get', 'post'], '/riwayatkonsul', 'Jadwal::riwayatkonsul', ['filter' => 'authcheck']);
$routes->match(['get', 'post'], '/jadwal/create', 'Jadwal::create');
// $routes->get('/', 'pengguna::index');

$routes->match(['get', 'post'], '/tujuan-konsul', 'Tujuan::index', ['filter' => 'authadmin']);
$routes->match(['get', 'post'], '/tujuan-konsul/create', 'Tujuan::create', ['filter' => 'authadmin']);

// Rute untuk bagian klien
$routes->match(['get', 'post'], '/klien', 'Klien::index', ['filter' => 'authadminpegawai']);
$routes->match(['get', 'post'], '/klien/create', 'Klien::create', ['filter' => 'authcheck']);
$routes->delete('/klien/(:num)', 'Klien::delete/$1', ['filter' => 'authcheck']);
$routes->add('/klien/edit/(:segment)', 'Klien::edit/$1', ['filter' => 'authcheck']);
$routes->match(['get', 'post'], '/klien/(:num)', 'Klien::detail/$1', ['filter' => 'authadminpegawai']);

// Rute untuk bagian konsul
$routes->add('/konsul/create/(:num)', 'Konsul::create/$1', ['filter' => 'authadminpegawai']);
$routes->delete('/konsul/(:num)', 'Konsul::delete/$1', ['filter' => 'authcheck']);
$routes->add('/konsul/edit/(:segment)', 'Konsul::edit/$1', ['filter' => 'authcheck']);
$routes->match(['get', 'post'], '/konsul/(:num)', 'Konsul::detail/$1', ['filter' => 'authcheck']);

// Rute untuk bagian user
$routes->match(['get', 'post'], '/users', 'Users::index', ['filter' => 'authadmin']);
$routes->add('/users/create', 'Users::create', ['filter' => 'authadmin']);
$routes->match(['get', 'post'], '/users/save', 'Users::save', ['filter' => 'authadmin']);
$routes->add('/users/editprofil/(:segment)', 'Users::editprofil/$1', ['filter' => 'authcheck']);
$routes->add('/users/edit/(:segment)', 'Users::edit/$1', ['filter' => 'authadmin']);

// Rute untuk jadwal
$routes->match(['get', 'post'], '/jadwal', 'Jadwal::index', ['filter' => 'authcheck']);
$routes->add('/jadwal/create', 'Jadwal::create', ['filter' => 'authcheck']);
$routes->delete('/klien/(:num)', 'Klien::delete/$1', ['filter' => 'authcheck']);
$routes->match(['get', 'post'], '/jadwal/save', 'Jadwal::save', ['filter' => 'authcheck']);
$routes->add('/jadwal/update/', 'Jadwal::update', ['filter' => 'authcheck']);


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
