<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/12
 * Time: 15:33
 */
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$name = $_GET['pro_name'];
$sql =$conn->query("select `start_time`,`end_time`,`investment_volume`,`save_money`,`material_volume`,`payback_period`,`technical_renovation_content` from `t_energy_saving_measures_plan` where `project_name`='{$name}' and `enter_tsn`='{$enter_tsn}'");
$row = mysqli_fetch_array($sql);
$array = array(
    'start_time' =>$row['start_time'],                         //开始日期
    'end_time' => $row['end_time'],                            //结束日期
    'investment'=>$row['investment_volume'],                   //投资额
    'money'=>$row['save_money'],                               //节约金额
    'material'=>$row['material_volume'],                       //实物量
    'payback' => $row['payback_period'],                       //回收期
    'address'=>$row['technical_renovation_content'],           //技改方案内容
);
echo json_encode($array);
mysqli_close($conn);