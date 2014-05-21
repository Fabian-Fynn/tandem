
<?php
	include 'menu.php';
	if($_SESSION['id'] != "3")
	{
		header('Location: index.php');
	}
	$error = "";

	$categories = $dbh->query("Select * FROM category");
	$courses= $dbh->query("Select c.name AS course, c.id AS cid, cat.name AS category FROM category cat, course c WHERE c.category = cat.id ORDER BY category, course");
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['edit'])&& !isset($_POST['editNow'])) {
		
		

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
					>
					<?php if(isset($_POST['course'])){echo('<input type="hidden" name="editNow" value="'.$_POST['course'].'">');} ?>
					<select name="category">
						<option value="">
						<?php
							foreach ($categories as $category) {
								echo("<option value='".$category->id."'>".$category->name);
							}
						?>
					</select>
					<input type="submit">
				</form>
				<p class="error"><?php if(isset($_GET['error'])) {echo($_GET['error']);} ?>	</p>
			</article>
			<article class="right">
			<h2>RandomuserDeleter</h2>
			<form action="addcourse.php" class="addcourse" method="post" >
					<label for="editCourses" >edit Courses</label> 
					<input type="hidden" name="edit" value="true">
						<?php
							foreach ($courses as $course) {
								echo($course->course."<input type='radio' name='course' value='".$course->course."'><br>");
								
							}
						?>
					
					<input type="submit">
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
