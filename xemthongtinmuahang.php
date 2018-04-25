<?php
session_start();
?>
<?php
ob_start();
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
<?php
    require("connect.php");
	require("doctien.php");
	$khachhang=$_SESSION['khachhang'];
	$str1="select ho_ten,dia_chi,so_dien_thoai,tong_tien,id_pn from phieu_giao_hang a, khach_hang c where c.id=a.id_kh and c.id='$khachhang'";
	$sql1=mysql_query($str1);
	$row=mysql_fetch_assoc($sql1);
	$ma_phieu=$row['id_pn'];
	$str2="select so_luong,ngay_dat,ten_hang,don_gia from chi_tiet_phieu_giao a,mat_hang b where a.ma_hang=b.ma_hang and ma_pg='$ma_phieu'";
	$sql2=mysql_query($str2);	
?>
<body>
<div style="width: 1000px; margin: 0 auto;">
        <div class="banner-index"></div>
        <div class="ds"><table border=0 cellpadding=0 cellspacing=0><tr><td style="width:20px;"></td><td align="center" style="height:35px;color:#490207;font-family:sans-serif;font-weight:bold;background-image:url(images/bcg2.png);background-repeat:repeat-x;width:100px;"><a href="index.php" style="text-decoration:none;color:#6f0702;">Trang chu</a></td><td></td></tr></table></div>
</div>
<div style="margin:10px auto;border:1px solid #000000;width:750px;">
<table width="749" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
	<td colspan="2" valign="top"><div><table border=0 cellpadding=0 cellspacing=0><tr><td style="border-bottom:1px dotted #000000;"><img src="images/logo.png" height=40></td><td style="border-bottom:1px dotted #000000;"><i>C&ocirc;ng Ty TNHH MTN </i></td></tr></table></div></td>
    <td colspan="2"></td>
    <td width="227" valign="top" align="right" style="border-bottom:1px dotted #000000;"><i>S&#7889; Phi&#7871;u </i>: <?php echo $row['id_pn'];?><br/>
    <i>Ng&agrave;y &#272;&#7863;t </i>: <?php date_default_timezone_set('UTC');  echo date('d-m-Y')?> </td>
  </tr>
<tr height="40px">
	<td colspan="5"><div align="center" class="style1">PHI&#7870;U &#272;&#7862;T H&Agrave;NG	</div></td>
  </tr>
<tr style="height:30px;">
	<td colspan="2"><div align="right" style="font-family:sans-serif;font-size:14px;font-style:italic;">H&#7885; T&ecirc;n Kh&aacute;ch H&agrave;ng : </div></td>
    <td colspan="3" style="padding-left:20px;"><b> <?php echo ucwords($row['ho_ten']);?></b></td>
  </tr>
<tr style="height:30px;">
  <td colspan="2"><div align="right" style="font-family:sans-serif;font-size:14px;font-style:italic;">&#272;&#7883;a Ch&#7881; Kh&aacute;ch H&agrave;ng : </div></td>
  <td colspan="3" style="padding-left:20px;"><b> <?php echo ucwords($row['dia_chi']);?></b></td>
</tr>
<tr style="height:30px;">
  <td colspan="2"><div align="right" style="font-family:sans-serif;font-size:14px;font-style:italic;">S&#7889; &#272;i&#7879;n Tho&#7841;i Kh&aacute;ch H&agrave;ng : </div></td>
  <td colspan="3" style="padding-left:20px;"><b> <?php echo $row['so_dien_thoai'];?></b></td>
</tr>
<tr>
  <td width="65" style="border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>STT</strong></div></td>
  <td width="146" style="border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>T&ecirc;n H&agrave;ng </strong></div></td>
  <td width="131" style="border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>&#272;&#417;n Gi&aacute; </strong></div></td>
  <td width="146" style="border-bottom:1px solid #000000;border-top:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>S&#7889; L&#432;&#7907;ng </strong></div></td>
  <td style="border-bottom:1px solid #000000;border-top:1px solid #000000;border-right:1px solid #000000;border-left:1px solid #000000;"><div align="center"><strong>Th&agrave;nh Ti&#7873;n </strong></div></td>
</tr>
<?php
	$stt=0;
	while($rows=mysql_fetch_assoc($sql2))
	{
	$stt++;
	$thanh_tien1=$rows['don_gia']*$rows['so_luong'];
	$thanh_tien=$thanh_tien1+$thanh_tien1*0.1;
	  echo "<tr>
	  <td width='65' style='border-bottom:1px solid #000000;border-left:1px solid #000000;'><div align='center'>".$stt."</div></td>
	  <td width='146' style='border-bottom:1px solid #000000;border-left:1px solid #000000;'><div align='center'>".$rows['ten_hang']."</div></td>
	  <td width='131' style='border-bottom:1px solid #000000;border-left:1px solid #000000;'><div align='center'>".number_format(($rows['don_gia']+($rows['don_gia']*0.1)),0)."</div></td>
	  <td width='146' style='border-bottom:1px solid #000000;border-left:1px solid #000000;'><div align='center'>".$rows['so_luong']."</div></td>
	  <td style='border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;'><div align='right'><b>".number_format($thanh_tien,2)."</b> <span style='font-family:sans-serif;font-size:13px;'> VND</span></div></td>
	  </tr>";
	}
?>
<tr>
  <td colspan="5"><div align="right">Tổng Tiền: <b><?php echo number_format($row['tong_tien'],2);?> </b>VND</div></td>
  </tr>
  <tr>
  <td colspan="5" align="right"><i style="color:red;">Tổng Tiền Bằng Chữ: <b><?php echo docso($row['tong_tien']);?> đồng</b></i></td>
  </tr>
  
</table>
</div>
<div style="margin:10px auto;width:750px;border-bottom:1px dotted #000000;"><table><tr><td>Công Ty TNHH MTN<br/>Địa Chỉ : 164, Đường Lý Tự Trọng, Q.Ninh Kiều, TP.Cần Thơ.<br/>Điện Thoại : 01646345235.<br/>Fax : 0773077099.</td></tr></table></div>
</body>
</html>
