<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/16
 * Time: 10:43
 */
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$array = array();
$point_number = array();
$type = array();
//选择表的编号
$sql = "select `path_number` from `t_collecting_point` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where `a`.`enter_tsn`='{$enter_tsn}' and `b`.`review_status`='通过审核'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $point_number[] = $row['path_number'];
}
echo json_encode($point_number);
mysqli_close($conn);