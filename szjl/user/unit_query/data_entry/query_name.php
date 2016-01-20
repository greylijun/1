<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/17
 * Time: 8:53
 */
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$project_name = $_POST['project_name'];

$sql = " select `project_name` from `t_energy_saving_measures_plan` where `project_name`='{$project_name}' and `enter_tsn`='{$enter_tsn}'";
$result = mysqli_query($conn,$sql);
if($result){
    $row = mysqli_fetch_array($result);
}
if($row['project_name'] != ""){
    echo "8006";
}else{
    echo "8007";
}
mysqli_close($conn);