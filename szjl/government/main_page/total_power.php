<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/3
 * Time: 16:46
 */
include "../../utils/conn.php";
$array = array();
$year =  date('Y').'-01-01 00:00:00';
//含水的消耗量
$sql = "select sum(`daily_indiff_value`) as `sum2` from `t_daily_data` WHERE `enable`='启用'
AND `import_time` BETWEEN '$year' AND current_time()";
$result = mysqli_query($conn,$sql);
if($result){
    $row=mysqli_fetch_array($result);
}
//  $row['sum2']     当年资源能耗等价值（含水）

//不含水的消耗量
$sqlForWater = "select sum(`daily_equival_value`) as `sum3`,sum(`daily_indiff_value`) as `sum4` from `t_daily_data` WHERE `enable`='启用' AND `energy_big_type` != '水' AND `import_time` BETWEEN '$year' AND current_time() ";
$resultForWater = mysqli_query($conn,$sqlForWater);
if($resultForWater){
    $rowForWater=mysqli_fetch_array($resultForWater);
}
// $rowForWater['sum3']   当年能耗当量值
// $rowForWater['sum4']   当年能耗等价值

$resultForLimit = $conn->query("select sum(`year_energy_equival_limit`) as `sum5`,sum(`year_energy_indiff_limit`) as `sum6`,sum(`year_source_indiff_limit`) as `sum7` from `t_enterprise_info` where `review_status`='通过审核'");
$rowForLimit = mysqli_fetch_array($resultForLimit);

//   $rowForLimit['sum5']   当年能源当量限额值（不含水）
//   $rowForLimit['sum6']   当年能源等价限额值（不含水）
//   $rowForLimit['sum7']   当年资源等价限额值（含水）

array_push($array,$row['sum2'],$rowForWater['sum3'],$rowForWater['sum4'],$rowForLimit['sum5'],$rowForLimit['sum6'],$rowForLimit['sum7']);
echo json_encode($array);