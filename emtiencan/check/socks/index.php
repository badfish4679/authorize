<?
Global $socks_list,$site,$sockstimeout,$paypaltimeout,$list;
$socks_list = $_POST["sockslist"];
if (strlen($socks_list)<1) {$socks_list = "82.67.164.189:55525\n71.229.119.8 11465\n67.81.180.167|59931\n211.189.18.165/5818\n";}
if($_POST["submit"]){
    Function getsocks($list)
    {
        preg_match_all("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}[:|-\s\/]\d{1,7}/", $list, $socks);
        $socks = array_unique($socks[0]);
        $socks2 = array();
        For ($i=0;$i<count($socks);$i++)
        {
            If($_POST['port']){
                If(stristr($socks[$i],$_POST['port1'])){
                    continue;
                }
            }
            If (strlen($socks[$i]) > 7) $socks2[] = str_replace(array("|", "/", " ", "-"),':',$socks[$i]);
        }
        Return $socks2;
    }
    $socks_list = str_replace(" ",":",$socks_list);
    $socks_list = str_replace("|",":",$socks_list);
    $socks_list = str_replace("/",":",$socks_list);
    $AllSocks = getsocks($socks_list);
    $All = count($AllSocks);
    $socks_list = "";
    For ($i = 1; $i <= $All; $i++)
    {
        $socks_list .= $AllSocks[$i-1]."\n";
    }
}
$site = $_POST["site"];
if (strlen($site)<1) {$site = "http://lon.cua.co.be/";}
$sockstimeout = $_POST["sockstimeout"];
if (!isset($sockstimeout)) {$sockstimeout = 3;}
?>
<title>...:: Check Socks 5 Live & Blacklist Paypal ::...</title>

<link rel ="stylesheet" type="text/css" href="../../css/default1.css"

<center><h1>--[ CHECK SOCKS 5 ONLINE ]--</h1></center>
<form action="" method="post">
<center><textarea name="sockslist" cols="122" rows="10"><?=$socks_list?></textarea></center>
<div align='center'>
<!---Trang ðích: <input type="text" name="site" size="30" maxlength="200" value="<?//=$site?>" />
|--->
<input type=checkbox name=port><b>Del Port </b><input type=text size=9 name=port1 value= 1080,8080 ><b> Sock Time-Out:</b> <select name="sockstimeout" ><option value="10" <?If ($sockstimeout == 10) echo 'selected';?> >10s</option><option value="9" <?If ($sockstimeout == 9) echo 'selected';?> >9s</option><option value="8" <?If ($sockstimeout == 8) echo 'selected';?> >8s</option><option value="7" <?If ($sockstimeout == 7) echo 'selected';?> >7s</option><option value="6" <?If ($sockstimeout == 6) echo 'selected';?> >6s</option><option value="5" <?If ($sockstimeout == 5) echo 'selected';?> >5s</option><option value="4" <?If ($sockstimeout == 4) echo 'selected';?> >4s</option><option value="3" <?If ($sockstimeout == 3) echo 'selected';?> >3s</option><option value="2" <?If ($sockstimeout == 2) echo 'selected';?> >2s</option><option value="1" <?If ($sockstimeout == 1) echo 'selected';?> >1s</option></select>
<font color=violet><b>   CLEAR PAYPAL   </b></font> <input name="Clear" type="checkbox" id="Clear" />
<b>PP Time-Out</b> <input name="timeoutpp" type="text" value=5 size=3 /><br><br>
<input type="submit" value="  Submit !!!   " name="submit" />
</div>
</form>

<?
if($_POST["submit"]){
$died="";

function ip2location($ip){
    $d = file_get_contents("http://www.ipinfodb.com/ip_query.php?ip=$ip&output=xml");
    if (!$d){
        $backup = file_get_contents("http://backup.ipinfodb.com/ip_query.php?ip=$ip&output=xml");
        $answer = new SimpleXMLElement($backup);
        if (!$backup) return false; // Failed to open connection
    }else{
        $answer = new SimpleXMLElement($d);
    }
    $country_code = $answer->CountryCode;
    $country_name = $answer->CountryName;
    $region_name = $answer->RegionName;
    $city = $answer->City;
    $zippostalcode = $answer->ZipPostalCode;
    $latitude = $answer->Latitude;
    $longitude = $answer->Longitude;
    $timezone = $answer->Timezone;
    $gmtoffset = $answer->Gmtoffset;
    $dstoffset = $answer->Dstoffset;
    return array('ip' => $ip, 'country_code' => $country_code, 'country_name' => $country_name, 'RegionName' => $region_name, 'city' => $city, 'ZipPostalCode' => $zippostalcode, 'latitude' => $latitude, 'longitude' => $longitude, 'Timezone' => $timezone, 'Gmtoffset' => $gmtoffset, 'dstoffset' => $dstoffset);
}


    function getbetween($content,$start,$end){
        $r = explode($start, $content);
        if (isset($r[1])){
            $r = explode($end, $r[1]);
            if ($r[0] == '') return 'Unknown';
            return $r[0];
        }
        return 'Unknown';
    }



    define("FULL_RECORD_LENGTH",50);

    function in_string($needle, $haystack, $insensitive = 0) {
    if ($insensitive) {
            return (false !== stristr($haystack, $needle)) ? true : false;
        } else {
            return (false !== strpos($haystack, $needle))  ? true : false;
        }
    }

    set_time_limit(0);

    function _check($url,$usecookie = false,$sock="",$ref) {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, False);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$_POST['timeoutpp']);
        curl_setopt($ch, CURLOPT_HEADER, 0);   
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3");  
        if($sock){
            curl_setopt($ch, CURLOPT_PROXY, $sock);
            curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        if ($usecookie){  
            curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie);  
            curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);     
        } 
        if ($ref){  
            curl_setopt($ch, CURLOPT_REFERER,$ref); 
        }
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10); 
        $result=curl_exec ($ch);  
        curl_close($ch);  
        return $result;  
    }
    
    Function CheckPP($sock,$cookie){
        $site = "http://www.dreamhost.com/donate.cgi?id=11557";
        $s = _check($site,$cookie,$sock,"http://google.com");
        $site1 = "https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=paypal@dreamhost.com&item_name=Web+Hosting+Donation&item_number=donation_11557&amount=20.00&image_url=https://secure.newdream.net/dreamhostpp.gif&no_shipping=1&no_note=1&rm=2&return=http://www.dreamhost.com/donate.cgi&cancel_return=http://www.manutd.mu/&currency_code=USD&tax=0&submit=Donate+USD+%2420.00";
        $s = _check($site1,$cookie,$sock,$site);
        if(stristr($s,"credit card")){
            if(stristr($s,"Create PayPal Password")){
                return "<td><font color=red><b>Blacklist</b></font></td>";
            }
            else{
                return "<td><b><font color=green>IP Clear PP</font></b></td>";
            }
        }
        else{
            return "<td><b><font color=orange>Time Out</font></b></td>";
        }
    }
    
    
    
    Function Check($Socks,$site,$sockstimeout,$paypaltimeout)
    {
        preg_match('/^.+\//',$_SERVER['SCRIPT_FILENAME'],$linkfolder);
        $cookie_file_path = $linkfolder[0].'/cookie/'.md5(microtime().rand(0,999)).'_cookie.txt';
        $fp = fopen($cookie_file_path,'wb');
        fclose($fp);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_file_path);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_file_path);
        curl_setopt($curl, CURLOPT_HTTPPROXYTUNNEL, 1);
        curl_setopt($curl, CURLOPT_PROXY, $Socks);
        curl_setopt($curl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT,1);
        curl_setopt($curl, CURLOPT_TIMEOUT,$sockstimeout);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,$sockstimeout);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        $site .= "?".microtime();
        curl_setopt($curl, CURLOPT_URL, $site);
        $Exec = curl_exec($curl);
        $info = curl_getinfo($curl);

        $sock1 = explode(":",$Socks);
        $PORT = $sock1[1];
        $sock2 = $sock1[0];
        $sock2 = str_replace(",", ".", $sock2);

        If ($Exec)
        {
            $times = $info['connect_time'];
            $ip =  ip2location($sock2);

            $country_name = $ip['country_name'];
            $region = $ip['RegionName'];
            $city = $ip['city'];
            $postal_code = $ip['ZipPostalCode'];
            if ($country_name == "") $country_name = "Unknown";
            if ($region == "") $region = "Unknown";
            if ($city == "") $city = "Unknown";
            if ($postal_code == "") $postal_code = "Unknown";

            if ($_POST["Clear"]){
                $Result1 = "<br><tr><td><font color='violet'><b>Live : </b></font></td><td>$Socks | </td><td>$times | </td><td>$city | </td><td>$region | </td><td>$postal_code | </td><td>$country_name | </td>".CheckPP($Socks,$cookie_file_path)."";
            }
            else{
                $Result1 = "<br><tr><td><font color='violet'><b>Live : </b></font></td><td>$Socks | </font></td><td>$times | </td><td>$city | </td><td>$region | </td><td>$postal_code | </td><td>$country_name | </td></tr>";
            }
        }
        else 
        {
            $times = $info['connect_time'];
                $Result1 = "<br><tr><td><font color='red'><b>Die : </b></font></td><td>$Socks  | </td><td colspan=7><font color=red>".curl_error($curl)."</font></td></tr>";
        }
        curl_close ($curl);
        unlink($cookie_file_path);
        return $Result1;
    }
    
    Echo "<b><i><center>...:: Checking Socks with timeout $sockstimeout s ::...</i></b><br>";
    if ($_POST["Clear"]){
        echo "<th width='100'>PAYPAL BL</th>";
    }
    Echo "</tr>";
    
    For ($i=1;$i<=$All;$i++){
        If (strlen($AllSocks[$i-1])>10)
        {
            $Socks = $AllSocks[$i-1];
            $s = Check($Socks,$site,$sockstimeout,$paypaltimeout);
            if(stristr($s,"<b>Live</b>")){
                echo $s;
                $s = str_replace("</td><td>"," | ",$s);
                $s = str_replace(array("<tr>","</tr>","<td>","</td>"),array("","","",""),$s);
                $list['live'][] = $s;
            }
            else{
                echo $s;
            }
            flush();
        }
    }
    if(!is_null($list['live'])){
            Echo "<br><tr><th colspan=9><font color=blue size=5>Total <font color=red size=6>$All</font> | Live <font color=red size=6>".count($list['live'])."<br></font><hr><font color=red>LIST SOCK(s) LIVE</font></th></tr><tr><td colspan=9></br>";
            foreach($list['live'] as $ss){
                echo $ss."  - <font color=red>Lon.Cua.Co.Be</font><br>";
                $ss = str_replace(array("<font color='violet'><b>","</b>","</font>"),array("","",""),$ss);
                $today = getdate();
                $day = $today['mday'];
                $mon = $today['mon'];
                $path="save/$day-$mon.txt";
                $files1=fopen($path, "a");
                fwrite($files1,"$ss\r\n");
            fclose($files1);
            }
            Echo "</td></tr>";
    }
    Echo "</table>";
    
    } 