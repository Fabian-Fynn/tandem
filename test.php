<?php
include "functions.php";
$status = 1;
		$id = $_SESSION['id'];
   		$buddies1 = $dbh->query("Select personA as id FROM partner WHERE personB = $id AND status = $status");
		$buddies2 = $dbh->query("Select personB as id FROM partner WHERE personA = $id AND status = $status");

	    $allBuddies = new AppendIterator;
	    $allBuddies->append(new IteratorIterator($buddies1));
	    $allBuddies->append(new IteratorIterator($buddies2));

	    echo(Count($buddies2));
	    if(Count($allBuddies) > 0)
	    {
	    	$buddylist = "";
	    	foreach ($allBuddies as $buddy) {
	    		$buddylist .= ",".$buddy->id;
	    	}
		    $buddylist = substr($buddylist, 1);

		   $buddies = $dbh->query("Select * FROM user WHERE id IN ($buddylist)");
		}
?>