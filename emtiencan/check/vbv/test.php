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


$url = "https://verified.visa.com/aam/src/app/captcha.aam";
$getcapt = _curl($url,"");
echo $getcapt;

?>
