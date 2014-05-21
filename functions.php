<?php

    include "config.php";
	 session_start();

    if( ! $DB_NAME ) die('please create config.php, define $DB_NAME, $DB_USER, $DB_PASS there');

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASS);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
        $dbh->exec('SET CHARACTER SET utf8') ;
    } catch (Exception $e) {
        die("Problem connecting to database $DB_NAME as $DB_USER: " . $e->getMessage() );
    }
	
	if(isset($_SESSION['USER']))
	{
		$loggedin = "Logout";
		$id = $_SESSION['id'];
	}

	
	
	

	function formValid($edit){
		GLOBAL $_POST;
		 include "config.php";
		GLOBAL $error;
		
		try {
			$dbh = new PDO($DSN, $DB_USER, $DB_PASS);
			$dbh->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
			$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
		} catch (Exception $e) {
        	die("Problem connecting to database $DB_NAME as $DB_USER: " . $e->getMessage() );
		  }
		//if( $_POST['isfemale'] != 0 || $_POST['isfemale'] != 1 || $_POST['isfemale'] === null ) {
		//	throw (new Exception( "Bitte geben Sie das Geschlecht an." ));
				
		//}
		if( $_POST['firstname'] == ''){ $error .= "<li>Bitte geben Sie den Vornamen an.</li>";}
		if( $_POST['surname'] == ''){ $error .= "<li>Bitte geben Sie den Nachnamen an.</li>";}
		
		if($edit == false)
		{
			$sth  = $dbh->prepare( "SELECT * FROM user WHERE email=?" );
			$sth->execute(array( $_POST['email']));
			$p = $sth->fetch();
		
			if($p != false){ $error .= "<li>Die angegebene E-Mail-Adresse ist gereits vergeben.</li>";}
		}
		
		
		$_POST['firstname'] = strip_tags ( $_POST['firstname'], '<b><p>' );
		$_POST['surname'] = strip_tags ( $_POST['surname'], '<b><p>' );
		
		if(isset($_POST['description'])){$_POST['description'] = strip_tags ( $_POST['description'], '<b><p>' );}
		
		
		
		
		if($error == ''){
			return true;
		}
			
		return false;
		}


	function matches($dbh, $id){
	$var = "";

	$offer = $dbh->query("Select course FROM offer WHERE teacher=$id");
	$search = $dbh->query("Select course FROM search WHERE student=$id");


		
		//echo("not empty");
		$aOffer[] = $var;
		foreach ($offer as $course) 
			array_push($aOffer, $course->course);
		if(Count($aOffer) == 1)
			return null;

		$aOffer = implode(',', $aOffer);
		$aOffer = substr($aOffer, 1);
		$students = $dbh->query("Select student FROM search WHERE course IN ($aOffer)");

	    $bSearch[] = $var;

	    foreach ($students as $student) {
	    	if($student->student != $id)
	    		array_push($bSearch, $student->student);
	    }
		    

		
		
		$aSearch[] = $var;
		foreach ($search as $course) 
			array_push($aSearch, $course->course);
		
		if(Count($aSearch) == 1)
			return null;	

		$aSearch = implode(',', $aSearch);
		$aSearch = substr($aSearch, 1);
		//echo("::::::::::".Count($aSearch));
		$teachers = $dbh->query("Select teacher FROM offer WHERE course IN ($aSearch)");

    	$bOffer[] = $var;

    	foreach ($teachers as $teacher) {
    		if($teacher->teacher != $id)
    			array_push($bOffer, $teacher->teacher);
    	}
    	 $allmatches = array_intersect($bSearch, $bOffer);

    	 $buddies = GetBuddies($dbh, $id);
    	if($buddies != null):
    	$buddyArray[] = $var;
		foreach ($buddies as $b)
			{

 			   array_push($buddyArray, $b->id);
			}

		
			return array_diff($allmatches, $buddyArray);
	
	endif;
	return $allmatches;
}
	    //bSearch => alle die suchen was ich anbiete
    //bOffer => alle die anbieten was ich suche

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
		array_push($errors, "Your FHS-Email is invalid");
		$error -= 1000;
	}
	if($error % 100000 != 0)
	{
		array_push($errors, "Your Password is invalid");
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
 width: 200px;
 margin: 0 auto;
}
</style>
<body>
 
<img src='".$url."/img/logo_new.png'>
<div style='width: 200px;margin: 0 auto'>
<h1 style='font-family: sans-serif'>Hallo ".$firstname."</h1>
<p style='font-family: sans-serif; font-size: 12px;'>Um die Anmeldung erfolgreich abzuschlie&szlig;en ist es erforderlich, dass du deine E-Mail-Adresse best&auml;tigst.
 <br>Klicke dazu bitte auf den folgenden <a href='".$url."/index.php?key=".$key."'>Link</a></p>
</div>
</body>
</html>";
 
$from   = "Meine Lieblingorte";
$subject    = "Kontoaktvierung";
 
$header  = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
 
$header .= "From: $from\r\n";
$header .= "Reply-To: s.hintersonnleitner@chello.at\r\n";
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
