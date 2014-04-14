function isNum(args)
{
args = args.toString();

if (args.length == 0)
return false;

for (var i = 0;  i<args.length;  i++)
{
	if (args.substring(i,i+1) < "0" || args.substring(i, i+1) > "9")
		{
		return false;
		}
}

return true;

}


function isCorrectChar(num)
{
	ar1 = new Array('!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/','0','1','2','3','4','5','6','7','8','9',':',';','<','=','>','?','@',
	'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','[','\\',']','^','_','`','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','{','|','}','~');
	ar2 = new Array('33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48','49','50','51','52','53','54','55','56','57','58','59','60','61','62','63','64','65',
	'66','67','68','69','70','71','72','73','74','75','76','77','78','79','80','81','82','83','84','85','86','87','88','89','90','91','92','93','94','95','96','97','98','99','100','101','102',
	'103','104','105','106','107','108','109','110','111','112','113','114','115','116','117','118','119','120','121','122','123','124','125','126');

	for(var j=0; j<ar1.length; j++)
	{
		if(num == ar1[j])
		{
		return ar2[j];
		}
	}

	return "NULL";
}


function strToAscii(str)
{
var decstr = "";
var binstr = "";
var hexstr = "";
 	for(k=0; k<str.length; k++)
 	{
	 var chr = str.charAt(k);

 	 //Lines that get decimal value
	 chr =  isCorrectChar(chr)
         decstr = decstr+chr+", ";

	//lines that get binary value from decimal
	 var chr1 = deciToBin(chr);
	binstr = binstr+chr1+" ";

	//lines that get Hex value from decimal
	var chr2 = deciToHex(chr);
	hexstr = hexstr+chr2;

 	}
//
decstr="char("+decstr.substr(0,decstr.length-2)+")";
document.ascii.decv.value=decstr;
document.ascii.binv.value=binstr;
hexstr="0x"+hexstr;
document.ascii.hexv.value=hexstr;
}

function deciToBin(arg)
{
	res1 = 999;
	args = arg;
	while(args>1)
	{
		arg1 = parseInt(args/2);
		arg2 = args%2;
		args = arg1;
		//alert(arg1);
		//alert(arg2);

		if(res1 == 999)
		{
			res1=arg2.toString();
		}
		else
		{
				res1=arg2.toString()+res1.toString();
		}
	}
	if(args==1 && res1 != 999)
	{
		res1=args.toString()+res1.toString();
	}
	else if(args==0 && res1 == 999)
	{
		res1=0;
	}

	else if(res1 == 999)
	{
		res1=1;
	}
	var ll = res1.length;
	while(ll%4 != 0)
	{
		res1 = "0"+res1;
		ll = res1.length;
	}	

	return res1;
}


function deciToHex(arg)
{
	res2 = 999;
	args = arg;
	while(args>15)
	{
		arg1=parseInt(args/16);
		arg2=args%16;
		arg2=getHexNum(arg2);
		args=arg1;

		if(res2 == 999)
		{
			res2=arg2.toString();
		}
		else
		{
			res2=arg2.toString()+res2.toString();
		}

	}
	if(args<16 && res2 != 999)
	{
		def = getHexNum(args);
		//document.first.deciBin.value = def;
		res2=def+res2.toString();
	}
	 else if(res2 == 999)
	{
		if(args < 16)
		{
			res2= getHexNum(args);
		}
		else
		{
			res2= 1;
		}
	}

	return res2;
}


function getHexNum(num)
{
	ar1 = new Array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15');
	ar2 = new Array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
	if(num > 15)
	{
		return num;
	}
	else
	{
		red = ar2[num];
		return red;
	}
}

function change(name)
{
	var sd = name.value;
	var lastchar = "";
	if(sd.length > 1)
	{
	lastchar = sd.substring(sd.length-1,sd.length)
	}
	else
	{
	lastchar = sd;
	}

	var des = isCorrectChar(lastchar);
	if(des == "NULL")
	{
	sd = sd.substring(0,sd.length-1);
	document.ascii.strv.value=sd;
	}

	strToAscii(sd);
}


function color(test)
{

//var ch ="background-color: "+test+"; width: 60px; height: 25px;";
//alert(ch);
	for(var j=1; j<4; j++)
	{
		var myI=document.getElementsByTagName("input").item(j);
		//myI.setAttribute("style",ch);
		myI.style.backgroundColor=test;
	}

//myI.setAttribute("style","background-color: #F70808; width: 60px; height: 25px;");
}


function color1(test)
{
var myI=document.getElementsByTagName("table").item(0);
//myI.setAttribute("style",ch);
myI.style.backgroundColor=test;
}



