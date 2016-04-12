<?php
include_once "../includes/class.inc.php";
if (isset($_GET['password']))
{
	User::SettingsPassword();
}
elseif (isset($_GET['general_settings']))
{
	User::SettingsGeneral();
}
else
{
	echo "Geen toegang!";
}