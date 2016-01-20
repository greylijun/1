<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/12
 * Time: 16:04
 */
include "../utils/conn.php";
session_start();
$tsn = $_SESSION['login_tsn'];
$region = $_POST['region'];
$industry_type = $_POST['industry_type'];
$second_industry_type = $_POST['second_industry_type'];
$unit_industry_type = $_POST['unit_industry_type'];
$about_enter = $_POST['about_enter'];
$password = md5('123456');

$update = "update `t_enterprise_info` set `region`='{$region}',`industry_type`='{$industry_type}',`second_industry_type`='{$second_industry_type}',`unit_industry_type`='{$unit_industry_type}',`about_enter`='{$about_enter}',`enter_password`='{$password}',`review_status`='未审核',`Crt_date`=CURRENT_TIME where `tsn`='{$tsn}'";
if(mysqli_query($conn,$update)){
    echo '8006';
}else{
    echo '8007';
}
mysqli_close($conn);