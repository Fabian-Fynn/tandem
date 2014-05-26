<?php include "head.php" ?>
<link rel="stylesheet" href="amaran/css/themes/user.css">
<link rel="stylesheet" href="style/index.css">
<link rel="stylesheet" href="style/indexNav.css">
<link rel="stylesheet" href="amaran/css/jquery.amaran.css">


</head>
<script src="amaran/js/jquery.amaran.js"></script>
<div class="subMenu" >
	 	<div class="outer"><div class="inner">
	 		<a href="index.php" id="around" rel="m_PageScroll2id" class="subNavBtn">TANDEM</a> 
	 		<div id="menuwrapper">
				<a href="#s1"  rel="m_PageScroll2id" class="subNavBtn s1">About</a>
				<a href="#s2"  rel="m_PageScroll2id" class="subNavBtn s2">Share</a>
				<a href="#s3"  rel="m_PageScroll2id" class="subNavBtn s3">Gain</a>
				<a href="#register"  rel="m_PageScroll2id" class="subNavBtn register">Register</a>
				<a href="#register" id="loginButton" class="subNavBtn" onclick="loginslide()" >Login</a>
			</div>
		</div>
			
		</div>
		
	<form id="slogin" action="./" method="post">
		<div id="loginForm">
		<input type="email" name="mail" id="email" placeholder=" E-Mail">
		<input type="password" name="pwd" id="pwd" placeholder=" Passwort">
        <input type="submit" value=" Login " class="submit" id="submitLogin">
		</div>
			<div id="add_err"></div>
	</form>
			
	</div>
	
<nav class="clearfix">
	<ul class="clearfix">
		<li><a href="#title"  onclick="menu.slideToggle();">TANDEM</a></li>
		<li><a href="#s1"  onclick="menu.slideToggle();">About</a></li>
		<li><a href="#s2"  onclick="menu.slideToggle();">Share</a></li>
		<li><a href="#s3"  onclick="menu.slideToggle();">Gain</a></li>
		<li><a href="#register"  onclick="menu.slideToggle();">Register/Login</a></li>
		<li><a href="#impressum"  onclick="menu.slideToggle();">Legal Notice</a></li>	
	</ul>
	<a href="#" id="pull"><img src="img/nav-brand.png"></a>
</nav>
<?php
	
?>
<div id="title"><div class="logo">
	<?php if (isset($_GET['msgId'])):
		if($_GET['msgId'] == "1"){
	?>
		<div id="message">
			<h1>Account successfully activated!</h1>
			<p>Please login now</p>
		</div>
	<?php
	} 
		if($_GET['msgId'] == "2"){
	?>
		<div id="message" class="bad">
			<h1>Account activation failed!</h1>
			<a href="mailto:fhoffmann.mmt-b2013@fh-salzburg.at"><p>Please contact me</p></a>
		</div>
	<?php
	}

	if($_GET['msgId'] == "3"){
		
	?>
		<div id="message" class="bad">
			<h1>Registration failed!</h1>
			<br>
					<ul>
						<?php
						if(isset($errors)){
							foreach ($errors as $error) {
								echo("<li>".$error."</li>");
							}
						}
						?>

					</ul>
					<a href="#register"><button> Try again </button></a>
			<a href="mailto:fhoffmann.mmt-b2013@fh-salzburg.at"><button> Contact me </button></a>
		</div>
	<?php
	}
	if($_GET['msgId'] == "4"){
	?>
		<div id="message">
			<h1>Message for you!</h1>
			<p>We send you an activation mail. Please click the included link.</p>
		</div>
	<?php
	} 
	endif;
	?>
		<img src="img/icons/cap.png" alt="TANDEM">
		<h1>TANDEM</h1>
		
		
		<div id="catch">
		<h2>Students share Knowledge</h2>
		
			
		</div>
		<div id="arrow"><a href="#s1" id="more"><div class="more"> <img src="img/icons/down.png" alt="down"></div></a></div>
		</div>
		
	</div>
 <div id="around"><div class="intro" ><img src="img/intro/intro.jpg">
	 </div>
</div>

<?php
	
?>
<div class="siteContainer">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script >

$(document).ready(function() {

	setTimeout(bounce, 500);
  

});

function bounce(){
	$("#arrow").effect( "bounce", {  distance: 35, direction: "down" }, 900 );
	setTimeout(bounce, 3500);	
}
 $.amaran({
    content:{
        img:'img/fabi.png',
        user:'Fabian Hoffmann',
        message:'Multimedia Technology student at University of Applied Science Salzburg'
       },
    theme:'user blue',
});
</script>
	
