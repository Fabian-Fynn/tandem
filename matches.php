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
	if(! isset($_SESSION['id']))
	{
		header('Location: index.php');
	}

	$id = $_SESSION['id'];
 	
  	$sth  = $dbh->prepare("Select * FROM user WHERE id=?");
 		    $sth->execute(array( $id));
 	
 	$person = $sth->fetch();

	$user = $person->firstname;

    $matches = Matches($dbh, $id);

    if(sizeof($matches) > 1)
    {
	    $matchesString = implode(',', $matches);
	    $matchesString = substr($matchesString, 1);

		$sth  = $dbh->prepare("Select * FROM user WHERE id IN ($matchesString) AND id != $id");
 		    $sth->execute(array( $id));
 		$matchedPeople = $sth->fetchAll();
	}
?>
	<div class = "wrap">
		<h1>Your Matches!</h1>
		<br>
		<br>
		<?php 
		if(sizeof($matches) > 1):
			if(sizeof($matches) == 2){?>
				<p>We found 1 Match for you.</p>

				<?php
			}
			else{
		?>

		<p>We found some Matches for you.</p>

		<?php
			}
		?>

		<br>
		<div class="matchbox">

		<?php 
			foreach ($matchedPeople as $match):
		?>
				<a href="profile.php?id=<?php echo($match->id) ?>">
				<div class = "match">
					<img src="img/profilePics/<?php echo ($match->avatar)?>">
					<div class="name"><?php echo($match->firstname." ".$match->surname) ?></div>
					
				</div>
				</a>
		<?php
			endforeach; 
	
		else:

		?>
			<p>Sorry, we couldn't find any matches :'(</p>

		<?php 
		endif;
		?>

		</div>
	</div>
	
<?php
    include "footer.php";
?>