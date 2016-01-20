<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/18
 * Time: 18:51
 */
include '../../utils/conn.php';
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$sqlForYear = "select * from `t_tech_limit_fill` where `enter_tsn`='{$enter_tsn}' and `audit_state`='通过审核' order by Crt_date desc limit 1";
$resultForYear = mysqli_query($conn,$sqlForYear);
while($rowForYear = mysqli_fetch_array($resultForYear)){
    $temp = array(
        'water_energy_consumption'=>$rowForYear['water_energy_consumption'],               //水的综合能耗
        'water_energy_con_unit'=>$rowForYear['water_energy_con_unit'],                     //水的综合能耗单位
        'water_production'=>$rowForYear['water_production'],                               //水的产量
        'water_production_unit'=>$rowForYear['water_production_unit'],                     //水的产量单位
        'water_energy_con_unit_pro'=>$rowForYear['water_energy_con_unit_pro'],             //水的单位产品综合能耗
        'water_energy_con_unit_pro_unit'=>$rowForYear['water_energy_con_unit_pro_unit'],   //水的单位产品综合能耗单位
        'water_limit_num'=>$rowForYear['water_limit_num'],                                 //水的限额编号
        'water_category_name'=>$rowForYear['water_category_name'],                         //水的类别名称
        'water_limit_value'=>$rowForYear['water_limit_value'],                             //水的定额值
        'water_limit_value_unit'=>$rowForYear['water_limit_value_unit'],                   //水的定额值单位
        'water_revise_limit_value'=>$rowForYear['water_revise_limit_value'],               //水的修改限额值
        'water_revise_limit_value_unit'=>$rowForYear['water_revise_limit_value_unit'],     //水的修改限额值单位
        'energy_consumption'=>$rowForYear['energy_consumption'],
        'energy_con_unit'=>$rowForYear['energy_con_unit'],
        'production'=>$rowForYear['production'],
        'production_unit'=>$rowForYear['production_unit'],
        'energy_con_unit_pro'=>$rowForYear['energy_con_unit_pro'],
        'energy_con_unit_pro_unit'=>$rowForYear['energy_con_unit_pro_unit'] ,
        'limit_num'=>$rowForYear['limit_num'],
        'category_name'=>$rowForYear['category_name'],
        'limit_value'=>$rowForYear['limit_value'],
        'limit_value_unit'=>$rowForYear['limit_value_unit'],
        'revise_limit_value'=>$rowForYear['revise_limit_value'],
        'revise_limit_value_unit'=>$rowForYear['revise_limit_value_unit']
    );
}
echo json_encode($temp);
mysqli_close($conn);