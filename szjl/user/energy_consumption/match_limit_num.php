<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/25
 * Time: 9:49
 */
include "../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$serial_num = $_POST['serial_num'];
$sql = "select `limit_num` from `t_tech_limit_fill` where `limit_num`='{$serial_num}' and `enter_tsn`='{$enter_tsn}'";
$result = mysqli_query($conn,$sql);
if($result){
    $row = mysqli_fetch_array($result);
}
if($row['limit_num'] != ""){
    echo "该限额编号已经存在！";
}else{
    echo "可以插入该限额编号！";
}
mysqli_close($conn);