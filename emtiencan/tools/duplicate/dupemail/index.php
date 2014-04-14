<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html> 
<title>--[ Remove Dupe Credits ]--</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

 <body>
 <table width="80%" align="center" border="0">
    <tbody><tr>
	<td align="center">
<h1>--[ Remove Dupe Mail Pass ]--</h1><font size="6" color="violet"> <b>*=-.| [- V.T.L - A.Z.S -] |.-=*</b></font>
</div><div align="center">
<?php
echo "</div><hr border=1><div align=left>";
function percent($num_amount, $num_total) { 
$count1 = $num_amount / $num_total; 
$count2 = $count1 * 100; 
$count = number_format($count2, 0); 
return $count; 
} 
function _dup($cclist){ 
    for ($i = 0;$i < count($cclist); $i++){ 
	$ccnum = info($cclist[$i]);
        if($ccnum){
            $cc = $ccnum['mail']; 
            for ($j = $i + 1;$j < count($cclist); $j++){ 
                if (inStr(str_replace("-","",str_replace(" ","",$cclist[$j])),$cc)){
				$cclist[$j] = ""; 
				}
            } 
        }
    } 
    foreach($cclist as $i => $cc) if ($cc == "") unset($cclist[$i]); 
    $ok = array_values($cclist); 
    return $ok; 
	
} 
function inStr($s,$as){ 
    $s=strtoupper($s); 
    if(!is_array($as)) $as=array($as); 

    for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true; 
    return false; 
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

	if (stristr($xx,"@")){
	$ccnum['mail'] = $xx;
	}
	
	}
	if (isset($ccnum['mail'])){ 
        return $ccnum; 
    } 
    else return false; 
}

if($_POST['maillist']){
	$maillist=$_POST['maillist'];
	$maillist=explode("\n",$maillist);
	$maildupe = _dup($maillist);
	$xx = percent(count($maildupe),count($maillist));
	echo"<center><font color=red><b>".count($maildupe)." ~ ".$xx."%<b></font></center>";	
	foreach($maildupe as $mailline){
	echo "<font color=violet><b>".$mailline."</b></font><br>";
	}
	echo('</div><hr border=1><div align=center><a href="index.php"><input type=button value="Dupe Again !"></a><br><br><br></div><div align=left>');
	
		}else{
?>
</div><div align="center">
<form action="" method="POST" >

<textarea style="color: rgb(85, 85, 85);" name="maillist" cols=110 rows=15 wrap="virtual" onblur="if(this.value==''){this.value='Tự động tìm vị trí Email rồi lọc data trùng'; this.style.color='#555'}" onclick="if(this.value=='Tự động tìm vị trí Email rồi lọc data trùng'){this.value=''; this.style.color='#000'}">Tự động tìm vị trí Email rồi lọc Data trùng</textarea> 
</div><hr border="1"><div align="center"><b>Tự động tìm vị trí Email rồi lọc Data trùng<br><br>  <input type=submit name=submit value="Remove Dupe Mail Pass !"></b>


</form>

</div><hr border="1"><div align="center">

</div>
</td></tr></table>


<?php
}
?>
</body>
</html>