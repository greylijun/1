<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/13
 * Time: 9:13
 */
include "../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$array=array();
$start_time = $_GET['start_time'];
$end_time = $_GET['end_time'];
$fixed = $_GET['if_fixed'];
$sql = "select `instrument_name`,`model_num`,`path_number`,`failure_time`,`recovery_time`,`if_fixed`,`enterprise_name` from (`t_collecting_point` as `a` inner join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn`) inner join `t_equipment_log` as `c` on `a`.`tsn`=`c`.`point_tsn` where `b`.`review_status`='通过审核' and `b`.`tsn`='{$enter_tsn}'";

if($start_time != "" && $end_time == ""){
    $sql .= " and `failure_time` between '{$start_time}' and current_time";
}

if($end_time != "" && $start_time == ""){
    $sql .= " and `failure_time` between '2015-01-01' and '{$end_time}'";
}

if($start_time != "" && $end_time != ""){
    $sql .= " and `failure_time` between '{$start_time}' and '{$end_time}'";
}

if($fixed != "全部"){
    $sql .= " and `if_fixed` = '{$fixed}'";
}

$result = mysqli_query($conn,$sql);
if($result){
    while($row=mysqli_fetch_array($result)){
        if($row['recovery_time'] == null){
            $temp = array(
                'path_number'=> $row['path_number'],                      //模块编号
                'instrument_name'=>$row['instrument_name'],               //器具名称
                'model_num'=>$row['model_num'],                           //型号
                'failure_time'=>$row['failure_time'],                     //最后响应时间
                'recovery_time'=>"",                   //恢复时间
                'fixed'=>$row['if_fixed']                                 //是否修复
            );
        }else{
            $temp = array(
                'path_number'=> $row['path_number'],                      //模块编号
                'instrument_name'=>$row['instrument_name'],               //器具名称
                'model_num'=>$row['model_num'],                           //型号
                'failure_time'=>$row['failure_time'],                     //最后响应时间
                'recovery_time'=>$row['recovery_time'],                   //恢复时间
                'fixed'=>$row['if_fixed']                                 //是否修复
            );
        }
        array_push($array,$temp);
    }
}
echo json_encode($array);
mysqli_close($conn);