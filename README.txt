PHP-Projekt "webcam"

webcam.php
----------
Die MySQL-Tabelle 'webcams' beinhaltet die URL und eine kurze Beschreibung fuer mehrere
Webcams. Das Programm ermittelt zuerst die Anzahl der Tabellenzeilen und benutz danach
ein Zufallsgenerator um ein Zeilen-Index zu ermitteln. Die entsprechende Tabellenzeile
wird aus der Tabelle gelesen und die Webcam-Adresse zusammen mit der Beschreibung dazu
wird in HTML-Form als Bild bzw. Text ausgegeben. Die Zeile mit der Beschreibung dient
dabei auch als Hyperlink an die webcam_pflege.php

webcam_pflege.php
-----------------
Das Programm listet alle Webcam-Eintraege auf und bietet die Loeschung bzw. Aenderung
der einzelnen Eintraege an. Ausserdem bietet es ein Link an das Programm zur Erfassung 
eines neuen Webcams bzw. die Anzeige aller Webcams.

webcam_insert.php
-----------------
Erfassung eines neuen Webcams.

webcam_delete.php
-----------------
Loescht ein ausgewaehlter Webcam.

webcam_update.php
-----------------
Aendert ein ausgewaehlter Webcam-Eintrag. ### BISHER NUR DUMMY  ###

webcam_show.php
---------------
Zeigt alle Webcams zusammen.
