<?php  include_once "functions.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Tandem - knowledge sharing plattform for students at the University of Applied Sciences Salzburg </title>

	<link rel="shortcut icon" href="favicon.ico"/>
	<link rel="stylesheet" href="style/main.css">
	<link href='http://fonts.googleapis.com/css?family=Raleway:800,900,500,400,100,300,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,300,400,700,900' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="style/jquery.Jcrop.css" type="text/css" />
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/functions.js"></script>
	
	
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
	