<?php
	include "menu.php";
	if(! isset($_SESSION['id']))
	{
		header('Location: index.php');
	}

	$id = $_SESSION['id'];
	$stm = $dbh->query("Select * FROM user WHERE id=$id");
  	$person = $stm->fetch();
	$user = $person->firstname;


?>
	<div class = "wrap">
		
		<div class="welcome">
			
			<h2>Welcome to TANDEM,</h2>
			
			<p>the knowledge sharing plattform for students at the University of Applied Sciences Salzburg</p>
			<div class="ann">
			<img src="img/icons/ann.png">
			
			</div>
			<br>
			<h3>I want to give you a short introduction in how to use TANDEM</h3>
			<ul>
			<li>I'm always there for you</li>
			<p>Whenever you want read this introduction again, click on "TANDEM" on the top left to come back.</p>
			
			<li>At first you should fill your Profile with information about you.<br></li>
			<p>Deliver information like your residence and course of study to make you more interesting to others.</p>
			<a href="profile.php"><button><div class="button"> Edit your Profile </div></button></a>
			
			<li>Tell the world what you want to learn and teach.<br></li>
			<p>You can edit your courses on your profile site.</p>
			<a href="profile.php"><button><div class="button"> Edit your Courses </div></button></a>
			<li>Now it's time to check out whether you have matches yet.<br></li>
			<p>To see them just click the menu button "Matches".</p>
			<p>If there are any matches you will see a list of people.</p>
			<p>Click on their picture or name to visit their profile,</p>
			<p>there you'll see their course offers and searches.</p>
			<a href="matches.php"><button><div class="button"> See your matches </div></button></a>
			

			<li>You found someone you want to study with?<br></li>
			<p>Great! Send him/her a buddy request.</p>
			<p>As soon as they accept your request, you will see each other's email address.</p>
			<p>Send him/her a mail and arrange a study session.</p>
			
			<li>Buddies and Requests<br></li>
			<p>On the "Buddies" page you'll find your and other's requests and below a list of your Buddies.</p>
			<a href="buddies.php"><button><div class="button"> Check it out </div></button></a>
			
			</ul>

		</div>



		
	
	
	</div>
	
<?php
    include "footer.php";

?>

