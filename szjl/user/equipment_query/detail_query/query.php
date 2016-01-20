<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/16
 * Time: 14:23
 */
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$source_type = $_GET['source_type'];
$table_id = $_GET['table_id'];
$array = array();
$sql = "select `path_number`,`energy_big_type`,`grade_table`,`standard_equ_fold`,`standard_equ_discount`,`energy_unit` from `t_collecting_point` as `a` left join `t_energy_small_type` as `b` on `a`.`energy_small_tsn`=`b`.`tsn` where `a`.`enter_tsn`='{$enter_tsn}'";

if($table_id != "全部"){
    $sql .= " and `path_number`='{$table_id}'";
}
if($source_type != "所有资源"){
    $sql .= " and `energy_big_type`='{$source_type}'";
}
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $temp = array(
        'point_num'=>$row['path_number'],
        'source_type'=>$row['energy_big_type'],
        'grade_table'=>$row['grade_table'],
        'equ_fold'=>$row['standard_equ_fold'],
        'equ_discount'=>$row['standard_equ_discount'],
        'energy_unit'=>$row['energy_unit']
    );
    array_push($array,$temp);
}
echo json_encode($array);
mysqli_close($conn);