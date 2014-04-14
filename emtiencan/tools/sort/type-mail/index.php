<html>
<title>--[ Tools Sort By EmXinhTT.Net ]--</title>
<style type="text/css">
</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

<body><br>
 <table width="80%" align="center" border="0">
    <tbody><tr>
	<td align="center"><br>
	
<h1><font color="violet"<b>--[ Tools Sort By EmXinhTT.Net ]--</b></font></h1>

<?php
echo "</div><hr border=1><div align=left>";
function percent($num_amount, $num_total) { 
$count1 = $num_amount / $num_total; 
$count2 = $count1 * 100; 
$count = number_format($count2, 0); 
return $count; 
} 

function info($mailline){
	$xy = array("|","\\","/","-",";"); 
	$sepe = $xy[0]; 
	foreach($xy as $v){ 
     if (substr_count($mailline,$sepe) < substr_count($mailline,$v)) $sepe = $v; 
	} 
	$x = explode($sepe,$mailline); 
	foreach($xy as $y) $x = str_replace($y,"",str_replace(" ","",$x)); 
	foreach ($x as $xx){

	if (stristr($xx,"@yahoo")){
	return 1;
	}
	elseif (stristr($xx,"@hotmail.com") or stristr($xx,"@live.com")or stristr($xx,"@msn.com")){ 
	return 2;
	}
	elseif (stristr($xx,"@aol.com")) {
	return 3;
	}
	elseif (stristr($xx,"@gmail.com")) {
	return 4;
	}
	}
}
if($_POST['maillist']){
	$maillist=$_POST['maillist'];
	$maillist=explode("\n",$maillist);
	foreach ($maillist as $mailline){
	$mail = info($mailline);
		if($mail==0){
		$ot[] = $mailline;
		}elseif($mail==1){
		$yh[] =  $mailline;
		}elseif($mail==2){
		$hm[] = $mailline;
		}elseif($mail==3){
		$al[] = $mailline;
		}elseif($mail==4){
		$gm[] = $mailline;
		}
		
	}	
		?>
		
	<br><br></div><div align="center">
   <a href='index.php'><input type=button value="SOFT AGAIN !"></a><br><br><br><div align="left">
   
    <? if (!is_null($yh)){
	if ($_POST['yahoo']){ ?>
    <?     $xx = percent(count($yh),count($maillist)); 
            echo "<br><center><font color=blue><strong>YAHOO : ".count($yh)." ~ $xx %</strong></font><br>Site Home : http://mail.yahoo.com/<br></center><br>"; ?> 
    
<? foreach ($yh as $ss) echo "<font color=blue><strong>| YAHOO | </strong>".$ss."</font><br>"; ?><br>
<br><br>
    </div><hr border="1"><div align="left">    <? } }?>
	<? if (!is_null($gm)){
	if ($_POST['gmail']){ ?>
    <?     $xx = percent(count($gm),count($maillist)); 
            echo "<br><center><font color=green><strong>GMAIL : ".count($gm)." ~ $xx %</strong></font><br>Site Home : http://mail.google.com/<br></center><br>"; ?> 
    
<? foreach ($gm as $ss) echo "<font color=green><strong>| GMAIL | </strong>".$ss."</font><br>"; ?><br>
<br><br>
    </div><hr border="1"><div align="left">    <? } } ?>
	<? if (!is_null($hm)){
	if ($_POST['hotmail']) {?>
    <?     $xx = percent(count($hm),count($maillist)); 
            echo "<br><center><font color=black><strong>HOTMAIL/LIVE/MSN : ".count($hm)." ~ $xx %</strong></font><br>Site Home : http://hotmail.com/</center><br><br>"; ?> 
    
<? foreach ($hm as $ss) echo "<font color=black><strong>| HOTMAIL/LIVE/MSN | </strong>".$ss."</font><br>"; ?><br>
<br><br>
    </div><hr border="1"><div align="left">    <? } } ?>
	<? if (!is_null($al)){
	if ($_POST['aol']){ ?>
    <?     $xx = percent(count($al),count($maillist)); 
            echo "<br><center><font color=red><strong>AOL : ".count($al)." ~ $xx %</strong></font><br>Site Home : http://mail.aol.com/<br></center><br>"; ?> 
    
<? foreach ($al as $ss) echo "<font color=red><strong>| AOL | </strong>".$ss."</font><br>"; ?><br>
<br><br></div><hr border="1"><div align="left"> 
<?  } }?> 
	<? if (!is_null($ot)){
	if ($_POST['other']){ ?>
    <?     $xx = percent(count($ot),count($maillist)); 
            echo "<br><center><font color=orange><strong>OTHER : ".count($ot)." ~ $xx %</strong></font><br><br></center><br>"; ?> 
    
<? foreach ($ot as $ss) echo "<font color=orange><strong>| OTHER | </strong>".$ss."</font><br>"; ?><br>
<br><br></div><hr border="1"><div align="center">
    <?  } }?> 
	
<?
}
else{
?>
</div><div align="center">
<form action="" method="POST" >

<textarea style="color: rgb(85, 85, 85);" name="maillist" cols=110 rows=15 wrap="virtual" onblur="if(this.value==''){this.value='Auto Get Info Credits Card'; this.style.color='#555'}" onclick="if(this.value=='Auto Get Info Credits Card'){this.value=''; this.style.color='#000'}">Auto Get Info Credits Card</textarea><br>

<div align="center"><br><b>Yahoo : <input name=yahoo type=checkbox value=1 checked> --- Gmail : <input name=gmail type=checkbox value=1 checked> --- HotMail/Live/MSN : <input name=hotmail type=checkbox value=1 checked> --- AOL : <input name=aol type=checkbox value=1 checked> --- Other : <input name=other type=checkbox value=1 checked><br><br>  <input type=submit name=submit value=" Get Now ! "></b>


</form>


<?php
}
?>
</body>
</html>