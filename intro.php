<?php include "head.php" ?>
<link rel="stylesheet" href="style/index.css">
<link rel="stylesheet" href="style/indexNav.css">

</head>


<div class="subMenu" >
	 	<div class="outer"><div class="inner">
	 		<a href="#title" id="around" rel="m_PageScroll2id" class="subNavBtn">TANDEM</a> 
	 		<div id="menuwrapper">
				<a href="#s1"  rel="m_PageScroll2id" class="subNavBtn s1">what's TANDEM?</a>
				<a href="#s2"  rel="m_PageScroll2id" class="subNavBtn s2">Section 2</a>
				<a href="#s3"  rel="m_PageScroll2id" class="subNavBtn s3">Section 3</a>
				<a href="#register"  rel="m_PageScroll2id" class="subNavBtn register">register</a>
				<a href="#register" id="loginButton" class="subNavBtn" onmouseover="loginslide('hover')" onclick="loginslide('click')" >login</a>
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
		<li><a href="#">Home</a></li>
		<li><a href="#about">About</a></li>
		<li><a href="#features">Features</a></li>
		<li><a href="#">Design</a></li>
		<li><a href="#">Web 2.0</a></li>
		<li><a href="#">Tools</a></li>	
	</ul>
	<a href="#" id="pull"><img src="img/nav-brand.png"></a>
</nav>

<div id="title"><div class="logo">
		<h1>TANDEM</h1>
		</div>
		<div id="catch">
		<h2>Students share Knowledge</h2>
		</div>
		<div class="more"><a href="#s1">more</a><img src="img/icons/down.png" alt="down"></div>
	</div>
 <div id="around"><div class="intro" >
	 </div>
</div>
<div class="siteContainer">
<script>

$(window).scroll(function() {
   
    if(!(document.body.scrollHeight - $(this).scrollTop()  <= $(this).height()+100))
    {
    	$(".register").removeClass("highlighted");
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

	
