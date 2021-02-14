<?php

$routes->set404Override('IM\CI\Controllers\GlobalController::notFound');

$routes->get('^(\w{2})/(.*)', 'GlobalController::changeLang', ['namespace' => 'IM\CI\Controllers']);

$routes->group('', ['namespace' => 'IM\CI\Controllers'], function ($routes) {
	$routes->get('login', 'AuthController::login', ['as' => 'login']);
	$routes->post('login', 'AuthController::attemptLogin');
	$routes->get('logout', 'AuthController::logout');

	$routes->get('register', 'AuthController::register', ['as' => 'register']);
	$routes->get('register/(:any)', 'AuthController::registerSuccess/$1');
	$routes->post('register', 'AuthController::attemptRegister');

	$routes->get('activate-account', 'AuthController::activateAccount', ['as' => 'activate-account']);
	$routes->get('resend-activate-account', 'AuthController::resendActivateAccount', ['as' => 'resend-activate-account']);

	$routes->get('forgot-password', 'AuthController::forgotPassword', ['as' => 'forgot']);
	$routes->post('forgot-password', 'AuthController::attemptForgot');
	$routes->get('reset-password', 'AuthController::resetPassword', ['as' => 'reset-password']);
	$routes->post('reset-password', 'AuthController::attemptReset');
});

$routes->group('support', ['namespace' => 'IM\CI\Controllers'], function ($routes) {
	$routes->group('groups', function ($routes) {
		$routes->get('/', 'Groups::index');
		$routes->post('list', 'Groups::list');
		$routes->match(['get', 'post'], 'create', 'Groups::create');
		$routes->match(['get', 'post'], 'edit/(:any)', 'Groups::edit/$1');
		$routes->get('detail/(:any)', 'Groups::detail/$1');
		$routes->match(['get', 'delete'], 'delete/(:any)', 'Groups::delete/$1');
		$routes->patch('restore/(:any)', 'Groups::restore/$1');
	});
	$routes->group('users', function ($routes) {
		$routes->get('/', 'Users::index');
		$routes->post('list', 'Users::list');
		$routes->get('edit/(:any)', 'Users::edit/$1');
		$routes->get('detail/(:any)', 'Users::detail/$1');
		$routes->delete('delete/(:any)', 'Users::delete/$1');
	});
	$routes->group('system-logs', function ($routes) {
		$routes->get('/', 'SystemLogs::index');
		$routes->post('list', 'SystemLogs::list');
		$routes->get('detail/(:any)', 'SystemLogs::detail/$1');
	});
	$routes->group('trash', function ($routes) {
		$routes->get('/', 'Trash::index');
		$routes->post('list', 'Trash::list');
		$routes->get('detail/(:any)', 'Trash::detail/$1');
	});
});
