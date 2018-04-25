<?php
ob_start();
?>
<?php
require("connect.php");
$ma_nhom=$_POST['manhom'];
$ten_nhom=$_POST['tennhom'];
$str="insert into ten_nhom_quyen(ma_nhom,ten_nhom)values('$ma_nhom','$ten_nhom')";
if($ma_nhom!=""&&$ten_nhom!="")
{
    $sql=mysql_query($str);
    header("location:phanquyen.php?tao_quyen=true");
}
?>
<html>
<head>
<title></title>
<script type="text/javascript">
function kiem_tra()
{
    var ma=document.getElementById("manhom").value;
    var ten=document.getElementById("tennhom").value;
    if(ma==""||ten=="")
    {
        alert("khong duoc bo rong");
        return false;
    }
    else
    {
        return true;
    }
} 
</script>
</head>
<body>
<form action="taonhom.php" method="POST">
<table>
<tr><td colspan="2" style="background: #8080FF; font-weight: bold; font-size: 18px;" align="center">Tao Nhom Moi</td></tr>
<tr><td>Ma Nhom :</td><td><input type="text" name="manhom" id="manhom"/></td></tr>
<tr><td>Ten Nhom :</td><td><input type="text" name="tennhom" id="tennhom"/></td></tr>
<tr><td colspan="2"><input type="submit" value="Tao Nhom" onclick="return kiem_tra();"/></td></tr>
</table>
</form>
<a href="phanquyen.php?tao_quyen=true">Tro ve</a>
</body>
</html>
<?php
ob_end_flush();
?>