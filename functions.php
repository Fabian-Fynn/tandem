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
    	 return array_intersect($bSearch, $bOffer);
	}
    //bSearch => alle die suchen was ich anbiete
    //bOffer => alle die anbieten was ich suche

   function GetBuddies($dbh)
	{
		$status = 1;
		$id = $_SESSION['id'];
   		$buddies1 = $dbh->query("Select personA as id FROM partner WHERE personB = $id AND status = 1");
		$buddies2 = $dbh->query("Select personB as id FROM partner WHERE personA = $id AND status = 1");

	    $allBuddies = new AppendIterator;
	    $allBuddies->append(new IteratorIterator($buddies1));
	    $allBuddies->append(new IteratorIterator($buddies2));

	    echo(Count($buddies2)."||");
	    if(Count($allBuddies) > 0)
	    {
	    	$buddylist = "";
	    	foreach ($allBuddies as $buddy) {
	    		$buddylist .= ",".$buddy->id;
	    	}
		    $buddylist = substr($buddylist, 1);

		   $buddies = $dbh->query("Select * FROM user WHERE id IN ($buddylist)");
		   
	
		}
		
	}

   	

?>
