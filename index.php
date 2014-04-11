<?php
require("config.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>CiCi autobot - v1.0 - build 20140412</title>
    <meta charset="utf-8"
    <meta property="fb:app_id" content="753308934688020"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap -->
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $site_root;?>bootstrap/css/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $site_root;?>bootstrap/css/bootstrap-responsive.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $site_root;?>bootstrap/css/bootstrap-theme.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $site_root;?>bootstrap/css/datepicker.css">
    <link media="all" type="text/css" rel="stylesheet" href="<?php echo $site_root;?>style.css">
</head>
<body>
<h1 class="text-center">CiCi AUTOBOT <label class=" label label-primary">V1.0</label></h1>
<br>
<div class="col-xs-12 col-md-6">
    <button class="btn btn-sm btn-success  pull-right" onclick="getinfo()"><span class="glyphicon glyphicon-info-sign"></span> Lấy thông tin</button>
    <div class="clearfix"></div>
    <br>
    <fieldset>
        <legend>Cấu hình đọc file </legend>
        <label>Ký tự phân cách </label>
        <input id="ccsplit" placeholder="" value="|" style="width: 30px" class="text-center">
        <label>Mã thẻ </label>
        <input id="ccnumber" placeholder="cột mã thẻ" value="1" style="width: 30px" class="text-center">
        <label>Tháng </label>
        <input id="ccmonth" placeholder="cột tháng" value="2" style="width: 30px" class="text-center">
        <label>Năm </label>
        <input id="ccyear" placeholder="cột năm" value="3" style="width: 30px" class="text-center">
        <input id="ccdatesplit" placeholder="" value="/" style="width: 30px" class="text-center">
        <label>CCV </label>
        <input id="ccv" placeholder="cột CCV " value="4" style="width: 30px" class="text-center">
       <br>
        <label>F name </label>
        <input id="ccfname" placeholder="cột first name " value="5" style="width: 30px" class="text-center">
        <label>L name </label>
        <input id="cclname" placeholder="cột last name " value="6" style="width: 30px" class="text-center">
        <label>Addr </label>
        <input id="ccaddr" placeholder="cột địa chỉ " value="7" style="width: 30px" class="text-center">
        <label>City </label>
        <input id="cccity" placeholder="cột thành phố " value="8" style="width: 30px" class="text-center">
        <label>State</label>
        <input id="ccstate" placeholder="cột bang " value="9" style="width: 30px" class="text-center">
        <label>Country</label>
        <input id="cccountry" placeholder="cột quốc gia " value="10" style="width: 30px" class="text-center">
        <label>Zip</label>
        <input id="cczip" placeholder="cột zip " value="11" style="width: 30px" class="text-center">
    </fieldset>
    <br>
    <textarea style="width: 100%;min-height: 300px" id="input"></textarea>
</div>
<div class="col-xs-12 col-md-6">
    <button class="btn btn-sm btn-success  pull-right"><span class="glyphicon glyphicon-play"></span> Run</button>
    <div class="clearfix"></div>
    <br>
    <fieldset>
        <legend>Thông tin </legend>
        <table class="table table-responsive table-bordered">
            <thead>
            <th>STT</th>
            <th>Mã thẻ</th>
            <th>Ngày</th>
            <th>CCV</th>
            <th>Auth</th>
            <th>Paid</th>
            <th>Refund</th>
            </thead>
            <tbody id="tablecontent">

            </tbody>
        </table>
    </fieldset>

</div>
</body>
</html>
<script src="<?php echo $site_root;?>jquery.js"></script>
<script src="<?php echo $site_root;?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $site_root;?>bootstrap/js/bootstrap-datepicker.js"></script>
<script>
    function getinfo(){
        if($("#input").val().trim()!=''){
            $("#tablecontent").html("");
            var input = $("#input").val();
            var arrLines = input.split("\n");
            for(var i=0;i<arrLines.length;i++){
                if(arrLines[i].trim()!=''){
                    var arrCols = arrLines[i].split($("#ccsplit").val());
                    var html = '<tr>' +
                               '<td>'+(i+1)+'</td>' +
                               '<td><input id="waitnumber'+(i+1)+'" value="'+arrCols[($('#ccnumber').val())]+'"></td>';
                    if(arrCols[($('#ccmonth').val())].indexOf("/") > 0){
                        var aDate = arrCols[($('#ccmonth').val())].split("/");
                        var month = aDate[0];
                        if(parseInt(month)<10) month = "0"+month;
                        var year = aDate[1];
                        year = year.substr((year.length-2),2);
                        html+=     '<td><input id="waitdate'+(i+1)+'" value="'+month+'/'+year+'" style="width:50px"></td>';
                    }
                    else if($('#ccmonth').val() != $('#ccyear').val() ){
                        var month = arrCols[$('#ccmonth').val()];
                        if(parseInt(month)<10) month = "0"+month;
                        var year = arrCols[($('#ccyear').val())];
                        year = year.substr((year.length-2),2);
                        html+=     '<td><input id="waitdate'+(i+1)+'" value="'+month+'/'+year+'" style="width:50px"></td>';
                    }
                    else{
                        var aDate = arrCols[$('#ccmonth').val()].split("/");
                        var month = aDate[0];
                        if(parseInt(month)<10) month = "0"+month;
                        var year = aDate[1];
                        year = year.substr((year.length-2),2);
                        html+=     '<td><input id="waitdate'+(i+1)+'" value="'+month+'/'+year+'" style="width:50px"></td>';
                    }

                    html+=     '<td><input id="waitccv'+(i+1)+'" value="'+arrCols[($('#ccv').val())]+'"  style="width:50px"></td>' +
                               '<td></td>' +
                               '<td></td>' +
                               '<td></td>' +
                               '</tr>'
                    $("#tablecontent").append(html);
                }
            }
        }

    }
</script>




