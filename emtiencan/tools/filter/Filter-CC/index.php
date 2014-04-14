<html>
<title> --[ Tool Filter CC & Order ]-- </title>

<center>
	<h2><font color="violet" size="6" <blink><b> --[ Tool Filter CC & Order ]-- </b></blink></font></h2>
</center>

<link rel ="stylesheet" type="text/css" link href="../../../css/default1.css"

<?php
/*
+ Loc CC By Nhóc Chíp - AZS
*/

if($_POST['concaocao']){
	if(strpos($_POST['concaocao'], '.txt')){
	// Use TXT FILE
	$data	=	file_get_contents($_POST['concaocao']);
	$data	=	explode(chr(13).chr(10),$data); 	
	}
	else{
	/* USE POST WAY */
	$data	=	$_POST['concaocao'];
	$data	=	explode("\r",$data); // Work only in Window
	echo '<b>Total: </b>'.count($data).'<hr>';
	}
	foreach($data as $key => $value)
	{
		for($i=0,$c=strlen($value);$i<$c;$i++)
		{
			$char	=	substr($value,$i,1);
			if(is_numeric($char))
			{
				$ccNum	.=	$char;
			}
			else
			{
				if(is_numeric($ccNum) && strlen($ccNum) > 14)
				{
					if(!$check[$ccNum])
					{
					$check[$ccNum]	=	true;
					if($_POST['binfilter']){
						$type	=	substr($ccNum,0,strlen($_POST['binfilter']));
						if($type == $_POST['binfilter'])
						{
						$cc['bin'][]	=	array($value);
						}
					}
					else{
					$type	=	substr($ccNum,0,1);
					if($type == 3)
					{
						$cc['amex'][]	=	array($value);
					}
					elseif($type == 4)
					{
						$cc['visa'][]	=	array($value);
					}
					elseif($type == 5)
					{
						$cc['master'][]	=	array($value);
					}
					elseif($type == 6)
					{
						$cc['discover'][]	=	array($value);
					}
					}
					$ccNum	=	false;
					break;
					}
				}
				else
				{
					$ccNum	=	false;
				}
			}
		}
	}
	$cols = '100%';
	$rows = '5';
	if(!$_POST['binfilter']){
	   if(!is_null($cc['amex'])){
	echo '<pre><b>Amex: </b>'.count($cc['amex']).'<Br><textarea cols="100"'.$cols.'" rows="8"'.$rows.'">';
	foreach($cc['amex'] as $key=>$value){
		echo $value[0]."";
	}
	echo '</textarea></pre>';
	//
    } if(!is_null($cc['visa'])){
	echo '<pre><b>Visa: </b>'.count($cc['visa']).'<Br><textarea cols="100"'.$cols.'" rows="8"'.$rows.'">';
	foreach($cc['visa'] as $key=>$value){
		echo $value[0]."";
	}
	echo '</textarea></pre>';
	//
    } if(!is_null($cc['master'])){
	echo '<pre><b>Master: </b>'.count($cc['master']).'<Br><textarea cols="100"'.$cols.'" rows="8"'.$rows.'">';
	foreach($cc['master'] as $key=>$value){
		echo $value[0]."";
	}
	echo '</textarea></pre>';
	//
    } if(!is_null($cc['discover'])){
	echo '<pre><b>Discover: </b>'.count($cc['discover']).'<Br><textarea cols="100"'.$cols.'" rows="8"'.$rows.'">';
	foreach($cc['discover'] as $key=>$value){
		echo $value[0]."";
	}
	echo '</textarea></pre>';
    } 
	}
	else{
	   if(!is_null($cc['bin'])){
		echo '<pre><b>BIN: </b>'.count($cc['bin']).'<Br><textarea cols="100"'.$cols.'" rows="10"'.$rows.'">';
	foreach($cc['bin'] as $key=>$value){
		echo $value[0]."";
	}
	echo '</textarea></pre>';
    }
	}
}
else{
?>

<form method="POST" action="">
<textarea name="concaocao" cols="100" rows="20"></textarea><br>
<input type="text" name="binfilter" size="15" value="0"> Nh&#7853;p BIN C&#7847;n L&#7885;c V&#224;o VD:Mu&#7889;n L&#7845;y BIN (MASTER Nh&#7853;p:5,VISA Nh&#7853;p:4...)
Nh&#7853;p:<b>0</b> &#272;&#7875; T&#7855;t Ch&#7913;c N&#259;ng L&#7885;c BIN!
<br>
<br><input type="submit" value="Submit">

</form>
</html>

<? } ?>