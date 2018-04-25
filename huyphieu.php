<?php
session_start();
?>
<?php
ob_start();
?>
<?php
require("connect.php");
$id_pg=$_GET['id_pg'];
$str="select * from phieu_giao_hang where id_pn='$id_pg'";
$sql=mysql_query($str);
$row=mysql_fetch_assoc($sql);
$id_kh=$row['id_kh'];
$str2="delete from khach_hang where id='$id_kh'";
$str3="delete from phieu_giao_hang where id_pn='$id_pg'";

$str5="select ma_hang, so_luong from chi_tiet_phieu_giao where ma_pg='$id_pg'";
$sql5=mysql_query($str5);
while($row5=mysql_fetch_assoc($sql5))
{
    $ma_hang=$row5['ma_hang'];
    $so_luong=$row5['so_luong'];
    $str6="update kho_tt set so_luong=so_luong+'$so_luong' where ma_hang='$ma_hang'";
    mysql_query($str6);
}
$str4="delete from chi_tiet_phieu_giao where ma_pg='$id_pg'";
mysql_query($str2);
mysql_query($str3);
mysql_query($str4);
header("location:quanlidondathang.php");
?>
<html>
    <head></head>
    <body></body>
</html>
<?php
ob_end_flush();
?>