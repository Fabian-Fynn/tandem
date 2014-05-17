<?php
	include "functions.php";

    if(!isset($_SESSION['id']))
	{
		header('Location: index.php');
	}
	$id = $_SESSION['id'];
	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		$reqAct = $_POST['reqAct'];
		$partner = $_POST['partner'];
	}
	else
	{
		$reqAct = "abort";
		$partner = $_GET['partner'];
	}
 	//
      	$stm = $dbh->query("Select COUNT(*) AS c FROM partner WHERE personA IN (".$partner.",".$id.") AND personB IN (".$partner.",".$id.")");
		$isbuddy = $stm->fetch();

		//$state = $dbh->query("Select status AS s FROM partner WHERE personA = ".$partner." AND personB = ".$id."");
		
		
		
		if($reqAct == "accept")
			$status = 1;
		if($reqAct == "send")
			$status = 0;

		

		try{
			   
			   $sth = $dbh->prepare("Delete FROM partner WHERE personA IN (:me, :other) AND personB IN (:me, :other)");
				
			   
				 	$sth->execute(
					  array(":me" => $id, ":other" => $partner)
					); 
				
			
			   
			   
		    } catch (Exception $e) {
				die("Problem with updating Data!" . $e->getMessage() );
			}

		if($reqAct != "unfriend" && $reqAct != "abort"):

	       	$sth = $dbh->prepare(
			  "INSERT INTO partner
				(id, personA, personB, status)
				  VALUES
				(NULL, ?,     ?,      ?)");
			$array = $_POST;
			
			$sth->execute(
				array(
				  	$id,
					$partner,
					$status
			    )
			); 	
			
		endif;
			
		header('Location: ' . $_SERVER['HTTP_REFERER']);
 	//}



	echo ('false');
?>
