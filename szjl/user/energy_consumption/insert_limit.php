<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/18
 * Time: 12:23
 */
include '../../utils/conn.php';
error_reporting(0);
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$user_name = $_SESSION['user_name'];
$water_energy_consumption = $_POST['water_energy_consumption'];                       //综合能耗
$water_energy_consumption_unit = $_POST['water_energy_consumption_unit'];             //综合能耗单位
$water_production = $_POST['water_production'];                                       //产量
$water_production_unit = $_POST['water_production_unit'];                             //产量单位
$water_energy_con_unit_pro = $_POST['water_energy_con_unit_pro'];                     //单位产品综合能耗
$water_energy_con_unit_pro_unit = $_POST['water_energy_con_unit_pro_unit'];           //单位产品综合能耗单位
$water_limit_num = $_POST['water_limit_num'];                                         //编号
$water_category_name = $_POST['water_category_name'];                                 //类别名称
$water_limit_value = $_POST['water_limit_value'];                                     //定额值
$water_limit_value_unit = $_POST['water_limit_value_unit'];                           //定额值单位
$water_revise_limit_value = $_POST['water_revise_limit_value'];                       //修改限额值
$water_revise_limit_value_unit = $_POST['water_revise_limit_value_unit'];             //修改限额值单位

$energy_consumption = $_POST['energy_consumption'];                       //综合能耗
$energy_consumption_unit = $_POST['energy_consumption_unit'];             //综合能耗单位
$production = $_POST['production'];                                       //产量
$production_unit = $_POST['production_unit'];                             //产量单位
$energy_con_unit_pro = $_POST['energy_con_unit_pro'];                     //单位产品综合能耗
$energy_con_unit_pro_unit = $_POST['energy_con_unit_pro_unit'];           //单位产品综合能耗单位
$limit_num = $_POST['limit_num'];                                         //编号
$category_name = $_POST['category_name'];                                 //类别名称
$limit_value = $_POST['limit_value'];                                     //定额值
$limit_value_unit = $_POST['limit_value_unit'];                           //定额值单位
$revise_limit_value = $_POST['revise_limit_value'];                       //修改限额值
$revise_limit_value_unit = $_POST['revise_limit_value_unit'];             //修改限额值单位
$user_IP = gethostbyname($_ENV['COMPUTERNAME']);
$year = date('Y');

$sqlForTsn =$conn->query("select max(tsn) as `max_tsn` from `t_tech_limit_fill`");
$rowForTsn = mysqli_fetch_array($sqlForTsn);
if($rowForTsn['max_tsn'] == null){
    $tsn = "1";
}else{
    $tsn = $rowForTsn['max_tsn']+1;
}

$sql = "insert  into `t_tech_limit_fill` values(null,'{$tsn}','{$enter_tsn}','{$water_energy_consumption}','{$water_energy_consumption_unit}','{$water_production}','{$water_production_unit}','{$water_energy_con_unit_pro}','{$water_energy_con_unit_pro_unit}','{$water_limit_num}','{$water_category_name}','{$water_limit_value}','{$water_limit_value_unit}','{$water_revise_limit_value}','{$water_revise_limit_value_unit}',null,null,null,'{$energy_consumption}','{$energy_consumption_unit}','{$production}','{$production_unit}','{$energy_con_unit_pro}','{$energy_con_unit_pro_unit}','{$limit_num}','{$category_name}','{$limit_value}','{$limit_value_unit}','{$revise_limit_value}','{$revise_limit_value_unit}',null,null,null,'{$year}',null,'未审核',CURRENT_TIME ,'{$user_name}','{$user_IP}')";
if(mysqli_query($conn,$sql)){
    echo "限额录入成功！";
}else{
    echo "限额录入失败！";
}
mysqli_close($conn);