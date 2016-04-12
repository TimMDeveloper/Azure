<?php
$rtlo=110767;
$description="Paysafecard Voorbeeld";
$amount=1000;
$returnurl="https://duckwave.nl/diamanten/nl/psc/700.php";
$reporturl="https://duckwave.nl/diamanten/nl/psc/700.php";

// De returnurl wordt aangeroepen. We moeten de status controleren
if( isset($_GET['ShoppingCartID'])){
  // 000000 OK Betekent succesvol. We kunnen het product leveren
  if( ($status = CheckReturnurl( $rtlo,  $_GET['ShoppingCartID'] )) == "000000 OK" ){
    // Zet uw orderinformatie op succesvol
    echo "U heeft uw 700 Diamanten ontvangen!";

	
		$sqlInsertAccount = $db->query("INSERT INTO accesscode (ip,code,time) VALUES ('".$_SERVER['REMOTE_ADDR']."','PSC','".time()."')");
		echo "U heeft uw $dia Diamanten ontvangen!";
		$geefdias = $db->query("UPDATE `users` SET `vip_points`=`vip_points`+'700' WHERE `id`='".$_SESSION['user']['id']."'");
		
	
  }
  // In de overige gevallen niet leveren.
  else die( $status );
} 
// De reporturl wordt aangeroepen vanaf de targetpay server
elseif ( isset($_POST['trxid']) && isset($_POST['amount']) ){

  HandleReporturl( $_POST['trxid'], $_POST['amount'] );
} else{
  // Hier starten we met een redirect naar Paysafecard
  $redirecturl = StartTransaction( $rtlo, $description, $amount, $returnurl, $reporturl );
  header ("Location: ".$redirecturl);
  die();
}

// Opvragen redirecturl met transactienummer
function StartTransaction( $rtlo, $description,  $amount, $returnurl, $reporturl){
  $url= "http://www.targetpay.com/paysafecard/start?".
  "rtlo=".$rtlo.
  "&description=".urlencode(substr($description,0,32)).
  "&amount=".$amount.
  "&userip=".urlencode($_SERVER['REMOTE_ADDR']).
  "&returnurl=".urlencode($returnurl).
  "&reporturl=".urlencode($reporturl);
	
  $strResponse = httpGetRequest($url);
  $aResponse = explode('|', $strResponse );
  # Bad response
  if ( !isset ( $aResponse[1] ) ) die('Error' . $aResponse[0] );
 
  $responsetype = explode ( ' ', $aResponse[0] );

  $trxid = $responsetype[1];
  // Hier kunt u het transactienummer toevoegen aan uw order
    
  if( $responsetype[0] == "000000" ) return $aResponse[1];
  else die($aResponse[0]);
}

// Statusverzoek in de returnurl
function CheckReturnurl($rtlo, $trxid){
  $once=1;
  $test=0; // Set to 1 for testing as described in paragraph 1.3 
  $url= "http://www.targetpay.com/paysafecard/check?".
  "rtlo=".$rtlo.
  "&trxid=".$trxid.
  "&once=".$once.
  "&test=".$test;
  return httpGetRequest($url);
}

// reporturl handler. Werk uw orderstatus bij naar succesvol. 
// Deze aanroep komt van Targetpay. 
// De consument heeft hier geen verbinding meer
function HandleReporturl($trxid, $amount ){
  if( substr($_SERVER['REMOTE_ADDR'],0,10) == "89.184.168" ||
  
substr($_SERVER['REMOTE_ADDR'],0,9) == "78.152.58"
 ){
    // Werk hier uw status bij naar Succesvol.
    //reporturl hoort OK terug te geven naar Targetpay.
    die( "OK" );
  }else{
    die("IP address not correct... This call is not from Targetpay");
  }
}

function httpGetRequest($url){
  $ch = curl_init( $url );
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
  $strResponse = curl_exec($ch);
  curl_close($ch);
  if ( $strResponse === false ) 
    die("Could not fetch response " . $url );	
  return $strResponse;
}
?>



<link rel="stylesheet" href="http://horbazone.nl/app/tpl/skins/Habbo/styles/common7.css" type="text/css">
	  <style>
	  body {
	background-color: #ffffff;
	background-image: url();
	font-size: 11px;
	font-family: Verdana,Arial,Helvetica,sans-serif;
	text-align: left;
	margin: 0;
	padding: 0
 }
 input {
font-size: 13px;
font-family: 'Varela Round',sans-serif;
width: 130px;
height: 30px;
padding: 5px 10px;
color: #000;
border-radius: 5px;
background: #FFF;
border: 1px solid #cacaca;
margin-right: 10px;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
-o-box-sizing: border-box;
-webkit-transition: ease-in 0.1s;
-moz-transition: ease-in 0.1s;
-o-transition: ease-in 0.1s;
}
input[type="submit"]:hover {
background-color: #52cd4c;
transition: ease-out 0.3s;
-webkit-transition: ease-out 0.2s;
-moz-transition: ease-out 0.2s;
-o-transition: ease-out 0.2s;
border-top: 2px solid #FFF;
border-bottom: none;
border-left: none;
border-right: none;
}
input[type="submit"] {
background: #52cd4c;
color: #FFF;
width: auto;
border-bottom: 2px solid rgba(0,0,0,0.2);
border-top: none;
border-left: none;
border-right: none;
cursor: pointer;
float: right;
}

.blauw2 {
-moz-border-radius: 5px;
-moz-box-shadow: inset 0 0 1px rgba(255,255,255,0.2);
-webkit-border-radius: 5px;
-webkit-box-shadow: inset 0 0 1px rgba(255,255,255,0.2);
background: #5785CF;
background: -moz-linear-gradient(top,#7BA0D9 35%,#5785CF 35%);
background: -ms-linear-gradient(top,#7BA0D9 35%,#5785CF 35%);
background: -o-linear-gradient(top,#7BA0D9 35%,#5785CF 35%);
background: -webkit-gradient(linear,left top,left bottom,color-stop(35%,#7BA0D9),color-stop(35%,#5785CF));
background: -webkit-linear-gradient(top,#7BA0D9 35%,#5785CF 35%);
background: linear-gradient(to bottom,#7BA0D9 35%,#5785CF 35%);
border-radius: 5px;
box-shadow: inset 0 0 1px rgba(255,255,255,0.2);
color: #FFF;
color: rgb(255,255,255);
font-size: 14px;
font-weight: 700;
margin: 0px -10px 0px -10px;
padding: 5px 5px;
position: relative;
text-align: center;
text-shadow: rgba(0,0,0,0.1) 1px 1px;
}
 </style>