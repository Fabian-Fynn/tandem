<?php
	include "head.php";
	$page = basename($_SERVER['PHP_SELF'], ".php");
	if($page === "image_upload")
	{
	?>	

	 <link rel="stylesheet" href="style/imgPicker.css">
<?php	
}
	



?>
	<link rel="stylesheet" href="style/nav.css">
</head>
<div class="subMenu" >
	 	<div class="outer"><div class="inner">
	 		<a href="home.php" id="intro" class="subNavBtn">Home</a> 
			<a href="profil.php" id="s1" class="subNavBtn">Profil</a>
			<a href="matches.php" id="s2" class="subNavBtn">Matches</a>
			<a href="buddies.php" id="s3" class="subNavBtn">Buddies</a>
			<a href="#register" id="s4" class="subNavBtn end">Reg</a>
			<a href="logout.php"  class="subNavBtn" >Logout</a>
			</div>
		</div>
	</div>
	
<nav class="clearfix">
	<ul class="clearfix">
		<li><a href="#">Home</a></li>
		<li><a href="#about">About</a></li>
		<li><a href="#features">Features</a></li>
		<li><a href="#">Design</a></li>
		<li><a href="#">Web 2.0</a></li>
		<li><a href="#">Tools</a></li>	
	</ul>
	<a href="#" id="pull"><img src="img/nav-brand.png"></a>
</nav>