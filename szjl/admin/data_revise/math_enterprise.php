<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/10
 * Time: 10:10
 */
error_reporting(0);
include "../../utils/conn.php";
$enter_name = array();
$textValue = $_POST['textValue'];
$sql = "select `enterprise_name` from `t_enterprise_info` where `review_status`='通过审核' and `enterprise_name` like '%".$textValue."%' limit 2";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $enter_name[] = $row[0];
}
echo json_encode($enter_name);
mysqli_close($conn);