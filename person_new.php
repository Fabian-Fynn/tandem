
<?php
include "menu.php";
	//$dbh = new PDO($DSN, $DB_USER, $DB_PASS);




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

	//if(!isset($_POST['email']) || preg_match('/^[A-Z0-9._-]+@fh-salzburg.ac.at/g',$_POST['email']) == 0)
	//	$error += 1000;
	//if(isset($_POST['password']) && strlen($_POST['password']) >= 5 && strlen($_POST['password']) <= 10)
		$hashedPw = hashPasswordSecure($_POST['password']);
	//else
	//	$error += 10000;

	$key = md5(microtime().rand());
	//echo($key);
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
		
		sendActivationMail($_POST['email'], $_POST['firstname'], $key);
	} catch(Exception $e)
	{
		$error += 100000;
	}
	if($error == 0)
		header("Location: home.php");
	
	else{
		$_SESSION['error'] = $error;
		header("Location: index.php");
	}
}






?>
<div class = "wrap">
	
</div>

<?php
include "footer.php";
?>