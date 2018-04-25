<?php
session_start();
?>
<?php
ob_start();
?>
<?php
require("doctien.php");
?>
<?php
    require("connect.php");
    if(isset($_GET['ma_hang']) && isset($_GET['dat_hang']))
    {
        $ma_hang=$_GET['ma_hang'];
        
        $str111="select * from mat_hang where ma_hang='$ma_hang'";
        $sql111=mysql_query($str111);
        $row111=mysql_fetch_assoc($sql111);
        $don_gia = $row111['don_gia'];
        $so_luong = 1;
        $don_vi_tinh = $row111['don_vi_tinh']; 
        if(isset($_SESSION['mat_hang']))
        {
            $trung=0;
            $mang1=explode("-",$_SESSION['mat_hang']);
            for($i=0;$i<count($mang1);$i++)
            {
                if($mang1[$i]==$ma_hang)
                {
                    $trung=1;
                }
            }
            if($trung==0)
            {
                $mat_hang= $_SESSION['mat_hang']."-".$ma_hang;
                unset($_SESSION['mat_hang']);
                $_SESSION['mat_hang']=$mat_hang;
                $s_l="so_luong".$ma_hang;
                $_SESSION[$s_l]=$so_luong;
                header("location:giohang.php");
            }
            if($trung==1)
            {
                $s_l="so_luong".$ma_hang;
                $so_luong=$_SESSION[$s_l]+1;
                $st12="select * from kho_tt where ma_hang='$ma_hang'";
                $sq12=mysql_query($st12);
                $ro12=mysql_fetch_assoc($sq12);
                if($so_luong > $ro12['so_luong'])
                {
                    $so_luong_hang="khongdu";
                }
                else
                {
                    unset($_SESSION[$s_l]);
                    $_SESSION[$s_l]=$so_luong;
                    header("location:giohang.php");
                }
            }
        }
        else
        {
            $mat_hang= $ma_hang;
            $_SESSION['mat_hang']=$mat_hang;
            if(!isset($_SESSION['so_luong']))
            {
                $s_l="so_luong".$ma_hang;
                $_SESSION[$s_l]=$so_luong;
                
            }
            header("location:giohang.php");
        }
        
    }
    else
    {}
    //echo $_SESSION['mat_hang'];
    //echo "so luong la ".$_SESSION[$s_l];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Dat Hang</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-image: url(images/background-index.png);background-repeat: repeat-x; text-align:center; background-attachment: fixed;margin: 0;">
    <div style="width: 1000px; margin: 0 auto;">
        <div class="banner-index"></div>
        <div class="ds"><table border=0 cellpadding=0 cellspacing=0><tr><td style="width:20px;"></td><td align="center" style="height:35px;color:#490207;font-family:sans-serif;font-weight:bold;background-image:url(images/bcg2.png);background-repeat:repeat-x;width:100px;"><a href="index.php" style="text-decoration:none;color:#6f0702;">Trang chu</a></td><td></td></tr></table></div>
        <div style="margin-top: 10px;">
            <div style="width:150px;border:2px solid #f37a05;background:#f8c56c;"><table border=0 cellpadding=0 cellspacing=0 width="100%"><tr><td align="center" style="width:37px;"><img src="images/icon_shopcart.png" height=30></td><td style="color:#e95903;height:34px;font-weight:bold;">Dat San Pham</td></tr></table></div>
            <form action="capnhatgiohang.php" method="post">
                <table width="100%" border=0 cellpadding=0 cellspacing=0><tr style="background:#9098fa;font-family:sans-serif;font-weight:bolder;font-size:14px;height:35px;color:#061092;">
                <td align="center">STT</td><td>Ten san pham</td><td>Gia</td><td>So luong</td><td>DVT</td><td align="center">Thanh tien</td><td align="center">Huy</td>
                </tr>
                <?php
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
                            echo"<tr style='background:#d1e7e9;height:25px;color:#343db0;font-family:sans-serif;font-size:13px;'><td align='center'>".$i."</td><td><input type='hidden' value='".$mang2[$t]."' name='ma[]'>".$row['ten_hang']."</td><td>".number_format(($row['don_gia']+($row['don_gia']*0.1)),0)."</td><td><input type='text' value='".$_SESSION[$sl]."' name='so_luong[]' style='width:70px;text-align:right;'></td><td>".$row['don_vi_tinh']."</td><td style='font-weight:bold;width:130px;' align='right'>".number_format($thanhtien,0)." <input type='button' value='VND' style='color:red;font-weight:bold;font-family:sans-serif;font-size:13px;'></td><td style='width:120px' align='center'><a href='xoahang.php?ma_hang=".$mang2[$t]."'><img src='images/Delete.png' border=0 height=20></a></td></tr>";
                        }
                        echo"<tr style='height:30px;'><td colspan=7 align='right'><i style='color:#343db0;font-family:sans-serif;font-size:13px;'>Tong tien : </i><b style='color:#343db0;font-family:sans-serif;font-size:13px;'>".number_format($tongtien,0)."</b> <input type='button' value='VND' style='color:red;font-weight:bold;font-family:sans-serif;font-size:13px;'></td></tr>";
                        echo"<trtr style='height:30px;'><td colspan=7 align='right'><i style='color:red;font-family:sans-serif;font-size:13px;'>Tổng tiền bằng chữ : ".docso($tongtien)." đồng</i></td></tr>";
                    }
                ?>
                <tr><td colspan=7 style="height:60px;" align="center"><input type="submit" value="Cap nhat" style="padding-left:10px;padding-right:10px;border:1px solid blue;background:#0099FF;color:#FFFFFF;margin-right:5px;"><a href='muahang.php' style="text-decoration:none;padding-left:10px;padding-right:10px;border:1px solid blue;background:#0099FF;color:#FFFFFF;margin-right:5px;">Mua hang</a><a href='index.php' style="text-decoration:none;padding-left:10px;padding-right:10px;border:1px solid blue;background:#0099FF;color:#FFFFFF;margin-right:5px;">Them hang</a><a href='huygiohang.php' style="text-decoration:none;padding-left:10px;padding-right:10px;border:1px solid blue;background:#0099FF;color:#FFFFFF;margin-right:5px;">Huy gio hang</a></td></tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>
<?php
ob_end_flush();
?>