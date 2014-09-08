<?php

// This is the main page controller for this web site. It receives
// all calls for different pages and routs the request to the router
// wich fetches content and renders it via the propriate view. 
// It's all base don the MVC pattern.

require __DIR__.'/config_with_app.php'; 
 
// Inlude theme for me. Contains configuration for the me-web-site

$app->theme->configure(ANAX_APP_PATH . 'config/theme_me.php');

// Inlude theme for the navigation menu.

$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

// Configure pretty, clean url links

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);


// The route for me. It's a page with an introduction who I am.
// Set title and fetch the content. The content is witten in 
// markdown and stored in a separate file at the moment

$app->router->add('me', function() use ($app) {
 
 	$app->theme->setTitle("Om mig");

 	$content = $app->fileContent->get('me.md');
 	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
	$byline  = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
});
 

// The route for reprot. It's a page with reports of each kmom.
// Set title and fetch the content. The content is witten in 
// markdown and stored in a separate file at the moment

$app->router->add('report', function() use ($app) {
 
 	$app->theme->setTitle("Redovisning");

 	$content = $app->fileContent->get('report.md');
 	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
	$byline  = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
  
});


// The route for kmom01.
// Set title and fetch the content. The content is witten in 
// markdown and stored in a separate file at the moment

$app->router->add('kmom01', function() use ($app) {
 
 	$app->theme->setTitle("Kmom01");

 	$content = $app->fileContent->get('kmom01.md');
 	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
	$byline  = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
  
});


// The route for kmom02.
// Set title and fetch the content. The content is witten in 
// markdown and stored in a separate file at the moment

$app->router->add('kmom02', function() use ($app) {
 
 	$app->theme->setTitle("Kmom02");

 	$content = $app->fileContent->get('kmom02.md');
 	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
	$byline  = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
  
});


// The route for misc. It's a page with submenus.
// Set title and fetch the content. The content is witten in 
// markdown and stored in a separate file at the moment

$app->router->add('misc', function() use ($app) {
 
 	$app->theme->setTitle("Diverse");

 	$content = $app->fileContent->get('misc.md');
 	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
	$byline  = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
  
});


// The route for calendar.
// Set title and fetch the content. The calender is created by 
// the CCalendar class

$app->router->add('calendar', function() use ($app) {
 
 	$app->theme->setTitle("Månadskalender");

 	$calendar = new \Herb13\Calendar\CCalendar();
 	$content = $calendar->getCalendar();
    
	$byline  = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
  
});


// The route for dice game.
// Set title and fetch the content. The game is created by 
// the CDiceGame class.

$app->router->add('dicegame', function() use ($app) {
 
 	$app->theme->setTitle("Tärningsspel");

 	$diceGame = new \Herb13\Dicegame\CDiceGame($app->session);
 	$content = $diceGame->getGameInstruction() . $diceGame->getGamePanel();
    
	$byline  = $app->fileContent->get('byline.md');
	$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
    $app->views->add('me/page', [
        'content' => $content,
        'byline' => $byline,
    ]);
  
});

// The route for guestbook. It's a page where users can write comments.
// Set title and fetch the content. 

$app->router->add('guestbook', function() use ($app) {
 
    //$app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Gästbok");
 
    $app->views->add('comment/index');

     $app->views->add('comment/form', [
        'mail'      => null,
        'web'       => null,
        'name'      => null,
        'content'   => null,
        'output'    => null,
    ]);

    $app->dispatcher->forward([
        'controller' => 'comment',
        'action'     => 'view',
    ]);

});

// The route for source code. It's a page for source code browsing.
// Set title and fetch the content. The content is witten in 
// markdown and stored in a separate file at the moment
 
$app->router->add('source', function() use ($app) {
 
    $app->theme->addStylesheet('css/source.css');
    $app->theme->setTitle("Källkod");
 
    $source = new \Mos\Source\CSource([
        'secure_dir' => '..', 
        'base_dir' => '..', 
        'add_ignore' => ['.htaccess'],
    ]);
 
    $app->views->add('me/source', [
        'content' => $source->View(),
    ]);
});
 

// Finally, let Anax MVC render the views.

$app->router->handle();
$app->theme->render();