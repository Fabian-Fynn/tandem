
<?php
	include "menu.php";
	if(! isset($_SESSION['id']))
	{
		header('Location: index.php');
	}

	$id = $_SESSION['id'];
	$stm = $dbh->query("Select * FROM user WHERE id=$id");
  	$person = $stm->fetch();
	$user = $person->firstname;

    $matches = Matches($dbh, $id);

    if(sizeof($matches) > 1)
    {
	    $matchesString = implode(',', $matches);
	    $matchesString = substr($matchesString, 1);

		$matchedPeople = $dbh->query("Select * FROM user WHERE id IN ($matchesString)");
	}
?>
	<div class = "wrap">
		<h1>Your Matches!</h1>
		<br><br>
		<?php 
			if(Count($matches) > 1): ?>
		<p>We found <?php echo(Count($matches)-1); ?> Matches for you.</p>
		<br>

		<?php 
		
		foreach ($matchedPeople as $match):
			?>
		<a href="profil.php?id=<?php echo($match->id) ?>">
		<div class = "match">
			<img src="img/profilePics/<?php echo ($match->avatar)?>">
			<div class="name"><?php echo($match->firstname." ".$match->surname) ?></div>
			<?php /*
			unset($offer);
			foreach ($matchedOffer as $o => $offer) {
				if($offer->teacher == $match->id)
				{
					echo("<p>".$offer->name."</p>");

				}

			}
			reset($matchedOffer);
			*/
			?>
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
	
	
<?php
    include "footer.php";
?>