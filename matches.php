
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
    if(Count($matches) > 1)
    {
	    $matchesString = implode(',', $matches);
	    $matchesString = substr($matchesString, 1);
	    $matchedPeople = $dbh->query("Select * FROM user WHERE id IN ($matchesString)");
	    $matchedOffer = $dbh->query("Select c.name AS name, o.teacher AS teacher FROM offer o, course c, search s WHERE o.teacher IN ($matchesString) AND c.id = o.course AND s.student = $id AND s.course = o.course");
	}
?>
	<div class = "wrap">
		<h1>Deine Matches!</h1>
		<br><br>
		<?php 
			if(Count($matches) > 1): ?>
		<p>Wir haben <?php echo(Count($matches)-1); ?> Matches für dich gefunden.</p>
		<br>

		<?php 
		
		foreach ($matchedPeople as $match):
			?>
		<a href="profil.php?id=<?php echo($match->id) ?>">
		<div class = "match">
			<img src="http://multimediatechnology.at/~fhs36101/mmp1/profilePics/<?php echo ($match->avatar)  ?>">
			<p><?php echo($match->firstname." ".$match->surname) ?></p>
			<?php 
			unset($offer);
			foreach ($matchedOffer as $o => $offer) {
				if($offer->teacher == $match->id)
				{
					echo("<p>".$offer->name."</p>");

				}

			}
			reset($matchedOffer);
			?>
		</div>
		</a>
		<?php
		endforeach; 
		
		else:

		?>
		<p>Wir haben leider keine Matches für dich gefunden.</p>



		<?php 

		
		endif;
		?>
	</div>
	
	
<?php
    include "footer.php";
?>