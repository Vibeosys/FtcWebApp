<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Route\DashedRouted;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/V1/', function (RouteBuilder $routes) {
    $routes->connect('getSignal', ['controller' => 'V1/Signal', 'action' => 'getTradeSignal']);
    $routes->connect('registerUser', ['controller' => 'V1/User', 'action' => 'userregistration']);
    $routes->connect('userLogin', ['controller' => 'V1/User', 'action' => 'userLogin']);
    $routes->connect('userSubLogin', ['controller' => 'V1/User', 'action' => 'userSubLogin']);
    $routes->connect('usernameAvailability', ['controller' => 'V1/User', 'action' => 'usernameAvailability']);
    $routes->connect('forgotPassword', ['controller' => 'V1/User', 'action' => 'forgotPassword']);
    $routes->connect('forgotSubPassword', ['controller' => 'V1/User', 'action' => 'forgotSubPassword']);
    $routes->connect('resetPassword', ['controller' => 'V1/User', 'action' => 'resetPassword']);
    $routes->connect('getUserProfile', ['controller' => 'V1/User', 'action' => 'getUserProfile']);
    $routes->connect('updateUserProfile', ['controller' => 'V1/User', 'action' => 'updateUserProfile']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->fallbacks('DashedRoute');
});
// temp website route for local server
Router::scope('/tradenowwebapp/', function (RouteBuilder $routes) {
$routes->connect('user/changepassword', ['controller' => 'V1/User', 'action' => 'changePassword','change_password']);    
    
 $routes->fallbacks('DashedRoute');    
});

// website route for V1
Router::scope('/', function (RouteBuilder $routes) {
$routes->connect('user/changepassword', ['controller' => 'V1/User', 'action' => 'changePassword','change_password']);
    
 $routes->fallbacks('DashedRoute');    
});

// website route for V2
Router::scope('/', function (RouteBuilder $routes) {
    $version = 'V2/';
    $routes->connect('admin/login', ['controller' => $version.'User', 'action' => 'adminWebLogin']);    
    $routes->connect('user/management', ['controller' => $version.'User', 'action' => 'userManagement']);    
    $routes->connect('/', ['controller' => $version.'Home', 'action' => 'index']);    
    $routes->connect('gallery', ['controller' => $version.'Home', 'action' => 'gallery']);    
    $routes->connect('database', ['controller' => $version.'Home', 'action' => 'database']);    
    $routes->connect('database/edit', ['controller' => $version.'Home', 'action' => 'editDatabase']);    
    $routes->connect('emailnotification', ['controller' => $version.'Home', 'action' => 'emailNotification']);    
    $routes->connect('emailnotification/edit', ['controller' => $version.'Home', 'action' => 'editTemplate']);    
    $routes->connect('appnotification', ['controller' => $version.'Home', 'action' => 'appNotification']);    
    $routes->connect('emailnotification/add', ['controller' => $version.'Home', 'action' => 'addTemplate']);    
    $routes->connect('pages', ['controller' => $version.'Pages', 'action' => 'pageList']);    
    $routes->connect('pages/page', ['controller' => $version.'Pages', 'action' => 'page']);    
    $routes->connect('user/createsubscription', ['controller' => $version.'Subscription', 'action' => 'createSubscription']);    
    $routes->connect('user/assignsubscription', ['controller' => $version.'UserSubscription', 'action' => 'assignSubscription']);
    $routes->connect('setcookie', ['controller' => $version.'Home', 'action' => 'setCookie']);
    $routes->connect('getcookie', ['controller' => $version.'Home', 'action' => 'getCookie']);
    $routes->connect('logout', ['controller' => $version.'Home', 'action' => 'logout']);
 
    
 $routes->fallbacks('DashedRoute');    
});
Router::scope('/v2/', function (RouteBuilder $routes) {
    $version = 'V2/';
    $routes->connect('getSignal', ['controller' => $version.'Signal', 'action' => 'getTradeSignal']);
    $routes->connect('registerUser', ['controller' => $version.'User', 'action' => 'userregistration']);
    $routes->connect('userLogin', ['controller' => $version.'User', 'action' => 'userLogin']);
    $routes->connect('userSubLogin', ['controller' => $version.'User', 'action' => 'userSubLogin']);
    $routes->connect('usernameAvailability', ['controller' => $version.'User', 'action' => 'usernameAvailability']);
    $routes->connect('forgotPassword', ['controller' => $version.'User', 'action' => 'forgotPassword']);
    $routes->connect('forgotSubPassword', ['controller' => $version.'User', 'action' => 'forgotSubPassword']);
    $routes->connect('resetPassword', ['controller' => $version.'User', 'action' => 'resetPassword']);
    $routes->connect('getUserProfile', ['controller' => $version.'User', 'action' => 'getUserProfile']);
    $routes->connect('updateUserProfile', ['controller' => $version.'User', 'action' => 'updateUserProfile']);
    $routes->connect('gettradehistory', ['controller' => $version.'TradeBackup', 'action' => 'getTradeBackup']);
    $routes->connect('getpages', ['controller' => $version.'Pages', 'action' => 'getPages']);
    $routes->connect('getpageupdates', ['controller' => $version.'Sync', 'action' => 'getPageUpdates']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->fallbacks('DashedRoute');
}); 


/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
