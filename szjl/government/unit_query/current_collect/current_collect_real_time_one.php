<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/14
 * Time: 8:55
 */
include "../../../utils/conn.php";
session_start();
$table_one_type = $_GET['table_one_type'];
$array = array();
$data = array();
$data2 = array();
$code = $_SESSION['organization_code'];
$sqlForEnter = $conn->query("select `tsn` from `t_enterprise_info` where `organization_code`='{$code}'  and `review_status`='通过审核'");
$resultForEnter = mysqli_fetch_array($sqlForEnter);
$enter_tsn = $resultForEnter['tsn'];

$sql = "select sum(`equival_using_energy`),DATE_FORMAT(import_time,'%H:%i') from `t_back_step` where `enter_tsn`='{$enter_tsn}'";
if($table_one_type != "全部"){
    $sql .= " and `energy_big_type` = '{$table_one_type}' and `table_grade` = '1'";
}else{
    $sql .= " and `table_grade` = '1'";
}
//if($table_two_type != "全部"){
//    $sql .= " and `path_number`='{$table_two_type}' and `table_grade`='2'";
//}
//if($table_three_type != "全部"){
//    $sql .= " and `path_number`='{$table_three_type}' and `table_grade`='3'";
//}
$sql .= "group by `import_time` order by `import_time` desc limit 300";
$result = mysqli_query($conn,$sql);
while($row= mysqli_fetch_array($result)){
    $data[]=$row[0]*1;
}

$sqlForIndiff = "select sum(`indiff_using_energy`),DATE_FORMAT(import_time,'%H:%i') from `t_back_step` where `enter_tsn`='{$enter_tsn}'";
if($table_one_type != "全部"){
    $sqlForIndiff .= " and `energy_big_type`='{$table_one_type}' and `table_grade`='1'";
}else{
    $sqlForIndiff .= " and `table_grade` = '1'";
}
//if($table_two_type != "全部"){
//    $sqlForIndiff .= " and `path_number`='{$table_two_type}' and `table_grade`='2'";
//}
//if($table_three_type != "全部"){
//    $sqlForIndiff .= " and `path_number` = '{$table_three_type}' and `table_grade`='3'";
//}
$sqlForIndiff .="group by `import_time` order by `import_time` desc limit 300";
$resultForIndiff = mysqli_query($conn,$sqlForIndiff);
while($rowForIndiff = mysqli_fetch_array($resultForIndiff)){
    $data2[] = $rowForIndiff[0]*1;
}
array_push($array,$data,$data2);
echo json_encode($array);
mysqli_close($conn);