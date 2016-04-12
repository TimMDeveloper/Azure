<?php
	include_once "theme/Azure/pages/header.php";


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
?>

<link rel="stylesheet" type="text/css" href="/theme/Azure/css/shop.css">
<div class="contentLeft" style="width: 100%;">
<div class="mainbox">
   <div class="boxHeader green">Diamanten Kopen</div>
   		<div class="inner" style="height:355px;">
   		   <div class="method-group online clearfix  bestvalue  cbs2">
   		      <div id="group-content-810">
   		         <div style="    float: left;
   		            padding-left: 212px;" id="price-container">
   		            <div id="pricepoints">
   		               <table id="purchase-table" width="400px;" border="0" cellspacing="2" cellpadding="8" style="margin:10px; margin-top:-10px;">
   		                  <tbody style="font-size: 8.5px;">
   		                     <tr>
   		                        <td bgcolor="#EFEFEF"><strong style="color:#963939 ;">SMS Bundel Bronze (NL)</strong></td>
   		                        <td bgcolor="#EFEFEF">45 Diamanten</td>
   		                        <td bgcolor="#EFEFEF">&euro; 1,10</td>
   		                        <td bgcolor="#FFBB00"><a href="#" onclick="window.open('/diamanten/nl/sms/45.php','Diamanten','width=500,height=300,scrollbars=yeslocation=yes');">Koop</a></td>
   		                     </tr>
   		                     <tr>
   		                        <td bgcolor="#EFEFEF"><strong>SMS Bundel Zilver (NL)</strong></td>
   		                        <td bgcolor="#EFEFEF">125 Diamanten</td>
   		                        <td bgcolor="#EFEFEF">&euro; 3,00</td>
   		                        <td bgcolor="#FFBB00"><a href="#" onclick="window.open('/diamanten/nl/sms/125.php','Diamanten','width=500,height=300,scrollbars=yeslocation=yes');">Koop</a></td>
   		                     </tr>
   		                     <tr>
   		                        <td bgcolor="#EFEFEF"><strong style="color:#A9A627 ;">SMS Bundel Goud (NL)</strong></td>
   		                        <td bgcolor="#EFEFEF">300 Diamanten</td>
   		                        <td bgcolor="#EFEFEF">&euro; 6,00</td>
   		                        <td bgcolor="#FFBB00"><a href="#" onclick="window.open('/diamanten/nl/sms/300.php','Diamanten','width=500,height=300,scrollbars=yeslocation=yes');">Koop</a></td>
   		                     </tr>
   		                     <tr>
   		                        <td></td>
   		                        <td></td>
   		                        <td></td>
   		                        <td></td>
   		                     </tr>
   		                     <tr>
   		                        <td bgcolor="#EFEFEF"><strong style="color:#000000 ;">SMS Bundel (BE)</strong></td>
   		                        <td bgcolor="#EFEFEF">300 Diamanten</td>
   		                        <td bgcolor="#EFEFEF">&euro; 6,00</td>
   		                        <td bgcolor="#FFBB00"><a href="#" onclick="window.open('/diamanten/be/sms/100.php','Diamanten','width=500,height=300,scrollbars=yeslocation=yes');">Koop</a></td>
   		                     </tr>
   		                     <tr>
   		                        <td></td>
   		                        <td></td>
   		                        <td></td>
   		                        <td></td>
   		                     </tr>
   		                     <tr>
   		                        <td bgcolor="#EFEFEF"><strong style="color:#1953C1 ;">PSC Bundel</strong></td>
   		                        <td bgcolor="#EFEFEF">250 Diamanten</td>
   		                        <td bgcolor="#EFEFEF">&euro; 5,00</td>
   		                        <td bgcolor="#FFBB00"><a href="#" onclick="window.open('/diamanten/nl/psc/500.php','Diamanten','width=700,height=500,scrollbars=yeslocation=yes');">Koop</a></td>
   		                     </tr>
   		                  </tbody>
   		               </table>
   		            </div>
   		         </div>
   		         <div style="    float: left;" id="price-container">
   		            <div id="pricepoints">
   		               <table id="purchase-table" width="400px;" border="0" cellspacing="2" cellpadding="8" style="margin:10px; margin-top:-10px;">
   		                  <tbody style="font-size: 8.5px;">
   		                     <tr>
   		                        <td bgcolor="#EFEFEF"><strong style="color:#963939 ;">Bel Bundel Bronze (NL)</strong></td>
   		                        <td bgcolor="#EFEFEF">20 Diamanten</td>
   		                        <td bgcolor="#EFEFEF">&euro; 0,55</td>
   		                        <td bgcolor="#FFBB00"><a href="#" onclick="window.open('/diamanten/nl/bellen/20.php','Diamanten','width=500,height=300,scrollbars=yeslocation=yes');">Koop</a></td>
   		                     </tr>
   		                     <tr>
   		                        <td bgcolor="#EFEFEF"><strong>Bel Bundel Zilver (NL)</strong></td>
   		                        <td bgcolor="#EFEFEF">40 Diamanten</td>
   		                        <td bgcolor="#EFEFEF">&euro; 1,00</td>
   		                        <td bgcolor="#FFBB00"><a href="#" onclick="window.open('/diamanten/nl/bellen/40.php','Diamanten','width=500,height=300,scrollbars=yeslocation=yes');">Koop</a></td>
   		                     </tr>
   		                     <tr>
   		                        <td bgcolor="#EFEFEF"><strong style="color:#A9A627 ;">Bel Bundel Goud (NL)</strong></td>
   		                        <td bgcolor="#EFEFEF">60 Diamanten</td>
   		                        <td bgcolor="#EFEFEF">&euro; 1,30</td>
   		                        <td bgcolor="#FFBB00"><a href="#" onclick="window.open('/diamanten/nl/bellen/60.php','Diamanten','width=500,height=300,scrollbars=yeslocation=yes');">Koop</a></td>
   		                     </tr>
   		                     <tr>
   		                        <td></td>
   		                        <td></td>
   		                        <td></td>
   		                        <td></td>
   		                     </tr>
   		                     <tr>
   		                        <td bgcolor="#EFEFEF"><strong style="color:#000000 ;">Bel Bundel (BE)</strong></td>
   		                        <td bgcolor="#EFEFEF">100 Diamanten</td>
   		                        <td bgcolor="#EFEFEF">&euro; 2,00</td>
   		                        <td bgcolor="#FFBB00"><a href="#" onclick="window.open('/diamanten/be/bellen/100.php','Diamanten','width=500,height=300,scrollbars=yeslocation=yes');">Koop</a></td>
   		                     </tr>
   		                     <tr>
   		                        <td></td>
   		                        <td></td>
   		                        <td></td>
   		                        <td></td>
   		                     </tr>
   		                     <tr>
   		                        <td bgcolor="#EFEFEF"><strong style="color:#1953C1 ;">PSC Bundel SUPER</strong></td>
   		                        <td bgcolor="#EFEFEF">700 Diamanten</td>
   		                        <td bgcolor="#EFEFEF">&euro; 10,00</td>
   		                        <td bgcolor="#FFBB00"><a href="#" onclick="window.open('/diamanten/nl/psc/700.php','Diamanten','width=700,height=500,scrollbars=yeslocation=yes');">Koop</a></td>
   		                     </tr>
   		                  </tbody>
   		               </table>
   		            </div>
   		         </div>
   		      </div>
   		   </div>
   		   <div class="method-group phone clearfix   cbs2">
   		      <div style="width: 48%;" class="method idx0 m-mopay">
   		         <div class="method-content">
   		            <h2>Hoe werkt het?</h2>
   		            <div class="top">
   		               <div></div>
   		            </div>
   		            <div class="summary clearfix">
   		               <ol style="margin: 0px;">
   		                  <li>
   		                     <div>Kies de bundel dat je wilt kopen.</div>
   		                  </li>
   		                  <li>
   		                     <div>Klik 'Koop' bij een betaalmethode.</div>
   		                  </li>
   		                  <li>
   		                     <div>Volg de instructies die verschijnt in het nieuwe venster.</div>
   		                  </li>
   		                  <li>
   		                     <div>Je hebt de Diamanten meteen ontvangen.</div>
   		                  </li>
   		                  <li>
   		                     <div>Iets mis gegaan? Neem dan contact op met iemand van de staff</a>.</div>
   		                  </li>
   		               </ol>
   		            </div>
   		         </div>
   		         <div class="smallprint">
   		            Mocht er iets fout zijn gegaan krijg je maximaal 24 uur nadat je contact hebt opgenomen alsnog de aankoop.
   		         </div>
   		         <div class="bottom">
   		            <div>
   		            </div>
   		         </div>
   		      </div>
   		      <div style="width: 48%;" class="method idx0 m-mopay">
   		         <div class="method-content">
   		            <h2>Diamanten kopen</h2>
   		            <div class="top">
   		               <div></div>
   		            </div>
   		         </div>
   		         <div style="    background-color: #EDEDED;" class="smallprint">
                  <?php
                  $rtlo = 71235;       // Your layout number
                  $ct = "PC";          // Pay per call standaard
                  $co = "31";          // Countrycode, 31=NL, 32=BE
                  $tb =  "130";         // 90 cent per call
                  $adult = "0";        // Use 1 for adult purposes
                  $test = "0";         // Use 1 for testing
                  $dia = "60";         // Aantal Dia
                  $coste = "1,30";         // Aantal Dia
                  $aReturn =  startPayment();
                  $iPayCode = $aReturn[0];
                  $iPhoneNumberToCall = $aReturn[1];
                  $iCosts = $aReturn[2];
   
                  echo"Koop <b>$dia</b> Diamanten voor <b>&euro;$coste</b><br><br>";
                  echo 'Bel dit nummer: <b> '. $iPhoneNumberToCall;
                  echo '</b><br/>Als ze om de code vraagt vul deze in<b>: '. $iPayCode;
                  
                  echo '</b><br/><br/>Als je het nummer gebeld hebt druk dan op de knop <b>Bevestig</b><br/>';
                  
                  echo "<form method=\"POST\" action=\"/?url=60\" >
                  <input type=\"hidden\" name=\"payline\" value=\"".$iPhoneNumberToCall."\">
                  <input type=\"hidden\" name=\"paycode\" value=\"".$iPayCode."\">
                  <input type=\"submit\"  name=\"action\" value=\"Bevestig\">
                  </form>
                  ";
                  ?>
   		             
   		         </div>
   		         <div class="bottom">
   		            <div>
   		            </div>
   		         </div>
   		      </div>
   		      <div class="credits-footer clearfix">
   		         <div class="disclaimer" style="width:100%;">
   		            <br/>
   		            <h3><span>Vraag altijd eerst toestemming aan je ouders/verzorgers.</span></h3>
   		            Als je je hier niet aan houdt, riskeer je een ban.<br />Lukt het niet om Diamanten te kopen, neem dan contact met ons in het hotel.
   		         </div>
   		      </div>
   		   </div>
   		</div>
   </div>
</div>
<?php
	include_once'footer.php';
?>
