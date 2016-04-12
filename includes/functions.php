<?php
	if(stristr($_SERVER['REQUEST_URI'], 'functions.php')){
		die("Whoat?! Hier mag jij niet in komen..");
	}
	function error($value)
	{
		echo "<div class='alert-danger3' style='width: 99%;'>" . $value . "</div>";
	}
	function errorLogin($value)
	{
		echo "<div class='errorBoxLogin'>" . $value . "</div>";
	}
	function errorRegister($value)
	{
		echo "<div class='errorBoxRegister'>" . $value . "</div>";
	}
	function succes($value)
	{
		echo "<div class='alert-success' style='padding: 12px;border: 1px solid rgb(143, 177, 115);'>" . $value . "</div>";
	}
	function succesLogin($value)
	{
		echo "<div class='succesBoxLogin'>" . $value . "</div>";
	}
	function succesRegister($value)
	{
		echo "<div class='succesBoxRegister'>" . $value . "</div>";
	}
	
	
	function emuUse()
	{
		global $config;
		switch ($config['emu']) 
		{
			case 'comet':
			$tbUsers = "players";
			$tbServerOnline = "active_players";
			$tbServerRooms = "active_rooms";
			break;
			
			case 'plus':
			$tbUsers = "users";
			$tbServerOnline = "users_online";
			$tbServerRooms = "loaded_rooms";
			break;
		}	
	}
	
	
	function filter($input) 
	{
		//global $db;
		$output = $input;
		
		//$output = addslashes($output);
		$output = DB::Escape($output);
		$output = htmlspecialchars($output);
		
		return $output;
	}
	function getFullyDate($time, $stijd = true, $sjaar = true, $cty = false) 
	{
		if(!is_numeric($time)) 
		{
			$time = strtotime($time);
		}
		
		if($cty) 
		{
			if(date("d-m-Y", strtotime("+1 week")) == date("d-m-Y", $time)) {
				return "Over een week";
				} else if(date("d-m-Y", strtotime("+6 days")) == date("d-m-Y", $time)) {
				return "Over 6 dagen";
				} else if(date("d-m-Y", strtotime("+5 days")) == date("d-m-Y", $time)) {
				return "Over 5 dagen";
				} else if(date("d-m-Y", strtotime("+4 days")) == date("d-m-Y", $time)) {
				return "Over 4 dagen";
				} else if(date("d-m-Y", strtotime("+3 days")) == date("d-m-Y", $time)) {
				return "Over 3 dagen";
				} else if(date("d-m-Y", strtotime("+2 days")) == date("d-m-Y", $time)) {
				return "Overmorgen";
				} else if(date("d-m-Y", strtotime("+1 day")) == date("d-m-Y", $time)) {
				return "Morgen";
				} else if(date("d-m-Y") == date("d-m-Y", $time)) {
				return "Vandaag om ".date("H:i", $time)."";
				} else if(date("d-m-Y", strtotime("-1 day")) == date("d-m-Y", $time)) {
				return "Gisteren om ".date("H:i", $time)."";
			}
		}
		
		//$dagen = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday');
		$dagen = Array('Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag');
		//$maanden = array('January','February','March','April','May','June','July ','August','September','October','November','December');
		$maanden = Array('Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December');
		
		$dag = $dagen[(date("N", $time) - 1)];
		$datum = date("j", $time);
		$maand = $maanden[(date("n", $time) - 1)];
		$jaar = date("Y", $time);
		$uren = date("H", $time);
		$minuten = date("i", $time);
		$seconden = date("s", $time);
		
		return $dag . " " . $datum . " " . $maand . " " . (($sjaar) ? $jaar : '') . (($stijd) ? " on " . $uren . ":" . $minuten . "":"");
	}
	function randomHasher()
	{
		return substr(md5(substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()-ABCDEFGHIJKLMNOPQRSTUVWXYZ?><`~", 5)), 0, 25)), 1, -19);
	}
	function PHPMailer($to, $subject, $message, $meldingTrue)
	{
		require './includes/PHPMailer-master/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug   = 0;										//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPAutoTLS = false;	
		$mail->Debugoutput = 'html';								//Ask for HTML-friendly debug output
		$mail->Host        = "mail.camwijsradio.nl"; 				//Set the hostname of the mail server
		$mail->Port        = 25;									//Set the SMTP port number - likely to be 25, 465 or 587
		$mail->SMTPAuth    = true;									//Whether to use SMTP authentication
		$mail->Username    = "tim@camwijsradio.nl";					//Username to use for SMTP authentication
		$mail->Password    = "***";							//Password to use for SMTP authentication
		$mail->setFrom('tim@camwijsradio.nl', 'CamwijsRadio');
		$mail->addAddress($to); 									// Name is optional
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = $subject;
		$mail->Body    = $message;
		if (!$mail->send()) {
			return error('Message could not be sent.<br> Mail error: ' . $mail->ErrorInfo);
		} 
		else 
		{
			return succes($meldingTrue);
		}
	}
	function ago($time) {
		$ago = time() - intval($time);
		if ($ago < 60) {
			$agotype = 'seconds';
			$agoval = $ago;
			} elseif ($ago < 3600) {
			$agotype = 'minutes';
			$agoval = (int) ($ago / 60);
			} elseif ($ago < 86400) {
			$agotype = 'hours';
			$agoval = (int) ($ago / 3600);
			} elseif ($ago < 604800) {
			$agotype = 'days';
			$agoval = (int) ($ago / 86400);
			} elseif ($ago < 2592000) {
			$agotype = 'weeks';
			$agoval = (int) ($ago / 604800);
			} elseif ($ago < 31536000) {
			$agotype = 'months';
			$agoval = (int) ($ago / 2592000);
			} else {
			$agotype = 'years';
			$agoval = (int) ($ago / 31536000);
		}
		return array ($agotype, $agoval);
	}
	function loggedIn()
	{
		if (isset($_SESSION['id']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function checkCloudflare()
	{
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) 
		{
			$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
			return $_SERVER['REMOTE_ADDR'];
		}
		else
		{
			return $_SERVER['REMOTE_ADDR'];
		}
	}
?>	