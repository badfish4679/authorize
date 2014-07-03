<html>
<head>
    <meta charset="utf-8">
    <title>Nhập key để check CC </title>
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
    <h1>Nhập key để check CC</h1>
    <p style="color: red">
        <?php
        if(isset($_GET['error']) && $_GET['error']==1)
            echo 'KEY sai!!!';
        if(isset($_GET['error']) && $_GET['error']==2)
            echo 'KEY đã hết lượt check, vui lòng liên hệ!!!';
        if(isset($_GET['error']) && $_GET['error']==3)
            echo 'Số lượng cần check nhiều hơn số lượt khả dụng, vui lòng thay đổi!!!';
        ?>
    </p>

    <form method="GET" action="check" >
        <p style="color:red;"><?php if (isset($flag) && !$flag) echo 'Sai mật khẩu!';
            else echo ''; ?></p>
        <input name="key" id="key" placeholder="Input key here..">
        <input type="submit" name="submit" value="  GO!  ">

    </form>
</center>
</html>
<script>
    function mysubmit(){
        var key = document.getElementById('key').value;
        window.location = "check/"+key;
        alert(key);
        return false;
    }
</script>