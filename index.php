
<?php
	include "config.php";
	$dbh = new PDO($DSN, $DB_USER, $DB_PASS);

    $pagetitle = "Tandem - Lernplattform für Studenten der FH-Salzburg";
   	include "functions.php";
    if(isset($_SESSION['error']))
    {
    	$errors = getIndexError($_SESSION['error']);
    	unset($_SESSION['error']);
    }
    include "intro.php";


?>

	
<div class = "wrapIndex">
	<?php

		if(isset($errors)):
?>
	<div class="siteContainer">
	<div class="section" id="s1">
		<div class="outer">
			<div class="inner">
				<br>
				<h1>Error!</h1>
					<ul>
<?php

			foreach ($errors as $error) {
				echo("<li>".$error."</li>");
			}
?>

					</ul>
				<a href="#register"><button> Try again </button></a>
			</div>
		</div>
	</div>
<?php
	endif;
	 ?>

	<div class="section" id="s1">
		<div class="outer">
			<div class="inner">
				<h1>What is TANDEM?</h1>

				
				<h3>TANDEM connects students of University of Applied Sciences Salzburg</h3>
				<div class="img triad">
				<div class="left"><img src="img/icons/people.png" alt="Study">Meet new people</div>
				
				<div class="center"><img src="img/icons/success.png" alt="Study">gain knowledge</div>
				
				<div class="right"><img src="img/icons/share.png" alt="Study">share your's</div>
			</div>
		</div>

	</div>
	</div>
	<div class="section" id="s2">
		<div class="outer">
			<div class="inner">
				<h1>Share your expertise</h1>
					
			</div>
		</div>

	</div>

	<div id="s3"class="section">
		<div class="outer">
			<div class="inner">
				<h1>Section 3</h1>
				<img class="img right" src="img/icons/study1.png" alt="Study">
					<br><br><br><br><br><br><br>
			</div>
		</div>

	</div>

	
	
	<div class="section s4" id="register">
		<div class="outer">
			<div class="inner">	
				<div id="regForm">
				<h1>Register</h1>
				
				<form action="person_new.php" method="post">
					
		   			<table border="0" cellspacing="5" cellpadding="2">
						<tr>
							<td><label for="firstname">Firstname:</label></td> <td><input type="text" name="firstname" required></td>
						</tr>
						<tr>
							<td><label for="surname">Lastname:</label></td> <td><input type="text" name="surname" required></td>
						</tr>
						<tr>
							<td><label for="isfemale" >Gender:</label></td>
							<td><input type="radio" name="isfemale" class="radio" value="1"  required checked>female
								<input type="radio" name="isfemale" class="radio" value="0" required>male</td>
						<tr>
							<td><label for="email">FHS E-Mail:</label></td> <td><input type="email" id="Regmail" name="email" onblur="checkmail()" placeholder="mmustermann.mmt-b2013@fh-salzburg.ac.at" required></td>
						</tr>
						<tr>
							<td><label for="password">Password:</label></td> <td><input id="txtPassword" type="password" name="password" pattern=".{5,10}" title="5-10 letters or numbers." required></td>
						</tr>
						<tr >
							<td><label for="password">repeat:</label></td> <td  id="pwConfirmCell"><input id="txtConfirmPassword" type="password" name="password" onKeyUp="checkPasswordMatch();"  required>
							<img id="pwIndicator"></td>
						</tr>
						<tr>
							<td></td><td ><input type="submit" value=" Register " formnovalidate="formnovalidate"></td>
						</tr>
					</table>
				</form>
		</div>
			<div id="altLogin">
			<h1>Login</h1>
			<form id="alogin" action="login.php" method="post">
			
			<input type="email" name="altMail" id="email" placeholder=" E-Mail">
			<input type="password" name="pwd" id="pwd" placeholder=" Password">
			<input type="submit" value=" Login " class="submit" id="submitLogin">
			
			
	</form>
				</div>
		</div>

	</div>
</div>
	

<div class="section impressum" id="impressum">
		<div class="outer">
			<div class="inner">	


	      <div id="impressContent"><h2>Impressum</h2>
<p>Meine Lieblingsorte ist ein MultiMediaProjekt 1 des Studiengangs MultimediaTechnology der Fachhochschule Salzburg</p><br>


<p>Simon Hintersonnleiter</p>
<a href="mailto:fhoffmann.mmt-b2013@fh-salzburg.at"><p>fhoffmann.mmt-b2013@fh-salzburg.at</p></a></div>
	
	</div></div></div>
<?php
    include "footer.php";
?>
<script>

$(window).scroll(function() {
   
    if(!(document.body.scrollHeight - $(this).scrollTop()  <= $(this).height()+80))
    {
    	$(".register").removeClass("highlighted");
    	$(".s1").removeClass("highlighted");
		checkvisability($("#s1"));
		checkvisability($("#s2"));
		checkvisability($("#s3"));

	}else
	{
		$(".s1").removeClass("highlighted");
		$(".s2").removeClass("highlighted");
		$(".s3").removeClass("highlighted");
		$(".register").addClass("highlighted");
    }
});


	
	window.onload = function(){
	    $('#loginButton').attr("href", "#");
	};


/* Code by Devin Sturgeon */
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
	        || location.hostname == this.hostname) {

	        var target = $(this.hash);
	        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	           if (target.length) {
	             $('html,body').animate({
	                 scrollTop: (target.offset().top -50)
	            }, 1000);
	            return false;
	        }
	    }
	});
});

	</script>