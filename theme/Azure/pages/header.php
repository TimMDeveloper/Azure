<?php
if (!loggedIn())
{
	header("Location: ./index.php");
	exit();
}
?>
<div class="headerMain">
	<div class="headerContent">
	    <div class="logo"></div>
	    <div class="onlineCounter"><div class="OnlineIcon"></div><div class="online"><b><?= Game::usersOnline() ?></b> <?= $config['name'] ?>'s in het hotel</div></div>
	</div>
</div>
<div id="container">
	<div class="statsItems credit"><div class="text"><?= User::userData('credits') ?></div></div>
	<div class="statsItems pixel" style="margin-left: 5px;"><div class="text"><?= User::userData('activity_points') ?></div></div>
	<div class="statsItems diamant" style="margin-left: 5px;"><div class="text"><?= User::userData('vip_points') ?></div></div>
	<div class="statsItems vip" style="margin-left: 5px;"><div class="text">Super VIP</div></div>
	<nav>
		<ul class="menu1">
			<li><a id="menu1_home"><?= $username; ?></a></li>
			<li><a id="menu1_community">Community</a></li>
			<li><a id="menu1_extra">Extra's</a></li>
			<li><a id="menu1_shop">Shop</a></li>
			<li><a href="#">Help</a></li>
			<li style="float:right"><a href="?logout=yes" style="    background-color: #1F3A53;">Uitloggen</a></li>
		</ul>
		<ul class="menu2" id="menu_home">
			<li><a href="?url=me" style="margin-left: -10px;">Homepagina</a></li>
			<li><a href="?url=home&username=<?= $username; ?>">Mijn profiel</a></li>
			<li><a href="?url=settings">Account instellingen</a></li>
			<li><a href="?url=tags">Tags</a></li>
		</ul>
		<ul class="menu2" id="menu_community" style="display: none">
			<li><a href="?url=community" style="margin-left: -10px;">Community</a></li>
			<li><a href="?url=news">Nieuws archief</a></li>
			<li><a href="?url=staff">Staff leden</a></li>
			<li><a href="?url=social">Social Media</a></li>
			<li><a href="?url=fansites">Fansites</a></li>
		</ul>
		<ul class="menu2" id="menu_extra" style="display: none">
			<li><a href="?url=extra" style="margin-left: -10px;">Extra</a></li>
			<li><a href="#">Extra2</a></li>
		</ul>
		<ul class="menu2" id="menu_shop" style="display: none">
			<li><a href="#" style="margin-left: -10px;">Shop</a></li>
			<li><a href="?url=badges">Badges</a></li>
		</ul>
	</nav>