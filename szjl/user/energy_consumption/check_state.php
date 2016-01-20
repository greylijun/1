<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/29
 * Time: 15:02
 */
include "../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$sql = "select `audit_state` from `t_tech_limit_fill` where `enter_tsn`='{$enter_tsn}' and `audit_state`='未审核'";
$result = mysqli_query($conn,$sql);
if($row = mysqli_fetch_array($result)){
    echo '8006';
}else{
    echo '8007';
}
mysqli_close($conn);