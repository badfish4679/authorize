<?php
$header_array[0] ="Host:www.paypal.com";
$header_array[1]= "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36";
$header_array[2]= "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
$header_array[3]= "Accept-Language:en-us,en;q=0.5";
$header_array[5]= "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7";
$header_array[6]= "Keep-Alive:300";
$header_array[8]= "Content-Type:application/x-www-form-urlencoded";

$cookie_file_path = 'cookie.txt';
$fp = fopen($cookie_file_path,'wb');
fclose($fp);

$url = 'https://www.paypal.com/vn/cgi-bin/webscr?cmd=_login-submit';
$post_field = "login_email=rookievn102%40gmail.com&login_password=zRookie%40%21%40%23&submit=Log+In&browser_name=Chrome&browser_version=537.36&browser_version_full=34.0.1847.116&operating_system=Mac&bp_mid=v=1;a1=na~a2=na~a3=na~a4=Mozilla~a5=Netscape~a6=5.0 (Macintosh; Intel Mac OS X 10_8_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36~a7=20030107~a8=na~a9=true~a10=~a11=true~a12=MacIntel~a13=na~a14=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36~a15=true~a16=en-US~a17=ISO-8859-1~a18=www.paypal.com~a19=na~a20=na~a21=na~a22=na~a23=1920~a24=1080~a25=24~a26=1080~a27=na~a28=Wed Apr 16 2014 17:04:07 GMT+0700 (ICT)~a29=7~a30=na~a31=yes~a32=na~a33=na~a34=no~a35=no~a36=yes~a37=yes~a38=online~a39=no~a40=MacIntel~a41=yes~a42=no~&bp_ks1=v=1;l=10;Di0:116292Ui0:172Di1:1136Ui1:112Di2:136Ui2:136Di3:640Ui3:96Di4:248Ui4:66Dk8:617Uk8:85Dk8:104Uk8:80Dk8:88Uk8:88Dk8:25Uk8:201Dk8:86Uk8:184Di5:793Ui5:141Di6:427Ui6:74Di7:83Ui7:106Di8:192Ui8:128Di9:161Ui9:87Di10:224Ui10:138Di11:1102Ui11:168Di12:201Ui12:159Di13:128Ui13:130Di14:167Ui14:135&bp_ks2=&bp_ks3=";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$post_field);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
//curl_setopt($ch, CURLOPT_REFERER, $reffer);
$result = curl_exec($ch);  // grab URL and pass it to the variable.
curl_close($ch);  // close curl resource, and free up system resources.
var_dump($result);
