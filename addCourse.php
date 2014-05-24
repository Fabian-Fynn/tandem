
<?php
	include 'menu.php';
	if($_SESSION['id'] != "3")
	{
		header('Location: index.php');
	}
	$error = "";

	$categories = $dbh->query("Select * FROM category");
	$courses= $dbh->query("Select c.name AS course, c.id AS cid, cat.name AS category FROM category cat, course c WHERE c.category = cat.id ORDER BY course");
	if ($_SERVER['REQUEST_METHOD'] == 'POST' &&!isset($_POST['editNow']) &&!isset($_POST['edit'])) {
		$_POST['editNow'] = "true";
		echo "string";

		$sth = $dbh->prepare(
			  "INSERT INTO course
				(id, name, category)
				  VALUES
				(NULL,  ?,?)");

		$sth->execute(
			array(
				$_POST['name'],
				$_POST['category']
				)
				); 

	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editNow']))
	{	
		try{
		$array = $_POST;
		$sth = $dbh->prepare("UPDATE course SET name = ?, category = ?
				 WHERE name = ?;");
			  
				 	$sth->execute(
					  array(
						$_POST['name'],
						$_POST['category'],
						$_POST['editNow']
						)
					); 

		}	 catch(Exception $e)
		{
			$error = "Choose category";
		}
					header("Location: addcourse.php?error=".$error);
			   
	}

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']))
	{
		try{
		$array = $_POST;
		$sth = $dbh->prepare("DELETE FROM course WHERE name = ?;");
				
			   
			  
				 	$sth->execute(
					  array(
						$_POST['course']
						)
					); 

		}	 catch(Exception $e)
		{
			$error = "Choose category";
		}
					header("Location: addcourse.php?error=".$error);

	}
?>


	<div class = "wrap">
		<div class="matchbox">
		<section class="profileTop">
			<div class="userName"><h1>Add Course</h1></div>
			<article class="left">
				

		


				<form action="addcourse.php" class="addcourse" method="post" >
					<label for="name" >Course name:</label> 
					<input type="text" name="name" 
					<?php if (isset($_POST['edit'])){
						echo("value='".$_POST['course']."'");} ?>
					required >
					<?php 
						if(isset($_POST['edit'])){
							echo('<input type="hidden" name="editNow" value="'.$_POST['course'].'">');
						}
					?>
					<label for="category" >Category:</label>
					<select name="category" required>
						<option value="">
						<?php
							foreach ($categories as $category) {
								echo("<option value='".$category->id."'>".$category->name);
							}
						?>
					</select>
					<br>
					<input type="submit">
				</form>
				<p class="error"><?php if(isset($_GET['error'])) {echo($_GET['error']);} ?>	</p>
			</article>
			<article class="right" style="width:200px">
			<h2>Edit existing Course</h2>
			<form action="addcourse.php" class="addcourse" method="post" >
					
					<input type="hidden" name="edit" value="true">
						<?php
							foreach ($courses as $course) {
								echo($course->course."<input type='radio' style='float:left; margin-top:4px; margin-right:10px;' name='course' value='".$course->course."'><br>");
								
							}
						?>
					
					<input type="submit" style="float:left;" value="edit">
					<input type="submit" style="float:left;" name="delete" value="delete">
				</form>
		</article>
		</section>

<?php
	
?>
</div>	
	</div>

<?php
	include 'footer.php'
?>
