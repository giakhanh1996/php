<?php
    echo $_FILES['file_anh']['name'];
    if(isset($_FILES['file_anh']['name']))
    {
        if($_FILES['file_anh']['type']=='image/jpeg' || $_FILES['file_anh']['type']=='image/png' || $_FILES['file_anh']['type']=='image/gif')
        {
            move_uploaded_file($_FILES["file_anh"]["tmp_name"],"anh_sp/".$_FILES["file_anh"]["name"]);
            $file_anh=$_FILES['file_anh']['name'];
        }
    }
?>
<html>
<head>

</head>
<body>
<form>
<input type="file" name="file_anh" />
</form>
</body>
</html>