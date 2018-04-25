<?php
session_start();
?>
<?php
ob_start();
?>
<?php
    require("connect.php");
?>
<?php
$hoten = $_POST['hoten'];
$diachi = $_POST['diachi'];
$sodienthoai = $_POST['sodienthoai'];
if(isset($hoten) && isset($diachi) && isset($sodienthoai)){
$str1 = "insert into khach_hang(ho_ten,dia_chi,so_dien_thoai) values('$hoten','$diachi','$sodienthoai')";
$sql1 = mysql_query($str1);
$id = mysql_insert_id();
$_SESSION['khachhang']=$id;
//echo $id;
$tien = $_POST['tongtien'];
//echo $tien;
$ma=$_POST['ma'];
//echo $ma[0];
$sl=$_POST['so_luong'];
//echo $sl[0];
$str6="insert into phieu_giao_hang(id_kh,tong_tien) values('$id','$tien')";
$sql6 = mysql_query($str6);
$pg = mysql_insert_id(); 
//echo $pg;
for($i=0;$i<count($ma);$i++)
{
    $ma_hang=$ma[$i];
    $so=$sl[$i];
	$str5 = "insert into chi_tiet_phieu_giao(ma_pg,ma_hang,so_luong,ngay_dat) values('$pg','$ma_hang','$so',now())";
	$sql5 = mysql_query($str5);
	$str9 = "update kho_tt set so_luong= so_luong - '$so' where ma_hang='$ma_hang'";
	$sql9 = mysql_query($str9);
}
	//unset($_SESSION[$sl]);
    unset($_SESSION['mat_hang']);
    header("location:xemthongtinmuahang.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {
	font-size: 36px;
	color: #FF0000;
	font-weight: bold;
}
.style3 {color: #0000FF}
.style5 {color: #0000FF; font-weight: bold; }
-->
</style>
<link rel="stylesheet" type="text/css" href="style.css">
<style type="text/css">
<!--
.style6 {font-size: 24px}
-->
</style>
<script type="text/javascript" src="script.js">
</script>
</head>

<body>
<div style="width: 1000px; margin: 0 auto;">
        <div class="banner-index"></div>
        <div class="ds"><table border=0 cellpadding=0 cellspacing=0><tr><td style="width:20px;"></td><td align="center" style="height:35px;color:#490207;font-family:sans-serif;font-weight:bold;background-image:url(images/bcg2.png);background-repeat:repeat-x;width:100px;"><a href="index.php" style="text-decoration:none;color:#6f0702;">Trang chu</a></td><td></td></tr></table></div>
        <div style="margin-top: 10px;">
            <div style="width:100%;border:2px solid #f37a05;background:#f8c56c;"><table border=0 cellpadding=0 cellspacing=0 width="100%"><tr><td align="center" style="width:20px;"><img src="images/icon_shopcart.png" height=30></td><td style="color:#e95903;height:34px;font-weight:bold;"><span class="style6"><marquee direction="left" behavior="scroll" scrollamount="7">Danh Sách Sản Phẩm Trong Giỏ Hàng của Bạn </marquee></span></td>
            </tr></table></div>
	<form action="muahang.php" method="post">
	                <table width="100%" border=0 cellpadding=0 cellspacing=0><tr style="background:#9098fa;font-family:sans-serif;font-weight:bolder;font-size:14px;height:35px;color:#061092;">
                <td align="center">STT</td><td>Ten san pham</td><td>Gia</td><td>So luong</td><td>DVT</td><td align="center">Thanh tien</td>
                </tr>
               <?php
			   require("doctien.php");
                    //$str="select a.ma_hang, b.ten_hang, a.don_gia, a.so_luong, a.dvt from dat_hang_ao a, mat_hang b where a.ma_hang=b.ma_hang";
                    //$sql=mysql_query($str);
                    $i=0;
                    if(isset($_SESSION['mat_hang']))
                    {
                        $mang2=explode("-",$_SESSION['mat_hang']);
                        $tongtien=0;
                        for($t=0;$t<count($mang2);$t++)
                        {
                            $i=$i+1;
                            $str="select * from mat_hang where ma_hang='$mang2[$t]'";
                            $sql=mysql_query($str);
                            $row=mysql_fetch_assoc($sql);
                            $sl="so_luong".$mang2[$t];
                            $thanhtien=$_SESSION[$sl]*($row['don_gia']+($row['don_gia']*0.1));
                            $tongtien=$tongtien+$thanhtien;
                            echo"<tr style='background:#d1e7e9;height:25px;color:#343db0;font-family:sans-serif;font-size:13px;'><td align='center'>".$i."</td><td><input type='hidden' value='".$mang2[$t]."' name='ma[]'>".$row['ten_hang']."</td><td>".number_format(($row['don_gia']+($row['don_gia']*0.1)),0)."</td><td><input type='text' readonly='true' value='".$_SESSION[$sl]."' name='so_luong[]' style='width:70px;text-align:right;'></td><td>".$row['don_vi_tinh']."</td><td style='font-weight:bold;width:130px;' align='right'>".number_format($thanhtien,0)." <input type='button' value='VND' style='color:red;font-weight:bold;font-family:sans-serif;font-size:13px;'></td></tr>";
                        }
                        echo"<tr style='height:30px;'><td colspan=7 align='right'><i style='color:#343db0;font-family:sans-serif;font-size:13px;'>Tong tien : </i><b style='color:#343db0;font-family:sans-serif;font-size:13px;'>".number_format($tongtien,0)."</b><input type='hidden' value='".$tongtien."' name='tongtien'/> <input type='button' value='VND' style='color:red;font-weight:bold;font-family:sans-serif;font-size:13px;'></td></tr>";
                        echo"<trtr style='height:30px;'><td colspan=7 align='right'><i style='color:red;font-family:sans-serif;font-size:13px;'>Tổng tiền bằng chữ : ".docso($tongtien)." đồng</i></td></tr>";
                    }
                ?>
				</table>
  <table width="516" border="0" cellspacing="1" cellpadding="5" align="center">
    <tr>
      <td colspan="2" bgcolor="#CCFF99"><div align="center" class="style2">Th&ocirc;ng Tin Kh&aacute;ch H&agrave;ng </div></td>
    </tr>
    <tr>
      <td width="217" bgcolor="#99FFFF"><div align="left"><strong><span class="style3">H&#7885; T&ecirc;n :</span><span class="style1">*</span> </strong></div></td>
      <td width="276" bgcolor="#99FFFF"><div align="left"><strong>
      </strong></div>        <strong><label>
        <div align="left">
          <input name="hoten" type="text" id="hoten" size="40" />
        </div>
        </label>
      </strong></td>
    </tr>
    <tr>
      <td align="left" bgcolor="#99FFFF"><div align="left"><strong><span class="style3">&#272;ịa Ch&#7881; Giao H&agrave;ng :<span class="style1">* </span></span></strong></div></td>
      <td bgcolor="#99FFFF"><div align="left"><strong>
      </strong></div>        <strong><label>
        <div align="left">
          <textarea name="diachi" cols="37" rows="3" id="diachi"></textarea>
        </div>
        </label>
      </strong></td>
    </tr>
    <tr>
      <td bgcolor="#99FFFF"><div align="left"><strong><span class="style3">S&#7889; &#272;i&#7879;n Tho&#7841;i :</span><span class="style1">*</span> </strong></div></td>
      <td bgcolor="#99FFFF"><div align="left"><strong>
      </strong></div>        <strong><label>
        <div align="left">
          <input name="sodienthoai" type="text" id="sodienthoai" size="40" />
        </div>
        </label>
      </strong></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#99FFFF"><div align="left">
        <p class="style5">Xin qu&iacute; kh&aacute;ch vui l&ograve;ng &#273;i&#7873;n &#273;&#7847;y &#273;&#7911; th&ocirc;ng tin ph&iacute;a tr&ecirc;n <span class="style1">!</span></p>
        <p class="style5"> <span class="style1"><em>lưu ý:</em></span> Chúng tôi sẽ giao hàng cho quí khách theo địa chỉ trên trong khoảng thời gian 2 ngày kể từ ngày thực hiện giao dịch. </p>
      </div></td>
    </tr>
    <tr>
      <td colspan="2" bgcolor="#99FFFF">
          <div align="center"><strong>
          <input name="Submit" type="submit" class="style5" onclick="return checkkhachhang();" value="Th&#7921;c Hi&#7879;n" />
          &nbsp; &nbsp;&nbsp;
          <input name="Submit2" type="reset" class="style5" value="H&#7911;y" />
      </strong></div></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
ob_end_flush();
?>