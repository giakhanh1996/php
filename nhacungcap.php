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
?>
<?php
require("connect.php");
$ma_ncc=$_POST['ma_ncc'];
$ten_ncc=$_POST['ten_ncc'];
$dia_chi_ncc=$_POST['diachi_ncc'];
$sdt_ncc=$_POST['sdt_ncc'];
$email_ncc=$_POST['email_ncc'];
$control=$_GET['control'];
$ma_ncc=$_GET['ma_ncc'];
	if($control=="edit"){
		$edit=1;
		$str3="select * from nha_cung_cap where ma_ncc='$ma_ncc'";
		$sql3=mysql_query($str3);
		$row3=mysql_fetch_assoc($sql3);
		}
 	if(!isset($control)){
        if(isset($ten_ncc) && $ten_ncc != "" && isset($sdt_ncc) && $sdt_ncc != ""){
        	$str4="insert into nha_cung_cap(ten_ncc,dia_chi_ncc,sdt_ncc,email_ncc) values('$ten_ncc','$dia_chi_ncc','$sdt_ncc','$email_ncc')";
        	mysql_query($str4);
            if($sql2){
				$insert=true;
				
			}
			else{
				$insert=false;		
			}
		}
  }
else{
    if($control=="edit")
    {
        
        	if( isset($ten_ncc)&& $ten_ncc!=""){
				$str4="update nha_cung_cap set ten_ncc='$ten_ncc',dia_chi_ncc='$dia_chi_ncc',sdt_ncc='$sdt_ncc',email_ncc='$email_ncc' where ma_ncc='$ma_ncc'";
				$sql4=mysql_query($str4);
					if($sql4){
						$update=true;
						header("location:nhacungcap.php");
					}
					else{
						$update=false;		
					}
			}
    }
   	if($control=="delete")
		{
		      $stst="select * from kho_tt a, mat_hang b where a.ma_hang=b.ma_hang and b.ma_ncc='$ma_ncc'";
            $sqsl=mysql_query($stst);
            $dd=mysql_num_rows($sqsl);
            if($dd <= 0)
            {
                //$ma_ncc1=$_GET['ma_ncc'];
    			$str4="delete from nha_cung_cap where ma_ncc='$ma_ncc'";
    			$sql4=mysql_query($str4);
    			if($sql4){
    				$delete=true;	
    			}
    			else{
    				$delete=false;
    			}
                $xoa=0;
            }
            else
            {
                $xoa=1;
            }
			
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản Lí Nhà Cung Cấp</title>
<link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" language="javascript" src="script.js"></script>
</head>

<body style="margin:0;padding:0;text-align:center;">
        <div style="text-align:left;">
	    <div class="title-tab">Quản Lí Nhà Cung Cấp</div>
	    <table width="100%">
		<tr>
		    <td valign="top">
			<div class="font-title"><div style="">Thêm Nhà Cung Cấp Mới</div></div>
             <?php
            if($xoa==1)
            {
                echo"<div style='color:red;border:1px solid red;'>Nha cung cap dang hop tac !!</div>";
            }
            ?>
			<div id="them_ncc_moi" style="background:#b59a9a;">
			    <form action="<?php echo $SCRIPT_NAME; ?>" name="them_ncc_form" method="POST" style="margin:0;padding:0;">
				<table border=0>
					
					<tr><td style="color:#000000;font-style:italic;">Tên NCC :</td><td><input type="text" name="ten_ncc" id="tenncc" value="<?php echo $row3['ten_ncc']; ?>"></td></tr>
					<tr><td style="color:#000000;font-style:italic;">Địa Chỉ :</td><td><input type="text" name="diachi_ncc" id="diachincc" value="<?php echo $row3['dia_chi_ncc']; ?>"></td></tr>
                    <tr><td style="color:#000000;font-style:italic;">Số Điện Thoại :</td><td><input type="text" name="sdt_ncc" id="sdtncc" value="<?php echo $row3['sdt_ncc']; ?>"></td></tr>
                    <tr><td style="color:#000000;font-style:italic;">Email :</td><td><input type="text" name="email_ncc" id="emailncc" value="<?php echo $row3['email_ncc']; ?>"></td></tr>
					<tr><td colspan=2><?php if($edit !=1 ){ echo"<input type='image' name='img_b' onclick= \"return checkncc();\" src='images/them1.png'>";
					echo "<a href=''><img src='images/cnhat.png' border=0></a>";
					}
					else{
						echo"<input type='image' name='img_b' src='images/capn.png'>";
					echo "<a href=''><img src='images/cnhat.png' border=0></a>";
					}
					?>
					</td></tr>
				</table>
			    </form>
			</div>
		    </td>
		</tr><tr>
		    <td style="" valign="top">
			<div>
			    <div class="font-title"><div style="padding-top:5px;">Danh Sách Nhà Cung Cấp</div></div>
			    <div style="">
				<table width="100%" border=0>
				    <tr>
				    <td style="border-bottom:1px solid #000000;font-weight:bold;color:#000000;width:70px;" align="center">STT</td>
				    <td style="border-bottom:1px solid #000000;font-weight:bold;color:#000000;">Tên Nhà Cung Cấp</td>
				    <td align="center" style="color:#000000;border-bottom:1px solid #000000;font-weight:bold;">Địa Chỉ</td>
				    <td align="center" style="color:#000000;border-bottom:1px solid #000000;font-weight:bold;">Số Điện Thoại</td>
				    <td align="center" style="color:#000000;border-bottom:1px solid #000000;font-weight:bold;">Email Address</td>
				    <td align="center" style="color:#000000;border-bottom:1px solid #000000;font-weight:bold;" colspan=2>Cập Nhật</td>
				    </tr>
				<?php
				    $str1="select * from nha_cung_cap";
				    $sql1=mysql_query($str1);
				    $i=0;
				    while($row=mysql_fetch_assoc($sql1)){
					$i=$i+1;
					echo"<tr style='height:30px;'><td align='center' style='font-weight:bold;color:#000000;border-bottom:1px dotted #000000;'>".$i."</td>
					<td style='color:#000000;border-bottom:1px dotted #000000;'>".$row['ten_ncc']."</td>
					<td style='font-style:italic;color:#000000;border-bottom:1px dotted #000000;'>".$row['dia_chi_ncc']." </td>
					<td style='font-style:italic;color:#000000;border-bottom:1px dotted #000000;'>".$row['sdt_ncc']." </td>
					<td style='font-style:italic;color:#000000;border-bottom:1px dotted #000000;'>".$row['email_ncc']." </td>
					<td style='border-bottom:1px dotted #000000;'><a href='nhacungcap.php?control=delete&ma_ncc=".$row['ma_ncc']."' onclick=\"return check('".$row['ten_ncc']."');\"><img src='images/delete-b.png' border=0></a></td>
					<td style='border-bottom:1px dotted #000000;'><a href='nhacungcap.php?control=edit&ma_ncc=".$row['ma_ncc']."'><img src='images/edit-b.png' border=0></a></td></tr>";
				    }
				?>
				</table>
			    </div>
			</div>
		    </td>
		    
		</tr>
	    </table>
        </div>
    </body>
</html>
<?php
ob_end_flush();
?>