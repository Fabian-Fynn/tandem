<?php
	include "menu.php";
	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}
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
					header("Location: profil.php");
			   
			 
		    } catch (Exception $e) {
				die("Problem with updating Data!" . $e->getMessage() );
			}

	}
	//if($_SESSION['request'] == 'o')
	//	echo("<script>alert('".$_SESSION['request']."');</script>");
	
	if($_SESSION['request'] == 'o')
	$sth = $dbh->query("Select c.id AS cId FROM course c, offer o WHERE $id = o.teacher AND o.course = c.id");
	else
		$sth = $dbh->query("Select c.id AS cId FROM course c, search o WHERE $id = o.student AND o.course = c.id");
 	$off = $sth->fetchAll();
	$courses= $dbh->query("Select c.name AS course, c.id AS cId, cat.name AS category FROM category cat, course c WHERE c.category = cat.id ORDER BY category, course");
	

?>
<div class = "wrap">
		
	<section class="profileTop">
		<div class="userName"><h1>Edit Offers</h1></div>
		
				
			 <form id="courseList" action="offer_edit.php" method="post" >
				
			
			<?php 
				$currentCat = '';
				
				foreach($courses as $c ){
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
				 <input style='float:right' type="submit" value="Send">
		</form>

		<article class="right">
				
		</article>
	</section>
	
</div>
	
<?php
    include "footer.php";
?>