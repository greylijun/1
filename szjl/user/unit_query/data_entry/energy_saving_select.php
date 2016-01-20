<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/12
 * Time: 15:16
 */
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$sql = $conn->query("select `project_name` from `t_energy_saving_measures_plan` where `enter_tsn`='{$enter_tsn}' and `if_finish`='否' order by `Crt_date` DESC ");
$array=array();
while($row = mysqli_fetch_array($sql)){
    $temp[] = $row['project_name'];
}
echo json_encode($temp);
mysqli_close($conn);