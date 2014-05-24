<?php
	
   include "functions.php";
	 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
		if(isset ($_POST['altMail']) && !isset($_POST['mail']))
	{
		$uMail = $_POST['altMail'];
		$altLogin = true;
	}
	else
	{
		$uMail = $_POST['mail'];	
		$altLogin = false;
	}
	
	

	$sth = $dbh->prepare("SELECT * FROM user WHERE email = ? AND active = 1");
			$sth->execute(
			  array(
			  	$uMail
				)

			 ); 

	$person = $sth->fetch();
	$pWord = $_POST['pwd'];

	if( $person != false) {
		if(verifyPw($pWord, $person->password)){
			$_SESSION['user'] = $person->firstname;
			$_SESSION['id'] = $person->id;
			echo 'true';
		}
		else
			echo 'false';
		}
	else {
		echo 'false';
	}
   if($altLogin)
		header('Location: home.php');
}
?>
