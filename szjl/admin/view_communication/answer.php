<?php

include("../../utils/conn.php");
$answer=$_POST["answer"];
$row_id=$_POST["row_id"];
$update = "update t_feedback set sub_answer='$answer' , Upd_date=current_time where row_id='$row_id'";
if(mysqli_query($conn,$update)){
    echo "提交成功！";
}else{
    echo "提交失败！";
}
mysqli_close($conn);