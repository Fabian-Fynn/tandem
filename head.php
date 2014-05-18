<?php  include "functions.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Tandem - Lernplattform für Studenten der FH-Salzburg </title>
	<link rel="stylesheet" href="style/main.css">
	
	<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:400,700,900' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Nunito:400,300,700' rel='stylesheet' type='text/css'>
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
	