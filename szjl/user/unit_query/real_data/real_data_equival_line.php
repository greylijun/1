<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/7
 * Time: 11:13
 */
include "../../../utils/conn.php";
session_start();
$array = array();
$data = array();
$data2 = array();
$enter_tsn = $_SESSION['enter_tsn'];
$sql = $conn->query("select sum(`equival_using_energy`),DATE_FORMAT(import_time,'%H:%i') from `t_back_step` where `enter_tsn`='{$enter_tsn}'  group by `import_time` order by `import_time` desc limit 1");
while($result= mysqli_fetch_array($sql)){
    $data[]=$result[0]*1;
}

$sqlForIndiff = $conn->query("select sum(`indiff_using_energy`),DATE_FORMAT(import_time,'%H:%i') from `t_back_step` where `enter_tsn`='{$enter_tsn}' group by `import_time` order by `import_time` desc limit 1");
while($resultForIndiff = mysqli_fetch_array($sqlForIndiff)){
    $data2[] = $resultForIndiff[0]*1;
}
array_push($array,$data,$data2);
echo json_encode($array);
mysqli_close($conn);