<?php
/*  Login Page scanner
* P-r-i-v-a-t-e
*
* FlashcRew.In
*       Danzel
*       Please If you Use in you site dont remove my copyright ..!
*/


@error_reporting(0);
@set_time_limit(60);

// add here more names if you want.
$word = array("4admin" ,"account" ,"acct_login" ,"adm" ,"adm_auth" ,"admin" ,"admin-login" ,"admin1" ,"admin2" ,"admin4_account" ,"admin4_colon" ,"admin_area" ,"admin_login" ,"adminarea" ,"admincontrol" ,"admincp" ,"administer" ,"administr8" ,"administrasi" ,"administratie" ,"administration" ,"administrator" ,"administratoraccounts" ,"administratorlogin" ,"administrators" ,"administrivia" ,"adminlogin" ,"adminpanel" ,"adminpro" ,"admins" ,"admintools" ,"admloginuser" ,"affiliate" ,"author" ,"autologin" ,"admin_logon" ,"upload" ,"crm" ,"sunpro" ,"crm_login" ,"d_login" ,"badmin" ,"doc-login" ,"" ,"banneradmin" ,"bb-admin" ,"bbadmin" ,"bigadmin" ,"blogindex" ,"cadmins" ,"ccms" ,"ccp14admin" ,"cms" ,"cms_user" ,"cmsadmin" ,"cms_admin" , "cmslogin", "cms_login", "cfg" ,"config" ,"configuration" ,"configure" ,"controlpanel" ,"cp" ,"cpanel" ,"cpanel_file" ,"customer_login" ,"data" ,"database_administration" ,"db" ,"dir-login" ,"directadmin" ,"download" ,"downloads" ,"ezsqliteadmin" ,"file" ,"files" ,"fileadmin" ,"folder" ,"folders" ,"formslogin" ,"globes_admin" ,"home" ,"hpwebjetadmin" ,"indy_admin" ,"instadmin" ,"irc-macadmin" ,"liveuser_admin" ,"login" ,"login-redirect" ,"login-us" ,"login1" ,"login_db" ,"loginflat" ,"logo_sysadmin" ,"lotus_domino_admin" ,"macadmin" ,"maintenance" ,"manuallogin" ,"memberadmin" ,"memberlogin" ,"member_login" ,"members" ,"memlogin" ,"meta_login" ,"modelsearch" ,"moderator" ,"myadmin" ,"navsiteadmin" ,"newsadmin" ,"openvpnadmin" ,"pages" ,"panel" ,"panel-administracion" ,"pgadmin" ,"phpinfo" ,"phpldapadmin" ,"phpmyadmin" ,"phppgadmin" ,"phpsqliteadmin" ,"platz_login" ,"power_user" ,"project-admins" ,"pureadmin" ,"radmind" ,"radmind-1" ,"rclogin" ,"root" ,"roots" ,"server" ,"server_admin_small" ,"serveradministrator" ,"showlogin" ,"simplelogin" ,"siteadmin" ,"smblogin" ,"sql-admin" ,"ss_vms_admin_sm" ,"sshadmin" ,"staradmin" ,"sub-login" ,"super-admin" ,"support_login" ,"sys-admin" ,"sysadmin" ,"sysadmin2" ,"sysadmins" ,"system-administration" ,"system_administration" ,"typo3" ,"ur-admin" ,"user" ,"useradmin" ,"userlogin" ,"users" ,"utility_login" ,"v" ,"v1" ,"v2" ,"v3" ,"vadmind" ,"vmailadmin" ,"webadmin" ,"webmaster" ,"websvn" ,"wizmysqladmin" ,"wp-admin" ,"wp-login" ,"xlogin" ,"yonetici" ,"yonetim" ,"control" ,"kontrol" ,"admincontrol" ,"shopadmin" ,"shopadministrator" ,"controldb" ,"db" ,"intranet" ,"menagers" ,"adminman" ,"upgrade" ,"changes" ,"change" ,"editing" ,"fkedit" ,"html" ,"php" ,"server" ,"serveradmin" ,"adminserver" ,"root" ,"rootuser" ,"rootadmin" ,"shell" ,"w00t" ,"view" ,"xpanel" ,"warning" ,"license" ,"reset" ,"stats" ,"etc" ,"logs" ,"scripts" ,"script" ,"lib" ,"js" ,"src" ,"include" ,"test" ,"man" ,"ls" ,"lab" ,"irc" ,"allwebscripts" ,"allmyphp" ,"alladmin" ,"amazesoft" ,"at" ,"img-sys" ,"java-sys" ,"webmail" ,"power" ,"auth" ,"bitrix" ,"dbinfo" ,"prefix_users" ,"universal" ,"code" ,"shared" ,"cpdbconfig" ,"bb-login" ,"bb-config" ,"kernel" ,"configinc" ,"classmysql" ,"mysql" ,"module" ,"settings" ,"setup" ,"backend" ,"cadmin" ,"CPGconfig" ,"CPGbridge" ,"apanel" ,"dbhcms" ,"apps" ,"app" ,"quixplorer" ,"application" ,"e107admin" ,"eazy-Portal" ,"asm-admin" ,"panel-login");
$max = count($word) - 1;

function checkurl($url) {
$url = "http://".trim(str_ireplace("http://","",$url));
$url = str_ireplace("&amp;","&",$url);


$headers = get_headers($url);
if(stripos($headers[0],"not") === false) return true;
return false;
}



if(isset($_GET['pattern'])&&($_GET['pattern']!="")){
$num = 0;
if(isset($_GET['num']) && (is_numeric($_GET['num']))) $num = (int) $_GET['num'];

$patt = trim($_GET['pattern']);
$patt = str_replace("$",$word[$num],$patt);

if(checkurl($patt)) $laporan = "<a href=\"".$patt."\" target=\"_".rand(1111,9999)."\"><span class=\"white\">".$patt."</span></a><br />";
else $laporan = "&gt; ".$patt;

echo $laporan;
die();

}



?><html>
<head><title>Login Page Scanner</title>
<!-- <?php echo date("Y",time()); ?> fLaShcReW -->

<script type="text/javascript">
jalan = false;
nomer = 1;
nomermax = <?php echo $max; ?>;
heavy = false;
xurl = '<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']; ?>';

function ajax(vars, nom, cbFunction){
var req = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("MSXML2.XMLHTTP.3.0");
var querystring = xurl + '?' + vars + '&num=' + nomer;
req.open("GET", querystring , true);
req.onreadystatechange = function(){
if (req.readyState == 4 && req.status == 200){
if (req.responseText){
  cbFunction(req.responseText,vars);
}
}
}
req.send(null);
}
function showResult(str, vars){
var box = document.getElementById("result")
var stat = document.getElementById("status")
if(str.match(/Warning|Fatal/gi)) stat.innerHTML = '<span class=\"red\">*** </span> error...<br />';
else{
if(str[0]=='&'){
stat.innerHTML = str;
}
else box.innerHTML += str;
}

if(!jalan){
stat.innerHTML = '<span class=\"red\">*** </span> paused...<br />';
document.getElementById("loading").style.visibility = 'hidden';
document.getElementById("btnOk").value = "Resume";
}
else if (nomer>nomermax){
stat.innerHTML = '<span class=\"red\">*** </span> Scanner Finished . FlashcRew.In<br />';
document.getElementById("loading").style.visibility = 'hidden';
document.getElementById("pattern").readOnly = false;
document.getElementById("btnOk").value = "Search";
nomer = 1;
jalan = false;
}
else {
pageCheck(vars);
}

var oldYPos = 0, newYPos = 0;
do{
if (document.all){
oldYPos = document.body.scrollTop;
}
else{
oldYPos = window.pageYOffset;
}
window.scrollBy(0, 50);
if (document.all){
newYPos = document.body.scrollTop;
}
else{
newYPos = window.pageYOffset;
}
} while (oldYPos < newYPos);
}
function keyHandler(ev){
if (!ev){
ev = window.event;
}
if (ev.which){
keycode = ev.which;
}
else if (ev.keyCode){
keycode = ev.keyCode;
}
if (keycode == 13){
var btext = document.getElementById("btnOk").value;
if((btext == 'Search') || (btext == 'Resume')){
sikat();
}
}
}
String.prototype.trim = function() {
return this.replace(/^\s*|\s*$/g, "");
}
function pageCheck(xdata){
if(jalan && (nomer<=nomermax)){
ajax(xdata, nomer, showResult);
nomer++;
}
}
function sikat(){
var btext = document.getElementById("btnOk");
if((btext.value == 'Search') || (btext.value == 'Resume')){
if(!jalan){
var target = document.getElementById('pattern');
if(target.value.trim().length>0 && (target.value.match(/\$/g))) {
document.getElementById("loading").style.visibility = 'visible';
target.readOnly = true;
document.getElementById("btnOk").value = "Pause";
jalan = true;
pageCheck('pattern=' + encodeURIComponent(target.value));
}
}
else alert("Please stop first...");
}
else {
berhenti();
}
}
function initpg(){
document.onkeypress = keyHandler;
}
function berhenti(){
jalan = false;
}
function bersih(){
var tanya = confirm("Clear results and restart?");
if(tanya == true) location.href = '?clear';
}
</script>

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

</head>
<body onload="initpg();">

<div id="result"></div>
<div id="status"></div>
<div id="box">
<input type="text" name="pattern" id="pattern" value="" style="width:400px;" title="Give url pattern..." />
<input type="submit" id="btnOk" name="btnOk" value="Search" onclick="sikat();" style="width:70px;text-align:center;" />
<input type="submit" name="btnClear" value="Restart" onclick="bersih();" style="width:70px;text-align:center;" />
<span class="sign">Copyright</span><span class="red">.</span><span class="sign">fLaShcReW.In</span>
<img src="../images/loading.gif" alt="" style="margin:0;padding:0;vertical-align:middle;visibility:hidden;" id="loading" title="loading..." />
<p>Ex: <i>http://www.target.com/$</i> or <i>http://www.target.com/$.php</i> etc..</p>
</div>

<!-- Dont Remove My Copyright . Thanks Danzel FlashcRew ... -->
</body>
</html>
