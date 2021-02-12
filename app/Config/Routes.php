<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
// $routes->setDefaultNamespace('App\Controllers\Front');
// $routes->setDefaultController('HomeController');
// $routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Frontend Routes
$routes->group('/', ['namespace' => 'App\Controllers\Front'], function($routes) {
	$routes->get('', 'HomeController::index', ['as' => 'front.index']);
});

$routes->addRedirect('controle', 'controle/login');

// CMS Routes
$routes->group('controle', function($routes) {

// 	// -- Login
	$routes->addRedirect('', 'login');
	$routes->get('login', 'App\Controllers\Cms\LoginController::index', ['as' => 'cms.login.index']);
// 	$routes->get('esqueci-senha', 'App\Controllers\Cms\LoginController::forgot_password', ['as' => 'cms.login.forgot_password']);
// 	$routes->match(['post', 'get'], 'gerar-nova-senha', 'App\Controllers\Cms\LoginController::generate_new_password', ['as' => 'cms.login.new_password']);
// 	$routes->get('logout', 'App\Controllers\Cms\LoginController::logout', ['as' => 'cms.logout']);
// 	$routes->get('refresh', 'App\Controllers\Cms\LoginController::refresh_token', ['as' => 'cms.login.refresh']);

	$routes->post('auth', 'App\Controllers\Cms\LoginController::auth', ['as' => 'cms.login.auth']);

// 	$routes->match(['post', 'get'], 'esqueci-senha/enviar-senha', 'App\Controllers\Cms\LoginController::send_notification_mail', ['as' => 'cms.login.send_notification_mail']);
// 	$routes->match(['post', 'get'], 'validar-senha/(:any)', 'App\Controllers\Cms\LoginController::password_strength/$1', ['as' => 'cms.login.password_strength', 'offset' => 1]);
	
	// -- Dashboard
	$routes->get('dashboard', 'App\Controllers\Cms\DashboardController::index', ['as' => 'cms.dashboard']);

	// -- Usuários
    $routes->group('usuarios', function($routes) {
		$routes->match(['get', 'post'], '/', 'App\Controllers\Cms\UsersController::index', ['as' => 'cms.users.index']);
		$routes->match(['get', 'post'], 'novo', 'App\Controllers\Cms\UsersController::create', ['as' => 'cms.users.create']);
		$routes->match(['get', 'post'], 'editar', 'App\Controllers\Cms\UsersController::update', ['as' => 'cms.users.update']);
		$routes->post('edicao-em-massa', 'App\Controllers\Cms\UsersController::mass_update', ['as' => 'cms.users.massupdate']);
	});
	
// 	// -- Perfil
// 	$routes->group('perfil', function($routes) {
// 		$routes->get('', 'App\Controllers\Cms\ProfileController::index', ['as' => 'cms.profile.index']);
// 		$routes->post('salvar', 'App\Controllers\Cms\ProfileController::index', ['as' => 'cms.profile.save']);
// 	});

	// -- Configurações
	$routes->group('configuracoes', function($routes) {

	});
});

/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
