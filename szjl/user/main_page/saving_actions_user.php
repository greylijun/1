<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/17
 * Time: 9:44
 */
include "../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$year = $_GET['year'];
$state = $_GET['state'];
$array = array();

if($state == "未完成"){
    $sql = "select `project_name`,`start_time`,`end_time`,`investment_volume`,`save_money`,`material_volume`,`payback_period`,`technical_renovation_content`,`if_finish`,`Crt_date` from `t_energy_saving_measures_plan` where `enter_tsn`='{$enter_tsn}' and `if_finish`='否'";
}else{
    $sql = "select `project_name`,`start_time`,`end_time`,`investment_volume`,`save_money`,`material_volume`,`payback_period`,`technical_renovation_content`,`if_finish`,`Crt_date` from `t_energy_saving_measures_finish` where `enter_tsn`='{$enter_tsn}' and `if_finish`='是'";
}

if($year != "全年度"){
    $sql .= " and year(`Crt_date`)='{$year}'";
}

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $temp = array(
        'name'=>$row['project_name'],
        'start_time'=>$row['start_time'],
        'end_time'=>$row['end_time'],
        'investment_volume'=>$row['investment_volume'],
        'save_money'=>$row['save_money'],
        'material_volume'=>$row['material_volume'],
        'payback_period'=>$row['payback_period'],
        'file_address'=>substr($row['technical_renovation_content'],3),
        'if_finish'=>$row['if_finish'],
        'submit_year'=>substr($row['Crt_date'],0,4)
    );
    array_push($array,$temp);
}
echo json_encode($array);
mysqli_close($conn);