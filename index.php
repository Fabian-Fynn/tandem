
<?php
	include "config.php";
	$dbh = new PDO($DSN, $DB_USER, $DB_PASS);

    $pagetitle = "Tandem - Lernplattform für Studenten der FH-Salzburg";
    include "intro.php";
?>

	
<div class = "wrapIndex">
<br>
<br>
<br>

	<div class="section s1" id="about">
		<div class="outer">
			<div class="inner">
				<h1>Section 1</h1>
				<br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>

	</div>

	<div class="section s2" id="features">
		<div class="outer">
			<div class="inner">
				<h1>Section 2</h1>
					<br><br><br><br><br><br><br><br>
					<br><br><br><br><br><br><br><br><br><br>
					<br><br><br><br><br><br><br><br><br><br>
					<br><br><br><br><br><br><br><br><br><br>
					<br><br><br><br><br><br><br><br><br><br>
			</div>
		</div>

	</div>

	<div class="section s3">
		<div class="outer">
			<div class="inner">
				<h1>Section 3</h1>
					<br><br><br><br><br><br><br>
			</div>
		</div>

	</div>

	
	
	<div class="section s4" id="register">
		<div class="outer">
			<div class="inner">	
				<div id="regForm">
				<h1>Registrieren</h1>
				
				<form action="person_new.php" method="post">
					
		   			<table border="0" cellspacing="5" cellpadding="2">
						<tr>
							<td><label for="firstname">Vorname:</label></td> <td><input type="text" name="firstname" required></td>
						</tr>
						<tr>
							<td><label for="surname">Nachname:</label></td> <td><input type="text" name="surname" required></td>
						</tr>
						<tr>
							<td><label for="isfemale" >Geschlecht:</label></td>
							<td><input type="radio" name="isfemale" class="radio" value="1"  required>weiblich
								<input type="radio" name="isfemale" class="radio" value="0" required>männlich</td>
						<tr>
							<td><label for="email">FHS E-Mail:</label></td> <td><input type="email" id="email" name="email" required></td>
						</tr>
						<tr>
							<td><label for="password">Passwort:</label></td> <td><input id="txtPassword" type="password" name="password" required></td>
						</tr>
						<tr >
							<td><label for="password">wiederholen:</label></td> <td  id="pwConfirmCell"><input id="txtConfirmPassword" type="password" name="password" onKeyUp="checkPasswordMatch();"  required>
							<img id="pwIndicator"></td>
						</tr>
						<tr>
							<td></td><td ><input type="submit" value="Person hinzufügen"></td>
						</tr>
					</table>
				</form>
		</div>
			<div id="altLogin">
			<h1>Login</h1>
			<form id="alogin" action="login.php" method="post">
			
			<input type="email" name="altMail" id="email" placeholder=" E-Mail">
			<input type="password" name="pwd" id="pwd" placeholder=" Passwort">
			<input type="submit" value=" Login " class="submit" id="submitLogin">
			
			
	</form>
				</div>
		</div>

	</div>
	
	
<?php
    include "footer.php";
?>