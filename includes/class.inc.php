<?php
	session_start();
	ob_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	$config = Array();
	$config['url'] 		= "http://beta.azurehotel.nl";
	$config['name'] 	= "Azure";
	$config['title'] 	= "Voor jongeren!";
	$config['ip'] 		= $_SERVER['REMOTE_ADDR'];
	// $config['ip'] 		= $_SERVER['HTTP_CF_CONNECTING_IP'];
	$config['skin'] 	= "Azure";
	$config['cms_name'] = "Unnamed CMS 1.0";
	
	$config['emu'] = "comet"; // comet // plus 
	
	//Registratie instellingen.
	$config['motto']	= "Ik ben nieuw op Azure.";
	$config['look'] 	= "lg-280-90.ch-210-1410.hr-893-61.hd-180-1.sh-300-91";
	$config['credits']	= "10000";
	$config['duckets']	= "20000";
	$config['diamonds']	= "0";
	
	//Hotel instellingen
	$hotel['homeRoom'] = "10";
	$hotel['ip'] = '185.120.14.74';
	$hotel['port'] = '30000';
	$hotel['externalVariablesTxt'] = 'http://beta.azurehotel.nl/game11/gamedata/external_variables.txt';
	$hotel['externalOverrideVariablesTxt'] = 'http://beta.azurehotel.nl/game11/gamedata/override/external_override_variables.txt';
	$hotel['externalTextsTxt'] = 'http://beta.azurehotel.nl/game11/gamedata/external_flash_texts.php';
	$hotel['externalOverrideTextsTxt'] = 'http://beta.azurehotel.nl/game11/gamedata/override/external_flash_override_texts.txt';
	$hotel['productdata'] = 'http://beta.azurehotel.nl/game11/gamedata/productdata2.txt';
	$hotel['furnidata'] = 'http://beta.azurehotel.nl/game11/gamedata/furnidata.xml';
	$hotel['clientStartingRevolving'] = 'Welkom in Azure';
	$hotel['swfFolder'] = 'http://beta.azurehotel.nl/game11/gordon/PRODUCTION-201601012205-2266674862528';
	$hotel['habboSwf'] = 'http://beta.azurehotel.nl/game11/gordon/PRODUCTION-201601012205-2266674862528/habbo.swf?v=2';
	$hotel['figuremap'] = 'http://beta.azurehotel.nl/game11/gamedata/figuremap.xml';
	$hotel['figuredata'] = 'http://beta.azurehotel.nl/game11/gamedata/figuredata.xml';
	$hotel['badges'] = "http://beta.azurehotel.nl/game11/c_images/album1584";

	$hiddenField = md5(date("d-m-Y-l"));

	if ($config['emu'] == "comet")
	{
		$emu = array(
			"users" => "players",
			"online_users" => "active_players",
			"active_rooms" => "active_rooms",
			"email" => "email",
			"user_badges" => "player_badges",
			"user_id" => "player_id"
			);
	}
	else
	{
		$emu = array(
			"users" => "users",
			"online_users" => "users_online",
			"active_rooms" => "loaded_rooms",
			"email" => "mail",
			"user_badges" => "user_badges",
			"user_id" => "user_id"
			);
	}
	
	//Benodige bestanden ophalen (classes & functions).
	
	require dirname(__FILE__) . "/class.db.php";
	require dirname(__FILE__) . "/functions.php";
	require dirname(__FILE__) . "/class.user.php";
	require dirname(__FILE__) . "/class.game.php";
	require dirname(__FILE__) . "/class.core.php";
	require dirname(__FILE__) . "/class.article.php";
	// require dirname(__FILE__) . "/class.forum.php";
	// require dirname(__FILE__) . "/class.items.php";
	// require dirname(__FILE__) . '/class.public.php';
	// require dirname(__FILE__) . '/class.ase.php';
	// require dirname(__FILE__) . '/class.stream.php';

	//Database gegevens.
	
	$db = array();
	$db['host'] 		= 'localhost';
	$db['gebruiker'] 	= 'root';
	$db['wachtwoord'] 	= 'TimRR12!';
	$db['db'] 			= 'comet';

	date_default_timezone_set('Europe/Amsterdam');

	//Verbinding maken MYSQL Database.
	
	DB::Initialize($db);

	//Ranken
	
	$rank = [];
	$rank['9'] 		= 'Owner';
	$rank['8'] 		= 'Community Managers';
	$rank['7'] 		= 'Assistant Managers';
	$rank['6'] 		= 'Hoofd Moderators';
	$rank['5'] 		= 'Moderators';
	$rank['4'] 		= 'eXperts';
	$rank['3'] 		= 'Leerlingen';
	$rank['2'] 		= 'Website Developers';
	$rank['1'] 		= 'User';

	$rankColors = [];
	$rankColors['9'] 		= '#2196f3';
	$rankColors['8'] 		= '#f44336';
	$rankColors['7'] 		= '#f44336';
	$rankColors['6'] 		= '#009688';
	$rankColors['5'] 		= '#009688';
	$rankColors['4'] 		= '#80d8ff';
	$rankColors['3'] 		= '#80d8ff';
	$rankColors['2'] 		= '#ff9800';
	$rankColors['1'] 		= '#000000';

	$allowedDeleteNewsReactions = ["2","7","8","9"];
	$badWords = ["kanker", "kuthoer", "geil", "anus", "tering"];
	if (loggedIn())
	{
		$username = User::userData("username");
		//DB::Query("UPDATE users SET lastonline='".strtotime("now")."' WHERE id='".$_SESSION['id']."'");
	}