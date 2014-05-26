  <div class="footer">
  	<div class="container">
    	<div class="left">
  		
      <?php 
        if(isset($_SESSION['id'])):
      ?>

        <a href="profile.php?id=3">Fabian Hoffmann</a><br>
    		<a href="legals.php">Legal Notice</a>

      <?php 
        else:
      ?>
        <a href="mailto:fhoffmann.mmt-b2013@fh-salzburg.ac.at">Fabian Hoffmann</a><br>
      <?php
        endif;
        if(isset($_SESSION['id']) && $_SESSION['id'] == "3"){
      ?>
        	<br>
      		<a href="createusers.php">create User</a>
      		<br>
      		<a href="addCourse.php">edit courses</a>
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