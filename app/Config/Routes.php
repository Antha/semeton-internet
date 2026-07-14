<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('o/(:segment)', 'Home::outlet/$1');
$routes->get('h/(:segment)', 'Home::history/$1');
$routes->post('api/payment/notification', 'Payment::notification');

$routes->group('',['filter' => 'auth'], function($routes){
    $routes->get('outlet_store', 'Outlet::index');
    $routes->post('outlet_store/getVoucher','Outlet::getVoucher');
    $routes->get('outlet_history', 'Outlet::historyTrx');
    $routes->get('logout', 'Home::logout');
    $routes->get('payment/finish', 'Payment::finish');
    $routes->post('api/payment/create', 'Payment::createTransaction');
});
