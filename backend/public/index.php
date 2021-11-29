<?php

require_once '../vendor/autoload.php';

/* ------------
--- ROUTAGE ---
-------------*/
$router = new AltoRouter();

if (array_key_exists('BASE_URI', $_SERVER)) {
    $router->setBasePath($_SERVER['BASE_URI']);
} else {
    $_SERVER['BASE_URI'] = '/';
}

//*** Home ***/
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\MainController'
    ],
    'main-home'
);

//*** User ***/
$router->map(
    'GET',
    '/users',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-list'
);

$router->map(
    'GET',
    '/users/[i:id]',
    [
        'method' => 'item',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-item'
);

$router->map(
    'POST',
    '/users',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-add'
);

$router->map(
    'DELETE',
    '/users/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\UserController'
    ],
    'user-delete'
);

//*** Task ***/
$router->map(
    'GET',
    '/tasks',
    [
        'method' => 'list',
        'controller' => '\App\Controllers\TaskController'
    ],
    'task-list'
);

$router->map(
    'GET',
    '/tasks/[i:id]',
    [
        'method' => 'item',
        'controller' => '\App\Controllers\TaskController'
    ],
    'task-item'
);

$router->map(
    'POST',
    '/tasks',
    [
        'method' => 'add',
        'controller' => '\App\Controllers\TaskController'
    ],
    'task-add'
);

$router->map(
    'DELETE',
    '/tasks/[i:id]',
    [
        'method' => 'delete',
        'controller' => '\App\Controllers\TaskController'
    ],
    'task-delete'
);


/* -------------
--- DISPATCH ---
--------------*/

$match = $router->match();
$dispatcher = new Dispatcher($match, '\App\Controllers\ErrorController::err404');
$dispatcher->dispatch();
