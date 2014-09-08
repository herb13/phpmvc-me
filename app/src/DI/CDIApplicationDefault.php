<?php

namespace Herb13\DI;

/**
 * Application base class that implementing Dependency Injection / Service Locator 
 * of the services used by the framework, using lazy loading. 
 *
 * Add all application specific DI:s in this class. It extends the framework's
 * fefault dependency injection
 *
 */

use Anax\DI\CDIFactoryDefault;
use Phpmvc\Comment\CommentController;

class CDIApplicationDefault extends CDIFactoryDefault
{
   /**
     * Construct.
     *
     */

    public function __construct()
    {
        parent::__construct();

        // Configure controller for comments.

        $this->set('CommentController', function() {
            $controller = new CommentController();
            $controller->setDI($this);
            return $controller;
        });
    }
}