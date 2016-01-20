<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/6
 * Time: 9:01
 */
include "../../../utils/conn.php";
$array = array();
$array1 = array();
$area = $_GET['area'];
if($area == "全市"){
    $sql = "select sum(`daily_indiff_value`) as `sum_indiff_daily`,`enterprise_name`,`region`,`longitude`,`latitude` from `t_enterprise_info` as `a` left join `t_daily_data` as `b` on `a`.`tsn`=`b`.`enter_tsn` where `b`.`enable`='启用' and `a`.`review_status`='通过审核' and DATE (`b`.`import_time`)=CURRENT_DATE-1 group by `a`.`tsn`";
    $sqlForMax = "select max(`c`.`sum_indiff_daily`) as `sum_max` from (select sum(`daily_indiff_value`) as `sum_indiff_daily`,`enterprise_name`,`region`,`longitude`,`latitude` from `t_enterprise_info` as `a` left join `t_daily_data` as `b` on `a`.`tsn`=`b`.`enter_tsn` where `b`.`enable`='启用' and `a`.`review_status`='通过审核' and DATE (`b`.`import_time`)=CURRENT_DATE-1 group by `a`.`tsn`) as `c`";
}else{
    $sql = "select sum(`daily_indiff_value`) as `sum_indiff_daily`,`enterprise_name`,`region`,`longitude`,`latitude` from `t_enterprise_info` as `a` left join `t_daily_data` as `b` on `a`.`tsn`=`b`.`enter_tsn` where `b`.`enable`='启用' and `a`.`review_status`='通过审核' and `a`.`region`= '$area' and DATE (`b`.`import_time`)=CURRENT_DATE-1 group by `a`.`tsn`";
    $sqlForMax = "select max(`c`.`sum_indiff_daily`) as `sum_max` from (select sum(`daily_indiff_value`) as `sum_indiff_daily`,`enterprise_name`,`region`,`longitude`,`latitude` from `t_enterprise_info` as `a` left join `t_daily_data` as `b` on `a`.`tsn`=`b`.`enter_tsn` where `b`.`enable`='启用' and `a`.`review_status`='通过审核' and `a`.`region`= '$area' and DATE (`b`.`import_time`)=CURRENT_DATE-1 group by `a`.`tsn`) as `c`";
}
$resultForMax = mysqli_query($conn,$sqlForMax);
while($rowForMax = mysqli_fetch_array($resultForMax)){
    $array1[] = $rowForMax['sum_max'];
}
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $temp = array(
        'sum_max' => $array1[0],
        'sum_indiff_daily' => $row['sum_indiff_daily'],
        'name' => $row['enterprise_name'],
        'longitude' => $row['longitude'],
        'latitude' => $row['latitude']
    );
    array_push($array,$temp);
}
echo json_encode($array);
