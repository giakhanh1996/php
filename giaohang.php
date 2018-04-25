<?php
session_start();
?>
<?php
ob_start();
?>
<?php
require("connect.php");
$id_pg=$_GET['id_pg'];
$str="update phieu_giao_hang set trangthai=0 where id_pn='$id_pg'";
$sql=mysql_query($str);
if($sql)
{
    header("location: quanlidondathang.php");
}
?>
<?php
ob_end_flush();
?>