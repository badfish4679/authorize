<font colo="yellow"><b>ഀ
>> Step 1: Put the link in format http://www.victim.com/file.cfm?id=ഀ
	>> Get tablesഀ
	>> Get columnsഀ
ഀ
>> Step 2: Generate linkഀ
	>> For single tableഀ
		>> Keep Table 2 be emptyഀ
		>> Put table name into Table 1ഀ
		>> Put key column (eg: orderid) into Column 1ഀ
		>> Put all columns into textarea (each column on one line)ഀ
	>> For double tablesഀ
		>> Do the same as for single tableഀ
		>> Put second table name into Table 2ഀ
		>> Put key column of second table (which has the same value as key column of first table)ഀ
		>> Put all columns of second table into correspond textareaഀ
ഀ
>> Step 3: Get latest orderഀ
	>> Copy generated link to Link >> Get latest. Then you get the last value of key column (eg: last orderid)ഀ
ഀ
>> Step 4: Query multiple orderഀ
	>> Copy the link with small change:ഀ
		Eg: http://www.victim.com/file.cfm?id=....from Orders A order by A.OrderID descഀ
		should be change to http://www.victim.com/file.cfm?id=....from Orders A where A.OrderID=ഀ
	>> Choose Last ID as the last id and quantity as the number of orders want to get.ഀ
ഀ
ഀ
Tiếng Việt:ഀ
Bước 1:ഀ
-Cho đường dẫn link bị lỗi vào theo dạng:http://www.victim.com/file.cfm?id=ഀ
-lấy table, columnഀ
Bước 2:ഀ
-nếu dữ liệu lưu cùng 1 table( thông tin cá nhân + CCV ...)ഀ
     ---Để trống tablèഀ
     ---thêm column chứa id vào table 1(orderid, customerid...)ഀ
     ---đặt tất cả column vào bên dướiഀ
-nếu dữ liệu lưu 2 table: làm tương tự với table2( id trong 2 table phải trùng khớp)ഀ
Bước 3:ഀ
-lấy link đã tạo chép vào --> get latest --> lấy giá trị thứ tự của order cuối cùngഀ
bước 4:ഀ
lấy nhiều giá trị:ഀ
chép link đã tạo vào, đổi từ:ഀ
http://www.victim.com/file.cfm?id=....from Orders A order by A.OrderID descഀ
thànhഀ
ഀ
http://www.victim.com/file.cfm?id=....from Orders A where A.OrderID=ഀ
nếu là 2 table thì thành:ഀ
 http://www.victim.com/file.cfm?id=....from Orders A where A.OrderID=B.Cusid and A.OrderID=ഀ
- nhập lastid vàoഀ
- nhập số lượngഀ
getഀ
ഀ
the endഀ
</b></font>