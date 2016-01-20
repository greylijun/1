<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/12
 * Time: 16:31
 */
error_reporting(0);
include "../../../utils/conn.php";
session_start();
$user_name = $_SESSION['user_name'];
$name = $_POST['pro_name'];                                 //项目名称
$start_time_finish = $_POST['start_time_finish'];           //开始时间
$end_time_finish = $_POST['end_time_finish'];               //结束时间
$finish_investment = $_POST['finish_investment'];           //投资额
$finish_payback = $_POST['finish_payback'];                 //回收期
$finish_saving_money = $_POST['finish_saving_money'];       //节约量金额
$finish_material_volume = $_POST['finish_material_volume']; //实物量
$user_IP = gethostbyname($_ENV['COMPUTERNAME']);                     //获取当前ip
$_SESSION['project_name'] = $name;           //将项目名称写入session

$sql =$conn->query("select `tsn`,`enter_tsn` from `t_energy_saving_measures_plan` where `project_name`='{$name}'");
$row = mysqli_fetch_array($sql);
$tsn = $row['tsn'];
$enter_tsn = $row['enter_tsn'];

$insert = "insert into `t_energy_saving_measures_finish` values (null,'{$tsn}','{$enter_tsn}','{$name}','{$start_time_finish}','{$end_time_finish}','{$finish_investment}','{$finish_saving_money}','{$finish_material_volume}','{$finish_payback}',null,'是',current_time,'{$enter_tsn}','{$user_name}','{$user_IP}',null,null,null,null)";
$update = "update `t_energy_saving_measures_plan` set `if_finish`='是' where `tsn`='{$tsn}'";
mysqli_query($conn,$update);
if(mysqli_query($conn,$insert)){
    echo "数据插入成功！";
}else{
    echo "数据插入失败！";
}

mysqli_close($conn);