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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//if($_POST[''])
	$date = date('Y-m-d H:i:s');
	$error = 0;

	if(!isset($_POST['firstname']) || strlen($_POST['firstname']) < 3)
		$error += 1;
	if(!isset($_POST['surname']) || strlen($_POST['surname']) < 3)
		$error += 10;

	if($_POST['isfemale'] == 0)
		$avatar = "male_avatar.png";
	elseif ($_POST['isfemale'] == 1) {
		$avatar = "female_avatar.png";
	}
	else
		$error += 100;
	if(!isset($_POST['email']) || preg_match('/[\w-.]+@fh-salzburg\.ac\.at$/', $_POST['email']) == 0 || checkMail($_POST['email']) == false)
	{
	
		$error += 1000;
	}
	if(isset($_POST['password']) && strlen($_POST['password']) >= 5 && strlen($_POST['password']) <= 10)
		$hashedPw = hashPasswordSecure($_POST['password']);
	else
		$error += 10000;

	$key = md5(microtime().rand());
	
	try{
	$sth = $dbh->prepare(
		"INSERT INTO user
		(id, firstname,surname,email,is_female,password,register_date,avatar, activationKey)
		VALUES
		(NULL,   ?,     ?,        ?,     ?,         ?,        ?,        ?,      ?)");
	$array = $_POST;
	
		$sth->execute(
			array(
				$_POST['firstname'],
				$_POST['surname'],
				$_POST['email'],
				$_POST['isfemale'],
				$hashedPw,
				$date,
				$avatar,
				$key
				)
			); 
		$id = $dbh->lastInsertId(); 
		$_SESSION['id'] = $id;
		if($error == 0)
		{
			sendActivationMail($_POST['email'], $_POST['firstname'], $key);
		}
	} catch(Exception $e)
	{
		$error += 100000;
	}
	if($error == 0)
		header("Location: index.php?msgId=4");
	
	else{
		$_SESSION['error'] = $error;
		header("Location: index.php?msgId=3");
	}
}

?>