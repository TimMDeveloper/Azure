$(document).ready(function() {
	$('#registerSubmit').click(function() {
		var username_register = $('#username_register').val();
		var email_register = $("#email_register").val();
		var password_register = $("#password_register").val();
		var password_repeat_register = $("#password_repeat_register").val();
		var hiddenField_register = $("#hiddenField_register").val();

		$.post('../../../account/register.php', { register: "", username_register:username_register, email_register: email_register, password_register: password_register, password_repeat_register: password_repeat_register}, function(result) 
		{
			$("#register").fadeOut("fast");
			$(".loginBox").fadeOut("fast");
			$(".registerLoginBox").fadeIn("fast");
			$(".rightIndex").css("background-image", "none");
			$("#registerForm").fadeIn("fast");
			if (result == 'succes')
			{
				window.location.href = "?url=me";
			}
			else
			{
				$("#errorBoxRegister").fadeIn("18000");
				if (result == "empty_username")
				{
					$("#errorBoxRegister").text("Je hebt geen gebruikersnaam ingevoerd.");
				}
				else if (result == "empty_password")
				{
					$("#errorBoxRegister").text("Je hebt geen wachtwoord ingevoerd.");
				}
				else if (result == "empty_password_repeat")
				{
					$("#errorBoxRegister").text("Je hebt je wachtwoord niet bevestigd.");
				}
				else if (result == "empty_email")
				{
					$("#errorBoxRegister").text("Je hebt geen email ingevoerd.");
				}
				else if (result == "valid_email")
				{
					$("#errorBoxRegister").text("Je email is geen geldig email adres.");
				}
				else if (result == "dubbel_username")
				{
					$("#errorBoxRegister").text("Deze gebruikersnaam bestaat jammer genoeg al.");
				}
				else if (result == "dubbel_email")
				{
					$("#errorBoxRegister").text("Dit email adres staat al in onze database.");
				}
				else if (result == "short_password")
				{
					$("#errorBoxRegister").text("Je wachtwoord moet uit minimaal 6 karakters bestaan.");
				}
				else if (result == "password_repeat_error")
				{
					$("#errorBoxRegister").text("Je wachtwoorden komen niet met elkaar overeen.");
				}
				else if (result == "to_many_ip")
				{
					$("#errorBoxRegister").text("Je mag maar maximaal 3 accounts op dit IP registreren.");
				}
				else
				{
					$("#errorBoxRegister").text("Er is een fout opgetreden! Neem a.u.b. contact op met de Website Beheerder.");
				}	
			}
		});
	});
});
function checkUsernameOrEmail(str, methode) 
{
	if (str.length == 0) { 
	    //document.getElementById("errorBoxRegister").innerHTML = "";
	    return;
	} 
	else 
	{
	    var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
	        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	            // document.getElementById("errorBoxRegister").innerHTML = xmlhttp.responseText;
	            if (methode == "username")
			    {
			    	$("#username_register").css("color", xmlhttp.responseText);
			    }
			    else if (methode == "email")
			    {
			    	$("#email_register").css("color", xmlhttp.responseText);
			    }
			    else
			    {
			    	alert("Dit is geen geldige methode! Neem a.u.b. contact op met de Website Beheerder.");
			    }
	        }
	    };
	    if (methode == "username")
	    {
	    	xmlhttp.open("GET", "checker/username.php?q=" + str, true);
	    	xmlhttp.send();
	    }
	    else if (methode == "email")
	    {
	    	xmlhttp.open("GET", "checker/email.php?q=" + str, true);
	    	xmlhttp.send();
	    }
	    else
	    {
	    	alert("Dit is geen geldige methode! Neem a.u.b. contact op met de Website Beheerder.");
	    }
	}
}
function checkPasswords(str, id)
{
	if (str.length > 6)
	{
		$("#"+id).css("color", "#2EAF33");
	}
	else
	{
		$("#"+id).css("color", "#BF0A0A");
	}
}