<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item for home. Start page of this sit
        // Its a single menu item without submenus.

        'home'  => [
            'text'  => 'Me',   
            'url'   => 'me',  
            'title' => 'Min me-sida'
        ],
 
        // This is a menu item for all reports. Its a menu item with submenus.
        // One submenu for each kmom (excersise).

        'report'  => [
            'text'  => 'Redovisning',   
            'url'   => 'report',   
            'title' => 'Mina redovisningar',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'kmom01'  => [
                        'text'  => 'Kmom01',   
                        'url'   => 'kmom01',  
                        'title' => 'Redovisning Kmom01'
                    ],

                    // This is a menu item of the submenu
                    'kmom02'  => [
                        'text'  => 'Kmom02',   
                        'url'   => 'kmom02',  
                        'title' => 'Redovisning Kmom02'
                    ],
                ],
            ],
        ],
 

        // This is a menu item with submenus. The idea is that we add extra excersices here
        // Extra excersices are optional.

        'misc'  => [
            'text'  => 'Diverse',   
            'url'   => 'misc',   
            'title' => 'Verktyg och spel',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    'calendar'  => [
                        'text'  => 'Kalender',   
                        'url'   => 'calendar',  
                        'title' => 'Månadskalender'
                    ],

                    // This is a menu item of the submenu
                    'dicegame'  => [
                        'text'  => 'Tärningsspel',   
                        'url'   => 'dicegame',  
                        'title' => 'Tärningsspel'
                    ],
                ],
            ],
        ],

        // This is a menu item without any submenus. This one is for source code.

        'source' => [
            'text'  =>'Källkod', 
            'url'   =>'source',  
            'title' => 'Min källkod'
        ],
    ],
 
    // Callback tracing the current selected menu item base on scriptname
    'callback' => function($url) {
        if ($url == $this->di->get('request')->getRoute()) {
            return true;
        }
    },

    // Callback to create the urls
    'create_url' => function($url) {
        return $this->di->get('url')->create($url);
    },
];
