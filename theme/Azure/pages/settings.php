<?php
	include_once "theme/Azure/pages/header.php";
?>
<div class="contentLeft">
	<div class="mainBox">
		<div class="boxHeader darkBlue">Verander jouw algemene instellingen</div>
		<div class="inner">
			<div id="errorBoxNews"></div>
			<div id="succesBoxNews"></div>
			<h3>Jouw motto</h3>
			<input type="text" name="settings_motto" required="" id="settings_motto" value="<?= User::userData("motto") ?>" placeholder="Motto" class="settings"></input>
			<h3>Jouw email</h3>
			<input type="email" name="settings_email" required="" id="settings_email" value="<?= User::userData("email") ?>" class="settings"></input>
			<div id="settingsSubmit" name="settingsSubmit" value="Verander jouw algemene instellingen" class="settings">Verander jouw algemene instelingen</div>
		</div>
	</div>
	<div class="mainBox">
		<div class="boxHeader darkBlue">Verander jouw wachtwoord</div>
		<div class="inner">
			<div id="errorBoxSettingsPassword"></div>
			<div id="succesBoxSettingsPassword"></div>
			<h3>Jouw oude wachtwoord</h3>
			<input type="password" name="settings_password_old" required="" onkeyup="checkPasswords(this.value, 'settings_password_old')"id="settings_password_old" placeholder="Oude wachtwoord" class="settings"></input>			
			<h3>Jouw nieuwe wachtwoord</h3>
			<input type="password" name="settings_password_new1" required="" onkeyup="checkPasswords(this.value, 'settings_password_new1')" id="settings_password_new1" placeholder="Nieuwe wachtwoord" class="settings"></input>	
			<h3>Herhaal je nieuwe wachtwoord</h3>
			<input type="password" name="settings_password_new2" required="" onkeyup="checkPasswords(this.value, 'settings_password_new2')" id="settings_password_new2" placeholder="Herhaal nieuwe wachtwoord" class="settings"></input>	
			<div id="settingsPasswordSubmit" name="settingsPasswordSubmit" value="Verander jouw wachtwoord" class="settings">Verander jouw wachtwoord</div>
		</div>
	</div>
</div>
<div class="contentRight">
	<div class="mainBox">
		<div class="boxHeader darkBlue">Account settings</div>
		<div class="inner">
			Test
		</div>
	</div>
</div>
<?php
	include_once "theme/Azure/pages/footer.php";
?>