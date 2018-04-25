<?php
session_start();
?>
<?php
ob_start();
?>
<?php
require("doctien.php");
?>
<?php
    if(!isset($_SESSION['manager_user']) && !isset($_SESSION['admin'])){
        header("location:login.php");
    }
    require("connect.php");
    $so_phieu=$_POST['so_phieu'];
    $ngay_nhap=$_POST['ngay_nhap'];
    $nhan_vien=$_POST['nhan_vien'];
    $nha_cc=$_POST['nha_cc'];
    $khohang=$_POST['khohang'];
    $ghi_chu=$_POST['ghi_chu'];
    $ma_pn=$_GET['ma_pn'];
    
?>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" language="javascript" src="script.js"></script>
    </head>
    <body style="margin:0;padding:0;">
        <div style="text-align:center;">
            <!--<div class="title-tab">Nhap Kho</div>-->
            <div style="height:10px;"></div>
            <div style="text-align:center;width:630px;margin:0 auto;">
                <div style="text-align:center;background:#e1c58a;font-family:sans-serif;font-size:20px;font-weight:bold;color:#482c07;">PHIẾU NHẬP</div>
		<form action="print_document.php" method="POST" name="nhapkho" style="margin:0;padding:0;">
                    <div style="text-align:center;background:#f4f2d3;border:1px solid #e1c58a;width:628px;margin:0 auto;">
                        <table align="center" border=0>
                            <tr>
                                <td>Số phiếu :</td>
                                <td colspan=2>
                                <select name="so_phieu" style="width:200;" onchange="tim_phieu_nhap();">
                                <?php
                                    $str23="select * from phieu_nhap";
                                    $sql23=mysql_query($str23);
                                    echo"<option value='null'>--chon phieu--</option>";
                                    while($row23=mysql_fetch_assoc($sql23))
                                    {
                                        
                                        if($row23['ma_pn']==$ma_pn)
                                        {
                                            echo"<option selected=true value='".$row23['ma_pn']."'>".$row23['ma_pn']."</option>";
                                        }
                                        else
                                        {
                                            
                                            echo"<option value='".$row23['ma_pn']."'>".$row23['ma_pn']."</option>";
                                        }
                                        
                                    }
                                ?>
                                </select>
                                </td>
                                <td>Ngày Nhập :</td>
                                <td><input type="text" name="ngay_nhap" value="<?php 
                                    $str23="select * from phieu_nhap where ma_pn='$ma_pn'";
                                    $sql23=mysql_query($str23);
                                    while($row23=mysql_fetch_assoc($sql23))
                                    {
                                        echo $row23['ngay_nhap'];
                                    }
                                 ?>" style="text-align:right;width:100px;"></td>
                            </tr>
                            <tr>
                                <td>Nhân Viên Nhập Hàng</td>
                                
                                
                                    
                                        
                                        <?php
                                        if(!isset($ma_pn))
                                        {
                                            echo"<td><input type='text' name='ma_nv' style='width:70px;'></td><td><input type='text' name='ten_nv' style='width:150px;'></td>";
                                        }
                                        else
                                        {
                                            $str15="select * from nhanvien a, phieu_nhap b where b.ma_nv=a.ma_nv and b.ma_pn='$ma_pn'";
                                            $sql15=mysql_query($str15);
                                            while($row15=mysql_fetch_assoc($sql15))
                                            {
                                                echo "<td><input type='text' value='".$row15['ma_nv']."' style='width:70px;'></td><td><input type='text' value='".$row15['ten_nv']."' style='width:150px;'></td>";
                                            }
                                        }
                                        ?>
                                    
                                
                                
                                <td></td>
                                <td></td>
                                
                                
                            </tr>
                            <tr>
                                <td>Nhà Cung Cấp :</td>
                                    <?php
                                        if(!isset($ma_pn))
                                        {
                                            echo"<td colspan=2><input type='text' name='ma_ncc'></td>";
                                        }
                                        else
                                        {
                                        $str16="select * from nha_cung_cap a, phieu_nhap b where b.ma_ncc=a.ma_ncc and b.ma_pn='$ma_pn'";
                                        $sql16=mysql_query($str16);
                                        while($row16=mysql_fetch_assoc($sql16))
                                        {
                                            echo "<td colspan=2><input type='text' value='".$row16['ten_ncc']."'></td>";
                                        }
                                        }
                                    ?> 
                               
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Kho Hàng :</td>
                                    <?php
                                        if(!isset($ma_pn))
                                        {
                                            echo"<td colspan=2><input type='text' name='ma_kho'></td>";
                                        }
                                        else
                                        {
                                            $str17="select * from kho_hang a, phieu_nhap b where b.ma_kho=a.ma_kho and b.ma_pn='$ma_pn'";
                                            $sql17=mysql_query($str17);
                                            while($row17=mysql_fetch_assoc($sql17))
                                            {
                                                echo "<td colspan=2><input type='text' value='".$row17['ten_kho']."'></td>";
                                            }
                                        }
                                    ?>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr><td>Ghi Chu :</td><td colspan=4><input type="text" name="ghi_chu" style="width:430px;"></td></tr>
                            
                        </table>
                    
                    <div  style="border: 1px solid #000000;">
                        <table width="100%" border=0 cellpadding=0 cellspacing=0>
                        <tr style="background:#d0cfcf;"><td class="border-td" style="width:60px;font-family:sans-serif;font-size:12px;font-weight:bold;border-right:1px solid #000000;border-bottom: 1px solid #000000;">Ma vat tu</td><td class="border-td" style="font-family:sans-serif;font-size:12px;font-weight:bold;border-right:1px solid #000000;border-bottom: 1px solid #000000;">Ten Vat tu</td><td class="border-td" style="font-family:sans-serif;font-size:12px;font-weight:bold;border-right:1px solid #000000;border-bottom: 1px solid #000000;">don vi tinh</td><td class="border-td" style="font-family:sans-serif;font-size:12px;font-weight:bold;text-align:center;border-bottom: 1px solid #000000;">So Luong</td></tr>
                        <?php
                            $str2="select a.ma_hang,b.ten_hang,a.so_luong,b.don_vi_tinh from chi_tiet_phieu_nhap a,mat_hang b where a.ma_hang = b.ma_hang and a.ma_pn ='$ma_pn' order by ma_hang asc";
                            $sql2=mysql_query($str2);
                            while($row2=mysql_fetch_assoc($sql2))
                            {
                                echo "<tr><td class='border-td-2' style='text-align:center;border-right:1px solid #acabab;border-bottom: 1px solid #acabab;'>".$row2['ma_hang']."</td><td class='border-td-2' style='border-right:1px solid #acabab;border-bottom: 1px solid #acabab;'>".$row2['ten_hang']."</td><td class='border-td-2' style='border-right:1px solid #acabab;border-bottom: 1px solid #acabab;'>".$row2['don_vi_tinh']."</td><td class='border-td-2' style='text-align:right;color:red;font-weight:bold;border-bottom: 1px solid #acabab;'>".$row2['so_luong']."</td></tr>";
                            }
                        ?>
                        <tr><td class="border-td-2" style="border-right:1px solid #acabab;">.</td><td class="border-td-2" style="border-right:1px solid #acabab;">.</td><td class="border-td-2" style="border-right:1px solid #acabab;">. </td><td class="border-td-2">.</td></tr>
                        <?php
                         $str26="select * from phieu_nhap where ma_pn='$ma_pn'";
                                        $sql26=mysql_query($str26);
                                        $row26=mysql_fetch_assoc($sql26);
                                        $tongtien = $row26['tong_tien'];
                        ?>
                        <tr><td align="right" style="border-top:1px solid #acabab;" colspan="4">Tổng Giá Trị Phiếu Nhập :<?php echo number_format($tongtien,2); ?> VND</td></tr>
                        <tr><td align="right" style="border-top:1px solid #acabab;" colspan="4">Viết Bằng Chữ : <?php echo docso($tongtien); ?> đồng</td></tr>
                        </table>
                    </div>
                    </div>
                    <div>
                        <table width="100%">
                            <tr><td><input type="submit" value="In Phieu" onclick="return check_print();"></td></tr>
                        </table>
                    </div>
		</form>
                
	    </div>
        </div>
        
    </body>
</html>
<?php
    ob_end_flush();
?>