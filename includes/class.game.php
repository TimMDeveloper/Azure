<?php
	if(stristr($_SERVER['REQUEST_URI'], 'class.game.php')){
		die("Whoat?! Hier mag jij niet in komen..");
	}
	class Game 
	{
		public static function sso()
		{
			global $config;
			$timeNow = strtotime("now");
			$sessionKey  = ''.$config['name'].'-'.substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 25).'-SSO';
			$Query = DB::Query("UPDATE players SET auth_ticket = '".$sessionKey."' WHERE id = '".$_SESSION['id']."'");
			$Query2 = DB::Query("UPDATE players SET last_online = '".$timeNow."' WHERE id = '".$_SESSION['id']."'");
		}
		Public static function usersOnline()
		{
			$Query = DB::Query("SELECT active_players FROM server_status");
			$fetch = DB::Fetch($Query);
			return $fetch['active_players'];
		}
		public static function homeRoom()
		{
			if (isset($_GET['room'])) {
				$room = filter($_GET['room']);
				$Query = DB::Query("UPDATE players SET home_room = '".$room."' WHERE id = '".$_SESSION['id']."'");
			}
			else{
				$Query = DB::Query("UPDATE players SET home_room = '".$hotel['homeRoom']."' WHERE id = '".$_SESSION['id']."'");
			}
		}
	}			