<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/5
 * Time: 18:11
 */
include "../../../utils/conn.php";
error_reporting(0);
$area = $_GET['user_area'];
$array = array();
$array1 = array();
$array2 = array();
$array3 = array();
$array4 = array();
$array5 = array();
//用能单位数量
if($area == "全市"){
    $sqlForNum = "select count(`tsn`) as `num` from `t_enterprise_info` where `review_status`='通过审核'";
}else{
    $sqlForNum = "select count(`tsn`) as `num` from `t_enterprise_info` where `region`='$area' and `review_status`='通过审核'";
}
$resultForNum = mysqli_query($conn,$sqlForNum);
if($resultForNum){
    $rowForNum = mysqli_fetch_array($resultForNum);
}
$num = $rowForNum['num'];

//前一日能耗量
if($area == "全市"){
    $sql =  "select sum(`daily_equival_value`) as `sum_equival`,sum(`daily_indiff_value`) as `sum_indiff` from `t_enterprise_info` as `a` left join `t_daily_data` as `b` on `a`.`tsn`=`b`.`enter_tsn` where date(`import_time`) = CURRENT_DATE()-1 and `enable`='启用' and `a`.`review_status`='通过审核' group by `a`.`enterprise_name` order by `enter_tsn` asc";
    $sqlForName = "select `enterprise_name`,`longitude`,`latitude`,`region` from `t_enterprise_info` where `review_status`='通过审核' order by `tsn` asc";
}else{
    $sql =  "select sum(`daily_equival_value`) as `sum_equival`,sum(`daily_indiff_value`) as `sum_indiff` from `t_enterprise_info` as `a` left join `t_daily_data` as `b` on `a`.`tsn`=`b`.`enter_tsn` where date(`import_time`) = CURRENT_DATE()-1 and `a`.`region`='{$area}' and `a`.`review_status`='通过审核' and `enable`='启用' group by `a`.`enterprise_name` order by `enter_tsn` asc";
    $sqlForName = "select `enterprise_name`,`longitude`,`latitude`,`region` from `t_enterprise_info` where `region`='{$area}' and `review_status`='通过审核' order by `tsn` asc";
}
$result = mysqli_query($conn,$sql);
$resultForName = mysqli_query($conn,$sqlForName);
while($row = mysqli_fetch_array($result)){
    $array1[] = $row['sum_equival'];
    $array2[] = $row['sum_indiff'];
}
while($rowForName = mysqli_fetch_array($resultForName)){
    $array3[] = $rowForName['enterprise_name'];
    $array4[] = $rowForName['longitude'];
    $array5[] = $rowForName['latitude'];
    $array6[] = $rowForName['region'];
}

for($i=0;$i<$num;$i++){
    $temp = array(
        'sum_equival'=> $array1[$i],         //前一日能耗当量值
        'sum_indiff' => $array2[$i],         //前一日能耗等价值
        'name' => $array3[$i],               //用能单位名称
        'longitude' => $array4[$i],          //经度
        'latitude' => $array5[$i],           //纬度
        'region' => $array6[$i]              //行政区
    );
    array_push($array,$temp);
}
echo json_encode($array);

