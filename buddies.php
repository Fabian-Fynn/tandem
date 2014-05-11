
<?php
	include "menu.php";
	if(! isset($_SESSION['id']))
	{
		header('Location: index.php');
	}

	$id = $_SESSION['id'];
	
	/* Get others Requests */
	$oRequests = $dbh->query("Select u.* FROM user u, partner p WHERE u.id = p.personA AND p.personB = $id AND p.status = 0");
	/* Get my Requests */
	$mRequests = $dbh->query("Select u.* FROM user u, partner p WHERE u.id = p.personB AND p.personA = $id AND p.status = 0");

	

	/* Get Buddies */
	$buddies1 = $dbh->query("Select personA as id FROM partner WHERE personB = $id AND status = 1");
	$buddies2 = $dbh->query("Select personB as id FROM partner WHERE personA = $id AND status = 1");

    $allBuddies = new AppendIterator;
    $allBuddies->append(new IteratorIterator($buddies1));
    $allBuddies->append(new IteratorIterator($buddies2));

    
	$buddylist = "";
	foreach ($allBuddies as $buddy) 
		$buddylist .= ",".$buddy->id;

    $buddylist = substr($buddylist, 1);
	if($buddylist != null)
    {
	   $buddies = $dbh->query("Select * FROM user WHERE id IN ($buddylist)");
	   
	   
	}
	
?>
<script>
	
	window.onload = function(){
	    $('a.req').click(function (e) {e.preventDefault(); });
	};
	
</script>

	<div class = "wrap">
		<div class="requestblock">
		<h1>Fremde Anfragen</h1>

		<?php 
			if(Count($oRequests) > 0): ?>

		<?php 
		
		foreach ($oRequests as $r):
			?>
		
		<div class = "request">
			<img src="http://multimediatechnology.at/~fhs36101/mmp1/profilePics/<?php echo ($r->avatar)  ?>">
			<a href="profil.php?id=<?php echo($r->id) ?>"><p><?php echo($r->firstname." ".$r->surname) ?></p></a>
			<a class="req" href="profil.php?id=<?php echo($r->id) ?>" ><button onclick='acceptRequest(<?php echo($r->id); ?>)'> Annehmen </button></a>
		</div>
		
		<?php
		endforeach; 
		else:

		?>
		<p>Du hast noch keine Buddies!</p>



		<?php 

		
		endif;
		?>
	</div>
	<div class="requestblock">
		<h1>Deine Anfragen</h1>

		<?php 
			if(Count($mRequests) > 0): ?>

		<?php 
		
		foreach ($mRequests as $r):
			?>
		
		<div class = "request" id="request_<?php echo($r->id); ?>">
			<img src="http://multimediatechnology.at/~fhs36101/mmp1/profilePics/<?php echo ($r->avatar)  ?>">
			<a href="profil.php?id=<?php echo($r->id) ?>"><p><?php echo($r->firstname." ".$r->surname) ?></p></a>
			<a class="req" href="profil.php?id=<?php echo($r->id) ?>" ><button onclick='abortRequest(<?php echo($r->id); ?>)'> Anfrage abbrechen </button></a>
		</div>
	
		<?php
		endforeach; 
		else:

		?>
		<p>Du hast noch keine Buddies!</p>



		<?php 

		
		endif;
		?>
	</div>
	<div class="requestblock">
		<h1>Deine Buddies</h1>
		<?php 
			if($buddylist != null): ?>

			
			<br><br>
		<?php 
		
		foreach ($buddies as $buddy):
			?>
		<a href="profil.php?id=<?php echo($buddy->id) ?>">
		<div class = "match">
			<img src="http://multimediatechnology.at/~fhs36101/mmp1/profilePics/<?php echo ($buddy->avatar)  ?>">
			<p><?php echo($buddy->firstname." ".$buddy->surname) ?></p>
			
		</div>
		</a>
		<?php
		endforeach; 
		else:

		?>
		<p>Du hast noch keine Buddies!</p>



		<?php 

		
		endif;
		?>
	</div>
	</div>
	
<?php
    include "footer.php";
?>