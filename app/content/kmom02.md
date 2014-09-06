Kmom02: Kontroller och modeller
------------------------------------
 
Jag började med att göra guiden för CLI kommandon. Körde lokat först på min egen Linux-maskin (Ubuntu). Här hade jag version 5.5.9.:
<code>
herb@rigel:~$ php --version
PHP 5.5.9-1ubuntu4.3 (cli) (built: Jul  7 2014 16:34:16) 
Copyright (c) 1997-2014 The PHP Group
Zend Engine v2.5.0, Copyright (c) 1998-2014 Zend Technologies
    with Zend OPcache v7.0.3, Copyright (c) 1999-2014, by Zend Technologies
</code>

Loggade också in på student servern och körde samma kommando vilket gav version 5.9.16:
<code>
herb13@seekers: php --version
PHP 5.5.16-1~dotdeb.1 (cli) (built: Aug 22 2014 14:41:51) 
Copyright (c) 1997-2014 The PHP Group
Zend Engine v2.5.0, Copyright (c) 1998-2014 Zend Technologies
    with Zend OPcache v7.0.4-dev, Copyright (c) 1999-2014, by Zend Technologies
    with Xdebug v2.2.5, Copyright (c) 2002-2014, by Derick Rethans
</code>

Följde sedan guiden för composer. Det fungerade utan problem på studentservern. Installerade det även på min egen miljö och lade det i /usr/bin/composer (döpte om composer.phar till composer för att det skall se likadant ut i både min egen miljö och på studentservern. det blir enklare så). 