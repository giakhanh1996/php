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
    $ma_kho=$_POST['ma_kho'];
    $ten_kho=$_POST['ten_kho'];
    $diachi_kho=$_POST['diachi_kho'];
	$sdt=$_POST['sdt'];
	$control=$_GET['control'];
	$ma_kho2=$_GET['ma_kho'];
	//echo $control;
	if($control=="edit"){
		//echo "ban dang sua bai";
		$edit=1;
		$str3="select * from kho_hang where ma_kho='$ma_kho2'";
		$sql3=mysql_query($str3);
		$row3=mysql_fetch_assoc($sql3);
		}
	if(!isset($control)){
		if(isset($ma_kho) && isset($ten_kho) && $ma_kho!="" && $ten_kho!=""){
			$str2="insert into kho_hang(ma_kho,ten_kho,dia_chi,sdt) values('$ma_kho','$ten_kho','$diachi_kho','$sdt')";
			$sql2=mysql_query($str2);
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
			if(isset($ma_kho) && isset($ten_kho) && $ma_kho!="" && $ten_kho!=""){
				$str2="update kho_hang set ma_kho='$ma_kho',ten_kho='$ten_kho',dia_chi='$diachi_kho',sdt='$sdt' where ma_kho='$ma_kho'";
				$sql2=mysql_query($str2);
					if($sql2){
						$update=true;
						header("location:khohang.php");
					}
					else{
						$update=false;		
					}
			}
		}
		if($control=="delete")
		{
			$stst="select * from kho_tt where ma_kho='$ma_kho2'";
            $sqsl=mysql_query($stst);
            $dd=mysql_num_rows($sqsl);
            if($dd <= 0)
            {
    			$str2="delete from kho_hang where ma_kho='$ma_kho2'";
    			$sql2=mysql_query($str2);
    			if($sql2){
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
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
	    Kho Hàng
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" language="javascript" src="script.js"></script>
    </head>
    <body style="margin:0;padding:0;text-align:center;">
        <div style="text-align:left;">
	    <div class="title-tab">Kho Hàng</div>
	    <div style="margin:0 auto;">
	    <table align="center">
		<tr>
		    <td valign="top">
			<div class="font-title"><div style="">Thêm Kho Mới</div></div>
            <?php
            if($xoa==1)
            {
                echo"<div style='color:red;border:1px solid red;'>Kho dang duoc su dung !!</div>";
            }
            ?>
			<div id="them_kho_moi" style="background:#b59a9a;">
			    <form action="<?php echo $SCRIPT_NAME; ?>" name="them_kho_form" method="POST" style="margin:0;padding:0;">
				<table border=0>
					<tr><td style="color:#000000;font-style:italic;">Mã Kho :</td><td><input type="text" name="ma_kho" id="makho" value="<?php echo $row3['ma_kho']; ?>"></td></tr>
					<tr><td style="color:#000000;font-style:italic;">Tên Kho :</td><td><input type="text" name="ten_kho" id="tenkho" value="<?php echo $row3['ten_kho']; ?>"></td></tr>
					<tr><td style="color:#000000;font-style:italic;">Địa Chỉ :</td><td><input type="text" name="diachi_kho" id="diachi" value="<?php echo $row3['dia_chi']; ?>"></td></tr>
                    <tr><td style="color:#000000;font-style:italic;">Số Điện Thoại :</td><td><input type="text" name="sdt" id="sdt" value="<?php echo $row3['sdt']; ?>"></td></tr>
					<tr>
					  <td colspan=2> <?php if($edit !=1 ){ echo"<input type='image' name='img_b' onclick =\" return checkkho();\" src='images/them1.png'>";
					echo "<a href=''><img src='images/cnhat.png' border=0></a>";
					}
					else{
						echo"<input type='image' src='images/capn.png'>";
					echo "<a href=''><img src='images/cnhat.png' border=0></a>";
					}
					?></td>
					</tr>
				</table>
			    </form>
			</div>
		    </td>
		</tr><tr>
		    <td style="width:600px;" valign="top">
			<div class="list">
			    <div class="font-title"><div style="padding-top:5px;">Danh Sách Các Kho</div></div>
			    <div style="width:600px;">
				<table width="100%" border=0>
				    <tr><td style="border-bottom:1px solid #000000;font-weight:bold;color:#000000;" align="center">STT</td><td style="border-bottom:1px solid #000000;font-weight:bold;color:#000000;">Tên Kho</td><td align="center" style="color:#000000;border-bottom:1px solid #000000;font-weight:bold;">Địa Chỉ</td><td align="center" style="color:#000000;border-bottom:1px solid #000000;font-weight:bold;">Số Điện Thoại</td><td align="center" style="color:#000000;border-bottom:1px solid #000000;font-weight:bold;" colspan=2>Cập Nhật</td></tr>
				<?php
				    $str1="select * from kho_hang";
				    $sql1=mysql_query($str1);
				    $i=0;
				    while($row=mysql_fetch_assoc($sql1)){
					$i=$i+1;
					echo"<tr><td align='center' style='font-weight:bold;color:#000000;border-bottom:1px dotted #000000;'>".$i."</td><td style='color:#000000;border-bottom:1px dotted #000000;'>".$row['ten_kho']."</td><td style='font-style:italic;color:#000000;border-bottom:1px dotted #000000;'>".$row['dia_chi']." </td><td style='font-style:italic;color:#000000;border-bottom:1px dotted #000000;'>".$row['sdt']." </td><td style='border-bottom:1px dotted #000000;'><a href='khohang.php?control=delete&ma_kho=".$row['ma_kho']."' onclick=\"return check('".$row['ten_kho']."');\"><img src='images/delete-b.png' border=0></a></td><td style='border-bottom:1px dotted #000000;'><a href='khohang.php?control=edit&ma_kho=".$row['ma_kho']."'><img src='images/edit-b.png' border=0></a></td></tr>";
				    }
				?>
				</table>
			    </div>
			</div>
		    </td>
		    
		</tr>
	    </table>
	    </div>
        </div>
    </body>
</html>
<?php
    ob_end_flush();
?>