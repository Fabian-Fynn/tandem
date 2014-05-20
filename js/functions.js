var loginvisible = false;
function loginslide () {
	if(loginvisible === false){
		$('#slogin').animate({marginTop:"0px"});
		loginvisible = true;
		$('#blogin').css('background-color','#FF4961');
	}
	else{
			$('#slogin').animate({marginTop:"-50px"}, 250);
			setTimeout( function() {
				$('#blogin').css('background-color','#fff');
			}, 240);
			$("#add_err").animate({marginTop:"-19px"},250);
			setTimeout( function() { $("#add_err").html(""); }, 100);
			$("#loginForm").trigger("reset");
			loginvisible = false;
		
		
		
	}

	
}

function JsSwitch () {
	$('#blogin').attr('href', 'javascript:');
	$('#slogin').css('display', 'block');
	$('#login').css('display', 'none');
}

function checkPasswordMatch() {
	var password = $("#txtPassword").val();
	var confirmPassword = $("#txtConfirmPassword").val();
	if (password != confirmPassword)
		$("#pwIndicator").attr("src","img/delete.png");
	else
		$("#pwIndicator").attr("src","img/check.png");
}



$(document).ready(function(){

	//$(".subMenu").css('top', '0px');
	$("#submitLogin").click(function(){	
		email=$("#email").val();
		password=$("#pwd").val();
		$.ajax({
			type: "POST",
			url: "login.php",
			data: "mail="+email+"&pwd="+password,
			success: function(html){ 
				if(html=='true')    {
					window.location="home.php";
				}
				else    {
					
					$("#add_err").animate({marginTop:"0px"},250);
					setTimeout( function() { $("#add_err").html("Wrong Username or Password"); }, 80);
					
				}
			}
		});
		return false;
	});
});

$(document).ready(function(){
	
	$("#submitRequest").click(function(){	
		
		partner=$("#partner").val();
		reqAct=$("#reqAct").val();
		$.ajax({
			type: "POST",
			url: "request.php",
			data: "partner="+partner+"&reqAct="+reqAct,
			success: function(html){ 
				if(html!='false')    {
					if($("#reqAct").val() == "send"){
						$("#submitRequest").val(" Abort ");
			 		//$("#add_err").html(html);											////////////////////////////
			 		$("#reqAct").val("abort");
			 	}
			 	else if($("#reqAct").val() == "abort" || $("#reqAct").val() == "unfriend"){
			 		$("#submitRequest").val(" Add as Buddy ");
			 		//$("#add_err").html(html);											////////////////////////////
			 		$("#reqAct").val("send");
			 	}
			 	else if($("#reqAct").val() == "abortList"){
			 		$("#request_" + partner).remove();
			 	}
			 	else if($("#reqAct").val() == "accept"){
			 		$("#submitRequest").val(" Accept ");
			 		$("#submitRequest").attr("disabled", "disabled");
			 	}
			 	else
			 	{
			 		
			 	}
			 }
			 else    {
			 	
			 	$("#add_err").animate({marginTop:"0px"},250);
				//$("#add_err").html("Es ist ein Fehler aufgetreten :(");
					$("#add_err").html(html);

				}
			}

		});
return false;
});
});

function checkvisability(element){
	var s = element.offset().top;
	highlighter = "."+element.attr('id');
	
	var scrollY = $(window).scrollTop();
	if (scrollY > s-160 && scrollY < s+element.height()-40) {
		removeAllHighlights($(highlighter));
		$(highlighter).addClass("highlighted");
	}
	//else
		
		//$(highlighter).removeClass("highlighted");	
}

function removeAllHighlights(element){
		$(".s1").removeClass("highlighted");
		$(".s2").removeClass("highlighted");
		$(".s3").removeClass("highlighted");
		$(".register").removeClass("highlighted");
		element.addClass("highlighted");

}

function checkmail(){
	mail = $('#Regmail').val();
		console.log(mail);
	if(!mail.match('/^[A-Z0-9._]+@fh-salzburg.ac.at/g') && mail != ""){
		console.log("You have to enter a valid FHS emailadress");
	}
	}
/*
function abortRequest(partner)
{
		   $.ajax({
		   		type: "POST",
			   	url: "request.php",
				data: "partner="+partner,
			   	success: function(html){ 
					if(html!='false')    
					 	$("#request_" + partner).remove(); 	
				}
			});
}

function acceptRequest(partner)
{
	 $.ajax({
		   		type: "POST",
			   	url: "request.php",
				data: "partner="+partner,
			   	success: function(html){ 
					if(html!='false')    
					 	$("#requestForm_" + partner+" submit").value("Anfrage angenommen"); 	
				}
			});
}*/