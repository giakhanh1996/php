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
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
            Cửa hàng bách hóa tổng hợp..
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src="script.js"></script>
        <script type="text/javascript">
         function mover(id_tr){
            var gtr=document.getElementById(id_tr);
            var gg=gtr.getElementsByTagName("a");
            for(i=0;i<gg.length;i++){
                gg[i].style.color="#ffffff";
                
            }
            gtr.style.background="#feb402";
         }
         function mout(id_tr){
            var gtr=document.getElementById(id_tr);
            var gg=gtr.getElementsByTagName("a");
            for(i=0;i<gg.length;i++){
                gg[i].style.color="blue";
                
            }
            gtr.style.background="#9ebed2";
         }
         function setvt(){
            var get=document.getElementById("giohang");
            var w;
            if(window.innerHeight){
                w=window.innerWidth-170;
            }
            else{
                w=document.body.clientWidth-170;
            }
            get.style.top=125;
            get.style.left=w;
         }
         
        </script>
    </head>
    <body style="background-image: url(images/background-index.png);background-repeat: repeat-x;background-attachment: fixed;margin: 0;" onload="Clock2();setvt();">
        <div>
            <!--<a href="quanlihanghoa.php">Quan Li Ban hang</a>-->
            <div class="banner-index"><table width="100%" border=0 cellpadding=0 cellspacing=0><tr><td style="height: 35px;">&nbsp;</td><td style="width: 270px;"><div style="background-image: url(images/bcf.png);background-repeat:no-repeat;width: 270px;height:35px;">
            <?php
                if(isset($_SESSION['admin']) || isset($_SESSION['manager_user']))
                {
                    echo"<table border=0 cellpadding=0 cellspacing=0 width='100%' align='right'><tr><td style='height:35px;' align='right'>Xin Chao <a href='quanlihanghoa.php' style='text-decoration:none;color:#ffffff;padding:3px 10px 3px 10px;background:blue;'>".$_SESSION['admin'].$_SESSION['manager_user']."</td><td><a href='logout.php' style='text-decoration:none;color:#ffffff;margin-left:10px;padding:3px 10px 3px 10px;background:blue;'>Dang Xuat</a></td></tr></table>";
                }
                else
                {
                    echo"<form action='login.php' method='POST' name='fr'>";
                        echo"<table width='100%' border=0 cellpadding=0 cellspacing=0>";
                            echo"<tr>";
                                echo"<td style='font-family: sans-serif;font-size: 10px;height:35px;width:10px;'></td>";
                                echo"<td valign='middle'>";
                                    echo"<input type='text' name='username' value='Tai Khoan' style='width: 70px;font-family: sans-serif;font-size: 10px;color: #bfc1c1;' onfocus=\"document.fr.username.value='';\"/>";
                                echo"</td>";
                                echo"<td style='font-family: sans-serif;font-size: 10px;'></td>";
                                echo"<td>";
                                    echo"<input type='password' name='password' value='Mat Khau' style='width: 70px;font-family: sans-serif;font-size: 10px;color: #bfc1c1;' onfocus=\"document.fr.password.value='';\" />";
                                echo"</td>";
                                echo"<td>";
                                    echo"<input type='submit' value='Dang Nhap' /></td>";
                            echo"</tr>";
                        echo"</table>";
                    echo"</form>";
                }
            ?>
            </div></td></tr></table></div>
            <div class="ds"><table border=0 cellpadding=0 cellspacing=0><tr><td style="width:20px;"></td><td align="center" style="height:35px;color:#490207;font-family:sans-serif;font-weight:bold;background-image:url(images/bcg2.png);background-repeat:repeat-x;width:100px;"><a href="index.php" style="text-decoration:none;color:#6f0702;">Trang chu</a></td></tr></table></div>
            <div class="main-index">
                <table width="100%" cellpadding=0 cellspacing=0>
                    <tr>
                        <td style="width:200px;" valign="top">
                            <div>
                                <table border=1 cellspacing=2 cellpadding=4 width="100%">
                                    <tr style="background:#0059c8;color:#ffffff;"><td style="font-family:sans-serif;font-weight:bold;">Danh muc hang hoa</td></tr>
                                    <?php
                                        $str="select * from loai_hang";
                                        $sql=mysql_query($str);
                                        $i=0;
                                        while($row=mysql_fetch_assoc($sql))
                                        {
                                            $i=$i+1;
                                            echo"<tr style='background:#9ebed2;' id='tr".$i."' onmouseover=\"mover('tr".$i."')\" onmouseout=\"mout('tr".$i."')\"><td style='font-family:arial;font-size:12px;'><a href='index.php?id_loai=".$row['ma_loai']."' style='color:blue;display:block;padding-left:10px;'>".ucwords($row['ten_loai'])."</a></td></tr>";
                                        }
                                    ?>
                                </table>
                            </div>
                            <div style="margin-top:10px;">
                                    <table border=1 cellspacing=2 cellpadding=4 width="100%">
                                        <tr style="background:#0059c8;color:#ffffff;"><td style="font-family:sans-serif;font-weight:bold;">Tim Kiem</td></tr>
                                        <tr style="background:#9ebed2;"><td><div><table border=0 cellpadding=0 cellspacing=0><tr><td width=30><img src="images/search.png" height=25></td><td>Tim theo gia</td></tr></table></div></td></tr>
                                        <tr>
                                            <td>
                                                <form action="index.php?searchkey=1" method="post" style="margin:0;padding:0;">
                                                    <div>
                                                        <table border=0 cellpadding=0 cellspacing=0 width="100%">
                                                            <tr>
                                                                <td style="width:40px;">Tu : </td>
                                                                <td>
                                                                    <select name="gia1" style="width:150px;">
                                                                        <option value="0">< 10.000</option>
                                                                        <option value="10000">10.000</option>
                                                                        <option value="100000">100.000</option>
                                                                        <option value="1000000">1.000.000</option>
                                                                        <option value="10000000">10.000.000</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div style="margin-top:5px;margin-bottom:5px;">
                                                        <table border=0 cellpadding=0 cellspacing=0 width="100%">
                                                            <tr>
                                                                <td style="width:40px;">Den : </td>
                                                                <td>
                                                                    <select name="gia2" style="width:150px;">
                                                                        <option value="100000">100.000</option>
                                                                        <option value="1000000">1.000.000</option>
                                                                        <option value="10000000">10.000.000</option>
                                                                        <option value="100000000">100.000.000</option>
                                                                        <option value="lager">> 100.000.000</option>
                                                                    </select>
                                                                </td>
                                                                </tr>
                                                        </table>
                                                    </div>
                                                    <input type="submit" value="Tim kiem">
                                                </form>
                                            </td>
                                        </tr>
                                        <tr style="background:#9ebed2;"><td><div><table border=0 cellpadding=0 cellspacing=0><tr><td width=30><img src="images/search.png" height=25></td><td>Tim theo ten SP'</td></tr></table></div></td></tr>
                                        <tr><td>
                                            <form action="index.php" method="POST" style="margin:0;padding:0;" name="tk">
                                                <input type="text" name="ten_sp" value="-- Nhap ten san pham --" style="width:115px;font-family:sans-serif;font-size:10px;color:#a1a4a4" onfocus="document.tk.ten_sp.value='';"><input type="submit" value="Tim kiem" style="font-family:sans-serif;font-size:10px;">
                                            </form>
                                        </td></tr>
                                    </table>
                            </div>
                        </td>
                        <td valign="top">
                            <div>
                                <table border=1 cellspacing=2 cellpadding=4 width="100%">
                                    <tr style="background:#0059c8;color:#ffffff;"><td style="font-family:sans-serif;font-weight:bold;" colspan="5">Danh sach hang hoa
                                    <?php
                                        if(isset($_POST['gia1']) && isset($_POST['gia2']))
                                        {
                                            echo"<span><b>[</b> Có giá ".$_POST['gia1']." - ".$_POST['gia2']." <b>]</b></span>";
                                        }
                                    ?>
                                    </td></tr>
                                    <?php
                                        $ma_loai=$_GET['id_loai'];
                                        $gia1=$_POST['gia1'];
                                        $gia2=$_POST['gia2'];
                                        if(isset($ma_loai))
                                        {
                                            $str="select * from loai_hang where ma_loai='$ma_loai'";
                                            $sql=mysql_query($str);
                                            $i=0;
                                            while($row=mysql_fetch_assoc($sql))
                                            {
                                                $i=$i+1;
                                                $ma_loai2=$row['ma_loai'];
                                                echo"<tr style='background:#9ebed2;'><td style='font-family:arial;font-size:12px;' colspan=5><b>".ucwords($row['ten_loai'])."</b></td></tr>";
                                                echo"<tr>";
                                                $str2="select b.ten_hang, hinh_anh, b.don_gia, b.ma_hang, a.so_luong from kho_tt a, mat_hang b, loai_hang c where a.ma_hang = b.ma_hang and b.ma_loai = c.ma_loai and c.ma_loai='$ma_loai2'";
                                                $sql2=mysql_query($str2);
                                                $j=0;
                                                while($row2=mysql_fetch_assoc($sql2))
                                                {
                                                    
                                                    $j=$j+1;
                                                    if($j%5==0)
                                                    {
                                                        if($row2['so_luong'] <= 0)
                                                        {
                                                            echo"<td align='center'><div style='width: 140px;position:relative;'><div style='position:absolute;top:0;left:10;'><img src='images/sold-out-icon.gif'></div><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=70 width=90></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format($row2['don_gia'],0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><img src='images/dat_hang2.png' border=0></div></td></tr></table></div></td></tr><tr>";
                                                        }
                                                        else
                                                        {
                                                            echo"<td align='center'><div style='width: 120px;'><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=60 width=80></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format(($row2['don_gia']+($row2['don_gia']*0.1)),0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><a href='giohang.php?ma_hang=".$row2['ma_hang']."&dat_hang=1' style='text-decoration:none'><img src='images/dat_hang.png' border=0></a></div></td></tr></table></div></td></tr><tr>";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if($row2['so_luong'] <= 0)
                                                        {
                                                            echo"<td align='center'><div style='width: 140px;position:relative;'><div style='position:absolute;top:0;left:10;'><img src='images/sold-out-icon.gif'></div><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=70 width=90></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format($row2['don_gia'],0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><img src='images/dat_hang2.png' border=0></div></td></tr></table></div></td>";
                                                        }
                                                        else
                                                        {
                                                            echo"<td align='center'><div style='width: 120px;'><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=60 width=80></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format(($row2['don_gia']+($row2['don_gia']*0.1)),0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><a href='giohang.php?ma_hang=".$row2['ma_hang']."&dat_hang=1' style='text-decoration:none'><img src='images/dat_hang.png' border=0></a></div></td></tr></table></div></td>";
                                                        }
                                                    }
                                                }
                                                echo"</tr>";
                                            }
                                        }
                                        else
                                        {
                                            if(isset($_POST['gia1']) && isset($_POST['gia2']))
                                            {
                                                echo"<tr>";
                                                $str2="select b.ten_hang, hinh_anh, b.don_gia, b.ma_hang, a.so_luong from kho_tt a, mat_hang b, loai_hang c where a.ma_hang = b.ma_hang and b.ma_loai = c.ma_loai and b.don_gia BETWEEN '$gia1' and '$gia2'";
                                                $sql2=mysql_query($str2);
                                                $j=0;
                                                while($row2=mysql_fetch_assoc($sql2))
                                                {
                                                   
                                                    $j=$j+1;
                                                    if($j%5==0)
                                                    {
                                                        if($row2['so_luong'] <= 0)
                                                        {
                                                            echo"<td align='center'><div style='width: 140px;position:relative;'><div style='position:absolute;top:0;left:10;'><img src='images/sold-out-icon.gif'></div><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=70 width=90></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format($row2['don_gia'],0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><img src='images/dat_hang2.png' border=0></div></td></tr></table></div></td></tr><tr>";
                                                        }
                                                        else
                                                        {
                                                            echo"<td align='center'><div style='width: 120px;'><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=60 width=80></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format(($row2['don_gia']+($row2['don_gia']*0.1)),0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><a href='giohang.php?ma_hang=".$row2['ma_hang']."&dat_hang=1' style='text-decoration:none'><img src='images/dat_hang.png' border=0></a></div></td></tr></table></div></td></tr><tr>";
                                                        }
                                                    }
                                                    else
                                                    {
                                                        if($row2['so_luong'] <= 0)
                                                        {
                                                            echo"<td align='center'><div style='width: 140px;position:relative;'><div style='position:absolute;top:0;left:10;'><img src='images/sold-out-icon.gif'></div><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=70 width=90></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format($row2['don_gia'],0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><img src='images/dat_hang2.png' border=0></div></td></tr></table></div></td>";
                                                        }
                                                        else
                                                        {
                                                            echo"<td align='center'><div style='width: 120px;'><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=60 width=80></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format(($row2['don_gia']+($row2['don_gia']*0.1)),0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><a href='giohang.php?ma_hang=".$row2['ma_hang']."&dat_hang=1' style='text-decoration:none'><img src='images/dat_hang.png' border=0></a></div></td></tr></table></div></td>";
                                                        }
                                                    }
                                                }
                                                echo"</tr>";
                                            }
                                            else
                                            {
                                                if(isset($_POST['ten_sp']))
                                                {
                                                    $ten_sp=$_POST['ten_sp'];
                                                    echo"<tr>";
                                                    $str2="select b.ten_hang, hinh_anh, b.don_gia, b.ma_hang, a.so_luong from kho_tt a, mat_hang b, loai_hang c where a.ma_hang = b.ma_hang and b.ma_loai = c.ma_loai and b.ten_hang like '%$ten_sp%'";
                                                    $sql2=mysql_query($str2);
                                                    $j=0;
                                                    while($row2=mysql_fetch_assoc($sql2))
                                                    {
                                                       
                                                        $j=$j+1;
                                                        if($j%5==0)
                                                        {
                                                            if($row2['so_luong'] <= 0)
                                                            {
                                                                echo"<td align='center'><div style='width: 140px;position:relative;'><div style='position:absolute;top:0;left:10;'><img src='images/sold-out-icon.gif'></div><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=70 width=90></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format($row2['don_gia'],0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><img src='images/dat_hang2.png' border=0></div></td></tr></table></div></td></tr><tr>";
                                                            }
                                                            else
                                                            {
                                                                echo"<td align='center'><div style='width: 120px;'><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=60 width=80></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format(($row2['don_gia']+($row2['don_gia']*0.1)),0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><a href='giohang.php?ma_hang=".$row2['ma_hang']."&dat_hang=1' style='text-decoration:none'><img src='images/dat_hang.png' border=0></a></div></td></tr></table></div></td></tr><tr>";
                                                            }
                                                        }
                                                        else
                                                        {
                                                            if($row2['so_luong'] <= 0)
                                                            {
                                                                echo"<td align='center'><div style='width: 140px;position:relative;'><div style='position:absolute;top:0;left:10;'><img src='images/sold-out-icon.gif'></div><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=70 width=90></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format($row2['don_gia'],0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><img src='images/dat_hang2.png' border=0></div></td></tr></table></div></td>";
                                                            }
                                                            else
                                                            {
                                                                echo"<td align='center'><div style='width: 120px;'><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=60 width=80></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format(($row2['don_gia']+($row2['don_gia']*0.1)),0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><a href='giohang.php?ma_hang=".$row2['ma_hang']."&dat_hang=1' style='text-decoration:none'><img src='images/dat_hang.png' border=0></a></div></td></tr></table></div></td>";
                                                            }
                                                        }
                                                    }
                                                    echo"</tr>";
                                                }
                                                else
                                                {
                                                    $str="select * from loai_hang";
                                                    $sql=mysql_query($str);
                                                    $i=0;
                                                    while($row=mysql_fetch_assoc($sql))
                                                    {
                                                        $i=$i+1;
                                                        $ma_loai2=$row['ma_loai'];
                                                        echo"<tr style='background:#9ebed2;'><td style='font-family:arial;font-size:12px;' colspan=5><b>".ucwords($row['ten_loai'])."</b></td></tr>";
                                                        echo"<tr>";
                                                        $str2="select b.ten_hang, hinh_anh, b.don_gia, b.ma_hang, a.so_luong from kho_tt a, mat_hang b, loai_hang c where a.ma_hang = b.ma_hang and b.ma_loai = c.ma_loai and c.ma_loai='$ma_loai2' limit 0,10";
                                                        $sql2=mysql_query($str2);
                                                        $diem=mysql_num_rows($sql2);
                                                        $j=0;
                                                        while($row2=mysql_fetch_assoc($sql2))
                                                        {
                                                            
                                                            $j=$j+1;
                                                            if($j%5==0)
                                                            {
                                                                if($row2['so_luong'] <= 0)
                                                                {
                                                                    echo"<td align='center'><div style='width: 140px;position:relative;'><div style='position:absolute;top:0;left:10;'><img src='images/sold-out-icon.gif'></div><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=70 width=90></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format($row2['don_gia'],0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><img src='images/dat_hang2.png' border=0></div></td></tr></table></div></td></tr><tr>";
                                                                }
                                                                else
                                                                {
                                                                    echo"<td align='center'><div style='width: 120px;'><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=60 width=80></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format(($row2['don_gia']+($row2['don_gia']*0.1)),0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><a href='giohang.php?ma_hang=".$row2['ma_hang']."&dat_hang=1' style='text-decoration:none'><img src='images/dat_hang.png' border=0></a></div></td></tr></table></div></td></tr><tr>";
                                                                }
                                                            }
                                                            else
                                                            {
                                                                if($row2['so_luong'] <= 0)
                                                                {
                                                                    echo"<td align='center'><div style='width: 140px;position:relative;'><div style='position:absolute;top:0;left:10;'><img src='images/sold-out-icon.gif'></div><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=70 width=90></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format($row2['don_gia'],0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><img src='images/dat_hang2.png' border=0></div></td></tr></table></div></td>";
                                                                }
                                                                else
                                                                {
                                                                    echo"<td align='center'><div style='width: 120px;'><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=60 width=80></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format(($row2['don_gia']+($row2['don_gia']*0.1)),0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><a href='giohang.php?ma_hang=".$row2['ma_hang']."&dat_hang=1' style='text-decoration:none'><img src='images/dat_hang.png' border=0></a></div></td></tr></table></div></td>";
                                                                }
                                                            }
                                                        }
                                                        echo"</tr>";
                                                        if($diem >= 10)
                                                        {
                                                            echo"<tr><td colspan=5 align='right'><a href='index.php?id_loai=".$row['ma_loai']."'>Xem them...</a></td></tr>";
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        
                                        
                                    ?>
                                </table>
                            </div>
                        </td>
                        <td valign="top" style="width:200px;">
                            <div>
                                <table border=1 cellspacing=2 cellpadding=4 width="100%">
                                    <tr style="background:#0059c8;color:#ffffff;"><td style="font-family:sans-serif;font-weight:bold;"><div><table border=0 cellpadding=0 cellspacing=0><tr><td style="font-family:sans-serif;font-weight:bold;color:#ffffff;">Hang moi ve</td><td><img src="images/new.gif" height=20></td></tr></table></div></td></tr>
                                </table>
                            </div>
                            <div style="height: 30px; background:url(images/dongho.png); color: blue; font-weight: bold; font-family: sans-serif;">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td style="height: 30px;width: 35px;" align="center"><img src="images/clock.png" height="25px"></td><td id="clock" style="font-family: sans-serif; font-weight: bold;" align="center"></td></tr></table>
                            </div>
                            <div style="text-align:center;">
                                <table width="194px" align="center">
                                    <?php
                                        $str2="select b.ten_hang, hinh_anh, b.don_gia, b.ma_hang, a.so_luong from kho_tt a, mat_hang b, loai_hang c where a.ma_hang = b.ma_hang and b.ma_loai = c.ma_loai order by ngay_nhap desc limit 5";
                                        $sql2=mysql_query($str2);
                                        $j=0;
                                        while($row2=mysql_fetch_assoc($sql2))
                                        {
                                            if($row2['so_luong'] <= 0)
                                            {
                                                echo"<tr><td align='center' style='border:1px solid #000000;'><div style='width: 120px;'><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=60 width=80></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format($row2['don_gia'],0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><img src='images/dat_hang2.png' border=0></div></td></tr></table></div></td></tr>";
                                            }
                                            else
                                            {
                                                echo"<tr><td align='center' style='border:1px solid #000000;'><div style='width: 120px;'><table><tr><td align='center'><img src='anh_sp/".$row2['hinh_anh']."' height=60 width=80></td></tr><tr><td align='center' style='color:blue;font-family:sans-serif;font-size:13px;'>".$row2['ten_hang']."</td></tr><tr><td align='center' style='color:red;font-family:sans-serif;font-size:11px;'>".number_format($row2['don_gia'],0)." VND</td></tr><tr><td align='center'><div style='width:100px;'><a href='giohang.php?ma_hang=".$row2['ma_hang']."&dat_hang=1' style='text-decoration:none'><img src='images/dat_hang.png' border=0></a></div></td></tr></table></div></td></tr>";
                                            }
                                        }
                                    ?>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
                
            </div>
            <?php
                if(isset($_SESSION['mat_hang']))
                {
                    echo"<div id='giohang' style='width:150px;background:#b4cdfb;position:absolute;border:1px solid #6c9ef9;'><table width='100%'><tr><td align='center'><a href='giohang.php' style='text-decoration:none;display:block;color:#6c9ef9;font-weight:bold;font-size:13px;font-family:sans-serif;'>Xem gio hang</a></td></tr></table></div>";
                }
            ?>
            <div class="footer-index">
                
                <table width="100%"><tr><td align="center" style="color:#ffffff;"><b>Công Ty TNHH MTN</b><br>Địa Chỉ : 164, Đường Lý Tự Trọng, Q.Ninh Kiều, TP.Cần Thơ.<br>Điện Thọai : 01646345235.<br>Fax : 0773077099.</td></tr></table>
            </div>
        </div>
    </body>
</html>
<?php
ob_end_flush();
?>