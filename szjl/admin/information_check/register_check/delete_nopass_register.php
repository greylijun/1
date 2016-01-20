<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/25
 * Time: 14:03
 */
include "../../../utils/conn.php";
$name = $_GET['name'];
$state = $_GET['state'];

$del = "delete from `t_enterprise_info` where `review_status`='{$state}' and `enterprise_name`='{$name}'";
if(mysqli_query($conn,$del)){
    echo "8006";
}else{
    echo "8007";
}
mysqli_close($conn);