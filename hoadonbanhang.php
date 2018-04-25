<?php
session_start();
?>
<?php
ob_start();
?>
<?php
    require("connect.php");
	require("doctien.php");
        if(isset($_GET['huy']) && $_GET['huy']==true)
        {
            $str21="delete from kho_ao2";
            mysql_query($str21);
        }
	$khachhang=$_SESSION['khachhang'];
	$str1="select ho_ten,dia_chi,so_dien_thoai,tong_tien,id_pn from phieu_giao_hang a, khach_hang c where c.id=a.id_kh and c.id='$khachhang'";
	$sql1=mysql_query($str1);
	$row=mysql_fetch_assoc($sql1);
	$ma_phieu=$row['id_pn'];
	$str2="select so_luong,ngay_dat,ten_hang,don_gia from chi_tiet_phieu_giao a,mat_hang b where a.ma_hang=b.ma_hang and ma_pg='$ma_phieu'";
	$sql2=mysql_query($str2);
        
        $strdd="select * from kiemke";
        $sqldd=mysql_query($strdd);
        //$row=mysql_num_rows($sql);
        $ro=mysql_fetch_assoc($sqldd);
        if($ro['kk']==0)
        {
            header("location:kiemke.php");
        }
    $ho_ten_kh=$_POST['kh_name'];
    $dia_chi_kh=$_POST['kh_diachi'];
    $sdt_kh=$_POST['kh_sdt'];
    $str19="select * from kho_ao2";
    $sql19=mysql_query($str19);
    $rogg=mysql_num_rows($sql19);
    $thongbao=2;
    $tongtien=0;
    $str32="select don_gia,so_luong from kho_ao2 a, mat_hang b where a.ma_vat_tu = b.ma_hang";
    $sql32=mysql_query($str32);
    while($row32=mysql_fetch_assoc($sql32))
    {
        $gia = $row32['don_gia'];
        $slg = $row32['so_luong'];
        $tong = $gia*$slg;
        $tongtien=$tongtien+$tong;
    }
    $id_hd="";
    if($ho_ten_kh !="" && $dia_chi_kh !="" && $sdt_kh != "")
    {
        if($rogg >= 1)
        {
            $str18="insert into hoa_don(ho_ten_kh,dia_chi_kh,sdt_kh,ngay_lap,tong_tien) values('$ho_ten_kh','$dia_chi_kh','$sdt_kh',now(),'$tongtien')";
            $sql18=mysql_query($str18);
            $id_hd = mysql_insert_id(); 
            if($sql18)
            {
                $str19="select * from kho_ao2";
                $sql19=mysql_query($str19);
                while($row19=mysql_fetch_assoc($sql19))
                {
                    $ma_vat_tu=$row19['ma_vat_tu'];
                    $so_luong=$row19['so_luong'];
                    $str20="update kho_tt so_luong = so_luong-'$so_luong' where ma_vat_tu = '$ma_vat_tu'";
                    mysql_query($str20);
                    $str22="insert into chi_tiet_hd(ma_hd,ma_hang,so_luong) values('$id_hd','$ma_vat_tu','$so_luong')";
                    mysql_query($str22);
                    
                }
                $str21="delete from kho_ao2";
                mysql_query($str21);
            }
            $thongbao=0;
            header("location:inhoadon.php?ma_hd=".$id_hd);
        }
        else
        {
            $thongbao=1;
        }
        
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css">
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
</head>
<body>
<form action="" method="post">
    
        <?php
            if($thongbao==1)
            {
                echo"<div style='border:1px solid red;color:red;'>Khong the lap hoa don ma khong co san pham !!</div>";
            }
            
        ?>
    
<div style="margin:10px auto;border:1px solid #000000;width:750px;">
<table width="749" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
	<td colspan="3" valign="top"><div><table border=0 cellpadding=0 cellspacing=0><tr><td style="border-bottom:1px dotted #000000;"><img src="images/logo.png" height=40></td><td style="border-bottom:1px dotted #000000;"><i>C&ocirc;ng Ty TNHH MTN </i></td></tr></table></div></td>
    <td colspan="2"></td>
    <td valign="top" align="right" style="border-bottom:1px dotted #000000;" colspan=2><i>Số Phiếu </i>: <?php echo $row['id_pn'];?><br/>
    <i>Ngày Lập </i>: <?php date_default_timezone_set('UTC');  echo date('d-m-Y')?> </td>
  </tr>
<tr height="40px">
	<td colspan="7"><div align="center" class="style1">HÓA ĐƠN BÁN HÀNG</div></td>
  </tr>
<tr style="height:30px;">
	<td colspan="3"><div align="right" style="font-family:sans-serif;font-size:14px;font-style:italic;">Họ Tên Khách Hàng : </div></td>
    <td colspan="4" style="padding-left:20px;"><input type="text" name="kh_name" style="border:1px solid #000000;width:200px;"></td>
  </tr>
<tr style="height:30px;">
  <td colspan="3"><div align="right" style="font-family:sans-serif;font-size:14px;font-style:italic;">Địa Chỉ Khách Hàng : </div></td>
  <td colspan="4" style="padding-left:20px;"><input type="text" name="kh_diachi" style="border:1px solid #000000;width:200px;"></td>
</tr>
<tr style="height:30px;">
  <td colspan="3"><div align="right" style="font-family:sans-serif;font-size:14px;font-style:italic;">Số điện thoại : </div></td>
  <td colspan="4" style="padding-left:20px;"><input type="text" name="kh_sdt" style="border:1px solid #000000;width:200px;"></td>
</tr>
<tr>
    <td width="30px" style="border-top:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>&nbsp;</strong></div></td>
  <td width="65px" style="border-top:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>Mã Hàng</strong></div></td>
  <td width="160px" style="border-top:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>Tên Hàng </strong></div></td>
    <td width="60px" style="border-top:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>ĐVT </strong></div></td>
  <td style="border-top:1px solid #000000;border-left:1px solid #000000;width:150px;"><div align="center"><strong>Đơn Giá </strong></div></td>
  <td width="100px" style="border-top:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>Số Lượng </strong></div></td>
  <td style="border-top:1px solid #000000;border-right:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>Thành Tiền</strong></div></td>
</tr>

<?php
/*
	$stt=0;
	while($rows=mysql_fetch_assoc($sql2))
	{
	$stt++;
	$thanh_tien1=$rows['don_gia']*$rows['so_luong'];
	$thanh_tien=$thanh_tien1+$thanh_tien1*0.1;
	  echo "<tr>
	  <td width='65' style='border-bottom:1px solid #000000;border-left:1px solid #000000;'><div align='center'>".$stt."</div></td>
	  <td width='146' style='border-bottom:1px solid #000000;border-left:1px solid #000000;'><div align='center'>".$rows['ten_hang']."</div></td>
	  <td width='131' style='border-bottom:1px solid #000000;border-left:1px solid #000000;'><div align='center'>".number_format($rows['don_gia'])."</div></td>
	  <td width='146' style='border-bottom:1px solid #000000;border-left:1px solid #000000;'><div align='center'>".$rows['so_luong']."</div></td>
	  <td style='border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;'><div align='right'><b>".number_format($thanh_tien,2)."</b> <span style='font-family:sans-serif;font-size:13px;'> VND</span></div></td>
	  </tr>";
	}
*/
?>
<!--
<tr>
  <td colspan="5"><div align="right">Tổng Tiền: <b><?php echo number_format($row['tong_tien'],2);?> </b>VND</div></td>
  </tr>
  <tr>
  <td colspan="5" align="right"><i style="color:red;">Tổng Tiền Bằng Chữ: <b><?php echo docso($row['tong_tien']);?></b></i></td>
  </tr>-->
  
</table>
<div style="text-align:center;">
    <iframe src="themhangvaohoadon.php" id="them_hang_kho" style="height:285px;width:749px;" frameborder=0></iframe>
</div>
</div>
<div style="margin:10px auto;width:750px;border-bottom:1px dotted #000000;"><table><tr><td>Cong Ty TNHH MTN<br>Dia Chi : 164, Duong Ly Tu Trong, Q.Ninh Kieu, TP.Can Tho.<br>Dien Thoai : 01646345235.<br>Fax : 0773077099.</td></tr></table></div>
<?php
	if(!$_GET['print'])
	{
		echo"<div style='text-align: center;'><table align='center'><tr><td><input type='submit' style='padding: 0px 15px 0px 15px;background:#4148a8;border:2px solid #161c71;color:#ffffff;text-decoration:none;margin-right:10px;' value='Lưu & In Hóa Đơn' ></td><td><a href='hoadonbanhang.php?huy=true' style='padding: 0px 15px 0px 15px;background:#4148a8;border:2px solid #161c71;color:#ffffff;text-decoration:none;margin-right:10px;'>Huy Phieu</a></td></tr></table></div>";
	}
	else
	{
		echo"<div style='text-align: center;'><table align='center'><tr><td><a href='javascript:window.print();' style='padding: 0px 15px 0px 15px;background:#4148a8;border:2px solid #161c71;color:#ffffff;text-decoration:none;margin-right:10px;'>Lưu & In Hóa Đơn</a></td></tr></table></div>";
	}
	
?>
</form>
</body>
</html>
