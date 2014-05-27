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
				header("Location: profile.php");
		   }
		   else{
		   	header("Location: person_edit.php");
		   }
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

<link href="froala/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="froala/css/froala_editor.min.css" rel="stylesheet" type="text/css">
<script src="froala/js/froala_editor.min.js"></script>
<div class = "wrap">
		
	<section class="profileTop">
		<div class="userName"><h1>Edit Profile</h1></div>
		<article class="left">
				<h2>My Data</h2>
			 <form action="person_edit.php" method="post" >
				<p>
					<label for="isfemale" >Gender:</label> 
					<select name="isfemale">
						<option value="1" <?php if($person->is_female == 1){echo " selected";} ?>>female</option>
						<option value="0" <?php if($person->is_female == 0){echo " selected";} ?>>male</option>
					</select>				
				</p>
			   
				<p>
					<label for="firstname">Firstname:</label> <input type="text" name="firstname" value="<?php echo ($person->firstname); ?>" required>
				</p>
				<p>
					<label for="surname">Lastname:</label> <input type="text" name="surname" value="<?php echo $person->surname; ?>" required>
				</p>
				<p>
				 	<label for="studienfach">Course of Studies:</label> <input type="text" name="studienfach" value="<?php echo $person->studienfach; ?>">
				</p>
				<p>
				 	<label for="studienjahr" >Year:</label> 
					<select name="studienjahr">
						<option value="">Please choose</option>
						<option value="2013" <?php if($person->studienjahr == 2013){echo " selected";} ?>>2013</option>
						<option value="2012" <?php if($person->studienjahr == 2012){echo " selected";} ?>>2012</option>	
						<option value="2011" <?php if($person->studienjahr == 2011){echo " selected";} ?>>2011</option>
						<option value="2010" <?php if($person->studienjahr == 2010){echo " selected";} ?>>2010</option>
						<option value="2009" <?php if($person->studienjahr == 2009){echo " selected";} ?>>2009</option>
					</select>
				</p>
				<p>
					<label for="city">Residence:</label> <input type="text" name="city" value="<?php echo $person->city; ?>">
				</p>
				<p>
					<label for="description">About me:</label> <textarea name="description" id="description" ><?php echo $person->description; ?></textarea>
				</p>
				<p>
					<input style='float:right' type="submit" value="Change"><a href='profile.php' style='float:right'><button onclick='location.href=this."profile.php"; return false;'>Cancel</button></a></p>
			</form>
		</article>
		<article class="right">
			<h2>Delete Account</h2>	
			<a href='person_delete.php' ><button onclick='location.href=this."person_delete.php"; return false;'>Delete Account</button></a>
		</article>
	</section>
</div>
	
<?php
    include "footer.php";
?>
    <script>
    $(function() {
        $('#description').editable({
			inlineMode: false,
			buttons: ['bold', 'underline',  'selectAll']
		})
    });
</script>