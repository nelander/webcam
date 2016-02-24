Die Datei Zugangsdaten.php beinhaltet die Zugangsdaten, die für den Zugriff auf 
den MySQL-Server DB2447799 beim Provider (hier Strato) bzw. im Test benötigt werden. 

Die PHP-Programme beinhalten dann folgende Anweisung: "require_once 'Zugangsdaten.php';".
Damit werden die Konstanten im Programm inkludiert. Der Vorteil dieses Vorgehens ist, 
dass die Programme für den Einsatz auf dem Testrechner bzw. beim Provider nicht verändert 
werden muessen.

Die Datei Zugangsdaten.php mit den Zugangsdaten vom Provider befindet sich in unserem Fall
im Ordner "E:\www_nelander_de\privat" bzw. auf dem Strato-Webserver für den Domain 
"www.nelander.de" im Unterordner "/privat".

Die Datei Zugangsdaten.php mit den Zugangsdaten für den Testbetrieb auf dem lokalen 
MySQL-Server "localhost" befindet sich im Projektordner(z.B. E:\xampp\htdocs\php-projects). 


Die Datei Zugangsdaten.php sieht wie folgt aus (hier jedoch mit anonymisierten Zugangsdaten):

	<?php
		//
		//  Konstanten fuer den MySQL-Server und die Zugangsdaten
		//
		$db_server   = "xxxxxxxxx";		// Web-Server
		$db_benutzer = "xxxxxxxx";		// MySQL User
		$db_passwort = "xxxxxxxxx";		// MySQL Password
		$db_name     = "xxxxxxxxx";		// MySQL Datenbank
	?>