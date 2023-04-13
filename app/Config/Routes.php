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

$routes->get('/', 'Pages::view');

$routes->get('exhibits/past', 'Exhibits::past');
$routes->get('exhibits', 'Exhibits::index');
$routes->get('exhibits/(:any)', 'Exhibits::view/$1');
$routes->get('collections', 'Collections::index');
$routes->post('search', 'Collections::search');
$routes->get('info/(:any)', 'Pages::view/$1');


/* ADMIN */


/** 
*  This codeigniter application uses 'Shield' for authentication and authorization.
* To login go to https://bpsc.library.ualberta.ca/index.php/login
* To reset your password you need to be logged in and go to  https://bpsc.library.ualberta.ca/admin/user/deleteuser
* To delete/create a user   https://bpsc.library.ualberta.ca/admin/user/createuser  or deleteuser. make sure to hard code the proper variables in the UserController.php file.
* To create the first user in the database you can turn on $allowRegistration in Config/Auth.php. Then go to the login page and there will be a link to register.
* Next go into the database and set the user to be a "superadmin" in the auth_groups_users table.
*/

// Note that multipleFilters variable was needed to be turned on at app/Config/Feature.php
$routes->group('admin', ['filter' => 'group:admin,superadmin'], static function ($routes) {
	
		$routes->get('/', 'Admin::index');
		$routes->get('exhibits/create', 'Exhibits::create');
		$routes->post('exhibits/create', 'Exhibits::store');
		$routes->get('exhibits/edit/(:any)', 'Exhibits::edit/$1');
		$routes->post('exhibits/edit/(:any)', 'Exhibits::update/$1');
		
		
		$routes->get('exhibits/delete/(:any)', 'Exhibits::deleteExhibit/$1');
		$routes->get('exhibits/deleteimage/(:any)', 'Exhibits::deleteimage/$1');
		$routes->get('exhibits/deleteslideimage/(:any)', 'Exhibits::deleteslideimage/$1/$2');
		
		$routes->get('collections/create', 'Collections::create');
		$routes->post('collections/create', 'Collections::store');
		$routes->get('collections/edit/(:any)', 'Collections::edit/$1');		
		$routes->post('collections/edit/(:any)', 'Collections::update/$1');	 
		$routes->get('collections/delete/(:any)', 'Collections::deleteCollection/$1'); 
		$routes->get('collections/deleteimage/(:any)', 'Collections::deleteImage/$1/');
		$routes->get('collections/deleteslideimage/(:any)', 'Collections::deleteSlideImage/$1/$2');
		
		$routes->get('user/resetpassword', 'UserController::index');
		$routes->post('user/resetpassword', 'UserController::resetpassword');
		
		/**
		*  There is no user interface for the routes below. Just hard code in the controller and run the route
		*  Note that online registration can be enabled in the Config/Auth.php file by changing: $allowRegistration  variable
		*/
		$routes->get('user/createuser', 'UserController::createUser');
		$routes->get('user/deleteuser', 'UserController::deleteUser');
		$routes->get('users/deleteuser', 'UserController::deleteUser');

			

});

service('auth')->routes($routes);

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
