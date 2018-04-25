<?php
session_start();
?>
<?php
ob_start();
?>
<?php

session_destroy();
header("location:index.php");
?>
<?php
ob_end_flush();
?>