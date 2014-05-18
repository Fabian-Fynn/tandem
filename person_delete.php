<<<<<<< HEAD
<?php
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
					header("Location: profil.php");
			   
			   
		    } catch (Exception $e) {
				die("Problem with updating Data!" . $e->getMessage() );
			}

	}
	
	

	
?>

</style>
<div class = "wrap">
		
	<section class="profileTop">
		<div class="userName"><h1>Account löschen</h1></div>
		<article class="left">
				<h2></h2>
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

=======
<?php
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
					header("Location: profil.php");
			   
			   
		    } catch (Exception $e) {
				die("Problem with updating Data!" . $e->getMessage() );
			}

	}
	
	

	
?>

</style>
<div class = "wrap">
		
	<section class="profileTop">
		<div class="userName"><h1>Account löschen</h1></div>
		<article class="left">
				<h2></h2>
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

>>>>>>> a908716f4aa8316342e499059fb3aa80f57c7b16
