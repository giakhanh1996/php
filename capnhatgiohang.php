<?php
session_start();
?>
<?php
ob_start();
?>
<?php
require("connect.php");
$ma=$_POST['ma'];
$sl=$_POST['so_luong'];
for($i=0;$i<count($ma);$i++)
{
    //echo $ma[$i]."-".$sl[$i];
    $ma_hang=$ma[$i];
    $s_l="so_luong".$ma[$i];
    $st12="select * from kho_tt where ma_hang='$ma_hang'";
    $sq12=mysql_query($st12);
    $ro12=mysql_fetch_assoc($sq12);
    if($sl[$i] > $ro12['so_luong'])
    {
        $so_luong_hang="khongdu";
        unset($_SESSION[$s_l]);
        $_SESSION[$s_l]=$ro12['so_luong'];
        //$mht=$_SESSION[$s_l];
    }
    else
    {
        unset($_SESSION[$s_l]);
        $_SESSION[$s_l]=$sl[$i];
    }
}


?>
<html>
<head></head>
<body>

<?php
if($so_luong_hang=="khongdu"){
    echo"<script type='text/javascript'>alert('So luong hang khong du, mat hang nay trong kho so luong con lai la');</script>";
}
header("location:giohang.php");
?>
</body>
</html>
<?php
ob_end_flush();
?>