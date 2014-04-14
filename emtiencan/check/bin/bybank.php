<?

function getStr($string,$start,$end){
	$str = explode($start,$string);
	$str = explode($end,$str[1]);
	return $str[0];
}

function info($bank){
	$file1 = file_get_contents('dbbin1/vbin30.csv');
	$file2 = file_get_contents('dbbin1/mbin30.csv');
	$file3 = file_get_contents('dbbin1/abin30.csv');
	
	$file1 = explode("\n",$file1);
	$file2 = explode("\n",$file2);
	$file3 = explode("\n",$file3);

	$data = "";

	foreach($file1 as $line1){
		if(stristr($line1,$bank)){
			$info = trim($line1);
			$info = explode(";",$info);
			
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
			
			$data .= "<tr align=center><td><font color=blue>".$info[0]."</font></td><td>$bank</td><td>".$info[2]." ".$info[3]."&nbsp;</td><td>".$info[4]."</td><td>".$info[9]."&nbsp;</td></tr>";
		}
	}
	foreach($file2 as $line2){
		if(stristr($line2,$bank)){
			$info = trim($line2);
			$info = explode(";",$info);
			
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
			
			$data .= "<tr align=center><td><font color=blue>".$info[0]."</font></td><td>$bank</td><td>".$info[2]." ".$info[3]."&nbsp;</td><td>".$info[4]."</td><td>".$info[9]."&nbsp;</td></tr>";
		}
	}
	foreach($file3 as $line3){
		if(stristr($line3,$bank)){
			$info = trim($line3);
			$info = explode(";",$info);
			
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
			
			$data .= "<tr align=center><td><font color=blue>".$info[0]."</font></td><td>$bank</td><td>".$info[2]." ".$info[3]."&nbsp;</td><td>".$info[4]."</td><td>".$info[9]."&nbsp;</td></tr>";
		}
	}

	return $data;
}

$bank = $_GET['bank'];

echo '<html>
<head><title>--[ Search BIN by Bank - Code by LTB.VN ]--</title>
<link rel="stylesheet" type="text/css" href="../css/default1.css">
</style>
</head>
<body>
<center>';

echo "<h1>--[ K&#7871;t Qu&#7843; - LTB.VN ]--</h1>";
echo "<table border=0 width=90%><tr align=center><td><b><font color=red>Card Number</font></b></td><td><b><font color=red>Bank Name</font></b></td><td><b><font color=red>Card Type</font></b></td><td><b><font color=red>Country</font></b></td><td><b><font color=red>Bank Phone</font></b></td></tr>";
$info = info($bank);
echo $info;
echo "</table></body></html>";
?>