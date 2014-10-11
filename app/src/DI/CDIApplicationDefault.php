<?php

namespace Herb13\DI;

/**
 * Application class that implementing Dependency Injection / Service Locator 
 * of the services used by the framework, using lazy loading. 
 *
 * Add all application specific DI:s in this class. It extends the framework's
 * default dependency injection
 *
 */

use Anax\DI\CDIFactoryDefault;
use Herb13\Comment\CPageCommentController;


class CDIApplicationDefault extends CDIFactoryDefault
{
   /**
     * Construct.
     *
     */

    public function __construct()
    {
        parent::__construct();

        // Configure controller for comments, first one is added to the guestbook.

        $this->set('GuestbookController', function() {
            $controller = new CPageCommentController();
            $controller->setDI($this);
            $controller->setPage('guestbook'); // page where comments should be added
            return $controller;
        });

        // Configure controller for comments, this one is added to the me page

        $this->set('MeController', function() {
            $controller = new CPageCommentController();
            $controller->setDI($this);
            $controller->setPage('me'); // page where comments should be added
            return $controller;
        });


        // Add any extra controller cofigurations here ...
    }
}