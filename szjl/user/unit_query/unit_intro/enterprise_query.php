<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/10
 * Time: 13:57
 */
session_start();
include "../../../utils/conn.php";
$enter_tsn = $_SESSION['enter_tsn'];
//echo $enter_tsn;
$sql = "select `enterprise_name`,`license_registration_number`,`organization_code`,`legal_person`,`business_contacts`,`contact_number`,`region`,`industry_type`,`second_industry_type`,`business_phone`,`zip_code`,`E_mail`,`fax`,`registered_address`,`production_address`,`unit_image_path`,`about_enter` from `t_enterprise_info` where `tsn`='{$enter_tsn}'";
$result = mysqli_query($conn,$sql);
if($result){
    $row = mysqli_fetch_array($result);
}
$sqlForPoint = "select count(`path_number`) as `path_num` from `t_collecting_point` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where `b`.`tsn`='{$enter_tsn}'";
$resultForPoint = mysqli_query($conn,$sqlForPoint);
if($resultForPoint){
    $rowForPoint = mysqli_fetch_array($resultForPoint);
}
$sqlForLastEnergy = "select sum(`daily_equival_value`) as `last_sum` from `t_daily_data` as `a` left join `t_enterprise_info` as `b` on `a`.`enter_tsn`=`b`.`tsn` where `b`.`tsn`='{$enter_tsn}' and date(`import_time`)=CURRENT_DATE -1 and `enable`='启用'";
$resultForLastEnergy = mysqli_query($conn,$sqlForLastEnergy);
if($resultForLastEnergy){
    $rowForLastEnergy = mysqli_fetch_array($resultForLastEnergy);
}
$enter_data = array(
    'name'=>$row['enterprise_name'],                       //企业名称
    'lic_number'=>$row['license_registration_number'],     //营业执照注册号
    'org_code'=>$row['organization_code'],                 //组织机构代码
    'legal_person'=>$row['legal_person'],                  //企业法人
    'business_contact'=>$row['business_contacts'],         //企业联系人
    'contact_num'=>$row['contact_number'],                 //联系人号码
    'region'=>$row['region'],                              //所在区域
    'industry_type'=>$row['industry_type'],                //一级行业类型
    'second_industry_type'=>$row['second_industry_type'],    //二级行业类型
    'business_phone'=>$row['business_phone'],              //企业电话
    'zip_code'=>$row['zip_code'],                          //邮政编码
    'Email'=>$row['E_mail'],                               //邮箱
    'fax'=>$row['fax'],                                    //传真
    'reg_address'=>$row['registered_address'],             //企业注册地址
    'pro_address'=>$row['production_address'],             //企业生产地址
    'image_path'=>$row['unit_image_path'],                      //图片路径
    'about_enter'=>$row['about_enter'],                    //企业简介
    'path_num'=>$rowForPoint['path_num'],                  //采集点数
    'last_sum'=>$rowForLastEnergy['last_sum']*1              //上一日总体当量用能量
);
echo json_encode($enter_data);
mysqli_close($conn);