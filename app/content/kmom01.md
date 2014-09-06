Kmom01: PHP-baserade och MVC-inspirerade ramverk
------------------------------------
 
Min utvecklingsmiljö är för närvarande på windows. Jag kör WAMP-server och sublime text som editor. All filöverfölring gör jag med FileZilla. Har även en Linuxmiljö 
som jag kör på emellanåt. Det består av en Ubuntu distribution där jag har installerat JEdit och LAMPP.

Jag har tidigare jobbat med ramverk och även implementerat ramverk. När det gäller MVC så har jag jobbat med detta tidigare i bl.a. java, men även närbesläktade varianter av 
MVC för inbyggda system. Har sett både bra och dåliga appliceringar av ramverk. De kan lätt bli överarbetade och självuppfyllande och det gäller att inte tappa bort vad det 
egentliga syftet med projektet är (syftet är ju oftast inte ramverket i sig utan det är ett medel för att slippa återupprepa sig och lösa frekvent förekommande problem).

När det gäller begreppen som introducerades, tänker då främst på dependency injection, så kände jag inte till just detta men har titigare läst en hel del om olika designmönster,
bl.a. "Robert C. Martin's (Uncle Bob's) Dependency inversion". Det påminner om dependency injection på så vis att man skall ha beroende till abstraktioner och inte konkreta klasser/objekt. Upptäckte också
att jag i förra kursen, OOPHP, använde mig oventandes av detta då jag skapade objekten i mina page controllers och skickade in dem som objekt i andra klassers konstruktorer. Använde mig
inte av interface (abstracta klasser) dock, men det kan bli nästa steg. 

Jag började detta moment med att läsa de rekommenderade artiklarna. Gillade PHP the right way. Det jag fastnade för här var pear kodningsregler. Tycker det är viktigt
att koda med samma stil (kan vara svårt även om man skriver all kod själv faktiskt). Men att ha samma stil i koden gör att man känner igen sig. Det är extra viktigt i 
större mjukvaruprojekt med många utvecklare. Då är det viktigt att man förstår vad andra utvecklare kodat. Koden skriver man för datorn, men även för andra utvecklare som kan behöva
ändra eller bygga ut det man gjort. För egen del har jag inte följt de kodningsregler som beskrevs av pear fullt ut, men kommer i och med denna kursen att försöka att följa pear-reglerna.

Efter läsningen gjorde jag guiden för "Bygg en-me-sida med Anax MVC". Guiden var lätt att följa och jag hade inga större problem att få ihop det. Det som vållade mest problem var 
de snygga länkarna. Jag fick det att fungera på BTH:s labbmiljö, men inte på min lokala webserver. 

Tycker det är smidigt och kraftfullt med Anax-MVC. Det är mer komplicerat än Anax som vi använde i OOPHP kursen och tar längre tid att komma in i. Det kändes lite onaturligt i början med vyerna och det blev många filer att editera i, både vyer och olika config-filer, men efter ett tag började strukturen sätta sig och man börjar förstå vilka delar som gör vad. Då blev det väldigt enkelt att lägga till nya vyer, navigeringsmenyer eller byline.

För att få extra träning så valde jag att göra extrauppgifterna där jag lade in min kalender och tärningsspelet 100 under en egen meny (diverse). Fick uppdatera klasserna så att de använder namespace, vilket gick bra för både kalendern och tärningsspelet. Däremot fick jag problem med tärningsspelet eftersom det använde sig av session för att spara spelets poäng. Lösningen blev att jag bytte sessionshantering till att använda Anax-MVC:s session-klass och skickar in den som argument till tärningsspelet.

Denna övning har gett en bra introduktion till Anax-MVC, jag har inte full koll på ramverket än och kommer att behöva läsa koden i ramverket fler gånger innan jag känner att jag har bra koll på det.   

