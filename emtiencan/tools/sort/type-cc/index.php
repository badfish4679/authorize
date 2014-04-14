<html> 
<title>--[ Tools Sort By EmXinhTT.Net ]--</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

 <body>
 <table width="100%" align="center" border="0">
    <tbody><tr>
	<td align="center"><br>
<h1><font color="violet"<b>--[ Tools Sort By EmXinhTT.Net ]--</b></font></h1>

<?
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
                         $ccnum['type'] = 3; 
                    } 
                     break; 
                 case 16: 
                     switch (substr($xx,0,1)){ 
                          case '4': 
                             $ccnum['num']=$xx; 
                             $ccnum['type'] = 4; 
                             break; 
                        case '5': 
                             $ccnum['num']=$xx; 
                             $ccnum['type'] = 5; 
                             break; 
                         case '6': 
                             $ccnum['num']=$xx; 
                             $ccnum['type'] = 6; 
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
function percent($num_amount, $num_total) { 
$count1 = $num_amount / $num_total; 
$count2 = $count1 * 100; 
$count = number_format($count2, 0); 
return $count; 
} 
if ($_POST['cclist']){ 
    $cclist = trim($_POST['cclist']); 
    $cclist = str_replace(array("\\\"","\\'"),array("\"","'"),$cclist); 
    $cclist = str_replace("\n\n","\n",$cclist); 
    $cclist = explode("\n",$cclist); 
	foreach ($cclist as $ccline){
	$ccnum = info($ccline);
	if ($ccnum['type']==3){
	echo "<font color=green><strong>| A | </strong>".$ccline."</font><br>";
	$a[] = $ccline;
	}
	if ($ccnum['type']==4){
	echo "<font color=blue><strong>| V | </strong>".$ccline."</font><br>";
	$v[] = $ccline;
	}
	if ($ccnum['type']==5){
	echo "<font color=orange><strong>| M | </strong>".$ccline."</font><br>";
	$m[] = $ccline;
	}
	if ($ccnum['type']==6){
	echo "<font color=black><strong>| D | </strong>".$ccline."</font><br>";
	$d[] = $ccline;
	}
	
	} 
	echo('</div><hr border=1><div align=center><a href="index.php"><input type=button value="Soft Again !"></a><br><br><br></div><div align=left>');
	?>
	<? if (!is_null($v)){ ?>
	
    <?     $xx = percent(count($v),count($cclist)); 
            echo "<br><center><font color=blue><strong>VISA : ".count($v)." ~ $xx %</strong></font></center><br><br><br>"; ?> 
    
<? foreach ($v as $ss) echo "<font color=BLUE><strong>| V | </strong>".$ss."</font><br>"; ?><br>
<br><br>
    <? } ?> 
	</div><hr border="1"><div align="left">
		<? if (!is_null($m)){ ?>
	
    <?     $xx = percent(count($m),count($cclist)); 
            echo "<br><center><font color=orange><strong>MASTER CARD : ".count($m)." ~ $xx %</strong></font></center><br><br><br>"; ?> 
    
<? foreach ($m as $ss) echo "<font color=orange><strong>| M | </strong>".$ss."</font><br>"; ?><br>
<br><br>
    <? } ?> 
	</div><hr border="1"><div align="left">
	<? if (!is_null($a)){ ?>
	
    <?     $xx = percent(count($a),count($cclist)); 
            echo "<br><center><font color=green><strong>AMERICAN EXPRESS : ".count($a)." ~ $xx %</strong></font></center><br><br><br>"; ?> 
    
<? foreach ($a as $ss) echo "<font color=green><strong>| A | </strong>".$ss."</font><br>"; ?><br>
<br><br>
    <? } ?> 
	</div><hr border="1"><div align="left">
	<? if (!is_null($d)){ ?>
	
    <?     $xx = percent(count($d),count($cclist)); 
            echo "<br><center><font color=black><strong>DISCOVERI : ".count($d)." ~ $xx %</strong></font></center><br><br><br>"; ?> 
    
<? foreach ($d as $ss) echo "<font color=black><strong>| D | </strong>".$ss."</font><br>"; ?><br>
<br><br>
    <? } ?> 
	</div><hr border="1"><div align="left">
	<?
	}else{
?>
<form action="" method=post>
<div align="center">
<textarea style="color: rgb(85, 85, 85);" name="cclist" cols="100" rows="13" wrap="virtual" onblur="if(this.value==''){this.value='S&#7889; th&#7913; t&#7921; CC &#273;&#432;&#7907;c l&#7845;y b&#7855;t &#273;&#7847;u t&#7915; S&#7889; 1'; this.style.color='#555'}" onclick="if(this.value=='S&#7889; th&#7913; t&#7921; CC &#273;&#432;&#7907;c l&#7845;y b&#7855;t &#273;&#7847;u t&#7915; S&#7889; 1'){this.value=''; this.style.color='#000'}">S&#7889; th&#7913; t&#7921; CC &#273;&#432;&#7907;c l&#7845;y b&#7855;t &#273;&#7847;u t&#7915; S&#7889; 1</textarea> 
</div>
    <b>Auto Get Info Credits Card</b>
	<br><input type=submit name=submit value="Sort Now !"> 
</form> 

</tbody></table>
<? } ?>

</body>
</html>