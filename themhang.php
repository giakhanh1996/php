<?php
session_start();
?>
<?php
ob_start();
?>
<?php
    require("connect.php");
    $str="select * from kiemke";
    $sql=mysql_query($str);
    //$row=mysql_num_rows($sql);
    $ro=mysql_fetch_assoc($sql);
    if($ro['kk']==0)
    {
        header("location:kiemke.php");
    }
    if(!isset($_SESSION['manager_user']) && !isset($_SESSION['admin'])){
        header("location:login.php");
    }
    
    //echo $_FILES['file_anh']['name'];
    
    if(isset($_FILES['file_anh']['name']))
    {
            move_uploaded_file($_FILES["file_anh"]["tmp_name"],"anh_sp/".$_FILES["file_anh"]["name"]);
            $file_anh=$_FILES['file_anh']['name'];
    }
    $control=$_GET['control'];
    $ten_loai=$_POST['ten_loai'];
    if(isset($ten_loai) && $ten_loai!= ""){
	$str8="insert into loai_hang(ten_loai) values('$ten_loai')";
	mysql_query($str8);
    }
    $control2=$_GET['control2'];
    $ma_loai=$_GET['ma_loai'];
    if($control2=="delete")
    {
        $str9="delete from loai_hang where ma_loai='$ma_loai'";
        mysql_query($str9);
    }
    $ten_hang=$_POST['ten_hang'];
    $loai_hang=$_POST['loai_hang'];
    $nhan_hieu2=$_POST['nhan_hieu'];
    $so_luong=$_POST['so_luong'];
    $dvt=$_POST['don_vi'];
    $hsd1=$_POST['han_su_dung'];
    $hsd2=explode("-",$hsd1);
    $ngay=$hsd2[0];
    $thang=$hsd2[1];
    $nam=$hsd2[2];
    $hsd=$nam."-".$thang."-".$ngay;
    $quy_cach=$_POST['quy_cach'];
    $ncc=$_POST['ncc'];
    $thaotac = $_GET['thaotac'];
    $ma_hang= $_GET['ma_hang'];
    $don_gia = $_POST['don_gia'];
    if(!isset($thaotac)){
	if(isset($ten_hang) && $ten_hang != "" && $hsd != "")
	{
	    //echo"dung quy cach";
	    $str10="insert into mat_hang(ma_loai,ten_hang,nhan_hieu,han_su_dung,quy_cach,don_vi_tinh,ma_ncc,don_gia,ngay_nhap,hinh_anh) 
	    values('$loai_hang','$ten_hang','$nhan_hieu2','$hsd','$quy_cach','$dvt','$ncc','$don_gia',now(),'$file_anh')";
	    mysql_query($str10);
	}
    }
    else{
	if($thaotac=="delete")
	{
	   $stst="select * from kho_tt where ma_hang='$ma_hang'";
        $sqsl=mysql_query($stst);
        $dd=mysql_num_rows($sqsl);
        if($dd <= 0)
        {
    	    $str12 = "delete from mat_hang where ma_hang = '$ma_hang'";
    	    mysql_query($str12);
            $xoa=0;
         }
         else
         {
            $xoa=1;
         }
	}
	if($thaotac=="edit")
	{
	    if(isset($ten_hang) && $ten_hang != ""&& $hsd != "")
	    {
	      $str13="update mat_hang set ma_loai='$loai_hang',ten_hang='$ten_hang',nhan_hieu='$nhan_hieu2',han_su_dung='$hsd',quy_cach='$quy_cach',don_vi_tinh='$dvt',ma_ncc='$ncc',don_gia='$don_gia',hinh_anh='$file_anh' where ma_hang='$ma_hang'";
	      mysql_query($str13);
	      //header("location:themhang.php");
	    }
	    else
	    {
	    $str12="select * from mat_hang where ma_hang='$ma_hang'";
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
<div style="width: 1000px; margin: 0 auto;">
 <?php
            if($xoa==1)
            {
                echo"<div style='color:red;border:1px solid red;'>Mat hang nay dang ton tai trong kho !!</div>";
            }
 ?>
	<table width="100%"><tr>
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
                    Thêm mặt hàng mới
                </div>
                <div>
                <form action="<?php echo $SCRIPT_NAME; ?>" method="POST" enctype="multipart/form-data">
                    <table>
                        <tr><td>Tên Hàng : </td><td><input type="text" name="ten_hang" id="tenhang" value="<?php echo $row12['ten_hang']; ?>"></td><td>Loại Hàng : </td><td>
                        <select name="loai_hang">
                        <?php 
                            $str5="select * from loai_hang";
                            $sql5=mysql_query($str5);
                            while($row5=mysql_fetch_assoc($sql5))
                            {
                                if($row5['ma_loai']==$row12['ma_loai']){
                                //echo "<script type='text/javascript'>alert('tuan sao');</script>";
                                echo"<option selected=true value='".$row5['ma_loai']."'>".$row5['ten_loai']."</option>";
                                }
                                else
                                {
                                 echo"<option value='".$row5['ma_loai']."'>".$row5['ten_loai']."</option>";
                                 }
                            }
                        ?>
                        </select><input type="button" value="Thêm Loại" onclick="show_form();" />
                        </td></tr>
                        <tr><td>Nhãn Hiệu :</td><td><input type="text" name="nhan_hieu" id="nhanhieu" value="<?php echo $row12['nhan_hieu']; ?>"></td>
                        <td>Đơn Vị Tính : </td><td>
                        <select name="don_vi">
			    <?php
				if(isset($thaotac) && $thaotac=="edit")
				{
				    if($row12['don_vi_tinh']=="cai")
				    {
					echo"<option selected=true value='cai'>Cái</option>";
					echo"<option value='lit'>Lít</option>";
					echo"<option value='hop'>Hộp</option>";
					echo"<option value='thung'>Thùng</option>";
					echo"<option value='kg'>Kilogam</option>";
					echo"<option value='bao'>Bao</option>";
				    }
				    if($row12['don_vi_tinh']=="lit")
				    {
					echo"<option value='cai'>Cái</option>";
					echo"<option selected=true value='lit'>Lít</option>";
					echo"<option value='hop'>Hộp</option>";
					echo"<option value='thung'>Thùng</option>";
					echo"<option value='kg'>Kilogam</option>";
					echo"<option value='bao'>Bao</option>";
				    }
				    if($row12['don_vi_tinh']=="hop")
				    {
					echo"<option value='cai'>Cái</option>";
					echo"<option value='lit'>Lít</option>";
					echo"<option selected=true value='hop'>Hộp</option>";
					echo"<option value='thung'>Thùng</option>";
					echo"<option value='kg'>Kilogam</option>";
					echo"<option value='bao'>Bao</option>";
				    }
				    if($row12['don_vi_tinh']=="thung")
				    {
					echo"<option value='cai'>Cái</option>";
					echo"<option value='lit'>Lít</option>";
					echo"<option value='hop'>Hộp</option>";
					echo"<option selected=true value='thung'>Thùng</option>";
					echo"<option value='kg'>Kilogam</option>";
					echo"<option value='bao'>Bao</option>";
				    }
				    if($row12['don_vi_tinh']=="kg")
				    {
					echo"<option value='cai'>Cái</option>";
					echo"<option value='lit'>Lít</option>";
					echo"<option value='hop'>Hộp</option>";
					echo"<option value='thung'>Thùng</option>";
					echo"<option selected=true value='kg'>Kilogam</option>";
					echo"<option value='bao'>Bao</option>";
				    }
				    if($row12['don_vi_tinh']=="bao")
				    {
					echo"<option value='cai'>Cái</option>";
					echo"<option value='lit'>Lít</option>";
					echo"<option value='hop'>Hộp</option>";
					echo"<option value='thung'>Thùng</option>";
					echo"<option value='kg'>Kilogam</option>";
					echo"<option selected=true value='bao'>Bao</option>";
				    }
				}
				else
				{
				    echo"<option value='cai'>Cái</option>";
				    echo"<option value='lit'>Lít</option>";
				    echo"<option value='hop'>Hộp</option>";
				    echo"<option value='thung'>Thùng</option>";
				    echo"<option value='kg'>Kilogam</option>";
				    echo"<option value='bao'>Bao</option>";
				}
			    ?>
			</select>
                        </td></tr>
                        <tr><td>Hạn sử dụng :</td><td><input type="text" id="hansudung" name="han_su_dung" value="<?php echo $row12['han_su_dung']; ?>"></td><td>Đơn Giá :</td><td><input style="width: 100px;" type="text" name="don_gia" id="dongia" value="<?php echo $row12['don_gia']; ?>" />VND</td></tr>
                        <tr><td>Quy cách : </td><td><input type="text" name="quy_cach" id="quycach" value="<?php echo $row12['quy_cach']; ?>"></td><td></td><td></td></tr>
                        <tr><td>Nhà cung cấp :</td><td>
                        <select name="ncc">
                        <?php 
                            $str6="select * from nha_cung_cap";
                            $sql6=mysql_query($str6);
                            while($row6=mysql_fetch_assoc($sql6))
                            {
                                echo"<option value='".$row6['ma_ncc']."'>".$row6['ten_ncc']."</option>";
                            }
                        ?>
                        </select></td></tr>
                        <tr><td>Hinh Anh : </td><td colspan="3"><input type="file" id="fileanh" name="file_anh"></td></tr>
                        <tr><td>Ghi Chú :</td><td><textarea name="ghi_chu"></textarea></td></tr>
                        <tr><td colspan="4"><input type="submit" onclick="return checkhanghoa();" value="<?php if($thaotac=="edit"){echo "Sửa Thông Tin"; }else{echo "Thêm Hàng";}?>" /><input type="reset" value="Làm Lại" /></td></tr>
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
    		    <div><a href="themhang.php">Trở về</a></div>
    		    <div class="area-title" style="color:#ffffff;text-align:center;font-family:sans-serif;font-weight:bold;">Thêm Loại Hàng Mới</div>
    		    <table><tr>
                <td valign="top">
        			<div style="background:#b59a9a;">
        			    <form action="themhang.php?control=themloai" method="post" name="them_laoi_hang">
        				<table>
        				<tr><td>Tên Loại :</td><td><input type="text" name="ten_loai" /></td></tr>
        				<tr><td colspan="2" align="center"><input type="submit" value="Thêm Loại" onclick="return check_form();" /></td></tr>
        				</table>
        			    </form>
        			</div>
    		    </td>
    		    <td>
         	          <div>
        			    <div style="color:#ffffff;background:#4a2020;text-align:center;font-family:sans-serif;font-weight:bold;font-size:13px;">Danh Sách Các Loại Hàg</div>
        			    <div style="width:250px;height:250px;overflow-y: scroll;">
        			    <table width="100%">
        				    <?php
        								    $str7="select * from loai_hang";
        								    $sql7=mysql_query($str7);
        								    while($row7=mysql_fetch_assoc($sql7))
        								    {
        									    echo"<tr><td>".$row7['ten_loai']."</td><td><a href='themhang.php?control=themloai&control2=delete&ma_loai=".$row7['ma_loai']."' onclick=\"return check('".$row7['ten_loai']."');\">Xóa</a></td></tr>";
        								    }
        							    ?>
        				</table>
        			    </div>
    			     </div>
    		    </td>
                </tr></table>
                
                </div>
                
          </td>
          
          </tr></table>
</div>
<div style="width: 1000px; margin: 0 auto;">
<table width="100%"><tr>
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
                    <div class="area-title" style="text-align:center;color: #ffffff;font-family: sans-serif;font-weight: bold;">Danh Sách Các Mặt Hàng</div>
                    <div>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr><td style="border-bottom: 1px solid #000000;">STT</td>
                            <td style="border-bottom: 1px solid #000000;">Hinh Anh</td>
                            <td style="border-bottom: 1px solid #000000;">Tên Hàng</td>
                            <td style="border-bottom: 1px solid #000000;">Nhãn Hiệu</td>
                            <td style="border-bottom: 1px solid #000000;">Hạn Sử Dụng</td>
                            <td style="border-bottom: 1px solid #000000;">Đơn Vị Tính</td>
                            <td style="border-bottom: 1px solid #000000;">Đơn Giá(VND)</td>
                            <td style="border-bottom: 1px solid #000000;" colspan="2">Cập Nhật</td>
                            </tr>
                                    <?php
                                            $str11="select * from mat_hang";
                                            $sql11=mysql_query($str11);
                                            $i=0;
                                            while($row11=mysql_fetch_assoc($sql11))
                                            {
                                                $i=$i+1;
                                                echo"<tr style='height:60px;' id='hang".$i."' onmouseover=\"doi_mau_hang('hang".$i."','#6cffcd');\" onmouseout=\"huy_mau_hang('hang".$i."');\"><td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'>".$i."</td><td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'><img src='anh_sp/".$row11['hinh_anh']."' height=50></td>
                                                <td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'>".ucwords($row11['ten_hang'])."</td>
                                                <td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'>".$row11['nhan_hieu']."</td>";
                                                $hsd1=$row11['han_su_dung'];
                                                $hsd2=explode("-",$hsd1);
                                                $ngay=$hsd2[0];
                                                $thang=$hsd2[1];
                                                $nam=$hsd2[2];
                                                $hsd=$nam."-".$thang."-".$ngay;
                                                echo "<td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'>".$hsd."</td>
                                                <td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'>".ucwords($row11['don_vi_tinh'])."</td>
                                                <td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'>".$row11['don_gia']."</td>
                                                <td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'><a href='themhang.php?thaotac=delete&ma_hang=".$row11['ma_hang']."' onclick=\"return check('".$row11['ten_hang']."')\">Xoa</a></td>
                                                <td style='border-bottom:1px dotted #000000;font-family:sans-serif;font-size:13px;'><a href='themhang.php?thaotac=edit&ma_hang=".$row11['ma_hang']."'>Sua</a></td>
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