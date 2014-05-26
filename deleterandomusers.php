<?php
	include 'menu.php';
	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}

	$dbh->exec("DELETE FROM user WHERE email LIKE  '%test.at'");
	header('Location: createusers.php');
?>