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
    $control=$_GET['control'];
    $ten_cv=ucwords($_POST['ten_cv']);
	$ma_cv=strtoupper($_POST['ma_cv']);
    if(isset($ten_cv)&&isset($ma_cv) && $ten_cv!= "" && $ma_cv != ""){
	$str8="insert into chuc_vu(ma_cv,ten_cv) values('$ma_cv','$ten_cv')";
	mysql_query($str8);
    }
    $control2=$_GET['control2'];
    $ma_cv2=$_GET['$ma_cv'];
    if($control2=="delete")
    {
        $str9="delete from chuc_vu where ma_cv='$ma_cv2'";
        mysql_query($str9);
    }
    $ma_nv=strtoupper($_POST['ma_nv']);
    $ten_nv=ucwords($_POST['ten_nv']);
    $chuc_vu=$_POST['chuc_vu'];
    $tai_khoan=$_POST['tai_khoan'];
    $mat_khau=$_POST['mat_khau'];
    $ngsinh1=$_POST['ngay_sinh'];
    $ngsinh2=explode("-",$ngsinh1);
    $ngay=$ngsinh2[0];
    $thang=$ngsinh2[1];
    $nam=$ngsinh2[2];
    $ngay_sinh=$nam."-".$thang."-".$ngay;
    $gioi_tinh=$_POST['gioi_tinh'];
	$sdt=$_POST['sdt'];
    $dia_chi=$_POST['dia_chi'];
    $thaotac = $_GET['thaotac'];
    $ma_nv2= $_GET['ma_nv'];
    if(!isset($thaotac)){
	if(isset($ma_nv) && isset($ten_nv)&& isset($chuc_vu)&& isset($tai_khoan) && $ma_nv != "" && $ten_nv != "" && $chuc_vu != "" && $mat_khau != "" && $sdt != "")
	{
	    $str10="insert into nhanvien(ma_nv,ten_nv,ma_cv,tai_khoan,mat_khau,ngay_sinh,gioi_tinh,so_dien_thoai,dia_chi) 
	    values('$ma_nv','$ten_nv','$chuc_vu','$tai_khoan','$mat_khau','$ngay_sinh','$gioi_tinh','$sdt','$dia_chi')";
	    $sql10=mysql_query($str10);
	    if($sql10)
	    {
	      $themnhanvien=true;  
	    }
	    else{
		$themnhanvien=false;
	    }
	}
    }
    else{
	if($thaotac=="delete")
	{
	    $str12 = "delete from nhanvien where ma_nv = '$ma_nv2'";
	    mysql_query($str12);
	}
	if($thaotac=="edit")
	{
	    if(isset($ma_nv) && isset($ten_nv)&& isset($chuc_vu)&& isset($tai_khoan) && $ma_nv != "" && $ten_nv != "" && $chuc_vu != "" && $mat_khau != "" && $sdt != ""){
		$str13="update nhanvien set ten_nv='$ten_nv',ma_cv='$chuc_vu',tai_khoan='$tai_khoan',mat_khau='$mat_khau',ngay_sinh='$ngay_sinh',gioi_tinh='$gioi_tinh',so_dien_thoai='$sdt',dia_chi='$dia_chi' where ma_nv='$ma_nv2' ";
		mysql_query($str13);
		header("location:nhanvien.php");
	    }
	    else{
	    $str12 = "select * from nhanvien where ma_nv = '$ma_nv2'";
	    $sql12=mysql_query($str12);
	    $row12=mysql_fetch_assoc($sql12);
	    }
	}
    }
    
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thêm mặt hàng mới</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" language="javascript" src="script.js"></script>
</head>

<body>
<div>
    <table width="100%">
    <tr>
    <td colspan="4">
    <?php 
    if(isset($themnhanvien)&& $themnhanvien==false)
    {
        echo "<div style='border:1px solid red; color:red; background:#efbcbb '><table><tr>
        <td width=60>
        <img src='images/error_icon.png' height=40/>
        </td>
        <td><b>Mã Nhân Viên Của Bạn Đã bị Trùng Rồi</b></td></tr></table></div>";
    }
    ?>
    </td>
    </tr>
    <tr>
    <td valign="top">
    		<?php
		if(isset($control))
		{
		    echo"<div id='form1' style='display:none;'>";
		}
		else
		{
		    echo"<div id='form1'>";
		}
		
		?>
                <div class="area-title" style="color:#ffffff;text-align:center;font-family:sans-serif;font-weight:bold;">
      Thêm Mới Nhân Viên</div>
                <div>
                <form action="<?php echo $SCRIPT_NAME; ?>" method="POST">
                    <table>
                        <tr>
                          <td width="107">Mã Nhân Viên :</td><td width="161"><input name="ma_nv" type="text" id="ma_nv" value="<?php echo $row12['ma_nv']; ?>"></td>
                          <td>Chức Vụ : </td><td width="225">
                        <select name="chuc_vu" id="chuc_vu">
                        <?php 
                            $str5="select * from chuc_vu";
                            $sql5=mysql_query($str5);
                            while($row5=mysql_fetch_assoc($sql5))
                            {
                                if($row5['ma_cv']==$row12['ma_cv']){
                                //echo "<script type='text/javascript'>alert('tuan sao');</script>";
                                echo"<option selected=true value='".$row5['ma_cv']."'>".$row5['ten_cv']."</option>";
                                }
                                else
                                {
                                 echo"<option value='".$row5['ma_cv']."'>".$row5['ten_cv']."</option>";
                                 }
                            }
                        ?>
                        </select>
                        <input type="button" value="Thêm chức vụ" onclick="show_form();" /></td></tr>
                        <tr>
                          <td>Tên Nhân Viên:</td><td><input name="ten_nv" type="text" id="ten_nv" value="<?php echo $row12['ten_nv']; ?>"></td><td>Ngày Sinh :</td><td><input name="ngay_sinh" type="text" id="ngay_sinh" value="<?php echo $row12['ngay_sinh']; ?>" style="width:217px;"></td></tr>
                        <tr>
                          <td>Tài Khoản : </td><td><input type="text" name="tai_khoan" id="tai_khoan" value="<?php echo $row12['tai_khoan']; ?>"></td><td>Giới Tính :</td><td>
			  <?php
                          if($row12[gioi_tinh]=="nam")
                          {
                          echo "<input type='radio' name='gioi_tinh' checked='checked' value='nam' />Nam<input type='radio' name='gioi_tinh' value='nu'/>Nữ";
                          }else if($row12[gioi_tinh]=="nu")
                          {                       
                          echo "<input type='radio' name='gioi_tinh'  value='nam' />Nam<input type='radio' name='gioi_tinh' value='nu' checked='checked'/>Nữ";
                          }
                          else{
                            echo "<input type='radio' name='gioi_tinh' checked='checked' value='nam' />Nam<input type='radio' name='gioi_tinh' value='nu'/>Nữ"; 
                          }
                          ?>
			  </td></tr>
                        <tr>
                      <td>Mật Khẩu :</td><td><input name="mat_khau" type="password" id="mat_khau" value="<?php echo $row12['mat_khau']; ?>"></td><td>Số Điện Thoại :</td><td> <input type="text" name="sdt" id="sdt" value="<?php echo $row12['so_dien_thoai']; ?>" style="width:217px;" /></td></tr>

                        <tr>
                      <td>Địa Chỉ:</td><td colspan=3>
                        <input type="text" name="dia_chi" id="dia_chi" value="<?php echo $row12['dia_chi']; ?>" style="width:480px;"/>
                      </td></tr> 
                        <tr><td colspan="4"><input type="submit" onclick="return checknhanvien();" value="<?php if($thaotac=="edit"){ echo "Sửa Thông Tin";}else{ echo "Thêm Nhân Viên";}  ?>" /><input type="reset" value="Làm Lại" /></td></tr>
                    </table>
                </form>
                </div>
            </div>
            </td>
            <td valign="top">
        		<?php
        		if($control=="themloai")
        		{
        		    echo"<div style='display:block;' id='form2'>";
        		}
        		else
        		{
        		    echo"<div style='display:none;' id='form2'>";
        		}
                    	
        		?>
    		    <div><a href="nhanVien.php">Trở về</a></div>
    		    <div class="area-title" style="color:#ffffff;text-align:center;font-family:sans-serif;font-weight:bold;">Thêm Chức Vụ</div>
    		    <table><tr>
                <td valign="top">
        			<div style="background:#b59a9a;">
        			    <form action="nhanvien.php?control=themloai" method="post" name="them_laoi_hang">
        				<table>
        				<tr><td>Mã Chức Vụ :</td><td><input type="text" name="ma_cv" id="ma_cv" /></td></tr>
                        <tr><td>Tên Chức Vụ :</td><td><input type="text" name="ten_cv" id="ten_cv" /></td></tr>
        				<tr><td colspan="2" align="center"><input type="submit" value="Thêm Chức Vụ" onclick="return checkchucvu();" onclick="return check_form();" /></td></tr>
        				</table>
        			    </form>
        			</div>
    		    </td>
    		    <td>
         	          <div>
        			    <div style="color:#ffffff;background:#4a2020;text-align:center;font-family:sans-serif;font-weight:bold;font-size:13px;">Danh Sách Các Chức Vụ</div>
        			    <div style="width:250px;height:250px;overflow-y: scroll;">
        			    <table width="100%">
        				    <?php
        								    $str7="select * from chuc_vu";
        								    $sql7=mysql_query($str7);
        								    while($row7=mysql_fetch_assoc($sql7))
        								    {
        									    echo"<tr><td>".$row7['ten_cv']."</td><td><a href='nhanvien.php?control=themloai&control2=delete&ma_cv=".$row7['ma_cv']."' onclick=\"return check('".$row7['ten_cv']."');\">Xóa</a></td></tr>";
        								    }
        							    ?>
        				</table>
        			    </div>
    			     </div>
    		    </td>
                </tr></table>
                
                </div>
                
          </td></tr><tr>
          <td valign="top">
                <?php
                if(isset($control))
        		{
        		    echo"<div id='form3' style='display:none;'>";
        		}
        		else
        		{
        		    echo"<div id='form3'>";
        		}
        		
        		?>
                    <div class="area-title" style="text-align:center;color: #ffffff;font-family: sans-serif;font-weight: bold;">Danh Sách Nhân Viên</div>
                    <div>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr style="font-family:sans-serif;font-size:14px;font-weight:bold;height:30px;"><td style="border-bottom: 1px solid #000000;">STT</td>
                            <td style="border-bottom: 1px solid #000000;">Mã Nhân Viên</td>
                            <td style="border-bottom: 1px solid #000000;">Tên Nhân Viên</td>
                            <td style="border-bottom: 1px solid #000000;">Giới tính</td>
                            <td style="border-bottom: 1px solid #000000;">Chức vụ</td>
                            <td style="border-bottom: 1px solid #000000;">Địa chỉ</td>
                            <td style="border-bottom: 1px solid #000000;">Số DT</td>
                            <td style="border-bottom: 1px solid #000000;" colspan="2">Cập Nhật</td>
                            </tr>
                                    <?php
                                            $str11="select ma_nv,ten_nv,gioi_tinh,dia_chi,so_dien_thoai,ten_cv from nhanvien a,chuc_vu b where a.ma_cv=b.ma_cv";
                                            $sql11=mysql_query($str11);
                                            $i=0;
                                            while($row11=mysql_fetch_assoc($sql11))
                                            {
                                                $i=$i+1;
                                                echo"<tr id='hang".$i."' onmouseover=\"doi_mau_hang('hang".$i."','#fd9104');\" onmouseout=\"huy_mau_hang('hang".$i."');\" style='font-family:sans-serif;font-size:13px;height:30px;'><td style='border-bottom:1px dotted #000000;'>".$i."</td>
                                                <td style='border-bottom:1px dotted #000000;'>".$row11['ma_nv']."</td>
                                                <td style='border-bottom:1px dotted #000000;'>".$row11['ten_nv']."</td>
                                                <td style='border-bottom:1px dotted #000000;'>".ucwords($row11['gioi_tinh'])."</td>
                                                <td style='border-bottom:1px dotted #000000;'>".ucwords($row11['ten_cv'])."</td>
												<td style='border-bottom:1px dotted #000000;'>".$row11['dia_chi']."</td>
												<td style='border-bottom:1px dotted #000000;'>".$row11['sdt']."</td>
                                                <td style='border-bottom:1px dotted #000000;'><a href='nhanvien.php?thaotac=delete&ma_nv=".$row11['ma_nv']."' onclick=\"return check('".$row11['ten_nv']."')\">Xoa</a></td>
                                                <td style='border-bottom:1px dotted #000000;'><a href='nhanvien.php?thaotac=edit&ma_nv=".$row11['ma_nv']."'>Sua</a></td>
                                                </tr>";
                                                
                                            }
                                    ?>
                            </table>
                    </div>
                </div>
          </td>
          </tr></table>
</div>
</body>
</html>
<?php
ob_end_flush();
?>