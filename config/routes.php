<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {
    $app->get('/users[/]', App\Handler\UserReadHandler::class, 'users');
    $app->get('/users/{id:\d+}[/]', App\Handler\UsersViewHandler::class, 'user.view');

    $app->post('/users[/]', App\Handler\UsersCreateHandler::class, 'user.create');

    $app->put('/users/{id:\d+}[/]', App\Handler\UsersUpdateHandler::class, 'user.update');
    $app->delete('/users/{id:\d+}[/]', App\Handler\UsersDeleteHandler::class, 'user.delete');

    $app->get('/addresses/{user_id:\d+}[/]', App\Handler\AddressesReadHandler::class, 'addresses');
    $app->post('/addresses[/]', App\Handler\AddressesCreateHandler::class, 'address.create');

    $app->put('/addresses/{id:\d+}[/]', App\Handler\AddressesUpdateHandler::class, 'address.update');
    $app->delete('/addresses/{id:\d+}[/]', App\Handler\AddressesDeleteHandler::class, 'address.delete');
};
