<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->options('(:any)', function () {
    return service('response')->setStatusCode(200);
});

$routes->get('/', 'Home::index');

$routes->group('api', function($routes) {
    $routes->resource('usuarios', ['controller' => 'ApiController']);
    $routes->get('usuarios', 'ApiController::index'); // Listar usuarios
    $routes->get('usuarios/(:num)', 'ApiController::show/$1'); // Obtener un usuario por ID
    $routes->post('usuarios', 'ApiController::create'); // Crear usuario
    $routes->put('usuarios/(:num)', 'ApiController::update/$1'); // Actualizar usuario
    $routes->delete('usuarios/(:num)', 'ApiController::delete/$1'); // Eliminar usuario
});

