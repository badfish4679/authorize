<!--
Admin Page Finder script v0.1 by Jan Dlabal, admin [at] houbysoft [dot] com, http://houbysoft.com

    Admin Page Finder is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Admin Page Finder is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Admin Page Finder.  If not, see <http://www.gnu.org/licenses/>.

-->

<html>
<head>
<title>scan link admin-linhbatinh</title>
</head>
<body bgcolor=#000000>
<font face="Arial, Helvetica, sans-serif"></font><font color='white'>

<?
require 'url_exists.inc';
$URL = $_GET['url'];
$URL=stripslashes($URL);
$URL=HTMLSpecialChars($URL);
$ID = $_GET['id'];
$ID=stripslashes($ID);
$ID=HTMLSpecialChars($ID);
$STR = $_GET['str'];
$STR=stripslashes($STR);
$STR=HTMLSpecialChars($STR);


if (!url_exists($URL))
{
  echo "<font color='red'>loi roi ku</font> : ".$URL." co ve server bi down.<br>";
} else {
  $filename = "./list.txt";
  $handle = fopen($filename, "r");
  $contents = fread($handle, filesize($filename));
  fclose($handle);
  $testme = explode("\n", $contents);

  if ($testme[$ID] == NULL)
  {
    echo "script (c) by Jan Dlabal, admin [at] houbysoft [dot] com.<br><a href="/">Restart script</a>";
    echo "<font color='yellow'>FINISHED</font><br>các link dc tim thay:<br>";
    echo $STR;
  } else {
    $URL_test = $URL.$testme[$ID];
    echo "<font color='green'>dang test</font> : ".$URL_test."<br>";
    echo "<font color='yellow'>cac link login dc tim thay cho den nay</font> : ".$STR."<br>";
    if (url_exists($URL_test))
    {
      if ($STR != "")
        $STR .= ", ";
      $STR .= $URL_test;
    }
    $ID++;
    include "redirect_script.inc";
  }

}
?>

</font>
</body>
</html>