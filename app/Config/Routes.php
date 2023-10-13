<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Principal::index');
$routes->get('Servicios', 'Servicios::index');
$routes->get('Servicios_eliminados', 'Servicios::Eliminados');
$routes->post('insertar_servicio', 'Servicios::insertar');
$routes->post('Estados_Servicios/(:num)/(:num)', 'Servicios::desactivar/$1/$2');
$routes->post('Estados_Servicios/(:num)/(:num)', 'Servicios::desactivar/$1/$2');

