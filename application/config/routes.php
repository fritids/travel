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

$route['default_controller'] = "welcome";
$route['404_override'] = '';



$route['about-us'] = "pages/about_us";
$route['jobs'] = "pages/jobs";
$route['support'] = "pages/support";
$route['contact'] = "pages/contact";
$route['how-it-works'] = "pages/how_it_works";
$route['terms-and-conditions'] = "pages/conditions";
$route['privacy-policy'] = "pages/privacy";
$route['how-it-works'] = "pages/how_it_works";
$route['how-it-works-tourist'] = "pages/how_it_works_tourist";
$route['how-it-works-tourist'] = "pages/how_it_works_tourist";
$route['how-it-works-hotel-owner'] = "pages/how_it_works_hotel_owner";
$route['how-it-works-tourist-office'] = "pages/how_it_works_tourist_office";
$route['get-started'] = "pages/get_started";


$route['login/twitter'] = "users/twitterlogin";
$route['login/facebook'] = "users/facebooklogin";

$route['offers/page/1'] = "offers/page";
$route['offers'] = "lastminute";

$route['users/signup/tourist'] = "users/signup/2";
$route['users/signup/hotel-owner/(:any)'] = "users/signup/1/$1";
$route['users/signup/hotel-owner'] = "users/signup/1";
$route['users/signup/tourist-office'] = "users/signup/3";
$route['users/signup/(:any)'] = "users/signup/2";


$route['messages/(:num)'] = "messages/index/$1";

//$route['account'] = "account/account/index";
$route['profile/edit/descrizione'] = "profile/descrizione";
$route['profile/edit/servizi'] = "profile/servizi";
$route['profile/edit/distanze'] = "profile/distanze";
$route['profile/edit/immagini'] = "profile/immagini";


$route['search/offers/(:any)/(:any)/checkin/(:any)/checkout/(:any)'] = "search/direct_search";
$route['search/load_direct_search_map/(:any)/(:any)/checkin/(:any)/checkout/(:any)'] = "search/load_direct_search_map";
$route['offers/page/(:num)'] = "lastminute/index/$1";
$route['offers/page'] = "lastminute/index";
$route['offers/edit/(:num)'] = "offers/edit/$1";
$route['offers/create'] = "offers/create";
$route['offers/cancel'] = "offers/cancel";
$route['offers/delete'] = "offers/delete";
$route['offers/like_offer'] = "offers/like_offer";
$route['offers/bookong_request'] = "offers/bookong_request";
$route['offers/(:num)'] = "offers/view/$1";
$route['offers/(:any)'] = "lastminute/search/$1";
$route['offers/(:any)/(:num)'] = "lastminute/search/$1";
$route['offers/(:any)/(:any)'] = "lastminute/search/$1/$2";
$route['offers/(:any)/(:any)/(:num)'] = "lastminute/search/$1/$2";
$route['offers/(:any)/(:any)/(:any)'] = "lastminute/search/$1/$2/$3";




$route['search/hotels/(:any)/(:any)'] = "hotels/direct_search";
$route['hotels/send_request_information'] = "hotels/send_request_information";
$route['hotels/page/(:num)'] = "hotels/index/$1";
$route['hotels/page'] = "hotels/index";
$route['hotels/search_hotel'] = "hotels/search_hotel";
$route['hotels/(:num)'] = "hotels/view/$1";
$route['hotels/(:any)'] = "hotels/search/$1";
$route['hotels/(:any)/(:num)'] = "hotels/search/$1";
$route['hotels/(:any)/(:any)'] = "hotels/search/$1/$2";
$route['hotels/(:any)/(:any)/(:num)'] = "hotels/search/$1/$2";
$route['hotels/(:any)/(:any)/(:any)'] = "hotels/search/$1/$2/$3";
$route['search/(:any)/(:any)/(:any)'] = "search/index/$1/$2/$3";


$route['dashboard/offers'] = "dashboard/lastminute";

$route['comments/delete_comment'] = "comments/delete_comment";
$route['comments/create'] = "comments/create";
$route['comments/(:any)'] = "comments/index/$1";



/* End of file routes.php */
/* Location: ./application/config/routes.php */