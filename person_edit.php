<?php
	include "menu.php";
	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}
	$id = $_SESSION['id'];
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		   	try{
			   $array = $_POST;
			   $sth = $dbh->prepare("UPDATE user SET firstname = ?, surname = ?, is_female = ?, studienfach = ?, studienjahr = ?, city = ?, description = ?
				 WHERE id = ?;");
				
			   if(formValid(true))
			   {
				 	$sth->execute(
					  array(
						$_POST['firstname'],
						$_POST['surname'],
						$_POST['isfemale'],
						$_POST['studienfach'],
						$_POST['studienjahr'],
						$_POST['city'],
						$_POST['description'],
						$id
						)
					); 
				  
					header("Location: profil.php");
			   }
			   else{die("damn");}
		    } catch (Exception $e) {
				die("Problem with updating Data!" . $e->getMessage() );
			}

	}
	
	

	$stm = $dbh->query("SELECT * FROM user WHERE id=$id");
  	$person = $stm->fetch();

	if($person->avatar != null)
	{
		$avatar = $person->avatar;
	}
	else
	{
		$avatar = "img/profilePic.png";
	}
?>

</style>
<div class = "wrap">
		
	<section class="profileTop">
		<div class="userName"><h1>Profil bearbeiten</h1></div>
		<article class="left">
				<h2>Meine Daten</h2>
			 <form action="person_edit.php" method="post" >
				<p><label for="isfemale" >Geschlecht:</label> 
					<select name="isfemale">
					<option value="1" <?php if($person->is_female == 1){echo " selected";} ?>>weiblich</option>
					<option value="0" <?php if($person->is_female == 0){echo " selected";} ?>>männlich</option>
					</select>
					
				</p>
			   
				<p  ><label for="firstname">Vorname:</label> <input type="text" name="firstname" value="<?php echo $person->firstname; ?>"></p>
				<p  ><label for="surname">Nachname:</label> <input type="text" name="surname" value="<?php echo $person->surname; ?>"></p>
				 <p  ><label for="studienfach">Studiengang:</label> <input type="text" name="studienfach" value="<?php echo $person->studienfach; ?>"></p>
				 <p><label for="studienjahr" >Jahr:</label> 
					<select name="studienjahr">
					<option value="">Bitte wählen</option>
					<option value="2013" <?php if($person->studienjahr == 2013){echo " selected";} ?>>2013</option>
					<option value="2012" <?php if($person->studienjahr == 2012){echo " selected";} ?>>2012</option>	
					<option value="2011" <?php if($person->studienjahr == 2011){echo " selected";} ?>>2011</option>
					<option value="2010" <?php if($person->studienjahr == 2010){echo " selected";} ?>>2010</option>
					<option value="2009" <?php if($person->studienjahr == 2009){echo " selected";} ?>>2009</option>
					</select>
				</p>
				<p><label for="city">Wohnort:</label> <input type="text" name="city" value="<?php echo $person->city; ?>"></p>
				<p><label for="description">Über mich:</label> <textarea name="description" id="description" ><?php echo $person->description; ?></textarea></p>
				
				<p><input style='float:right' type="submit" value="Daten ändern"><a href='profil.php' style='float:right'><button onclick='location.href=this."profil.php"; return false;'>Abbrechen</button></a></p>
			</form>

		</article>
		<article class="right">
			<h2>Account löschen</h2>	
			<a href='person_delete.php' ><button onclick='location.href=this."person_delete.php"; return false;'>Account löschen</button></a>
		</article>
	</section>
	
</div>
	
<?php
    include "footer.php";
?>