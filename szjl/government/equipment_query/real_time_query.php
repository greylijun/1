<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/17
 * Time: 13:19
 */
include "../../utils/conn.php";
$array = array();
$area = $_GET['region'];
$industry = $_GET['industry_type'];
$unit_name = $_GET['unit_name'];
$sql = "select `enterprise_name`,`point_region`,`path_number`,`grade_table`,`point_state` from `t_collecting_point` a left join `t_enterprise_info` b on `a`.`enter_tsn`=`b`.`tsn` where `b`.`review_status`='通过审核'";

if($area != "全市"){
    $sql .= " and `region`='{$area}'";
}

if($industry != "全行业"){
    $sql .= " and `industry_type` = '{$industry}'";
}

if($unit_name != "所有企业"){
    $sql .= " and `enterprise_name` = '{$unit_name}'";
}

$result=mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_array($result)){
        $temp = array(
            'name'=>$row['enterprise_name'],                      //单位名称
            'point_region'=>$row['point_region'],                 //区域
            'path_number'=>$row['path_number'],                   //模块编号
            'grade_table'=>$row['grade_table'],                   //表的等级
            'point_state'=>$row['point_state']                    //模块状态
        );
        array_push($array,$temp);
    }
}
echo json_encode($array);
mysqli_close($conn);