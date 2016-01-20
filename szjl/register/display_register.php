<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/12
 * Time: 13:09
 */
session_start();
include "../utils/conn.php";
$tsn = $_SESSION['login_tsn'];

$sql = "select `enterprise_name`,`license_registration_number`,`organization_code`,`legal_person`,`business_contacts`,`contact_number`,`business_phone`,`zip_code`,`E_mail`,`fax`,`registered_address`,`production_address` from `t_enterprise_info` where `tsn`='{$tsn}'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $temp = array(
        'enter_name'=>$row['enterprise_name'],
        'lic_reg_num'=>$row['license_registration_number'],
        'organization_code'=>$row['organization_code'],
        'legal_person'=>$row['legal_person'],
        'business_contacts'=>$row['business_contacts'],
        'contact_number'=>$row['contact_number'],
        'business_phone'=>$row['business_phone'],
        'zip_code'=>$row['zip_code'],
        'E_mail'=>$row['E_mail'],
        'fax'=>$row['fax'],
        'registered_address'=>$row['registered_address'],
        'production_address'=>$row['production_address']
    );
}

echo json_encode($temp);
mysqli_close($conn);