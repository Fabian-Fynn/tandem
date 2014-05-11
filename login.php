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
		
		$pWord = $_POST['pwd'];
		
		$stm = $dbh->query("SELECT id, email, firstname FROM user WHERE email='".$uMail."' AND password='".$pWord."' ");
		$person = $stm->fetch();
		if( $person != false) {
			$_SESSION['user'] = $person->firstname;
			$_SESSION['id'] = $person->id;
			echo 'true';
			//echo('<script> alert('.$_SESSION['id'].'); </script>');
			}
		else {
			echo 'false';
			//echo('<script> alert("false"); </script>');
		}
       if($altLogin)
			header('Location: home.php');

			 
	
	}
	?>
