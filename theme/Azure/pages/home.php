<?php
	include_once "theme/Azure/pages/header.php";
	if (isset($_GET['username']))
	{
		if (DB::NumRowsQuery("SELECT * FROM ".$emu['users']." WHERE username = '".filter($_GET['username'])."'") == 1)
		{
			$homeUsername = filter($_GET['username']);
		}
		else
		{
			$homeUsername = User::userData("username");
			$error = "Het profiel van " . filter($_GET['username']) . " is niet gevonden in de database. Je eigen profiel wordt nu getoond.";
		}
	}
	else
	{
		$homeUsername = User::userData("username");
	}
	User::updateLastVistorProfile(User::data($homeUsername, "username", "id"));
	$getInfoUserTable = DB::Fetch(DB::Query("SELECT * FROM ".$emu['users']." WHERE username = '".filter($homeUsername)."'"));
?>
<div class="contentLeft">
	<div class="mainBox">
		<div class="boxHeader purple">Over mijzelf</div>
		<div class="inner">
			<?= (!empty($getInfoUserTable['over_mijzelf']) ? $getInfoUserTable['over_mijzelf'] : "Deze gebruiker heeft nog niks over zichzelf verteld.") ?>
		</div>
	</div>
	<div class="mainBox">
		<?php $queryGetBadges = DB::Query("SELECT * FROM ".$emu['user_badges']." WHERE ".$emu['user_id']." = '".$getInfoUserTable['id']."'"); ?>
		<div class="boxHeader skyBlue">Badges van <?= $homeUsername ?> (<?= DB::NumRows($queryGetBadges) ?>)</div>
		<div class="inner" style="height: 146px;overflow-y: scroll;">
			<?php 
				while ($getBadges = DB::Fetch($queryGetBadges))
				{
				?>
				<div class="badge-holder">
					<div style="background: url(<?= $hotel['badges'] ?>/<?= $getBadges['badge_code'] ?>.gif) no-repeat 50% 50%; padding-top: 60px;"></div>
				</div>
				<?php
				}
			?>
		</div>
	</div>
	<div class="mainBox">
		<?php $queryGetFriends = DB::Query("SELECT * FROM messenger_friendships WHERE user_one_id = '".$getInfoUserTable['id']."' ORDER by RAND()"); ?>
		<div class="boxHeader yellow">Vrienden van <?= $homeUsername ?> (<?= DB::NumRows($queryGetFriends) ?>)</div>
		<div class="inner" style="height: 146px;overflow-y: scroll;">
			<?php 
				while ($getFriends = DB::Fetch($queryGetFriends))
				{
				?>
				<a href="?url=home&username=<?= User::data($getFriends['user_two_id'], 'id', 'username') ?>" class="profileFriends">
					<div class="circle staffMember" style="width: 56px; height: 56px;border:2px dotted <?= $rankColors[1] ?>;background: url(<?= $config['url'] ?>/theme/azure/images/avatar/avatar.php?figure=<?= User::data($getFriends['user_two_id'], 'id', 'figure') ?>&amp;head_direction=2&amp;direction=2&amp;gesture=sml) rgba(255, 255, 255, 0.2) -3px -16px no-repeat;"></div>
				</a>
				<?php
				}
			?>
		</div>
	</div>
	<div class="mainBox">
		<div class="boxHeader red">Youtube</div>
		<div class="inner">
			<?= (!empty($getInfoUserTable['youtube']) ? "<object data='http://www.youtube.com/embed/{$getInfoUserTable['youtube']}' width='100%' height='400px'></object>" : "Deze gebruiker heeft nog geen youtube filmpje ingesteld.") ?>
		</div>
	</div>
</div>
<div class="contentRight">
	<div class="mainBox">
		<div class="boxHeader orange">Laatst bekeken door</div>
		<div class="inner">
			Tom, RetroRipper, Tom, RetroRipper, Tom, RetroRipper, Tom, RetroRipper, en 10 anderen
		</div>
	</div>
	<div class="mainBox">
		<div class="boxHeader green">Gastenboek</div>
		<div style="" class="inner">
			<div style="height: 250px;overflow-y: scroll;">
				<div class="gastenboek">
					<img src="https://www.habbo.com/habbo-imaging/avatarimage?figure=cp-3128-62,s-0.hr-677-1028.lg-3434-73-64.ca-1814-62.sh-305-62.he-8210-62-62.hd-180-2.ha-3494-70-62.ch-3215-73&amp;direction=2&amp;head_direction=3&amp;action=crr=667&amp;gesture=sml&amp;headonly=1&amp;size=m" style="    float: left;margin-top: -8px;margin-left: -10px;">
					<div style="float:left">RetroRipper</div> <div style="float:right; font-size:10px;">Dinsdag 29 Maart </div>
					<br>
					<hr>
					<div id="fullMessage" style="margin-top:-5px;font-size:14px;">
						Hallo Tim :D leuke pagina heb jij! kom ook is op die van mij kijken!			
					</div>
				</div>
				
			</div>
			
			 <textarea style="width:100%;" id="comment" rows="6" name="comment" placeholder="Schrijf hier je bericht"></textarea>
           <button class="gastenboekButton">Verstuur bericht</button>
		</div>
	</div>
	<div class="mainBox">
		<div class="boxHeader purple">Zoeken naar een andere gebruiker</div>
		<div style="display: block;"class="inner">
			<div id="errorBoxNews"></div>
			<input type="text" name="searchUserProfileUsername" required="" id="searchUserProfileUsername" placeholder="Geruikersnaam" class="gastenboekInpute">
			<button style="float: right;width: 28%;" id="searchUserProfile" class="gastenboekButton">Zoek</button>
		</div>
	</div>
</div>
<?php
	include_once "theme/Azure/pages/footer.php";
?>		