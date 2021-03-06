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
if($_SESSION['id'] != "3")
{
	header('Location: index.php');
}
$error = "";

$categories = $dbh->query("Select * FROM category");
$courses= $dbh->query("Select c.name AS course, c.id AS cid, cat.name AS category, cat.id AS catid FROM category cat, course c WHERE c.category = cat.id AND c.active = 1 ORDER BY course");
$InactiveCourses= $dbh->query("Select c.name AS course, c.id AS cid, cat.name AS category FROM category cat, course c WHERE c.category = cat.id AND c.active = 0 ORDER BY course");
if (!isset($_POST['editNow']) &&!isset($_POST['edit']) &&!isset($_POST['accept']) ) {
	try{
		$_POST['editNow'] = "true";

		$sth = $dbh->prepare(
			"INSERT INTO course
			(id, name, category, active)
			VALUES
			(NULL,  ?,?, ?)");

		$sth->execute(
			array(
				$_POST['name'],
				$_POST['category'],
				1
				)
			); 
	}	 catch(Exception $e)
	{
		$error = "unable_to_add";
		header("Location: addCourse.php?error=".$error);
	}
	header("Location: addCourse.php");
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
		$error = "unable_to_edit";
		header("Location: addCourse.php?error=".$error);
	}
	header("Location: addCourse.php");

}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']))
{
	try{
		$array = $_POST;
		$sth = $dbh->prepare("DELETE FROM course WHERE id = ?;");	  
		$sth->execute(
			array(
				$_POST['courseid']
				)
			); 
	}catch(Exception $e)
	{
		$error = "unable_to_delete";
		header("Location: addCourse.php?error=".$error);
	}
	header("Location: addCourse.php");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accept']))
{
	try{
		$array = $_POST;
		$sth = $dbh->prepare("UPDATE course SET name = ?, active = ?
			WHERE id = ?;");

		$sth->execute(
			array(
				$_POST['name'],
				1,
				$_POST['courseid']
				)
			); 
	}catch(Exception $e)
	{
		$error = "unable_to_accept";
		header("Location: addCourse.php?error=".$error);
	}
	header("Location: addCourse.php");
}
?>

<div class = "wrap">
	<div class="matchbox">
		<section class="profileTop">
			<div class="userName"><h1>Edit Courses</h1><br></div>
			<article class="left">
				<h2 class="higherH2">Add Course</h2>
				<form action="addCourse.php" class="addcourse" method="post" >

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
							<option value=""></option>
							<?php
							foreach ($categories as $category) {
								if(isset($_POST['category']) && $category->id == $_POST['category'] )
									echo("<option value='".$category->id."' selected >".$category->name);
								else	
									echo("<option value='".$category->id."'>".$category->name);
							}
							?>
						</select>
						<br>
						<input type="submit" value="Send">
					</form>
					<p class="error"><?php if(isset($_GET['error'])) {echo($_GET['error']);} ?>	</p>
					<br>
					<h2>Course Suggestions</h2>
					<?php 
					foreach ($InactiveCourses as $course):
						?>
					<form action="addCourse.php" method="post">
						<input type="text" name="name" style="float:left; margin: 0;width:90%" value="<?php echo($course->course) ?>">
						<input type="hidden" name="courseid" value="<?php echo($course->cid) ?>">
						<label style="clear:left; width:90%" for="category" >Category:</label>
						<input type="text"  style="float:left; margin: 0;width:90%" value="<?php echo($course->category) ?>" disabled>

						<div style="clear:left; width:90%; height:100px;">
							<input type="submit" style="float:left;" name="accept" value="accept">
							<input type="submit" style="float:left;" name="delete" value="delete">
						</div>

					</form>
					<?php
					endforeach;
					?>
				</article>
				<article class="right" style="width:300px">
					<h2 class="higherH2">Edit existing Course</h2>
					<br>
					<?php 
					foreach ($courses as $course):
						?>
					<div class="editCourseList">
						<form action="addCourse.php"  method="post">
							<input type="hidden" name="edit" value="true">
							<div class="info">
								<b><?php echo($course->course) ?></b>
								<input type="hidden" name="courseid" value="<?php echo($course->cid) ?>">
								<input type="hidden" name="course" value="<?php echo($course->course) ?>">
								<input type="hidden" name="category" value="<?php echo($course->catid) ?>">
								<br>
								<?php echo($course->category) ?>
							</div>
							<div class="courseButtons">
								<input type="submit" value="edit">
								<input type="submit" name="delete" value="delete">
							</div>
						</form>
					</div>
					<?php
					endforeach;
					?>
					
				</article>
			</section>
		</div>	
</div>
<?php
include 'footer.php'
?>
