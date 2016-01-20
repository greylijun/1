<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/18
 * Time: 8:48
 */
include "../../utils/conn.php";
session_start();
$state = $_GET['state'];
$project_name = $_GET['project_name'];
$enter_tsn = $_SESSION['enter_tsn'];

if($state == "未完成"){
    $sql = "select `technical_renovation_content` from `t_energy_saving_measures_plan` where `project_name`='{$project_name}' and `enter_tsn`='{$enter_tsn}'";
}else{
    $sql = "select `technical_renovation_content` from `t_energy_saving_measures_finish` where `project_name`='{$project_name}' and `enter_tsn`='{$enter_tsn}'";
}

$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    if($row['technical_renovation_content'] == null){
        $temp = array(
            'download_address'=>""
        );
    }else{
        $temp = array(
            'download_address'=>substr($row['technical_renovation_content'],3)
        );
    }
}

echo json_encode($temp);
mysqli_close($conn);