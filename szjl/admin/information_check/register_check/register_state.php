<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/1
 * Time: 14:01
 */
include "../../../utils/conn.php";
$name = $_POST['name'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$state = $_POST['state'];

$sql = " update `t_enterprise_info` set `longitude`='{$longitude}',`latitude`='{$latitude}',`review_status`='{$state}' where `enterprise_name`='{$name}' and `review_status` != '未通过审核'";
if(mysqli_query($conn,$sql)){
    echo "8006";
}else{
    echo "8007";
}
mysqli_close($conn);