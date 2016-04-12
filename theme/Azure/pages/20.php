<style>
	BODY{
    font-family: "Lucida Sans Unicode", Lucida Grande, sans-serif;
    font-size: 8pt;
    color: #515151;
    text-decoration: none;
    line-height: 18px;
}
</style>
<body>
<?php
$rtlo = 71235;       // Your layout number
$ct = "PC";          // Pay per call standaard
$co = "31";          // Countrycode, 31=NL, 32=BE
$tb =  "55";         // 90 cent per call
$adult = "0";        // Use 1 for adult purposes
$test = "0";         // Use 1 for testing
$dia = "20";         // Aantal Dia
$coste = "0,55";         // Aantal Dia

if ( !(isset ( $_GET['action'] ) && $_GET['action'] == 'Bevestig' &&
 isset ( $_GET['payline'] ) && isset ( $_GET['paycode'] ))) {
	$aReturn =  startPayment();
	$iPayCode = $aReturn[0];
	$iPhoneNumberToCall = $aReturn[1];
	$iCosts = $aReturn[2];
	
	echo"Koop <b>$dia</b> Diamanten voor <b>&euro;$coste</b><br><br>";
	echo 'Bel dit nummer: <b> '. $iPhoneNumberToCall;
	echo '</b><br/>Als ze om de code vraagt vul deze in<b>: '. $iPayCode;
	
	echo '</b><br/><br/>Als je het nummer gebeld hebt druk dan op de knop <b>Bevestig</b><br/>';
	
	echo "<form method=\"GET\" >
	<input type=\"hidden\" name=\"payline\" value=\"".$iPhoneNumberToCall."\">
	<input type=\"hidden\" name=\"paycode\" value=\"".$iPayCode."\">
	<input type=\"submit\"  name=\"action\" value=\"Bevestig\">
	</form>
	";
	
}
else 
{
   if (validatePayment($_GET['paycode'],$_GET['payline'] )== true ) {

	
	
		$sqlInsertAccount = $db->query("INSERT INTO accesscode (ip,code,time) VALUES ('".$_SERVER['REMOTE_ADDR']."','".$iPhoneNumberToCall."','".time()."')");
		echo "U heeft uw $dia Diamanten ontvangen!";
		$geefdias = $db->query("UPDATE `users` SET `vip_points`=`vip_points`+'".$dia."' WHERE `id`='".$_SESSION['user']['id']."'");
	
	
	
	
	
	
	}
	
	
    else   {     
    	

echo 'Er is iets mis gegeaan, Of de Diamanten zijn ontvangen of er is nog niet betaald!';
}
}

function startPayment(){
   global    $rtlo, $ct, $co, $tb, $adult, $test, $cd;
  $sRequest="http://api.targetpay.nl/payment/startpayment.asp";
  $strParamString = "?rtlo=".$rtlo."&ct=".$ct."&co=".$co."&tb=".$tb."&iphash=".
urlencode($_SERVER['REMOTE_ADDR'])."&adult=".$adult."&test=".$test."&cd=".$cd;
  $ch = curl_init($sRequest.$strParamString);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
  $strResponse = curl_exec($ch);
  curl_close($ch);

  $aResponse = explode('|', $strResponse );

  if( $ct == "PC" ) $aResponse[3] = $tb." per call.";
  else $aResponse[3] = $tb." ct. per minute. Duration $cd seconds.";
  
  if( $aResponse[0] == "000 OK" )
  {
  	return array ( $aResponse[1], $aResponse[2] , $aResponse[3] );
  }
  else
  {
  	echo $strResponse;
   	return FALSE;	
  }
}

function validatePayment($code, $payline){
global    $rtlo, $co, $test;
  $sRequest="http://api.targetpay.nl/payment/checkpayment.asp";
  $strParamString = "?rtlo=".$rtlo."&payline=".urlencode($payline).
  "&paycode=".$code."&country=".$co."&test=".$test;
  $ch = curl_init($sRequest.$strParamString);
  curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;
  $strResponse = curl_exec($ch);
  curl_close($ch);
  $aResponse = explode('|', $strResponse );
  return $aResponse[0] ==  "000 OK";
}

?>

	  