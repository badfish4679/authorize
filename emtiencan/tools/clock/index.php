<center>
<h1><font color="violet"<b> World Clock - Useful for Shipper :D </b> </font> </h1>

<link rel="stylesheet" type="text/css" href="../../css/default1.css" />

<?
//code for the World Wide Clock
$rqst=$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];
$url="http://www.onyoursite.com/data/wwc.htp?rqst=".$rqst;
@readfile($url);
?> 

</center>