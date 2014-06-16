<?php
/*TANDEM is a second semester project (MultiMediaProjekt 1) of the course Multimedia Technology at University of Applied Sciences Salzburg

Author: Fabian Hoffmann
Course of Study: Multimedia Technology
At: University of Applied Sciences Salzburg

fhoffmann.mmt-b2013@fh-salzburg.ac.at

"Icons made by Icons8, Freepik and Designerz Base from Flaticon.com / partly modified"

"Index picture made by CollegeDegrees360 from Flickr.com"
*/
	include 'menu.php';
	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}

	$dbh->exec("DELETE FROM user WHERE email LIKE  '%test.at'"); //keine beeinflussbare Variable
	header('Location: createusers.php');
?>