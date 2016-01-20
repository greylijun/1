<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/17
 * Time: 14:32
 */
include "../../../utils/conn.php";
$year = $_GET['year'];
$state = $_GET['state'];
$region = $_GET['region'];
$industry = $_GET['industry'];
$enter_name = $_GET['enter_name'];
$array = array();

if($state == "未完成"){
    $sql = "select `project_name`,`start_time`,`end_time`,`investment_volume`,`save_money`,`material_volume`,`payback_period`,`technical_renovation_content`,`if_finish`,`a`.`Crt_date`,`region`,`enterprise_name`,`industry_type` from `t_energy_saving_measures_plan` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where `if_finish`='否'";
}else{
    $sql = "select `project_name`,`start_time`,`end_time`,`investment_volume`,`save_money`,`material_volume`,`payback_period`,`technical_renovation_content`,`if_finish`,`a`.`Crt_date`,`region`,`enterprise_name`,`industry_type` from `t_energy_saving_measures_finish`  as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn`  where `if_finish`='是'";
}

if($year != "全年度"){
    $sql .= " and year(`a`.`Crt_date`)='{$year}'";
}

if($region != "全地区"){
    $sql .= " and `region` = '{$region}'";
}

if($industry != "全行业"){
    $sql .= " and `industry_type`='{$industry}'";
}

if($enter_name != "所有企业"){
    $sql .= " and `enterprise_name`='{$enter_name}'";
}

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    if($row['technical_renovation_content'] == null){
        $temp = array(
            'region'=>$row['region'],
            'industry'=>$row['industry_type'],
            'enterprise_name'=>$row['enterprise_name'],
            'submit_year'=>substr($row['Crt_date'],0,4),
            'name'=>$row['project_name'],
            'start_time'=>$row['start_time'],
            'end_time'=>$row['end_time'],
            'investment_volume'=>$row['investment_volume'],
            'save_money'=>$row['save_money'],
            'material_volume'=>$row['material_volume'],
            'payback_period'=>$row['payback_period'],
            'if_finish'=>$row['if_finish'],
            'file_address'=>""
        );
    }else{
        $temp = array(
            'region'=>$row['region'],
            'industry'=>$row['industry_type'],
            'enterprise_name'=>$row['enterprise_name'],
            'submit_year'=>substr($row['Crt_date'],0,4),
            'name'=>$row['project_name'],
            'start_time'=>$row['start_time'],
            'end_time'=>$row['end_time'],
            'investment_volume'=>$row['investment_volume'],
            'save_money'=>$row['save_money'],
            'material_volume'=>$row['material_volume'],
            'payback_period'=>$row['payback_period'],
            'if_finish'=>$row['if_finish'],
            'file_address'=>substr($row['technical_renovation_content'],3)
        );
    }
    array_push($array,$temp);
}
echo json_encode($array);
mysqli_close($conn);