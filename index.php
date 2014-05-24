
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
		<div class="section" id="s1">
			<div class="outer">
				<div class="inner">
					<h1>What is TANDEM?</h1>

					
					<h2>TANDEM connects students at University of Applied Sciences Salzburg</h2>
					<div class="img triad">
						<div class="left"><img src="img/icons/people.png" alt="Study">Meet new people</div>
						
						<div class="center"><img src="img/icons/success.png" alt="Study">gain knowledge</div>
						
						<div class="right"><img src="img/icons/share.png" alt="Study">share your's</div>
					</div>

					<h2>With TANDEM can learn a variety of things.</h2> 
					<p>From science through economics and music skills to handcrafts and languages.</p>
				</div>

			</div>
		</div>
		<div class="section" id="s2">
			<div class="outer">
				<div class="inner">
					<h1>Share your expertise</h1>
					<h2>No matter what you're good in. Share your knowledge!</h2>
					<p>Save your for private lessons, pay your tutor with your own expertise.</p>
					<img class="img center" src="img/icons/share2.png" alt="Study">
					
				</div>
			</div>

		</div>

		<div id="s3"class="section">
			<div class="outer">
				<div class="inner">
					<h1>Gain knowledge and skills</h1>
					<h2>We all despair at some point.</h2>
					<p>Admit it, you know what i mean.</p>
					<img class="img center" src="img/icons/confusion.png" alt="Study">
					<br>
					<h2>At that point it's good to have a tutor.</h2>
					<img class="img center" src="img/icons/tutor.png" alt="Study">
					<br>
					
				</div>
			</div>

		</div>

		
		
		<div class="section s4" id="register">
			<div class="outer">
				<div class="inner">	
					<h2>So join now, share your knowledge and learn new stuff.</h2>
					<div class="img triad">
						<div class="left"><img src="img/icons/science.png" alt="Study"></div>
						
						<div class="center"><img src="img/icons/sports.png" alt="Study"></div>
						
						<div class="right"><img src="img/icons/music.png" alt="Study"></div>
					</div>
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
										</tr>
										<tr>
											<td><label for="email">FHS E-Mail:</label></td> <td id="mailCell"><input type="email" id="Regmail" name="email" onKeyUp="checkmail()" onChange="checkmail()" placeholder="mmustermann.mmt-b2013@fh-salzburg.ac.at" required>
												<img id="mailValid" src="img/error.png">
											</td>
										</tr>
										<tr>
											<td><label for="password">Password:</label></td> <td id="pwCell"><input id="txtPassword" type="password" name="password" pattern=".{5,10}" onKeyUp="checkPasswordMatch();" title="5-10 letters or numbers." required>
											<img id="pwLength" src="img/error.png">
										</td>
										</tr>
										<tr >
											<td><label for="password">repeat:</label></td> <td id="pwCell"><input id="txtConfirmPassword" type="password" name="password" onKeyUp="checkPasswordMatch();"  required>
											<img id="pwIndicator" src="img/error.png"></td>
										</tr>
										<tr>
											<td></td><td ><input type="submit" value=" Register " ></td>
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


							<div id="impressContent"><h2>Legal Notice</h2>

								
								<?php
									include "legalText.php";
								?>
								
							</div>

								
							</div></div></div>
							<?php
							include "footer.php";
							?>
							<script>
							$(window).scroll(function() {								
									$(".s1").removeClass("highlighted");
									checkvisability($("#s1"));
									checkvisability($("#s2"));
									checkvisability($("#s3"));
									checkvisability($("#register"));

								
							});
				$(function() {
					
					$("#loginButton").removeAttr("href"); 
				});
			

							/* Code by Devin Sturgeon */
							$(function() {
								$('a[href*=#]:not([href=#])').click(function() {
									if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

										var target = $(this.hash);
										target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
										if (target.length) {
											$('html,body').animate({
												scrollTop: (target.offset().top - 50)
											}, 1000);
											return false;
										}
									}
								});
							});
							</script>