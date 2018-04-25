<?php
session_start();
?>
<?php
ob_start();
?>
<?php
    if(!isset($_SESSION['manager_user']) && !isset($_SESSION['admin'])){
        header("location:login.php");
    }
    require("connect.php");
?>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" language="javascript" src="script.js"></script>
    </head>
    <body style="margin:0;padding:0;text-align:center;">
        <div class="title-tab">
            Thống Kê Kho Hàng
        </div>
        <div>
		<div>
		    <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td style="font-family:sans-serif;font-size:13px;width:300px;" valign="top"><span style="border-bottom:1px dotted #000000;">Tổng Số Mặt Hàng Trong Kho : 
		    <b>
		    <?php
			$str1="select * from kho_tt";
                        $sql1=mysql_query($str1);
			$row=mysql_num_rows($sql1);
			echo $row;
		    ?></b> Mặt Hàng.</span>
		    </td><td>&nbsp;</td><td style="font-family:sans-serif;font-size:13px;width:250px;" valign="top">Tổng Mặt Hàng Tồn Kho :
		    <?php
			date_default_timezone_set('UTC'); 
                        $date2=date("Y-m-d");
			$str2="select a.so_luong, b.ten_hang, b.han_su_dung from kho_tt a, mat_hang b where a.ma_hang = b.ma_hang and han_su_dung < '$date2'";
                        $sql2=mysql_query($str2);
			$row=mysql_num_rows($sql2);
			echo "<b>".$row."</b> Mặt Hàng.";
			echo"<div style='border:1px solid #000000;height:100px;overflow-y:scroll;'>";
			echo"<table border=0 cellpadding=0 cellspacing=0 width='100%'>";
                        echo"<tr style='height:25px;font-weight:bold;font-family:sans-serif;font-size:13px;background:#e27103;'><td style='border-bottom:1px solid #000000;'>Tên Hàng</td><td style='border-bottom:1px solid #000000;'>Số Lượng</td></tr>";
			while($row1=mysql_fetch_assoc($sql2))
                        {
                            echo"<tr><td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'>".$row1['ten_hang']."</td><td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'>".$row1['so_luong']."</td></tr>";
			}
			echo"</table>";
			echo"</div>";
		    ?>
		    </td><td style="width:20px;">&nbsp;</td>
                    <td style="font-family:sans-serif;font-size:13px;width:250px;" valign="top">Hàng Đã Hết Số Lượng :
		    <?php
			date_default_timezone_set('UTC'); 
                        $date2=date("Y-m-d");
			$str2="select a.so_luong, b.ten_hang, b.han_su_dung from kho_tt a, mat_hang b where a.ma_hang = b.ma_hang and a.so_luong <= 0";
                        $sql2=mysql_query($str2);
			$row=mysql_num_rows($sql2);
			echo "<b>".$row."</b> Mặt Hàng.";
			echo"<div style='border:1px solid #000000;height:100px;overflow-y:scroll;'>";
			echo"<table border=0 cellpadding=0 cellspacing=0 width='100%'>";
                        echo"<tr style='height:25px;font-weight:bold;font-family:sans-serif;font-size:13px;background:#e27103;'><td style='border-bottom:1px solid #000000;'>Tên Hàng</td><td style='border-bottom:1px solid #000000;'>Số Lượng</td></tr>";
			while($row1=mysql_fetch_assoc($sql2))
                        {
                            echo"<tr><td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'>".$row1['ten_hang']."</td><td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'>".$row1['so_luong']."</td></tr>";
			}
			echo"</table>";
			echo"</div>";
		    ?>
		    </td>
                    </tr></table>
		</div>
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <?php
                $str1="select * from kho_hang";
                $sql1=mysql_query($str1);
                while($row1=mysql_fetch_assoc($sql1))
                {
                    $ma_kho=$row1['ma_kho'];
                    $str2="select a.so_luong, b.ten_hang, b.han_su_dung from kho_tt a, mat_hang b where a.ma_hang = b.ma_hang and a.ma_kho='$ma_kho'";
                    $sql2=mysql_query($str2);
                    
                    echo"<tr><td style='background:#380303;border:3px solid #150101;color:#ffffff;font-family:sans-serif;font-weight:bold;padding-left:20px;'>".ucwords($row1['ten_kho'])."</td></tr>";
                    echo"<tr><td><div><table border=0 cellspacing=0 cellpadding=0 width='100%'>";
                    echo"<tr style='font-weight:bold;'><td align='center' style='border-bottom:1px solid #000000;'>STT</td><td style='border-bottom:1px solid #000000;'>TEN HANG</td><td style='border-bottom:1px solid #000000;'>SO LUONG</td><td style='border-bottom:1px solid #000000;'>HAN SU DUNG</td></tr>";
                    $i=0;
                    while($row2=mysql_fetch_assoc($sql2))
                    {
                        $i=$i+1;
                        if($row2['so_luong'] <= 0)
                        {
                            $sl="<span style='color:red;font-family:sans-serif;font-size:13px;'><b>[</b> Hết Hàng <b>]</b></span>";
                        }
                        else
                        {
                            $sl=$row2['so_luong'];
                        }
						date_default_timezone_set('UTC'); 
                        $date=date("Y-m-d");
                        if($row2['han_su_dung'] < $date)
                        {
                            $hsd="<span style='color:red;font-family:sans-serif;font-size:13px;'><b>[</b> Hết hạn sử dụng <b>]</b></span>";
                        }
                        else
                        {
                            $hsd=$row2['han_su_dung'];
                        }
                        echo"<tr style='height:30px;' id='hang".$i."' onmouseover=\"doi_mau_hang('hang".$i."','#fd9104');\" onmouseout=\"huy_mau_hang('hang".$i."');\"><td align='center' style='border-bottom:1px dotted #000000;'>".$i."</td><td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;font-weight:bold;'>".$row2['ten_hang']."</td><td style='border-bottom:1px dotted #000000;'>".$sl."</td><td style='border-bottom:1px dotted #000000;'>".$hsd."</td></tr>";
                    }
                    echo"</table></div></td></tr>";
                }
            ?>
            </table>
        </div>
    </body>
</html>
<?php
    ob_end_flush();
?>