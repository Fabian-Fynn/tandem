<?php
	include "menu.php";
	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}
	$id = $_SESSION['id'];
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $uploaddir = dirname( $_SERVER["SCRIPT_FILENAME"] ) . "/img/";
 
    $filename = basename($_FILES['image']['name']);
    $ext = substr($filename, -4);
     
    
    $imgname = "temp_".$id.$ext;
    if( $ext != '.jpg' && $ext != '.png' && $ext != '.gif' ) {
       die("ich darf nur jpg-Dateien hochladen, nicht " . substr($filename, -3) );
      exit;
    }
     
    $uploadfile = $uploaddir . $imgname;
     
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
      echo "Datei erfolgreich hochgeladen nach <a href='upload/'>upload/</a>\n";
    } else {
      echo "Problem beim Speichern der Datei.\n";
    }
     
    
  }
?>
<script type="text/javascript" src="js/mootools.js"></script>
<script type="text/javascript" src="js/Lasso.js"></script>
<script type="text/javascript" src="js/Lasso.Crop.js"></script>

<div class = "wrap">
		
	<section class="profileTop">
		<div class="userName"><h1>Profilbild hochladen</h1></div>
		<article class="left">
			
    <form method="post" action="image_upload.php" id="picForm" enctype="multipart/form-data">
      
      <input name="image" type="file">
      
      <p><input type="submit" value="Senden">
    </form>

<?php
  
  if($_SERVER['REQUEST_METHOD'] == 'POST')
    { ?>
    <img src="img/temp_<?php echo ($id.$ext); ?>" onload="cropper()" id="tempPic"/>

<?php
  }
  	?>
    </article>
		<article class="right">
		</article>
	</section>
	
</div>
<script>
function cropper(){
new Lasso.Crop('tempPic',{
  ratio: [1,1],
  preset: [235, 140, 505, 340],
  min: [50,50],
  handleSize : 8,
  opacity : .6,
  color: '#7389AE',
  border : 'img/crop.gif'
});
}

 </script>
<?php
    include "footer.php";
?>

