
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
    	$matchedPeople = $dbh->query("Select * FROM user WHERE id IN ($matchesString) order by rand() limit 5");
    
    }
    
?>
	<div class = "wrap">
		<h1>Willkommen, <?php echo $user ?> !</h1>
		<br><br>
		<?php 
			if(Count($matches) > 1): ?>
		<p>Wir haben <?php echo(Count($matches)-1); ?> Matches für dich gefunden.</p>
		<br>

		<?php 
		
			foreach ($matchedPeople as $match):
		?>
		<a href="profil.php?id=<?php echo($match->id) ?>">
		<div class = "homeMatch">
			<img src="http://multimediatechnology.at/~fhs36101/mmp1/profilePics/<?php echo ($match->avatar)  ?>">
			<p><?php echo($match->firstname." ".$match->surname) ?></p>
		</div>
		</a>
		<?php
		endforeach; 
		endif;
		?>




		<?php /*
		<div class="offer" style="width:200px;">
				<h2 style='margin-bottom:-5px'>suchen was ich biete</h2><div class="profileInfo"><a href="offer_edit.php?request=o">bearbeiten</a></div>
				<?php
					if($aOffer != '')
					{
						//echo($aOffer);
						foreach($bSearch as $oCourse){
							echo ('<div class="profileInfo"><pre>'.$oCourse.'</pre></div>');
						}
					}
					else
					{
						echo ('<div class="profileInfo">Leider habe ich noch keine Beschreibung hinzugefügt.</div>');
					}
				?>
			</div>

			<div class="offer"style="width:200px;">
				<h2 style='margin-bottom:-5px'>bieten was ich suche</h2><div class="profileInfo"><a href="offer_edit.php?request=o">bearbeiten</a></div>
				<?php
					if($aSearch != '')
					{
						//echo($aOffer);
						foreach($bOffer as $oCourse){
							echo ('<div class="profileInfo"><pre>'.$oCourse.'</pre></div>');
						}
					}
					else
					{
						echo ('<div class="profileInfo">Leider habe ich noch keine Beschreibung hinzugefügt.</div>');
					}
				?>
			</div>

			<div class="offer"style="width:200px;">
				<h2 style='margin-bottom:-5px'>Matches</h2><div class="profileInfo"><a href="offer_edit.php?request=o">bearbeiten</a></div>
				<?php
					if($bSearch != '' && $bOffer != '')
					{
						//echo($aOffer);
						foreach($matches as $oCourse){
							echo ('<div class="profileInfo"><pre>'.$oCourse.'</pre></div>');
						}
					}
					else
					{
						echo ('<div class="profileInfo">Leider habe ich noch keine Beschreibung hinzugefügt.</div>');
					}
				?>
			</div>
		*/?>
	</div>
	
	
<?php
    include "footer.php";
?>