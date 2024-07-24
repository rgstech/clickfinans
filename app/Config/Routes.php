<?php

namespace Config;

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

//$routes->set404Override('App\Controllers\Home::msg'); // exemplo/example
//$routes->setAutoRoute(false);
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

$routes->get('/teste', 'Home::teste', ["as" => "teste"]);

 // ****************** Expenses Routes *******************************
$routes->get('/expense', 'Expense::index');

$routes->get('/expense/all', 'Expense::show'); // colocar parametros get
//$routes->get('/expense/all/(:any)', 'Expense::show/$1'); // colocar parametros get


//$routes->post('/expense/all', 'Expense::show');

$routes->get('/expense/delete/(:num)', 'Expense::delete/$1');

$routes->get('/expense/new', 'Expense::new');  // carrega view salvar 

$routes->get('/expense/edit/(:num)', 'Expense::edit/$1'); // carrega view editar mandando id da despesa

$routes->post('/expense/save', 'Expense::save'); //url da ação salvar (save )

$routes->post('/expense/save/(:num)', 'Expense::save/$1'); //url da ação salvar atualizando(update) 


 // ****************** Categories Routes *******************************

 //$routes->get('/category', 'Category::index');

 $routes->get('/category/all', 'Category::show');
 
 $routes->get('/category/delete/(:num)', 'Category::delete/$1');
 
 $routes->get('/category/new', 'Category::new');  // carrega view salvar 
 
 $routes->get('/category/edit/(:num)', 'Category::edit/$1'); // carrega view editar mandando id da categoria
 
 $routes->post('/category/save', 'Category::save'); //url da ação salvar (save )
 
 $routes->post('/category/save/(:num)', 'Category::save/$1'); //url da ação salvar atualizando(update) 


// ****************** Account Routes *******************************


$routes->get('account/signup', 'Account::signup');

$routes->post('account/createaccount','Account::createAccount');

$routes->post('account/delete','Account::delete');

// *****************************************************************

// ****************** Profile Routes *******************************

$routes->get('profile/show', 'Profile::show');

$routes->get('profile/edit', 'Profile::edit');

$routes->get('profile/remove', 'Profile::remove');

$routes->get('profile/chpassword', 'Profile::chpassword');


$routes->post('profile/delete', 'Profile::delete');

$routes->post('profile/update', 'Profile::update');

$routes->post('profile/updatepassword', 'Profile::updatepassword');

// *****************************************************************

$routes->post('/login/signIn', 'Login::signIn');

$routes->get('login/signOut','Login::signOut');

$routes->get('/login', 'Login::index');

$routes->get('/teste/adduser','Home::addUser');

// $routes->get('/expense', 'Expense::index');
// $routes->get('/tmsg', 'Home::msg');


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
