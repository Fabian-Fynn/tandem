<?php
/*TANDEM is a second semester project (MultiMediaProjekt 1) of the course Multimedia Technology at University of Applied Sciences Salzburg

Author: Fabian Hoffmann
Course of Study: Multimedia Technology
At: University of Applied Sciences Salzburg

fhoffmann.mmt-b2013@fh-salzburg.ac.at

"Icons made by Icons8, Freepik and Designerz Base from Flaticon.com / partly modified"

"Index picture made by CollegeDegrees360 from Flickr.com"
*/
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
  	$stm = $dbh->query("Select COUNT(*) AS c FROM partner WHERE personA IN (".$partner.",".$id.") AND personB IN (".$partner.",".$id.")");
	$isbuddy = $stm->fetch();		
	
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
    	header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	if($reqAct != "unfriend" && $reqAct != "abort" && $reqAct != "abortList"):

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
		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	endif;
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>