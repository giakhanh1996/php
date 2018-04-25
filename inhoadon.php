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
    $id_pg=$_GET['ma_hd'];
	//$khachhang=$_SESSION['khachhang'];
	$str1="select ho_ten_kh,dia_chi_kh,sdt_kh,tong_tien from hoa_don where ma_hd='$id_pg'";
	$sql1=mysql_query($str1);
	$row=mysql_fetch_assoc($sql1);
	$str2="select b.ten_hang, b.don_gia, a.so_luong from chi_tiet_hd a, mat_hang b where a.ma_hang=b.ma_hang and a.ma_hd='$id_pg'";
	$sql2=mysql_query($str2);
?>
<body>

<div style="margin:10px auto;border:1px solid #000000;width:750px;">
<table width="749" border="0" cellpadding="0" cellspacing="0" align="center">
<tr>
	<td colspan="2" valign="top"><div><table border=0 cellpadding=0 cellspacing=0><tr><td style="border-bottom:1px dotted #000000;"><img src="images/logo.png" height=40></td><td style="border-bottom:1px dotted #000000;"><i>C&ocirc;ng Ty TNHH MTN </i></td></tr></table></div></td>
    <td colspan="2"></td>
    <td width="227" valign="top" align="right" style="border-bottom:1px dotted #000000;"><i>S&#7889; Phi&#7871;u </i>: <?php echo $row['ma_hd'];?><br/>
    <i>Ng&agrave;y &#272;&#7863;t </i>: <?php date_default_timezone_set('UTC');  echo date('d-m-Y')?> </td>
  </tr>
<tr height="40px">
	<td colspan="5"><div align="center" class="style1">HÓA ĐƠN BÁN HÀNG</div></td>
  </tr>
<tr style="height:30px;">
	<td colspan="2"><div align="right" style="font-family:sans-serif;font-size:14px;font-style:italic;">H&#7885; T&ecirc;n Kh&aacute;ch H&agrave;ng : </div></td>
    <td colspan="3" style="padding-left:20px;"><b> <?php echo ucwords($row['ho_ten_kh']);?></b></td>
  </tr>
<tr style="height:30px;">
  <td colspan="2"><div align="right" style="font-family:sans-serif;font-size:14px;font-style:italic;">&#272;&#7883;a Ch&#7881; Kh&aacute;ch H&agrave;ng : </div></td>
  <td colspan="3" style="padding-left:20px;"><b> <?php echo ucwords($row['dia_chi_kh']);?></b></td>
</tr>
<tr style="height:30px;">
  <td colspan="2"><div align="right" style="font-family:sans-serif;font-size:14px;font-style:italic;">S&#7889; &#272;i&#7879;n Tho&#7841;i Kh&aacute;ch H&agrave;ng : </div></td>
  <td colspan="3" style="padding-left:20px;"><b> <?php echo $row['sdt_kh'];?></b></td>
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
	  <td width='131' style='border-bottom:1px solid #000000;border-left:1px solid #000000;'><div align='center'>".number_format($rows['don_gia'])."</div></td>
	  <td width='146' style='border-bottom:1px solid #000000;border-left:1px solid #000000;'><div align='center'>".$rows['so_luong']."</div></td>
	  <td style='border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;'><div align='right'><b>".number_format($thanh_tien,2)."</b> <span style='font-family:sans-serif;font-size:13px;'> VND</span></div></td>
	  </tr>";
	}
?>
<tr>
  <td colspan="5"><div align="right">Tổng Tiền: <b><?php echo number_format($row['tong_tien'],2);?> </b>VND</div></td>
  </tr>
  <tr>
  <td colspan="5" align="right"><i style="color:red;">Tổng Tiền Bằng Chữ: <b><?php echo docso($row['tong_tien']);?></b></i></td>
  </tr>
  
</table>
</div>
<div style="margin:10px auto;width:750px;border-bottom:1px dotted #000000;"><table><tr><td>Cong Ty TNHH MTN<br>Dia Chi : 164, Duong Ly Tu Trong, Q.Ninh Kieu, TP.Can Tho.<br>Dien Thoai : 01646345235.<br>Fax : 0773077099.</td></tr></table></div>
<?php
	if(!$_GET['print'])
	{
		echo"<div style='text-align: center;'><table align='center'><tr><td><a href='hoadonbanhang.php' style='padding: 0px 15px 0px 15px;background:#4148a8;border:2px solid #161c71;color:#ffffff;text-decoration:none;margin-right:10px;'>Trở Về</a></td><td><a href='inhoadon.php?ma_hd=".$id_pg."&print=true' target='_blank' style='padding: 0px 15px 0px 15px;background:#4148a8;border:2px solid #161c71;color:#ffffff;text-decoration:none;margin-right:10px;'>In Phieu</a></td></tr></table></div>";
	}
	else
	{
		echo"<div style='text-align: center;'><table align='center'><tr><td><a href='javascript:window.print();' style='padding: 0px 15px 0px 15px;background:#4148a8;border:2px solid #161c71;color:#ffffff;text-decoration:none;margin-right:10px;'>In Phieu</a></td></tr></table></div>";
	}
	
?>
</body>
</html>
