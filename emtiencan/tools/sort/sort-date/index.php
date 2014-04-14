<html>
<head><title>--[ Tools Sort By Date Credits Card ]--</title>
<style type="text/css">
</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

<body><br>
 <table width="80%" align="center" border="0">
    <tbody><tr>
	<td align="center"><br>
<h1><font color="violet"<b>--[ Tools Sort By Date Credits Card ]--</b></font></h1>
 
<?php

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
                 case 1: 
                     if (($xx >= 1) and ($xx <=12) and (!isset($ccnum['mon']))) $ccnum['mon'] = "0".$xx; 
                 case 2: 
                     if (($xx >= 1) and ($xx <=12) and (!isset($ccnum['mon'])))    $ccnum['mon'] = $xx; 
                     elseif (($xx >= 9) and ($xx <= 19) and (isset($ccnum['mon'])) and (!isset($ccnum['year'])))    $ccnum['year'] = "20".$xx; 
                     break; 
                 case 4: 
                     if (($xx >= 2009) and ($xx <= 2019) and (isset($ccnum['mon'])))    $ccnum['year'] = $xx; 
                     elseif ((substr($xx,0,2) >= 1) and (substr($xx,0,2) <=12) and (substr($xx,2,2)>= 9) and (substr($xx,2,2) <= 19) and (!isset($ccnum['mon'])) and (!isset($ccnum['year']))){ 
                             $ccnum['mon'] = substr($xx,0,2); 
                             $ccnum['year'] = "20".substr($xx,2,2); 
                         } 
                     else $ccv['cv4'] = $xx; 
                     break; 
                 case 6: 
                     if ((substr($xx,0,2) >= 1) and (substr($xx,0,2) <=12) and (substr($xx,2,4)>= 2009) and (substr($xx,2,4) <= 2019)){ 
                        $ccnum['mon'] = substr($xx,0,2); 
                        $ccnum['year'] = substr($xx,2,4); 
                    } 
                    break; 
                case 3: 
                    $ccv['cv3'] = $xx; 
                    break; 

              } 
          } 
          } 
    if (isset($ccnum['num']) and isset($ccnum['mon']) and isset($ccnum['year'])){ 
            if ($ccnum['type'] == "American+Express") $ccnum['cvv'] = $ccv['cv4']; 
            else $ccnum['cvv'] = $ccv['cv3']; 
        return $ccnum; 
    } 
    else return false; 
		
} 
function _date($cclist){ 
    if (!is_null($cclist)){ 
        foreach ($cclist as $cc){ 
            $ccnum = info($cc); 
            if ($ccnum){ 
                $_d = $ccnum['year'].$ccnum['mon']; 
                $order[$_d][] = $cc; 
            } 
            else $order['e'][] = $cc; 
        } 
        ksort($order); 
        if (!is_null($order)) foreach ($order as $_d) foreach ($_d as $cc) $ok[] = $cc; 
        if (!is_null($order['e'])) foreach ($order['e'] as $cc) $ok[]=$cc; 
        return $ok; 
    } 
} 
?> 

    <?
if($_POST['cclist']){
	$cclist=$_POST['cclist'];
	$cclist=explode("\n",$cclist);
	$cclist = _date($cclist);
	 foreach ($cclist as $ss) echo "<font color=blue><b>".$ss."</b></font><br>";
	echo('</div><hr border=1><div align=center><a href="index.php"><input type=button value="Soft Again !"></a><br><br><br></div><div align=left>');
}
else{
?>
</div><div align="center">
<form action="" method="POST" >

<textarea style="color: rgb(85, 85, 85);" name="cclist" cols=110 rows=15 wrap="virtual" onblur="if(this.value==''){this.value='Auto Get Info Credits Card'; this.style.color='#555'}" onclick="if(this.value=='Auto Get Info Credits Card'){this.value=''; this.style.color='#000'}">Auto Get Info Credits Card</textarea>
<div align="center"><br><b>Auto Get Info Credit Card<br><br> <input type=submit name=submit value="  Sort Now !  "></b>

</form>

</div>
</td></tr></table>

<? } ?>
</body>
</html>