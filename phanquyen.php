<?php
session_start();
?>
<?php
ob_start();
?>
<?php
if(!isset($_SESSION['admin']))
{
    $quyen=false;
}
else
{
    $quyen=true;
}
$tao_quyen=$_GET['tao_quyen'];

?>
<?php
require("connect.php");
$str1="select ma_nv,ten_nv,tai_khoan,ten_cv from nhanvien a, chuc_vu b where a.ma_cv=b.ma_cv";
$sql1=mysql_query($str1);
$cv=$_POST['ma_cv'];
$qc=$_POST['quyen_combo'];
for($j=0;$j<count($cv);$j++)
{
    //echo $cv[$j]." - ".$qc[$j]."<br/>";
    if($qc[$j] != "")
    {
        $str44="insert into nhom_quyen(ma_nhom,ma_cv) values('$qc[$j]','$cv[$j]')";
        $sql44=mysql_query($str44);
        
        if($sql44)
        {
            
        }
        else
        {
            $str33="update nhom_quyen set ma_nhom='$qc[$j]' where ma_cv='$cv[$j]'";
            mysql_query($str33);
        }
    }
}
if(isset($_POST['quyen']))
{
    $capquyen = $_POST['quyen'];
    $i = count($capquyen);
    if($i>=1)
    {
        $ma = $_POST['mq'];
        $sty="select * from cap_quyen where ma_nhom='$ma'";
        $syl=mysql_query($sty);
        $numrow=mysql_num_rows($syl);
        if($numrow >= 1)
        {
            $strg = "delete from cap_quyen where ma_nhom='$ma'";
            $sqlg=mysql_query($strg);
            if($sqlg)
            {
                for($r=0;$r<$i;$r++)
                {
                    $cq=$capquyen[$r];
                    $str = "insert into cap_quyen(ma_nhom,quyen) values('$ma','$cq')";
                    mysql_query($str);
                }
                $upd=1;
            }
        }
        else
        {
            for($r=0;$r<$i;$r++)
            {
                $cq=$capquyen[$r];
                $str = "insert into cap_quyen(ma_nhom,quyen) values('$ma','$cq')";
                mysql_query($str);
                
            }
            $ins=1;
        }
    }
    $dd=$_SERVER['REQUEST_URI'];
    $exmang=explode("/",$dd);
    $count=count($exmang);
    //echo $count;
    $aa=explode("&",$exmang[2]);
    if($ins==1)
    {
        if(!isset($_GET['insert_rows']))
        {
            header("location:".$exmang[2]."&insert_rows=complete");
            //echo $exmang[2];
        }
        else
        {}
    }
    if($upd==1)
    {
        if(!isset($_GET['update_rows']))
        {
            if(isset($_GET['insert_rows']))
            {
                header("location:".$aa[0]."&".$aa[1]."&update_rows=complete");
            }
            else
            {
                header("location:".$exmang[$count-1]."&update_rows=complete");
            }
        }
        else
        {}
    }
}
$nhom=$_GET['ma_nhom'];
if(isset($nhom))
{
$trs="select * from cap_quyen where ma_nhom='$nhom'";
$lsq=mysql_query($trs);

}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quan li nhan vien</title>
<style type="text/css">
.hh a:hover img{border:1px solid red;}
</style>
<script type="text/javascript">
function allow_update(bien,can_xo,id){
    //alert("goi duoc ham");
    var getid=document.getElementById(bien);
    var getidcombo=document.getElementById(can_xo);
    var getid2=document.getElementById(id);
    if(getid.checked==true)
    {
        getidcombo.disabled=false;
        getid2.disabled=false;
    }
    else{
        getidcombo.disabled=true;
        getid2.disabled=true;
    }
}
function checkg(){
    var mang=document.form_quyen.checkgroup;
    var check_variable=0;
    var getchecbox=document.form_quyen.checkgroup.length;
    //alert(getchecbox);
    if(getchecbox==undefined){
        if(document.form_quyen.checkgroup.checked==true){
                check_variable=1;
            }
            else
            {
                alert("Vui Long Check Vao Hang Can Cap Nhat");
                return false;
            }
        
    }
    else{
        for(i=0;i<getchecbox;i++){
            if(document.form_quyen.checkgroup[i].checked==true){
                check_variable=1;
                //alert("trong for"+check_variable);
            }
        }
        
    }
    //alert("ngoai for"+check_variable);
    if(check_variable==1){
        //alert("dung roi");
        return true;
        
    }
    else{
        alert("Vui Long Check Vao Hang Can Cap Nhat");
        return false;
    }
}
function hien_thi_nhom(){
    var nhom=document.fk.mq.options[fk.mq.selectedIndex].value;
    if(nhom=="null"){
        window.location="phanquyen.php?tao_quyen=true";
    }
    else
    {
        window.location="phanquyen.php?tao_quyen=true&ma_nhom="+nhom;
    }
}
function checkall(){
    //alert("goi duoc ham");
    var getchecbox=document.fk["quyen[]"].length;
    for(i=0;i<getchecbox;i++){
        document.fk["quyen[]"][i].checked=true;
    }
}
function uncheckall(){
    //alert("goi duoc ham");
    var getchecbox=document.fk["quyen[]"].length;
    for(i=0;i<getchecbox;i++){
        document.fk["quyen[]"][i].checked=false;
    }
}
</script>
</head>
<body style="text-align: center;">
    <?php
    
    if($quyen==false)
    {
        echo"<div style='text-align:center;background:#d7fe02;border:2px solid #2d3902;color:#2d3902;'><table border=0 cellpadding=0 cellspacing=0 width='100%'><tr><td style='width:53px;'><a href='quanlihanghoa.php'><img src='images/store-icon.png' height=40 border=0></a></td><td align='center' style='color:#2d3902;font-size:24px;font-weight:bolder;height:40px;'>Ban khong co quyen vao trang nay!</td></tr></table></div>";
    }
    else
    {
        if(isset($tao_quyen) && $tao_quyen==true)
        {
            echo"<div style='text-align:center;background:#d8fba5;border:2px solid #94fb02;color:#94fb02;'><table border=0 cellpadding=0 cellspacing=0 width='100%'><tr><td align='center' style='color:#5c8c18;font-size:24px;font-weight:bolder;height:40px;'>Quan Li Phan Quyen</td></tr></table></div>";
            echo"<div style='position:absolute;top:60;left:7;background:#d8fba5;border:2px solid #94fb02;color:#94fb02;width:200px;'><table border=0 width='100%'><tr><td style='width:30px;' align='center'><a href='index.php'><img src='images/greenHouseIcon.png' height=25 border=0 title='Trang Chu' alt='Trang Chu'></a></td><td style='font-weight:bold;'><a href='index.php' style='text-decoration:none;color:#5c8c18;'>Trang Chu</a></td></tr></table></div>";
            echo"<div style='position:absolute;top:100;left:7;background:#d8fba5;border:2px solid #94fb02;color:#679821;width:200px;'><table border=0 width='100%'><tr><td style='width:30px;' align='center'><a href='quanlihanghoa.php'><img src='images/icon_shopcart.png' height=25 border=0 title='Quan Li Hang Hoa' alt='Quan Li Hang Hoa'></a></td><td style='font-weight:bold;'><a href='quanlihanghoa.php' style='text-decoration:none;color:#5c8c18;'>Quan Li Hang Hoa</a></td></tr></table></div>";
            echo"<div style='position:absolute;top:140;left:7;background:#d8fba5;border:2px solid #94fb02;color:#679821;width:200px;'><table border=0 width='100%'><tr><td style='width:30px;' align='center'><a href='logout.php'><img src='images/logout_icon_small.png' height=25 border=0 title='Logout' alt='Logout'></a></td><td style='font-weight:bold;'><a href='logout.php' style='text-decoration:none;color:#5c8c18;'>Dang Xuat</a></td></tr></table></div>";
            echo"<div style='position:absolute;top:180;left:7;background:#d8fba5;border:2px solid #94fb02;color:#679821;width:200px;'><table border=0 width='100%'><tr><td style='width:30px;' align='center'><a href='phanquyen.php?tao_quyen=true'><img src='images/add_48.png' height=25 border=0 title='Tao nhom quyen moi' alt='Tao nhom quyen moi'></a></td><td style='font-weight:bold;'><a href='phanquyen.php?tao_quyen=true' style='text-decoration:none;color:#5c8c18;'>Tao Nhom Quyen Moi</a></td></tr></table></div>";
            echo"<div style='position:absolute;top:220;left:7;background:#d8fba5;border:2px solid #94fb02;color:#679821;width:200px;'><table border=0 width='100%'><tr><td style='width:30px;' align='center'><a href='phanquyen.php'><img src='images/arrow_left_green_48.png' height=25 border=0 title='Tro Ve' alt='Tro Ve'></a></td><td style='font-weight:bold;'><a href='phanquyen.php' style='text-decoration:none;color:#5c8c18;'>Tro Ve</a></td></tr></table></div>";
            echo"<div style='width: 600px;margin:0 auto;' class='hang'>";
            echo"<form action='".$SCRIPT_NAME."' method='POST' name='fk'>";
            echo"<table>";
            echo"<tr><td>";
            echo"<select name='mq' onchange='hien_thi_nhom();'>";
            $str3="select * from ten_nhom_quyen";
            $sql3=mysql_query($str3);
            echo"<option value='null'>-- Chon Nhom --</option>";
            if(isset($nhom))
            {
                //$orw=mysql_fetch_assoc($lsq);
                    while($row3=mysql_fetch_assoc($sql3))
                    {
                       if($nhom == $row3['ma_nhom']) 
                       {
                        echo"<option selected=true value='".$row3['ma_nhom']."'>".$row3['ten_nhom']."</option>";
                       }
                       else
                       {
                            echo"<option value='".$row3['ma_nhom']."'>".$row3['ten_nhom']."</option>";
                       }
                    }
                
            }
            else
            {
                while($row3=mysql_fetch_assoc($sql3))
                {
                  echo"<option value='".$row3['ma_nhom']."'>".$row3['ten_nhom']."</option>";
                }
            }
            
            echo"</select>";
            echo"<a href='taonhom.php' style='text-decoration:none;'><input type='button' value='Tao Nhom Quyen Moi'></a></td></tr>";
            echo"<tr><td>";
            echo"<div>";
            echo"<fieldset style='border:1px solid #000000;'><legend>Phan Quyen</legend>";
            echo"<table width='300px'>";
            echo"<tr><td></td><td>STT</td><td>Quyen</td></tr>";
            if(isset($nhom))
            {
                $diem=mysql_num_rows($lsq);
                if($diem==0)
                {
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='1'></td><td>1</td><td>Quan li kho hang</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='2'></td><td>2</td><td>Quan li nhap kho</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='3'></td><td>3</td><td>Quan li nha cung cap</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='4'></td><td>4</td><td>Quan li mat hang</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='5'></td><td>5</td><td>Quan li Nhan vien</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='6'></td><td>6</td><td>Quan li Xuat kho</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='7'></td><td>6</td><td>Chuc nang kiem ke</td></tr>";
                }
                else
                {
                    while($orw=mysql_fetch_assoc($lsq))
                    {
                        if($orw['quyen']==1)
                        {
                            $check1=true;
                        }
                        if($orw['quyen']==2)
                        {
                            $check2=true;
                        }
                        if($orw['quyen']==3)
                        {
                            $check3=true;
                        }
                        if($orw['quyen']==4)
                        {
                            $check4=true;
                        }
                        if($orw['quyen']==5)
                        {
                            $check5=true;
                        }
                        if($orw['quyen']==6)
                        {
                            $check6=true;
                        }
                        if($orw['quyen']==7)
                        {
                            $check7=true;
                        }
                    }
                    if($check1==true)
                    {
                        echo"<tr><td><input type='checkbox' checked='checked' name='quyen[]' value='1'></td><td>1</td><td>Quan li kho hang</td></tr>";
                    }
                    else
                    {
                        echo"<tr><td><input type='checkbox' name='quyen[]' value='1'></td><td>1</td><td>Quan li kho hang</td></tr>";
                    }
                    if($check2==true)
                    {
                        echo"<tr><td><input type='checkbox' checked='checked' name='quyen[]' value='2'></td><td>2</td><td>Quan li nhap kho</td></tr>";
                    }
                    else
                    {
                        echo"<tr><td><input type='checkbox' name='quyen[]' value='2'></td><td>2</td><td>Quan li nhap kho</td></tr>";
                    }
                    if($check3==true)
                    {
                        echo"<tr><td><input type='checkbox' checked='checked' name='quyen[]' value='3'></td><td>3</td><td>Quan li nha cung cap</td></tr>";
                    }
                    else
                    {
                        echo"<tr><td><input type='checkbox' name='quyen[]' value='3'></td><td>3</td><td>Quan li nha cung cap</td></tr>";
                    }
                    if($check4==true)
                    {
                        echo"<tr><td><input type='checkbox' checked='checked' name='quyen[]' value='4'></td><td>4</td><td>Quan li mat hang</td></tr>";
                    }
                    else
                    {
                        echo"<tr><td><input type='checkbox' name='quyen[]' value='4'></td><td>4</td><td>Quan li mat hang</td></tr>";
                    }
                    if($check5==true)
                    {
                        echo"<tr><td><input type='checkbox' checked='checked' name='quyen[]' value='5'></td><td>5</td><td>Quan li Nhan vien</td></tr>";
                    }
                    else
                    {
                        echo"<tr><td><input type='checkbox' name='quyen[]' value='5'></td><td>5</td><td>Quan li Nhan vien</td></tr>";
                    }
                    if($check6==true)
                    {
                        echo"<tr><td><input type='checkbox' checked='checked' name='quyen[]' value='6'></td><td>6</td><td>Quan li Xuat kho</td></tr>";
                    }
                    else
                    {
                        echo"<tr><td><input type='checkbox' name='quyen[]' value='6'></td><td>6</td><td>Quan li Xuat kho</td></tr>";
                    }
                    if($check7==true)
                    {
                        echo"<tr><td><input type='checkbox' checked='checked' name='quyen[]' value='7'></td><td>7</td><td>Chuc nang kiem ke</td></tr>";
                    }
                    else
                    {
                        echo"<tr><td><input type='checkbox' name='quyen[]' value='7'></td><td>7</td><td>Chuc nang kiem ke</td></tr>";
                    }
                }
            }
            else
            {
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='1'></td><td>1</td><td>Quan li kho hang</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='2'></td><td>2</td><td>Quan li nhap kho</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='3'></td><td>3</td><td>Quan li nha cung cap</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='4'></td><td>4</td><td>Quan li mat hang</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='5'></td><td>5</td><td>Quan li Nhan vien</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='6'></td><td>6</td><td>Quan li Xuat kho</td></tr>";
                    echo"<tr><td><input type='checkbox' name='quyen[]' value='7'></td><td>7</td><td>Chuc nang kiem ke</td></tr>";
            }
            echo"</table>";
            echo"</fieldset>";
            echo"</div>";
            echo"</td></tr>";
            echo"<tr><td colspan='2'><input type='button' value='chon tat ca' onclick='checkall();'><input type='button' value='Huy tat ca' onclick='uncheckall();'><input type='submit' value='cap quyen'></td></tr>";
            echo"</table>";
            echo"</form>";
            echo"</div>";
        }
        else
        {
            echo"<div style='text-align:center;background:#d8fba5;border:2px solid #94fb02;color:#2d3902;'><table border=0 cellpadding=0 cellspacing=0 width='100%'><tr><td align='center' style='color:#5c8c18;font-size:24px;font-weight:bolder;height:40px;'>Quan Li Phan Quyen</td></tr></table></div>";
            echo"<div style='width: 600px;margin:0 auto;' class='hang'>";
            echo"<table width='100%'><tr><td style='width:40px;'><img src='images/settingsev4.png'></td><td style='font-family:sans-serif;font-size:14px;'><b>Phan Quyen Theo tung Nhan vien</b></td></tr></table>";
            echo"<table width='100%' border=0 cellspacing=0 cellpadding=0>";
            echo"<tr style='background: #5c8c18;color: #ffffff;font-weight:bold;'><td align='center' style='border-top:1px solid #5c8c18;border-left:1px solid #5c8c18;'>STT</td><td align='center' style='border-top:1px solid #5c8c18;border-left:1px solid #5c8c18;'>MA_NV</td><td align='center' style='border-top:1px solid #5c8c18;border-left:1px solid #5c8c18;'>TEN_NV</td><td align='center' style='border-top:1px solid #5c8c18;border-left:1px solid #5c8c18;'>TAI_KHOAN</td><td align='center' style='border-top:1px solid #5c8c18;border-left:1px solid #5c8c18;'>CHUC_VU</td><td style='border-top:1px solid #5c8c18;border-left:1px solid #5c8c18;border-right:1px solid #5c8c18;'>Quyen</td></tr>";
            
            $i=0;
            while($row=mysql_fetch_assoc($sql1))
            {
                $i=$i+1;
                if(($i%2)==0)
                {
                    $mau="background:#d8fba5;font-family:sans-serif;font-size:13px;height:30px;";
                }
                else
                {
                    $mau="background:#d1dcc2;font-family:sans-serif;font-size:13px;height:30px;";
                }
                echo"<tr style='".$mau."'><td align='center' style='border-bottom:1px solid #5c8c18'>".$i."</td><td style='border-bottom:1px solid #5c8c18'>".$row['ma_nv']."</td><td style='border-bottom:1px solid #5c8c18'>".$row['ten_nv']."</td><td style='border-bottom:1px solid #5c8c18'>".$row['tai_khoan']."</td><td style='border-bottom:1px solid #5c8c18'>".$row['ten_cv']."</td><td style='border-bottom:1px solid #5c8c18'><a href='phanquyen.php?ma_nv'>Sua Quyen</a></td></tr>";
            }
            
            echo"</table>";
            echo"</div>";
            echo"<div style='width: 600px;margin:10 auto;' class='hang'>";
            echo"<table width='100%'><tr><td style='width:40px;'><img src='images/settingsev4.png'></td><td style='font-family:sans-serif;font-size:14px;'><b>Phan Quyen Theo chuc vu</b></td></tr></table>";
            echo"<form action='".$SCRIPT_NAME."' method='POST' name='form_quyen' onsubmit='return checkg();'>";
            echo"<table width='100%' border=0 cellspacing=0 cellpadding=0>";
            
            echo"<tr style='background: #5c8c18;color: #ffffff;font-weight:bold;'><td align='center'>STT</td><td align='center'>MA_CV</td><td align='center'>TEN_CV</td><td align='center'>Nhom Quyen</td><td align='center'>Cap Nhat</td></tr>";
            
            $i=0;
            $str2="select ma_cv, ten_cv from chuc_vu";
            $sql2=mysql_query($str2);
            while($row2=mysql_fetch_assoc($sql2))
            {
                $i=$i+1;
                if(($i%2)==0)
                {
                    $mau="background:#d8fba5;font-family:sans-serif;font-size:13px;height:30px;";
                }
                else
                {
                    $mau="background:#d1dcc2;font-family:sans-serif;font-size:13px;height:30px;";
                }
                echo"<tr style='".$mau."'><td align='center' style='border-bottom:1px solid #5c8c18;border-left:1px solid #5c8c18;'>".$i."</td><td style='border-bottom:1px solid #5c8c18;border-left:1px solid #5c8c18;text-align:center;'><input type='text' readonly='readonly' disabled=true id='ma_q".$i."' name='ma_cv[]' value='".$row2['ma_cv']."' style='width:80px;'></td><td style='border-bottom:1px solid #5c8c18;border-left:1px solid #5c8c18;padding-left:7px;'>".$row2['ten_cv']."</td><td align='center' style='border-bottom:1px solid #5c8c18;border-left:1px solid #5c8c18;'><select name='quyen_combo[]' id='chon_quyen".$i."' disabled=true><option value='no_quyen'>-- Chon Quyen --</option>";
                $str3="select * from ten_nhom_quyen";
                $sql3=mysql_query($str3);
                $c_v=$row2['ma_cv'];
                $str4="select * from nhom_quyen where ma_cv='$c_v'";
                $sql4=mysql_query($str4);
                $row4=mysql_fetch_assoc($sql4);
                while($row3=mysql_fetch_assoc($sql3))
                {
                    if($row4['ma_nhom']==$row3['ma_nhom'])
                    {
                        echo"<option selected=true value='".$row3['ma_nhom']."'>".$row3['ten_nhom']."</option>";
                    }
                    else
                    {
                        echo"<option value='".$row3['ma_nhom']."'>".$row3['ten_nhom']."</option>";
                    }
                }
                echo"</select></td><td style='border-bottom:1px solid #5c8c18;border-left:1px solid #5c8c18;text-align:center;border-right:1px solid #5c8c18;'><input type='checkbox' name='checkgroup' id='box".$i."' onmouseout=\"allow_update('box".$i."','chon_quyen".$i."','ma_q".$i."');\"></td></tr>";
                
            }
            echo"<tr><td colspan=5><input type='submit' value='Cap Nhat'></td></tr>";
            
            
            
            echo"</table>";
            echo"</div>";
            echo"</form>";
            
            echo"<div style='position:absolute;top:60;left:7;background:#d8fba5;border:2px solid #94fb02;color:#679821;width:200px;'><table border=0 width='100%'><tr><td style='width:30px;' align='center'><a href='index.php'><img src='images/greenHouseIcon.png' height=25 border=0 title='Trang Chu' alt='Trang Chu'></a></td><td style='font-weight:bold;'><a href='index.php' style='text-decoration:none;color:#5c8c18;'>Trang Chu</a></td></tr></table></div>";
            echo"<div style='position:absolute;top:100;left:7;background:#d8fba5;border:2px solid #94fb02;color:#679821;width:200px;'><table border=0 width='100%'><tr><td style='width:30px;' align='center'><a href='quanlihanghoa.php'><img src='images/icon_shopcart.png' height=25 border=0 title='Quan Li Hang Hoa' alt='Quan Li Hang Hoa'></a></td><td style='font-weight:bold;'><a href='quanlihanghoa.php' style='text-decoration:none;color:#5c8c18;'>Quan Li Hang Hoa</a></td></tr></table></div>";
            echo"<div style='position:absolute;top:140;left:7;background:#d8fba5;border:2px solid #94fb02;color:#679821;width:200px;'><table border=0 width='100%'><tr><td style='width:30px;' align='center'><a href='logout.php'><img src='images/logout_icon_small.png' height=25 border=0 title='Logout' alt='Logout'></a></td><td style='font-weight:bold;'><a href='logout.php' style='text-decoration:none;color:#5c8c18;'>Dang Xuat</a></td></tr></table></div>";
            echo"<div style='position:absolute;top:180;left:7;background:#d8fba5;border:2px solid #94fb02;color:#679821;width:200px;'><table border=0 width='100%'><tr><td style='width:30px;' align='center'><a href='phanquyen.php?tao_quyen=true'><img src='images/add_48.png' height=25 border=0 title='Tao nhom quyen moi' alt='Tao nhom quyen moi'></a></td><td style='font-weight:bold;'><a href='phanquyen.php?tao_quyen=true' style='text-decoration:none;color:#5c8c18;'>Tao Nhom Quyen Moi</a></td></tr></table></div>";
        }
    }
    if(isset($_GET['insert_rows']) && $_GET['insert_rows']=="complete")
    {
        echo"<script type='text/javascript'> alert('Cap quyen thanh cong!'); </script>";
    }
    else
    {
        
    }
    if(isset($_GET['update_rows']) && $_GET['update_rows']=="complete")
    {
        echo"<script type='text/javascript'> alert('Cap nhat thanh cong!'); </script>";
    }
    else
    {
        
    }
?>
</body>
</html>
<?php
ob_end_flush();
?>