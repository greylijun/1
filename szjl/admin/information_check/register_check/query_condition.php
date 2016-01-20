<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/13
 * Time: 9:25
 */
include "../../../utils/conn.php";
$enter_name =array();
$area=$_GET['area'];
$industry=$_GET['industry'];
$second_industry_type = $_GET['second_industry_type'];
$sql ="select `enterprise_name` from `t_enterprise_info` where `review_status` !=''";
if($area != "全市"){
    $sql .= " and `region`='{$area}'";
}

if($industry != "全行业"){
    $sql .= " and `industry_type`='{$industry}'";
}

if($second_industry_type != "全行业"){
    $sql .= " and `second_industry_type`='{$second_industry_type}'";
}

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $enter_name[] = $row['enterprise_name'];
}
echo json_encode($enter_name);
mysqli_close($conn);
