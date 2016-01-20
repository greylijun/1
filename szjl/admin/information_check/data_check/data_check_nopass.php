<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/26
 * Time: 15:24
 */
include "../../../utils/conn.php";
$name = $_POST['unit_name'];
$modify_date = $_POST['modify_date'];  //修改日期
$fill_date = $_POST['fill_date'];      //填报日期

$sql = "select `tsn` from `t_enterprise_info` where `enterprise_name`='{$name}'";
$result = mysqli_query($conn,$sql);
if($result){
    $row = mysqli_fetch_array($result);
    $tsn = $row['tsn'];
}

$updateDate = " update `t_energy_data_entry` set `state`='未通过审核' where `enter_tsn`='{$tsn}' and date(`fill_date`)='{$fill_date}' and `modify_date`='{$modify_date}'";
if(mysqli_query($conn,$updateDate)){
    echo "数据更新成功！";
}else{
    echo "数据更新失败！";
}
mysqli_close($conn);
