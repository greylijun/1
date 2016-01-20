<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/23
 * Time: 16:44
 */
include "../../../utils/conn.php";
$area = $_GET['area'];
$industry = $_GET['industry'];
$enter_name = $_GET['name'];
$year = $_GET['year'];
$state = $_GET['state'];
$array = array();
$sql = "select `enterprise_name`,`limit_year`,ifnull(`water_limit_value`,'') as water_limit_value,ifnull(`water_limit_value_unit`,'') as water_limit_value_unit,`water_energy_con_unit_pro`,`water_energy_con_unit_pro_unit`,ifnull(`water_revise_limit_value`,'') as water_revise_limit_value,ifnull(`water_revise_limit_value_unit`,'') as water_revise_limit_value_unit,ifnull(`water_last_limit_value`,'') as water_last_limit_value,ifnull(`water_last_limit_value_unit`,'') as water_last_limit_value_unit,ifnull(`limit_value`,'') as limit_value,ifnull(`limit_value_unit`,'') as limit_value_unit,`energy_con_unit_pro`,`energy_con_unit_pro_unit`,ifnull(`revise_limit_value`,'') as revise_limit_value,ifnull(`revise_limit_value_unit`,'') as revise_limit_value_unit,ifnull(`last_limit_value`,'') as last_limit_value,ifnull(`last_limit_value_unit`,'') as last_limit_value_unit,ifnull(`limit_select`,'') as limit_select,`audit_state`,`a`.`Crt_date` as Crt_date from `t_tech_limit_fill` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where 1=1";
if($area != "全市"){
    $sql .= " and `b`.`region`='{$area}'";
}
if($industry != "全行业"){
    $sql .= " and `b`.`industry_type`='{$industry}'";
}
if($enter_name != "所有企业"){
    $sql .= " and `b`.`enterprise_name`='{$enter_name}'";
}
if($year != "全部"){
    $sql .= " and `limit_year`='{$year}'";
}
if($state != "全部"){
    $sql .= " and `audit_state`='{$state}'";
}
$sql .= " order by `a`.`Crt_date` desc";
$result = mysqli_query($conn,$sql);
while($row= mysqli_fetch_array($result)){
    $temp = array(
        'enterprise_name'=>$row['enterprise_name'],
        'limit_year'=>$row['limit_year'],
        'water_limit_value'=>$row['water_limit_value'],                              //水的定额值
        'water_limit_value_unit'=>$row['water_limit_value_unit'],                    //水的定额值单位
        'water_energy_con_unit_pro'=>$row['water_energy_con_unit_pro'],              //水的单位产品综合能耗
        'water_energy_con_unit_pro_unit'=>$row['water_energy_con_unit_pro_unit'],    //水的单位产品综合能耗单位
        'water_revise_limit_value'=>$row['water_revise_limit_value'],                //水的修改限额值
        'water_revise_limit_value_unit'=>$row['water_revise_limit_value_unit'],      //水的修改限额值单位
        'water_last_limit_value'=>$row['water_last_limit_value'],                    //水的限额最终修改值
        'water_last_limit_value_unit'=>$row['water_last_limit_value_unit'],          //水的限额最终修改值单位
        'limit_value'=>$row['limit_value'],
        'limit_value_unit'=>$row['limit_value_unit'],
        'energy_con_unit_pro'=>$row['energy_con_unit_pro'],
        'energy_con_unit_pro_unit'=>$row['energy_con_unit_pro_unit'],
        'revise_limit_value'=>$row['revise_limit_value'],
        'revise_limit_value_unit'=>$row['revise_limit_value_unit'],
        'last_limit_value'=>$row['last_limit_value'],
        'last_limit_value_unit'=>$row['last_limit_value_unit'],
        'limit_select'=>$row['limit_select'],
        'audit_state'=>$row['audit_state'],
        'Crt_date'=>$row['Crt_date']
    );
    array_push($array,$temp);
}
echo json_encode($array);
mysqli_close($conn);