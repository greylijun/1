<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/1
 * Time: 9:18
 */
include "../../../utils/conn.php";
$area = $_GET['area'];
$industry = $_GET['industry'];
$second_industry_type = $_GET['second_industry_type'];
$name = $_GET['name'];
$state = $_GET['state'];
$array = array();
$sql = "select `tsn`,`region`,`industry_type`,`unit_industry_type`,`enterprise_name`,`business_contacts`,`contact_number`,`business_phone`,`lic_image_path`,ifnull(`longitude`,'') as `longitude`,ifnull(`latitude`,'') as `latitude`,`review_status` from `t_enterprise_info`  where `review_status`='{$state}'";
if($area != "全市"){
    $sql .= " and `region`='{$area}'";
}


if($industry != "全行业"){
    $sql .= " and `industry_type`='{$industry}'";
}

if($second_industry_type != "全行业"){
    $sql .= " and `unit_industry_type`='{$second_industry_type}'";
}

if($name != "所有企业"){
    $sql .= " and `enterprise_name`='{$name}'";
}

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
        $temp = array(
            'region'=>$row['region'],
            'industry_type'=>$row['industry_type'],
            'name'=>$row['enterprise_name'],
            'business_contacts'=>$row['business_contacts'],
            'contact_number'=>$row['contact_number'],
            'business_phone'=>$row['business_phone'],
            'lic_image_path'=>"../../".$row['lic_image_path'],
            'longitude'=>$row['longitude'],
            'latitude'=>$row['latitude'],
            'review'=>$row['review_status'],
        );
    array_push($array,$temp);
}
echo json_encode($array);
mysqli_close($conn);