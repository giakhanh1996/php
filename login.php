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
//$login=1;
$username=$_POST['username'];
$password=$_POST['password'];
if($username!="" && $password!="")
{
    $str1="select ma_nv,tai_khoan,mat_khau,admin from nhanvien where tai_khoan='$username' and mat_khau='$password'";
    $sql1=mysql_query($str1);
    $row1=mysql_fetch_assoc($sql1);
    $row=mysql_num_rows($sql1);
    if($row==1)
    {
        if($row1['admin']=="admin")
        {
               // echo"ko sai";
                //session_register("admin");
                $_SESSION['admin']=$username;
                //$_SESSION['ma_nv']=$row1['ma_nv'];
                $login=1;
        }
        else
        {
            //session_register("manager_user");
            $_SESSION['manager_user']=$username;
            $_SESSION['ma_nv']=$row1['ma_nv'];
            header("location:index.php");
            $login=1;
            
        }
    }
    else
    {
        $dangnghap=0;
    }
}
?>
<html>
    <head>
        <title>
            O-| Dang Nhap He Thong
        </title>
    </head>
    <body style="text-align:center;">
        <?php
            if(isset($_SESSION['manager_user'])){
                echo"Ban dang su dung he thong, hay dang xuat ngay de tien hanh dang nhap lai.";
                echo"<a href='logout.php'><img src='dangxuat-bt.png'></a>";
            }
            else{
                if(!isset($_SESSION['manager_user'])&&$login==1)
                {
                        echo"<div style='width:500px;margin:0 auto;'>";
                        echo"<table border=0 cellspading=0 cellspacing=0 width='100%'>";
                        echo"<tr><td><img src='images/User-icon.png' height=200 ></td><td><img src='images/store-icon.jpg' height=200 ></td><td><img src='images/AdminIcon.jpg' height=200></td></tr>";
                        echo"<tr>";
                        echo"<td style='text-align:center;'>";
                        echo"<a href='phanquyen.php'>Quan Li Nguoi dung</a>";
                        echo"</td>";
                        echo"<td style='text-align:center;'>";
                        echo"<a href='quanlihanghoa.php'>Quan li ban hang</a>";
                        echo"</td>";
                        echo"<td style='text-align:center;'>";
                        echo"<a href='admin.php'>Thay Doi mat khau</a>";
                        echo"</td>";
                        echo"<table>";
                        echo"</div>";
                }
                else
                {
                    //if($chuyendoi==1)
                    //{
                        //if(isset($_SESSION['manager_user'])
                    
                    if(isset($username)){
                        if($dangnhap==0 ||$username=="")
                        {
                    echo"<script type='text/javascript'>alert('Username or password khong dung, vui long nhap lai!')</script>";
                    }
                    }
                    echo"<div style='margin:0 auto;text-align:left;width:360px;height:150px;background-image:url(images/dropshawdow-login.png);'>";
                    echo"<div style='border:1px solid #000000;width:350px;height:140px;background:#b5b4b4;'>";
                    echo"<div style='background-image:url(images/login-title-back.png)'>";
                    echo"<table border=0 cellpadding=0 cellspacing=0>";
                    echo"<tr><td style='height:30px;'><img src='images/login_icon.png' height=25></td><td style='font-family:sans-serif;font-size:13px;font-weight:bold;'>He Thong Dang Nhap</td></tr>";
                    echo"</table>";
                    echo"</div>";
                    echo"<div>";
                    echo"<table border=0 cellpadding=0 cellspacing=0>";
                    echo"<tr>";
                    echo"<td><img src='images/user-login.png' height=110></td>";
                    echo"<td><div><form action='login.php' method='POST' style='margin:0;padding:0'><table border=0 cellpadding=0 cellspacing=0>";
                    echo"<tr><td style='font-family:sans-serif;font-size:13px;'>Username : </td><td><input type='text' name='username' style='width:150px;'></td></tr>";
                    echo"<tr><td style='font-family:sans-serif;font-size:13px;'>Password : </td><td><input type='password' name='password' style='width:150px;'></td></tr>";
                    echo"<tr><td colspan=2 style='font-family:sans-serif;font-size:13px;'><input type='checkbox'>Ghi nho</td></tr>";
                    echo"<tr><td colspan=2><input type='submit' value='Dang Nhap'><input type='reset' value='lam lai'></td></tr>";
                    echo"</table></form></div></td>";
                    echo"</tr>";
                    echo"</table>";
                    echo"</div>";
                    echo"</div>";
                    echo"</div>";
                   // }
                }
            }
            
        ?>
    </body>
</html>
<?php
ob_end_flush();
?>