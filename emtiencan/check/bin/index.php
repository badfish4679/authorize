<?php
session_start();
?>
<html>
<head><title>--[ Search BIN Info - Code by EmXinhTT.Net ]--</title>
<link rel="stylesheet" type="text/css" href="default1.css">
</style>
</head>
<body>
<center>
<?
function cc($ccline){
  $xy = array("|","\\","/","-",";");
  $sepe = $xy[0];
  foreach($xy as $v){
      if (substr_count($ccline,$sepe) < substr_count($ccline,$v)) $sepe = $v;
  }
  $x = explode($sepe,$ccline);
  foreach($xy as $y) $x = str_replace($y,"",str_replace(" ","",$x));
  foreach ($x as $xx){
      $xx = trim($xx);
         if (is_numeric($xx)){
             $yy=strlen($xx);
             switch ($yy){
                 case 15: $ccnum['num'] = $xx; break;
                 case 16: $ccnum['num'] = $xx; break;
              }
          }
  }
	return $ccnum['num'];
}

function findcc($str){
	$str=str_replace(" ","",$str);
	for($i=0;$i<=strlen($str);$i++){
	if(is_numeric($str[$i])){
	$ccNum.=$str[$i];
	if(strlen($ccNum)>5){
	return $ccNum;
	break;
	};
	}
	else $ccNum='';
	}
}

function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,$str[1]);
	return $str[0];
}

function info($ccnum){
	$type = substr($ccnum,0,1);
	$bin = substr($ccnum,0,6);
	if($type == "4"){
		$file = file_get_contents('dbbin1/vbin30.csv');
		$info = getStr($file,$bin,"\n");
		$info = explode(";",$info);
	}
	elseif($type == "5"){
		$file = file_get_contents('dbbin1/mbin30.csv');
		$info = getStr($file,$bin,"\n");
		$info = explode(";",$info);
	}
	elseif($type == "3"){
		$file = file_get_contents('dbbin1/abin30.csv');
		$info = getStr($file,$bin,"\n");
		$info = explode(";",$info);
	}
	else{
		$info = "Unknown";
	}
	if($info[2] == "CREDIT"){
		$info[2] = str_replace('CREDIT','<font color=blue>CREDIT</font>',$info[2]);
	}
	if($info[3] == "PLATINUM"){
		$info[3] = str_replace('PLATINUM','<font color=red>PLATINUM</font>',$info[3]);
	}
	elseif($info[3] == "GOLD/PREM"){
		$info[3] = str_replace('GOLD/PREM','<font color=orange>GOLD/PREM</font>',$info[3]);
	}
	elseif($info[3] == "BUSINESS"){
		$info[3] = str_replace('BUSINESS','<font color=green>BUSINESS</font>',$info[3]);
	}
	$data = "<tr align=center><td><font color=blue>$ccnum</font></td><td><a href='bybank.php?bank=".$info[1]."'>".$info[1]."</a></td><td>".$info[2]." ".$info[3]."&nbsp;</td><td>".$info[4]."</td><td>".$info[9]."&nbsp;</td></tr>";
	if(strlen($info[1]) < 2){
		$data = "<tr align=center><td><font color=blue>$ccnum</font></td><td colspan=5>Unknown</td></tr>";
	}
	return $data;
}

if($_POST['listcc']){
	if($_POST['security_code'] == $_SESSION['code']) {
		$listcc = trim($_POST['listcc']); 
		$listcc = str_replace(array("\\\"","\\'"),array("\"","'"),$listcc); 
		$listcc = str_replace("\n\n","\n",$listcc); 
		$listcc = str_replace("\r\n\r\n","\r\n",$listcc); 
		$listcc = explode("\n",$listcc);

		echo "<h1>--[ K&#7871;t Qu&#7843; - EmXinhTT.NET ]--</h1>";
		echo "<table border=0 width=90%><tr align=center><td><b><font color=red>Card Number</font></b></td><td><b><font color=red>Bank Name</font></b></td><td><b><font color=red>Card Type</font></b></td><td><b><font color=red>Country</font></b></td><td><b><font color=red>Bank Phone</font></b></td></tr>";
		for($i=0;$i<count($listcc);$i++){
			$ccnum = cc($listcc[$i]);
			if($ccnum == ""){
				$ccnum = findcc($listcc[$i]);
			}
			$info = info($ccnum);
			echo $info;
		}
		echo "</table>";
	}
	else{
		echo "Please make sure you type it right.";
	}
}
else{
?>
<center>
<b><font size=5>--[ Search BIN Info - Code by DungX ]--</font><br></b>
C&#243; th&#7875; &#273;&#432;a v&#224;o 6 &#273;&#7847;u s&#7889; Bin ho&#7863;c n&#233;m c&#7843; con CC v&#224;o.<br>
Auto Search CCNUMBER and Search Bin Info by CCNUMBER.<br>
Click BankName to View more BIN.<br>
<form name="f" method="POST" action="">
<textarea name="listcc" cols="120" rows="10"></textarea><br>
<br><br> <input type=submit name=submit size=10 value="CHECK NOW"> 
</form>
</center>
<? } ?>
</body>
</html>
