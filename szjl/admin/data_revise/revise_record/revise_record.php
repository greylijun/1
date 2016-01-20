<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/7
 * Time: 16:30
 */
include "../../../utils/conn.php";
$unit_name = $_GET['unit_name'];
$area = $_GET['area'];
$energy_type = $_GET['energy_type'];
$revise_type = $_GET['revise_type'];
$array = array();

//获取企业信息tsn
$sqlForTsn = $conn->query("select `tsn` from `t_enterprise_info` where `review_status`='通过审核' and `enterprise_name`='{$unit_name}'");
while($rowForTsn = mysqli_fetch_array($sqlForTsn)){
    $tsn = $rowForTsn['tsn'];
}


if($revise_type == "日数据修正"){
    $day_select = $_GET['day_select'];
    $sql = "select `energy_big_type`,`import_time`,date_format(`a`.`Upd_date`,'%Y-%m-%d') as `Upd_date`,`total_equival_value`,`total_indiff_value`,`revise_total_equival_value`,`revise_total_indiff_value`,`enterprise_name` from `t_daily_data_log` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where `energy_big_type`='{$energy_type}' and `revise_type`='日数据修正'";
    if($unit_name != "所有企业"){
        $sql .= "  and `enter_tsn`='{$tsn}'";
    }
    if($area != "全市"){
        $sql .= " and `region`='{$area}'";
    }
    if($day_select != ""){
        $sql .= "  and `import_time`='{$day_select}' ";
    }
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
        $temp = array(
            'name' => $row['enterprise_name'],                        //企业名称
            'energy_big_type' => $row['energy_big_type'],             //能源大类类型
            'import_time' => $row['import_time'],                     //修改时间
            'Upd_date' => $row['Upd_date'],                           //填报时间
            'original_equ_data' => $row['total_equival_value'],       //原始当量值
            'original_ind_data' => $row['total_indiff_value'],        //原始等价值
            'revise_equ_data' => $row['revise_total_equival_value'],  //修改当量值
            'revise_ind_data' => $row['revise_total_indiff_value']    //修改等价值
        );
        array_push($array,$temp);
    }
}

if($revise_type == "月数据修正"){
    $year_select = $_GET['year_select'];
    $month_select = $_GET['month_select'];
    $date = $year_select."-".$month_select;
    $sql = "select `energy_big_type`,`import_time`,date_format(`a`.`Upd_date`,'%Y-%m-%d %H:%i') as `Upd_date`,`total_equival_value`,`total_indiff_value`,`revise_total_equival_value`,`revise_total_indiff_value`,`enterprise_name` from `t_daily_data_log` as `a` left join `t_enterprise_info` as  `b` on `a`.`enter_tsn`=`b`.`tsn` where `energy_big_type`='{$energy_type}' and `revise_type`='月数据修正' and `import_time`='{$date}'";
    if($area != "全市"){
        $sql .= " and `region`='{$area}'";
    }
    if($unit_name != "所有企业"){
        $sql .= "  and `enter_tsn`='{$tsn}'";
    }
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
        $temp = array(
            'name' => $row['enterprise_name'],                        //企业名称
            'energy_big_type' => $row['energy_big_type'],             //能源大类类型
            'import_time' => $row['import_time'],                     //修改时间
            'Upd_date' => $row['Upd_date'],                           //填报时间
            'original_equ_data' => $row['total_equival_value'],       //原始当量值
            'original_ind_data' => $row['total_indiff_value'],        //原始等价值
            'revise_equ_data' => $row['revise_total_equival_value'],  //修改当量值
            'revise_ind_data' => $row['revise_total_indiff_value']    //修改等价值
        );
        array_push($array,$temp);
    }
}
echo json_encode($array);
mysqli_close($conn);