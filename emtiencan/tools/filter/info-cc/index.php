<html>
<head><title>--[ Tools Get Info Credis Card ]--</title>
<style type="text/css">
</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

<body><br>
 <table width="80%" align="center" border="0">
    <tbody><tr>
	<td align="center"><br>
<h1><blink><font color="green"<b>--[ Tools Get Info Credis Card ]--</b></font></blink></h1>

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
function percent($num_amount, $num_total) { 
$count1 = $num_amount / $num_total; 
$count2 = $count1 * 100; 
$count = number_format($count2, 0); 
return $count; 
} 
?> 
	</div><hr border="1"><div align="left">
    <?
if($_POST['cclist']){
	$cclist=$_POST['cclist'];
	$cclist=explode("\n",$cclist);
	foreach ($cclist as $ccline){
	$ccnum = info($ccline);
	echo ('<font color="green"><b>');
	if (isset($_POST['num'])) echo ($ccnum['num']." | ");
	if (isset($_POST['mon'])) echo ($ccnum['mon']." | ");
	if (isset($_POST['year'])) echo ($ccnum['year']." | ");
	if (isset($_POST['cvv'])) echo ($ccnum['cvv']." | ");
	echo ('</b></font><br>');
		}
	echo('</div><hr border=1><div align=center><a href="index.php"><input type=button value="Get Again !"></a><br><br><br></div><div align=left>');
}
else{
?>
</div><div align="center">
<form action="" method="POST" >

<textarea style="color: rgb(85, 85, 85);" name="cclist" cols=110 rows=15 wrap="virtual" onblur="if(this.value==''){this.value='Auto Get Info Credits Card'; this.style.color='#555'}" onclick="if(this.value=='Auto Get Info Credits Card'){this.value=''; this.style.color='#000'}">Auto Get Info Credits Card</textarea> 
</div><hr border="1"><div align="center"><b>CCNUM : <input name=num type=checkbox value=1 checked> --- MON : <input name=mon type=checkbox value=1 checked> --- YEAR : <input name=year type=checkbox value=1 checked> --- CVV : <input name=cvv type=checkbox value=1 checked><br><br>  <input type=submit name=submit value="Get Now !"></b>


</form>

</div>
</td></tr></table>


<?php
}
?>
</body>
</html>