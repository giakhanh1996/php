<?php
session_start();
?>
<?php
ob_start();
?>
<?php
require("connect.php");
?>
<html>
    <head>
        <title></title>
    </head>
    <script type="text/javascript">
        function hien_hd(id_name){
            var get=document.getElementById(id_name);
            if(get.style.display=="none")
            {
                get.style.display="";
            }
            else
            {
                get.style.display="none";
            }
        }
    </script>
    <body>
        <div>
            <table border=0 cellpadding=0 cellspacing=0 width="100%">
                <tr>
                    <td valign="top" style="width:360px;"><div style="border:1px solid #000000;text-align:center;font-family:sans-serif;font-size:16px; font-weight:bold;">QUẦY THU</div>
                        <div>
                            <table>
                                <tr style="height:25px;"><td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;" colspan=2>Đã Lập Trong Thang [ <?php date_default_timezone_set('UTC'); echo date('m-Y'); ?> ] :
                                <b>
                                <?php
                                    date_default_timezone_set('UTC'); 
                                    $ngay_ht=date("Y-m-d");
                                    $ng=(date("Y-m"))."-1";
                                    $str40="select tong_tien from hoa_don where ngay_lap BETWEEN '$ng' and '$ngay_ht'";
                                    $sql40=mysql_query($str40);
                                    $row40=mysql_num_rows($sql40);
                                    echo $row40;
                                
                                ?></b>
                                Hóa đơn bán hàng.</td></tr>
                                <tr style="height:25px;"><td style="width:40px;border-bottom:1px dotted #000000;"><img src="images/arrow_right_green_48.png" height=25></td><td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;">
                                <?php
                                    date_default_timezone_set('UTC'); 
                                    $ngay_ht=date("Y-m-d");
                                    $ng=(date("Y-m"))."-1";
                                    $str40="select tong_tien from hoa_don where ngay_lap BETWEEN '$ng' and '$ngay_ht'";
                                    $sql40=mysql_query($str40);
                                    $tong_tien1=0;
                                    while($rr1=mysql_fetch_assoc($sql40))
                                    {
                                        $tong_tien1=$tong_tien1+$rr1['tong_tien'];
                                    }
                                    echo "Thu : <b>".$tong_tien1."</b>";
                                
                                ?> VND</td></tr>
				<tr style="height:25px;">
                                    <td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;" colspan=2>Đã Xuất Trong Thang [ <?php date_default_timezone_set('UTC'); echo date('m-Y'); ?> ] :
                                    <b>
                                    <?php
                                        date_default_timezone_set('UTC'); 
                                        $ngay_ht=date("Y-m-d");
                                        $ng=(date("Y-m"))."-1";
                                        $str40="select distinct a.id_pn, a.tong_tien from phieu_giao_hang a, chi_tiet_phieu_giao b where a.id_pn = b.ma_pg and ngay_dat BETWEEN '$ng' and '$ngay_ht'";
                                        $sql40=mysql_query($str40);
                                        
                                        $row40=mysql_num_rows($sql40);
                                        echo $row40;
                                    ?></b> - 
                                    Hóa đơn đặt hàng.
                                    </td>
                                </tr>
                                
                                <tr style="height:25px;"><td style="width:40px;border-bottom:1px dotted #000000;"><img src="images/arrow_right_green_48.png" height=25></td><td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;">
                                <?php
                                    date_default_timezone_set('UTC'); 
                                    $ngay_ht=date("Y-m-d");
                                    $ng=(date("Y-m"))."-1";
                                    $str40="select distinct a.id_pn, a.tong_tien from phieu_giao_hang a, chi_tiet_phieu_giao b where a.id_pn = b.ma_pg and a.trangthai=0 and ngay_dat BETWEEN '$ng' and '$ngay_ht'";
                                    $sql40=mysql_query($str40);
                                    $tong_tien2=0;
                                    while($rr1=mysql_fetch_assoc($sql40))
                                    {
                                        $tong_tien2=$tong_tien2+$rr1['tong_tien'];
                                    }
                                    $row40=mysql_num_rows($sql40);
                                    echo "Đã Giao : ".$row40." - ";
                                    echo "Thu : <b>".$tong_tien2."</b>";
                                
                                ?> VND</td></tr>
                                
				<tr style="height:25px;"><td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;" colspan=2>Tổng thu của tháng : <b><?php echo $tong_tien1+$tong_tien2; ?></b> VND</td></tr>
                            </table>
                        </div>
                    </td>
                    <td>&nbsp;</td>
                    <td valign="top" style="width:340px;font-family:sans-serif;font-size:16px; font-weight:bold;"><div style="border:1px solid #000000;text-align:center;">QUẦY CHI</div>
                        <div>
                            <table>
                                <tr style="height:25px;"><td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;">Đã Lập Trong Thang [ <?php date_default_timezone_set('UTC'); echo date('m-Y'); ?> ] :
                                <b>
                                <?php
                                    date_default_timezone_set('UTC'); 
                                    $ngay_ht=date("Y-m-d");
                                    $ng=(date("Y-m"))."-1";
                                    $str40="select ma_pn,tong_tien from phieu_nhap where ngay_nhap BETWEEN '$ng' and '$ngay_ht'";
                                    $sql40=mysql_query($str40);
                                    $row40=mysql_num_rows($sql40);
                                    $tong_tien=0;
                                    while($rr=mysql_fetch_assoc($sql40))
                                    {
                                        $tong_tien=$tong_tien+$rr['tong_tien'];
                                    }
                                    echo $row40;
                                ?></b> - 
                                Phiếu nhập.</td></tr>
				<tr style="height:25px;"><td style="font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;">Tổng chi của tháng [ <?php date_default_timezone_set('UTC'); echo date('m-Y'); ?> ] : <b><?php echo $tong_tien; ?></b> VND</td></tr>
                            </table>
                        </div>
                        <div style="margin-top:10px;width:330px;position:relative;" onclick="hien_hd('phieu_nhap');">
                            <table border=0 cellpadding=0 cellspacing=0>
                                <tr><td style="height:30px;border:1px solid #a93203;color:#a93203;background:#d7b9ad;font-family:sans-serif;font-size:14px;font-weight:bold;padding-left:20px;padding-right:20px;cursor:pointer;width:330px;">Xem Chi Tiet Cac Phieu Nhap</td></tr>
                            </table>
                            <div id="phieu_nhap" style="width:610px;border:1px solid #a93203;height:200px;overflow:auto;display:none;position:absolute;left:-282;">
                                <table width="580px" border=0 cellpadding=0 cellspacing=0>
                                    <?php
                                    //date_default_timezone_set('UTC'); 
                                    //$ngay_ht=date("Y-m-d");
                                    //$ng=(date("Y-m"))."-1";
                                    $str40="select * from phieu_nhap order by ngay_nhap desc";
                                    $sql40=mysql_query($str40);
                                    //$tong_tien1=0;
                                    $i=0;
                                    echo"<tr><td style='width:60px;text-align:center;border-bottom:1px solid #a93203;'>STT</td><td style='border-bottom:1px solid #a93203;text-align:center;width:200px;'>Ma Phieu</td><td style='width:130px;text-align:right;border-bottom:1px solid #a93203;'>Tong Tien PN</td></tr>";
                                    while($rr1=mysql_fetch_assoc($sql40))
                                    {
                                        $i++;
                                        echo"<tr style='height:25px;'><td style='font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;text-align:center;'>".$i."</td><td style='font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;'><a href='xemphieunhap.php?ma_pn=".$rr1['ma_pn']."' target='_blank'>Phieu Nhap So ".$rr1['ma_pn']." - ".$rr1['ngay_nhap']."</a></td><td style='font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;text-align:right;'>".$rr1['tong_tien']." VND</td></tr>";
                                    } 
                                    ?>
                                    
                                </table>
                                
                            </div>
                        </div>
                    </td>
                </tr>
                
            </table>
        </div>
        <div style="margin-top:10px;width:330px;" onclick="hien_hd('hoa_don');">
            <table border=0 cellpadding=0 cellspacing=0>
                <tr><td style="height:30px;border:1px solid #a93203;color:#a93203;background:#d7b9ad;font-family:sans-serif;font-size:14px;font-weight:bold;padding-left:20px;padding-right:20px;cursor:pointer;">Xem Chi Tiet Cac Hoa Don Ban Hang</td></tr>
            </table>
            
        </div>
        <div id="hoa_don" style="width:600px;border:1px solid #a93203;height:200px;overflow:auto;display:none;">
            <table width="600px" border=0 cellpadding=0 cellspacing=0>
                <?php
                //date_default_timezone_set('UTC'); 
                //$ngay_ht=date("Y-m-d");
                //$ng=(date("Y-m"))."-1";
                $str40="select * from hoa_don order by ngay_lap desc";
                $sql40=mysql_query($str40);
                //$tong_tien1=0;
                $i=0;
                echo"<tr><td style='width:60px;text-align:center;border-bottom:1px solid #a93203;'>STT</td><td style='border-bottom:1px solid #a93203;text-align:center;width:200px;'>Hoa Don</td><td style='border-bottom:1px solid #a93203;'>Ten KH</td><td style='width:130px;text-align:right;border-bottom:1px solid #a93203;'>Tong Tien HD</td></tr>";
                while($rr1=mysql_fetch_assoc($sql40))
                {
                    $i++;
                    echo"<tr style='height:25px;'><td style='font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;text-align:center;'>".$i."</td><td style='font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;'><a href='inhoadon.php?ma_hd=".$rr1['ma_hd']."&print=true' target='_blank'>Hoa Don So ".$rr1['ma_hd']." - ".$rr1['ngay_lap']."</a></td><td style='font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;'>".$rr1['ho_ten_kh']."</td><td style='font-family:sans-serif;font-size:13px;border-bottom:1px dotted #000000;text-align:right;'>".$rr1['tong_tien']." VND</td></tr>";
                } 
                ?>
                
            </table>
            
        </div>
    </body>
</html>
<?php
ob_end_flush();
?>