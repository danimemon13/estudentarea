<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = 'home/login';
$route['dashboard'] = 'home/dashboard';


$route['department'] = 'home/department';
$route['department/add'] = 'home/department_add';
$route['department/edit/(:any)'] = 'home/department_edit/$1';



$route['team'] = 'home/team';
$route['team/add'] = 'home/team_add';
$route['team/edit/(:any)'] = 'home/team_edit/$1';



$route['role'] = 'home/role';
$route['role/add'] = 'home/role_add';
$route['role/edit/(:any)'] = 'home/role_edit/$1';



$route['user'] = 'home/user';
$route['user/add'] = 'home/user_add';
$route['user/edit/(:any)'] = 'home/user_edit/$1';
$route['user/team/(:any)'] = 'home/user_team/$1';
$route['user/website/(:any)'] = 'home/user_website/$1';


$route['leads'] = 'home/leads';
$route['leads/add'] = 'home/leads_add';
$route['leads/edit/(:any)'] = 'home/leads_edit/$1';



$route['website'] = 'home/website';
$route['website/add'] = 'home/website_add';
$route['website/edit/(:any)'] = 'home/website_edit/$1';


$route['invoice'] = 'home/invoice';
$route['invoice/add'] = 'home/invoice_add';
$route['invoice/edit/(:any)'] = 'home/invoice_edit/$1';



$route['order'] = 'home/order';
$route['order/add'] = 'home/order_add';
$route['order/edit/(:any)'] = 'home/order_edit/$1';



$route['ip_address'] = 'home/ip_address';
$route['ip_address/add'] = 'home/ip_address_add';
$route['ip_address/edit/(:any)'] = 'home/ip_address_edit/$1';

$route['permissions'] = 'home/permissions';

$route['logout'] = 'home/logout';