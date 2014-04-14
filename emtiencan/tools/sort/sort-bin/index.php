<html> 
<title>--[ Tools Sort By EmXinhTT.Net ]--</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

<body>
<table width="80%" align="center" border="0">
    <tbody><tr>
	<td align="center"><br>
<h1><font color="violet"<b>--[ Tools Sort By EmXinhTT.Net ]--</b></font></h1>

<?

function _bin($cclist){ 
    if (!is_null($cclist)){ 
        foreach ($cclist as $ccline){ 
            switch($option) {
	case 0:
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
						 $ccnum['bin'] = substr($xx,0,6);
                         $ccnum['type'] = "American+Express"; 
                    } 
                     break; 
                 case 16: 
                     switch (substr($xx,0,1)){ 
                          case '4': 
                             $ccnum['num']=$xx; 
							 $ccnum['bin'] = substr($xx,0,6);
                             $ccnum['type'] = "VISA"; 
                             break; 
                        case '5': 
                             $ccnum['num']=$xx; 
							 $ccnum['bin'] = substr($xx,0,6);
                             $ccnum['type'] = "Mastercard"; 
                             break; 
                         case '6': 
                             $ccnum['num']=$xx; 
							 $ccnum['bin'] = substr($xx,0,6);
                             $ccnum['type'] = "Discover"; 
                             break; 
                     } 
                     break; 

              } 
          } 
          } 
		
	break;
	case 1:
	$delim = $_POST['delim'];
$xx = explode($delim,$ccline);
$num = trim($xx[$_POST['num'] - 1]);
if (is_numeric($num)){ 
             $yn=strlen($num); 
             switch ($yn){ 
                 case 15: 
                     if (substr($num,0,1)==3){ 
                         $ccnum['num'] = $num; 
						 $ccnum['bin'] = substr($num,0,6);
                         $ccnum['type'] = "American+Express"; 
                    } 
                     break; 
                 case 16: 
                     switch (substr($num,0,1)){ 
                          case '4': 
                             $ccnum['num']=	$num; 
							 $ccnum['bin'] = substr($num,0,6);
                             $ccnum['type'] = "VISA"; 
                             break; 
                        case '5': 
                             $ccnum['num']=$num; 
							 $ccnum['bin'] = substr($num,0,6);
                             $ccnum['type'] = "Mastercard"; 
                             break; 
                         case '6': 
                             $ccnum['num']=$num; 
							 $ccnum['bin'] = substr($num,0,6);
                             $ccnum['type'] = "Discover"; 
                             break; 
                     } 
                     break;
					 }
					 }
    
	break;
		}
            if ($ccnum){ 
                $_d = $ccnum['num']; 
                $order[$_d][] = $ccline; 
            } 
            else $order['e'][] = $ccline; 
        } 
        ksort($order); 
        if (!is_null($order)) foreach ($order as $_d) foreach ($_d as $ccline) $ok[] = $ccline; 
        if (!is_null($order['e'])) foreach ($order['e'] as $cc) $ok[]=$ccline; 
        return $ok; 
    } 
} 
if ($_POST['cclist']){ 
    $cclist = trim($_POST['cclist']); 
    $cclist = str_replace(array("\\\"","\\'"),array("\"","'"),$cclist); 
    $cclist = str_replace("\n\n","\n",$cclist); 
    $cclist = explode("\n",$cclist); 
	$cclist = _bin($cclist);
	foreach ($cclist as $ccline){
	 switch($option) {
	case 0:
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
						 $ccnum['bin'] = substr($xx,0,6);
                         $ccnum['type'] = "American+Express"; 
                    } 
                     break; 
                 case 16: 
                     switch (substr($xx,0,1)){ 
                          case '4': 
                             $ccnum['num']=$xx; 
							 $ccnum['bin'] = substr($xx,0,6);
                             $ccnum['type'] = "VISA"; 
                             break; 
                        case '5': 
                             $ccnum['num']=$xx; 
							 $ccnum['bin'] = substr($xx,0,6);
                             $ccnum['type'] = "Mastercard"; 
                             break; 
                         case '6': 
                             $ccnum['num']=$xx; 
							 $ccnum['bin'] = substr($xx,0,6);
                             $ccnum['type'] = "Discover"; 
                             break; 
                     } 
                     break; 

              } 
          } 
          }  
		
	break;
	case 1:
	$delim = $_POST['delim'];
$xx = explode($delim,$ccline);
$num = trim($xx[$_POST['num'] - 1]);
if (is_numeric($num)){ 
             $yn=strlen($num); 
             switch ($yn){ 
                 case 15: 
                     if (substr($num,0,1)==3){ 
                         $ccnum['num'] = $num; 
						 $ccnum['bin'] = substr($num,0,6);
                         $ccnum['type'] = "American+Express"; 
                    } 
                     break; 
                 case 16: 
                     switch (substr($num,0,1)){ 
                          case '4': 
                             $ccnum['num']=	$num; 
							 $ccnum['bin'] = substr($num,0,6);
                             $ccnum['type'] = "VISA"; 
                             break; 
                        case '5': 
                             $ccnum['num']=$num; 
							 $ccnum['bin'] = substr($num,0,6);
                             $ccnum['type'] = "Mastercard"; 
                             break; 
                         case '6': 
                             $ccnum['num']=$num; 
							 $ccnum['bin'] = substr($num,0,6);
                             $ccnum['type'] = "Discover"; 
                             break; 
                     } 
                     break;
					 }
					 }
    
	break;
		}
		if ($ccnum){ 
	echo "<font color=blue><strong>| BIN : ".$ccnum['bin']." | </strong>".$ccline."</font><br>";
	}}
	echo('</div><hr border=1><div align=center><a href="index.php"><input type=button value="Soft Again !"></a><br><br><br></div>');

	}else{
?>
<form action="" method=post>
<div align="center">
<textarea style="color: rgb(85, 85, 85);" name="cclist" cols="100" rows="13" wrap="virtual" onblur="if(this.value==''){this.value='S&#7889; th&#7913; t&#7921; CC &#273;&#432;&#7907;c l&#7845;y b&#7855;t &#273;&#7847;u t&#7915; S&#7889; 1'; this.style.color='#555'}" onclick="if(this.value=='S&#7889; th&#7913; t&#7921; CC &#273;&#432;&#7907;c l&#7845;y b&#7855;t &#273;&#7847;u t&#7915; S&#7889; 1'){this.value=''; this.style.color='#000'}">S&#7889; th&#7913; t&#7921; CC &#273;&#432;&#7907;c l&#7845;y b&#7855;t &#273;&#7847;u t&#7915; S&#7889; 1</textarea> 
     </div>    <br>

     <b> <input type="radio" id="1" name="option" value="0" checked="checked" onClick="return get('1');" />Auto Get Info CC --- <input type="radio" id="2" name="option" value="1" onClick="return get('2');" />Get Info CC by Hand <br /></b>
	<br>
	<script>
function get(id)
{	
    if(document.getElementById(id).value==0)
    {
    document.getElementById("nonauto").style.display="none";
    document.getEleme?tById("auto").style.display="block";        
    return true;
    }
    if(document.getElementById(id).value==1)
    {
    document.getElementById("auto").style.display="none";
    document.getElementById("nonauto").style.display="block";    
    return true;
    }
    

}
</script><b>
	<div id="auto" style="display:block;">Auto Get Info CC - Click Check Credits Card Now!</div>
	<div id="nonauto" style="display:none;">DELIM : <input name=delim type=text value=| size=3> --- STT CCNUM : <input name=num type=text value=2 size=3><br>V? trí CC tính t? 1</b></div>

	<br><br> <input type=submit name=submit value="Check Credits Card Now!"> 
    </form> 
 <p>

 </td></tr>
  </tbody></table>
<? } ?>
    
	
</body>
</html>