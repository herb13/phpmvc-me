<?php 
/**
 * This is a Anax pagecontroller.
 *
 */

// Include the essential settings for this website.

require __DIR__.'/config_with_app.php'; 
 
// Inlude theme for me. Contains configuration for the me-web-site

$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

// Inlude theme for the navigation menu.

$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

// Set the controller object

$di->set('CommentController', function() use ($di) {
    $controller = new Phpmvc\Comment\CommentController();
    $controller->setDI($di);
    return $controller;
});

// Home route

$app->router->add('', function() use ($app) {

    $app->theme->setTitle("Welcome to Anax Guestbook");
    $app->views->add('comment/index');

    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
    ]);

    $app->views->add('comment/form', [
        'mail'      => null,
        'web'       => null,
        'name'      => null,
        'content'   => null,
        'output'    => null,
    ]);
});


// Check for matching routes and dispatch to controller/handler of route

$app->router->handle();

// Render the page

$app->theme->render();
