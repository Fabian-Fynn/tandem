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
	checkSession();
	$id = $_SESSION['id'];
	if(isset($_GET['request']))
		$_SESSION['request'] = $_GET['request'];
	
	$request = "o";
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		   try{
		   	if($_SESSION['request'] == "o")
			   $sth1 = $dbh->prepare("DELETE FROM offer WHERE teacher = ?");
			else
			   $sth1 = $dbh->prepare("DELETE FROM search WHERE student = ?");
			
			   $sth1->execute(array($id));
			   
			   $array = $_POST;
			   foreach($array as $courseVal)
			   {
			   	if($_SESSION['request'] == $request)
			   	{
		   			$sth1 = $dbh->prepare("DELETE FROM offer WHERE teacher = ?");
		   			$sth2 = $dbh->prepare("INSERT INTO offer (course , teacher ) VALUES (?, ?)");
		   		}
			   	else
			   	{
			   		$sth1 = $dbh->prepare("DELETE FROM search WHERE student = ?");
			   		$sth2 = $dbh->prepare("INSERT INTO search (course , student ) VALUES (?, ?)");
				}
				 	$sth2->execute(
					  array(
						$courseVal,
						  $id
						)
					); 
				   }
					header("Location: profile.php");
		
		    } catch (Exception $e) {
				die("Problem with updating Data!" . $e->getMessage() );
			}
	}
	
	if($_SESSION['request'] == 'o')
	{
		$sth = $dbh->prepare("Select c.id AS cId FROM course c, offer o WHERE ? = o.teacher AND o.course = c.id");
		$stm = $dbh->prepare("Select c.name AS course, c.id AS cId, cat.name AS category FROM category cat, course c WHERE c.category = cat.id AND c.active = 1 AND c.id NOT IN(Select c.id AS cId FROM course c, search o WHERE ? = o.student AND o.course = c.id) ORDER BY category, course");

	}else
	{
		$sth = $dbh->prepare("Select c.id AS cId FROM course c, search o WHERE o.student = ? AND o.course = c.id");
		$stm = $dbh->prepare("Select c.name AS course, c.id AS cId, cat.name AS category FROM category cat, course c WHERE c.category = cat.id AND c.active = 1 AND c.id NOT IN(Select c.id AS cId FROM course c, offer o WHERE ? = o.teacher AND o.course = c.id) ORDER BY category, course");
	}

	$sth->execute(array($id)); 
	$stm->execute(array($id)); 

 	$off = $sth->fetchAll();
	$courses = $stm->fetchAll();

?>
<div class = "wrap">
		
	<section class="profileTop">
		<div class="userName">
		<?php if($_SESSION['request'] == 'o'): ?>
				<h1>Edit Offer</h1>
		<?php else: ?>
				<h1>Edit Search</h1>
		<?php endif; ?>
			
			</div>	
			<form id="courseList" action="offer_edit.php" method="post" >		
				<div class="column">
				<?php 
					$currentCat = '';
					$counter = 0;
					$break = (sizeof($courses)/4);
					
					foreach($courses as $c ){
						$counter++;

						if($counter > $break)
						{
							echo "</div><div class='column'>";
							$counter = 0;
						}
						
						if($c->category != $currentCat)
						{
							echo ('<div class="profileInfo"><strong>'.$c->category.'</strong></div>');
							$currentCat = $c->category;
						}
						
						$isset = '';
						foreach($off as $oCourse)
						{
							if($c->cId == $oCourse->cId)
							{	$isset = ' checked';
							 	 break;	
							}	
						}
						echo ('<div class="profileInfo"><input type="checkbox" name="offer_'.$c->cId.'" value="'.$c->cId.'"'.$isset.'><pre> '.$c->course.'</pre>  </div>');
					}
				?>
				 </div>
				 <input style='float:right' type="submit" value="Send">
			</form>

		<article class="right">		
		</article>
	</section>
</div>
	
<?php
    include "footer.php";
?>