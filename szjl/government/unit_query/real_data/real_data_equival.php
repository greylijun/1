<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/7
 * Time: 9:35
 */
include "../../../utils/conn.php";
session_start();
$array = array();
$data = array();
$data2 = array();
$code = $_SESSION['organization_code'];
$sqlForEnter = $conn->query("select `tsn` from `t_enterprise_info` where `organization_code`='{$code}'  and `review_status`='通过审核'");
$resultForEnter = mysqli_fetch_array($sqlForEnter);
$enter_tsn = $resultForEnter['tsn'];

$sql = $conn->query("select sum(`equival_using_energy`),DATE_FORMAT(import_time,'%H:%i') from `t_back_step` where `enter_tsn`='{$enter_tsn}' group by `import_time` order by `import_time` desc limit 300");
while($result= mysqli_fetch_array($sql)){
    $data[]=$result[0]*1;
}

$sqlForIndiff = $conn->query("select sum(`indiff_using_energy`),DATE_FORMAT(import_time,'%H:%i') from `t_back_step` where `enter_tsn`='{$enter_tsn}' group by `import_time` order by `import_time` desc limit 300");
while($resultForIndiff = mysqli_fetch_array($sqlForIndiff)){
    $data2[] = $resultForIndiff[0]*1;
}
array_push($array,$data,$data2);
echo json_encode($array);
mysqli_close($conn);