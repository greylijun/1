<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/23
 * Time: 8:35
 */
include "../../utils/conn.php";
error_reporting(0);
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$array = array();
$sqlForNum = "select count(`limit_year`) from `t_limit_summary` where `enter_tsn`='{$enter_tsn}' and `audit_state`='通过审核'";
$resultForNum = mysqli_query($conn,$sqlForNum);
if($resultForNum){
    $rowForNum = mysqli_fetch_array($resultForNum);
    $num = $rowForNum['count(`limit_year`)'];
}
$sql = "select `limit_year`,`fill_energy_equival_limit`,`fill_energy_indiff_limit`,`fill_source_indiff_limit`,`hand_energy_equival_limit`,`hand_energy_indiff_limit`,`hand_source_indiff_limit`,`revise_energy_equival_limit`,`revise_energy_indiff_limit`,`revise_source_indiff_limit` from `t_limit_summary` where `enter_tsn`='{$enter_tsn}' and `audit_state`='通过审核' order by `limit_year` asc";

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    if($row['revise_energy_equival_limit'] == ""){
        if($row['hand_energy_equival_limit'] == ""){
            $year[] = $row['limit_year'];
            $energy_eqival_limit[] = $row['fill_energy_equival_limit'];
            $energy_indiff_limit[] = $row['fill_energy_indiff_limit'];
            $source_indiff_limit[] = $row['fill_source_indiff_limit'];
        }else{
            $year[] = $row['limit_year'];
            $energy_eqival_limit[] = $row['hand_energy_equival_limit'];
            $energy_indiff_limit[] = $row['hand_energy_indiff_limit'];
            $source_indiff_limit[] = $row['hand_source_indiff_limit'];
        }
    }else{
        $year[] = $row['limit_year'];
        $energy_eqival_limit[] = $row['revise_energy_equival_limit'];
        $energy_indiff_limit[] = $row['revise_energy_indiff_limit'];
        $source_indiff_limit[] = $row['revise_source_indiff_limit'];
    }
}
if($year != null){
    //能源消耗量的当量值和等价值
    $sqlForData = "select sum(`daily_equival_value`),sum(`daily_indiff_value`) from `t_daily_data` where `energy_big_type` != '水' and `enter_tsn`='{$enter_tsn}' and `enable`='启用' group by year(`import_time`) order by year(`import_time`) asc";
    $resultForData = mysqli_query($conn,$sqlForData);
    while($rowForData = mysqli_fetch_array($resultForData)){
        $year_equival_value[]=$rowForData['sum(`daily_equival_value`)'];
        $year_indiff_value[]=$rowForData['sum(`daily_indiff_value`)'];
    }

//资源消耗的等价值
    $sqlForSource = "select sum(`daily_indiff_value`) from `t_daily_data` where `enter_tsn`='{$enter_tsn}' and `enable`='启用' group by year(`import_time`) order by year(`import_time`) asc";
    $resultForSource = mysqli_query($conn,$sqlForSource);
    while($rowForSource = mysqli_fetch_array($resultForSource)){
        $year_source_indiff_value[] = $rowForSource['sum(`daily_indiff_value`)'];
    }

//查找当前企业的信息
    $sqlForEnter = "select `enterprise_name` from `t_enterprise_info` where `tsn`='{$enter_tsn}'";
    $resultForEnter = mysqli_query($conn,$sqlForEnter);
    if($resultForEnter){
        $rowForEnter = mysqli_fetch_array($resultForEnter);
    }

    for($i=0;$i<$num;$i++){
        $temp = array(
            'year'=>$year[$i],
            'name'=>$rowForEnter['enterprise_name'],
            'energy_eqival_limit'=>$energy_eqival_limit[$i],        //当量能源总限额值
            'energy_indiff_limit'=>$energy_indiff_limit[$i],        //等价能源总限额值
            'source_indiff_limit'=>$source_indiff_limit[$i],        //等价资源总限额值
            'year_equival_value'=>$year_equival_value[$i],          //当量能源总消耗量
            'year_indiff_value'=>$year_indiff_value[$i],            //等价能源总消耗量
            'year_source_indiff_value'=>$year_source_indiff_value[$i] //等价资源总消耗量
        );
        array_push($array,$temp);
    }
    echo json_encode($array);
}else{
    echo "8007";
}

