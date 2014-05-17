
<?php
	include "menu.php";
	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$ownProfile = false;	
	}
	else{
	
	$ownProfile = true;
	$id = $_SESSION['id'];
	}
	$stm = $dbh->query("SELECT * FROM user WHERE id=$id");
  	$person = $stm->fetch();
	
	$user = $person->firstname;

	$date = new DateTime($person->register_date);
	if($person->avatar != null)
	{
		$avatar = $person->avatar;
	}
	else
	{
		$avatar = "profilePic.png";
	}
	$offer = $dbh->query("Select c.name AS course, cat.name AS category FROM category cat, course c, offer o WHERE o.teacher = $id AND o.course = c.id AND c.category = cat.id ");
	$search = $dbh->query("Select c.name AS course, cat.name AS category FROM category cat, course c, search s WHERE s.student = $id AND s.course = c.id AND c.category = cat.id ");
	$stm = $dbh->query("Select COUNT(*) AS c FROM partner WHERE personA IN (".$_SESSION['id'].",".$id.") AND personB IN (".$_SESSION['id'].",".$id.") AND status = 1");
	$aBuddy = $stm->fetch();

	if($aBuddy->c != 0)
		$isbuddy = true;
	else
		$isbuddy = false;
	$stm = $dbh->query("Select COUNT(*) AS c FROM partner WHERE personA = ".$_SESSION['id']." AND personB = ".$id." AND status = 0");
	$mRequest = $stm->fetch();

	$stm = $dbh->query("Select COUNT(*) AS c FROM partner WHERE personB = ".$_SESSION['id']." AND personA = ".$id." AND status = 0");
	$oRequest = $stm->fetch();

	if($mRequest->c != 0)
		$isMyRequest = true;
	else
		$isMyRequest = false;

	if($oRequest->c != 0)
		$isOthersRequest = true;
	else
		$isOthersRequest = false;
	
	if($isbuddy):
	{
		$buddyButton = " Als Buddy entfernen ";
		$reqAct = "unfriend";
	}
	elseif($isMyRequest):
	{
		$buddyButton = " Anfrage abbrechen ";
		$reqAct = "abort";
	}
	elseif($isOthersRequest):
	{
		$buddyButton = " Anfrage annehmen ";
		$reqAct = "accept";	
	}
	else:
	{
		$buddyButton = " Buddyanfrage senden ";
		$reqAct = "send";	
	}
	endif;
?>
<div class="wrap">
		
	<section class="profileTop">
		<div class="userName"><h1><?php echo ($person->firstname." ".$person->surname) ?></h1></div>
		<article class="left"><div class="profilePicContainer">
				<div class="profilePic"><img src="img/profilePics/<?php echo $avatar ?>"></div>

				<?php if($ownProfile): ?>
					<div class="profileInfo"><a href="image_upload.php">Profilbild bearbeiten</a></div> 
					<div class="profileInfo"><a href="person_edit.php">Profil bearbeiten</a></div>
				<?php endif; ?>
				
				<?php
					if($person->studienfach != null)
					{
						echo ('<div class="profileInfo"><strong>Studiengang</strong></div>');
						echo ('<div class="profileInfo">'.$person->studienfach);
					}
					if($person->studienjahr != null)
					{
						echo (' '.$person->studienjahr.'</div>');
					}
					else
					{
						echo ('</div>');
					}
					if($person->city != null)
					{
						echo ('<div class="profileInfo"><strong>Wohnort</strong></div>');
						echo ('<div class="profileInfo">'.$person->city);
					}
					if($isbuddy)
					{
						echo ('<div class="profileInfo"><strong>Kontaktiere '.$person->firstname.'</strong>');
						echo ('<div class="profileInfo"><a href="mailto:'.$person->email.'">'.$person->email.'</a>');
					}
					echo ('<div class="profileInfo"><strong>Mitglied seit</strong></div>');
					echo ('<div class="profileInfo">'.$date->format('d. m. Y'));
				?>
			
			
			
			</div>
		
		</article>
		<article class="right">
			<?php 
				if(!$ownProfile):
				
			?>

			<form id="RequestForm" action="request.php" method="post">
				<div id="sendRequest">
				<input type="hidden" name="partner" id="partner" value="<?php echo($id); ?>">
				<input type="hidden" name="reqAct" id="reqAct" value="<?php echo($reqAct); ?>">
		        <input type="submit" value="<?php echo($buddyButton) ?>" class="submit" id="submitRequest" >
				</div>
					<div id="add_err"></div>
			</form>
			<?php if($isOthersRequest): ?>
				<a class="req" id="reqAbort" href="request.php?partner=<?php echo($id) ?>&reqAct=<?php echo($reqAct); ?>" ><button onclick='abortRequest(<?php echo($id); ?>)'> Anfrage abbrechen </button></a>
			<?php endif; ?>
			<script>
				window.onload = function(){
					$("#RequestForm").submit(function(e){
		    			e.preventDefault();
					});
				};
			</script>
			<?php 
				if($isbuddy):
			?>

				<h2> Ihr seit Buddies!</h2>
			<?php
				endif;
				endif;
			?>			
			<div class="description">
				<h2>Über mich</h2>
					<?php
						if($person->description != null)
						{
							echo ('<div class="profileInfo"><pre>'.$person->description.'</pre></div>');
						}
						else
						{
							echo ('<div class="profileInfo">Leider habe ich noch keine Beschreibung hinzugefügt.</div>');
						}
					?>
			</div>
			<div class="offer">
				<h2 style='margin-bottom:-5px'>Ich biete</h2><?php if($ownProfile): ?><div class="profileInfo"><a href="offer_edit.php?request=o">bearbeiten</a></div><?php endif; ?>
				<?php
						$currentCat = '';
						foreach($offer as $oCourse){
							if($oCourse->category != $currentCat)
							{
								echo ('<div class="profileInfo"><strong>'.$oCourse->category.'</strong></div>');
								$currentCat = $oCourse->category;
							}
							echo ('<div class="profileInfo"><pre>'.$oCourse->course.'</pre></div>');
						}
				?>
			</div>
			<div class="search">
				<h2 style='margin-bottom:-5px'>Ich suche</h2><?php if($ownProfile): ?><div class="profileInfo"><a href="offer_edit.php?request=s">bearbeiten</a></div><?php endif; ?>
				<?php
						$currentCat = '';
						foreach($search as $sCourse){
							if($sCourse->category != $currentCat)
							{
								echo ('<div class="profileInfo"><strong>'.$sCourse->category.'</strong></div>');
								$currentCat = $sCourse->category;
							}
							echo ('<div class="profileInfo"><pre>'.$sCourse->course.'</pre></div>');
						}
				?>
		</div>
		</article>
	</section>
	<section class="profileBottom">
		<article class="left">
		
		</article>
		<article class="right">

		</article>
	</section>
</div>
	
<?php
    include "footer.php";
?>