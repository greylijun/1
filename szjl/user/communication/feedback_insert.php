<?php

include("../../utils/conn.php");
$username=$_POST["username"];
$theme=$_POST["theme"];
$question=$_POST["question"];
$ip=$_SERVER["REMOTE_ADDR"];

$insert = "insert into t_feedback (user_enter_tsn,theme,sub_question,sub_time,crt_date,Crt_user_tsn,Crt_user_name,Crt_ip) 
						   values ('1','{$theme}','{$question}',current_time,current_time,'1','{$username}','{$ip}')";
if(mysqli_query($conn,$insert)){
    echo "提交成功！";
}else{
    echo "提交失败！";
}
mysqli_close($conn);