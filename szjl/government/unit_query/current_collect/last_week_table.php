<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/8
 * Time: 15:02
 */
include "../../../utils/conn.php";
session_start();
$state = $_GET['state'];
$code = $_SESSION['organization_code'];
$sqlForEnter = $conn->query("select `tsn` from `t_enterprise_info` where `organization_code`='{$code}'  and `review_status`='通过审核'");
$resultForEnter = mysqli_fetch_array($sqlForEnter);
$enter_tsn = $resultForEnter['tsn'];

$energy_total = array();
$percent = array();
$array = array();

if($state == "当量值"){
    $sql =$conn->query("select `enter_tsn`,YEARWEEK(date_format(`import_time`,'%Y-%m-%d')),sum((case `energy_big_type` when '水' then `daily_equival_value` else 0 end)) 'water',sum((case `energy_big_type` when '电' then `daily_equival_value` else 0 end)) 'electrical',sum((case `energy_big_type` when '煤' then `daily_equival_value` else 0 end)) 'coal',sum((case `energy_big_type` when '油' then `daily_equival_value` else 0 end)) 'oil',sum((case `energy_big_type` when '天然气' then `daily_equival_value` else 0 end)) 'gas',sum((case `energy_big_type` when '蒸汽' then `daily_equival_value` else 0 end)) 'steam',sum((case `energy_big_type` when '冷量' then `daily_equival_value` else 0 end)) 'cold' from `t_daily_data` where `enable`='启用' and YEARWEEK(date_format(`import_time`,'%Y-%m-%d'))=YEARWEEK(now())-1 and `enter_tsn`='$enter_tsn' group by YEARWEEK(date_format(`import_time`,'%Y-%m-%d'))");
}else{
    $sql =$conn->query("select `enter_tsn`,YEARWEEK(date_format(`import_time`,'%Y-%m-%d')),sum((case `energy_big_type` when '水' then `daily_indiff_value` else 0 end)) 'water',sum((case `energy_big_type` when '电' then `daily_indiff_value` else 0 end)) 'electrical',sum((case `energy_big_type` when '煤' then `daily_indiff_value` else 0 end)) 'coal',sum((case `energy_big_type` when '油' then `daily_indiff_value` else 0 end)) 'oil',sum((case `energy_big_type` when '天然气' then `daily_indiff_value` else 0 end)) 'gas',sum((case `energy_big_type` when '蒸汽' then `daily_indiff_value` else 0 end)) 'steam',sum((case `energy_big_type` when '冷量' then `daily_indiff_value` else 0 end)) 'cold' from `t_daily_data` where `enable`='启用' and YEARWEEK(date_format(`import_time`,'%Y-%m-%d'))=YEARWEEK(now())-1 and `enter_tsn`='$enter_tsn' group by YEARWEEK(date_format(`import_time`,'%Y-%m-%d'))");
}

$row = mysqli_fetch_array($sql);
if($row['water'] == null){
    $water=0;                  //水的消耗量
    $electrical=0;             //电的消耗量
    $coal=0;                   //煤
    $oil=0;                    //油
    $gas=0;                    //天然气
    $steam=0;                  //蒸汽
    $cold=0;                   //冷量
}else{
    $water=$row['water'];                              //水的消耗量
    $electrical=$row['electrical'];        //电的消耗量
    $coal=$row['coal'];                    //煤
    $oil=$row['oil'];                      //油
    $gas=$row['gas'];                      //天然气
    $steam=$row['steam'];                  //蒸汽
    $cold=$row['cold'];                    //冷量
}

$energy=$row['electrical']+$row['coal']+$row['oil']+$row['gas']+$row['steam']+$row['cold'];           //能源总量
$source=$row['water']+$row['electrical']+$row['coal']+$row['oil']+$row['gas']+$row['steam']+$row['cold']; //资源总量
if($electrical == 0 && $water == 0 && $coal == 0 && $oil == 0 && $gas == 0 && $steam==0 && $cold ==0){
    $water_per = 0;
    $electrical_per = 0;
    $coal_per = 0;
    $oil_per = 0;
    $gas_per = 0;
    $steam_per = 0;
    $cold_per = 0;
    $energy_per = 0;
    $source_per = 0;
}else{
    $water_per = round($water/$source*100,3);
    $electrical_per = round($electrical/$source*100,3);
    $coal_per = round($coal/$source*100,3);
    $oil_per = round($oil/$source*100,3);
    $gas_per = round($gas/$source*100,3);
    $steam_per = round($steam/$source*100,3);
    $cold_per = round($cold/$source*100,3);
    $energy_per = round($energy/$source*100,3);
    $source_per = 100;
}

array_push($energy_total,$water,$electrical,$coal,$oil,$gas,$steam,$cold,$energy,$source);
array_push($percent,$water_per,$electrical_per,$coal_per,$oil_per,$gas_per,$steam_per,$cold_per,$energy_per,$source_per);
array_push($array,$energy_total,$percent);
echo json_encode($array);
mysqli_close($conn);