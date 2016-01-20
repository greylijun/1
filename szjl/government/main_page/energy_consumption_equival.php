<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/2
 * Time: 14:19
 */
include "../../utils/conn.php";
$year = date("Y"."-");
$monthArray = array('01','02','03','04','05','06','07','08','09','10','11','12');
//各月水的等价值
$water_consumption =array();        // 当年水的等价消耗量
$water_consumption_last = array();  // 去年水的等价消耗量
$month_water_consumption = array(); //上月水的等价消耗量*
$month_link = array();              //水的环比值*
$other_equival =array();            //当年各月能源当量消耗值
$month_other_equival = array();     //上月能源当量消耗值*
$month_equ_link = array();          //能源当量环比值
$other_equival_last =array();       //去年各月能源当量消耗值
$month_other_consumption = array(); //上月能源等价消耗量*
$month_con_link = array();          //能源等价环比值*
$other_consumption =array();        //当年各月能源等价消耗量
$other_consumption_last = array();  //去年各月能源等价消耗量
$year_on_year_energy = array();     //能耗等价与去年同比值
$year_on_year_energy2 = array();    //能耗当量与去年同比值
$year_on_year_water = array();      //水等价与去年同比值
$data = array();
for($i=0;$i<12;$i++){
    $sqlForwater = "select sum(`daily_indiff_value`) from `t_daily_data` WHERE substr(`import_time`,1,7)='".$year.$monthArray[$i]."' AND `energy_big_type`='水' AND `enable`='启用'";
    $sqlForLoop = "select sum(`daily_indiff_value`) from `t_daily_data` where substr(`import_time`,1,7)='".($year-1).$monthArray[$i]."' and `energy_big_type`='水' and `enable`= '启用'";
    if($i==0){
        $sqlForWaterLoop = "select sum(`daily_indiff_value`) from `t_daily_data` WHERE substr(`import_time`,1,7)='".($year-1)."12' AND `energy_big_type`='水' AND `enable`='启用'";
    }else{
        $sqlForWaterLoop = "select sum(`daily_indiff_value`) from `t_daily_data` WHERE substr(`import_time`,1,7)='".$year.$monthArray[$i-1]."' AND `energy_big_type`='水' AND `enable`='启用'";
    }
    $resultForwater = mysqli_query($conn,$sqlForwater);
    $resultForLoop = mysqli_query($conn,$sqlForLoop);
    $resultForWaterLoop = mysqli_query($conn,$sqlForWaterLoop);
    if($resultForwater) {
        $rowForwater = mysqli_fetch_array($resultForwater);
    }
    if($resultForLoop){
        $rowForLoop = mysqli_fetch_array($resultForLoop);
    }
    if($resultForWaterLoop){
        $rowForWaterLoop = mysqli_fetch_array($resultForWaterLoop);
    }
    $water_consumption[] = $rowForwater['sum(`daily_indiff_value`)']*1;           // 当年水的等价消耗量
    if($rowForLoop['sum(`daily_indiff_value`)']*1 == 0){
        $water_consumption_last[] = "-";
        $year_on_year_water[] = "-";
    }else{
        $water_consumption_last[] = $rowForwater['sum(`daily_indiff_value`)']*1;  // 去年水的等价消耗量
        $year_on_year_water[] = round($rowForwater['sum(`daily_indiff_value`)']*1/$rowForwater['sum(`daily_indiff_value`)']*1,3); // 水等价与去年同比值
    };
    if($rowForWaterLoop['sum(`daily_indiff_value`)']*1 == 0){
        $month_water_consumption[] = "-";
        $month_link[] = "-";
    }else{
        $month_water_consumption[] = $rowForWaterLoop['sum(`daily_indiff_value`)']*1;
        $month_link[] = round($rowForwater['sum(`daily_indiff_value`)']*1/$rowForWaterLoop['sum(`daily_indiff_value`)']*1,3);    //水等价与上月环比值
    }
}
//各月能源的等价值
for($i=0;$i<12;$i++){
    $sqlForother = "select sum(`daily_indiff_value`) from `t_daily_data` WHERE substr(`import_time`,1,7)='".$year.$monthArray[$i]."' AND `energy_big_type`!='水' AND `enable`='启用'";
    $sqlForIndLast = "select sum(`daily_indiff_value`) from `t_daily_data` WHERE substr(`import_time`,1,7)='".($year-1).$monthArray[$i]."' AND `energy_big_type`!='水' AND `enable`='启用'";
    if($i==0){
        $sqlForLoop_In = "select sum(`daily_indiff_value`) from `t_daily_data` WHERE substr(`import_time`,1,7)='".($year-1)."12' AND `energy_big_type`!='水' AND `enable`='启用'";
    }else{
        $sqlForLoop_In = "select sum(`daily_indiff_value`) from `t_daily_data` WHERE substr(`import_time`,1,7)='".$year.$monthArray[$i-1]."' AND `energy_big_type`!='水' AND `enable`='启用'";
    }
    $resultForother = mysqli_query($conn,$sqlForother);
    $resultIndLast = mysqli_query($conn,$sqlForIndLast);
    $resultForLoop_In =  mysqli_query($conn,$sqlForLoop_In);
    if($resultForother) {
        $rowForother = mysqli_fetch_array($resultForother);
    }
    if($resultIndLast){
        $rowIndLast = mysqli_fetch_array($resultIndLast);
    }
    if($resultForLoop_In){
        $rowForLoop_In = mysqli_fetch_array($resultForLoop_In);
    }
    $other_consumption[] = $rowForother['sum(`daily_indiff_value`)']*1;     //当年各月能源等价消耗量
    if($rowIndLast['sum(`daily_indiff_value`)']*1 == 0){
        $other_consumption_last[] = "-";
        $year_on_year_energy[] = "-";
    }else{
        $other_consumption_last[] = $rowIndLast['sum(`daily_indiff_value`)']*1;     //去年各月能源等价消耗量
        $year_on_year_energy[] = round($rowForother['sum(`daily_indiff_value`)']*1/$rowIndLast['sum(`daily_indiff_value`)']*1,3);  //能耗等价与去年同比值
    }
    if($rowForLoop_In['sum(`daily_indiff_value`)']*1 == 0){
        $month_other_consumption[] = "-";
        $month_con_link[] = "-";
    }else{
        $month_other_consumption[] = $rowIndLast['sum(`daily_indiff_value`)']*1;
        $month_con_link[] = round($rowForother['sum(`daily_indiff_value`)']*1/$rowForLoop_In['sum(`daily_indiff_value`)']*1,3);    //能耗等价与上月环比值
    }
}
//各月能源的当量值
for($i=0;$i<12;$i++){
    $sqlForEqu = "select sum(`daily_equival_value`) from `t_daily_data` WHERE substr(`import_time`,1,7)='".$year.$monthArray[$i]."' AND `energy_big_type`!='水' AND `enable`='启用'";
    $sqlForEquLast = "select sum(`daily_equival_value`) from `t_daily_data` WHERE substr(`import_time`,1,7)='".($year-1).$monthArray[$i]."' AND `energy_big_type`!='水' AND `enable`='启用'";
    if($i==0){
        $sqlForLink = "select sum(`daily_equival_value`) from `t_daily_data` WHERE  substr(`import_time`,1,7)='".($year-1)."12' and `energy_big_type` != '水' AND `enable`='启用'";
    }else{
        $sqlForLink = "select sum(`daily_equival_value`) from `t_daily_data` WHERE substr(`import_time`,1,7)='".$year.$monthArray[$i-1]."' AND `energy_big_type`!='水' AND `enable`='启用'";
    }
    $resultForEqu = mysqli_query($conn,$sqlForEqu);
    $resultForEquLast = mysqli_query($conn,$sqlForEquLast);
    $resultForLink = mysqli_query($conn,$sqlForLink);
    if($resultForEqu) {
        $rowForEqu = mysqli_fetch_array($resultForEqu);
    }
    if($resultForEquLast){
        $rowForEquLast = mysqli_fetch_array($resultForEquLast);
    }
    if($resultForLink){
        $rowForLink = mysqli_fetch_array($resultForLink);
    }
    $other_equival[] = $rowForEqu['sum(`daily_equival_value`)']*1;                //当年各月能源当量消耗值
    if($rowForEquLast['sum(`daily_equival_value`)']*1 == 0){
        $other_equival_last[] = "-";
        $year_on_year_energy2[] = "-";
    }else{
        $other_equival_last[] = $rowForEquLast['sum(`daily_equival_value`)']*1;   // 去年各月能源当量消耗值
        $year_on_year_energy2[] = round($rowForEqu['sum(`daily_equival_value`)']*1/$rowForEquLast['sum(`daily_equival_value`)']*1,3);  //能耗当量与去年同比值
    }
    if($rowForLink['sum(`daily_equival_value`)']*1 == 0){
        $month_other_equival[] = "-";
        $month_equ_link[] = "-";
    }else{
        $month_other_equival[] = $rowForLink['sum(`daily_equival_value`)']*1;
        $month_equ_link[] = round($rowForEqu['sum(`daily_equival_value`)']*1/$rowForLink['sum(`daily_equival_value`)']*1,3);    //能耗当量与上月环比值
    }
}
array_push($data,$water_consumption,$other_consumption,$other_equival,$year_on_year_water,$year_on_year_energy,$year_on_year_energy2,$month_link,$month_con_link,$month_equ_link);
echo json_encode($data);
mysqli_close($conn);

