<html>
<head><title>--[ Tools Get Info Mail & Pass ]--</title>
<style type="text/css">
</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=uft-8" />

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

<body><br>
 <table width="80%" align="center" border="0">
    <tbody><tr>
	<td align="center"><br>
<h1><blink><font color="green"<b>--[ Tools Get Info Mail & Pass ]</b></font></blink>--</h1>
 
<?php

 
	echo "</div><hr border=1><div align=left>";
    
if($_POST['maillist']){
	$maillist=$_POST['maillist'];
	$maillist=explode("\n",$maillist);
	foreach ($maillist as $mailline){
		$delim = $_POST['delim'];
		$list = explode($delim,$mailline);
		$list['mail']=$list[$_POST['mail'] -1];
		$list['pass'] = $list[$_POST['pass'] -1];
	echo ('<font color="blue"><b>| ');
	echo ($list['mail']." | ".$list['pass']);
	echo (' |</b></font><br>');
		}
	echo('</div><hr border=1><div align=center><a href="index.php"><input type=button value="Get Again !"></a><br><br><br></div><div align=left>');
}
else{
?>
</div><div align="center">
<form action="" method="POST" >

<textarea style="color: rgb(85, 85, 85);" name="maillist" cols=110 rows=15 wrap="virtual" onblur="if(this.value==''){this.value='Auto Get Info Credits Card'; this.style.color='#555'}" onclick="if(this.value=='Auto Get Info Credits Card'){this.value=''; this.style.color='#000'}">Auto Get Info Credits Card</textarea> 
</div><hr border="1"><div align="center"><b>DELIM : <input name=delim type=text value=| size=3> --- STT MAIL : <input name=mail type=text value=2 size=3> --- STT PASS : <input name=pass type=text value=3 size=3><br><br>  <input type=submit name=submit value="Get Now !"></b>


</form>

</td></tr></table>


<?php
}
?>
</body>
</html>