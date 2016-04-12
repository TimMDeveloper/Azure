$(document).ready(function() { 
	$("#comments").load("../../../account/news.php");
	$('#submitComment').click(function() {
		var comment = $('#comment').val();
		var newsId = $("#newsId").val();
		// console.info('clicked');

		$.ajax({
			url:'../../../account/newsReaction.php',
			method: 'POST',
			dataType: 'json',
			data: {
				submitComment: "", 
				comment:comment, 
				newsId: newsId
			},
			success: function (response) {
				// alert(JSON.stringify(response));

				if (response.succes) {
					$("#errorBoxNews").fadeOut();
					$("#succesBoxNews")
						.fadeIn("18000")
						.text(response.message);
					setTimeout(function() {
						window.location.hash = '#commentBoxjQuery';
					}, 2000);
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
	$('div#deleteReactionSubmit.newsRemove').click(function() {
		console.info('clicked');
		var deleteReaction = $('#deleteReaction').val();
		// console.info('clicked');
		console.log(deleteReaction);

		$.ajax({
			url:'../../../account/newsReaction.php?delete=true',
			method: 'POST',
			dataType: 'json',
			data: {
				deleteReaction:deleteReaction
			},
			success: function (response) {
				// alert(JSON.stringify(response));

				if (response.succes) {
					$("#dialog").dialog("open").text(response.message);
					$("div#newsComment"+deleteReaction+".newsComment").fadeOut("slow");
				}
				else {
					$("#dialog").dialog("open").text(response.message);
				}
			}
		});
	});
});