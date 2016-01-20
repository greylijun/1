<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/13
 * Time: 15:49
 */
include "../../../utils/conn.php";
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$name = $_POST['name'];
$lic_number = $_POST['lic_number'];
$legal_person = $_POST['legal_person'];
$business_contact = $_POST['business_contact'];
$contact_num = $_POST['contact_num'];
$region = $_POST['region'];
$industry_type = $_POST['industry_type'];
$unit_industry_type = $_POST['unit_industry_type'];
$business_phone = $_POST['business_phone'];
$zip_code = $_POST['zip_code'];
$E_mail = $_POST['E-mail'];
$fax = $_POST['fax'];
$reg = $_POST['reg'];
$pro = $_POST['pro'];

$update = "update `t_enterprise_info` set `enterprise_name`='{$name}',`license_registration_number`='{$lic_number}',`legal_person`='{$legal_person}',`business_contacts`='{$business_contact}',`contact_number`='{$contact_num}',`region`='{$region}',`industry_type`='{$industry_type}',`unit_industry_type`='{$unit_industry_type}',`business_phone`='{$business_phone}',`zip_code`='{$zip_code}',`E_mail`='{$E_mail}',`fax`='{$fax}',`registered_address`='{$reg}',`production_address`='{$pro}' where `tsn`='{$enter_tsn}'";
if(mysqli_query($conn,$update)){
    echo '8006';
}else{
    echo '8007';
}

mysqli_close($conn);


