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
    <link media="all" type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="bootstrap/css/datepicker.css">
    <link media="all" type="text/css" rel="stylesheet" href="style.css">
    <link media="all" type="text/css" rel="stylesheet" href="jquery-linedtextarea.css">
</head>
<body>
<h1 class="text-center">CiCi Aut0b0t <label class=" label label-default">V1.0</label></h1>
<br>
<div class="col-xs-12 col-md-12">

    <fieldset>
        <legend>Cấu hình đọc file </legend>
        <label>Ký tự phân cách </label>
        <input id="ccsplit" placeholder="" value="|" style="width: 30px" class="text-center">
        <label>Mã thẻ </label>
        <input id="ccnumber" placeholder="cột mã thẻ" value="0" style="width: 30px" class="text-center">
        <label>Tháng </label>
        <input id="ccmonth" placeholder="cột tháng" value="1" style="width: 30px" class="text-center">
        <label>Năm </label>
        <input id="ccyear" placeholder="cột năm" value="2" style="width: 30px" class="text-center">
        <label>CCV </label>
        <input id="ccv" placeholder="cột CCV " value="3" style="width: 30px" class="text-center">
        <label>F name </label>
        <input id="ccfname" placeholder="cột name " value="4" style="width: 30px" class="text-center">
        <label>Addr </label>
        <input id="ccaddr" placeholder="cột địa chỉ " value="5" style="width: 30px" class="text-center">
        <label>City </label>
        <input id="cccity" placeholder="cột thành phố " value="6" style="width: 30px" class="text-center">
        <label>State</label>
        <input id="ccstate" placeholder="cột bang " value="7" style="width: 30px" class="text-center">
        <label>Zip</label>
        <input id="cczip" placeholder="cột zip " value="8" style="width: 30px" class="text-center">
        <label>Country</label>
        <input id="cccountry" placeholder="cột quốc gia " value="9" style="width: 30px" class="text-center">

    </fieldset>
    <br>
    <textarea style="width: 100%;min-height: 150px" id="input"></textarea>
</div>
<div class="clearfix">
    <br>
</div>
<div class="col-xs-12 col-md-12">
    <button class="btn btn-sm btn-success  pull-left" onclick="getinfo()"><span class="glyphicon glyphicon-info-sign"></span> Lấy thông tin</button>
    <div class="clearfix"></div>
    <br>

    <fieldset>
        <legend>Thông tin </legend>
        <div class="col-xs-12" id="status">
            <label>Hàng hiện tại </label>
            <input id="currentrow" value="0" style="width: 50px;text-align: center">
            <label>Inteval </label>
            <input id="inteval" value="5000" style="width: 100px;text-align: center">
        </div>
        <div class="pull-left" id="nofi"></div>
        <button onclick="checkOne()" class="btn btn-sm btn-success  pull-right"><span class="glyphicon glyphicon-play"></span> Run</button>
        <div class="clearfix"></div>
        <br>
        <table class="table table-responsive table-bordered">
            <thead>
            <th><input type=checkbox id="checkall"></th>
            <th>STT</th>
            <th>Mã thẻ</th>
            <th>Ngày</th>
            <th>CCV</th>
            <th>Auth</th>
            <th>Paid</th>
            <th>Refund</th>
            <th>Name</th>
            <th>Addr</th>
            <th>City</th>
            <th>State</th>
            <th>Zip</th>
            <th>Country</th>
            </thead>
            <tbody id="tablecontent">

            </tbody>
        </table>
    </fieldset>

</div>
</body>
</html>
<script src="jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap-datepicker.js"></script>
<script src="jquery-linedtextarea.js"></script>
<script>
    $(function() {
        // Target all classed with ".lined"
        $("#input").linedtextarea(
        );

    });
    $(document).ready(function() {
        $('#checkall').click(function(event) {  //on click
            if(this.checked) { // check select status
                $('.checkbox').each(function() { //loop through each checkbox
                    this.checked = true;  //select all checkboxes with class "checkbox1"
                });
            }else{
                $('.checkbox').each(function() { //loop through each checkbox
                    this.checked = false; //deselect all checkboxes with class "checkbox1"
                });
            }
        });

    });
    function checkOne(){
        var row = $("#currentrow").val();
        if(parseInt(row)>0){
            $.ajax({
                url:"Process.php",
                data:"card_num="+$("#waitnumber"+row).val().trim()+
                    "&exp_date="+$("#waitdate"+row).val().trim() +
                    "&first_name="+$("#waitfname"+row).val().trim() +
//                    "&last_name="+$("#waitfname"+row).val().trim() +
                    "&address="+$("#waitaddr"+row).val().trim() +
                    "&city="+$("#waitcity"+row).val().trim() +
                    "&state="+$("#waitstate"+row).val().trim() +
                    "&country="+$("#waitcountry"+row).val().trim() +
                    "&zip="+$("#waitzip"+row).val().trim() +
                    "&card_code="+$("#waitccv"+row).val().trim()+"",
                method:"post",
                success:function(msg){
                    var result = eval(msg);
                    if(result.authorize){
                        $("#auth"+row).html("OK").addClass("label label-success");
                        if(result.capture){
                            $("#paid"+row).html("OK").addClass("label label-success");
                        }
                        else{
                            $("#paid"+row).html("FAIL").addClass("label label-danger");
                        }
                        if(result.refurn){
                            $("#refund"+row).html("OK").addClass("label label-success");
                        }
                        else{
                            $("#refund"+row).html("FAIL").addClass("label label-danger");
                        }
                    }
                    else{
                        $("#auth"+row).html("FAIL").addClass("label label-danger");
                    }
                }
            });
        }

    }
    function getinfo(){
        if($("#input").val().trim()!=''){
            $("#tablecontent").html("");
            var input = $("#input").val();
            var arrLines = input.split("\n");
            var count = 0;
            $("#nofi").html("");
            for(var i=0;i<arrLines.length;i++){
                try{
                if(arrLines[i].trim()!=''){
                    var arrCols = arrLines[i].split($("#ccsplit").val());
                    var flag = 0;
                    var html = '<tr>' +
                        '<td><input type="checkbox" id="check'+(i+1)+'" class="checkbox"></td>' +
                               '<td>'+(i+1)+'' +
                        '</td>' +
                               '<td><input type="text" id="waitnumber'+(i+1)+'" value="'+arrCols[($('#ccnumber').val())].trim()+'"></td>';
                    if(arrCols[($('#ccmonth').val())].trim().indexOf("/") > 0 && $('#ccmonth').val() != $('#ccyear').val()){
                        flag = 1;
                        var aDate = arrCols[($('#ccmonth').val())].trim().split("/");
                        var month = aDate[0].trim();
                        if(month.length < 2) month = "0"+month;
                        var year = aDate[1].trim();
//                        year = year.substr((year.length-2),2);
                        html+=     '<td><input  type="text" id="waitdate'+(i+1)+'" value="'+month+'/'+year+'" style="width:70px"></td>';
                    }
                    else if($('#ccmonth').val() != $('#ccyear').val() ){
                        var month = arrCols[$('#ccmonth').val()].trim();
                        if(month.length < 2) month = "0"+month;
                        var year = arrCols[($('#ccyear').val())].trim();
//                        year = year.substr((year.length-2),2);
                        html+=     '<td><input  type="text" id="waitdate'+(i+1)+'" value="'+month+'/'+year+'" style="width:70px"></td>';
                    }
                    else{
                        var aDate = arrCols[$('#ccmonth').val()].trim().split("/");
                        var month = aDate[0].trim();
                        if(month.length < 2) month = "0"+month;
                        var year = aDate[1].trim();
//                        year = year.substr((year.length-2),2);
                        html+=     '<td><input  type="text" id="waitdate'+(i+1)+'" value="'+month+'/'+year+'" style="width:70px"></td>';
                    }

                    html+=     '<td><input  type="text" id="waitccv'+(i+1)+'" value="'+arrCols[($('#ccv').val() - flag)].trim()+'"  style="width:50px"></td>' +
                               '<td ><span id="auth'+(i+1)+'" class=""></span></td>' +
                               '<td><span id="paid'+(i+1)+'" class=""></span></td>' +
                               '<td><span id="refund'+(i+1)+'" class=""></span></td>' +
                               '<td><input type="text" id="waitfname'+(i+1)+'" value="'+arrCols[($('#ccfname').val() - flag)].trim()+'" ></td>' +
                               '<td><input type="text" id="waitaddr'+(i+1)+'" value="'+arrCols[($('#ccaddr').val() - flag)].trim()+'" ></td>' +
                               '<td><input type="text" id="waitcity'+(i+1)+'" value="'+arrCols[($('#cccity').val() - flag)].trim()+'" ></td>' +
                               '<td><input type="text" id="waitstate'+(i+1)+'" value="'+arrCols[($('#ccstate').val() - flag)].trim()+'" ></td>' +
                        '<td><input type="text" id="waitzip'+(i+1)+'" value="'+arrCols[($('#cczip').val() - flag)].trim()+'"></td>' +
                        '<td><input type="text" id="waitcountry'+(i+1)+'" value="'+arrCols[($('#cccountry').val() - flag)].trim()+'" ></td>' +
                               '</tr>'
                    $("#tablecontent").append(html);
                }
                    count++;
                }
                catch(e){
                    $("#nofi").append("Lỗi ở hàng "+(i+1)+"<br>");
                }
            }
            $("#nofi").append("Lấy được "+count+"/"+arrLines.length).addClass("bg-danger");
        }

    }
</script>




