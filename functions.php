<?php
/*TANDEM is a second semester project (MultiMediaProjekt 1) of the course Multimedia Technology at University of Applied Sciences Salzburg

Author: Fabian Hoffmann
Course of Study: Multimedia Technology
At: University of Applied Sciences Salzburg

fhoffmann.mmt-b2013@fh-salzburg.ac.at

"Icons made by Icons8, Freepik and Designerz Base from Flaticon.com / partly modified"

"Index picture made by CollegeDegrees360 from Flickr.com"
*/
include "config.php";
session_start();

checkDB();

if(isset($_SESSION['USER']))
{
	$loggedin = "Logout";
	$id = $_SESSION['id'];
}

function formValid($edit){
	GLOBAL $_POST;
	include "config.php";
	GLOBAL $error;
	
	checkDB();

	if( $_POST['firstname'] == ''){ $error .= "<li>Bitte geben Sie den Vornamen an.</li>";}
	if( $_POST['surname'] == ''){ $error .= "<li>Bitte geben Sie den Nachnamen an.</li>";}
	
	$_POST['firstname'] = strip_tags ( $_POST['firstname'], '' );
	$_POST['surname'] = strip_tags ( $_POST['surname'], '' );
	if(isset($_POST['city']))
	{
		$_POST['city'] = strip_tags ( $_POST['city'], '' );
	}
	if(isset($_POST['studienfach']))
	{
		$_POST['studienfach'] = strip_tags ( $_POST['studienfach'], '' );
	}
	
	
	if(isset($_POST['studienjahr']) && preg_match('/[0-9]*/', $_POST['studienjahr']) == 0)
	{
		return false;
	}
	if(isset($_POST['description']))
	{
			$_POST['description'] = strip_tags ( $_POST['description'], '<b><p><br><u><i><style><strong>' );
	}
	
	
	if($error == '')
	{
		return true;
	}	
}

function checkMail($mail)
{
	include "config.php";
	
	checkDB();

	$sth  = $dbh->prepare( "SELECT * FROM user WHERE email=?" );
			$sth->execute(array( $_POST['email']));
			$p = $sth->fetch();
	if($p != false)
		return false;

	if(preg_match('/[\w-.]+@fh-salzburg\.ac\.at$/', $mail) == 0 )
		return false;
	
	return true;
}
function matches($dbh, $id){
	$var = "";

 	//Get my students
	$sth = $dbh->prepare("Select student FROM search WHERE course IN (Select course FROM offer WHERE teacher=?)");
		$sth->execute(array(  $id));
	$students = $sth->fetchAll();

	//To array
	$bSearch[] = $var;
	foreach ($students as $student) {
		array_push($bSearch, $student->student);
	}

	//Get my teachers
	$sth = $dbh->prepare("Select teacher FROM offer WHERE course IN (Select course FROM search WHERE student=?)");
		$sth->execute(array(  $id));
	$teachers = $sth->fetchAll();

	//To array
	$bOffer[] = $var;
	foreach ($teachers as $teacher) {
		array_push($bOffer, $teacher->teacher);
	}

	//Combine the arrays
	$allmatches = array_intersect($bSearch, $bOffer);

	//Get my buddies and kick them from list
	$buddies = GetBuddies($dbh, $id);
	if($buddies != null):
		$buddyArray[] = $var;
		foreach ($buddies as $b){
		   array_push($buddyArray, $b->id);
		}

		return array_diff($allmatches, $buddyArray);
	endif;
	return $allmatches;
}

   function GetBuddies($dbh, $id)
	{

	/* Get Buddies */
	$buddies1 = $dbh->query("Select personA as id FROM partner WHERE personB = $id AND status = 1");
	$buddies2 = $dbh->query("Select personB as id FROM partner WHERE personA = $id AND status = 1");

    $allBuddies = new AppendIterator;
    $allBuddies->append(new IteratorIterator($buddies1));
    $allBuddies->append(new IteratorIterator($buddies2));

	$buddylist = "";
	foreach ($allBuddies as $buddy) 
		$buddylist .= ",".$buddy->id;

	if($buddylist != "")
	{
    	$buddylist = substr($buddylist, 1);
	   	$sth = $dbh->query("Select * FROM user WHERE id IN ($buddylist)");
	   	
	    return $sth->fetchAll();
	}
	return null;
	}
 
/* Code by Simon Hintersonnleitner */
function hashPasswordSecure($pw)
{
  $cost = 10;
  $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
  $salt = sprintf("$2a$%02d$", $cost) . $salt;
  return crypt($pw, $salt);
}

function verifyPw($pw,$pwFromDB)
{
  if(crypt($pw, $pwFromDB) === $pwFromDB)
  {
    return true;
  }
  return false;
}
function checkSession(){
	if(! isset($_SESSION['id']))
	{
		header('Location: index.php');
	}
}
function checkDB() {
	    if( ! $DB_NAME ) die('please create config.php, define $DB_NAME, $DB_USER, $DB_PASS there');

	    try {
	        $dbh = new PDO($DSN, $DB_USER, $DB_PASS);
	        $dbh->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
	        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
	        $dbh->exec('SET CHARACTER SET utf8') ;
	    } catch (Exception $e) {
	        die("Problem connecting to database $DB_NAME as $DB_USER: " . $e->getMessage() );
	    }
	}
	

/**
 *
 * @author    Patrick W.
 * @website    http://www.it-talent.de
 * @date    02/06/2013
 *
 **/
 function resize($path, $new_path, $new_width, $new_height, $cut, $size = false) {
    /*
     *
     * @description
     *
     * Falls die getimagesize() schon vorliegt, kann sie der Methode
     * übergeben werden, das ist performanter.
     *
     **/
    echo($path);
    $size = ($size) ? $size : getimagesize($path);
 
    $height_skaliert = (int)$size[1]*$new_width/$size[0];
 
    if (($cut) ? ($new_height < $height_skaliert) : ($new_height > $height_skaliert)) {
        $height_skaliert = $height_skaliert;
        $width_skaliert = $new_width;
    } else {
        $width_skaliert = (int)$size[0]*$new_height/$size[1];
        $height_skaliert = $new_height;
    }
 
    switch ($size[2]) {
        case 1:    // GIF
            $image_func = 'imagecreatefromGIF';
            $image_out = 'imageGIF';
            $q = 100;
        break;
 
        case 2:    // JPG
            $image_func = 'imagecreatefromJPEG';
            $image_out = 'imageJPEG';
            $q = 100;
        break;
 
        case 3:    // PNG
            $image_func = 'imagecreatefromPNG';
            $image_out = 'imagePNG';
            $q = 9;
        break;
 
        default:
            return false;
    }
 
    $old_image = $image_func($path);
 
    $new_image_skaliert = imagecreatetruecolor($width_skaliert, $height_skaliert);
    $bg = imagecolorallocatealpha($new_image_skaliert, 255, 255, 255, 75);
    ImageFill($new_image_skaliert, 0, 0, $bg);
 
    imagecopyresampled($new_image_skaliert, $old_image, 0,0,0,0, $width_skaliert, $height_skaliert, $size[0], $size[1]);
 
    if ($cut) {
        $new_image_cut = imagecreatetruecolor($new_width, $new_height);
        $bg = imagecolorallocatealpha($new_image_cut, 255, 255, 255, 75);
        imagefill($new_image_cut, 0, 0, $bg);
        imagecopy($new_image_cut, $new_image_skaliert, 0,0,0,0, $width_skaliert, $height_skaliert);
    }
 
    $image_out(($cut) ? $new_image_cut : $new_image_skaliert, $new_path, $q);
 
    if ($cut) {
        return array($new_width, $new_height, $size[2]);
    } else {
        return array(floor($width_skaliert), floor($height_skaliert), $size[2]);
    }
}   	

function getIndexError($error)
{
	$errors[] = null;
	if($error % 10 != 0)
	{
		array_push($errors, "Your Firstname is invalid");
		$error -= 1;
	}
	if($error % 100 != 0)
	{
		array_push($errors, "Your Surname is invalid");
		$error -= 10;
	}
	if($error % 1000 != 0)
	{
		array_push($errors, "Please select your gender");
		$error -= 100;
	}
	if($error % 10000 != 0)
	{
		array_push($errors, "Your FHS-Email is invalid or already registered.");
		$error -= 1000;
	}
	if($error % 100000 != 0)
	{
		array_push($errors, "Your Password is invalid. At least 5 and at most 10 letters.");
		$error -= 10000;
	}
	if($error % 100000 != 0)
	{
		array_push($errors, "An internal error occurred, we are sorry");
		$error -= 10000;
	}
	array_splice($errors, 0, 1);
	return $errors;
}

function sendActivationMail($mail, $firstname, $key)
{
	try
  	{
 
	    if($_SERVER['HTTP_HOST'] == "multimediatechnology.at")
	    {
	      $url = "http://".$_SERVER['HTTP_HOST']."/~fhs36101/mmp1";
	    }
	    else
	    {
	       $url = "http://".$_SERVER['HTTP_HOST']."/mmp1";
	    }
 
		$message = "
		<html>
		<head>
		 <meta charset='UTF-8'>
		</head>
		<style>
		@import url(http://fonts.googleapis.com/css?family=Raleway:400,300,200;);
		body {
		font-family: 'Raleway', sans-serif;
		font-weight: 300;
		}
		.container {
		 width: 700px;
		 margin: 0 auto;
		}
		</style>
		<body>
		 
		<img src='".$url."/img/nav-brand.png'>
		<div style='width: 200px;margin: 0 auto'>
		<h1 style='font-family: sans-serif'>Hi ".$firstname."</h1>
		<p style='font-family: sans-serif; font-size: 12px;'>Your activation is almost complete. Please click the link below to verify your email address.
		 <br><a href='".$url."/activation.php?key=".$key."'>Click me</a></p>
		</div>
		</body>
		</html>";
 
		$from   = "TANDEM";
		$subject    = "Accountactivation";
		 
		$header  = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
		 
		$header .= "From: $from\r\n";
		$header .= "Reply-To: fhoffmann.mmt-b2013@fh-salzburg.ac.at\r\n";
		$header .= "X-Mailer: PHP ". phpversion();
		 
		if(mail($mail,$subject,$message,$header))
		    echo "true";
		else
		  echo "false";
	}
	catch (Exception $e)
	  {
	    die("Problem with sending email " . $e->getMessage() );
	  }
	}
?>