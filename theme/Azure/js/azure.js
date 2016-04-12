$(document).ready(function() {
	$("#moreInfo").click(function() {
		$("#fullMailOpen").fadeIn();
	});
	$('.mail').on('click', '.readInfo', function () {
		$(this).next('#fullMailOpen').toggle();
	});
	$('.mail #fullMailOpen').hide();
	$("button#searchUserProfile.gastenboekButton").click(function() {
		var username = $("#searchUserProfileUsername").val();
		if (username !== "")
		{
			window.top.location = "?url=home&username="+username;
		}
		else
		{
			$("#errorBoxNews")
					.fadeIn("18000")
					.text("Je moet wel een gebruikersnaam invoeren.");
		}
	});
	$('#settingsSubmit').click(function() {
		var settings_motto = $('#settings_motto').val();
		var settings_email = $('#settings_email').val();

		$.ajax({
			url:'../../../account/settings.php?general_settings=true',
			method: 'POST',
			dataType: 'json',
			data: {
				settingsSubmit: "", 
				settings_motto:settings_motto, 
				settings_email: settings_email
			},
			success: function (response) {
				// alert(JSON.stringify(response));

				if (response.succes) {
					$("#errorBoxNews").fadeOut();
					$("#succesBoxNews")
						.fadeIn("18000")
						.text(response.message);
				}
				else {
					$("#succesBoxNews").fadeOut();
					$("#errorBoxNews")
						.fadeIn("18000")
						.text(response.message);
				}
			}
		});
	});
	$('#settingsPasswordSubmit').click(function() {
		var settings_password_old = $('#settings_password_old').val();
		var settings_password_new1 = $('#settings_password_new1').val();
		var settings_password_new2 = $('#settings_password_new2').val();
		console.info("clicked");

		$.ajax({
			url:'../../../account/settings.php?password=true',
			method: 'POST',
			dataType: 'json',
			data: {
				settingsPasswordSubmit: "", 
				settings_password_old:settings_password_old, 
				settings_password_new1:settings_password_new1, 
				settings_password_new2:settings_password_new2
			},
			success: function (response) {
				// alert(JSON.stringify(response));

				if (response.succes) {
					$("#errorBoxSettingsPassword").fadeOut();
					$("#succesBoxSettingsPassword")
						.fadeIn("18000")
						.text(response.message);
				}
				else {
					$("#succesBoxSettingsPassword").fadeOut();
					$("#errorBoxSettingsPassword")
						.fadeIn("18000")
						.text(response.message);
				}
			}
		});
	});
});
function checkLength(str, id, min_length)
{
	if (str.length > min_length)
	{
		$("#"+id).css("color", "#2EAF33");
	}
	else
	{
		$("#"+id).css("color", "#BF0A0A");
	}
}
function getQuery(name)
{
		if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
    	return decodeURIComponent(name[1]);
}
$(document).ready(function() {
	$("#containerIndex").fadeIn("slow");
	$("#register").click(function() {
		$("#register").fadeOut(300);
		$(".loginBox").fadeOut(300);
		$(".registerLoginBox").delay(300).fadeIn(300);
		$(".rightIndex").css("background-image", "none");
		$("#registerForm").fadeIn("18000");
	});
	$("#registerLoginButton").click(function() {
		$("#register").fadeIn(300);
		$(".loginBox").fadeIn(300);
		$(".registerLoginBox").fadeOut(300);
		$(".rightIndex").css("background-image", "url(../theme/<?= $config['skin'] ?>/images/index_background_container2.png)");
		$("#registerForm").fadeOut(300);
	});
	$("#menu1_home").mouseover(function() {
		$("#menu_home").show();
		$("#menu_community").hide();
		$("#menu_extra").hide();
		$("#menu_shop").hide();
	});
	$("#menu1_community").mouseover(function() {
		$("#menu_home").hide();
		$("#menu_community").show();
		$("#menu_extra").hide();
		$("#menu_shop").hide();
	});
	$("#menu1_extra").mouseover(function() {
		$("#menu_home").hide();
		$("#menu_community").hide();
		$("#menu_extra").show();
		$("#menu_shop").hide();
	});
	$("#menu1_shop").mouseover(function() {
		$("#menu_home").hide();
		$("#menu_community").hide();
		$("#menu_extra").hide();
		$("#menu_shop").show();
	});
	$("#sent").click(function() {
		$("div#inbox.mailContent").fadeOut("18000");
		$("div#verzonden.mailContent").fadeIn("18000");
		$("div#new_email.mailContent").fadeOut("18000");
	});
	$("#inbox").click(function() {
		$("div#inbox.mailContent").fadeIn("18000");
		$("div#verzonden.mailContent").fadeOut("18000");
		$("div#new_email.mailContent").fadeOut("18000");
	});
	$("#newMail").click(function() {
		$("div#inbox.mailContent").fadeOut("18000");
		$("div#verzonden.mailContent").fadeOut("18000");
		$("div#new_email.mailContent").fadeIn("18000");
	});
});
$(function() {
	$("#dialog" ).dialog({
	  autoOpen: false
	});
});