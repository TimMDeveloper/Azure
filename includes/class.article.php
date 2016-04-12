<?php
if(stristr($_SERVER['REQUEST_URI'], 'class.article.php')){
	die("Whoat?! Hier mag jij niet in komen..");
}
class Article {
	public static function AddReaction()
	{
		if (isset($_POST['submitComment']))
		{
			if (!empty($_POST['newsId']) && DB::NumRowsQuery("SELECT * FROM cms_news WHERE id = '".filter($_POST['newsId'])."'") == 1)
			{
				if (loggedIn())
				{
					if (DB::NumRowsQuery("SELECT * FROM comments_news WHERE news_id = '".filter($_POST['newsId'])."' && user_id = '".User::userData("id")."' && time >= '".strtotime("-1 minutes")."'") == 0)
					{
						if (!empty($_POST['comment']))
						{
							if (strlen($_POST['comment']) > 4)
							{
								DB::Query("INSERT INTO comments_news (news_id, user_id, news_comment, time) VALUES ('".filter($_POST['newsId'])."', '".User::userData("id")."', '".filter($_POST['comment'])."', '".strtotime("now")."')");
								echo json_encode(['succes' => true, 'message' => 'Je reactie is succesvol geplaatst.']);
							}
							else
							{
								echo json_encode(['succes' => false, 'message' => 'Je moet wel een reactie typen van minimaal 5 tekens.']);
							}
						}
						else
						{
							echo json_encode(['succes' => false, 'message' => 'Je reactie is nog leeg.']);
						}
					}
					else
					{
						echo json_encode(['succes' => false, 'message' => 'Je kunt niet zosnel weer een reactie plaatsen op dit nieuwsbericht.']);
					}
				}
				else
				{
					echo json_encode(['succes' => false, 'message' => 'Je moet ingelogd zijn voor een reactie te plaatsen.']);
				}
			}
			else
			{
				echo json_encode(['succes' => false, 'message' => 'Dit is geen geldig nieuws ID.']);
			}
		}
	}
	public static function DeleteReaction()
	{
		global $allowedDeleteNewsReactions;
		if (loggedIn())
		{
			if (in_array(User::userData("rank"), $allowedDeleteNewsReactions))
			{
				if (DB::NumRowsQuery("SELECT * FROM comments_news WHERE id = '".filter($_POST['deleteReaction'])."'") == 1)
				{
					DB::Query("UPDATE comments_news SET status = '0' WHERE id = '".filter($_POST['deleteReaction'])."'");
					echo json_encode(['succes' => true, 'message' => 'Deze reactie is succesvol verwijderd.']);
				}
				else 
				{
					echo json_encode(['succes' => false, 'message' => 'Deze reactie bestaat niet.']);
				}
			}
			else
			{
				echo json_encode(['succes' => false, 'message' => 'Je hebt geen rechten om deze actie uit te voeren.']);
			}
		}
		else
		{
			echo json_encode(['succes' => false, 'message' => 'Je moet ingelogd zijn voor een reactie te plaatsen.']);
		}
	}
}