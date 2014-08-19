<div id="leftside">
<div class="blockmoniter border cornertopleft cornertopright"  id="blockpacsv">
	<div class="blocktitle  cornertopleft cornertopright"><?=$gw_name?> - <?=$gw_ip?></div>
	<div class="blockline">
	<div class="blockname"><?=$gw_ping?><img src="src/img/<?=$gw_ping?>.png" class="iconmodule"></div>
	<div class="blockcontent">
	<div class="blockstatus bstatus_on"  title="Module dang chay" id="<?=$this->config->item('gwpr')?>">-</div>
        <div class="blockitem"  id="<?=$this->config->item('gwps')?>">
            <p>Chua co du lieu</p>
        </div>
	</div><!-- end block content-->
	</div><!-- end blockline -->
	<div class="borderbot"></div>
	
	<div class="blockline">
	<div class="blockname"><?=$gw_dicom?><img src="src/img/<?=$gw_dicom?>.png" class="iconmodule"></div>
	<div class="blockcontent">
	<div class="blockstatus bstatus_on"  title="Module dang chay" id="<?=$this->config->item('gwdr')?>">-</div>
    <div class="blockitem">
	<div class="item">
		<div class="itemstatus processnook" id="<?=$this->config->item('gwdss')?>icon"></div>
		<div class="itemcontent cornertopleft cornerbottomright " id="<?=$this->config->item('gwdss')?>">Process Send Dicom</div>
	</div><!-- end item-->
	<div class="item">
		<div class="itemstatus processnook" id="<?=$this->config->item('gwdrs')?>icon"></div>
		<div class="itemcontent  cornertopleft cornerbottomright " id="<?=$this->config->item('gwdrs')?>">Process Recive Dicom</div>
	</div>
    </div>
	</div><!-- end block content-->
	</div><!-- end blockline -->
	<div class="borderbot"></div>
	<div class="blockline">
	<div class="blockname"><?=$gw_process?><img src="src/img/<?=$gw_process?>.png" class="iconmodule"></div>
	<div class="blockcontent">
	<div class="blockstatus bstatus_on"  title="Module dang chay" id="<?=$this->config->item('gwqtr')?>">-</div>
    <div class="blockitem">
	<div class="item">
		<div class="itemstatus processnook" id="<?=$this->config->item('gwqts')?>icon"></div>
		<div class="itemcontent cornertopleft cornerbottomright " id="<?=$this->config->item('gwqts')?>">Quy trinh gui/nhan Dicom</div>
	</div><!-- end item-->
    </div>
	</div><!-- end block content-->
	</div><!-- end blockline -->
	<div class="borderbot"></div>
	
	<div class="blockline">
	<div class="blockname"><?=$gw_disk?><img src="src/img/<?=$gw_disk?>.png" class="iconmodule"></div>
	<div class="blockcontent">
	<div class="blockstatus bstatus_on"  title="Module dang chay" id="<?=$this->config->item('gwchr')?>">-</div>
    <div class="blockitem">
	<div class="item">
		<div class="itemstatus foldernook" id="<?=$this->config->item('gwned')?>icon"></div>
		<div class="itemcontent cornertopleft cornerbottomright" id="<?=$this->config->item('gwned')?>">Thu muc loi</div>
	</div><!-- end item-->
	<div class="item">
		<div class="itemstatus foldernook" id="<?=$this->config->item('gwfp')?>icon"></div>
		<div class="itemcontent  cornertopleft cornerbottomright" id="<?=$this->config->item('gwfp')?>">DL trong: </div>
	</div>
    </div>
	</div><!-- end block content-->
	</div><!-- end blockline -->
	<div class="borderbot"></div>
</div>
<div class="blockmoniter border cornertopleft cornertopright ">
	<div class="blocktitle  cornertopleft cornertopright">Server - </div>
    <div id="testcontent"></div>
	
</div>
</div><!-- end leftside -->

<div id="rightside">

<div class="blockmoniter border cornertopleft cornertopright ">
	<div class="blocktitle  cornertopleft cornertopright"><?=$sv_name?> - <?=$sv_ip?></div>
	<div class="blockline">
	<div class="blockname"><?=$sv_ping?><img src="src/img/<?=$sv_ping?>.png" class="iconmodule"></div>
	<div class="blockcontent">
	<div class="blockstatus bstatus_on" title="Module dang chay" id="<?=$this->config->item('svpr')?>">-</div>
    <div class="blockitem" id="<?=$this->config->item('svps')?>">
	<p>Chua co du lieu</p>
    </div>
	</div><!-- end block content-->
	</div><!-- end blockline -->
	<div class="borderbot"></div>
	
	<div class="blockline">
	<div class="blockname"><?=$sv_dicom?><img src="src/img/<?=$sv_dicom?>.png" class="iconmodule"></div>
	<div class="blockcontent">
	<div class="blockstatus bstatus_on"  title="Module dang chay" id="<?=$this->config->item('svdr')?>">-</div>
    <div class="blockitem">
	<div class="item">
		<div class="itemstatus processnook"  id="<?=$this->config->item('svds')?>icon"></div>
		<div class="itemcontent  cornertopleft cornerbottomright"  id="<?=$this->config->item('svds')?>">Dicom server</div>
        <div class="icon24 iconplay" title="Start Dicom Server" id="butstart_svdcm" onclick="savecmd('start_sv_dcm','<?=$sv_ip?>')"></div> <div class="icon24 iconstop" title="Stop Dicom Server" id="butstop_svdcm" onclick="savecmd('stop_sv_dcm','<?=$sv_ip?>')"></div>
	</div>
    </div>
	</div><!-- end block content-->
	</div><!-- end blockline -->
	<div class="borderbot"></div>
	
	<div class="blockline">
	<div class="blockname"><?=$sv_disk?><img src="src/img/<?=$sv_disk?>.png" class="iconmodule"></div>
	<div class="blockcontent">
	<div class="blockstatus bstatus_on"  title="Module dang chay" id="<?=$this->config->item('svchr')?>">-</div>
    <div class="blockitem">
	<div class="item">
		<div class="itemstatus foldernook" id="<?=$this->config->item('svfp')?>icon"></div>
		<div class="itemcontent  cornertopleft cornerbottomright" id="<?=$this->config->item('svfp')?>">DL trong:</div>
	</div>
    </div>
	</div><!-- end block content-->
	</div><!-- end blockline -->
	<div class="borderbot"></div>
</div>
<div class="blockmoniter border cornertopleft cornertopright center">
	<div class="blocktitle  cornertopleft cornertopright">Bieu do thong ke PACS Server</div>
    <select id="chartopt" onblur="selectchart()" onchange="selectchart()"> 
        <option value="pie" selected="true">Do thi thong ke dung luong</option>
         <option value="bar">Do thi thong ke hoat dong</option>
    </select>
    <input type="button" value="Refesh" onclick="drawChart()">
    <div id="datepick"  style="display: none">
        From <input id="datefrom"> To <input from id="dateto">
    </div>
    
	<div id="chartcontent">
	<?=$chart?>
	</div>
</div>
</div> <!-- end right side -->
<script>
   function savecmd(cmd,sv){
       $.ajax({
           url:"<?=$this->config->item('base_url')?>main/savecmd",
           data:"cmd="+cmd+"&sv="+sv,
           type:"post",
           success:function(msg){
               alert(msg);
           }
       });
   }
    function selectchart(){
        var type = $("#chartopt").val();
        if(type == "bar") $("#datepick").show("slow");
        else $("#datepick").hide("slow");
    }
//$(function() {
//    $( "#datefrom" ).datepicker();
//    $( "#dateto" ).datepicker();
//});
function drawChart(){
    var type = $("#chartopt").val();
    var datestr ="datefrom=0&dateto=0";
    if(type == "bar"){
        datestr = "datefrom="+$("#datefrom").val()+"&dateto="+$("#dateto").val();
    }
    $.ajax({
        url:"<?=$this->config->item('base_url');?>main/drawchart",
        data: "type="+type+"&"+datestr,
        type:"post",
        success:function(msg){
            $("#chartcontent").html(msg);
        }
    });
}
function setRunningStatus(id,status,now){
    var dstatus = Date.parse(status);
     //now = Date.parse(now);
    var timeout = (Math.floor((now - dstatus)/(1000)))
    //alert(timeout);
    if(timeout>5 || isNaN(timeout)) status = 0;
    else status = 1;
    if(status==1){
        $("#"+id).html("Dang chay");
        $("#"+id).removeClass().addClass("blockstatus bstatus_on");
        $("#"+id).attr("title","Module dang chay");
    }
    else{
        $("#"+id).html("Khong chay");
        $("#"+id).removeClass().addClass("blockstatus bstatus_off");
        $("#"+id).attr("title","Module khong chay");
    }
}
function setProcessStatus(id,status){
    if(status=='1'){
                $("#"+id+"icon").removeClass().addClass("itemstatus processok");
                $("#"+id).removeClass().addClass("itemcontent  cornertopleft cornerbottomright bggreen");
            }
            else{
                $("#"+id+"icon").removeClass().addClass("itemstatus processnook");
                $("#"+id).removeClass().addClass("itemcontent  cornertopleft cornerbottomright bgred");
            }
}
function setPingStatus(id,pinglist,status){
    if(pinglist == "null"){
        $("#"+id).html("<p>Khong co du lieu.</p>");
    }
    else{
        var pingarr = pinglist.split(";");
        var spingarr = status.split(";");
        var str = "";
        for(var i=0;i<pingarr.length;i++){
            if(spingarr[i]=="1"){
                str+='<div class="item"><div class="itemstatus pingconnect"></div> <div class="itemcontent cornertopleft cornerbottomright bggreen">'+pingarr[i]+'</div></div>';
            }
            else{
                str+='<div class="item"><div class="itemstatus pingdisconnect"></div> <div class="itemcontent cornertopleft cornerbottomright bgred">'+pingarr[i]+'</div></div>';
            }
        }
        $("#"+id).html(str);
    }
}
dojob();
function dojob(){
    loadStatus();
    var t = setTimeout("dojob()",15000);
}
function loadStatus(){
     var t= new Date().getTime();

    $.ajax({
        url:"<?=$this->config->item('base_url')?>main/jloadStatus",
        type:"post",
        data:"t="+t,
        success:function(msg){
            var m = eval(msg);
            console.log(m);
//            var m = json_parse(msg);

            setRunningStatus("<?=$this->config->item('svpr')?>",m.status.<?=$this->config->item('svpr')?>.status,m.status.<?=$this->config->item('svpr')?>.crrtime);
            setRunningStatus("<?=$this->config->item('svdr')?>",m.status.<?=$this->config->item('svdr')?>.status,m.status.<?=$this->config->item('svdr')?>.crrtime);
            setRunningStatus("<?=$this->config->item('svchr')?>",m.status.<?=$this->config->item('svchr')?>.status,m.status.<?=$this->config->item('svchr')?>.crrtime);
            setRunningStatus("<?=$this->config->item('gwpr')?>",m.status.<?=$this->config->item('gwpr')?>.status,m.status.<?=$this->config->item('gwpr')?>.crrtime);
            setRunningStatus("<?=$this->config->item('gwdr')?>",m.status.<?=$this->config->item('gwdr')?>.status,m.status.<?=$this->config->item('gwdr')?>.crrtime);
            setRunningStatus("<?=$this->config->item('gwqtr')?>",m.status.<?=$this->config->item('gwqtr')?>.status,m.status.<?=$this->config->item('gwqtr')?>.crrtime);
            setRunningStatus("<?=$this->config->item('gwchr')?>",m.status.<?=$this->config->item('gwchr')?>.status,m.status.<?=$this->config->item('gwchr')?>.crrtime);
            
            setPingStatus("<?=$this->config->item('gwps')?>",m.status.<?=$this->config->item('gwps')?>.content,m.status.<?=$this->config->item('gwps')?>.status);
            setPingStatus("<?=$this->config->item('svps')?>",m.status.<?=$this->config->item('svps')?>.content,m.status.<?=$this->config->item('svps')?>.status);

           var svfreespace = m.status.<?=$this->config->item('svfp')?>.content;
           svfreespace = parseFloat(svfreespace)/1000000;
            $("#<?=$this->config->item('svfp')?>").html("DL trong: "+svfreespace.toFixed(3)+" GB");
            if(svfreespace>1){
                $("#<?=$this->config->item('svfp')?>icon").removeClass().addClass("itemstatus folderok");
                $("#<?=$this->config->item('svfp')?>").removeClass().addClass("itemcontent  cornertopleft cornerbottomright bggreen");
            }
            else{
                $("#<?=$this->config->item('svfp')?>icon").removeClass().addClass("itemstatus foldernook");
                $("#<?=$this->config->item('svfp')?>").removeClass().addClass("itemcontent  cornertopleft cornerbottomright bgred");
            }
            setProcessStatus("<?=$this->config->item('svds')?>",m.status.<?=$this->config->item('svds')?>.status);
            var svdrclass = $("#<?=$this->config->item('svdr')?>").attr("class");
            //alert(svdrclass);
            if(svdrclass == "blockstatus bstatus_off"){
                $("#butstart_svdcm").hide("slow");
                $("#butstop_svdcm").hide("slow");
            }
            else{

                if(m.status.<?=$this->config->item('svds')?>.status == 1){
                    //$("#butstart_svdcm").attr("disabled","disabled");
                    //$("#butstop_svdcm").removeAttr("disabled");
                    $("#butstart_svdcm").hide("slow");
                    $("#butstop_svdcm").show("slow");
                }
                else {
                    $("#butstop_svdcm").hide("slow");
                     $("#butstart_svdcm").show("slow");
                   // $("#butstop_svdcm").attr("disabled","disabled");
                   // $("#butstart_svdcm").removeAttr("disabled");
                }
            }
            
            setProcessStatus("<?=$this->config->item('gwqts')?>",m.status.<?=$this->config->item('gwqts')?>.status);
            setProcessStatus("<?=$this->config->item('gwdss')?>",m.status.<?=$this->config->item('gwdss')?>.status);
            setProcessStatus("<?=$this->config->item('gwdrs')?>",m.status.<?=$this->config->item('gwdrs')?>.status);

            var gwfreespace = m.status.<?=$this->config->item('gwfp')?>.content;
            if(gwfreespace != "0" && gwfreespace != "null")
                $("#<?=$this->config->item('gwfp')?>").html("DL trong: "+gwfreespace.toFixed(3)+" GB");
            if(svfreespace>1){
                $("#<?=$this->config->item('gwfp')?>icon").removeClass().addClass("itemstatus folderok");
                $("#<?=$this->config->item('gwfp')?>").removeClass().addClass("itemcontent  cornertopleft cornerbottomright bggreen");
            }
            else{
                $("#<?=$this->config->item('gwfp')?>icon").removeClass().addClass("itemstatus foldernook");
                $("#<?=$this->config->item('gwfp')?>").removeClass().addClass("itemcontent  cornertopleft cornerbottomright bgred");
            }
            var gwned = m.status.<?=$this->config->item('gwned')?>.status;
            if(gwned>1){
                $("#<?=$this->config->item('gwned')?>icon").removeClass().addClass("itemstatus foldernook");
                $("#<?=$this->config->item('gwned')?>").removeClass().addClass("itemcontent  cornertopleft cornerbottomright bgred");
            }
            else{
                $("#<?=$this->config->item('gwned')?>icon").removeClass().addClass("itemstatus folderok");
                $("#<?=$this->config->item('gwned')?>").removeClass().addClass("itemcontent  cornertopleft cornerbottomright bggreen");
            }
        }
    });
}
</script>
