<?php
include_once "../includes/class.inc.php";
if (isset($_GET['delete']))
{
	Article::DeleteReaction();
}
else
{
	Article::AddReaction();
}