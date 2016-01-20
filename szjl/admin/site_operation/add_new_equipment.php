<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/19
 * Time: 14:33
 */
include "../../utils/conn.php";
error_reporting(0);
$name = $_POST['InsertUnitName'];                                      //单位名称
$InsertModuleId = $_POST['InsertModuleId'];                            //管理编号
$InsertUpperLevelModuleId = $_POST['InsertUpperLevelModuleId'];        //上一级管理编号
$InsertMeterLevel = $_POST['InsertMeterLevel'];                        //分级分项
$InsertResourceType = $_POST['InsertResourceType'];                    //资源类型
$InsertSpecificResourceType = $_POST['InsertSpecificResourceType'];    //具体资源类型
$InsertEquivalentCoefficient = $_POST['InsertEquivalentCoefficient'];  //当量系数
$InsertEquivalentFactor = $_POST['InsertEquivalentFactor'];            //等价系数
$EquipmentName = $_POST['EquipmentName'];                              //器具名称
$Model = $_POST['Model'];                                              //型号
$user_IP = gethostbyname($_ENV['COMPUTERNAME']);                       //获取ip

//获取用能单位tsn和行政区域
$sqlForEnterTsn = $conn->query("select `tsn`,`region` from `t_enterprise_info` where `enterprise_name`='{$name}' and `review_status`='通过审核'");
$rowForEnterTsn = mysqli_fetch_array($sqlForEnterTsn);
$enter_tsn = $rowForEnterTsn['tsn'];                        //enter_tsn
$region = $rowForEnterTsn['region'];                        //行政区域

//获取能源小类tsn
$sqlForEnergyTsn = $conn->query("select `tsn`,`energy_unit` from `t_energy_small_type` where `energy_small_name`='{$InsertSpecificResourceType}'");
$rowForEnergyTsn = mysqli_fetch_array($sqlForEnergyTsn);
$energy_small_tsn = $rowForEnergyTsn['tsn'];                //能源小类tsn
$energy_unit = $rowForEnergyTsn['energy_unit'];             //单位

//采集点tsn
$sqlForTsn = $conn->query("select ifnull(max(`tsn`),'0') as `tsn` from `t_collecting_point`");
$rowForTsn = mysqli_fetch_array($sqlForTsn);
$tsn = $rowForTsn['tsn']+1;

$insert = "insert into `t_collecting_point`(tsn,enter_tsn,point_region,grade_table,last_grade_number,energy_small_tsn,instrument_name,model_num,path_number,point_equival_standard,point_indiff_standard,unit,point_state,Crt_date,Crt_ip) values('{$tsn}','{$enter_tsn}','{$region}','{$InsertMeterLevel}','{$InsertUpperLevelModuleId}','{$energy_small_tsn}','{$EquipmentName}','{$Model}','{$InsertModuleId}','{$InsertEquivalentCoefficient}','{$InsertEquivalentFactor}','{$energy_unit}','正常',CURRENT_TIME ,'{$user_IP}')";
if(mysqli_query($conn,$insert)){
    echo '8006';
}else{
    echo '8007';
}

mysqli_close($conn);