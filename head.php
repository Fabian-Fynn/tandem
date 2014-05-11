<?php  include "functions.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Tandem - Lernplattform für Studenten der FH-Salzburg </title>
	
	<link rel="stylesheet" href="style/index.css">
	<link rel="stylesheet" href="style/main.css">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
	
	
	
	<script src="js/functions.js"></script>
	<script src="js/jquery.appear.js"></script>
	<script src="js/jquery.smint.js"></script>
	
	
	<script>
		
		$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();
			
			
				
			
			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
				
				
        		}
    		});
		});

	</script>
	<?php 
	$page = basename($_SERVER['PHP_SELF'], ".php");
	if($page != "image_upload")
	{
	?>	
	<script type="text/javascript">
		
		$(document).ready( function() {

			//if(loginvisible === false)
			//	$('#login :input').attr("disabled", true);
			
			
			
			$('.subMenu').smint({
    			'scrollSpeed' : 1000
    		});
			
			
		});
	</script>
	<?php
}
?>