  <div class="footer">
  	<div class="container">
  	<div class="left">
		<a href="mailto:fhoffmann.mmt-b2013@fh-salzburg.at">Fabian Hoffmann</a><br>
  		<a href="impressum.php">Impressum</a>
  
  </div>
  <div class="right"><img src="img/mtfbwy.png" alt="mtfbwy"><?php 

  if($_SESSION['id'] == "3")
  {
  	?>
		<a href="createusers.php">create User</a>
		<a href="addcourse.php">edit courses</a>
  	<?php
  }
?>
   </div>
  </div>
 </div>
   </div>
</body>
 <script>JsSwitch();</script>
</html>
