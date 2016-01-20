<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/4
 * Time: 15:58
 */
include "../../utils/conn.php";
$unit = $_POST['unit'];                      //单位名称
$revise_type = $_POST['revise_type'];        //修改类型
$energy_type = $_POST['energy_type'];        //能源类型
$original_equ_data = $_POST['original_equ_value'];         //当量原始数据
$original_ind_data = $_POST['original_ind_value'];         //等价原始数据
$revise_equ_data = $_POST['revise_equ_value'];             //修改当量数据
$revise_ind_data = $_POST['revise_ind_value'];             //修改等价数据

$sqlForTsn = $conn->query("select `tsn` from `t_enterprise_info` where `review_status`='通过审核' and `enterprise_name`='{$unit}'");
while($rowForTsn = mysqli_fetch_array($sqlForTsn)){
    $tsn = $rowForTsn['tsn'];
}

if($revise_type == "日数据修正"){
    $day_select = $_POST['day'];                               //日期
    //获取日数据tsn
    $sqlForDaily_tsn = $conn->query("select `tsn` as `daily_tsn` from `t_daily_data` where `enable`='启用' and `enter_tsn`='{$tsn}' and `energy_big_type`='{$energy_type}' and date_format(`import_time`,'%Y-%m-%d')='{$day_select}'");
    $rowForDaily_tsn = mysqli_fetch_array($sqlForDaily_tsn);
    $daily_tsn = $rowForDaily_tsn['daily_tsn'];

    //插入到日数据日志表
    $insert = "insert into `t_daily_data_log`(enter_tsn,daily_tsn,import_time,energy_big_type,revise_type,total_equival_value,total_indiff_value,revise_total_equival_value,revise_total_indiff_value,Upd_date) values('{$tsn}','{$daily_tsn}','{$day_select}','{$energy_type}','{$revise_type}','{$original_equ_data}','{$original_ind_data}','{$revise_equ_data}','{$revise_ind_data}',CURRENT_TIME )";
    if(mysqli_query($conn,$insert)){
        echo '8006';
    }else {
        echo '8007';
    }

    //更新日表
    $sql = "update `t_daily_data` set `daily_equival_value`='{$revise_equ_data}',`daily_indiff_value`='{$revise_ind_data}' where `enable`='启用' and `enter_tsn`='{$tsn}' and `energy_big_type`='{$energy_type}' and date_format(`import_time`,'%Y-%m-%d')='{$day_select}'";
    if (mysqli_query($conn, $sql)) {
        echo '8006';
    } else {
        echo '8007';
    }
}

if($revise_type == "月数据修正"){
    $daily_tsn = array();
    $year_select = $_POST['year_select'];
    $month_select = $_POST['month_select'];
    $year_month = $year_select.'-'.$month_select;          //录入时间
    //获取日数据tsn
    $sqlForDaily_tsn = $conn->query("select `tsn`  as `daily_tsn` from `t_daily_data` where `enable`='启用' and `enter_tsn`='{$tsn}' and `energy_big_type`='{$energy_type}' and date_format(`import_time`,'%Y-%m')='{$year_select}-{$month_select}' order by `import_time` asc");
    while($rowForDaily_tsn = mysqli_fetch_array($sqlForDaily_tsn)){
        $daily_tsn[] = $rowForDaily_tsn['daily_tsn'];
    };
    $num = count($daily_tsn);
    $daily_tsn_num = $daily_tsn[0].'~'.$daily_tsn[$num-1];    //当天能耗数据tsn
    //插入到日数据日志表
    $insert = "insert into `t_daily_data_log`(enter_tsn,daily_tsn,import_time,energy_big_type,revise_type,total_equival_value,total_indiff_value,revise_total_equival_value,revise_total_indiff_value,Upd_date) values('{$tsn}','{$daily_tsn_num}','{$year_month}','{$energy_type}','{$revise_type}','{$original_equ_data}','{$original_ind_data}','{$revise_equ_data}','{$revise_ind_data}',CURRENT_TIME )";
    if(mysqli_query($conn,$insert)){
        echo '8006';
    }else {
        echo '8007';
    }

    //更新日表
    $revise_equ_data_per = $revise_equ_data/$num;
    $revise_ind_data_per = $revise_ind_data/$num;
    $sql = "update `t_daily_data` set `daily_equival_value`='{$revise_equ_data_per}',`daily_indiff_value`='{$revise_ind_data_per}' where `enable`='启用' and `enter_tsn`='{$tsn}' and `energy_big_type`='{$energy_type}' and date_format(`import_time`,'%Y-%m')='{$year_month}'";
    if(mysqli_query($conn, $sql)){
        echo '8006';
    }else {
        echo '8007';
    }
}
mysqli_close($conn);
