Kmom02: Kontroller och modeller
------------------------------------
 
Jag började med att göra guiden för CLI kommandon. Körde lokat först på min egen Linux-maskin (Ubuntu). Här hade jag version 5.5.9.:
<code>
<br/><br/>herb@rigel:~$ php --version
<br/>PHP 5.5.9-1ubuntu4.3 (cli) (built: Jul  7 2014 16:34:16)
<br/>Copyright (c) 1997-2014 The PHP Group
<br/>Zend Engine v2.5.0, Copyright (c) 1998-2014 Zend Technologies
<br/>    with Zend OPcache v7.0.3, Copyright (c) 1999-2014, by Zend Technologies
</code>

Loggade också in på student servern och körde samma kommando vilket gav version 5.9.16:
<code>
<br/><br>herb13@seekers: php --version
<br/>PHP 5.5.16-1~dotdeb.1 (cli) (built: Aug 22 2014 14:41:51)
<br/>Copyright (c) 1997-2014 The PHP Group
<br/>Zend Engine v2.5.0, Copyright (c) 1998-2014 Zend Technologies
<br/>    with Zend OPcache v7.0.4-dev, Copyright (c) 1999-2014, by Zend Technologies
<br/>    with Xdebug v2.2.5, Copyright (c) 2002-2014, by Derick Rethans
</code>

Följde sedan guiden för composer. Det fungerade utan problem på studentservern. Installerade det även på min egen miljö och lade det i /usr/bin/composer (döpte om composer.phar till composer för att det skall se likadant ut i både min egen miljö och på studentservern. det blir enklare så).

Hade sedan en hel del problem när jag skulle peka om webläsaren till page-with-comments.php och felutskriften indikerade att det var problem att ladda klassen CommentController. Felsökte detta länge och gick igenom autoloader i /vendor och även min /app/autoloader.php, men kund inte hitta något fel. Det visade sig att filerna under /vendor/php/mvc/comment/ inte pushades upp till mitt phpmvc-me-repo Github (de undantogs i regeln vendor/.git i .gitignore). Så när jag klonade mitt repo till driftservern så fanns inte filerna med (därför hittades de inte av autoloadern). Jag gjorde då ett ett litet script som först klonar mitt eget repo ner till driftservern och sedan Mikaels repo för phpmv-comment. 
