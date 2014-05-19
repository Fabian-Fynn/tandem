<?php
	include "menu.php";
	if(! isset($_SESSION['user']))
	{
		header('Location: index.php');
	}
?>

<?php
  try{
	$id = $_SESSION['id'];
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {

    
      $uploaddir = dirname( $_SERVER["SCRIPT_FILENAME"] ) . "/img/profilePics/";
   
      if(!isset($_FILES['image']))
        throw new Exception("filesize");

        
      $filename = basename($_FILES['image']['name']);
      $ext = substr($filename, -4);
       

    
    
    
    $imgname = "temp_".$id.$ext;
    if( $ext != '.jpg' && $ext != '.png' && $ext != '.JPG' && $ext != '.PNG' )
       throw new Exception("filetype");
      //"ich darf nur jpg-Dateien hochladen, nicht " . substr($filename, -3) 
    
     
    $uploadfile = $uploaddir . $imgname;
    //echo($avatar->avatar);
    //if(unlink("img/profilePics/".$avatar->avatar))
     // echo("<script>alert(".$avatar->avatar.");</script>");
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
      $_SESSION['uploadfile'] = $imgname;
      resize("img/profilePics/".$imgname, "img/profilePics/".$imgname, 500, 500, false);
      header("Location:crop.php");
    } else {
      throw new Exception("saveError");
      //echo "Problem beim Speichern der Datei.\n";
    }

    
  }
  }
    catch(Exception $e)
    {
      $errorType = $e->getmessage();
      switch ($errorType) {
        case 'filesize':
          $error = 'Das Bild ist zu groß, bitte wähle ein kleineres.';
          break;
        case 'filetype':
          $error = 'Der Dateityp des gewählten Bildes wird nicht unterstützt. Bitte wähle ein png oder jpg.';
          break;
        case 'saveError':
          $error = 'Es ist ein Fehler beim Speichern des Bildes aufgetreten. Bitte versuche es erneut.';
          break;
            
        default:
          $error = 'Es ist ein unerwarteter Fehler aufgetreten. Das tut mir leid. Bitte versuche es erneut.';
          break;
      }
      
    }
?>
<script type="text/javascript" src="js/mootools.js"></script>
<script type="text/javascript" src="js/Lasso.js"></script>
<script type="text/javascript" src="js/Lasso.Crop.js"></script>

<div class = "wrap">
		
	<section class="profileTop">
		
  <?php

    if(!isset($e)):
  ?>
    <div class="userName"><h1>Upload Profilepicture</h1></div>
		<article class="left">
			
    <form method="post" action="image_upload.php" id="picForm" enctype="multipart/form-data">
      
      <input name="image" type="file" id="fileToUpload">
      <div class="buttons">
      <a href="profil.php"><input type="button" value=" Cancel "></a><input type="submit" value=" Send " id="submit">
      <div style="float: left;height:auto; width:auto;"><p id="error"></p></div>
      </div>
    </form>
<script>

 $('#fileToUpload').bind('change', function() {

  //this.files[0].size gets the size of your file.
  if(this.files[0].size > 8000000)
    {
      $('#submit').attr("disabled", "disabled");
      $('#error').html("The Picture too large");
    }
    else
    {
      $('#submit').removeAttr("disabled");
      $('#error').html(""); 
    }

});  </script>
<?php
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'):
   ?>
    <img src="img/profilePics/temp_<?php echo ($id.$ext); ?>"  id="cropbox"/>

<?php
  endif;
  else:
    ?>

  <article class="left">
    <?php echo($error); ?>
    <a href="image_upload.php"><button>Back</button></a>
  </article>

  <?php
  endif;

  	?>
    </article>
		<article class="right">
		</article>
	</section>
	
</div>
<?php
    include "footer.php";
?>

