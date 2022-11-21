<?php

namespace Config;

use Faker\Provider\Base;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/activate/(:segment)', 'AuthController::activate/$1');
$routes->get('/recover-password/(:segment)', 'AuthController::recover_view/$1');
$routes->get('/', 'Home::index');
$routes->get('/login', function () {
	if(session()->has('username'))
        {
        	return redirect()->to(base_url('/'));
        } else {
	return view('auth/login');}
});
$routes->get('/register', function () {
	return view('auth/register');
});
$routes->get('/forgot-password', function () {
	return view('auth/forgot-password');
});

// ================ inventory ==============
// $routes->get('/ci', 'Home::index');
// dashboard
// $routes->get('/inventor', 'Base\Home::home');

// stok barang
$routes->add('/add', 'Base\StokBarang::add_stok');
$routes->add('/edit/stok/(:num)', 'Base\StokBarang::update_stok_brg/$1');
$routes->add('/stok/barang', 'Base\StokBarang::stok');
$routes->add('/delete/stock/(:num)', 'Base\StokBarang::delete/$1');

// barang masuk
$routes->add('/barang/masuk', 'Base\Barangmasuk::barang_masuk');
$routes->add('/edit/barang/(:num)', 'Base\Barangmasuk::edit_brg_to_stok/$1');
$routes->post('/delete', 'Base\Barangmasuk::delete_brg');
$routes->post('/add/barang/baru', 'Base\Barangmasuk::add_barang_baru');

// pengiriman
$routes->add('/kirim/barang', 'Base\Pengirimanbarang::kirim');
$routes->add('/pengiriman', 'Base\Pengirimanbarang::pengiriman');
$routes->add('/status/pengiriman/(:num)', 'Base\Pengirimanbarang::status_pengiriman/$1');
$routes->add('/batal/(:num)/(:any)/(:num)', 'Base\Pengirimanbarang::batal/$1/$2/$3');
$routes->add('/status/kirim/(:num)', 'Base\Pengirimanbarang::stts_kirim/$1');

// laporan selesai
$routes->add('/selesai', 'Base\Home::selesai');

// barang keluar
$routes->add('/barang/keluar', 'Base\Home::barang_keluar');

// penerimaan
$routes->add('/penerimaan', 'Base\Penerimaanbarang::penerimaan');
$routes->add('/tambah/penerimaan', 'Base\Penerimaanbarang::tambah_penerimaan');
$routes->add('/accept/penerimaan/(:num)', 'Base\Penerimaanbarang::accept_penerimaan/$1');
$routes->add('/cancel/penerimaan/(:num)', 'Base\Penerimaanbarang::cancel_penerimaan/$1');

// login
$routes->add('/login', 'Base\Home::login');
$routes->add('/login/user', 'Base\Home::do_login');
$routes->add('/logout', 'Base\Home::logout');


// lokasi
$routes->add('/add/lokasi', 'Base\Lokasidistribusi::add_location');
$routes->add('/lokasi', 'Base\Lokasidistribusi::lokasi');
$routes->post('/edit/lokasi/(:num)', 'Base\Lokasidistribusi::edit_lokasi/$1');
$routes->post('/delete/lokasi/(:num)', 'Base\Lokasidistribusi::delete_lokasi/$1');

// user
$routes->add('/add/user', 'Base\Pengguna::add_user');
$routes->add('/user', 'Base\Pengguna::user');
$routes->post('/delete/user/(:num)', 'Base\Pengguna::delete_user/$1');
$routes->post('/edit/user/(:num)', 'Base\Pengguna::edit_user/$1');

// contact
$routes->add('/contact', 'Base\Home::contact');
$routes->post('/get/stok', 'Base\Home::get_stok');

// profil
$routes->add('/profil', 'Base\Home::profil');
$routes->add('/edit/name/(:num)', 'Base\Home::edit_name/$1');
$routes->add('/edit/password/(:num)', 'Base\Home::edit_pass/$1');
/**
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
