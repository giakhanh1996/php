<?php
session_start();
?>
<?php
ob_start();
?>
<?php
require("connect.php");
if(isset($_POST['admin']) && isset($_POST['passadmin']))
{
$admin=$_POST['admin'];
$passadmin=$_POST['passadmin'];

$str="update nhanvien set tai_khoan='$admin',mat_khau='$passadmin' where admin='admin'";
$sql=mysql_query($str);
if($sql)
{
//$row=mysql_fetch_assoc($sql);
header("location:phanquyen.php");
}
}
?>
<html>
<head>
<title>Thay Doi Mat Khau...</title>
<script type="text/javascript">
function checkpass(){
    var ad=document.ff.admin.value;
    var pass1=document.ff.passadmin.value;
    var pass2=document.ff.passadmin2.value;
    if(ad==""){ alert("Nhap Vao Ten Admin"); return false;}
    if(pass1 != pass2){ alert("Password khong trung nhau!");return false; }else{ if(pass1 == ""){ alert("Password khong duoc rong!");return false; } }
}
</script>
</head>
<body>
<div style="width: 250px; margin:10 auto;border: 1px solid blue;background: #b4ccf9;">
<form action="admin.php" method="post" style="margin: 0;padding: 0;" name="ff">
<table width="100%">
<tr style="background: blue;"><td colspan="2"><div><table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td style="width: 35px;"><img src="images/loginm.png" height="30px"></td><td style="color: #ffffff;font-weight: bold;">Admin</td></tr></table></div></td></tr>
<tr><td>Admin : </td><td><input type="text" name="admin" /></td></tr>
<tr><td>Password : </td><td><input type="password" name="passadmin" /></td></tr>
<tr><td>Re_Password : </td><td><input type="password" name="passadmin2" /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Cap Nhat" onclick="return checkpass();"/></td></tr>
</table>
</form>
</div>
</body>
</html>
<?php
ob_end_flush()
?>