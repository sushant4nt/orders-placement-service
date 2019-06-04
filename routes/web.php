<?php

/*
 * Application Routes
 * 
 * maaping of URIs and Closure to call when URI is requested
*/

	# Orders
	$router->post('/orders', 'OrderController@place');
	$router->put('/orders/{id}', 'OrderController@take');
	$router->get('/orders', 'OrderController@list');
