<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

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
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->setExtensions(['json','pdf']);
    $routes->connect('/ajax/compagnies-add/*',['controller' => 'Ajax', 'action' => 'compagniesAdd','_ext' => 'json']);

    $routes->connect('/ajax/get-articles-params', ['controller' => 'Ajax', 'action' => 'getArticlesParams', '_ext' => 'json']);
    $routes->connect('/ajax/get-default-tva',['controller' => 'Ajax', 'action' => 'getTvaDefault','_ext' => 'json']);
    $routes->connect('/search/*', ['controller' => 'Dashboard', 'action' => 'search']);
    
    $routes->connect('/pdf/*', ['controller' => 'Files', 'action' => 'pdf']);
});

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    //$routes->applyMiddleware('csrf');

    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Dashboard', 'action' => 'index']);
    $routes->connect('/enregistrement', ['controller' => 'Users', 'action' => 'register']);
    $routes->connect('/connexion', ['controller' => 'Users', 'action' => 'login']);

    $routes->connect('/files/*', ['controller' => 'Files', 'action' => 'pdfview']);

    $routes->connect('/clients',['controller' => 'Clients', 'action' => 'index']);   
    $routes->connect('/clients/fiche/*', ['controller' => 'Clients', 'action' => 'view']);
    $routes->connect('/clients/ajouter', ['controller' => 'Clients', 'action' => 'add']);
    $routes->connect('/clients/modifier/*', ['controller' => 'Clients', 'action' => 'edit']);

    $routes->connect('/compagnies/', ['controller' => 'Compagnies', 'action' => 'index']);
    $routes->connect('/compagnies/fiche/*', ['controller' => 'Compagnies', 'action' => 'view']);
    $routes->connect('/compagnies/ajouter/*',['controller' => 'Compagnies','action' => 'add']);
    $routes->connect('/compagnies/modifier/*',['controller' => 'Compagnies','action' => 'edit']);

    $routes->connect('/:type', ['controller' => 'Actions', 'action' => 'index'])->setPass(['type'])->setPatterns(['type' => '[a-z]+']);
    $routes->connect('/:type/:state', ['controller' => 'Actions','action' => 'index'])->setPass(['type','state'])->setPatterns(['type' => '[a-z]+','state' => '[0-9]+']);
    $routes->connect('/:type/n/:id', ['controller' => 'Actions','action' => 'view'])->setPass(['type','id'])->setPatterns(['type' => '[a-z]+','id' => '[0-9]+']); 
    $routes->connect('/:type/nouveau', ['controller' => 'Actions', 'action' => 'add'])->setPass(['type'])->setPatterns(['type' => '[a-z]+']); 
    $routes->connect('/:type/nouveau/:id', ['controller' => 'Actions', 'action' => 'add'])->setPass(['type','id'])->setPatterns(['type' => '[a-z]+','id' => '[0-9]+']);
    $routes->connect('/:type/modifier/:id', ['controller' => 'Actions','action' => 'edit'])->setPass(['type','id'])->setPatterns(['type' => '[a-z]+','id' => '[0-9]+']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *
     * ```
     * $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);
     * $routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);
     * ```
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * If you need a different set of middleware or none at all,
 * open new scope and define routes there.
 *
 * ```
 * Router::scope('/api', function (RouteBuilder $routes) {
 *     // No $routes->applyMiddleware() here.
 *     // Connect API actions here.
 * });
 * ```
 */
