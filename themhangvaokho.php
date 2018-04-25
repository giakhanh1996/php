<?php
require("connect.php");
?>
<?php
    $ma_loai= $_GET['ma_loai'];
    $str12 = "select * from loai_hang where ma_loai='$ma_loai'";
    $sql12=mysql_query($str12);
    $row12=mysql_fetch_assoc($sql12);
    $mat_hang=$_POST['mat_hang'];
    $so_luong=$_POST['so_luong'];
    if(isset($mat_hang) && isset($so_luong) && $so_luong != "" && $mat_hang != "")
    {
        $str3="insert into kho_ao(ma_vat_tu,so_luong) values('$mat_hang','$so_luong')";
        $sql3=mysql_query($str3);
        if($sql3)
        {
            
        }
        else
        {
            $str5="update kho_ao set so_luong = so_luong+'$so_luong' where ma_vat_tu='$mat_hang'";
            mysql_query($str5);
        }
    }
    $chon=$_POST['chon']; 
    if(isset($chon))
    {
        $length=count($chon);
        for($i=0;$i<$length;$i++)
        {
            $id_del=$chon[$i];
            $str6="delete from kho_ao where ma_vat_tu='$id_del'";
            mysql_query($str6);
        }
    }
    
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
        </title>
        <style type="text/css">
        .border-td{border-bottom:1px solid #000000;}
        .border-td-2{border-bottom:1px solid #acabab;}
        </style>
        <script type="text/javascript">
            function hienthihang(){
                //alert("onchange");
                var get=document.them_h_k.loai_hang.options[them_h_k.loai_hang.selectedIndex].value;
                window.location="themhangvaokho.php?ma_loai="+get;
                //alert(get);
            }
        </script>
        <script type="text/javascript" language="javascript" src="script.js"></script>
    </head>
    <body style="margin:0;padding:0;">
        <form action="<?php echo $SCRIPT_NAME; ?>" method="post" style="margin:0;padding:0;" name="list_hang">
            <div style="height:205px;border:1px solid #000000;overflow:auto;">
                
                    <table width="100%" border=0 cellpadding=0 cellspacing=0>
                        <tr style="background:#d0cfcf;"><td class="border-td" style="width:30px;height:20px;border-right:1px solid #000000;">&nbsp;</td><td class="border-td" style="width:60px;font-family:sans-serif;font-size:12px;font-weight:bold;border-right:1px solid #000000;">Ma vat tu</td><td class="border-td" style="font-family:sans-serif;font-size:12px;font-weight:bold;border-right:1px solid #000000;">Ten Vat tu</td><td class="border-td" style="font-family:sans-serif;font-size:12px;font-weight:bold;border-right:1px solid #000000;">don vi tinh</td><td class="border-td" style="font-family:sans-serif;font-size:12px;font-weight:bold;border-right:1px solid #000000;">Don Gia</td><td class="border-td" style="font-family:sans-serif;font-size:12px;font-weight:bold;text-align:center;">So Luong</td></tr>
                        <?php
                            $str2="select * from kho_ao order by ma_vat_tu";
                            $sql2=mysql_query($str2);
                            while($row2=mysql_fetch_assoc($sql2))
                            {
                                $ma=$row2['ma_vat_tu'];
                                $str4="select * from mat_hang where ma_hang='$ma'";
                                $sql4=mysql_query($str4);
                                $row4=mysql_fetch_assoc($sql4);
                                echo "<tr><td style='width:30px;height:20px;background:#d0cfcf;border-right:1px solid #000000;text-align:center;' class='border-td'><input type='checkbox' name='chon[]' value='".$row2['ma_vat_tu']."'></td><td class='border-td-2' style='text-align:center;border-right:1px solid #acabab;'>".$row2['ma_vat_tu']."</td><td class='border-td-2' style='border-right:1px solid #acabab;'>".$row4['ten_hang']."</td><td class='border-td-2' style='border-right:1px solid #acabab;'>".$row4['don_vi_tinh']."</td><td class='border-td-2' style='border-right:1px solid #acabab;'>".$row4['don_gia']."VND</td><td class='border-td-2' style='text-align:right;color:red;font-weight:bold;'>".$row2['so_luong']."</td></tr>";
                            }
                        ?>
                        <tr><td style="width:30px;height:20px;background:#d0cfcf;border-right:1px solid #000000;" class="border-td">&nbsp;</td><td class="border-td-2" style="border-right:1px solid #acabab;">&nbsp;</td><td class="border-td-2" style="border-right:1px solid #acabab;">&nbsp;</td><td class="border-td-2" style="border-right:1px solid #acabab;">&nbsp;</td><td style="border-right:1px solid #acabab;" class="border-td-2">&nbsp;</td><td class="border-td-2">&nbsp;</td></tr>
                        
                    </table>
                
            </div>
            <div>
            <?php
                            $tongtien=0;
                            $str32="select don_gia,so_luong from kho_ao a, mat_hang b where a.ma_vat_tu = b.ma_hang";
                            $sql32=mysql_query($str32);
                            while($row32=mysql_fetch_assoc($sql32))
                            {
                                $gia = $row32['don_gia'];
                                $slg = $row32['so_luong'];
                                $tong = $gia*$slg;
                                $tongtien=$tongtien+$tong;
                            }
                        ?>
                <table width="100%" border=0 cellpadding=0 cellspacing=0>
                    <tr><td><input type="button" value="Chon Tat Ca" onclick="checkall();"><input type="button" value="Huy chon tat ca" onclick="uncheckall();"><input type="submit" value="Xoa" onclick="return check_xoa();"></td><td align="right">Tổng Tiền: <?php echo $tongtien; ?> VND</td></tr>
                </table>
            </div>
        </form>
        
        <div>
            <form name="them_h_k" action="<?php echo $SCRIPT_NAME; ?>" method="post" style="margin:0;padding:0;">
                <table border=0 cellpadding=0 cellspacing=0 width="100%">
                    <tr>
                        <td style="font-family:sans-serif;font-size:11px;width:80px;">Chon loai hang : </td>
                        <td>
                            <select name="loai_hang" onchange="hienthihang()">
                                <?php 
                                    $str5="select * from loai_hang";
                                    $sql5=mysql_query($str5);
                                    while($row5=mysql_fetch_assoc($sql5))
                                    {
                                        if($row5['ma_loai']==$row12['ma_loai']){
                                        //echo "<script type='text/javascript'>alert('tuan sao');</script>";
                                        echo"<option selected=true value='".$row5['ma_loai']."'>".$row5['ten_loai']."</option>";
                                        }
                                        else
                                        {
                                         echo"<option value='".$row5['ma_loai']."'>".$row5['ten_loai']."</option>";
                                         }
                                    }
                                ?>
                            </select>
                        </td>
                        <?php
                            if(isset($ma_loai) && $ma_loai != ""){
                                echo"<td style='font-family:sans-serif;font-size:11px;'>Chon Mat hang : </td><td>
                                <select name='mat_hang'>";
                                $str1="select * from mat_hang where ma_loai='$ma_loai'";
                                $sql1=mysql_query($str1);
                                while($row1=mysql_fetch_assoc($sql1))
                                {
                                    echo"<option value='".$row1['ma_hang']."'>".$row1['ten_hang']."</option>";
                                }
                                echo"
                                </select>
                                </td>";
                                echo"<td style='font-family:sans-serif;font-size:11px;'>So Luong : </td><td><input type='text' name='so_luong' style='width:50px;'></td>";
                                echo"<td><input type='submit' value='Them'></td>";
                            }
                        ?>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>