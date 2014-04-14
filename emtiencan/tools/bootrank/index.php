<?
If (isset($_POST['submit']))
{
	set_time_limit(0);
	Function rand_name($length)
	{
		$ret = "";
		for ($i = 0; $i < $length; $i++) {
			$ret .= chr(rand(97,122));
		}
		return $ret;
	}
	Function rand_num($length)
	{
		$ret = "";
		for ($i = 0; $i < $length; $i++) {
			$ret .= chr(rand(48,57));
		}
		return $ret;
	}
	Function rand_string($length)
	{
		$ret = "";
		for ($i = 0; $i < $length; $i++) {
			$s = 60;
			While ($s > 57 && $s < 97)
			{
				$s = rand(48,122);
			}
			$ret .= chr($s);
		}
		return $ret;
	}
	function getbetween($content,$start,$end)
	{
		$r = explode($start, $content);
		if (isset($r[1])){
			$r = explode($end, $r[1]);
			if ($r[0] == '') return 'Unknown';
			return $r[0];
		}
		return 'Unknown';
	}
	Function getsocks($list)
	{
		preg_match_all("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}[:|-\s\/]\d{1,7}/", $list, $socks);
		$socks = array_unique($socks[0]);
		$socks2 = '';
		For ($i=0;$i<count($socks);$i++)
		{
			If (strlen($socks[$i]) > 7) $socks2 .= str_replace(array("|", "/", " ", "-"),':',$socks[$i]);
			If ($i<(count($socks)-1)) $socks2 .= "\n";
		}
		Return $socks2;
	}
	Function get($list)
	{
		$array1 = explode("\r\n", $list);
		$array2 = array();
		For ($i=0;$i<count($array1);$i++)
		{
			If (strlen($array1[$i]) > 5) $array2[] = $array1[$i];
		}
		Return $array2;
	}
	Function opencurl($url,$socks='',$type=5,$referer='',$postdata='',$timeout=30,$h=false,$ua='Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1) Gecko/20061010 Firefox/2.0')
	{
		preg_match('/^.+\//',$_SERVER['SCRIPT_FILENAME'],$linkfolder);
		$cookie_file_path = $linkfolder[0].'/c/'.md5(time().rand(0,999)).'_cookie.txt';
		$fp = fopen($cookie_file_path,'wb');
		fclose($fp);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, $h);
		@curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT,$timeout);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,$timeout);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
		If ($ua) curl_setopt($ch, CURLOPT_USERAGENT, $ua);
		If ($referer) curl_setopt($ch, CURLOPT_REFERER,$referer);
		If (strncmp($url,"https",6)) curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		If ($socks)
		{
			curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
			curl_setopt($ch, CURLOPT_PROXY, $socks);
			If ($type == 5)
			{
				curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
			}
			ElseIf ($type == 4)
			{
				curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS4);
			}
			Else
			{
				curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
			}
		}
		If ($postdata)
		{
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		}
		$data = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		ob_end_clean();
		unlink($cookie_file_path);
		If ($data) Return "<font color='yellow'>Load OK</font>";//$data;
		Else Return "<font color='red'>$error</font>";
	}
	Function boot($sitelist,$sockslist,$type,$refererlist,$timeout,$max=0,$ua_chose)
	{
		$useragent = array("Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1) Gecko/20061010 Firefox/2.0","Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.1) Gecko/20090715 Firefox/3.5.1","Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)","Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)","Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)","Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)","msnbot/1.1 (+http://search.msn.com/msnbot.htm)","Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)");
		$sitelist = get($sitelist);
		$sockslist = explode("\n", $sockslist);
		$refererlist = get($refererlist);
		//$refererlist[] = '';
		$id = 1;
		while ($id <= ((count($sockslist))*$max) || $max == 0)
		{
			$site = $sitelist[rand(0,count($sitelist)-1)];
			$socks = $sockslist[rand(0,count($sockslist)-1)];
			$referer = $refererlist[rand(0,count($refererlist)-1)];
			If ($ua_chose == -1)
			{
				$ua_rand = rand(0,4);
			}
			Else
			{
				$ua_rand = $ua_chose;
			}
			$ua = $useragent[$ua_rand];
			switch ($ua_rand) {
				case 0:
					$browser = "Firefox 2.0";
					break;
				case 1:
					$browser = "Firefox 3.5";
					break;
				case 2:
					$browser = "IE 6.0";
					break;
				case 3:
					$browser = "IE 7.0";
					break;
				case 4:
					$browser = "IE 8.0";
					break;
			}
			switch ($type) {
				case 5:
					$sockstype = "Socks 5";
					break;
				case 4:
					$sockstype = "Socks 4";
					break;
				case 3:
					$sockstype = "Proxy";
					break;
			}
			echo "Load <font color='white'>$site</font> with $sockstype <font color='white'>$socks</font>, referer <font color='white'>$referer</font> and browser <font color='white'>$browser</font> => <b>";
			echo opencurl($site,$socks,$type,$referer,'',$timeout,false,$ua);
			echo "</b><br>";
			flush();
			$id++;
		}
	}
	$sitelist = $_POST['sitelist'];
	$sockslist = getsocks($_POST['sockslist']);
	$refererlist = $_POST['refererlist'];
	$ua_chose = $_POST['ua_chose'];
	$type = $_POST['type'];
	$timeout = $_POST['timeout'];
	$max = $_POST['max'];
}
If (!isset($sitelist)) $sitelist = "http://google.com\nhttp://msn.com\nhttp://yahoo.com";
If (!isset($sockslist)) $sockslist = "127.0.0.1:1080";
If (!isset($refererlist)) $refererlist = "http://google.com\nhttp://msn.com\nhttp://yahoo.com";
If (!isset($ua_chose)) $ua_chose = -1;
If (!isset($type)) $type = 5;
If (!isset($timeout)) $timeout = "10";
If (!isset($max)) $max = "1";
?>
<title>...:: Tools Boot Traffic v3.0 ::...</title>

<link rel="stylesheet" type="text/css" href="../../css/default1.css">

<center>
<h2>...:: Tools Boot Traffic v3.0 ::...</h2>
<b>Tool boot traffic l&#7845;y ng&#7851;u nhi&#234;n 1 site, 1 socks, 1 referer v&#224; 1 browser trong list &#273;&#7875; boot.<br><br>

<form method="post">
Danh S&#225;ch Site<br>
<textarea name="sitelist" cols="122" rows="3"><?=$sitelist?></textarea><br>
List referer:<br>
<textarea name="refererlist" cols="122" rows="3"><?=$refererlist?></textarea><br>
List socks:</b><br>
<textarea name="sockslist" cols="122" rows="5"><?=$sockslist?></textarea><br>
Proxy type:
<select name="type">
  <option value="5" <?If ($type == 5) echo 'selected';?> >Socks 5</option>
  <option value="4" <?If ($type == 4) echo 'selected';?> >Socks 4</option>
  <option value="3" <?If ($type == 3) echo 'selected';?> >Proxy</option>
</select>
Browser: 
<select name="ua_chose">
  <option value="-1" <?If ($ua_chose == -1) echo 'selected';?> >Random</option>
  <option value="0" <?If ($ua_chose == 0) echo 'selected';?> >Firefox 2.0</option>
  <option value="1" <?If ($ua_chose == 1) echo 'selected';?> >Firefox 3.5</option>
  <option value="2" <?If ($ua_chose == 2) echo 'selected';?> >IE 6.0</option>
  <option value="3" <?If ($ua_chose == 3) echo 'selected';?> >IE 7.0</option>
  <option value="4" <?If ($ua_chose == 4) echo 'selected';?> >IE 8.0</option>
</select>
S&#7889; l&#7847;n Boot (0 = Unlimited): <input name="max" type="text" id="max" size='5' value = '<?=$max?>' />
Timeout: <input name="timeout" type="text" id="timeout" size='5' value = '<?=$timeout?>' />
<input type="submit" value="H&#7845;p Di&#234;m" name="submit" />

</center>
</form>
<?
If (isset($_POST['submit']))
{
	boot($sitelist,$sockslist,$type,$refererlist,$timeout,$max,$ua_chose);
}
?>