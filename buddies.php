
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
			if(Count($oRequests) > -1): ?>

		<?php 
		
		foreach ($oRequests as $r):
			?>
		
		<div class = "request">
			<img src="img/profilePics/<?php echo ($r->avatar)?>">
			<a href="profil.php?id=<?php echo($r->id) ?>"><p><?php echo($r->firstname." ".$r->surname) ?></p></a>

			<form id="acceptForm_<?php echo($r->id); ?>" action="request.php" method="post">
				<div id="sendRequest">
				<input type="hidden" name="partner" id="partner" value="<?php echo($r->id); ?>">
				<input type="hidden" name="reqAct" id="reqAct" value="accept">
		        <input type="submit" value=" Anfrage annehmen " class="submit" id="submitRequest" >
				</div>
					<div id="add_err"></div>
			</form>
			<form id="abortForm_<?php echo($r->id); ?>" action="request.php" method="post">
				<div id="sendRequest">
				<input type="hidden" name="partner" id="partner" value="<?php echo($r->id); ?>">
				<input type="hidden" name="reqAct" id="reqAct" value="abort">
		        <input type="submit" value=" Anfrage ablehnen " class="submit" id="submitRequest" >
				</div>
					<div id="add_err"></div>
			</form>
			
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
		//$mRequestst = (array)$mRequests;
			//if(empty($mRequestst)): ?>
			
		<?php 
		$requestCount = 0;
		foreach ($mRequests as $r):
			$requestCount++;
			?>
		<div class = "request" id="request_<?php echo($r->id); ?>">
			<img src="img/profilePics/<?php echo ($r->avatar)?>">
			<a href="profil.php?id=<?php echo($r->id) ?>"><p><?php echo($r->firstname." ".$r->surname) ?></p></a>
			<form id="abortForm_<?php echo($r->id); ?>" action="request.php" method="post">
				<div id="sendRequest">
				<input type="hidden" name="partner" id="partner" value="<?php echo($r->id); ?>">
				<input type="hidden" name="reqAct" id="reqAct" value="abortList">
		        <input type="submit" value=" Anfrage abbrechen " class="submit" id="submitRequest" >
				</div>
					<div id="add_err"></div>
			</form>
		</div>
	
		<?php
		endforeach; 
		//else:
		if($requestCount == 0 ):
		?>
		<p>Du hast momentan keine Anfrage</p>



		<?php 

		
		endif;
		?>
	</div>
	<div class="requestblock">
		<h1>Deine Buddies</h1>
		<?php 

		if(isset($buddies)):
			 ?>

			
			<br><br>
		<?php 
		$requestCount = 0;
		foreach ($buddies as $buddy):
			
			$requestCount++;
		?>
		<a href="profil.php?id=<?php echo($buddy->id) ?>">
		<div class = "match">
			<img src="img/profilePics/<?php echo ($buddy->avatar)?>">
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