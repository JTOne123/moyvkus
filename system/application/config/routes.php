<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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
| 	www.your-site.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:s
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['get_message/message/id/:num/delete'] = "get_message";
$route['get_message/message/id/:num'] = "get_message";
$route['mymessages/delete/id/:num'] = "mymessages";
$route['send_message/send_to/id/:num/answer/id/:num'] = "send_message";
$route['send_message/send_to/id/:num'] = "send_message";
$route['register/invite/id/:num'] = "register";
$route['messagebox/:any'] = "messagebox";
$route['myfriends/id/:num'] = "myfriends";
$route['myfriends/confirm_friend_id/:num'] = "myfriends";
$route['myfriends/reject_friend_id/:num'] = "myfriends";
$route['profile/id/:num'] = "profile";

$route['my_recipes/id/:num'] = "my_recipes";
$route['my_recipes/view/:any'] = "my_recipes";

$route['edit_recipe/id/:num'] = "add_recipe";
$route['add_new_recipe'] = "add_recipe";
$route['view_recipe/id/:num'] = "view_recipe";

$route['favorites/id/:num'] = "favorites";
$route['favorites/add/id/:num'] = "favorites/add/";
$route['favorites/delete/id/:num'] = "favorites/delete/";
$route['favorites/view/:any'] = "favorites";

$route['default_controller'] = "main";
$route['register/wrong_captcha'] = "register";
$route['scaffolding_trigger'] = "";

?>