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

Följde sedan guiden för composer. Det fungerade utan problem på studentservern. Installerade det även på min egen miljö och lade det i /usr/bin/composer (döpte om composer.phar till composer för att det skall se likadant ut i både min egen miljö och på studentservern. Det blir enklare så).

Browsade runt i koden för "comment controller" komponenten. Insåg ganska snabbt att det skulle behövas en hel del förändringar i komponenten för att få till editering och borttagning av inlägg/kommenterar samt att få det att fungera på valfri sida. Jag ville inte koda om själva komponenten eftersom man då får problem om man tar ner en uppdaterad variant av den senare. Istället valde jag att göra utökningar (subklasser) av CommentController och CommentsInSession som jag lade under /app/Comment/. Det resulterade i följande:

* CPageCommentController, ärver från CommentController och har utökat stöd för editering och radering av specifika inlägg. Har också stöd för koppla inlägg till en specifik sida
* CPageCommentsInSession, ärver från CommentsInSession och har adderat stöd för att spara kommentar i valbar sessions-variabel. På så sätt kan olika sidor ha sina egna kommentarer

Det visade sig till slut att det stöd som fanns i komponeten, "comment controller", inte gick att återvända så mycket av. Det blev antingen nya metoder i mina subklasser eller överridna (override). Hade varit bra om det hade funnits lite bättre stöd i ursprungskomponenten så att man inte behövde göra om det mesta. Då faller lite idén med att använda externa komponenter. 
För att konfigurera CommentController så gjorde jag en egen klass för "dependency injection", CDIApplicationDefault under /app/src/, som är en subklass till CDIFactoryDefault.php. I denna klassen definierar man egna controllers för applikationen. Det ger ett smidigt sätt att bygga vidare på CDIFactoryDefault.php istället för att uppdatera den. Här skapas 2 stycken instanser av "CPageCommentController", en för varje sida där man vill ha kommentarer, med namnen:

* GuestBookController, hanterar kommentarar för gästbok sidan
* MeController, hanterar kommentarer för me-sidan

Gjorde också egna vyer i /app/view/comment/ som renderar HTML för alla delar i kommentatorsystemet.

Slutligen gjorde jag en klass CGravatar, under /app/src/Gravatar/, som hämtar en gravatar från http://wwww.gravatar.com baserat på en anvädares mailadress. Jag valde att lägga detta i en egen klass för att kunna återanvända den i framtiden. CPageCommentController använder CGravatar för att hämta avatar från gravatar.
