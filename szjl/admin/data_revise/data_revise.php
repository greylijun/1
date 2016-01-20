<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/31
 * Time: 13:52
 */
include "../../utils/conn.php";
$name = $_GET['unit'];
$type = $_GET['energy_type'];
$revise_type = $_GET['revise_type'];
$temp = array();

$sqlForTsn = $conn->query("select `tsn` from `t_enterprise_info` where `review_status`='通过审核' and `enterprise_name`='{$name}'");
while($rowForTsn = mysqli_fetch_array($sqlForTsn)){
    $tsn = $rowForTsn['tsn'];
}

if($revise_type == "日数据修正"){
    $day = $_GET['day'];
    $sql = "select date_format(`import_time`,'%d') as `date_time`,`daily_equival_value`,`daily_indiff_value` from `t_daily_data` where `enable`='启用' and `enter_tsn`='{$tsn}' and `energy_big_type`='{$type}' and date_format(`import_time`,'%Y-%m-%d')='{$day}' order by `import_time` asc";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
        $temp = array(
            'day_time' => $row['date_time'],
            'daily_equival_value'=>$row['daily_equival_value'],
            'daily_indiff_value'=>$row['daily_indiff_value']
        );
    }
}else{
    $year = $_GET['year_select'];
    $month = $_GET['month_select'];
    $sql = "select date_format(`import_time`,'%d') as `date_time`,sum(`daily_equival_value`),sum(`daily_indiff_value`) from `t_daily_data` where `enable`='启用' and `enter_tsn`='{$tsn}' and `energy_big_type`='{$type}' and date_format(`import_time`,'%Y-%m')='{$year}-{$month}' order by `import_time` asc";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
        $temp = array(
            'day_time' => $row['date_time'],
            'daily_equival_value'=>$row['sum(`daily_equival_value`)'],
            'daily_indiff_value'=>$row['sum(`daily_indiff_value`)']
        );
    }
}
echo json_encode($temp);
mysqli_close($conn);

