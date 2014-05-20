
<?php
	include "config.php";
	$dbh = new PDO($DSN, $DB_USER, $DB_PASS);

    $pagetitle = "Tandem - Lernplattform für Studenten der FH-Salzburg";
    include "intro.php";
?>

	
<div class = "wrapIndex">

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
							<td><input type="radio" name="isfemale" class="radio" value="1"  required>female
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
							<td></td><td ><input type="submit" value=" Register "></td>
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
	
	
<?php
    include "footer.php";
?>