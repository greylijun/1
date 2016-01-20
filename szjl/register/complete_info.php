<?php

session_start();
include "../utils/conn.php";
$enter_name = $_POST['enter_name'];                                       //单位名称
$legal_person = $_POST['legal_person'];                                   //企业法人
$registered_address = $_POST['registered_address'];                       //注册地址
$production_address = $_POST['production_address'];                       //生产地址
$license_registration_number = $_POST['license_registration_number'];     //营业执照注册号
$organization_code = $_POST['organization_code'];                         //组织机构代码
$business_phone = $_POST['business_phone'];                               //单位电话
$E_mail = $_POST['E_mail'];                                               //邮箱
$zip_code = $_POST['zip_code'];                                           //邮政编码
$fax = $_POST['fax'];                                                     //传真
$business_contacts = $_POST['business_contacts'];                         //单位联系人
$contact_number = $_POST['contact_number'];                               //联系人号码

if(isset($_SESSION['login_tsn'])){
    $tsn = $_SESSION['login_tsn'];
    $update = "update `t_enterprise_info` set `enterprise_name`='{$enter_name}',`license_registration_number`='{$license_registration_number}',`organization_code`='{$organization_code}',`legal_person`='{$legal_person}',`business_contacts`='{$business_contacts}',`contact_number`='{$contact_number}',`business_phone`='{$business_phone}',`zip_code`='{$zip_code}',`E_mail`='{$E_mail}',`fax`='{$fax}',`registered_address`='{$registered_address}',`production_address`='{$production_address}' where `tsn`='{$tsn}'";
    if(mysqli_query($conn,$update)){
        echo '8006';
    }else{
        echo '8007';
    }
}else{
    $sql = $conn->query("select ifnull(max(`tsn`),'1') as `tsn` from `t_enterprise_info`");
    $row = mysqli_fetch_array($sql);
    $tsn = $row['tsn']+1;
    $_SESSION['login_tsn'] = $tsn;

    $insert = "insert into `t_enterprise_info`(tsn,enterprise_name,license_registration_number,organization_code,legal_person,business_contacts,contact_number,business_phone,zip_code,E_mail,fax,registered_address,production_address) values('{$tsn}','{$enter_name}','{$license_registration_number}','{$organization_code}','{$legal_person}','{$business_contacts}','{$contact_number}','{$business_phone}','{$zip_code}','{$E_mail}','{$fax}','{$registered_address}','{$production_address}')";
    if(mysqli_query($conn,$insert)){
        echo '8006';    //成功
    }else{
        echo '8007';    //失败
    }
}


mysqli_close($conn);



