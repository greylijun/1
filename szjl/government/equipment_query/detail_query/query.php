<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/16
 * Time: 14:23
 */
include "../../../utils/conn.php";
$area = $_GET['area'];
$industry = $_GET['industry'];
$enter_name = $_GET['enter_name'];
$source_type = $_GET['source_type'];
$table_id = $_GET['table_id'];
$array = array();
$sql = "select `region`,`industry_type`,`enterprise_name`,`path_number`,`energy_big_type`,`grade_table`,`standard_equ_fold`,`standard_equ_discount`,`energy_unit` from (`t_collecting_point` as `a` inner join `t_enterprise_info` as `b` on `a`.`enter_tsn` = `b`.`tsn`) inner join `t_energy_small_type` as `c` on `a`.`energy_small_tsn`=`c`.`tsn` where `b`.`review_status`='通过审核'";
if($area != "全市"){
    $sql .= " and `region`='{$area}'";
}
if($industry != "全行业"){
    $sql .= " and `industry_type`='{$industry}'";
}
if($enter_name != "所有企业"){
    $sql .= " and `enterprise_name`='{$enter_name}'";
}
if($table_id != ""){
    $sql .= " and `path_number`='{$table_id}'";
}
if($source_type != "所有资源"){
    $sql .= " and `energy_big_type`='{$source_type}'";
}
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $temp = array(
        'region'=>$row['region'],
        'type'=>$row['industry_type'],
        'name'=>$row['enterprise_name'],
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