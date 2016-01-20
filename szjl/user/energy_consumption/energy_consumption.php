<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/17
 * Time: 16:14
 */
include "../../utils/conn.php";
$array = array();
$serial_num = $_GET['serial_num'];
$sql = "select `category_name`,`fixed_unit`,`fixed_value`,`serial_num` from `t_technology_limit` where `serial_num`='{$serial_num}'";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_array($result)){
        $temp = array(
            'serial_num' => $row['serial_num'],                 //编号
            'category_name' => $row['category_name'],           //工艺类型
            'fixed_unit' => $row['fixed_unit'],                 //限额单位
            'fixed_value' => $row['fixed_value']                //限额值
        );
        array_push($array,$temp);
    }
}
echo json_encode($array);
mysqli_close($conn);