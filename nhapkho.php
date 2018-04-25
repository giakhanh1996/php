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
    $so_phieu=strtoupper($_POST['so_phieu']);
    $ngay_nhap1=$_POST['ngay_nhap'];
    $listdate=explode("-",$ngay_nhap1);
    $ngay=$listdate[0];
    $thang=$listdate[1];
    $nam=$listdate[2];
    $ngay_nhap=$nam."-".$thang."-".$ngay;
    //echo $ngay_nhap;
    $nhan_vien=$_POST['nhan_vien'];
    $nha_cc=$_POST['nha_cc'];
    $khohang=$_POST['khohang'];
    $ghi_chu=$_POST['ghi_chu'];
    if(isset($so_phieu) && $so_phieu != ""  && isset($ngay_nhap) && $ngay_nhap != "" && isset($nhan_vien) && isset($nha_cc) && isset($khohang))
    {
        //echo"du dieu kien";
                            $tongtien=0;
                            $str32="select don_gia,so_luong from kho_ao a, mat_hang b where a.ma_vat_tu = b.ma_hang";
                            $sql32=mysql_query($str32);
                            while($row32=mysql_fetch_assoc($sql32))
                            {
                                $gia = $row32['don_gia'];
                                $slg = $row32['so_luong'];
                                $tong = $gia*$slg;
                                $tongtien=$tongtien+$tong;
                            }
        $str18="insert into phieu_nhap(ma_pn,ma_kho,ma_ncc,ma_nv,ngay_nhap,tong_tien,ghi_chu) values('$so_phieu','$khohang','$nha_cc','$nhan_vien','$ngay_nhap','$tongtien','$ghi_chu')";
        $sql18=mysql_query($str18);
        if($sql18)
        {
            $str19="select * from kho_ao";
            $sql19=mysql_query($str19);
            while($row19=mysql_fetch_assoc($sql19))
            {
                $ma_vat_tu=$row19['ma_vat_tu'];
                $so_luong=$row19['so_luong'];
                $str20="insert into kho_tt(ma_kho,ma_hang,so_luong) values('$khohang','$ma_vat_tu','$so_luong')";
                $sql20=mysql_query($str20);
                if($sql20)
                {
                    
                }
                else
                {
                    $str26="update kho_tt set so_luong = so_luong + '$so_luong' where ma_hang='$ma_vat_tu'";
                    mysql_query($str26);
                }
                $str22="insert into chi_tiet_phieu_nhap(ma_pn,ma_hang,so_luong) values('$so_phieu','$ma_vat_tu','$so_luong')";
                mysql_query($str22);
                
            }
            $str21="delete from kho_ao";
            mysql_query($str21);
        }
        
        
    }
    $str="select * from kiemke";
    $sql=mysql_query($str);
    //$row=mysql_num_rows($sql);
    $ro=mysql_fetch_assoc($sql);
    if($ro['kk']==0)
    {
        header("location:kiemke.php");
    }
?>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" language="javascript" src="script.js"></script>
    </head>
    <body style="margin:0;padding:0;" onLoad="setvitrihopthoai();">
        <div style="text-align:center;">
            <!--<div class="title-tab">Nhap Kho</div>-->
            <div style="height:10px;"></div>
            <div style="text-align:center;width:600px;margin:0 auto;">
                <div style="text-align:center;background:#e1c58a;font-family:sans-serif;font-size:20px;font-weight:bold;color:#482c07;">LẬP PHIẾU NHẬP</div>
		<form action="<?php echo $SCRIPT_NAME; ?>" method="POST" name="nhapkho" style="margin:0;padding:0;">
                    <div style="text-align:center;background:#f4f2d3;border:1px solid #e1c58a;width:600px;margin:0 auto;">
                        <table align="center" border=0>
                            <tr>
                                <td>Số phiếu :</td>
                                <td colspan=2><input type="text" name="so_phieu" id="so_phieu" style="width:200;" autocomplete="off" onKeyUp="ajaxFunction()" onBlur="hiddenn()">
								<div id="sophieu" style="background:#ffffff; width:200px; position:absolute;display:none;overflow:auto;"></div>
								</td>
								
                                <td>Ngày Nhập :</td>
                                <td><input type="text" name="ngay_nhap" value="<?php date_default_timezone_set('UTC');  echo date("d-m-Y"); ?>" style="text-align:right;width:100px;"></td>
                            </tr>
                            <tr>
                                <td>Nhân Viên Nhập Hàng</td>
                                
                                <td>
                                    <select name="nhan_vien" onChange="showdata('snv')" id="nhanvien">
                                        <option value="rong">--Nhan vien --</option>
                                        <?php
                                        $str15="select * from nhanvien";
                                        $sql15=mysql_query($str15);
                                        while($row15=mysql_fetch_assoc($sql15))
                                        {
                                            echo "<option value='".$row15['ma_nv']."'>".$row15['ma_nv']."</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <iframe src="show_combobox.php" id="snv" style="height:20px;width:150px;margin:0;padding:0;" frameborder=0></iframe>
                                </td>
                                <td></td>
                                <td></td>
                                
                                
                            </tr>
                            <tr>
                                <td>Nhà Cung Cấp :</td>
                                <td colspan=2><select style="width:200;" name="nha_cc">
                                    <?php
                                    $str16="select * from nha_cung_cap";
                                    $sql16=mysql_query($str16);
                                    while($row16=mysql_fetch_assoc($sql16))
                                    {
                                        echo "<option value='".$row16['ma_ncc']."'>".$row16['ten_ncc']."</option>";
                                    }
                                    ?>
                                </select></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Kho Hàng :</td>
                                <td colspan=2><select style="width:200;" name="khohang">
                                    <?php
                                    $str17="select * from kho_hang";
                                    $sql17=mysql_query($str17);
                                    while($row17=mysql_fetch_assoc($sql17))
                                    {
                                        echo "<option value='".$row17['ma_kho']."'>".$row17['ten_kho']."</option>";
                                    }
                                    ?>
                                </select></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr><td>Ghi Chu :</td><td colspan=4><input type="text" name="ghi_chu" style="width:430px;"></td></tr>
                            
                        </table>
                    
                    <div>
                        <iframe src="themhangvaokho.php" id="them_hang_kho" style="height:285px;width:590px;" frameborder=0></iframe>
                    </div>
                    </div>
                    <div>
                        <table width="100%">
                            <tr><td><a href="xemphieunhap.php" target="_blank" style='padding: 0px 15px 0px 15px;background:#4148a8;border:2px solid #161c71;color:#ffffff;text-decoration:none;margin-right:10px;'>In Phieu</a></td><td align="right"><input type="submit" onClick="return checkphieunhap();" value="Luu Phieu"><input type="button" value="Huy Phieu"></td></tr>
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