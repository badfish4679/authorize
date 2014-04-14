<title>--[ Sort & Filter ]--</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<link rel="stylesheet" type="text/css" href="../../css/default1.css">

<body>
<div align=center>
<table width="100%" border="0"><tbody><tr><td align="center">

<?php
if($_POST['cclist']){
if($_POST["cclist"] == '' OR $_POST["delim"] == '' OR $_POST["getnum"] == '')
    {
        echo "<div align='left' id='res'>Điền chưa đủ thông tin</div><br />";
        exit();
    }
    $cclist=$_POST['cclist'];
    $cclist=explode("\n",$cclist);
        echo '<div align="left">';
    foreach ($cclist as $ccline){
    $delim=$_POST['delim'];
    $tp=explode($delim,$ccline); //Lấy từng phần trong 1 dòng
    $nget = explode(",",$_POST['getnum']); //Lấy từng giá trị trong GET NUMBER
    echo "";
    foreach ($nget as $ngetn){
    echo $tp[$ngetn-1]." | ";
    }
    echo "<br />";
    }
    echo '</div>';
}else{
?>
<br />
<h2><font color="violet" size="6" <blink><b> --[ Sort & Filter ]-- </b></blink></font></h2>
<form target='result' action="" method="post">

<textarea name="cclist" cols="120" rows="15" onclick="this.value='';">
EXAMPLE : SCOTT JASCH | SCOTT | JASCH | 158 S FREMOUNT ST.| 42668xxxxxxx99 | 09 | 2012 | 456 |
DELIM : |
GET NUMBER : 5,6,7,8 <= Phân cách bởi kí tự ,
Vị trí đếm tính từ 1.
RESULTS : | 42668xxxxxxx99 | 09 | 2012 | 456 |
</textarea>
<br /><br />
 <b>Delim </b> : <input type="text" name="delim" size="6" value="|">
 <b>Column(s) </b> : <input type="text" name="getnum" size="10" value="5,6,7,8"><br><br>
<input name="submit" value="     Submit !     " type="submit" /><br>
</form>

<h1><font color ="green" size="4" <b> --[ Result(s) ]-- </b></font></h1>

<div style="width:90%;border:dashed thin #80c65a;">
<iframe name='result' frameborder="0" style="width:100%;height:300px;"></iframe>
</div>

<? } ?>
</td></tr>
 </tbody></table>
</div>
</body>
</html>