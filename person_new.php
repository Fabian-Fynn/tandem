
<?php
include "menu.php";
	//$dbh = new PDO($DSN, $DB_USER, $DB_PASS);




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$date = date('Y-m-d H:i:s');
	if($_POST['isfemale'] == 0)
		$avatar = "male_avatar.png";
	else
		$avatar = "female_avatar.png";

	$hashedPw = hashPasswordSecure($_POST['password']);
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
				$hashedPw,
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






?>
<div class = "wrap">
	
</div>

<?php
include "footer.php";
?>