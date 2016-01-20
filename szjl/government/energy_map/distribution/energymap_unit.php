<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/4
 * Time: 14:12
 */
include "../../../utils/conn.php";
$area = $_GET['area'];
$array = array();

if($area != "全市"){
    $resultForUnit = $conn->query("select count(`tsn`) as `num` from `t_enterprise_info` WHERE `review_status`='通过审核' and `region` = '$area'");
    $resultForPoint = $conn->query("select count(`tsn`) as `num1` from `t_collecting_point` where `point_region` = '{$area}'");
    $resultForEquival = $conn->query("select sum(`a`.`daily_equival_value`) as `sum2` from `t_daily_data` as `a` LEFT JOIN `t_enterprise_info` as `b` ON `a`.`enter_tsn`=`b`.`tsn` WHERE `energy_big_type` != '水' AND  date(`import_time`) = current_date()-1 AND `review_status`='通过审核' and `enable`='启用' AND `region` = '$area'");
}else{
    $resultForUnit = $conn->query("select count(`tsn`) as `num` from `t_enterprise_info` where `review_status`='通过审核'");      //用能单位总数
    $resultForPoint = $conn->query("select count(`tsn`) as `num1` from `t_collecting_point`");   //采集点总数
    $resultForEquival = $conn->query("select sum(`a`.`daily_equival_value`) as `sum2` from `t_daily_data` as `a` LEFT JOIN `t_enterprise_info` as `b` ON `a`.`enter_tsn`=`b`.`tsn` WHERE `energy_big_type` != '水' AND  date(`import_time`) = current_date()-1 AND `review_status`='通过审核' and `enable`='启用'");                          //前一日能耗当量值
}
if($resultForUnit) {
    $rowForUnit = mysqli_fetch_array($resultForUnit);
}

if($resultForPoint){
    $rowForPoint = mysqli_fetch_array($resultForPoint);
}
if($resultForEquival){
    $rowForEquival = mysqli_fetch_array($resultForEquival);
}
array_push($array,$rowForUnit['num']*1,$rowForPoint['num1']*1,$rowForEquival['sum2']*1);
echo json_encode($array);
mysqli_close($conn);