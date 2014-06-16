<?php
/*TANDEM is a second semester project (MultiMediaProjekt 1) of the course Multimedia Technology at University of Applied Sciences Salzburg

Author: Fabian Hoffmann
Course of Study: Multimedia Technology
At: University of Applied Sciences Salzburg

fhoffmann.mmt-b2013@fh-salzburg.ac.at

"Icons made by Icons8, Freepik and Designerz Base from Flaticon.com / partly modified"

"Index picture made by CollegeDegrees360 from Flickr.com"
*/
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

	$stm = $dbh->prepare("SELECT * FROM user WHERE id=?");
	$stm->execute(array($id));
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
	$stho = $dbh->prepare("Select c.name AS course, cat.name AS category FROM category cat, course c, offer o WHERE o.teacher = ? AND o.course = c.id AND c.category = cat.id ");
	$sths = $dbh->prepare("Select c.name AS course, cat.name AS category FROM category cat, course c, search s WHERE s.student = ? AND s.course = c.id AND c.category = cat.id ");
	$sthb = $dbh->prepare("Select COUNT(*) AS c FROM partner WHERE personA IN (".$_SESSION['id'].",?) AND personB IN (".$_SESSION['id'].",?) AND status = 1");

	$stho->execute(array($id)); 
	$sths->execute(array($id)); 
	$sthb->execute(array($id, $id)); 

	$offer = $stho->fetchAll();
	$search = $sths->fetchAll();
	$aBuddy = $sthb->fetch();
	if($aBuddy->c != 0)
		$isbuddy = true;
	else
		$isbuddy = false;

	$stm = $dbh->prepare("Select COUNT(*) AS c FROM partner WHERE personA = ".$_SESSION['id']." AND personB = ? AND status = 0");
	$stm->execute(array($id)); 
	$mRequest = $stm->fetch();

	$stm = $dbh->prepare("Select COUNT(*) AS c FROM partner WHERE personB = ".$_SESSION['id']." AND personA = ? AND status = 0");
	$stm->execute(array($id));
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
		$buddyButton = " Delete from Buddies ";
		$reqAct = "unfriend";
	}
	elseif($isMyRequest):
	{
		$buddyButton = " Abort ";
		$reqAct = "abort";
	}
	elseif($isOthersRequest):
	{
		$buddyButton = " Accept ";
		$reqAct = "accept";	
	}
	else:
	{
		$buddyButton = " Add as Buddy ";
		$reqAct = "send";	
	}
	endif;
?>
<div class="wrap">
	<div class="matchbox">	
		<section class="profileTop">
			<div class="userName"><h1><?php echo ($person->firstname." ".$person->surname) ?></h1></div>
			<article class="left"><div class="profilePicContainer">
					<div class="profilePic"><img src="img/profilePics/<?php echo $avatar ?>"></div>

					<?php if($ownProfile): ?>
						<div class="profileInfo changePic"><a href="image_upload.php">Change Profile picture</a></div> 
						<div class="profileInfo"><a href="person_edit.php">Edit Profile</a></div>
					<?php endif; ?>
					
					<?php
						if($person->studienfach != null)
						{
							echo ('<div class="profileInfo"><strong>Course of Studies</strong></div>');
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
							echo ('<div class="profileInfo"><strong>Residence</strong></div>');
							echo ('<div class="profileInfo">'.$person->city);
						}
						if(($isbuddy || $id == 3) && $_SESSION['id'] != 3)
						{
							echo ('<div class="profileInfo"><strong>Contact '.$person->firstname.'</strong>');
							echo ('<div class="profileInfo"><a href="mailto:'.$person->email.'">'.$person->email.'</a>');
						}
						echo ('<div class="profileInfo"><strong>Member since</strong></div>');
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
				        <input type="submit" value="<?php echo($buddyButton); ?>" class="submit" id="submitRequest" >
						</div>
							<div id="add_err"></div>
					</form>
					<?php 
						if($isOthersRequest): ?>
							<a class="req" id="reqAbort" href="request.php?partner=<?php echo($id) ?>&reqAct=<?php echo($reqAct); ?>" ><button onclick='abortRequest(<?php echo($id); ?>)'> Abort </button></a>
					<?php 
						endif; 
						if($isbuddy):
					?>
						<h2> Your are Conneted!</h2>
					<?php
						endif;
					endif;
				?>			
				<div class="description">
					<h2>About me</h2>
						<?php
							if($person->description != null)
							{
								echo ('<div class="profileInfo">'.$person->description.'</div>');
							}
							else
							{
								echo ('<div class="profileInfo">I\'m too cool to share this Info</div>');
							}
						?>
				</div>
				<div class="offer">
					<h2 style='margin-bottom:-5px'>I offer</h2><?php if($ownProfile): ?><div class="profileInfo"><a href="offer_edit.php?request=o">edit</a></div><?php endif; ?>
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
					<h2 style='margin-bottom:-5px'>I look for</h2><?php if($ownProfile): ?><div class="profileInfo"><a href="offer_edit.php?request=s">edit</a></div><?php endif; ?>
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
	</div>
</div>
	
<?php
    include "footer.php";
?>