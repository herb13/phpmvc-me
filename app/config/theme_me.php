<?php
/**
 * Config-file for Anax, theme related settings, return it all as array.
 *
 */
return [

    /**
     * Settings for Which theme to use, theme directory is found by path and name.
     *
     * path: where is the base path to the theme directory, end with a slash.
     * name: name of the theme is mapped to a directory right below the path.
     */
    'settings' => [
        'path' => ANAX_INSTALL_PATH . 'theme/',
        'name' => 'anax-base',
    ],

    
    /** 
     * Add default views.
     */
    'views' => [
        
        // Header

        [
            'region' => 'header', 
            'template' => 'me/header', 
            'data' => [
                'siteTitle' => "Min me-sida",
                'siteTagline' => "Powered by Anax MVC i kursen PHPMVC",
            ], 
            'sort' => -1
        ],
    
        // Footer

        [
            'region' => 'footer', 
            'template' => 'me/footer', 
            'data' => [
                'siteFooter' => "Verktyg: <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a> Github: <a href='https://github.com/herb13/phpmvc-me'>phpmvc-me</a>",
                'siteCopyright' => "<br/><br/>Copyright © SLS SkyLineSoftware",
            ], 
            'sort' => -1
        ],


        // Navbar

        [
            'region' => 'navbar', 
            'template' => [
                'callback' => function() {
                    return $this->di->navbar->create();
                },
            ], 
            'data' => [], 
            'sort' => -1
        ],
    ],


    /** 
     * Data to extract and send as variables to the main template file.
     */
    'data' => [

        // Language for this page.
        'lang' => 'sv',

        // Append this value to each <title>
        'title_append' => ' | Powered by Anax',

        // Stylesheets
        'stylesheets' => ['css/style.css', 'css/navbar_me.css', 'css/figure.css', 'css/calendar.css','css/dice.css','css/comments.css'],
        // Stylesheets

        // Inline style
        'style' => null,

        // Favicon
        'favicon' => 'sls_favicon.png',

        // Path to modernizr or null to disable
        'modernizr' => 'js/modernizr.js',

        // Path to jquery or null to disable
        'jquery' => '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js',

        // Array with javscript-files to include
        'javascript_include' => [],

        // Use google analytics for tracking, set key or null to disable
        'google_analytics' => null,
    ],
];