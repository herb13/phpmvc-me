<?php
/**
 * Config file for pagecontrollers, creating an instance of $app.
 *
 */

// Get environment & autoloader.
require __DIR__.'/config.php'; 

// Create services and inject into the app. 
$di  = new \Herb13\DI\CDIApplicationDefault();
$app = new \Anax\Kernel\CAnax($di);
