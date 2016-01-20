<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/20
 * Time: 9:06
 */
include "../../utils/conn.php";
$array = array();
$temp = array();
$unit = $_GET['unit'];
$energy_type = $_GET['energy_type'];
$model_number = $_GET['model_number'];

$sqlForTsn = $conn->query("select `tsn` from `t_enterprise_info` where `enterprise_name`='{$unit}' and `review_status`='通过审核'");
$rowForTsn = mysqli_fetch_array($sqlForTsn);
$tsn = $rowForTsn['tsn'];

$sql = "select `path_number`,ifnull(`last_grade_number`,'') as `last_grade_number`,`grade_table`,`energy_big_type`,`energy_small_name`,`point_equival_standard`,`point_indiff_standard`,`instrument_name`,`model_num` from `t_collecting_point` as `a` left join `t_energy_small_type` as `b` on `a`.`energy_small_tsn`=`b`.`tsn` where `enter_tsn`='{$tsn}'";

if($energy_type != "全部"){
    $sql .= " and `b`.`energy_big_type`='{$energy_type}'";
}

if($model_number != ""){
    $sql .= " and `a`.`path_number`='{$model_number}'";
}

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $temp = array(
        'unit_name' => $unit,                              //单位名称
        'path_number' => $row['path_number'],              //管理编号
        'last_grade_number' => $row['last_grade_number'],  //上一级管理编号
        'grade_table' => $row['grade_table'],              //分级分项
        'energy_big_type' => $row['energy_big_type'],      //资源类型
        'energy_small_name' => $row['energy_small_name'],  //具体资源类型
        'point_equival_standard' => $row['point_equival_standard'],  //该采集点当量折标系数
        'point_indiff_standard' => $row['point_indiff_standard'],    //该采集点等价折标系数
        'instrument_name' => $row['instrument_name'],      //器具名称
        'model_num' => $row['model_num']                   //型号
    );
    array_push($array,$temp);
}
echo json_encode($array);
mysqli_close($conn);