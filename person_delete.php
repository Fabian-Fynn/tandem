<?php
/*TANDEM is a second semester project (MultiMediaProjekt 1) of the course Multimedia Technology at University of Applied Sciences Salzburg

Author: Fabian Hoffmann
Course of Study: Multimedia Technology
At: University of Applied Sciences Salzburg

fhoffmann.mmt-b2013@fh-salzburg.ac.at

"Icons made by Icons8, Freepik and Designerz Base from Flaticon.com / partly modified"

"Index picture made by CollegeDegrees360 from Flickr.com"
*/
	include "menu.php";
	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}
	$id = $_SESSION['id'];
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	   	try{
		   $sth = $dbh->prepare("DELETE FROM user WHERE id = ?;");
			 	$sth->execute(
				  array($id)
				); 
			
			$_SESSION = array();

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
	    } catch (Exception $e) {
			die("Problem with updating Data!" . $e->getMessage() );
		}
	}
?>

<div class = "wrap">
		
	<section class="profileTop">
		<div class="userName">
			<h1>Account löschen</h1>
		</div>
		<article class="left">
			 <form id="personDelete" action="person_delete.php" method="post">
		        <input type="submit" value=" Account löschen " class="submit" id="submitPersDel">		
			</form>
		</article>
		<article class="right">
		</article>
	</section>
</div>
	
<?php
    include "footer.php";
?>