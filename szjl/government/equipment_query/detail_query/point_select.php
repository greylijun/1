<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/16
 * Time: 10:43
 */
include "../../../utils/conn.php";
$enter_name = $_GET['enter_name'];
$array = array();
$point_number = array();
$type = array();
//选择表的编号
$sql = "select `path_number` from `t_collecting_point` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where `b`.`review_status`='通过审核'";
if($enter_name != "所有企业"){
    $sql .= " and `enterprise_name`='{$enter_name}'";
}
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $point_number[] = $row['path_number'];
}
echo json_encode($point_number);
mysqli_close($conn);