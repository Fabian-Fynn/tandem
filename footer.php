  <div class="footer">
  	<div class="container">
  	<div class="left">
		<a href="mailto:fhoffmann.mmt-b2013@fh-salzburg.at">Fabian Hoffmann</a><br>
  		<a href="impressum.php">Impressum</a>
  <?php 

  if($_SESSION['id'] == "3")
  {
  	?>
  	<br>
		<a href="createusers.php">create User</a>
		<br>
		<a href="addcourse.php">edit courses</a>
  	<?php
  }
?>
  </div>
  <div class="right">
	<div class="logofooter">
	<img src="img/icons/cap.png" alt="logo">
</div>


  	
   </div>
  </div>
 </div>
   </div>
</body>
 <script>JsSwitch();</script>
</html>
