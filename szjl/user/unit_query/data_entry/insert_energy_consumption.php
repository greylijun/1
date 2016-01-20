<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/11
 * Time: 13:56
 */
include "../../../utils/conn.php";
include "../../../utils/month_day.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$user_name = $_SESSION['user_name'];
$data_year = $_POST['data_year'];
$data_month = $_POST['data_month'];
$modify_date = $data_year."-".$data_month;
$coal1 = $_POST['coal1'];
$coal2 = $_POST['coal2'];
$coal3 = $_POST['coal3'];
$coal4 = $_POST['coal4'];
$coal5 = $_POST['coal5'];
$oil1 = $_POST['oil1'];
$oil2 = $_POST['oil2'];
$oil3 = $_POST['oil3'];
$oil4 = $_POST['oil4'];
$oil5 = $_POST['oil5'];
$oil6 = $_POST['oil6'];
$oil7 = $_POST['oil7'];
$cold_quantity = $_POST['cold_quantity'];                          //冷量的消耗量
$steam = $_POST['steam'];                                          //蒸汽的消耗量
$water1 = $_POST['water1'];
$water2 = $_POST['water2'];
$water3 = $_POST['water3'];
$gas1 = $_POST['gas1'];
$gas2 = $_POST['gas2'];
$gas3 = $_POST['gas3'];
$gas4 = $_POST['gas4'];
$gas5 = $_POST['gas5'];
$gas6 = $_POST['gas6'];
$gas7 = $_POST['gas7'];
$gas8 = $_POST['gas8'];
$gas9 = $_POST['gas9'];
$gas10 = $_POST['gas10'];
$gas11 = $_POST['gas11'];
$gas12 = $_POST['gas12'];
$gas13 = $_POST['gas13'];
$electricity = $_POST['electricity'];                                 //电的消耗量
$month_day = getMonthDay($data_month,$data_year);                               //获得当前月份的天数
$_SESSION['modify_date'] = $modify_date;

$cold_equival_value = 0.03412*$cold_quantity;                        //冷量当量折标
$cold_indiff_value = 0.03412*$cold_quantity;                         //冷量等价折标

$steam_equival_value = 0.1286*$steam;                                //蒸汽当量折标
$steam_indiff_value = 0.1286*$steam;                                 //蒸汽等价折标

$electricity_equival_value = 0.1229*$electricity;                    //电的当量折标
$electricity_indiff_value = 4.0400*$electricity;                     //电的等价折标

$daily_data_coal = $coal1+$coal2+$coal3+$coal4+$coal5;                //煤的消耗量
$coal_equival_value = 0.7143*$coal1+0.9000*$coal2+0.2857*$coal3+0.3572*$coal4+0.9714*$coal5;   //煤的当量折标
$coal_indiff_value = 0.7143*$coal1+0.9000*$coal2+0.2857*$coal3+0.3572*$coal4+0.9714*$coal5;    //煤的等价折标

$daily_data_oil = $oil1+$oil2+$oil3+$oil4+$oil5+$oil6+$oil7;          //油的消耗量
$oil_equival_value = 1.4286*$oil1+1.4286*$oil2+1.4714*$oil3+1.4286*$oil4+1.4571*$oil5+1.1429*$oil6+1.4286*$oil7;
//油的当量折标
$oil_indiff_value = 1.4286*$oil1+1.4286*$oil2+1.4714*$oil3+1.4286*$oil4+1.4571*$oil5+1.1429*$oil6+1.4286*$oil7;
//油的等价折标

$daily_data_water = $water1+$water2+$water3;                          //水的消耗量
$water_equival_value = 0.0857*$water1+0.4857*$water2+0.9714*$water3;  //水的当量折标
$water_indiff_value = 0.0857*$water1+0.4857*$water2+0.9714*$water3;   //水的等价折标

$daily_data_gas = $gas1+$gas2+$gas3+$gas4+$gas5+$gas6+$gas7+$gas8+$gas9+$gas10+$gas11+$gas12+$gas13;    //天然气的消耗量
$gas_equival_value = 0.7143*$gas1+0.5714*$gas2+0.3300*$gas3+0.2143*$gas4+0.53570*$gas5+0.59290*$gas6+0.1286*$gas7+0.1786*$gas8+0.6571*$gas9+1.2143*$gas10+0.5571*$gas11+0.5143*$gas12+0.3571*$gas13;   //天然气当量折标
$gas_indiff_value = 0.7143*$gas1+0.5714*$gas2+0.3300*$gas3+0.2143*$gas4+0.53570*$gas5+0.59290*$gas6+0.1286*$gas7+0.1786*$gas8+0.6571*$gas9+1.2143*$gas10+0.5571*$gas11+0.5143*$gas12+0.3571*$gas13;   //天然气等价折标

$sqlForDate = "select `enter_tsn` from `t_energy_data_entry` where `modify_date`='{$modify_date}' and `state` = '未审核' and `enter_tsn`='{$enter_tsn}'";
$resultForDate = mysqli_query($conn,$sqlForDate);
if($resultForDate){
    $rowForDate = mysqli_fetch_array($resultForDate);
}
if($rowForDate['enter_tsn'] != ""){
    echo "8007";   //当前日期已经存在未审核数据
}else{
    if($daily_data_coal != null || $daily_data_gas != null || $daily_data_oil != null || $daily_data_water != null || $cold_quantity != null || $steam != null || $electricity != null){
        $insert = "insert into `t_energy_data_entry` values (null,'{$enter_tsn}','{$coal1}','{$coal2}','{$coal3}','{$coal4}','{$coal5}','{$oil1}','{$oil2}','{$oil3}','{$oil4}','{$oil5}','{$oil6}','{$oil7}','{$cold_quantity}','{$steam}','{$water1}','{$water2}','{$water3}','{$gas1}','{$gas2}','{$gas3}','{$gas4}','{$gas5}','{$gas6}','{$gas7}','{$gas8}','{$gas9}','{$gas10}','{$gas11}','{$gas12}','{$gas13}','{$electricity}','{$month_day}',null,'未审核','{$modify_date}',CURRENT_TIME )";
        mysqli_query($conn,$insert);
        echo "能耗数据插入成功！";
    }

////插入煤的相关数据
//    if($daily_data_coal != null){
//        $insertSql = "insert into `t_daily_data` values(null,'{$tsn}','{$enter_tsn}','{$date}','煤','{$daily_data_coal}','{$coal_equival_value}','{$coal_indiff_value}','不启用','未审核','否',CURRENT_TIME,null,null,null)";
//        if(mysqli_query($conn,$insertSql)){
//            echo "插入数据成功！";
//        }else{
//            echo "插入数据失败！";
//        }
//    }

////插入天然气的相关数据
//    if($daily_data_gas != null){
//        $insertSql1 = "insert into `t_daily_data` values(null,'{$tsn}','{$enter_tsn}','{$date}','天然气','{$daily_data_gas}','{$gas_equival_value}','{$gas_indiff_value}','不启用','未审核','否',CURRENT_TIME ,null,null,null)";
//        if(mysqli_query($conn,$insertSql1)){
//            echo "插入数据成功！";
//        }else{
//            echo "插入数据失败！";
//        }
//    }
//
////插入油的相关数据
//    if($daily_data_oil != null){
//        $insertSql2 = "insert into `t_daily_data` values(null,'{$tsn}','{$enter_tsn}','{$date}','油','{$daily_data_oil}','{$oil_equival_value}','{$oil_indiff_value}','不启用','未审核','否',CURRENT_TIME,null,null,null)";
//        if(mysqli_query($conn,$insertSql2)){
//            echo "插入数据成功！";
//        }else{
//            echo "插入数据失败！";
//        }
//    }
//
////插入水的相关数据
//    if($daily_data_water != null){
//        $insertSql3 = "insert into `t_daily_data` values(null,'{$tsn}','{$enter_tsn}','{$date}','水','{$daily_data_water}','{$water_equival_value}','{$water_indiff_value}','不启用','未审核','否',CURRENT_TIME,null,null,null)";
//        if(mysqli_query($conn,$insertSql3)){
//            echo "插入数据成功！";
//        }else{
//            echo "插入数据失败！";
//        }
//    }
//
////插入冷量的相关数据
//    if($cold_quantity != null){
//        $insertSql4 = "insert into `t_daily_data` values(null,'{$tsn}','{$enter_tsn}','{$date}','冷量','{$cold_quantity}','{$cold_equival_value}','{$cold_indiff_value}','不启用','未审核','否',CURRENT_TIME,null,null,null)";
//        if(mysqli_query($conn,$insertSql4)){
//            echo "插入数据成功！";
//        }else{
//            echo "插入数据失败！";
//        }
//    }
//
////插入蒸汽的相关数据
//    if($steam != null){
//        $insertSql5 = "insert into `t_daily_data` values(null,'{$tsn}','{$enter_tsn}','{$date}','蒸汽','{$steam}','{$steam_equival_value}','{$steam_indiff_value}','不启用','未审核','否',CURRENT_TIME,null,null,null)";
//        if(mysqli_query($conn,$insertSql5)){
//            echo "插入数据成功！";
//        }else{
//            echo "插入数据失败！";
//        }
//    }
//
////插入电的相关数据
//    if($electricity != null){
//        $insertSql6 = "insert into `t_daily_data` values(null,'{$tsn}','{$enter_tsn}','{$date}','电','{$electricity}','{$electricity_equival_value}','{$electricity_indiff_value}','不启用','未审核','否',CURRENT_TIME,null,null,null)";
//        if(mysqli_query($conn,$insertSql6)){
//            echo "插入数据成功！";
//        }else{
//            echo "插入数据失败！";
//        }
//    }

}
mysqli_close($conn);