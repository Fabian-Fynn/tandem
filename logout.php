<?php
/*TANDEM is a second semester project (MultiMediaProjekt 1) of the course Multimedia Technology at University of Applied Sciences Salzburg

Author: Fabian Hoffmann
Course of Study: Multimedia Technology
At: University of Applied Sciences Salzburg

fhoffmann.mmt-b2013@fh-salzburg.ac.at

"Icons made by Icons8, Freepik and Designerz Base from Flaticon.com / partly modified"

"Index picture made by CollegeDegrees360 from Flickr.com"
*/
    $pagetitle = "Logout";
    include "functions.php";  

	// Löschen aller Session-Variablen.
	$_SESSION = array();
	 
	// Löscht das Session-Cookie.
	if (isset($_COOKIE[session_name()])) {
	  setcookie(
	    session_name(),  // Cookie-Name war gleich Name der Session 
	    '',             // Cookie-Daten. Achtung! Leerer String hier hilft nicht!
	    time()-42000,  // Ablaufdatum in der Vergangenheit. Erst das löscht!
	    '/'           // Wirkungsbereich des Cookies: der ganze Server
	   );
	}
	session_destroy();
	header("Location: index.php");
?>