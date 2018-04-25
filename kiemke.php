<?php
session_start();
?>
<?php
ob_start();
?>
<?php
/*
    if(!isset($_SESSION['manager_user'])  && !isset($_SESSION['admin'])){
        header("location:login.php");
    }*/
?>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
            Chức Năng Kiểm Kê.
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" language="javascript" src="script.js"></script>
    </head>
    <body style="margin:0;padding:0;text-align:center;">
        <div style="margin-top:20px;">
            <table width="100%" cellpadding=0 cellspacing=0><tr><td style="border-bottom:2px solid red;border-top:2px solid red;border-left:2px solid red;width:70px;background:#fbcfd0;"><img src="images/lifecycle.gif" height=60></td><td style="border-bottom:2px solid red;border-top:2px solid red;border-right:2px solid red;font-family:sans-serif;font-size:14px;color:red;height:60px;background:#fbcfd0;">Chức năng kiểm kê đang hoạt động,<br/> Tất cả các hoạt động bán hàng và nhập hàng đã bị khóa. Vui lòng quay trở lại sau !!</td></tr></table>
            
        </div>
        <div style="text-align:center;">
            <table align="center"><tr><td style="width:200px;border:1px solid blue;background:#9badfb;" align="center">
                <?php
                    if(!isset($_SESSION['manager_user'])  && !isset($_SESSION['admin'])){
                        //header("location:login.php");
                    }
                    else
                    {
                        echo"<a href='quanlihanghoa.php' style='display:block;text-decoration:none;font-family:sans-serif;color:blue;' target='_blank'>Đên Khu Vực Làm Việc</a>";
                    }
                ?>
            </td></tr></table>
        </div>
    </body>
</html>
<?php
    ob_end_flush();
?>