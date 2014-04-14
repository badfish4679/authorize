<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html> 
<title>--[ Tool Hack Shop CFM ]--</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="../../../css/default1.css" />

 <body>
 <table width="80%" align="center" border="0">
    <tbody><tr>
	<td align="center">
<h1><blink><font color="green" <b>--[ Tool Hack Shop CFM ]--</b></font><blink></h1>

<a href="readme.html" target="main"><input type="button" value="Read Me"></a>

<div align="center">
</div><hr border="1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form target="main" action="table.php" method="POST">
  <br /><br /><tr>
    <td width="25%"> <div align="right"><strong>Link- Đường dẫn bị Sql Injection : </strong></div></td>
    <td width="75%"><input name="link" type="text" class="style1" size="100" maxlength="1000"> </td>
  </tr>
  <tr>
    <td><br /><div align="right"><strong>(http://victim.com/products.cfm?id=)</strong></div></td>
<input type="hidden" name="hiddenField">
    <td><br /><div align="center"><input name="submit" type="submit" value="Get tables - Lấy Bảng"></div></td>
  </tr>
</form>
</table>
<br />
<hr /><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form target="main" action="generate.php" method="POST">
  <tr>
    <td width="25%"><div align="right"><strong>Link- Đường dẫn bị sql injection : </strong></div></td>
    <td width="75%"><input name="link" type="text" class="style1" size="100" maxlength="1000"></td>
  </tr>
  <tr>
    <td><br /><div align="right"><strong>(http://victim.com/products.cfm?id=)</strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="right"><strong>Table 1 :=></strong>
          <input type="text" style="width:200px" name="table1">&nbsp;
        </div></td>
        <td>&nbsp;<input type="text" style="width:200px" name="table2">
          <strong><=: Table 2</strong></td>
      </tr>
      <tr>
        <td><div align="right"><strong>Column 1 :=></strong>
          <input type="text" style="width:200px" name="column1">&nbsp;</div></td>
        <td>&nbsp;<input type="text" style="width:200px" name="column2">
          <strong><=: Column 2</strong></td>
      </tr>
      <tr>
        <td><div align="right"><textarea name="fields1" rows="5" class="style12" style="width:200px" type="text"></textarea>&nbsp;</div></td>
        <td>&nbsp;<textarea name="fields2" rows="5" class="style12" style="width:200px" type="text"></textarea></td>
      </tr>
    </table></td>

  </tr>
<tr>
<td></td>
<td><div align="center"><input type="submit" style="width:410px" value="Generate link - Tạo đường dẫn"></div></td>
</tr>
</form>
</table>
<br /><hr><br />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<form target="main" action="getlatest.php" method="POST">
  <tr>
    <td width="25%"><div align="right"><strong> Link- Đường dẫn đã tạo: </strong></div></td>
    <td width="75%"><input name="link" type="text" class="style1" size="100" maxlength="5000"></td>
  </tr>
  <tr>
    <td><br /><div align="right"><strong>(the generated link)</strong></div></td>
    <td><br /><div align="center"><input type="submit" value="Lấy order cuối cùng"></div></td>
  </tr>
 </form>
</table>
<br /><hr><br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <form target="main" action="getdata.php" method="POST">
  <tr>
    <td width="25%"> <div align="right"><strong>Link- Đường dẫn sửa đổi: </strong></div></td>
    <td width="75%"><input name="link" type="text" class="style1" size="100" maxlength="5000"></td>
  </tr>
  <tr>
    <td> <div align="center"><strong>(the fixed link) </strong></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="right"><span class="style1">Last ID :</span>              
          <input type="text" style="width:200px" name="lastID"> 
            &nbsp;</div></td>
        <td>&nbsp;<input type="text" style="width:200px" name="quantity"> <strong>Số lượng</strong></td>
      </tr>
      <tr>
        <td><div align="right">&nbsp;</div></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
<tr>
<td></td>
<td><div align="center"><input type="submit" style="width:408px" value="Get data - Lấy nhiều order cùng lúc"></div></td>
</tr>
</form>
</table><p>&nbsp;</p>

</td></tr></tbody></table>
</body>
</html>
