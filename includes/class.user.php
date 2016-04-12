<?php
	if(stristr($_SERVER['REQUEST_URI'], 'class.user.php')){
		die("Whoat?! Hier mag jij niet in komen..");
	}
	class User 
	{
		public static function data($var, $where, $key)
		{
			global $emu;
			if (loggedIn())
			{
				$Query = DB::Query("SELECT * FROM ".$emu['users']." WHERE $where = '" . $var . "'");
				$fetch = DB::Fetch($Query);
				return $fetch[$key];
			}
			return false;
		}
		public static function userData($key)
		{
			global $emu;
			if (loggedIn())
			{
				$Query = DB::Query("SELECT * FROM ".$emu['users']." WHERE id = '" . $_SESSION['id'] . "'");
				$fetch = DB::Fetch($Query);
				return $fetch[$key];
			}
			return false;
		}
		public static function ranks($var, $where)
		{
			global $emu;
			if (loggedIn())
			{
				$Query = DB::Query("SELECT * FROM ".$emu['users']." WHERE $where = '" . $var . "'");
				return $Query;
			}
			return false;
		}
		public static function checkUser($password, $passwordDb)
		{
			//Global $db;
			//$sqlControleer = DB::query("SELECT * FROM ".$emu['users']." WHERE username = '" . $username . "' LIMIT 1");
			//if (DB::NumRows($sqlControleer) > 0)
			//{
			//$sqlControleerFetch = DB::Fetch($sqlControleer);
			if (password_verify($password, $passwordDb))
			{
				return true;
			}
			return false;
			
			// }
			// else
			// {
			// 	return false;
			// }
		}
		public static function Login()
		{
			global $hiddenField, $emu;
			if (isset($_POST['login']) && isset($_POST['hiddenField']) && $_POST['hiddenField'] == $hiddenField)
			{
				// Ban checken
				if (!empty($_POST['username']))
				{
					if (!empty($_POST['password']))
					{
						if (DB::NumRowsQuery("SELECT * FROM ".$emu['users']." WHERE username = '".filter($_POST['username'])."'") == 1)
						{
							$getInfo = DB::Fetch(DB::Query("SELECT id, password FROM ".$emu['users']." WHERE username = '".filter($_POST['username'])."'"));
							if (self::checkUser($_POST['password'], $getInfo['password']))
							{
								$_SESSION['id'] = $getInfo['id'];
								return succesLogin("Je bent succesvol ingelogd.<script type='text/javascript'>window.top.location='?url=me';</script>");
							}
							return errorLogin("Je wachtwoord klopt niet!");
						}
						return errorLogin("Deze gebruikersnaam bestaat niet.");
					}
					return errorLogin("Je hebt geen wachtwoord ingevuld.");
				}
				return errorLogin("Je hebt geen gebruikersnaam ingevuld.");
			}
		}
		public static function hashed($password)
		{
			return password_hash($password, PASSWORD_DEFAULT);
		}
		public static function Register()
		{
			global $hiddenField, $config, $emu;
			if (isset($_POST['register']))
			{
				if (!empty($_POST['username_register']))
				{
					if (!empty($_POST['password_register']))
					{
						if (!empty($_POST['password_repeat_register']))
						{
							if (!empty($_POST['email_register']))
							{
								if (filter_var($_POST['email_register'], FILTER_VALIDATE_EMAIL))
								{
									if (DB::NumRowsQuery("SELECT username FROM ".$emu['users']." WHERE username = '".filter($_POST['username_register'])."'") == 0)
									{
										if (DB::NumRowsQuery("SELECT '".$emu['email']."' FROM ".$emu['users']." WHERE '".$emu['email']."' = '".filter($_POST['email_register'])."'") == 0)
										{
											if (strlen($_POST['password_register']) > 5)
											{
												if ($_POST['password_register'] == $_POST['password_repeat_register'])
												{
													if (DB::NumRowsQuery("SELECT reg_ip FROM ".$emu['users']." WHERE reg_ip = '".checkCloudflare()."'") < 4)
													{
														DB::Query("
														INSERT INTO
														".$emu['users']."
														(username, password, rank, motto, account_created, '".$emu['email']."', figure, last_ip, reg_ip, credits, activity_points, vip_points)
														VALUES
														(
														'".filter($_POST['username_register'])."', 
														'".self::hashed($_POST['password_register'])."', 
														'1', 
														'".$config['motto']."', 
														'".strtotime("now")."', 
														'".filter($_POST['email_register'])."', 
														'".$config['look']."', 
														'".checkCloudflare()."', 
														'".checkCloudflare()."', 
														'".$config['credits']."',
														'".$config['duckets']."',
														'".$config['diamonds']."'
														)
														");
														$_SESSION['id'] = $getInfo['id'];
														echo "succes";
													}
													else
													{
														echo "to_many_ip"; // errorRegister("Je mag maximaal 3 accounts op je IP hebben staan.");
													}
												}
												else
												{
													echo "password_repeat_error"; // errorRegister("Je hebt geen gebruikersnaam ingevoerd.");
												}
											}
											else
											{
												echo "short_password"; // errorRegister("Je hebt geen gebruikersnaam ingevoerd.");	
											}
										}
										else
										{
											echo "dubbel_email"; // errorRegister("Blah");
										}
									}
									else
									{
										echo "dubbel_username"; // errorRegister("Blah");
									}
								}
								else
								{
									echo "valid_email"; // errorRegister("Dit is geen geldig '".$emu['email']."' adres!");
								}
							}
							else
							{
								echo "empty_email"; // errorRegister("Je hebt geen gebruikersnaam ingevoerd.");
							}
						}
						else
						{
							echo "empty_password_repeat"; // errorRegister("Je hebt geen gebruikersnaam ingevoerd.");
						}
					}
					else
					{
						echo "empty_password"; // errorRegister("Je hebt geen gebruikersnaam ingevoerd.");
					}
				}
				else
				{
					echo "empty_username";
				}
			}
		}
		public static function SettingsGeneral()
		{
			global $emu;
			if (isset($_POST['settingsSubmit']))
			{
				if (!empty($_POST['settings_email']))
				{
					if (filter_var($_POST['settings_email'], FILTER_VALIDATE_EMAIL))
					{
						if (User::userData($emu['email']) == $_POST['settings_email'])
						{
							DB::Query("UPDATE ".$emu['users']." SET motto = '".filter($_POST['settings_motto'])."' WHERE id = '".User::userData("id")."'");
							echo json_encode(["succes" => true, "message" => "Je algemene instellingen zijn succesvol veranderd."]);
						}
						elseif (DB::NumRowsQuery("SELECT '".$emu['email']."' FROM ".$emu['users']." WHERE '".$emu['email']."' = '".filter($_POST['settings_email'])."'") == 0)
						{
							DB::Query("UPDATE ".$emu['users']." SET motto = '".filter($_POST['settings_motto'])."', '".$emu['email']."' = '".filter($_POST['settings_email'])."' WHERE id = '".User::userData("id")."'");
							echo json_encode(["succes" => true, "message" => "Je algemene instellingen zijn succesvol veranderd."]);
						}
						else
						{
							echo json_encode(["succes" => false, "message" => "Dit email adres is al in gebruik."]);
						}
					}
					else
					{
						echo json_encode(["succes" => false, "message" => "Dit is geen geldig email adres."]);
					}
				}
				else
				{
					echo json_encode(["succes" => false, "message" => "Je email adres is leeg."]);
				}
			}
		}
		public static function SettingsPassword()
		{
			global $emu;
			if (isset($_POST['settingsPasswordSubmit']))
			{
				if (!empty($_POST['settings_password_old']) && !empty($_POST['settings_password_new1']) && !empty($_POST['settings_password_new2']))
				{
					if (self::checkUser($_POST['settings_password_old'], User::userData("password")))
					{
						if ($_POST['settings_password_new1'] == $_POST['settings_password_new2'])
						{
							if (strlen($_POST['settings_password_new1']) > 5)
							{
								DB::Query("UPDATE ".$emu['users']." SET password = '".self::hashed($_POST['settings_password_new1'])."' WHERE id = '".User::userData("id")."'");
								echo json_encode(["succes" => true, "message" => "Je wachtwoord is succesvol aangepast."]);
							}
							else
							{
								echo json_encode(["succes" => false, "message" => "Je wachtwoord moet uit minimaal 6 tekens bestaan."]);
							}
						}
						else
						{
							echo json_encode(["succes" => false, "message" => "Je wachtwoorden komen niet overeen."]);
						}
					}
					else
					{
						echo json_encode(["succes" => false, "message" => "Je oude wachtwoord klopt niet."]);
					}
				}
				else
				{
					echo json_encode(["succes" => false, "message" => "Je hebt niet alle velden ingevuld."]);
				}
			}
		}
		public static function updateLastVistorProfile($profileId = '')
		{
			if ($profileId !== User::userData("id"))
			{
				$checkLast = DB::Query("SELECT * FROM profile_visitors WHERE profile_id = '".filter($profileId)."' && user_id = '".User::userData("id")."'");
				if (DB::NumRows($checkLast) == 1)
				{
					return DB::Query("UPDATE profile_visitors SET last_time = '".strtotime("now")."' WHERE user_id = '".User::userData("id")."'");
				}
				else
				{
					return DB::Query("INSERT INTO profile_visitors (profile_id, user_id, last_time) VALUES ('".$profileId."','".User::userData("id")."','".strtotime("now")."')");
				}
			}
		}
	}		