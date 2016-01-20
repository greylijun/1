<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/14
 * Time: 11:21
 */
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$table_one_type = $_GET['table_one_type'];
$array = array();
$sql = "select `path_number` from `t_collecting_point` as `a` left join `t_energy_small_type` as `b` on `a`.`energy_small_tsn`=`b`.`tsn` where `enter_tsn`='{$enter_tsn}' and `energy_big_type`='{$table_one_type}' and `grade_table`='2'";
$result = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
    $type2[] = $row['path_number'];
}
echo json_encode($type2);
mysqli_close($conn);
