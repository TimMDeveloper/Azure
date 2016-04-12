<?php
	Game::sso();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script type="text/javascript">
	document.habboLoggedIn = true;
	var habboName = "<?= User::userData('username') ?>";
	var habboId = "<?= User::userData('id') ?>";
	var facebookUser = false;
	var habboReqPath = "";
	var habboStaticFilePath = "/web-gallery";
	var habboImagerUrl = "/habbo-imaging/";
	var habboPartner = "";
	var habboDefaultClientPopupUrl = "/?url=client";
	window.name = "client";
	if (typeof HabboClient != "undefined") {
		HabboClient.windowName = "client";
		HabboClient.maximizeWindow = true;
	}
</script> 
<title><?php // echo $HotelName; ?> - Hotel V.3W.0</title>
<script src="/theme/azure/client/libs2.js" type="text/javascript"></script> 
<script src="/theme/azure/client/visual.js" type="text/javascript"></script> 
<script src="/theme/azure/client/libs.js" type="text/javascript"></script> 
<script src="/theme/azure/client/common.js" type="text/javascript"></script>  
<noscript> 
    <meta http-equiv="refresh" content="0;url=/client/nojs" />
</noscript> 
<link rel="shortcut icon" href="<?php echo $URL ?>/images/favicon.ico" type="image/vnd.microsoft.icon" /> 
<link rel="stylesheet" href="/theme/azure/client/client.css" type="text/css" />
<script src="/theme/azure/client/habboflashclient.js" type="text/javascript"></script>
<script type="text/javascript"> 
	FlashExternalInterface.loginLogEnabled = true;    
    FlashExternalInterface.logLoginStep("web.view.start");
    if (top == self) {
        FlashHabboClient.cacheCheck();
	}
    var flashvars = {
		"client.allow.cross.domain" : "1", 
		"client.notify.cross.domain" : "1", 
		"connection.info.host" : "<?= $hotel['ip'] ?>", 
		"connection.info.port" : "<?= $hotel['port'] ?>",
		"site.url" : "<?= $config['url'] ?>/", 
		"url.prefix" : "<?= $config['url'] ?>/", 
		"client.reload.url" : "<?= $config['url'] ?>/?url=client", 
		"client.fatal.error.url" : "<?= $config['url'] ?>/?url=client", 
		"client.connection.failed.url" : "<?= $config['url'] ?>/?url=client", 
		"external.variables.txt" : "<?= $hotel['externalVariablesTxt'] ?>",
		"external.override.variables.txt" : "<?= $hotel['externalOverrideVariablesTxt'] ?>",
		"external.texts.txt" : "<?= $hotel['externalTextsTxt'] ?>", 
		"external.override.texts.txt" : "<?= $hotel['externalOverrideTextsTxt'] ?>", 
		"productdata.load.url" : "<?= $hotel['productdata'] ?>",
		"furnidata.load.url" : "<?= $hotel['furnidata'] ?>",
		"sso.ticket" : "<?= User::userData('auth_ticket') ?>", 
		"client.starting.revolving" : "<?= $hotel['clientStartingRevolving'] ?>",
		"flash.client.url" : "<?= $hotel['swfFolder'] ?>/",
		"flash.dynamic.avatar.download.configuration" : "<?= $hotel['figuremap'] ?>",
		"external.figurepartlist.txt" : "<?= $hotel['figuredata'] ?>",
	};
    var params = {
        "base" : "<?= $hotel['swfFolder'] ?>/",
		"clientUrl" : "<?= $hotel['habboSwf'] ?>",
		"allowScriptAccess" : "always",
        "menu" : "true"               
	};
    if (!(HabbletLoader.needsFlashKbWorkaround())) {
    	params["wmode"] = "opaque";
		FlashExternalInterface.signoutUrl = "/logout.php";
	}
    var clientUrl = "<?= $hotel['habboSwf'] ?>";
	swfobject.embedSWF(clientUrl, "flash-container", "100%", "100%", "10.0.0", "https://images.habbo.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/1642/web-gallery/flash/expressInstall.swf", flashvars, params);
    window.onbeforeunload = unloading;
    function unloading() {
        var clientObject;
        if (navigator.appName.indexOf("Microsoft") != -1) {
            clientObject = window["flash-container"];
			} else {
            clientObject = document["flash-container"];
		}
        try {
            clientObject.unloading();
		} catch (e) {}
	}
</script>
<body id="client" class="flashclient">
	<div id="client-ui" >
		<div id="flash-wrapper">
			<div id="flash-container">
			</div>
		</div>
	</div>