<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/26
 * Time: 15:40
 */
include "../../../utils/conn.php";
$unit_name = $_GET['unit_name'];
$modify_date = $_GET['modify_date'];    //修改日期
$fill_date = $_GET['fill_date'];        //填报日期
//$array = array();
$sqlForTsn = " select `tsn` from `t_enterprise_info` where `enterprise_name`='{$unit_name}' and `review_status`='通过审核'";
$resultForTsn = mysqli_query($conn,$sqlForTsn);
if($resultForTsn){
    $rowForTsn = mysqli_fetch_array($resultForTsn);
}
$tsn = $rowForTsn['tsn'];
$sql = "select * from `t_energy_data_entry` where `enter_tsn`='{$tsn}' and `modify_date`='{$modify_date}' and date(`fill_date`)='{$fill_date}'";
$result = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
    if($row['certificate_path'] == null){
        $temp = array(
            'raw_coal_con'=>$row['raw_coal_con'],                      //原煤消耗量
            'washing_coal_con'=>$row['washing_coal_con'],              //洗精煤消耗量
            'midding_con'=>$row['midding_con'],                        //洗中煤
            'slurry_con'=>$row['slurry_con'],                          //煤泥
            'coke_con'=>$row['coke_con'],                              //焦炭
            'crude_oil_con'=>$row['crude_oil_con'],                    //原油
            'fuel_oil_con'=>$row['fuel_oil_con'],                      //燃料油
            'gasoline_con'=>$row['gasoline_con'],                      //汽油
            'kerosene_con'=>$row['kerosene_con'],                      //煤油
            'diesel_oil_con'=>$row['diesel_oil_con'],                  //柴油
            'coal_tar_con'=>$row['coal_tar_con'],                      //煤焦油
            'residuum_con'=>$row['residuum_con'],                      //渣油
            'cold_quantity_con'=>$row['cold_quantity_con'],            //冷量
            'steam_con'=>$row['steam_con'],                            //蒸汽（低压）
            'new_water_con'=>$row['new_water_con'],                    //新水
            'soft_water_con'=>$row['soft_water_con'],                  //软水
            'deo_water_con'=>$row['deo_water_con'],                    //除氧水
            'liq_pet_gas_con'=>$row['liq_pet_gas_con'],                //液化石油气
            'refinery_gas_con'=>$row['refinery_gas_con'],              //炼厂干气
            'oil_field_gas_con'=>$row['oil_field_gas_con'],            //油田天然气
            'gas_field_gas_con'=>$row['gas_field_gas_con'],            //气田天然气
            'coal_mine_gas_con'=>$row['coal_mine_gas_con'],            //煤矿瓦斯气
            'coke_gas_con'=>$row['coke_gas_con'],                      //焦炉煤气
            'blast_furn_gas_con'=>$row['blast_furn_gas_con'],          //高炉煤气
            'generator_gas_con'=>$row['generator_gas_con'],            //发生炉煤气
            'heavy_oil_con'=>$row['heavy_oil_con'],                    //重油催化裂解煤气
            'thermal_cracking_gas_con'=>$row['thermal_cracking_gas_con'], //重油热裂解煤气
            'coke_gasification_con'=>$row['coke_gasification_con'],    //焦炭制气
            'pressurized_gas_con'=>$row['pressurized_gas_con'],        //压力气化煤气
            'water_gas_con'=>$row['water_gas_con'],                    //水煤气
            'electric_con'=>$row['electric_con'],                       //电
            'certificate_path'=>""               //凭证路径
        );
    }else{
        $temp = array(
            'raw_coal_con'=>$row['raw_coal_con'],                      //原煤消耗量
            'washing_coal_con'=>$row['washing_coal_con'],              //洗精煤消耗量
            'midding_con'=>$row['midding_con'],                        //洗中煤
            'slurry_con'=>$row['slurry_con'],                          //煤泥
            'coke_con'=>$row['coke_con'],                              //焦炭
            'crude_oil_con'=>$row['crude_oil_con'],                    //原油
            'fuel_oil_con'=>$row['fuel_oil_con'],                      //燃料油
            'gasoline_con'=>$row['gasoline_con'],                      //汽油
            'kerosene_con'=>$row['kerosene_con'],                      //煤油
            'diesel_oil_con'=>$row['diesel_oil_con'],                  //柴油
            'coal_tar_con'=>$row['coal_tar_con'],                      //煤焦油
            'residuum_con'=>$row['residuum_con'],                      //渣油
            'cold_quantity_con'=>$row['cold_quantity_con'],            //冷量
            'steam_con'=>$row['steam_con'],                            //蒸汽（低压）
            'new_water_con'=>$row['new_water_con'],                    //新水
            'soft_water_con'=>$row['soft_water_con'],                  //软水
            'deo_water_con'=>$row['deo_water_con'],                    //除氧水
            'liq_pet_gas_con'=>$row['liq_pet_gas_con'],                //液化石油气
            'refinery_gas_con'=>$row['refinery_gas_con'],              //炼厂干气
            'oil_field_gas_con'=>$row['oil_field_gas_con'],            //油田天然气
            'gas_field_gas_con'=>$row['gas_field_gas_con'],            //气田天然气
            'coal_mine_gas_con'=>$row['coal_mine_gas_con'],            //煤矿瓦斯气
            'coke_gas_con'=>$row['coke_gas_con'],                      //焦炉煤气
            'blast_furn_gas_con'=>$row['blast_furn_gas_con'],          //高炉煤气
            'generator_gas_con'=>$row['generator_gas_con'],            //发生炉煤气
            'heavy_oil_con'=>$row['heavy_oil_con'],                    //重油催化裂解煤气
            'thermal_cracking_gas_con'=>$row['thermal_cracking_gas_con'], //重油热裂解煤气
            'coke_gasification_con'=>$row['coke_gasification_con'],    //焦炭制气
            'pressurized_gas_con'=>$row['pressurized_gas_con'],        //压力气化煤气
            'water_gas_con'=>$row['water_gas_con'],                    //水煤气
            'electric_con'=>$row['electric_con'],                       //电
            'certificate_path'=>$row['certificate_path']               //凭证路径
        );
    }
}
echo json_encode($temp);
mysqli_close($conn);