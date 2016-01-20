<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/13
 * Time: 9:25
 */
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$enter_name =array();
$sql ="select `enterprise_name` from `t_enterprise_info` where `tsn`='{$enter_tsn}' and `review_status`='通过审核'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $enter_name[] = $row['enterprise_name'];
}
echo json_encode($enter_name);
