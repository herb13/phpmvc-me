<?php

// This is the page controller for illustration of LESS

require __DIR__.'/config_with_app.php'; 
 
// Inlude theme for me. Contains configuration for the me-web-site

$app->theme->configure(ANAX_APP_PATH . 'config/theme_grid.php');

// Inlude theme for the navigation menu.

$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');

// Configure pretty, clean url links

$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Fetch query string and check if show-grid is set, i.e. <url>?show-grid
// Save the result in $showGrid variable for usage in this file:
// $showGrid = true, user wants grid to be shown
// $showGrid = false, user does not want grid to be shown

$showGrid = $app->request->getGet("show-grid", "show-no-grid") == null ? true : false;

if ($showGrid) {
	
	$app->theme->addStyleSheet('css/anax-grid/grid_background.less');
}


// Below are all available routes for this page controller.
// All routes are related to theme

$app->router->add('theme', function() use ($app) {
 
 	$app->theme->setTitle("Tema");
  //$app->theme->addStyleSheet('css/anax-grid/grid_background.less');


	//$app->theme->addStyleSheet('css/style.css');
	//$app->theme->addStyleSheet('css/navbar_me.css');
	//$app->theme->addStyleSheet('css/figure.css');
 	
   /* $content = $app->fileContent->get('theme.md');
    $content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
    $byline  = $app->fileContent->get('byline.md');
    $byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
  
    $app->views->addString("Dagens nyhet!", 'flash')
               ->addString($content, 'main')
               ->addString('sidebar', 'sidebar');*/
  
  //$app->theme->addStyleSheet('css/anax-grid/grid_background.less');

  $content = "Detta är ett nytt tema som visar regioner";

    //$content = $app->fileContent->get('theme.md');
    //$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
    //$byline  = $app->fileContent->get('byline.md');
    //$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
  $app->views->addString('flash', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString($content, 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('triptych-1', 'triptych-1')
               ->addString('triptych-2', 'triptych-2')
               ->addString('triptych-3', 'triptych-3')
               ->addString('footer-col-1', 'footer-col-1')
               ->addString('footer-col-2', 'footer-col-2')
               ->addString('footer-col-3', 'footer-col-3')
               ->addString('footer-col-4', 'footer-col-4');

    /* $app->views->add('me/page', [
        'content' => $content,
    ], 'main');*/
 
});


$app->router->add('regions', function() use ($app) {
 
 	$app->theme->setTitle("Regioner");
 	$app->theme->addStyleSheet('css/anax-grid/grid_background.less');

 	$content = "Detta är ett nytt tema som visar regioner";

    //$content = $app->fileContent->get('theme.md');
    //$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
    //$byline  = $app->fileContent->get('byline.md');
    //$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    
	$app->views->addString('flash', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString('main', 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('triptych-1', 'triptych-1')
               ->addString('triptych-2', 'triptych-2')
               ->addString('triptych-3', 'triptych-3')
               ->addString('footer-col-1', 'footer-col-1')
               ->addString('footer-col-2', 'footer-col-2')
               ->addString('footer-col-3', 'footer-col-3')
               ->addString('footer-col-4', 'footer-col-4');

  //  $app->views->add('me/page', [
  //      'content' => $content,
  //  ]);

});


$app->router->add('typography', function() use ($app) {
 
  $app->theme->setTitle("Typografi");
  //$app->theme->addStyleSheet('css/anax-grid/grid_background.less');

  $content = $content = $app->fileContent->get('typography.html');

    //$content = $app->fileContent->get('theme.md');
    //$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
    
    //$byline  = $app->fileContent->get('byline.md');
    //$byline = $app->textFilter->doFilter($byline, 'shortcode, markdown');
    

  $app->views->addString($content, 'main')
             ->addString($content, 'sidebar');
              
               
  //  $app->views->add('me/page', [
  //      'content' => $content,
  //  ]);

});

$app->router->handle();
$app->theme->render();