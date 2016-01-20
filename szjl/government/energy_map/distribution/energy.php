<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/3
 * Time: 13:49
 */
error_reporting(0);
include "../../../utils/conn.php";
$year = date('Y').'-01-01 00:00:00';
$area = $_GET['area'];
if($area != "全市"){
    $sql = "select count(`tsn`) as `tsn` from `t_enterprise_info` where `review_status`='通过审核' and `region`='$area'";
}else{
    $sql = "select count(`tsn`) as `tsn` from `t_enterprise_info` where `review_status`='通过审核'";
}
$result = mysqli_query($conn,$sql);
if($result){
    $row = mysqli_fetch_array($result);
}
$num = $row['tsn'];
$array= array();
$array0 = array();
$array1 = array();
$array2 = array();
$array3 = array();
$array4 = array();
$array5 = array();
$array6 = array();
$array7 = array();
$array8 = array();
$array9 = array();

 //今年累计能耗量
if($area != "全市"){
    $sqlForYear = "select sum(`b`.`daily_equival_value`) as `sum_year` from `t_enterprise_info` as `a` left join `t_daily_data` as `b` on `a`.`tsn`=`b`.`enter_tsn` where `b`.`energy_big_type` != '水' AND `a`.`region`='$area' AND `a`.`review_status`='通过审核' AND `b`.`enable`='启用' AND `b`.`import_time` BETWEEN '{$year}' AND current_time() group by `a`.`tsn`";
}else{
    $sqlForYear = "select sum(`b`.`daily_equival_value`) as `sum_year` from `t_enterprise_info` as `a` left join `t_daily_data` as `b` on `a`.`tsn`=`b`.`enter_tsn` where `b`.`energy_big_type` != '水' AND `a`.`review_status`='通过审核' AND `b`.`enable`='启用' AND `b`.`import_time` BETWEEN '{$year}' AND current_time() group by `a`.`tsn` order by `a`.`tsn` asc";
}
    $resultForYear = mysqli_query($conn, $sqlForYear);
while($rowForYear = mysqli_fetch_array($resultForYear)){
    $array2[] = $rowForYear['sum_year'];
}
//企业基本信息、地址、采集点数
if($area != "全市"){
    $sqlForMap = "select sum(`equival_using_energy`) as `sum_daily` from `t_enterprise_info` as `a` left join `t_back_step` as `b` on `a`.`tsn`=`b`.`enter_tsn` where `region`='{$area}' and `a`.`review_status`='通过审核' and `b`.`import_time` BETWEEN current_date AND current_time() group by `a`.`tsn` order by `a`.`tsn` asc";
    $sqlForEnter = "select `tsn`,`enterprise_name`,`organization_code`,`production_address`,`longitude`,`latitude`,`unit_image_path`,`region` from t_enterprise_info where `review_status`='通过审核' and `region`='{$area}' order by `tsn` asc";
    $sqlForPoint = "select count(`path_number`) as `path_number` from `t_enterprise_info` as `a` left join `t_collecting_point` as `b` on `a`.`tsn`=`b`.`enter_tsn` where `review_status`='通过审核' and `region`='{$area}' group by `a`.`tsn` order by `a`.`tsn` asc";
}else{
    $sqlForMap = "select sum(`equival_using_energy`) as `sum_daily` from `t_enterprise_info` as `a` left join `t_back_step` as `b` on `a`.`tsn`=`b`.`enter_tsn` where `a`.`review_status`='通过审核' and `b`.`import_time` BETWEEN current_date AND current_time() group by `a`.`tsn` order by `a`.`tsn` asc";
    $sqlForEnter = "select `tsn`,`enterprise_name`,`organization_code`,`production_address`,`longitude`,`latitude`,`unit_image_path`,`region` from t_enterprise_info where `review_status`='通过审核' order by `tsn` asc";
    $sqlForPoint = "select count(`path_number`) as `path_number` from `t_enterprise_info` as `a` left join `t_collecting_point` as `b` on `a`.`tsn`=`b`.`enter_tsn` where `review_status`='通过审核' group by `a`.`tsn` order by `a`.`tsn` asc";
}
    $resultForMap = mysqli_query($conn, $sqlForMap);
    $resultForEnter = mysqli_query($conn,$sqlForEnter);
    $resultForPoint = mysqli_query($conn,$sqlForPoint);
while($rowForEnter = mysqli_fetch_array($resultForEnter)){
    $array3[] = $rowForEnter['enterprise_name'];
    $array4[] = $rowForEnter['organization_code'];
    $array5[] = $rowForEnter['production_address'];
    $array6[] = $rowForEnter['longitude'];
    $array7[] = $rowForEnter['latitude'];
    $array8[] = $rowForEnter['unit_image_path'];
    $array9[] = $rowForEnter['region'];
}
while ($rowForMap = mysqli_fetch_array($resultForMap)) {
        $array1[] = $rowForMap['sum_daily'];
}
while($rowForPoint = mysqli_fetch_array($resultForPoint)){
    $array0[] = $rowForPoint['path_number'];
}

for($i=0;$i<$num;$i++){
    $temp = array(
            'name' => $array3[$i],                    //单位名称
            'code' => $array4[$i],                    //组织机构代码
            'address' => $array5[$i],                 //地址
            'longitude' => $array6[$i],               //经度
            'latitude' => $array7[$i],                //纬度
            'image_path' => "../".$array8[$i],              //图片路径
            'region' => $array9[$i],                  //行政区
            'point_number' => $array0[$i]*1,            //采集点数
            'daily_consumption' => $array1[$i]*1,       //当日采集情况
            'year_consumption' => $array2[$i]*1         //今年累计耗量
    );
    array_push($array,$temp);
}
echo json_encode($array);

