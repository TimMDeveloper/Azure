<?php
	echo "Hi";
	include_once 'includes/class.inc.php';
    include_once "theme/".$config['skin']."/content/head.php";
    if(isset($_GET['logout']))
	{
		if($_GET['logout'] === "yes"){
			session_destroy();
			echo'<meta http-equiv="refresh" content="0;url='.$config['url'].'">';
		}
	}
    if(loggedIn()){ 
    	if($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/?url='){
    		header('Location: /?url=me');
		}	
	}	
	
	if(isset($_GET['url']))
	{
		$page = $_GET['url'];	
		if($page)
		{ 
			$fileExists = $_SERVER['DOCUMENT_ROOT'] . '/theme/'.$config['skin'].'/pages/'.$page.".php";
			if(file_exists($fileExists))
			{
				include("theme/".$config['skin']."/pages/".$page.".php");
			} 
			else 
			{
				include("theme/".$config['skin']."/pages/404.php"); 
			}
		} 
		else 
		{
			include("theme/".$config['skin']."/pages/index.php");
		}
	} 
	else 
	{
		include("theme/".$config['skin']."/pages/index.php");
	}
		//include_once "content/footer.php"; 
		?>
				