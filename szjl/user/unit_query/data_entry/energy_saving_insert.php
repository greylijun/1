<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/12
 * Time: 10:55
 */
error_reporting(0);
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$user_name = $_SESSION['user_name'];

$project_name = $_POST['project_name'];                 //项目名称
$start_time = $_POST['start_time'];                     //开始时间
$end_time = $_POST['end_time'];                         //结束时间
$investment = $_POST['investment'];                     //投资额
$payback = $_POST['payback'];                           //回收期
$saving_money = $_POST['saving_money'];                 //节约金额量
$material_volume = $_POST['material_volume'];           //实物量
$user_IP = gethostbyname($_ENV['COMPUTERNAME']);        //获取当前ip
$_SESSION['project_name'] = $project_name;  //将项目名称写入session

$sql =$conn->query("select max(tsn) as `max_tsn` from `t_energy_saving_measures_plan`");
$row = mysqli_fetch_array($sql);
if($row['max_tsn'] == null){
    $tsn = "1";
}else{
    $tsn = $row['max_tsn']+1;
}


$insertSql = "insert into `t_energy_saving_measures_plan` values(null,'{$tsn}','{$enter_tsn}','{$project_name}','{$start_time}','{$end_time}','{$investment}','{$saving_money}','{$material_volume}','{$payback}',null,'否',CURRENT_TIME ,'{$enter_tsn}','{$user_name}','{$user_IP}',null,null,null,null)";
if(mysqli_query($conn,$insertSql)){
    echo "节能措施录入成功！";
}else{
    echo "节能措施录入失败！";
}
mysqli_close($conn);