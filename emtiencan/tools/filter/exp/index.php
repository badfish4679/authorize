<html> 
<title>--[ EXP Filter - Code by EmXinhTT.Net ]--</title>
<link rel="stylesheet" type="text/css" href="../../../css/default1.css">
<script>
function tuxu(){
    document.getElementById("tuxu").innerHTML = '<br>Delim <input type=text name=kitu value="|" size=6> Month <input type=text name=mon value="3" size=6> Year <input type=text name=year value="4" size=6>';
}
</script>
<body>
<? 

function percent($num_amount, $num_total) {
$count1 = $num_amount / $num_total; 
$count2 = $count1 * 100; 
$count = number_format($count2, 0); 
return $count; 
}


function checkMon($date){
    $len = strlen($date);
    if ($len == 1) return $date;
    elseif ($len ==2){
        switch ($date){
                case '01': $date=1; break;
                case '02': $date=2; break;
                case '03': $date=3; break;
                case '04': $date=4; break;
                case '05': $date=5; break;
                case '06': $date=6; break;
                case '07': $date=7; break;
                case '08': $date=8; break;
                case '09': $date=9; break;
                case '10': $date=10; break;
                case '11': $date=11; break;
                case '12': $date=12; break;
            }
            return $date;
        }
    else return false;
}


function checkYear($date){
    $len = strlen($date);
    if ($len == 4) return $date;
    elseif ($len ==2){ $date = "20".$date; return $date;}
    else return false;
}

function get($line){ 
  $xy = array("|","\\","/","-",";"); 
  $sepe = $xy[0]; 
  foreach($xy as $v){ 
      if (substr_count($line,$sepe) < substr_count($line,$v)) $sepe = $v; 
  } 
  foreach($xy as $y) $line = str_replace($y,$sepe,str_replace(" ","",$line)); 
  $x = explode($sepe,$line); 
  foreach ($x as $xx){ 
      $xx = trim($xx); 
         if (is_numeric($xx)){ 
             $yy=strlen($xx); 
             switch ($yy){ 
                 case 1: 
                     if (($xx >= 1) and ($xx <=9) and (!isset($ccnum['mon']))) $ccnum['mon'] = $xx; 
                 case 2: 
                     if (($xx >= 1) and ($xx <=12) and (!isset($ccnum['mon'])))    $ccnum['mon'] = $xx; 
                     elseif (($xx > 9) and ($xx <= 19) and (isset($ccnum['mon'])) and (!isset($ccnum['year'])))    $ccnum['year'] = "20".$xx; 
                     break; 
                 case 4: 
                     if (($xx >= 2009) and ($xx <= 2019) and (isset($ccnum['mon'])))    $ccnum['year'] = $xx; 
                     elseif ((substr($xx,0,2) >= 1) and (substr($xx,0,2) <=12) and (substr($xx,2,2)> 9) and (substr($xx,2,2) <= 19) and (!isset($ccnum['mon'])) and (!isset($ccnum['year']))){ 
                             switch (substr($xx,0,2)){
                                case '01': $ccnum['mon']=1; break;
                                case '02': $ccnum['mon']=2; break;
                                case '03': $ccnum['mon']=3; break;
                                case '04': $ccnum['mon']=4; break;
                                case '05': $ccnum['mon']=5; break;
                                case '06': $ccnum['mon']=6; break;
                                case '07': $ccnum['mon']=7; break;
                                case '08': $ccnum['mon']=8; break;
                                case '09': $ccnum['mon']=9; break;
                                case '10': $ccnum['mon']=10; break;
                                case '11': $ccnum['mon']=11; break;
                                case '12': $ccnum['mon']=12; break;
                            }
                            $ccnum['year'] = "20".substr($xx,2,2); 
                         } 
                     break; 
                 case 6: 
                     if ((substr($xx,0,2) >= 01) and (substr($xx,0,2) <=12) and (substr($xx,2,4)>= 2009) and (substr($xx,2,4) <= 2019)){ 
                            switch (substr($xx,0,2)){
                                case '01': $ccnum['mon']=1; break;
                                case '02': $ccnum['mon']=2; break;
                                case '03': $ccnum['mon']=3; break;
                                case '04': $ccnum['mon']=4; break;
                                case '05': $ccnum['mon']=5; break;
                                case '06': $ccnum['mon']=6; break;
                                case '07': $ccnum['mon']=7; break;
                                case '08': $ccnum['mon']=8; break;
                                case '09': $ccnum['mon']=9; break;
                                case '10': $ccnum['mon']=10; break;
                                case '11': $ccnum['mon']=11; break;
                                case '12': $ccnum['mon']=12; break;
                            }
                            $ccnum['year'] = substr($xx,2,4); 
                    } 
                    break; 
              } 
          } 
          } 
    if (isset($ccnum['mon']) and isset($ccnum['year'])){ 
        return $ccnum; 
    } 
    else return false; 
}

if ($_POST['cclist']){
        $em = $_POST['em'];
        $ey = $_POST['ey'];
        
        $conexp = "";
        $hetexp = "";

        $cclist = trim($_POST['cclist']); 
        $cclist = str_replace(array("\\\"","\\'"),array("\"","'"),$cclist); 
        $cclist = str_replace("\n\n","\n",$cclist); 
        $cclist = explode("\n",$cclist);
        
        for($i=0;$i<count($cclist);$i++){
            if($_POST['kind']=='auto'){
                $ccnum = get($cclist[$i]);
                $ccmon = $ccnum['mon'];
                $ccyear = $ccnum['year'];
            }
            else{
                $ccc = explode($_POST['kitu'],$cclist[$i]);
                $ccmon = (checkMon(trim($ccc[$_POST['mon']])));
                $ccyear = (checkYear(trim($ccc[$_POST['year']])));
            }
            
            if($ccyear < $ey){
                $hetexp .= $cclist[$i]."\n";
            }
            elseif($ccyear == $ey && $ccmon < $em){
                $hetexp .= $cclist[$i]."\n";
            }
            else{
                $conexp .= $cclist[$i]."\n";
            }
        }
        
        $per1 = percent(count(explode("\n",$conexp))-1,count($cclist));
        $per2 = percent(count(explode("\n",$hetexp))-1,count($cclist));
        
        echo "<center>";
        echo "<h1>Ket Qua - EmXinhTT.Net</h1>";
        echo "<font color=blue>Còn H?n</font> $per1 % (".(count(explode("\n",$conexp))-1)."/".count($cclist).")<br>";
        echo "<textarea cols=120 rows=10>$conexp</textarea><br>";
        echo "<font color=red>H?t H?n</font> $per2 % (".(count(explode("\n",$hetexp))-1)."/".count($cclist).")<br>";
        echo "<textarea cols=120 rows=10>$hetexp</textarea><br>";
    }
else{
?> 
<center><h1><font color="green"<blink><b>--[ EXP Filter - Code by EmXinhTT.Net ]--</h1></b></font></blink<br><b>Credit Card List:</b>
    <form action="" method=post name=f> 
        <textarea wrap="off" name=cclist cols=120 rows=20></textarea><br>
        Month <input type=text name=em value="9"> Year <input type=text name=ey value="2010"><br>
        <input type=radio name=kind value=auto checked> Automatic
        <input type=radio name=kind value=non onClick="tuxu()">Manual<div id=tuxu></div><br>
       <br><br> <input type=submit name=submit size=10 value="CHECK NOW"> 
    </form> 
<? }?>
</body>
</html>