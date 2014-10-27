Kmom03: Bygg ett eget tema
------------------------------------
Denna upgiften var ganska krävande och innehöll många olika moment. Samtidigt var det svårt att få till bra struktur på LESS koden eftersom man kopierade både CSS-kod och LESS-kod från många olika källor. Det blev mycket kod och det var svårt att gå igenom allt och se till att saker inte fanns med två gånger. Jag gick därför på Mikaels råd i guiden - om det ser ut att fungera så gör det nog det också.

Jag tycker att LESS är väldigt kraftfullt. Mycket trevligt att kunna göra beräkningar och att definiera egenskaper i variabler. Jag har saknat det tidigare och tyck att CSS-koden blivit svårändrad när den väl är på plats. LESS löser detta problem vilket jag tycker är mycket trevligt.

Det jag saknar med LESS och dess kompilator är felutpekningen. Missar man något, t.ex dubbel @ för variabel eller semikolon, så ser man bara att stylen inte blir som man förväntade sig, men det är väldigt svårt att lista ut var i alla .less filer som felet ligger. Man får leta i den genererade style.css och prova sig fram. Det gjorde att denna övning tog mycket tid. 

En sak som jag hade mycket problem med var renderingen då jag inte hade med alla regioner (gjorde 13 st). Då spännde footern över alla de andra regionerna och gjorde att det blev mörk färg mellan regionerna. Det tog tid att hitta vad som var problemet, men det visade sig vara att även min footer hade en flow-layout. Detta löste jag genom att göra rensa flow-layouten innan jag renderar footern.

Annars är jag positiv till grid-layout. det ger en tydlig layout och var sak har sin plats på sidan. Det blir snyggt. Har lite erfarenhet av layout-hantering sedan tidigare eftersom jag progtrammerat mycket med java swing. CSS-baserade ramverk har jag dock ingen erfarenhet av.

Har laddat upp hela mitt projekt på GitHub, allstå inte bara temat. Men det är ett bra sätt att revisions hantera sin kod.

