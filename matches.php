
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

    if(sizeof($matches) > 0)
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