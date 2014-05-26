
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

$buddies = getBuddies($dbh, $id);

?>
<script>
$(document).ready(function(){
	$('.submit').click(function (e) {e.preventDefault(); });
)};

</script>
<div class = "wrap">
	<div class="matchbox">
		<div class="requestblock">
			<h1>Other's Requests</h1>
			<br>



			<?php 
			$requestCount = 0;
			foreach ($oRequests as $r):
				$requestCount++;
			?>
			
			<div class = "request">
				<img src="img/profilePics/<?php echo ($r->avatar)?>">
				<a href="profile.php?id=<?php echo($r->id) ?>"><p><?php echo($r->firstname." ".$r->surname) ?></p></a>

				<form id="acceptForm_<?php echo($r->id); ?>" action="request.php" method="post">
					<div id="sendRequest">
						<input type="hidden" name="partner" id="partner" value="<?php echo($r->id); ?>">
						<input type="hidden" name="reqAct" id="reqAct" value="accept">
						<input type="submit" value=" Accept " class="submit" id="submitRequest" >
					</div>
					<div id="add_err"></div>
				</form>
				<form id="abortForm_<?php echo($r->id); ?>" action="request.php" method="post">
					<div id="sendRequest">
						<input type="hidden" name="partner" id="partner" value="<?php echo($r->id); ?>">
						<input type="hidden" name="reqAct" id="reqAct" value="abort">
						<input type="submit" value=" Reject " class="submit" id="submitRequest" >
					</div>
					<div id="add_err"></div>
				</form>
				
			</div>
			
			<?php
			endforeach; 
			if($requestCount == 0 ):

				?>
			<p>You have no Requests.</p>



			<?php 

			
			endif;
			?>
		</div>
		<div class="requestblock">
			<h1>Your Requests</h1>
	 		<br>

			<?php 
			$requestCount = 0;
			foreach ($mRequests as $r):
				$requestCount++;
			?>
			<div class = "request" id="request_<?php echo($r->id); ?>">
				<img src="img/profilePics/<?php echo ($r->avatar)?>">
				<a href="profile.php?id=<?php echo($r->id) ?>"><p><?php echo($r->firstname." ".$r->surname) ?></p></a>

				<form id="abortForm_<?php echo($r->id); ?>" action="request.php" method="post">
					<div >
						<input type="hidden" name="partner" id="partner" value="<?php echo($r->id); ?>">
						<input type="hidden" name="reqAct" id="reqAct" value="abortList">
						<input type="submit" value=" Abort " class="submit" id="submitRequest" >
					</div>
					<div id="add_err"></div>
				</form>
			</div>

			<?php
			endforeach; 
			//else:
			if($requestCount == 0 ):
				?>
			<p>You have not sent any Requests.</p>



			<?php 

			
			endif;
			?>
		</div>
		<div class="requestblock">
			<h1>Your Buddies</h1>
			<br>
			<?php if(isset($buddies)): ?>
	<br>
			<?php 
			$requestCount = 0;
			foreach ($buddies as $buddy):
				
				$requestCount++;
			?>
			<a href="profile.php?id=<?php echo($buddy->id) ?>">
				<div class = "match">
					<img src="img/profilePics/<?php echo ($buddy->avatar)?>">
					<div class="name"><?php echo($buddy->firstname." ".$buddy->surname) ?></div>

				</div>
			</a>
			<?php
			endforeach; 
			
			else:

				?>
			<p>You have no Buddies yet!</p>



			<?php 

			
			endif;
			?>
		</div>
	</div>
</div>

<?php
include "footer.php";
?>
