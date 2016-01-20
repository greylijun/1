<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/21
 * Time: 11:17
 */
include "../../../utils/conn.php";
$time = $_GET['date'];
$area = $_GET['area'];
$industry = $_GET['industry'];
$name = $_GET['name'];
$state = $_GET['state'];
$array = array();

$sqlForNum = "select count(`enter_tsn`) from `t_energy_data_entry` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where `b`.`review_status` ='通过审核' and `a`.`state`='{$state}'";
if($area != "全市"){
    $sqlForNum .= " and `region`='{$area}'";
}

if($industry != "全行业"){
    $sqlForNum .= " and `industry_type`='{$industry}'";
}

if($name != "所有企业"){
    $sqlForNum .= " and `enterprise_name`='{$name}'";
}

if($time != ""){
    $sqlForNum .= " and date(`fill_date`)='{$time}'";
}

$resultForNum = mysqli_query($conn,$sqlForNum);
$RowForNum = mysqli_fetch_array($resultForNum);
if($RowForNum){
    $tsn = $RowForNum['count(`enter_tsn`)'];
}

$sql = "select `b`.`enterprise_name`,`a`.* from `t_energy_data_entry` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where `b`.`review_status` ='通过审核' and `a`.`state`='{$state}'";
if($area != "全市"){
    $sql .= " and `region`='{$area}'";
}

if($industry != "全行业"){
    $sql .= " and `industry_type`='{$industry}'";
}

if($name != "所有企业"){
    $sql .= " and `enterprise_name`='{$name}'";
}

if($time != ""){
    $sql .= " and date(`fill_date`)='{$time}'";
}

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $daily_data_coal[] = $row['raw_coal_con']+$row['washing_coal_con']+$row['midding_con']+$row['slurry_con']+$row['coke_con'];                                                //煤的消耗量
    $coal_equival_value[] = 0.7143*$row['raw_coal_con']+0.9000*$row['washing_coal_con']+0.2857*$row['midding_con']+0.3572*$row['slurry_con']+0.9714*$row['coke_con'];            //煤的当量折标
    $coal_indiff_value[] = 0.7143*$row['raw_coal_con']+0.9000*$row['washing_coal_con']+0.2857*$row['midding_con']+0.3572*$row['slurry_con']+0.9714*$row['coke_con'];            //煤的等价折标

    $daily_data_oil[] = $row['crude_oil_con']+$row['fuel_oil_con']+$row['gasoline_con']+$row['kerosene_con']+$row['diesel_oil_con']+$row['coal_tar_con']+$row['residuum_con'];
    //油的消耗量
    $oil_equival_value[] = 1.4286*$row['crude_oil_con']+1.4286*$row['fuel_oil_con']+1.4714*$row['gasoline_con']+1.4286*$row['kerosene_con']+1.4571*$row['diesel_oil_con']+1.1429*$row['coal_tar_con']+1.4286*$row['residuum_con'];
    //油的当量折标
    $oil_indiff_value[] = 1.4286*$row['crude_oil_con']+1.4286*$row['fuel_oil_con']+1.4714*$row['gasoline_con']+1.4286*$row['kerosene_con']+1.4571*$row['diesel_oil_con']+1.1429*$row['coal_tar_con']+1.4286*$row['residuum_con'];
    //油的等价折标

    $daily_data_water[] = $row['new_water_con']+$row['soft_water_con']+$row['deo_water_con'];
  //水的消耗量
    $water_equival_value[] = 0.0857*$row['new_water_con']+0.4857*$row['soft_water_con']+0.9714*$row['deo_water_con'];  //水的当量折标
    $water_indiff_value[] = 0.0857*$row['new_water_con']+0.4857*$row['soft_water_con']+0.9714*$row['deo_water_con'];   //水的等价折标

    $daily_data_gas[] = $row['liq_pet_gas_con']+$row['refinery_gas_con']+$row['oil_field_gas_con']+$row['gas_field_gas_con']+$row['coal_mine_gas_con']+$row['coke_gas_con']+$row['blast_furn_gas_con']+$row['generator_gas_con']+$row['heavy_oil_con']+$row['thermal_cracking_gas_con']+$row['coke_gasification_con']+$row['pressurized_gas_con']+$row['water_gas_con'];                    //天然气的消耗量
    $gas_equival_value[] = 0.7143*$row['liq_pet_gas_con']+0.5714*$row['refinery_gas_con']+0.3300*$row['oil_field_gas_con']+0.2143*$row['gas_field_gas_con']+0.53570*$row['coal_mine_gas_con']+0.59290*$row['coke_gas_con']+0.1286*$row['blast_furn_gas_con']+0.1786*$row['generator_gas_con']+0.6571*$row['heavy_oil_con']+1.2143*$row['thermal_cracking_gas_con']+0.5571*$row['coke_gasification_con']+0.5143*$row['pressurized_gas_con']+0.3571*$row['water_gas_con'];   //天然气当量折标
    $gas_indiff_value[] = 0.7143*$row['liq_pet_gas_con']+0.5714*$row['refinery_gas_con']+0.3300*$row['oil_field_gas_con']+0.2143*$row['gas_field_gas_con']+0.53570*$row['coal_mine_gas_con']+0.59290*$row['coke_gas_con']+0.1286*$row['blast_furn_gas_con']+0.1786*$row['generator_gas_con']+0.6571*$row['heavy_oil_con']+1.2143*$row['thermal_cracking_gas_con']+0.5571*$row['coke_gasification_con']+0.5143*$row['pressurized_gas_con']+0.3571*$row['water_gas_con'];   //天然气等价折标

    $electricity[] = $row['electric_con'];                         //电的消耗量
    $electricity_equival_value[] = 0.1229*$row['electric_con'];    //电的当量折标
    $electricity_indiff_value[] = 4.0400*$row['electric_con'];     //电的等价折标

    $cold_quantity[] = $row['cold_quantity_con'];                 //冷量的消耗量
    $cold_equival_value[] = 0.03412*$row['cold_quantity_con'];    //冷量当量折标
    $cold_indiff_value[] = 0.03412*$row['cold_quantity_con'];     //冷量等价折标

    $steam[] = $row['steam_con'];                           //蒸汽消耗量
    $steam_equival_value[] = 0.1286*$row['steam_con'];      //蒸汽当量折标
    $steam_indiff_value[] = 0.1286*$row['steam_con'];       //蒸汽等价折标

    $enter_tsn[] = $row['enter_tsn'];
    $month_day[] = $row['month_day'];
    $modify_date[] = $row['modify_date'];
    $data_state[] = $row['state'];
    $fill_date[] = substr($row['fill_date'],0,10);
    $enter_name[] = $row['enterprise_name'];
}

for($i=0;$i<$tsn;$i++){
    $sqlForOriginal = "select ifnull(sum(case `energy_big_type` when '水' then `daily_indiff_value` else 0 end),0) 'water',ifnull(sum(case `energy_big_type` when '电' then `daily_indiff_value` else 0 end),0) 'electrical',ifnull(sum(case `energy_big_type` when '煤' then `daily_indiff_value` else 0 end),0) 'coal',ifnull(sum(case `energy_big_type` when '油' then `daily_indiff_value` else 0 end),0) 'oil',ifnull(sum(case `energy_big_type` when '天然气' then `daily_indiff_value` else 0 end),0) 'gas',ifnull(sum(case `energy_big_type` when '蒸汽' then `daily_indiff_value` else 0 end),0) 'steam',ifnull(sum(case `energy_big_type` when '冷量' then `daily_indiff_value` else 0 end),0) 'cold' from `t_daily_data` where `enter_tsn`='{$enter_tsn[$i]}' and `enable` = '启用' and DATE_FORMAT(`import_time`,'%Y-%m')='{$modify_date[$i]}'";
    $resultForOriginal = mysqli_query($conn,$sqlForOriginal);
    while($rowForOriginal = mysqli_fetch_array($resultForOriginal)){
        $temp = array(
            'enter_name'=>$enter_name[$i],                           //用能单位名称
            'state'=>$data_state[$i],                                //审核状态
            'import_time'=>$modify_date[$i],                         //修改月份
            'upd_date'=>$fill_date[$i],                              //填报时间
            'water'=>$rowForOriginal['water'],                       //等价水
            'electrical'=>$rowForOriginal['electrical'],             //等价电
            'coal'=>$rowForOriginal['coal'],                         //等价煤
            'oil'=>$rowForOriginal['oil'],                           //等价油
            'gas'=>$rowForOriginal['gas'],                           //等价天然气
            'steam'=>$rowForOriginal['steam'],                       //等价蒸汽
            'cold'=>$rowForOriginal['cold'],                         //等价冷量
            'hand_water'=>$water_indiff_value[$i],                //等价修改水
            'hand_electrical'=>$electricity_indiff_value[$i],      //等价修改电
            'hand_coal'=>$coal_indiff_value[$i],                  //等价修改煤
            'hand_oil'=>$oil_indiff_value[$i],                    //等价修改油
            'hand_gas'=>$gas_indiff_value[$i],                    //等价修改天然气
            'hand_steam'=>$steam_indiff_value[$i],                //等价修改蒸汽
            'hand_cold'=>$cold_indiff_value[$i]                   //等价修改冷量
        );
        array_push($array,$temp);
    }
}
echo json_encode($array);
mysqli_close($conn);
