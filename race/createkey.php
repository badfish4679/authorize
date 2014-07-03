<?php
require('DB.php');
$db = connect();
if (isset($_POST['passwd'])) {
    $sql = "SELECT count(cname) FROM `config` WHERE cname='passwd' AND cvalue='" . mysql_escape_string($_POST['passwd']) . "' ";
    $flag = false;
    foreach ($db->query($sql) as $row) {
        if ($row[0] > 0) $flag = true;
    }
    if ($flag) {
        if(isset($_POST['delete'])){
            $sql = "DELETE FROM `mykeys` WHERE keys='".$_POST['delete']."' ";
            $count = $db->exec($sql);
        }
        if (isset($_POST['submit'])) {
            try {
                $sql = "INSERT INTO `mykeys` (`keys`,`amount`,`leftamount`,`keytype`) VALUES ('" . mysql_escape_string($_POST['key']) . "','" . mysql_escape_string($_POST['amount']) . "','" . mysql_escape_string($_POST['amount']) . "','" . mysql_escape_string($_POST['keytype']) . "')";
//            echo $sql;
                $count = $db->exec($sql);
//                var_dump($count);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
//        else if (isset($_POST['viewkey'])) {
        $sql = "SELECT * FROM `mykeys` ";
        $listkey = "<hr>
            <h2>Danh sách keys đang có</h2>
            <table border=1><thead><tr>
            <td>STT</td>
            <td>KEY</td>
            <td>Số lượng </td>
            <td>Còn</td>
            <td>Loại</td>
            <td>Xóa key</td>
            </tr></thead><tbody>";
        $count = 1;
        foreach ($db->query($sql) as $row) {
            $listkey .= "<tr>
                    <td>" . $count++ . "</td>
                    <td>" . $row[0] . "</td>
                    <td>" . $row[1] . "</td>
                    <td>" . $row[2] . "</td>
                    <td>" . $row[3] . "</td>
                    <td><input type='submit' name='delete' value='".$row[0]."'></td>
                </tr>";
        }
        $listkey .= "</tbody></table><hr>";
    }
//    }
    $db = null;
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Tạo key cho tool check CC </title>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            padding: 5px;
        }
    </style>
</head>
<body>
<center>
    <h1>Tạo key cho tool check CC </h1>


    <form method="POST" action="">
        <p style="color:red;"><?php if (isset($flag) && !$flag) echo 'Sai mật khẩu!';
            else echo ''; ?></p>
        <div><?php if (isset($listkey)) echo $listkey; ?></div>
        <table>
            <tr>
                <td>KEY</td>
                <td><input name="key"
                           value="<?php echo((isset($_POST['key'])) ? $_POST['key'] : ''); ?>"></td>
            </tr>
            <tr>
                <td>Số lượng</td>
                <td><input name="amount"
                           value="<?php echo((isset($_POST['amount'])) ? $_POST['amount'] : ''); ?>">
                </td>
            </tr>
            <tr>
                <td>Loại key</td>
                <td><input name="keytype"
                           value="<?php echo((isset($_POST['keytype'])) ? $_POST['keytype'] : ''); ?>">
                </td>
            </tr>
            <tr>
                <td>Mật khẩu</td>
                <td><input name="passwd" type="password"
                           value="<?php echo((isset($_POST['passwd'])) ? $_POST['passwd'] : ''); ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="viewkey" value="  Xem  ">
                    <input type="submit" name="submit" value="  Tạo  ">
                </td>
            </tr>
        </table>


    </form>
</center>
</body>
</html>