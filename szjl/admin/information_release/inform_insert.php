<?php

include("../../utils/conn.php");
require("uppic.php");

$name=$_POST["name"];
$date=$_POST["date"];
$content=$_POST["content"];
$unit=$_POST["unit"];
//图片上传
$upinfo = uploadFile("pic","./uploads/");
if($upinfo["error"]===false){
	die("图片信息上传失败：".$upinfo["info"]);
}else{
	//上传成功
	$pic = $upinfo["info"];// 获取上传成功的图片名
}
$insert = "insert into t_inform (user_admin_tsn,name,date,content,unit,image_path) values ('1','{$name}','{$date}','{$content}','{$unit}','{$pic}')";										if ($name==""){ 
    echo "<script language='javascript'>alert('请输入名称！');history.back();</script>";
	}
	else{
if(mysqli_query($conn,$insert)){
    echo "<script language='javascript'>alert('提交成功！');history.back();</script>";
}else{
    echo "<script language='javascript'>alert('提交失败！');history.back();</script>";
}
	}
mysqli_close($conn);

?>




















