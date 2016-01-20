<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/10
 * Time: 11:17
 */
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$table_one_type = $_GET['table_one_type'];
$table_two_type = $_GET['table_two_type'];
$array = array();
$sqlForThree = "select `c`.`path_number` as `three_number` from `t_collecting_point` as `a` inner join `t_energy_small_type` as `b` on `a`.`energy_small_tsn`=`b`.`tsn` inner join `t_collecting_point` as `c` on `a`.`path_number`=`c`.`last_grade_number` where `energy_big_type`='{$table_one_type}' and `a`.`path_number`='{$table_two_type}' and `a`.`enter_tsn`='{$enter_tsn}'";
$resultForThree = mysqli_query($conn,$sqlForThree);
while($rowForThree = mysqli_fetch_array($resultForThree)){
    $type3[] = $rowForThree['three_number'];
}
array_push($array,$type3);
echo json_encode($array);
mysqli_close($conn);