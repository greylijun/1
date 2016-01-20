<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/25
 * Time: 9:24
 */
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$data_year = $_GET['data_year'];
$data_month = $_GET['data_month'];
$modify_date = $data_year."-".$data_month;

$sql = "select `enter_tsn` from `t_energy_data_entry` where `modify_date`='{$modify_date}' and `state` = '未审核' and `enter_tsn`='{$enter_tsn}'";
$result = mysqli_query($conn,$sql);
if($result){
    $row = mysqli_fetch_array($result);
}
if($row['enter_tsn'] != ""){
    echo "8007";
}else{
    echo "8006";
}
mysqli_close($conn);