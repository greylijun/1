<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/24
 * Time: 16:08
 */
include "../../../utils/conn.php";
$name = $_GET['enter_name'];
$array = array();
$sql = "select `tsn` from `t_enterprise_info` where `enterprise_name`='{$name}'";
$result = mysqli_query($conn,$sql);
if($result){
    $row = mysqli_fetch_array($result);
}
$tsn = $row['tsn'];
$sqlForLimit = "select `limit_num`,`category_name`,`fixed_unit`,`limit_production`,`limit_value`,fill_unit from `t_tech_limit_fill` where `enter_tsn`='{$tsn}'";
$resultForLimit = mysqli_query($conn,$sqlForLimit);
while($rowForLimit = mysqli_fetch_array($resultForLimit)){
    $temp = array(
        'limit_num'=>$rowForLimit['limit_num'],
        'category_name'=>$rowForLimit['category_name'],
        'limit_fixed_unit'=>$rowForLimit['fixed_unit'],
        'production'=>$rowForLimit['limit_production'],
        'limit_sum'=>$rowForLimit['limit_value'],
        'unit1'=>explode('/',$rowForLimit['fill_unit'])[0],
        'unit2'=>explode('/',$rowForLimit['fill_unit'])[1]
    );
    array_push($array,$temp);
}
echo json_encode($array);
mysqli_close($conn);