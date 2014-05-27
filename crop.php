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
	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}
	
	$id = $_SESSION['id'];

	if(isset($_SESSION['uploadfile']))
	{
		$filename = $_SESSION['uploadfile'];
	}
	if(isset($_POST['cropNow']))
	{
		try{
		  $targ_w = $targ_h = 500;
		  $jpeg_quality = 90;
		  $src = "img/profilePics/".$_SESSION['uploadfile'];
		  unset($_SESSION['uploadfile']);

		  $stm = $dbh->query("SELECT avatar FROM user WHERE id=$id");
		  $avatar = $stm->fetch();

		    if($avatar->avatar != "male_avatar.png" && $avatar->avatar != "female_avatar.png")
		    	unlink("img/profilePics/".$avatar->avatar);
 
		  $srcParts = pathinfo($src);

		  if($srcParts['extension'] == 'jpg')
		     $img_r = imagecreatefromjpeg($src);
		   else if ($srcParts['extension'] == 'png')
		     $img_r = imagecreatefrompng($src);
		   else
		      exit;

		  $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

		  imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
		  $targ_w,$targ_h,$_POST['w'],$_POST['h']);

		  $filename = $_SESSION['id'] . '_profile.'. $srcParts['extension'];
		  $newSrc = 'img/profilePics/' . $filename;

		  if($srcParts['extension'] == 'jpg' || $srcParts['extension'] == 'JPG')
		     imagejpeg($dst_r,$newSrc);
		   else if ($srcParts['extension'] == 'png' || $srcParts['extension'] == 'PNG')
		    imagepng($dst_r,$newSrc);

		  imagedestroy($img_r);

			$sth = $dbh->prepare("UPDATE user SET avatar = ? WHERE id = ?;");

			 	$sth->execute(
						  array(
							$filename,
							$id
							)
						); 
			 	
			$srcParts = pathinfo($avatar->avatar);
		    $ext = $srcParts['extension'];

		    unlink("img/profilePics/temp_".$id.".".$ext);

	   		header("Location:profile.php");
	   		exit;
	   	}catch(Exeption $e)
	   	{
	   		echo("<script>alert('".$e."')</script>");
	   	}
	}
?>
<script src="js/jquery.Jcrop.js"></script>
<script>
  window.onload = function(){
    $('#cropbox').Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords
    });
  };

  function updateCoords(c)
  {
    $('#x').val(c.x);
    $('#y').val(c.y);
    $('#w').val(c.w);
    $('#h').val(c.h);
  };

  function checkCoords()
  {
    if (parseInt($('#w').val())) return true;
    alert('Please select a crop region then press submit.');
    return false;
  };

</script>

<div class = "wrap">
	<div class="matchbox">
		<section class="crop">
			<div class="userName"><h1>Edit Profilepicture</h1></div>			
			<h2>Choose image section</h2>
			<img src="img/profilePics/<?php echo $filename; ?>" id="cropbox">
			<form action="crop.php" method="post" onsubmit="return checkCoords();">
			    <input type="hidden" id="x" name="x" />
			    <input type="hidden" id="y" name="y" />
			    <input type="hidden" id="w" name="w" />
			    <input type="hidden" id="h" name="h" />
			    <input type="submit" name="cropNow" value="Send" class="btn" />
			</form>
	 		<div class="warning"><b>Note:</b> After submiting your new image it sometimes happens that you still see your old profile picture. In that case please refresh the page.</div>
		</section>
	</div>
</div>
<?php
    include "footer.php";
?>