<?php
include_once "../includes/class.inc.php";
if (isset($_GET['q']))
{
	if (DB::NumRowsQuery("SELECT email FROM players WHERE email = '".filter($_GET['q'])."'") == 0 && filter_var($_GET['q'], FILTER_VALIDATE_EMAIL))
	{
		echo "#2EAF33";
	}
	else
	{
		echo "#BF0A0A";
	}
}