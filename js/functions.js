var loginvisible = false;
function loginslide () {
	if(loginvisible === false){
		$('#slogin').animate({marginTop:"0px"});
		loginvisible = true;
	}
	else{
		$('#slogin').animate({marginTop:"-50px"});
		loginvisible = false;
		$("#add_err").animate({marginTop:"-19px"},250);
		setTimeout( function() { $("#add_err").html(""); }, 100);
		$("#loginForm").trigger("reset");
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
				setTimeout( function() { $("#add_err").html("Benutzername oder Passwort falsch"); }, 80);
			 	
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
			 		$("#submitRequest").val(" Anfrage abbrechen ");
			 		//$("#add_err").html(html);											////////////////////////////
			 		$("#reqAct").val("abort");
			 	}
			 	else if($("#reqAct").val() == "abort" || $("#reqAct").val() == "unfriend"){
			 		$("#submitRequest").val(" Buddyanfrage senden ");
			 		//$("#add_err").html(html);											////////////////////////////
			 		$("#reqAct").val("send");
			 	}
			 	else if($("#reqAct").val() == "abortList"){
			 		$("#request_" + partner).remove();
			 	}
			 	else if($("#reqAct").val() == "accept"){
			 		$("#submitRequest").val(" Anfrage angenommen ");
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