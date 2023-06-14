<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|       Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['system-content'] = 'system-content/Login';

/*
** Routing Modify For Frontend
*/

// Privacy Policy
$route['privacy-policy']                            = 'Privacy/index';

/*
** Routing URL About US
*/
$route['about-us']                                  = 'About_us/index';
$route['about-us/(:any)']                           = 'About_us/details/$1';
$route['about-us/(:any)/(:any)']                    = 'About_us/page_sub_detail/$1/$1';
$route['about-us/(:any)/(:any)/(:any)']             = 'About_us/page_subchild_detail/$1/$1/$1';
$route['contact-us']                                = 'Contact/index';

$route['governing-board']                           = 'Governing_board/index';
$route['advisors-to-the-president']                 = 'Advisors_to_the_president/index';
$route['organisational-structure']                  = 'Organisational_structure/index';
$route['key-staff']                                 = 'Staff/index';
$route['partners-and-networks']                     = 'Partners_and_networks/index';
$route['eria-research-institutes-network']          = 'Rin/index';
$route['eria-energy-research-institutes-network']   = 'Rin/energy';
$route['message-from-secretary-general-of-asean']   = 'Message/details/message-from-secretary-general-of-asean';
$route['presidents-office']                         = 'Message/president';

// $route['about-us/message-from-secretary-general-of-asean']   = 'Message/details/message-from-secretary-general-of-asean';
// $route['about-us/message-from-the-chairman-of-the-governing-board']     = 'About_us/Message_from_the_chairman_of_the_governing_board';
// $route['about-us/messages-from-the-board']                              = 'About_us/Messages_from_the_board';
// $route['about-us/key-staff']                                            = 'Staff/index';
// $route['about-us/academic-advisory-council']                            = 'About_us/Academic_advisory_council';
// $route['about-us/logo-use-standards']                                   = 'About_us/Logo_use_standards';
// $route['about-us/organisations-we-work-with']                = 'About_us/Organisations_we_work_with';
// $route['about-us/history']                                   = 'History/index';
// $route['about-us/governing-board']                           = 'Governing_board/index';
// $route['about-us/advisors-to-the-president']                 = 'Advisors_to_the_president/index';
// $route['about-us/organisational-structure']                  = 'Organisational_structure/index';
// $route['about-us/key-staff']                                 = 'Staff/index';
// $route['about-us/partners-and-networks']                     = 'Partners_and_networks/index';
// $route['about-us/eria-research-institutes-network']          = 'Rin/index';
// $route['about-us/eria-energy-research-institutes-network']   = 'Rin/energy';

// $route['about-us/presidents-office']                         = 'Message/president';
// $route['about-us/career-opportunities']                      = 'Career/index';
// $route['about-us/contact-us']                                = 'Contact/index';

/*
** News and views
*/
$route['news-and-views']                            = 'Update/type/all';
$route['news-and-views/category/(:any)']            = 'Update/type/$1';
$route['news-and-views/(:any)']                     = 'News/details/$1';
$route['news/press-room']                           = 'News/index';
$route['news-and-views/category/all/(:any)']        = 'Update/Brows/all/$1';
// $route['news-and-views/(:any)']                     = 'NewsMultimedia/detail/$1';

/*
** ENDS
*/

$route['programmes/topic/(:any)']                   = 'Programmes/category/$1';
$route['database-and-programmes/topic/(:any)']      = 'Programmes/category/$1';
$route['database-and-programmes']                   = 'Programmes/index';
$route['database-and-programmes/(:any)']            = 'Programmes/Programmes_article_detail/$1';

$route['publications/(:any)']                       = 'Publications/Detail/$1';
$route['publications/category/(:any)']              = 'Publications/type/$1';

$route['events/(:any)']                             = 'Events/details/$1';

$route['news/(:any)']                               = 'news/details/$1';

$route['experts/(:any)']                            = 'Experts/detail/$1';

$route['multimedia/(:any)/(:any)']                  = 'Multimedia/detail_multimedia';
$route['multimedia/(:any)']                         = 'Multimedia/views_category';
// $route['multimedia/(:any)']                         = 'NewsMultimedia/detail/$1';

$route['research/topic/(:any)']                     = 'Research/category/$1';
$route['research/topic/asean/(:any)']               = 'Asean/country/$1';
$route['research/(:any)']                           = 'Research/Detail/$1'; // 'Publications/Detail/$1'; // 'News/details/$1'

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;