Sehr geehrter Herr Hoffmann,

Sie haben ein sehr professionelles, umfrangreiches Projekt gemacht.
Ich glaub sie haben das alleine implementiert, was vor 2 Jahren vier
Leute (2MMT+2MMA) als Abschlussprojekt gemacht haben.  Respekt!


### Offene Fragen:

Was ist 00000000profilePic.php? und warum ist es im git?

Warum überprüfen Sie immer  if ($_SERVER['REQUEST_METHOD'] == 'POST')? 
Es reicht doch in $_POST nachzusehen ob die Werte gesetzt und valide sind?

### TODO (muss):

Alle nicht benötigten Dateien aus dem Repository raus. z.B.  Dateien der Entwicklungsumgebung.

Prepared Statements verwenden! 

### TODO (kann):

z.B. in head.php ist JavaScript direkt in HTML/PHP einbettet.  Schöner wär es
alles Javascript extern zu haben.  

Refactoring: eine eine checkMail Funktion definiere, in der dann das hier: 
if(!isset($_POST['email']) || preg_match('/[\w-.]+@fh-salzburg\.ac\.at$/', $_POST['email']) == 0 || checkMail($_POST['email']) == false)
weg-versteckt ist.

### Bonuslevel:

schaffen sie es die Funktion matches() in der Datei matches.php:95
radikal zu vereinfachen?  indem sie die Logik "alle leute die zeug anbieten dass ich haben will" in eine SQL-Query packen?
und eine zweite Query für "alle leute die zeug haben wollen das ich anbiete"?
das wäre sehr cool wenn Sie das umsetzten, dann können sie auch einen kurzen Vortrag drüber halten am 17.

### Schlussworte

haben wir schon gesagt wie SCHÖN die webseite ist?  super!

lg

Hannes Moser und Brigitte Jellinek
