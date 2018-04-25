<?php
session_start();
?>
<?php
ob_start();
?>
<?php
    if(!isset($_SESSION['manager_user'])){
        header("location:login.php");
    }
?>
<html>
    <head>
        <title>
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" language="javascript" src="script.js"></script>
    </head>
    <body style="margin:0;padding:0;text-align:center;">
        <div class="title-tab">
            Xuat Kho
        </div>
    </body>
</html>
<?php
    ob_end_flush();
?>