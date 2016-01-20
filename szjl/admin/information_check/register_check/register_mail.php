<?php
error_reporting(0);
require "../../../utils/smtp.php";
include "../../../utils/conn.php";
$state = $_POST['state'];
$name = $_POST['name'];
$sql = $conn->query("select `E_mail` from `t_enterprise_info` where `enterprise_name`='{$name}' and `review_status` !='未通过审核'");
while($row = mysqli_fetch_array($sql)){
    $email = $row['E_mail'];
}

//使用163邮箱服务器
$smtpserver = "smtp.163.com";
//163邮箱服务器端口
$smtpserverport = 25;
//你的163服务器邮箱账号
$smtpusermail = "fluentjiang@163.com";
//收件人邮箱
$smtpemailto = "{$email}";
//你的邮箱账号（去掉@163.com）
$smtpuser = "fluentjiang"; // SMTP服务器的用户账号
//你的邮箱密码
$smtppass = "loopguqghgzslsct"; //SMTP服务器的用户名密码
//邮件主题
$mailsubject = "注册成功提醒";
//邮件内容
if($state == "通过审核"){
    $mailbody = "尊敬的用户您好，你在苏州市用能单位能源计量数据在线采集系统中注册的账号已审核通过，立刻登录系统请点击<a style ='color:blue' href='http://sjcj.szjl.com.cn:8090'>苏州市用能单位能源计量数据在线采集系统</a>";
}else{
    $mailbody = "尊敬的用户您好，不好意思，你在苏州市用能单位能源计量数据在线采集系统中注册的账号未审核通过，请登录该系统重新填写企业相关信息<a style ='color:blue' href='http://sjcj.szjl.com.cn:8090'>苏州市用能单位能源计量数据在线采集系统</a>";
}

//邮件格式（HTML/TXT),TXT为文本邮件
$mailtype = "HTML";
//这里面的一个true是表示使用身份验证，否则不使用身份验证
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
//是否显示发送的调试信息
$smtp-> debug = TRUE;
//发送邮件
$smtp->sendmail($smtpemailto,$smtpusermail,$mailsubject,$mailbody,$mailtype);

?>