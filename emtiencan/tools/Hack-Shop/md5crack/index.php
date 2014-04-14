<?php
/*
########################################################
#Kodlayan : KiLiCaRsLaN                                                                                                                        #
#website   : www.megaturks.net                                                                                                              #
#Tesekkur : RMx-h4ckinger                                                                                                                   #
#Dostlar    : Tum Megaturks Ekibi ( All Megaturks)                                                                               #
########################################################
*/
ini_set('max_execution_time',0);
error_reporting (0);
if (!extension_loaded(curl)){die("<b>Serverda curl yuklu degil - Curl Support Not installed</b>");}
$md5=$_POST ['md5'];
$desen1="#<td width=\"35%\"><b>(.*?)</b></td></tr>#si";
$desen2="#<TD align=\"middle\" nowrap=\"nowrap\" width=90>(.*?)</TD><TD align=\"middle\"#si";
$desen3="#<font color=\"blue\">(.*?)</font></b></center><br><br>#si";
$desen4="#Password - <b>(.*?)</b>#si";
$desen5="#Normal Text: </b>(.*?)<br/><br/>#si";
$desen6="#<textarea name=select cols=12 rows=\"1\">(.*?)</textarea>#si";
$desen7="#<font color=red size=5 >(.*?)</font></center></h3>#si";
$desen8="#<b>(.*?)</b><br><br>#si";
$desen9="#<strong>(.*?)</strong>        </div>#si";
$desen10="#<b><br /><br /> -(.*?)</b>#si";
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<SCRIPT LANGUAGE="JavaScript">
function win() {
msg=window.open("","msg","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=yes,width=270,height=400,left=380,top=80");
msg.document.write("<style>body{margin:0px;font-style:normal;font-size:10px;color:#FFFFFF;font-family:Verdana,Arial;background-color:#3a3a3a;scrollbar-face-color: #303030;scrollbar-highlight-color: #5d5d5d;scrollbar-shadow-color: #121212;scrollbar-3dlight-color: #3a3a3a;scrollbar-arrow-color: #9d9d9d;scrollbar-track-color: #3a3a3a;scrollbar-darkshadow-color: #3a3a3a;}input,.kbrtm,select{background:#303030;color:#FFFFFF;font-family:Verdana,Arial;font-size:10px;vertical-align:middle; height:100; border-left:1px solid #5d5d5d; border-right:1px solid #121212; border-bottom:1px solid #121212; border-top:1px solid #5d5d5d;}button{background-color: #666666; font-size: 8pt; color: #FFFFFF; font-family: Tahoma; border: 1 solid #666666;}body,td,th { font-family: verdana; color: #d9d9d9; font-size: 11px;}body { background-color: #303030;}  </style><html><title>Kontrol Kalemi Kullan?m?</title>");
msg.document.write("<html><title>Kontrol Kalemi Kullan?m?</title><center><b>Kullanimi OKUYUNUZ</b><hr><br><b>RFI,LFI ve XSS Tarat?rken</b><br>Aranacak Kelime: ornek.php?page=<br>PROXY IP:PORT: ?steginize bagl?<br>Sonuclar? Kes: = Verecegi Sonuclar (http://www.site.com/ornek.php?page)<br>Sonuclar? Kes: / Verecegi Sonuclar (http://www.site.com)<br>Sonuna Ekle: LFI XSS RFI Kodunuz<br>Eklerken Mutlaka = veya / isaretini koyunuz<br>Ornek: =http://site.com/shell.txt?<br>XSS Tarat?rken Tan?ma Kelimesi XSSdir<br>RFI tan?ma kelimesi MGGdir.<br><b>SQL Taramalar?nda</b><br>Aranacak Kelime: ornek.php?id=<br>PROXY IP:PORT: ?steginize Bagl?<br>Sonuclar? Kes: Bos B?rak?n?z<br>Sonuna Ekle: %27 veya isteginize bagl?<br>DBO Tarat?rken Sonuna Ekle K?sm?na<br>mutlaka dbo kullan?c? bulma kodu<br>Ekleyiniz.<br><b>Proxy Kullan?rken</b><br>127.0.0.1:21<br>seklinde ip ve port yaz?n?z.<br>www.megaturks.net - K?L?CaRsLaN<br>Yaz?l?m?n kullan?m?ndan dogacak her t?r mesuliyet kullanana aittir.</center>");
msg.document.write("</body></html>");
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>-- [ MGG Md5 Cracker ] --[</title>
<style type="text/css">
<!--
.style1 {
    border: 4px solid #FFFFFF;
    font-family: Tahoma;
        font-weight: bold;
        font-size: 12px;
        color: #330000;
}
.style2 {
    text-align: center;
}
-->

body{margin:0px;font-style:normal;font-size:10px;color:#FFFFFF;font-family:Verdana,Arial;background-color:#3a3a3a;scrollbar-face-color: #303030;scrollbar-highlight-color: #5d5d5d;scrollbar-shadow-color: #121212;scrollbar-3dlight-color: #3a3a3a;scrollbar-arrow-color: #9d9d9d;scrollbar-track-color: #3a3a3a;scrollbar-darkshadow-color: #3a3a3a;}
input,
.kbrtm,select{background:#303030;color:#FFFFFF;font-family:Verdana,Arial;font-size:10px;vertical-align:middle; height:18; border-left:1px solid #5d5d5d; border-right:1px solid #121212; border-bottom:1px solid #121212; border-top:1px solid #5d5d5d;}
button{background-color: #666666; font-size: 8pt; color: #FFFFFF; font-family: Tahoma; border: 1 solid #666666;}
body,td,th { font-family: verdana; color: #d9d9d9; font-size: 11px;}body { background-color: #000000;} 
textarea{background:#303030;color:#FFFFFF;font-family:Verdana,Arial;font-size:10px;vertical-align:middle; border-left:1px solid #121212; border-right:1px solid #5d5d5d; border-bottom:1px solid #5d5d5d; border-top:1px solid #121212;}

.style4 {
    color: #FFFFFF;
}
.style5 {
    font-family: Tahoma;
    font-weight: bold;
    font-size: 12px;
}
.style12 {
    border-style: solid;
    border-color: #FFFFFF;
    font-family: Tahoma;
    font-weight: bold;
    font-size: 12px;
    color: #FF0000;
    text-align: left;
}

.style15 {
    border-style: solid;
    border-color: #FFFFFF;
    font-family: Tahoma;
    font-weight: normal;
    font-size: small;
    color: #C0C0C0;
}

.style16 {
    border-style: solid;
    border-color: #FFFFFF;
    text-align: left;
}

.style19 {
    font-size: x-small;
}

.style20 {
                font-weight: bold;
}

</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div class="style2">
    <table width="374" class="style1">
    <tr>
      <td  class="style15"><strong># Md5 Cracker #<br />
        </strong><span class="style19">www.chinhphu.vn &copy;</span></td>
    </tr>
    </table>
    <table width="374" class="style1">
    <tbody class="style2">
    <tr>
      <td class="style12">Md5 Hash</td>
      <td class="style16" style="width: 218px"><label>
        <input name="md5" type="text" class="style5" size="35" maxlength="35" style="width: 233px" /><span class="style4">
        </span>
      </label></td>
    </tr>
    </table>
      <br />
    <strong>
    <input name="basla" type="submit" value="Start Crack" style="width: 225px; height: 25px" class="style20" /></strong></div>
  </form>
</body>
</html>';
if (isset ($_POST ['basla'])) {
echo "<center>..................Start....................</center>";
Function milw0rm ($ie) {
global $md5;
$baglan=curl_init();
curl_setopt($baglan,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($baglan,CURLOPT_URL,$ie);
curl_setopt($baglan,CURLOPT_REFFERER,"http://www.google.com");
curl_setopt($baglan,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4");
curl_setopt($baglan,CURLOPT_HEADER,1);
curl_setopt($baglan,CURLOPT_POSTFIELDS,"hash=".$md5."");
$gir=curl_exec ($baglan);
curl_close($baglan);
return $gir;
}
$mil=milw0rm ("http://www.milw0rm.com/cracker/search.php");
preg_match_all ($desen2,$mil,$milson);
foreach ($milson[1] as $milbit){
$milbit=str_replace ("md5","",$milbit);
}
if ($milbit==""){
echo "<center><b>1-milw0rm.com : Not Found</center></b><br>";

}else{
echo "<center><font color='#FF0000'><b>1-milw0rm.com :".$milbit."</font></b></center><br>";

}
//Gdataonline basla
Function gdata ($ie) {
global $md5;
$baglan=curl_init();
curl_setopt($baglan,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($baglan,CURLOPT_URL,$ie);
curl_setopt($baglan,CURLOPT_REFFERER,"http://www.google.com");
curl_setopt($baglan,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4");
curl_setopt($baglan,CURLOPT_HEADER,1);
curl_setopt($baglan,CURLOPT_POSTFIELDS,"code=d66fdf6d3dcee4423e9aa23d81704e23&hash=".$md5."");
$gir=curl_exec ($baglan);
curl_close($baglan);
return $gir;
}
$gdata=gdata ("http://gdataonline.com/seekhash.php");
preg_match_all ($desen1,$gdata,$sondata);
foreach ($sondata[1] as $gdatabit) {
echo "<center><font color='#FF0000'><b>2-gdataonline.com :".$gdatabit."</font></b></center><br>";
}
if ($gdatabit==""){
echo "<center><b>2-gdataonline.com  : Not Found</center></b><br>";
}
//insidepro.com basla
Function inside ($ie) {
global $md5;
$baglan=curl_init();
curl_setopt($baglan,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($baglan,CURLOPT_URL,$ie);
curl_setopt($baglan,CURLOPT_REFFERER,"http://www.google.com");
curl_setopt($baglan,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4");
curl_setopt($baglan,CURLOPT_HEADER,1);
curl_setopt($baglan,CURLOPT_POSTFIELDS,"h1=".$md5."");
$gir=curl_exec ($baglan);
curl_close($baglan);
return $gir;
}
$inside=inside ("http://hash.insidepro.com/index.php?lang=eng");
preg_match_all ($desen3,$inside,$insideson);
foreach ($insideson[1] as $insidebit){
echo "<center><font color='#FF0000'><b>3-insidepro.com : $insidebit</font></b></center><br>";
}
if ($insidebit==""){
echo "<center><b>3-insidepro.com  : Not Found</center></b><br>";
}
//Md5pass.Info Basla
Function md5pass ($ie) {
global $md5;
$baglan=curl_init();
curl_setopt($baglan,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($baglan,CURLOPT_URL,$ie);
curl_setopt($baglan,CURLOPT_REFFERER,"http://www.google.com");
curl_setopt($baglan,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4");
curl_setopt($baglan,CURLOPT_HEADER,1);
curl_setopt($baglan,CURLOPT_POSTFIELDS,"hash=".$md5."&get_pass=Get+Pass");
$gir=curl_exec ($baglan);
curl_close($baglan);
return $gir;
}
$md5pass=md5pass ("http://md5pass.info/");
preg_match_all ($desen4,$md5pass,$md5pason);
foreach ($md5pason[1] as $md5pabit){
echo "<center><font color='#FF0000'><b>4-md5pass.info : $md5pabit</font></b></center><br>";
}
if ($md5pabit==""){
echo "<center><b>4-md5pass.Info  : Not Found</center></b><br>";
}
//Md5Decrypter.Com Basla
Function md5de ($ie) {
global $md5;
$baglan=curl_init();
curl_setopt($baglan,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($baglan,CURLOPT_URL,$ie);
curl_setopt($baglan,CURLOPT_REFFERER,"http://www.google.com");
curl_setopt($baglan,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4");
curl_setopt($baglan,CURLOPT_HEADER,1);
curl_setopt($baglan,CURLOPT_POSTFIELDS,"hash=".$md5."&get_pass=Get+Pass");
$gir=curl_exec ($baglan);
curl_close($baglan);
return $gir;
}
$md5de=md5de ("http://www.md5decrypter.com/");
preg_match_all ($desen5,$md5de,$md5deson);
foreach ($md5deson[1] as $md5debit){
echo "<center><font color='#FF0000'><b>5-md5decrypter.com : $md5debit</font></b></center><br>";
}
if ($md5debit==""){
echo "<center><b>5-md5decrypter.com  : Not Found</center></b><br>";
}
//md5.allfact.info basla
Function allfac ($ie) {
global $md5;
$baglan=curl_init();
curl_setopt($baglan,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($baglan,CURLOPT_URL,$ie);
curl_setopt($baglan,CURLOPT_REFFERER,"http://www.google.com");
curl_setopt($baglan,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4");
curl_setopt($baglan,CURLOPT_HEADER,1);
curl_setopt($baglan,CURLOPT_POSTFIELDS,"decrypt=".$md5."&act=decrypt");
$gir=curl_exec ($baglan);
curl_close($baglan);
return $gir;
}

$allfac=allfac ("http://md5.allfact.info/index.php");
preg_match_all ($desen6,$allfac,$allfacson);
foreach ($allfacson[1] as $allfacbit){
echo "<center><font color='#FF0000'><b>6-allfact.info : $allfacbit</font></b></center><br>";
}
if ($allfacbit==""){
echo "<center><b>6-allfact.info  : Not Found</center></b><br>";
}
//www.md5cracker.pl Basla
Function plcra ($ie) {
global $md5;
$baglan=curl_init();
curl_setopt($baglan,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($baglan,CURLOPT_URL,$ie);
curl_setopt($baglan,CURLOPT_REFFERER,"http://www.google.com");
curl_setopt($baglan,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4");
curl_setopt($baglan,CURLOPT_HEADER,1);
curl_setopt($baglan,CURLOPT_POSTFIELDS,"dico=dicos%2F1.txt&hash=".$md5."&ok=+Crack+&pass=");
$gir=curl_exec ($baglan);
curl_close($baglan);
return $gir;
}
$plcra=plcra ("http://www.md5cracker.pl/md5_.php");
preg_match_all ($desen7,$plcra,$plcrason);
foreach ($plcrason[1] as $plcrabit){
echo "<center><font color='#FF0000'><b>7-md5cracker.pl : $plcrabit</font></b></center><br>";
}
if ($plcrabit==""){
echo "<center><b>7-md5cracker.pl  : Not Found</center></b><br>";
}
//blacklight.gotdns.org Basla
Function black ($ie) {
global $md5;
$baglan=curl_init();
curl_setopt($baglan,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($baglan,CURLOPT_URL,$ie);
curl_setopt($baglan,CURLOPT_REFFERER,"http://www.google.com");
curl_setopt($baglan,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4");
curl_setopt($baglan,CURLOPT_HEADER,1);
curl_setopt($baglan,CURLOPT_POSTFIELDS,"hash=".$md5."&algos=MD5&crack=Crack");
$gir=curl_exec ($baglan);
curl_close($baglan);
return $gir;
}
$black=black ("http://blacklight.gotdns.org/cracker/crack.php");
preg_match_all ($desen8,$black,$blackson);
foreach ($blackson[1] as $blackbit){
echo "<center><font color='#FF0000'><b>8-blacklight.gotdns.org : $blackbit</font></b></center><br>";
}
if ($blackbit==""){
echo "<center><b>8-blacklight.gotdns.org  : Not Found</center></b><br>";
}
//www.bigtrapeze.com Basla
Function bigtra ($ie) {
global $md5;
$baglan=curl_init();
curl_setopt($baglan,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($baglan,CURLOPT_URL,$ie);
curl_setopt($baglan,CURLOPT_REFFERER,"http://www.google.com");
curl_setopt($baglan,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4");
curl_setopt($baglan,CURLOPT_HEADER,1);
curl_setopt($baglan,CURLOPT_POSTFIELDS,"query=".$md5."&+Crack+=Sorguyu+g%F6nder");
$gir=curl_exec ($baglan);
curl_close($baglan);
return $gir;
}
$bigtra=bigtra ("http://www.bigtrapeze.com/md5/index.php");
preg_match_all ($desen9,$bigtra,$bigtrason);
foreach ($bigtrason[1] as $bigtrabit){
echo "<center><font color='#FF0000'><b>9-bigtrapeze.com  : $bigtrabit</font></b></center><br>";
}
if ($bigtrabit==""){
echo "<center><b>9-bigtrapeze.com  : Not Found</center></b><br>";
}
//ice.breaker.free.fr basla
Function ice ($ie) {
global $md5;
$baglan=curl_init();
curl_setopt($baglan,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($baglan,CURLOPT_URL,$ie);
curl_setopt($baglan,CURLOPT_REFFERER,"http://www.google.com");
curl_setopt($baglan,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; de; rv:1.8.0.4");
curl_setopt($baglan,CURLOPT_HEADER,1);
$gir=curl_exec ($baglan);
curl_close($baglan);
return $gir;
}
$ice=ice ("http://ice.breaker.free.fr/md5.php?hachage=".$md5."");
preg_match_all ($desen10,$ice,$iceson);
foreach ($iceson[1] as $icebit){
echo "<center><font color='#FF0000'><b>10-ice.breaker.free.fr   : $icebit</font></b></center><br>";
}
if ($icebit==""){
echo "<center><b>10-ice.breaker.free.fr : Not Found</center></b><br>";
}

echo "<center>..................Finish....................</center>";

}








?>
