<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html> 
<title>--[ Remove Dupe Credit Card ]--</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

 <body>
 <table width="80%" align="center" border="0">
    <tbody><tr>
	<td align="center">
<h1>--[ Remove Dupe Credit Card ]--</h1><font size="6" color="violet"><b>*=-.| [ EmXinhTT.Net ]- |.-=*</b></font>
</div><div align="center">
<?php
function inStr($s,$as){ 
    $s=strtoupper($s); 
    if(!is_array($as)) $as=array($as); 

    for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true; 
    return false; 
} 
function info($ccline){ 
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
                 case 15: 
                     if (substr($xx,0,1)==3){ 
                         $ccnum['num'] = $xx; 
                         $ccnum['type'] = "American+Express"; 
                    } 
                     break; 
                 case 16: 
                     switch (substr($xx,0,1)){ 
                          case '4': 
                             $ccnum['num']=$xx; 
                             $ccnum['type'] = "VISA"; 
                             break; 
                        case '5': 
                             $ccnum['num']=$xx; 
                             $ccnum['type'] = "Mastercard"; 
                             break; 
                         case '6': 
                             $ccnum['num']=$xx; 
                             $ccnum['type'] = "Discover"; 
                             break; 
                     } 
                     break; 

              } 
          } 
          } 
    if (isset($ccnum['num'])){ 
        return $ccnum; 
    } 
    else return false; 
		
} 

function _dup($cclist){ 
    for ($i = 0;$i < count($cclist); $i++){ 
        switch($option) {
	case 0:
	$ccnum = info($cclist[$i]);
	break;
	case 1:
	$ccnum = info1($cclist[$i]);
	break;
		}
        if ($ccnum){ 
            $cc = $ccnum['num']; 
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
function percent($num_amount, $num_total) { 
$count1 = $num_amount / $num_total; 
$count2 = $count1 * 100; 
$count = number_format($count2, 0); 
return $count; 
} 
echo "</div><hr border=1><div align=left>";
if($_POST['cclist']){
	$cclist = $_POST['cclist'];
	$cclist = explode("\n",$cclist);
	$ccdupe = _dup($cclist);
	$xx = percent(count($ccdupe),count($cclist));
	echo"<center><font color=red><b>".count($ccdupe)." ~ ".$xx."%<b></font></center>";
	foreach ($ccdupe as $ccline){
	$ccnum = info($ccline);
        if ($ccnum){ 
	
	
	 echo "<font color=green><b>".$ccline."</b></font><br>";
	 }
	 }
	 
	echo('</div><hr border=1><div align=center><a href="index.php"><input type=button value="Soft Again !"></a><br><br><br></div><div align=left>');
	
}else{ ?>
</div><div align="center">
<form action="" method="POST" >

<textarea style="color: rgb(85, 85, 85);" name="cclist" cols=110 rows=15 wrap="virtual" onblur="if(this.value==''){this.value='T? ??ng L?y Info CC r?i L?c các Credits Card Number b? trùng'; this.style.color='#555'}" onclick="if(this.value=='T? ??ng L?y Info CC r?i L?c các Credits Card Number b? trùng'){this.value=''; this.style.color='#000'}">T? ??ng L?y Info CC r?i L?c các Credits Card Number b? Trùng</textarea> 
</div><hr border="1"><div align="center"><b>
	T? ??ng L?y Info CC r?i L?c các Credits Card Number b? trùng<br> <input type=submit name=submit value="Remove Dupe Credit Card Now !"></b>

</form>

<? } ?>
</div>
</td></tr></tbody></table>
</body>
</html>