<link href="<?= $config['url'] ?>/theme/<?= $config['skin'] ?>/css/index.css" rel="stylesheet">
<div class="header">
    <div class="logo"></div>
    <div class="onlineCounterIndex"><div class="online"><?= Game::usersOnline() ?> <?= $config['name'] ?>'s online</div></div>
</div>
<div id="containerIndex">
	<div class="leftIndex">
		<div class="loginBox">
			<?php User::Login(); ?>
			<div style="font-size: 28px; color: #acafb5;">Log in</div>
			<form method="POST">
				<input type="hidden" name="hiddenField" value="<?= $hiddenField ?>"></input>
				<input type="text" name="username" placeholder="<?= $config['name'] ?> naam" class="login"></input>
				<input type="password" name="password" placeholder="Wachtwoord" class="login"></input>
				<div class="forgotPassword"><a href="#">Wachtwoord vergeten?</a></div>
				<input type="submit" name="login" value="Login" class="login"></input>
			</form>
		</div>
		<div class="registerLoginBox">
			<img src="../theme/<?= $config['skin'] ?>/images/Red_loper_frank.png">
		</div>
	</div>
	<div class="rightIndex">
		<div id="register">
			Registreer nu<br />
			Het is helemaal gratis!
		</div>
		<div id="registerForm">
			<?php User::Register(); ?>
			<span id="errorBoxRegister"></span>
			<div style="font-size: 28px; color: #acafb5;">Registreer</div>
			<input type="hidden" name="hiddenField_register" required="" value="<?= $hiddenField ?>"></input>
			<input type="text" name="username_register" id="username_register" onkeyup="checkUsernameOrEmail(this.value, 'username')" required="" placeholder="<?= $config['name'] ?> naam" class="register"></input>
			<input type="email" name="email_register" required="" id="email_register" onkeyup="checkUsernameOrEmail(this.value, 'email')" placeholder="Email adres" class="register"></input>
			<input type="password" name="password_register" required="" id="password_register" onkeyup="checkPasswords(this.value, 'password_register')" placeholder="Wachtwoord" class="register"></input>
			<input type="password" name="password_repeat_register" id="password_repeat_register" onkeyup="checkPasswords(this.value, 'password_repeat_register')" required="" placeholder="Herhaal wachtwoord" class="register"></input>
			<div id="registerLoginButton">Inloggen</div>
			<div id="registerSubmit" name="register" value="Registreer" class="register">Registreer</div>
		</div>
	</div>
</div>
</div>
<div class="footerIndex">
	<div class="footerTextIndex">Copyright © 2016 Azure Hotel. Alle rechten voorbehouden. Unnamed CMS 1.0</div>
</div>