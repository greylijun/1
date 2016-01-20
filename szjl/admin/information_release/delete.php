<?php
include("../../utils/conn.php");

$row_id=$_POST["row_id"];

$delete = "delete from t_inform where row_id='$row_id'";


if(mysqli_query($conn,$delete)){
    echo "<html>"; 
    echo "<head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'/></head>"; 
	echo "<script language='javascript'>alert('删除成功！');history.back();</script>";
    echo "</html>";
}else{
    echo "删除失败！";
}
	

mysqli_close($conn);




?>