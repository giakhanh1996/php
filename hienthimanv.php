<?php
session_start();
?>
<?php
require("connect.php");

?>
<html>
    <head>
    </head>
    <script type="text/javascript">
        
        function click(id_hang){
            var getid=document.getElementById("ht");
            var getid2=document.getElementById(id_hang);
            var mang=getid.getElementsByTagName("tr");
            for(i=0;i<mang.length;i++){
                mang[i].style.background="#ffffff";
            }
            getid2.style.background="#fd4b05";
        }
    </script>
    <body style="margin:0;padding:0;">
        <?php
        $ma_pn=$_GET['ma_pn'];
        $str="select ma_pn from phieu_nhap where ma_pn like '$ma_pn%'";
        $sql=mysql_query($str);
        echo"<div id='ht'>";
        echo"<table border=0 cellpadding=0 cellspacing=0 width='180px'>";
        $i=0;
        while($row=mysql_fetch_assoc($sql))
        {
            $i++;
            if($i==1)
            {
                echo "<tr style='background:#fd4b05;' id='hang".$i."' onclick=\"click('hang".$i."');\"><td>".$row['ma_pn']."</td></tr>";
            }
            else
            {
                echo "<tr id='hang".$i."' onclick=\"click('hang".$i."');\"><td>".$row['ma_pn']."</td></tr>";
            }
        }
        echo"</table></div>";
        ?>
    </body>
</html>