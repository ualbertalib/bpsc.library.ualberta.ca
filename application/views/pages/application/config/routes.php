<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['admin'] = 'admin/index';
$route['exhibits/edit/(:any)'] = 'exhibits/edit/$1';
$route['exhibits/create'] = 'exhibits/create';
$route['exhibits/delete/(:any)'] = 'exhibits/delete/$1';
$route['exhibits/(:any)'] = 'exhibits/view/$1';
$route['exhibits'] = 'exhibits/index';
$route['collections/edit/(:any)'] = 'collections/edit/$1';
$route['collections/create'] = 'collections/create';
$route['upload'] = 'uploader';
$route['collections/delete/(:any)'] = 'collections/delete/$1';
$route['collections/(:any)'] = 'collections/view/$1';
$route['collections'] = 'collections/index';
$route['default_controller'] = 'pages/view';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */