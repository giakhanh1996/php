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
if(isset($_SESSION['ma_nv']))
{
    $manv=$_SESSION['ma_nv'];
$str="select a.ma_cv, b.ma_nhom from nhanvien a, nhom_quyen b where a.ma_cv=b.ma_cv and ma_nv='$manv'";
$sql=mysql_query($str);
$row=mysql_fetch_assoc($sql);
$q_h=$row['ma_nhom'];

}
if(isset($_GET['taokk']))
{
    //$tao=$_GET['taokk'];
    $str="insert into kiemke(kk) values(1)";
    mysql_query($str);
    header("location:quanlihanghoa.php");
}
if(isset($_GET['kiemke']) && $_GET['kiemke']=="kk")
{
    //$tao=$_GET['taokk'];
    $str="update kiemke set kk=0";
    mysql_query($str);
    header("location:quanlihanghoa.php");
}
if(isset($_GET['kiemke']) && $_GET['kiemke']=="kh")
{
    //$tao=$_GET['taokk'];
    $str="update kiemke set kk=1";
    mysql_query($str);
    header("location:quanlihanghoa.php");
}
?>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
            Quản Lí Hàng Hóa
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" language="javascript" src="script.js"></script>
        <script type="text/javascript">
            function setvt(){
                var get=document.getElementById("giohang");
                var w;
                if(window.innerHeight){
                    w=window.innerWidth-220;
                }
                else{
                    w=document.body.clientWidth-220;
                }
                get.style.top=100;
                get.style.left=w;
            }
        </script>
    </head>
    <body class="body" onload="setvt();">
        
        <div class="header">
            <table align="right" border=0 cellpadding=0 cellspacing=0><tr><td style="font-family:sans-serif;font-size:13px;"><div><table border=0 cellpadding=0 cellspacing=0><tr><td class="show-left"></td><td class="show-center"><?php if(isset($_SESSION['manager_user'])){echo"Xin Chao ".$_SESSION['manager_user']; } if(isset($_SESSION['admin'])){echo"Xin Chao <a href='login.php'>".$_SESSION['admin']."</a>"; }?></td><td class="show-right"></td></tr></table></div></td><td><div><table border=0 cellpadding=0 cellspacing=0><tr><td class="show-left"></td><td class="show-center"><a href="logout.php" style="font-family:sans-serif;font-size:13px;text-decoration:none;color:#ffffff;font-weight:bold;">Dang Xuat</a></td><td class="show-right"></td></tr></table></div></td></tr></table>
        </div>
        <?php
        $strmm="select * from kiemke";
        $sqlmm=mysql_query($strmm);
        $rowmm=mysql_num_rows($sqlmm);
        $roo=mysql_fetch_assoc($sqlmm);
        $str3="select * from cap_quyen where ma_nhom='$q_h'";
        $sql3=mysql_query($str3);
       
        while($row3=mysql_fetch_assoc($sql3))
        {
            if($row3['quyen']==7)
            {
                if($rowmm < 1)
                {
                    echo"<div id='giohang' style='width:200px;background:#b4cdfb;position:absolute;border:1px solid #6c9ef9;'><table width='100%'><tr><td align='center'><a href='quanlihanghoa.php?taokk=1' style='text-decoration:none;display:block;color:#6c9ef9;font-weight:bold;font-size:13px;font-family:sans-serif;'>Tạo Chức Năng Kiểm Kê</a></td></tr></table></div>";
                }
                else
                {
                    if($roo['kk']==1)
                    {
                        echo"<div id='giohang' style='width:200px;background:#b4cdfb;position:absolute;border:1px solid #6c9ef9;'><table width='100%'><tr><td align='center'><a href='quanlihanghoa.php?kiemke=kk' style='text-decoration:none;display:block;color:#6c9ef9;font-weight:bold;font-size:13px;font-family:sans-serif;'>Mở Chức Năng Kiểm Kê</a></td></tr></table></div>";
                    }
                    else
                    {
                        echo"<div id='giohang' style='width:200px;background:#b4cdfb;position:absolute;border:1px solid #6c9ef9;'><table width='100%'><tr><td align='center'><a href='quanlihanghoa.php?kiemke=kh' style='text-decoration:none;display:block;color:#6c9ef9;font-weight:bold;font-size:13px;font-family:sans-serif;'>Đóng Chức Năng Kiểm Kê</a></td></tr></table></div>";
                    }
                }
            }
        }
        
        ?>
        <div class="navigator">
            <table border=0 cellpadding=0 cellspacing=0>
                <tr id="main_menu">
                    <td><div><table border=0 cellpadding=0 cellspacing=0><tr><td class="left-bt2"></td><td class="center-bt2"><a href="index.php" style="color: white; font-weight: bold;display: block;">Trang Chu</a></td><td class="right-bt2"></td></tr></table></div></td>
                    <td><div id="menu1" onClick="tab_menu('menu1');"><table border=0 cellpadding=0 cellspacing=0><tr><td id="left_menu" class="left-bt"></td><td id="center_menu" class="center-bt">Quản Lí Kho Hàng</td><td id="right_menu" class="right-bt"></td></tr></table></div></td>
                    <td><div id="menu2" onClick="tab_menu('menu2');"><table border=0 cellpadding=0 cellspacing=0><tr><td id="left_menu" class="left-bt"></td><td id="center_menu" class="center-bt">Quản Lí Hàng Hóa</td><td id="right_menu" class="right-bt"></td></tr></table></div></td>
                    <td><div id="menu3" onClick="tab_menu('menu3');"><table border=0 cellpadding=0 cellspacing=0><tr><td id="left_menu" class="left-bt"></td><td id="center_menu" class="center-bt">Quản Lí Nhân Viên</td><td id="right_menu" class="right-bt"></td></tr></table></div></td>
                    <td><div id="menu4" onClick="tab_menu('menu4');"><table border=0 cellpadding=0 cellspacing=0><tr><td id="left_menu" class="left-bt"></td><td id="center_menu" class="center-bt">Quản Lí Thu Chi</td><td id="right_menu" class="right-bt"></td></tr></table></div></td>
                    
                </tr>
            </table>
        </div>
            
        <div class="area-title" id="sub_menu">
            <div id="menu1_sub" style="display:none;">
                <?php
                
                    $str3="select * from cap_quyen where ma_nhom='$q_h'";
                    $sql3=mysql_query($str3);
                    echo"<table border=0 cellpadding=0 cellspacing=0><tr>";
                    while($row3=mysql_fetch_assoc($sql3))
                    {
                        if($row3['quyen']==1)
                        {
                            echo"<td><div id='sub1'><table border=0 cellpadding=0 cellspacing=0><tr><td class='main_back' onMouseOver=\"sub_mouseover('menu1_sub','sub1')\" onMouseOut=\"sub_mouseout('menu1_sub','sub1')\" onClick=\"sub_mouseclick('menu1_sub','sub1','khohang.php')\">Kho Hàng</td><td class='right_back'></td></tr></table></div></td>";
                        }
                        if($row3['quyen']==2)
                        {
                            echo"<td><div id='sub2'><table border=0 cellpadding=0 cellspacing=0><tr><td class='normal' onMouseOver=\"sub_mouseover('menu1_sub','sub2')\" onMouseOut=\"sub_mouseout('menu1_sub','sub2')\" onClick=\"sub_mouseclick('menu1_sub','sub2','nhapkho.php')\">Nhập Kho</td><td class='right_normal'></td></tr></table></div></td>";
                        }
                        if($row3['quyen']==6)
                        {
                            echo"<td><div id='sub3'><table border=0 cellpadding=0 cellspacing=0><tr><td class='normal' onMouseOver=\"sub_mouseover('menu1_sub','sub3')\" onMouseOut=\"sub_mouseout('menu1_sub','sub3')\" onClick=\"sub_mouseclick('menu1_sub','sub3','xuatkho.php')\">Xuất Kho</td><td class='right_normal'></td></tr></table></div></td>";
                        }
                        if($row3['quyen']==3)
                        {
                            echo"<td><div id='sub4'><table border=0 cellpadding=0 cellspacing=0><tr><td class='normal' onMouseOver=\"sub_mouseover('menu1_sub','sub4')\" onMouseOut=\"sub_mouseout('menu1_sub','sub4')\" onClick=\"sub_mouseclick('menu1_sub','sub4','nhacungcap.php')\">Quản Lí Nhà Cung Cấp</td><td class='right_normal'></td></tr></table></div></td>";
                        }
                    }
                    echo"<td><div id='sub5'><table border=0 cellpadding=0 cellspacing=0><tr><td class='normal' onMouseOver=\"sub_mouseover('menu1_sub','sub5')\" onMouseOut=\"sub_mouseout('menu1_sub','sub5')\" onClick=\"sub_mouseclick('menu1_sub','sub5','thongke.php')\">Thong Ke Kho Hang</td><td class='right_normal'></td></tr></table></div></td>";
                    echo"</tr></table>";
                ?>
            </div>
            <div id="menu2_sub" style="display:none;">
                <table border=0 cellpadding=0 cellspacing=0><tr>
                <?php
                    $str3="select * from cap_quyen where ma_nhom='$q_h'";
                    $sql3=mysql_query($str3);
                    while($row3=mysql_fetch_assoc($sql3))
                    {
                        if($row3['quyen']==4)
                        {
                            echo"<td><div id='sub6'><table border=0 cellpadding=0 cellspacing=0><tr><td class='main_back' onMouseOver=\"sub_mouseover('menu2_sub','sub6')\" onMouseOut=\"sub_mouseout('menu2_sub','sub6')\" onClick=\"sub_mouseclick('menu2_sub','sub6','themhang.php')\">Thêm Mặt Hàng</td><td class='right_back'></td></tr></table></div></td>";
                        }
                    }
                    echo"<td><div id='sub7'><table border=0 cellpadding=0 cellspacing=0><tr><td class='normal' onMouseOver=\"sub_mouseover('menu2_sub','sub7')\" onMouseOut=\"sub_mouseout('menu2_sub','sub7')\" onClick=\"sub_mouseclick('menu2_sub','sub7','quanlidondathang.php')\">Quan Li Don Dat Hang</td><td class='right_normal'></td></tr></table></div></td>";
                ?>
                </tr></table>
            </div>
            <div id="menu3_sub" style="display:none;">
                <table border=0 cellpadding=0 cellspacing=0><tr>
                <?php
                    $str3="select * from cap_quyen where ma_nhom='$q_h'";
                    $sql3=mysql_query($str3);
                    while($row3=mysql_fetch_assoc($sql3))
                    {
                        if($row3['quyen']==5)
                        {
                            echo"<td><div id='sub8'><table border=0 cellpadding=0 cellspacing=0><tr><td class='main_back' onMouseOver=\"sub_mouseover('menu3_sub','sub8')\" onMouseOut=\"sub_mouseout('menu3_sub','sub8')\" onClick=\"sub_mouseclick('menu3_sub','sub8','nhanvien.php')\">Thêm Nhân Viên</td><td class='right_back'></td></tr></table></div></td>";
                        }
                    }
                ?>
                </tr></table>
            </div>
            <div id="menu4_sub" style="display:none;">
                <table border=0 cellpadding=0 cellspacing=0><tr>
                <?php
                    echo"<td><div id='sub9'><table border=0 cellpadding=0 cellspacing=0><tr><td class='main_back' onMouseOver=\"sub_mouseover('menu4_sub','sub9')\" onMouseOut=\"sub_mouseout('menu4_sub','sub9')\" onClick=\"sub_mouseclick('menu4_sub','sub9','thuchi.php')\">Quầy Thu - Chi</td><td class='right_back'></td></tr></table></div></td>";
                    echo"<td><div id='sub11'><table border=0 cellpadding=0 cellspacing=0><tr><td class='normal' onMouseOver=\"sub_mouseover('menu4_sub','sub11')\" onMouseOut=\"sub_mouseout('menu4_sub','sub11')\" onClick=\"sub_mouseclick('menu4_sub','sub11','hoadonbanhang.php')\">Lập Hóa Đơn Bán Hàng</td><td class='right_normal'></td></tr></table></div></td>";
                ?>
                </tr></table>
            </div>
        </div>
        
        <div class="main">
            <div>
                <iframe src="introduce.php" name="work_frame" id="work_frame" height="100%" width="100%" frameborder=0>
            </div>
        </div>
        <div class="footer">
            
        </div>
    </body>
</html>
<?php
ob_end_flush();
?>