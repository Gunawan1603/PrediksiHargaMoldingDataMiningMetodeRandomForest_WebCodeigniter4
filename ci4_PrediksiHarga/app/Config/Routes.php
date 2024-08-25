<?php

namespace Config;
use Config\Services;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/dashboard', 'Dashboard::index',['filter' => 'auth']);


// Rute untuk admin
$routes->group('admin', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    // Tambahkan rute lainnya untuk admin di sini

    //----Data Set Prediksi Mold--------------
    $routes->get('/dataset', 'Dataset::index');
    $routes->add('/dataset/add', 'Datasetmold::adddataset');
    $routes->post('/dataset/save', 'Datasetmold::save');
    $routes->get('/dataset/edit/(:num)', 'Datasetmold::edit/$1');
    $routes->add('/dataset/update/(:num)', 'Datasetmold::update/$1');
    $routes->get('/dataset/delete/(:num)', 'Dataset::delete/$1');
     
    //----Insert .csv Data Set Prediksi Mold--------------
    $routes->post('dataset/insert_csv', 'Dataset::insert_csv');
    $routes->post('dataset/insert_csv', 'Dataset::insert_csv');

    //----Insert .csv masukkan ke dalam List tabel dataset--------------
    $routes->get('listCsvFiles', 'Dataset::listCsvFiles');
    // Rute untuk menghapus file CSV
    $routes->get('/deleteCsvFile/(:num)', 'Dataset::deleteCsvFile/$1');
    // Di app/Config/Routes.php
    $routes->post('/dataset/upload_csv', 'Dataset::upload_csv');
    $routes->get('dataset/download/(:num)', 'Dataset::download/$1');




    //----Split Data Set Prediksi Mold--------------
    $routes->get('/splitdataset', 'Splitdataset::index');
    $routes->get('splitdataset', 'Dataset::splitDataset');
    $routes->get('splitdataset/(:num)', 'Splitdataset::splitDataset/$1');
    $routes->get('splitdataset/split/(:num)', 'Splitdataset::splitDataset/$1');
    $routes->get('/splitdataset', 'Splitdataset::index');
    $routes->get('/splitdataset/split/(:num)', 'Splitdataset::split/$1');
    $routes->get('/splitdataset/splitpersen', 'Splitdataset::splitPersen'); // Perubahan disini
    $routes->get('/splitdataset/reset', 'Splitdataset::reset');

    $routes->get('reset_status', 'ResetStatus::index');

    $routes->get('splitdataset/resetStatus', 'Splitdataset::resetStatus');
    $routes->post('splitdataset/resetStatus', 'Splitdataset::resetStatus');
    $routes->post('splitdataset/splitPersen', 'Splitdataset::splitPersen');
    $routes->post('splitdataset/performance', 'Splitdataset::performance');
    $routes->post('splitdataset/deleteAllData', 'Splitdataset::deleteAllData');

    // Tambahkan rute untuk halaman hasil
    $routes->get('results_view', 'Splitdataset::resultsView');

    //----Prediksi Mold--------------
    $routes->get('prediksiharga', 'Prediksi::index'); // Menampilkan formulir prediksi
    $routes->post('prediksiharga/proses_prediksi', 'Prediksi::proses_prediksi'); // Memproses prediksi

    $routes->get('/', 'PrediksiPrice::index');
    $routes->post('PrediksiPrice/proses_prediksiharga', 'PrediksiPrice::proses_prediksiharga');
    $routes->get('/prediksi-result', 'PrediksiPrice::proses_prediksiharga');
    //$routes->post('PrediksiPrice/plotConfusionMatrix', 'PrediksiPrice::plotConfusionMatrix');
    $routes->post('prediksi-price/plotConfusionMatrix', 'PrediksiPrice::plotConfusionMatrix');
    $routes->post('prediksi-price/plotConfusionMatrix', 'PrediksiPrice::plotConfusionMatrix');

    $routes->get('/PrediksiPrice/exportToExcel', 'PrediksiPrice::exportToExcel');
    $routes->get('PrediksiPrice/downloadExcel/(:any)', 'PrediksiPrice::downloadExcel/$1');


});

// Rute untuk user
$routes->group('user', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('dashboard', 'User\Dashboard::index');
    // Tambahkan rute lainnya untuk user di sini

    //----User Data Set Prediksi Mold--------------
    $routes->get('datasetuser', 'DatasetUser::index'); 
    $routes->add('datasetuser/add', 'DatasetUser::adddatasetuser');
    $routes->post('datasetuser/save', 'DatasetUser::save');
    $routes->get('datasetuser/edit/(:num)', 'DatasetUser::edit/$1');
    $routes->add('datasetuser/update/(:num)', 'DatasetUser::update/$1');
    $routes->get('datasetuser/delete/(:num)', 'DatasetUser::delete/$1');

    //----User Split Data Set Prediksi Mold--------------
    $routes->get('splitdatasetuser', 'SplitdatasetUser::index');
    $routes->get('splitdatasetuser', 'Dataset::splitDataset');
    $routes->get('splitdatasetuser/(:num)', 'SplitdatasetUser::splitDataset/$1');
    $routes->get('splitdatasetuser/split/(:num)', 'SplitdatasetUser::splitDataset/$1');
    $routes->get('/splitdatasetuser', 'SplitdatasetUser::index');
    $routes->get('/splitdatasetuser/split/(:num)', 'SplitdatasetUser::split/$1');
    $routes->get('/splitdatasetuser/splitpersen', 'SplitdatasetUser::splitPersen'); // Perubahan disini
    $routes->get('/splitdatasetuser/reset', 'SplitdatasetUser::reset');

    $routes->get('reset_status', 'ResetStatus::index');

    $routes->get('splitdatasetuser/resetStatus', 'SplitdatasetUser::resetStatus');
    $routes->post('splitdatasetuser/resetStatus', 'SplitdatasetUser::resetStatus');
    $routes->post('splitdatasetuser/splitPersen', 'SplitdatasetUser::splitPersen');
    $routes->post('splitdatasetuser/performance', 'SplitdatasetUser::performance');
    $routes->post('splitdatasetuser/deleteAllData', 'SplitdatasetUser::deleteAllData');

    //----User Prediksi Mold--------------
    $routes->get('prediksiharga', 'Prediksi::index'); // Menampilkan formulir prediksi
    $routes->post('prediksiharga/proses_prediksi', 'Prediksi::proses_prediksi'); // Memproses prediksi

    $routes->get('PrediksiPriceUser', 'PrediksiPriceUser::index');
    $routes->post('PrediksiPrice/proses_prediksiharga', 'PrediksiPriceUser::proses_prediksiharga');
    $routes->get('/prediksi-resultuser', 'PrediksiPriceUser::proses_prediksiharga');
    //$routes->post('PrediksiPrice/plotConfusionMatrix', 'PrediksiPrice::plotConfusionMatrix');
    $routes->post('prediksi-priceuser/plotConfusionMatrix', 'PrediksiPriceUser::plotConfusionMatrix');
    $routes->post('prediksi-priceuser/plotConfusionMatrix', 'PrediksiPriceUser::plotConfusionMatrix');

    $routes->get('/PrediksiPriceUser/exportToExcel', 'PrediksiPriceUser::exportToExcel');
    $routes->get('PrediksiPriceUser/downloadExcel/(:any)', 'PrediksiPriceUser::downloadExcel/$1');
     
});

//Login to register data Admin/user
$routes->setDefaultController('Register');
//$routes->get('/', 'Register::index', ['filter' => 'guestFilter']);
$routes->get('/register', 'Register::index', ['filter' => 'guestFilter']);
$routes->post('/register', 'Register::register', ['filter' => 'guestFilter']);


$routes->get('/login', 'Login::index', ['filter' => 'guestFilter']);
$routes->post('/login', 'Login::authenticate', ['filter' => 'guestFilter']);

//Login to register data Admin
$routes->get('admin/login-admin', 'Login::index', ['filter' => 'guestFilter']);
$routes->post('admin/login', 'Login::authenticate', ['filter' => 'guestFilter']);
$routes->get('admin/loginadmin', 'Login::loginadmin', ['filter' => 'adminFilter']);

$routes->get('/logout', 'Login::logout', ['filter' => 'authFilter']);
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'authFilter']);

//Logout to register data user
$routes->get('/logoutregister', 'Login::logout', ['filter' => 'authFilter']);

//$routes->get('/', 'Page::dashboard');
//$routes->get('/', 'Home::index');

//------------------------------------------
$routes->get('/users', 'Users::index');
$routes->add('/users/add', 'Users::addusers');
$routes->post('/users/save', 'Users::save');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->add('/users/update/(:num)', 'Users::update/$1');
$routes->get('/users/delete/(:num)', 'Users::delete/$1');


//$routes->get('/dashboard', 'Page::dashboard');
//$routes->get('/login', 'Page::login');
//$routes->get('/register', 'Page::register');


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