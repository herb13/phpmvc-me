phpmvc-me
=========

Repository phpmvc-me contains a website built upon Anax-MVC framework / webtemplate / boilerplate. It is developed as part of
the course "Databasdrivna webbappl med PHP och MVC-kp25". In this repository, both the Anax-MVC and the website built upon it is found.

To learn more about the Anax-MVC framework, the following gives an introduction.

Read article about it here: ["Anax som MVC-ramverk"](http://dbwebb.se/kunskap/anax-som-mvc-ramverk) and here ["Bygg en me-sida med Anax-MVC"](http://dbwebb.se/kunskap/bygg-en-me-sida-med-anax-mvc). 

Builds upon Anax-base, read article about Anax-base ["Anax - en hållbar struktur för dina webbapplikationer"](http://dbwebb.se/kunskap/anax-en-hallbar-struktur-for-dina-webbapplikationer) to get an overview of its none-MVC variant. 



License 
------------------

This software is free software and carries a MIT license.



Use of external libraries
-----------------------------------

The following external modules are included and subject to its own license.

### Anax-MVC (Framework this website is built on)
* Website: https://github.com/mosbth/Anax-MVC
* Version: v2.0.0
* License: MIT License
* Path: whole website structure included, i.e. /3pp /app /docs /src /test /theme /webroot



### PHPMVC-Comment 
* Website: https://github.com/mosbth/phpmvc-comment
* Version: Latest
* License: -
* Path: `vendor/phpmvc/comment`



### Modernizr
* Website: http://modernizr.com/
* Version: 2.6.2
* License: MIT license 
* Path: included in `webroot/js/modernizr.js`



### PHP Markdown
* Website: http://michelf.ca/projects/php-markdown/
* Version: 1.4.0, November 29, 2013
* License: PHP Markdown Lib Copyright © 2004-2013 Michel Fortin http://michelf.ca/ 
* Path: included in `3pp/php-markdown`



### LESS
* Website: http://leafo.net/lessphp
* Version: 0.4.0
* License: MIT License 
* Path: included in `webroot/css/anax-grid/lessphp`



### Semantic.gs
* Website: http://semantic.gs/
* Version: 1.2, January 11, 2012
* License: Apache License
* Path: included in `webroot/css/anax-grid/semantic.gs`



### Font Awesome
* Website: http://fortawesome.github.io/Font-Awesome/
* Version: 4.2.0
* License: MIT License and SIL OFL 1.1
* Path: included in `webroot/css/anax-grid/font-awesome-4.2.0`


History
-----------------------------------


###History for phpmvc-me


v3.0.0 (tagged with v3.0.0)

* Version containing kmom03
* Added support for LESS PHP
* Added support for grid-layout
* Added support for Font Awesome
* Added examples for grid-layout and Font Awesome


v2.0.0 (tagged with v2.0.0)

* Version containing kmom02
* Added support for comment system
* Comment system introduced on two pages, me and guestbook
* Gravatar support added for comments


v1.0.0 (tagged with v1.0.0)

* First version for exercise kmom01.
* Updated /app/config/ with theme_me.php and navbar_me.php for own style
* Updated /app/content/ with byline.md kmom01.md, kmom02.md, me.md, misc.md, report.md
* Updated /app/src/ with /Calendar containing a class for a simple calendar
* Updated /app/src/ with /Dicegame containing classes for a simple dice game
* Updated /app/src/ with /Source containing classes for source code browsing
* Added /view/me/ and template files for footer, header, page and source
* Updated /webroot/css/ calendar.css (added), navbar_me.css (added), dice.css (updated), source.css (added)
* Added website specific pictures in /webrrot/img/
* Added /webroot/index.php main page controller and url dispacher 


