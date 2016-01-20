<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/20
 * Time: 10:00
 */
error_reporting(0);
include "../../utils/conn.php";
$area = $_GET['area'];
$industry = $_GET['industry'];
$key = $_GET['key'];
$year = $_GET['year'];
$array = array();
$sqlForNum = "select count(`limit_year`) from `t_limit_summary` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where `audit_state`='通过审核' and `review_status`='通过审核'";
if($area != "全市"){
    $sqlForNum .= " and `b`.`region`='{$area}'";
}
if($industry != "全行业"){
    $sqlForNum .= " and `b`.`industry_type`='{$industry}'";
}
if($key != "所有企业"){
    $sqlForNum .= " and `b`.`enterprise_name`='{$key}'";
}
if($year != "全部"){
    $sqlForNum .= " and `limit_year`='{$year}'";
}
$resultForNum = mysqli_query($conn,$sqlForNum);
if($resultForNum){
    $rowForNum = mysqli_fetch_array($resultForNum);
    $num = $rowForNum['count(`limit_year`)'];
}

$sql = "select `b`.`enterprise_name` as `name`,`enter_tsn`,`limit_year`,`fill_energy_equival_limit`,`fill_energy_indiff_limit`,`fill_source_indiff_limit`,`hand_energy_equival_limit`,`hand_energy_indiff_limit`,`hand_source_indiff_limit`,`revise_energy_equival_limit`,`revise_energy_indiff_limit`,`revise_source_indiff_limit` from `t_limit_summary` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where `audit_state`='通过审核' and `review_status`='通过审核'";
if($area != "全市"){
    $sql .= " and `b`.`region`='{$area}'";
}
if($industry != "全行业"){
    $sql .= " and `b`.`industry_type`='{$industry}'";
}
if($key != "所有企业"){
    $sql .= " and `b`.`enterprise_name`='{$key}'";
}
if($year != "全部"){
    $sql .= " and `limit_year`='{$year}'";
}

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    if($row['revise_energy_equival_limit'] == ""){
        if($row['hand_energy_equival_limit'] == ""){
            $name[] = $row['name'];
            $enter_tsn[] =$row['enter_tsn'];
            $limit_year[] = $row['limit_year'];
            $energy_eqival_limit[] = $row['fill_energy_equival_limit'];
            $energy_indiff_limit[] = $row['fill_energy_indiff_limit'];
            $source_indiff_limit[] = $row['fill_source_indiff_limit'];

        }else{
            $name[] = $row['name'];
            $enter_tsn[] =$row['enter_tsn'];
            $limit_year[] = $row['limit_year'];
            $energy_eqival_limit[] = $row['hand_energy_equival_limit'];
            $energy_indiff_limit[] = $row['hand_energy_indiff_limit'];
            $source_indiff_limit[] = $row['hand_source_indiff_limit'];
        }
    }else{
        $name[] = $row['name'];
        $enter_tsn[] =$row['enter_tsn'];
        $limit_year[] = $row['limit_year'];
        $energy_eqival_limit[] = $row['revise_energy_equival_limit'];
        $energy_indiff_limit[] = $row['revise_energy_indiff_limit'];
        $source_indiff_limit[] = $row['revise_source_indiff_limit'];
    }
}

for($i=0;$i<$num;$i++){
    $sqlForData = "select sum(`daily_equival_value`) as `year_equival_value`,sum(`daily_indiff_value`) as `year_indiff_value` from `t_daily_data`  where `energy_big_type` != '水' and year(`import_time`)='{$limit_year[$i]}' and `enter_tsn`='{$enter_tsn[$i]}' and `enable`='启用'";
    $resultForData = mysqli_query($conn,$sqlForData);
    while($rowForData = mysqli_fetch_array($resultForData)){
        $year_equival_value[] = $rowForData['year_equival_value'];
        $year_indiff_value[] = $rowForData['year_indiff_value'];
    }
    $sqlForSource = "select sum(`daily_indiff_value`) as `year_indiff_source` from `t_daily_data`  where  year(`import_time`)='{$limit_year[$i]}' and `enter_tsn`='{$enter_tsn[$i]}' and `enable`='启用'";
    $resultForSource = mysqli_query($conn,$sqlForSource);
    while($rowForSource =mysqli_fetch_array($resultForSource)){
        $year_indiff_source[] = $rowForSource['year_indiff_source'];
    }
}

for($a=0;$a<$num;$a++){
    $temp = array(
        'name'=>$name[$a],
        'limit_year'=>$limit_year[$a],
        'energy_eqival_limit'=>$energy_eqival_limit[$a]*1,
        'energy_indiff_limit'=>$energy_indiff_limit[$a]*1,
        'source_indiff_limit'=>$source_indiff_limit[$a]*1,
        'year_equival_value'=>$year_equival_value[$a]*1,
        'year_indiff_value'=>$year_indiff_value[$a]*1,
        'year_source_indiff_value'=>$year_indiff_source[$a]*1
    );
    array_push($array,$temp);
}
echo json_encode($array);
mysqli_close($conn);




