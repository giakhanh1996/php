<?php
require("connect.php");
$ma_nv=$_GET['ma_nv'];
?>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
        </title>
    </head>
    <body style="margin:0;padding:0;background:#f4f2d3;">
        <?php
            if(isset($ma_nv) && $ma_nv!="rong")
            {
                $str1="select ten_nv from nhanvien where ma_nv='$ma_nv'";
                $sql1=mysql_query($str1);
                while($row1=mysql_fetch_assoc($sql1)){
                    echo "<i style='color:red;'><b>".$row1['ten_nv']."</b></i>";
                }
            }
            else
            {
                echo "<i style='color:red;'><b>Chon nhan vien</b></i>";
            }
        ?>
    </body>
</html>