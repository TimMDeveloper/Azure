<?php
	if(stristr($_SERVER['REQUEST_URI'], 'class.core.php')){
		die("Whoat?! Hier mag jij niet in komen..");
	}
	
	class Core {
		public static function getMiniMail()
		{
			$getMiniMails = DB::Query("SELECT * FROM mini_mail WHERE user_id_to = '".User::userData("id")."' ORDER by id DESC");
			$mails = array();
			while ($getMails = DB::Fetch($getMiniMails))
			{
				$mails[] = array(
				'id' => $getMails['id'], 
				'from' => User::data($getMails['user_id_from'], "id", "username"), 
				'to' => User::data($getMails['user_id_to'], "id", "username"),
				'message' => $getMails['message'],
				'time' => $getMails['time'],
				'subject' => $getMails['subject'],
				'read' => $getMails['read'],
				'prullenbak' => $getMails['prullenbak'],
				);
			}
			return $mails;
		}
		
		/**
		 * Filters a string for bad words, which are defined in the database
		 * @param String $string The string which has to be filtered
		 * @return String The filtered string
		 */
		public static function checkWordFilter($string, $replacement = '***')
		{
			$getBadWords = DB::Query("SELECT * FROM wordfilter");
			$badWords = [];
			$words = explode(' ', $string);

			while($lol = $getBadWords->fetch_assoc()) {

				for ($i=0; $i < count($words); $i++) { 
					if(strtolower($words[$i]) == strtolower($lol['word'])) {
						//bad word was found
						$words[$i] = $replacement; //$lol['replacement'];
					}
				}
			}
			return implode(' ', $words);
		}
	}	