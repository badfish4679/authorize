<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start('ob_gzhandler');
else ob_start(); 

$config['file'] = substr(strrchr($_SERVER['SCRIPT_FILENAME'], '/'), 1);
$config['cookie_file'] = str_replace('.php','.txt',$config['file']);
if(!file_exists($config['cookie_file'])){
	$fp = @fopen($config['cookie_file'],'w');
	@fclose($fp);
}

function _curl($url,$post="") {  
	$ch = curl_init();
	if($post) {
		curl_setopt($ch, CURLOPT_POST ,1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($ch, CURLOPT_REFERER, "https://verified.visa.com/aam/data/vdc/landing.aam?partner=vdc&resize=no"); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3"); 
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt"); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");    
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 3);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$result=curl_exec ($ch); 
	curl_close ($ch); 
	return $result; 
}
function _curl1($url,$post="") {  
	$ch = curl_init();
	if($post) {
		curl_setopt($ch, CURLOPT_POST ,1);
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($ch, CURLOPT_REFERER, "https://verified.visa.com/aam/data/vdc/landing.aam?partner=vdc&resize=no"); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3"); 
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt"); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");    
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 3);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
	curl_setopt($ch, CURLOPT_HEADER,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$result=curl_exec ($ch); 
	curl_close ($ch); 
	return $result; 
}


if($_POST['submit'])
{
	$ccn = trim($_POST['ccn']);
	$capt = trim($_POST['capt']);
	$bin=substr($ccn,0,6);
	$u="https://verified.visa.com/aam/src/app/ve.aam?partner=default&resize=no";
	$p="pan=".$ccn."&securityCode=".$capt."&x=0&y=0";
	
	$s = _curl1($u,$p);
	if(stristr($s,"scrn_2_hdr_text.jpg")){
		echo "$ccn - Pass VBV --> &#272;&#227; &#273;&#432;&#7907;c th&#234;m v&#224;o Data ";
		$path="dbvbv/hv.txt";
		$files=fopen($path, "a");
		fwrite($files,"$bin\n");
		fclose($files);
	}
	elseif(stristr($s,"images/not_valid.gif")){
		echo "<font color=red>Sai CCNum ho&#7863;c Captcha</font><br><br>";
		$url = "https://verified.visa.com/aam/src/app/captcha.aam";
		$getcapt = _curl($url,"");
		$random = 'image/'.mt_rand().'.gif';
		$fp = @fopen($random,'w');
		@fwrite($fp,$getcapt);
		@fclose($fp);


		print('<form method="POST" action="'.$config['file'].'" name="f">');
		print("<input type=text name=ccn size=20 value='$ccn'><br>");
		print('<img src="'.$random.'" border="0" /><br>');
		print('<input type=text name=capt size=10><br>');
		print('<input type="Submit" name=submit value="Check Now">');
		print('</form>');
	}
	else{
		echo "$ccn - No Pass VBV --> &#272;&#227; &#273;&#432;&#7907;c th&#234;m v&#224;o Data";
		$path="dbvbv/nv.txt";
		$files=fopen($path, "a");
		fwrite($files,"$bin\n");
		fclose($files);
	}
}
else{
$cc = $_GET['ccn'];
$url = "https://verified.visa.com/aam/src/app/captcha.aam";
$getcapt = _curl($url,"");
$random = 'image/'.mt_rand().'.gif';
$fp = @fopen($random,'w');
@fwrite($fp,$getcapt);
@fclose($fp);


print('<form method="POST" action="'.$config['file'].'" name="f">');
print("<input type=text name=ccn size=20 value='$cc'><br>");
print('<img src="'.$random.'" border="0" /><br>');
print('<input type=text name=capt size=10><br>');
print('<input type="Submit" name=submit value="Check Now">');
print('</form>');
}

?>
