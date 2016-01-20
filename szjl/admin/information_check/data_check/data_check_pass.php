<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/26
 * Time: 13:32
 */
include "../../../utils/conn.php";
$name = $_POST['unit_name'];
$modify_date = $_POST['modify_date'];
$fill_date = $_POST['fill_date'];

$sql = "select `tsn` from `t_enterprise_info` where `enterprise_name`='{$name}'";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_array($result);
    $tsn = $row['tsn'];
}

$sqlForEnergy = "select * from `t_energy_data_entry` where `enter_tsn`='{$tsn}' and date(`fill_date`)='{$fill_date}' and `modify_date`='{$modify_date}' and `state`='未审核'";
$resultForEnergy = mysqli_query($conn, $sqlForEnergy);
if ($resultForEnergy) {
    $rowForEnergy = mysqli_fetch_array($resultForEnergy);
    $num = $rowForEnergy['month_day'];
    $daily_data_coal = $rowForEnergy['raw_coal_con'] + $rowForEnergy['washing_coal_con'] + $rowForEnergy['midding_con'] + $rowForEnergy['slurry_con'] + $rowForEnergy['coke_con'];             //煤的消耗量

    $daily_data_oil = $rowForEnergy['crude_oil_con'] + $rowForEnergy['fuel_oil_con'] + $rowForEnergy['gasoline_con'] + $rowForEnergy['kerosene_con'] + $rowForEnergy['diesel_oil_con'] + $rowForEnergy['coal_tar_con'] + $rowForEnergy['residuum_con'];                //油的消耗量

    $daily_data_water = $rowForEnergy['new_water_con'] + $rowForEnergy['soft_water_con'] + $rowForEnergy['deo_water_con'];                              //水的消耗量
    $daily_data_gas = $rowForEnergy['liq_pet_gas_con'] + $rowForEnergy['refinery_gas_con'] + $rowForEnergy['oil_field_gas_con'] + $rowForEnergy['gas_field_gas_con'] + $rowForEnergy['coal_mine_gas_con'] + $rowForEnergy['coke_gas_con'] + $rowForEnergy['blast_furn_gas_con'] + $rowForEnergy['generator_gas_con'] + $rowForEnergy['heavy_oil_con'] + $rowForEnergy['thermal_cracking_gas_con'] + $rowForEnergy['coke_gasification_con'] + $rowForEnergy['pressurized_gas_con'] + $rowForEnergy['water_gas_con'];                 //天然气的消耗量
    $electricity = $rowForEnergy['electric_con'];                        //电的消耗量
    $cold_quantity = $rowForEnergy['cold_quantity_con'];                 //冷量的消耗量
    $steam = $rowForEnergy['steam_con'];                                 //蒸汽消耗量
}

//插入煤的相关数据
if ($daily_data_coal != "0") {
    $update = "update `t_daily_data` set `enable`='不启用' where `enter_tsn`='{$tsn}' and `verification_state` = '' and `energy_big_type`='煤' and date_format(`import_time`,'%Y-%m')='{$modify_date}'";
    if (mysqli_query($conn, $update)) {
        echo "8006";
    } else {
        echo "8007";
    }
    $insert = "insert into `t_daily_data`(tsn,enter_tsn,import_time,energy_big_type,daily_data_amount,daily_equival_value,daily_indiff_value,enable,if_original_data) select '1',`enter_tsn`,`calendar_date`,'煤',((`crude_oil_con`+`washing_coal_con`+`midding_con`+`slurry_con`+`coke_con`)/$num),((0.7143*`raw_coal_con`+0.9000*`washing_coal_con`+0.2857*`midding_con`+0.3572*`slurry_con`+ 0.9714*`coke_con`)/$num),((0.7143*`raw_coal_con`+0.9000*`washing_coal_con`+0.2857*`midding_con`+0.3572*`slurry_con`+ 0.9714*`coke_con`)/$num),'启用','否' from `t_energy_data_entry` as `a` left join `t_year_day` as `b` on `a`.`modify_date`=date_format(`calendar_date`,'%Y-%m')  where `enter_tsn`='{$tsn}' and date(`fill_date`)='{$fill_date}' and `modify_date`='{$modify_date}'  and `state`='未审核'";
    mysqli_query($conn, $insert);
}

//插入油的相关数据
if ($daily_data_oil != "0") {
    $update2 = "update `t_daily_data` set `enable`='不启用' where `enter_tsn`='{$tsn}' and `verification_state` = '' and `energy_big_type`='油' and date_format(`import_time`,'%Y-%m')='{$modify_date}'";
    if (mysqli_query($conn, $update2)) {
        echo "8006";
    } else {
        echo "8007";
    }
    $insert2 = "insert into `t_daily_data`(tsn,enter_tsn,import_time,energy_big_type,daily_data_amount,daily_equival_value,daily_indiff_value,enable,if_original_data) select '1',`enter_tsn`,`calendar_date`,'油',((`crude_oil_con`+`fuel_oil_con`+`gasoline_con`+`kerosene_con`+`diesel_oil_con`+`coal_tar_con`+`residuum_con`)/$num),((1.4286*`crude_oil_con`+1.4286*`fuel_oil_con`+1.4714*`gasoline_con`+1.4286*`kerosene_con`+1.4571*`diesel_oil_con`+1.1429*`coal_tar_con`+1.4286*`residuum_con`)/$num),((1.4286*`crude_oil_con`+1.4286*`fuel_oil_con`+1.4714*`gasoline_con`+1.4286*`kerosene_con`+1.4571*`diesel_oil_con`+1.1429*`coal_tar_con`+1.4286*`residuum_con`)/$num),'启用','否' from `t_energy_data_entry` as `a` left join `t_year_day` as `b` on `a`.`modify_date`=date_format(`calendar_date`,'%Y-%m')  where `enter_tsn`='{$tsn}' and date(`fill_date`)='{$fill_date}' and `modify_date`='{$modify_date}'  and `state`='未审核'";
    mysqli_query($conn, $insert2);
}

//插入水的相关数据
if ($daily_data_water != "0") {
    $update3 = "update `t_daily_data` set `enable`='不启用' where `enter_tsn`='{$tsn}' and `verification_state` = '' and `energy_big_type`='水' and date_format(`import_time`,'%Y-%m')='{$modify_date}'";
    if (mysqli_query($conn, $update3)) {
        echo "8006";
    } else {
        echo "8007";
    }
    $insert3 = "insert into `t_daily_data`(tsn,enter_tsn,import_time,energy_big_type,daily_data_amount,daily_equival_value,daily_indiff_value,enable,if_original_data) select '1',`enter_tsn`,`calendar_date`,'水',((`new_water_con`+`soft_water_con`+`deo_water_con`)/$num),((0.0857*`new_water_con`+0.4857*`soft_water_con`+0.9714*`deo_water_con`)/$num),((0.0857*`new_water_con`+0.4857*`soft_water_con`+0.9714*`deo_water_con`)/$num),'启用','否' from `t_energy_data_entry` as `a` left join `t_year_day` as `b` on `a`.`modify_date`=date_format(`calendar_date`,'%Y-%m')  where `enter_tsn`='{$tsn}' and date(`fill_date`)='{$fill_date}' and `modify_date`='{$modify_date}'  and `state`='未审核'";
    mysqli_query($conn, $insert3);
}

//插入天然气的相关数据
if ($daily_data_gas != "0") {
    $update4 = "update `t_daily_data` set `enable`='不启用' where `enter_tsn`='{$tsn}' and `verification_state` = '' and `energy_big_type`='天然气' and date_format(`import_time`,'%Y-%m')='{$modify_date}'";
    if (mysqli_query($conn, $update4)) {
        echo "8006";
    } else {
        echo "8007";
    }
    $insert4 = "insert into `t_daily_data`(tsn,enter_tsn,import_time,energy_big_type,daily_data_amount,daily_equival_value,daily_indiff_value,enable,if_original_data) select '1',`enter_tsn`,`calendar_date`,'天然气',((`liq_pet_gas_con`+`refinery_gas_con`+`oil_field_gas_con`+`gas_field_gas_con`+`coal_mine_gas_con`+`coke_gas_con`+`blast_furn_gas_con`+`generator_gas_con`+`heavy_oil_con`+`thermal_cracking_gas_con`+`coke_gasification_con`+`pressurized_gas_con`+`water_gas_con`)/$num),((0.7143*`liq_pet_gas_con`+0.5714*`refinery_gas_con`+0.3300*`oil_field_gas_con`+0.2143*`gas_field_gas_con`+0.53570*`coal_mine_gas_con`+0.59290*`coke_gas_con`+0.1286*`blast_furn_gas_con`+0.1786*`generator_gas_con`+0.6571*`heavy_oil_con`+1.2143*`thermal_cracking_gas_con`+0.5571*`coke_gasification_con`+0.5143*`pressurized_gas_con`+0.3571*`water_gas_con`)/$num),((0.7143*`liq_pet_gas_con`+0.5714*`refinery_gas_con`+0.3300*`oil_field_gas_con`+0.2143*`gas_field_gas_con`+0.53570*`coal_mine_gas_con`+0.59290*`coke_gas_con`+0.1286*`blast_furn_gas_con`+0.1786*`generator_gas_con`+0.6571*`heavy_oil_con`+1.2143*`thermal_cracking_gas_con`+0.5571*`coke_gasification_con`+0.5143*`pressurized_gas_con`+0.3571*`water_gas_con`)/$num),'启用','否' from `t_energy_data_entry` as `a` left join `t_year_day` as `b` on `a`.`modify_date`=date_format(`calendar_date`,'%Y-%m')  where `enter_tsn`='{$tsn}' and date(`fill_date`)='{$fill_date}' and `modify_date`='{$modify_date}'  and `state`='未审核'";
    mysqli_query($conn, $insert4);
}

//插入电的相关数据
if ($electricity != "0") {
    $update5 = "update `t_daily_data` set `enable`='不启用' where `enter_tsn`='{$tsn}' and `verification_state` = '' and `energy_big_type`='电' and date_format(`import_time`,'%Y-%m')='{$modify_date}'";
    if (mysqli_query($conn, $update5)) {
        echo "8006";
    } else {
        echo "8007";
    }
    $insert5 = "insert into `t_daily_data`(tsn,enter_tsn,import_time,energy_big_type,daily_data_amount,daily_equival_value,daily_indiff_value,enable,if_original_data) select '1',`enter_tsn`,`calendar_date`,'电',((`electric_con`)/$num),((0.1229*`electric_con`)/$num),((4.0400*`electric_con`)/$num),'启用','否' from `t_energy_data_entry` as `a` left join `t_year_day` as `b` on `a`.`modify_date`=date_format(`calendar_date`,'%Y-%m')  where `enter_tsn`='{$tsn}' and date(`fill_date`)='{$fill_date}' and `modify_date`='{$modify_date}'  and `state`='未审核'";
    mysqli_query($conn, $insert5);
}

//插入冷量的相关数据
if ($cold_quantity != "0") {
    $update6 = "update `t_daily_data` set `enable`='不启用' where `enter_tsn`='{$tsn}' and `verification_state` = '' and `energy_big_type`='冷量' and date_format(`import_time`,'%Y-%m')='{$modify_date}'";
    if (mysqli_query($conn, $update6)) {
        echo "8006";
    } else {
        echo "8007";
    }
    $insert6 = "insert into `t_daily_data`(tsn,enter_tsn,import_time,energy_big_type,daily_data_amount,daily_equival_value,daily_indiff_value,enable,if_original_data) select '1',`enter_tsn`,`calendar_date`,'冷量',((`cold_quantity_con`)/$num),((0.03412*`cold_quantity_con`)/$num),((0.03412*`cold_quantity_con`)/$num),'启用','否' from `t_energy_data_entry` as `a` left join `t_year_day` as `b` on `a`.`modify_date`=date_format(`calendar_date`,'%Y-%m')  where `enter_tsn`='{$tsn}' and date(`fill_date`)='{$fill_date}' and `modify_date`='{$modify_date}'  and `state`='未审核'";
    mysqli_query($conn, $insert6);
}

//插入蒸汽的相关数据
if ($steam != "0") {
    $update7 = "update `t_daily_data` set `enable`='不启用' where `enter_tsn`='{$tsn}' and `verification_state` = '' and `energy_big_type`='蒸汽' and date_format(`import_time`,'%Y-%m')='{$modify_date}'";
    if (mysqli_query($conn, $update7)) {
        echo "8006";
    } else {
        echo "8007";
    }
    $insert7 = "insert into `t_daily_data`(tsn,enter_tsn,import_time,energy_big_type,daily_data_amount,daily_equival_value,daily_indiff_value,enable,if_original_data) select '1',`enter_tsn`,`calendar_date`,'蒸汽',((`steam_con`)/$num),((0.1286*`steam_con`)/$num),((0.1286*`steam_con`)/$num),'启用','否' from `t_energy_data_entry` as `a` left join `t_year_day` as `b` on `a`.`modify_date`=date_format(`calendar_date`,'%Y-%m')  where `enter_tsn`='{$tsn}' and date(`fill_date`)='{$fill_date}' and `modify_date`='{$modify_date}' and `state`='未审核'";
    mysqli_query($conn, $insert7);
}

$update0 = "update `t_energy_data_entry` set `state`='通过审核' where `enter_tsn`='{$tsn}' and date(`fill_date`)='{$fill_date}' and `modify_date`='{$modify_date}' and `state`='未审核'";
mysqli_query($conn,$update0);
mysqli_close($conn);