
<?php
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


		$targ_w = $targ_h = 500;
	  $jpeg_quality = 90;
	  $src = "img/profilePics/".$_SESSION['uploadfile'];
	  //unset($_SESSION['uploadfile']);

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

	  //if $srcParts['extension'] =="jpgp";

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

   		header("Location:profil.php");
   		exit;


	}
?>
<script src="js/jquery.Jcrop.js"></script>
<script type="text/javascript">

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
		<section>
	
		<div class="userName"><h1>Profil bearbeiten</h1></div>
		<article class="left">
			<h2>Cropper</h2>
			<img src="img/profilePics/<?php echo $filename; ?>" id="cropbox">
			 <p><form action="crop.php" method="post" onsubmit="return checkCoords();">
      <input type="hidden" id="x" name="x" />
      <input type="hidden" id="y" name="y" />
      <input type="hidden" id="w" name="w" />
      <input type="hidden" id="h" name="h" />
      <input type="submit" name="cropNow" value="Fertig" class="btn" />
  </form></p>
		</article>
		<article class="right">
		
		
		
	</article>
	</section>
</div>
<?php
    include "footer.php";
?>

