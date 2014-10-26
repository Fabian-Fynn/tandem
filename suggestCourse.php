<?php

/*TANDEM is a second semester project (MultiMediaProjekt 1) of the course Multimedia Technology at University of Applied Sciences Salzburg

Author: Fabian Hoffmann
Course of Study: Multimedia Technology
At: University of Applied Sciences Salzburg

fhoffmann.mmt-b2013@fh-salzburg.ac.at

"Icons made by Icons8, Freepik and Designerz Base from Flaticon.com / partly modified"

"Index picture made by CollegeDegrees360 from Flickr.com"
*/
include 'menu.php';
	checkSession();
	$error = "";

	$categories = $dbh->query("Select * FROM category");
	$courses= $dbh->query("Select c.name AS course, c.id AS cid, cat.name AS category FROM category cat, course c WHERE c.category = cat.id ORDER BY course");
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if($_POST['name'] == "" || $_POST['category'] == "")
		{
			$_SESSION['message'] = "Please fill both input fields";
			
			
		}

		if(preg_match("/\;/i", $_POST['name']))
		{
			$_SESSION['message'] = "Sorry no SQL injections allowed ;)";
	}
	else
	{
		$sth = $dbh->prepare(
			"INSERT INTO course
			(id, name, category, active)
			VALUES
			(NULL,  ?,?, ?)");

		$sth->execute(
			array(
				$_POST['name'],
				$_POST['category'],
				0
				)
			); 
		
		$_SESSION['message'] = "Thanks for your support!";
	}
	header("Location: suggestCourse.php");
}

?>

<div class = "wrap">
	<div class="matchbox">
		<section class="profileTop">
			<div class="userName"><h1>Suggest Course</h1></div>
			<article class="left">
				<form action="suggestCourse.php" class="addcourse" method="post" novalidate>
					<label for="name" >Course name:</label> 
					<input type="text" name="name" required >
					
					<label for="category">Category:</label>
					<select name="category" required>
						<option value="">
							<?php
							foreach ($categories as $category) {
								echo("<option value='".$category->id."'>".$category->name);
							}
							?>
						</select>
						<br>
						<input type="submit" value=" Send ">
						
					</form>
					<br><br>
					<?php
					if(isset($_SESSION['message']) && $_SERVER['REQUEST_METHOD'] != 'POST')
					{
						echo("<strong>".$_SESSION['message']."</strong>");
						unset($_SESSION['message']);
					}
		
					?>

				</article>
			</section>

		</div>	
	</div>

	<?php
	include 'footer.php'
	?>
