<?php
require("connect.php");
$so_phieu=$_GET['id'];
$str="select ma_pn from phieu_nhap where ma_pn like '".$so_phieu."%' order by ma_pn";
$sql=mysql_query($str);
$i=0;
while($row=mysql_fetch_assoc($sql))
{
$i++;
	echo "<div id='hopthoai'><table width='190px' cellpadding='0px' cellspacing=0 border=0>
		<tr padding='0px'>
			<td onclick=\"clickhang('cot".$i."');\">".$row['ma_pn']."<input type='hidden' value='".$row['ma_pn']."' id='cot".$i."'></td>
		</tr>
	</table></div>";
}
?>