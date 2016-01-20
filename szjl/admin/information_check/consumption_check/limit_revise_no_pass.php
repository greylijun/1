<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/24
 * Time: 14:53
 */
include "../../../utils/conn.php";
$date = $_POST['date'];
$name = $_POST['name'];
$water_last_limit_value = $_POST['water_last_limit_value'];
$water_last_limit_value_unit = $_POST['water_last_limit_value_unit'];
$last_limit_value = $_POST['last_limit_value'];
$last_limit_value_unit = $_POST['last_limit_value_unit'];
$select_state = $_POST['select_state'];
$water_if_beyond = $_POST['water_if_beyond'];
$if_beyond = $_POST['if_beyond'];
$sql = "select `tsn` from `t_enterprise_info` where `enterprise_name`='{$name}' and `review_status`='通过审核'";
$result = mysqli_query($conn,$sql);
if($result){
    $row =mysqli_fetch_array($result);
}
$tsn = $row['tsn'];
$updateLimit = "update `t_tech_limit_fill` set `water_last_limit_value`='{$water_last_limit_value}',`water_last_limit_value_unit`='{$water_last_limit_value_unit}',`last_limit_value`='{$last_limit_value}',`last_limit_value_unit`='{$last_limit_value_unit}',`water_if_beyond`='{$water_if_beyond}',`if_beyond`='{$if_beyond}',`limit_select`='{$select_state}',`audit_state`='未通过审核' where `enter_tsn`='{$tsn}' and `Crt_date`='{$date}'";
if(mysqli_query($conn,$updateLimit)){
    echo "数据更新成功！";
}else{
    echo "数据更新失败！";
}
mysqli_close($conn);