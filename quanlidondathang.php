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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
</head>
<script type="text/javascript" language="javascript" src="script.js"></script>
<body>
    <div style="margin-bottom:10px;">
        <table border=0 cellpadding=0 cellspacing=0 width="100%">
            <tr style="height:30px;"><td style="border:1px solid #000000;text-align:center;" colspan=3>THỐNG KÊ THEO THÁNG</td></td><td></td><td style="border:1px solid #000000;text-align:center;" colspan=3>THỐNG KÊ THEO NGÀY</td></tr>
        <tr style="height:30px;"><td><img src="images/arrow_right_green_48.png" height=30></td>
            <td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;width:350px;" colspan=2>Đơn Đặt Hàng Trong Tháng <?php date_default_timezone_set('UTC'); echo date('m-Y'); ?> :
            <b>
            <?php
		date_default_timezone_set('UTC'); 
                $ngay_ht=date("Y-m-d");
                $ng=(date("Y-m"))."-1";
                $str40="select distinct a.id_pn from phieu_giao_hang a, chi_tiet_phieu_giao b where a.id_pn = b.ma_pg and ngay_dat BETWEEN '$ng' and '$ngay_ht'";
                $sql40=mysql_query($str40);
                $row40=mysql_num_rows($sql40);
                echo $row40;
            ?></b> - Phiếu Đặt Hàng.
            </td><td></td><td style="width:40px;"><img src="images/arrow_right_green_48.png" height=30></td><td style="width:240px;font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;" colspan=2>Ngày Hôm Nay :
            <b>
            <?php
				date_default_timezone_set('UTC'); 
                $ngay_ht=date("Y-m-d");
                $str40="select distinct a.id_pn from phieu_giao_hang a, chi_tiet_phieu_giao b where a.id_pn = b.ma_pg and  ngay_dat ='$ngay_ht'";
                $sql40=mysql_query($str40);
                $row40=mysql_num_rows($sql40);
                echo $row40;
            ?></b> - Phiếu Đặt Hàng.
            </td>
        </tr>
        <tr style="height:30px;"><td></td><td style="width:40px;border-bottom:1px dotted #000000;"><img src="images/arrow_right_48.png" height=30></td>
            <td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;width:350px;">Phiếu đã giao :
            <b>
            <?php
				date_default_timezone_set('UTC'); 
                $ngay_ht=date("Y-m-d");
                $ng=(date("Y-m"))."-1";
                $str40="select distinct a.id_pn, a.trangthai from phieu_giao_hang a, chi_tiet_phieu_giao b where a.id_pn = b.ma_pg and ngay_dat BETWEEN '$ng' and '$ngay_ht' and a.trangthai=0";
                $sql40=mysql_query($str40);
                $row40=mysql_num_rows($sql40);
                echo $row40;
            ?>
            </b>
            </td><td></td><td></td><td style="width:40px;border-bottom:1px dotted #000000;"><img src="images/arrow_right_48.png" height=30></td><td style="width:240px;font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;">Phiếu đã giao :
            <b>
            <?php
				date_default_timezone_set('UTC'); 
                $ngay_ht=date("Y-m-d");
                $str40="select distinct a.id_pn from phieu_giao_hang a, chi_tiet_phieu_giao b where a.id_pn = b.ma_pg and  ngay_dat ='$ngay_ht' and a.trangthai=0";
                $sql40=mysql_query($str40);
                $row40=mysql_num_rows($sql40);
                echo $row40;
            ?>
            </b>
            </td>
        </tr>
        <tr style="height:30px;"><td></td><td style="border-bottom:1px dotted #000000;"><img src="images/arrow_right_48.png" height=30></td>
            <td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;width:350px;">Phiếu chưa giao :
            <b>
            <?php
				date_default_timezone_set('UTC'); 
                $ngay_ht=date("Y-m-d");
                $ng=(date("Y-m"))."-1";
                $str40="select distinct a.id_pn from phieu_giao_hang a, chi_tiet_phieu_giao b where a.id_pn = b.ma_pg and ngay_dat BETWEEN '$ng' and '$ngay_ht' and a.trangthai=1";
                $sql40=mysql_query($str40);
                $row40=mysql_num_rows($sql40);
                echo $row40;
            ?></b>
            </td><td></td><td></td><td style="width:40px;border-bottom:1px dotted #000000;"><img src="images/arrow_right_48.png" height=30></td><td style="width:240px;font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;">Phiếu chưa giao :
            <b>
            <?php
				date_default_timezone_set('UTC'); 
                $ngay_ht=date("Y-m-d");
                $str40="select distinct a.id_pn from phieu_giao_hang a, chi_tiet_phieu_giao b where a.id_pn = b.ma_pg and  ngay_dat ='$ngay_ht' and a.trangthai=1";
                $sql40=mysql_query($str40);
                $row40=mysql_num_rows($sql40);
                echo $row40;
            ?>
            </b>
            </td>
        </tr>
        <tr style="height:30px;"><td style="width:40px;"><img src="images/arrow_right_green_48.png" height=30></td>
            <td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;" colspan=2>Đơn Đặt Hàng Trong Tháng <?php echo "0".(date('m')-1)."-".date('Y'); ?> :
            <b>
            <?php
				date_default_timezone_set('UTC'); 
                $ngay_ht=date("Y")."-".(date("m-Y")-1)."-31";
                $ng=date("Y")."-".(date("m-Y")-1)."-1";
                $str40="select distinct a.id_pn from phieu_giao_hang a, chi_tiet_phieu_giao b where a.id_pn = b.ma_pg and ngay_dat BETWEEN '$ng' and '$ngay_ht'";
                $sql40=mysql_query($str40);
                $row40=mysql_num_rows($sql40);
                echo $row40;
            ?></b> - Phiếu Đặt Hàng.
            </td><td></td><td></td><td></td><td></td>
        </tr>
        </table>
        
    </div>
<div>
<table width="100%" border=0 cellpadding=0 cellspacing=0>
<?php
    $str="select distinct a.id_pn, b.ho_ten, c.ngay_dat, a.trangthai from phieu_giao_hang a, khach_hang b, chi_tiet_phieu_giao c where a.id_pn = c.ma_pg and a.id_kh=b.id order by ngay_dat desc";
    $sql=mysql_query($str);
    $i=0;
    echo"<tr style='font-weight:bold;'><td style='border-bottom:1px solid #000000;border-top:1px solid #000000;'>STT</td><td style='border-bottom:1px solid #000000;border-top:1px solid #000000;'>MÃ PHIẾU</td><td style='border-bottom:1px solid #000000;border-top:1px solid #000000;'>HỌ TÊN KH</td><td style='border-bottom:1px solid #000000;border-top:1px solid #000000;'>NGÀY ĐẶT</td><td style='border-bottom:1px solid #000000;border-top:1px solid #000000;'>TRẠNG THÁI PHIẾU</td><td style='border-bottom:1px solid #000000;border-top:1px solid #000000;'>HỦY</td></tr>";
    while($row=mysql_fetch_assoc($sql))
    {
        $i++;
        if($row['trangthai']==1)
        {
            $gh="<span style='color:red'><b>[</b> Chưa Giao Hàng <b>]</b></span>";
            $sp="<a href='hienthiphieudathang.php?id_pg=".$row['id_pn']."' style='font-family:sans-serif;font-size:13px;'>Số Phiếu ".$row['id_pn']."</a>";
			$link="<a href='huyphieu.php?id_pg=".$row['id_pn']."'><img src='images/Delete.png' border=0 height=20></a>";
        }
        else
        {
            $gh="<b>[</b> Đã giao hàng <b>]</b>";
            $sp="So Phieu ".$row['id_pn'];
			$link="<img src='images/Delete2.png' border=0 height=20>";
        }
        echo"<tr style='height:30px;' id='hang".$i."' onmouseover=\"doi_mau_hang('hang".$i."','#fd9104');\" onmouseout=\"huy_mau_hang('hang".$i."');\"><td style='border-bottom:1px dotted #000000;'>".$i."</td><td style='border-bottom:1px dotted #000000;'>".$sp."</td><td style='border-bottom:1px dotted #000000;'>".ucwords($row['ho_ten'])."</td><td style='border-bottom:1px dotted #000000;'>".$row['ngay_dat']."</td><td style='border-bottom:1px dotted #000000;'>".$gh."</td><td style='border-bottom:1px dotted #000000;'>".$link."</td></tr>";
    }
?>
</table>
</div>
</body>
</html>