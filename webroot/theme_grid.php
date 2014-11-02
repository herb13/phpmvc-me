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
  
  // Fetch content for each region and place it there as an 
  // example page with regions

  $content = $app->fileContent->get('/theme-grid/flash.md');
  $flash = $app->textFilter->doFilter($content, 'shortcode, markdown');
  
  $content = $app->fileContent->get('/theme-grid/featured-1.md');
  $featured1 = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/featured-2.md');
  $featured2 = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/featured-3.md');
  $featured3 = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/sidebar.md');
  $sidebar = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/footer-col-1.md');
  $footerCol1 = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/footer-col-2.md');
  $footerCol2 = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/footer-col-3.md');
  $footerCol3 = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/footer-col-4.md');
  $footerCol4 = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/triptych-1.md');
  $tripTych11 = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/triptych-2.md');
  $tripTych12 = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/triptych-3.md');
  $tripTych13 = $app->textFilter->doFilter($content, 'shortcode, markdown');

  $content = $app->fileContent->get('/theme-grid/main.md');
  $main = $app->textFilter->doFilter($content, 'shortcode, markdown');

  // Configure the views
    
  $app->views->addString($flash, 'flash')
             ->addString($featured1, 'featured-1')
             ->addString($featured2, 'featured-2')
             ->addString($featured3, 'featured-3')
             ->addString($main, 'main')
             ->addString($sidebar, 'sidebar')
             ->addString($tripTych11, 'triptych-1')
             ->addString($tripTych12, 'triptych-2')
             ->addString($tripTych13, 'triptych-3')
             ->addString($footerCol1, 'footer-col-1')
             ->addString($footerCol2, 'footer-col-2')
             ->addString($footerCol3, 'footer-col-3')
             ->addString($footerCol4, 'footer-col-4');
 
});


// This route shows regions that the theme is built up by.
// It shows a grid in the background and all region's placement
// on the grid.

$app->router->add('regions', function() use ($app) {
 
 	$app->theme->setTitle("Regioner");

  // The grid background

 	$app->theme->addStyleSheet('css/anax-grid/grid_background.less');

  // Add the regions that will be rendered by the view
    
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

});


// This route shows typography and uses some of the available
// regions. Content for the reoute is fetched from a html file.

$app->router->add('typography', function() use ($app) {
 
  $app->theme->setTitle("Typografi");

  $content = $content = $app->fileContent->get('typography.html');

  // Render the content in main and sidebar

  $app->views->addString($content, 'main')
             ->addString($content, 'sidebar');
              
});


// This route gives an example of font awesome. 

$app->router->add('awesome', function() use ($app) {
 
  $app->theme->setTitle("Font awesome");
  
  // Content for main
    
  $content = '<h1>Test av Font Awesome</h1>
              <p>Font awesome ger stöd för att lägga in häftiga bilder på din hemsida. Det finns även stöd för rörliga, små animationer. Till exempel:</p>
              <i class="fa fa-spinner fa-spin"></i>
              <i class="fa fa-circle-o-notch fa-spin"></i>
              <i class="fa fa-refresh fa-spin"></i>
              <i class="fa fa-cog fa-spin"></i>';  

  $content .= '<h2>Nytt i 4.2.0</h2>
               <p>Nedan sysns några exempel på nya ikoner i awesome 4.2.0</p>
               <i class="fa fa-area-chart fa-2x"></i>
               <i class="fa fa-at fa-2x"></i>
               <i class="fa fa-bell-slash fa-2x"></i>
               <i class="fa fa-bell-slash-o fa-2x"></i>
               <i class="fa fa-bicycle fa-2x"></i>
               <i class="fa fa-binoculars fa-2x"></i>
               <i class="fa fa-birthday-cake fa-2x"></i>
               <i class="fa fa-bus fa-2x"></i>
               <i class="fa fa-calculator fa-2x"></i>
               <i class="fa fa-copyright fa-2x"></i> 
               <i class="fa fa-eyedropper fa-2x"></i> 
               <i class="fa fa-futbol-o fa-2x"></i>
               <i class="fa fa-ils fa-2x"></i> 
               <i class="fa fa-ioxhost fa-2x"></i>';

  // Content for sidebar
  
  $sidebar = '<h1>Exempel på bilder</h1>
              <h2>Grundikon</h2>
              <i class="fa fa-camera-retro"></i> fa-camera-retro
              <h2>Varierande storlek</h2>
              <i class="fa fa-camera-retro fa-lg"></i> fa-lg </br></br>
              <i class="fa fa-camera-retro fa-2x"></i> fa-2x </br></br>
              <i class="fa fa-camera-retro fa-3x"></i> fa-3x </br></br>
              <i class="fa fa-camera-retro fa-4x"></i> fa-4x </br></br>
              <i class="fa fa-camera-retro fa-5x"></i> fa-5x </br></br>';  


  $app->views->addString($content, 'main')
             ->addString($sidebar, 'sidebar');
              
});

$app->router->handle();
$app->theme->render();