
<?php
	include "head.php";
	//$dbh = new PDO($DSN, $DB_USER, $DB_PASS);

	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}
    

 	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       $date = date('Y-m-d H:i:s');
       	if($isfemale == 0)
            $avatar = "male_avatar.png";
        else
        	$avatar = "female_avatar.png";

       $sth = $dbh->prepare(
		  "INSERT INTO user
			(id, firstname,surname,email,is_female,password,register_date,avatar)
			  VALUES
			(NULL,   ?,     ?,      ?,    ?,              ?,?,?)");
		$array = $_POST;
		if(formValid(false))
		{
			$sth->execute(
			  array(
				$_POST['firstname'],
				$_POST['surname'],
				$_POST['email'],
				$_POST['isfemale'],
				$_POST['password'],
				$date,
				$avatar
			  )
			); 
			$id = $dbh->lastInsertId(); 
			$_SESSION['id'] = $id;
			header("Location: home.php");
		}
		else{
			header("Location: person_new.php?error=$error");
		}
 }




include "menu.php";

?>
<div class = "wrap">
	
	</div>
	
<?php
    include "footer.php";
?>