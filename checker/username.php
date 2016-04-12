<?php
include_once "../includes/class.inc.php";
if (isset($_GET['q']))
{
	if (DB::NumRowsQuery("SELECT username FROM players WHERE username = '".filter($_GET['q'])."'") == 0)
	{
		echo "#2EAF33";
	}
	else
	{
		echo "#BF0A0A";
	}
}