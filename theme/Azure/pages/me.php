<?php
	include_once "theme/Azure/pages/header.php";
?>
<div class="userContent">
	<div class="userContentHead">
		<div class="userContentAvatar" style="background: url(<?= $config['url'] ?>/theme/azure/images/avatar/avatar.php?figure=<?= User::userData('figure') ?>&amp;direction=2&amp;head_direction=3&amp;action=crr=667&amp;gesture=sml);">
		</div>
	</div>
	<div class="userContentMotto">
		<?= User::userData('motto') ?>
	</div>
	<a href="/?url=client" target="_blank" class="hotel-button" >
	<span class="hotel-button__text">Hotel</span></a>
</div>
<div class="contentLeft">
	<div class="newssilder" id="demoSlider">
		<ul>
			<?php
				$query = DB::Query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 5");
				while($news = DB::Fetch($query)){
				?>
				<li><a href="#<?= $news['id'] ?>"></a></li>
				<?php
				}
			?>
		</ul>
		<?php
			$query = DB::Query("SELECT * FROM cms_news ORDER BY id DESC LIMIT 5");
			while($news = DB::Fetch($query)){
				if($news['type'] == 'news'){
					$id = $news['id'];
					$url = '/?url=news&id=' . $id;
					} else if($news['type'] == 'room'){
					$id = $news['roomid'];
					$url = '/?url=client&room=' . $id;
					} else if($news['type'] == 'page'){
					$url = $news['url'];
				}
			?>
			<div id="<?= $news['id'] ?>">
				<div class="newstxtheader"><?= $news['title'] ?></div> 
				<div class="newstxtheader2"><?= $news['shortstory'] ?></div>
				<div class="enter-hotel-btn">
					<div class="open enter-btn">
						<a href="<?= $url ?>" style="padding: 0 8px 0 19px;"><?= $news['button'] ?></a><b></b>
					</div></div>
					<img src="theme/azure/images/ts/<?= $news['image'] ?>" />
			</div>
			<?php
			}
		?>
	</div>
	<script>
		var demo = $("div#demoSlider").sliderTabs({
			indicators: true,
			mousewheel: false,
			autoplay: '10000',
			panelArrows: true,
			panelArrowsShowOnHover: true,
			tabs: false,
			classes: {
				panel: 'demoPanel'
			}
		});
	</script>
	<div class="mainBox">
		<div style="margin-bottom: 10px;" class="boxHeader darkBlue">Wat is er te doen in <?= $config['name'] ?>?</div>
		<div class="topStory">
			<div style="background: url(http://habboemotion.com/resources/images/topstory/BRPT_TopStory_sabatina_300x187.png) right bottom;" class="topStoryImage"></div>
			<div class="topStoryTxt">
				Welkom in ons nieuwe hotel! Dit is een test bericht dus het klopt niet dus blablablabla
			</div>
		</div>
		<div class="topStory">
			<div style="background: url(http://images.habbo.com/c_images/Top_Story_Images/ts_byebyebighand_hotels.gif) right bottom;" class="topStoryImage"></div>
			<div class="topStoryTxt">
				Welkom in ons nieuwe hotel! Dit is een test bericht dus het klopt niet dus blablablabla
			</div>
		</div>
		
		<div class="topStory">
			<div style="background: url(http://www.habbid.com.br/arquivos/2010/02/ts_habbolympics_01.gif) right bottom;" class="topStoryImage"></div>
			<div class="topStoryTxt">
				Welkom in ons nieuwe hotel! Dit is een test bericht dus het klopt niet dus blablablabla
			</div>
		</div>
		
		
		<div class="topStory">
			<div style="background: url(http://images.habbo.com/c_images/Top_Story_Images/waasa_top_story_news_001.gif) right bottom;" class="topStoryImage"></div>
			<div class="topStoryTxt">
				Welkom in ons nieuwe hotel! Dit is een test bericht dus het klopt niet dus blablablabla
			</div>
		</div>
	</div>
</div>
<div class="contentRight">
	<div class="mainBox">
		<div class="boxHeader Red">Minimail</div>
		<div id="left" style="float: left;">
			<button class="BlueBtn" id="inbox">
				Inbox (0)
			</button>
			<button class="BlueBtn" id="sent">
				Verzonden
			</button>
		</div>
		<div class="right">
			<a href="index.php?url=me&amp;action=delete_all&amp;toWho=Mike">
				<button class="RedBtn" id="delete">
					Verwijder alles
				</button>
			</a>
			<button class="GreenBtn" id="newMail">
				Nieuwe mail
			</button>
		</div>
		<div class="mailContent" id="inbox">
			<?php // echo strtotime("now"); ?>
			<div id="inbox-content" style="display: block;">
				<?php
					$array = Core::getMiniMail();
					$count = DB::NumRowsQuery("SELECT * FROM mini_mail WHERE user_id_to = '".User::userData("id")."'");
			        for ($i=0; $i < $count; $i++) { 
			            $getMails = $array[$i];
					?>
					<div class="mail">
						<div class="title readInfo">
							<img src="https://www.habbo.com/habbo-imaging/avatarimage?figure=<?= User::data($getMails['from'], "username", "figure") ?>&direction=2&head_direction=3&action=crr=667&gesture=sml&headonly=1&size=s" style="float:left; margin-top: -5px;">
							<div id="moreInfo">
								<?= $getMails['from'] ?> - <?= $getMails['subject'] ?> - <?= getFullyDate($getMails['time'], false, false, true) ?>										
								<div class="right">
									<a href="index.php?url=me&amp;action=delete&amp;mail_id=353">
										<img class="hastip" title="" src="/theme/Azure/images/delete_16x16.gif">
									</a>
								</div>
							</div>
						</div>
						<div id="fullMailOpen" style="color: black; margin-top: -7px; display: none;">
							<hr>
							<div id="fullMessage" style="margin-top:-5px;font-size:14px;">
								<?= $getMails['message'] ?>										
							</div>
						</div>
					</div>
					
					<?php
					}
				?>
				<div id="trash-content" style="display: none;">
					<div class="mailError">Je hebt nog geen verwijderde minimails.</div>					
				</div>
			</div>
		</div>
		<div class="mailContent" id="verzonden">
			<?php // echo strtotime("now"); ?>
			<div id="inbox-content" style="display: block;">
				<?php
					$array = Core::getMiniMail();
					$count = DB::NumRowsQuery("SELECT * FROM mini_mail WHERE user_id_from = '".User::userData("id")."'");
			        for ($i=0; $i < $count; $i++) { 
			            $getMails = $array[$i];
					?>
					<div class="mail">
						<div class="title readInfo">
							<img src="https://www.habbo.com/habbo-imaging/avatarimage?figure=<?= User::data($getMails['from'], "username", "figure") ?>&direction=2&head_direction=3&action=crr=667&gesture=sml&headonly=1&size=s" style="float:left; margin-top: -5px;">
							<div id="moreInfo">
								<?= $getMails['from'] ?> - <?= $getMails['subject'] ?> - <?= getFullyDate($getMails['time'], false, false, true) ?>										
								<div class="right">
									<a href="index.php?url=me&amp;action=delete&amp;mail_id=353">
										<img class="hastip" title="" src="/theme/Azure/images/delete_16x16.gif">
									</a>
								</div>
							</div>
						</div>
						<div id="fullMailOpen" style="color: black; margin-top: -7px; display: none;">
							<hr>
							<div id="fullMessage" style="margin-top:-5px;font-size:14px;">
								<?= $getMails['message'] ?>										
							</div>
						</div>
					</div>
					
					<?php
					}
				?>
				<div id="trash-content" style="display: none;">
					<div class="mailError">Je hebt nog geen verwijderde minimails.</div>					
				</div>
			</div>
		</div>
		<div class="mailContent" id="new_email">
			<div id="inbox-content" style="display: block;">
				<form>
					<table>
						<tr>
							<td>Naam</td>
						</tr>
						<tr>
							<td><input type="text" placeholder="Test" name="name"></td>
						</tr>
						<tr>
							<td>Naam</td>
						</tr>
						<tr>
							<td><input type="text" placeholder="Test" name="name"></td>
						</tr>
						<tr>
							<td>Naam</td>
						</tr>
						<tr>
							<td><input type="text" placeholder="Test" name="name"></td>
						</tr>
					</table>
				</form>
				<div id="trash-content" style="display: none;">
					<div class="mailError">Je hebt nog geen verwijderde minimails.</div>					
				</div>
			</div>
		</div>
	</div>
	<div class="mainBox">
		<div class="boxHeader darkBlue">test 3</div>
		Iets 3
	</div>
</div>
<?php
	include'footer.php';
?>