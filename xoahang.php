<?php
session_start();
?>
<?php
ob_start();
?>
<?php
    require("connect.php");
    $ma_hang=$_GET['ma_hang'];
    $mang2=explode("-",$_SESSION['mat_hang']);
    $mh="";
    for($t=0;$t<count($mang2);$t++)
    {
        
        if($mang2[$t] != $ma_hang)
        {
            $mh=$mh."-".$mang2[$t];
        }
    }
    $sd=substr($mh,1,(strlen($mh)-1));
    //echo $sd;
    if($sd=="")
    {
        unset($_SESSION['mat_hang']);
        header("location:index.php");
    }
    else
    {
        unset($_SESSION['mat_hang']);
        $_SESSION['mat_hang']=$sd;
        header("location:giohang.php");
    }
    
?>
<?php
ob_end_flush();
?>