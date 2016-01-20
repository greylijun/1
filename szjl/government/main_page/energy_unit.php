<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/4
 * Time: 8:56
 */
include "../../utils/conn.php";
$array = array();
//用能单位总数
$resultForUnit = $conn->query("select count(`tsn`) as `num` from `t_enterprise_info` where `review_status`='通过审核'");
$rowForUnit = mysqli_fetch_array($resultForUnit);
array_push($array,$rowForUnit['num']);

//采集点总数
$resultForPoint = $conn->query("select count(`tsn`) as `num2` from `t_collecting_point`");
$rowForPoint = mysqli_fetch_array($resultForPoint);
array_push($array,$rowForPoint['num2']);

//前一日能耗当量值
$resultForEquival = $conn->query("select sum(`daily_equival_value`) as `sum1` from `t_daily_data` WHERE `energy_big_type` != '水' AND date(`import_time`) = current_date()-1 AND `enable`='启用'");
$rowForEquival = mysqli_fetch_array($resultForEquival);
array_push($array,$rowForEquival['sum1']*1);

//前一日能耗等价值
$resultForIndiff = $conn->query("select sum(`daily_indiff_value`) as `sum2` from `t_daily_data` WHERE date(`import_time`) = current_date()-1 AND `enable`='启用'");
$rowForIndiff = mysqli_fetch_array($resultForIndiff);
array_push($array,$rowForIndiff['sum2']*1);

echo json_encode($array);
mysqli_close($conn);