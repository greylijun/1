<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/1
 * Time: 10:59
 */
include "../../../utils/conn.php";
$name = $_GET['name'];
$state = $_GET['state'];
$sql = "select `enterprise_name`,`license_registration_number`,`organization_code`,`legal_person`,`business_contacts`,`contact_number`,`region`,`industry_type`,`second_industry_type`,`unit_industry_type`,`business_phone`,`zip_code`,`E_mail`,`fax`,`registered_address`,`production_address` from `t_enterprise_info` where `enterprise_name`='{$name}' and `review_status` = '{$state}'";
$result = mysqli_query($conn,$sql);
if($result){
    $row = mysqli_fetch_array($result);
}
$array = array(
    'enter_name'=>$row['enterprise_name'],
    'license_registration_number'=>$row['license_registration_number'],
    'organization_code'=>$row['organization_code'],
    'legal_person'=>$row['legal_person'],
    'business_contacts'=>$row['business_contacts'],
    'contact_number'=>$row['contact_number'],
    'region'=>$row['region'],
    'industry_type'=>$row['industry_type'],
    'second_industry_type'=>$row['second_industry_type'],
    'unit_industry_type'=>$row['unit_industry_type'],
    'business_phone'=>$row['business_phone'],
    'zip_code'=>$row['zip_code'],
    'E_mail'=>$row['E_mail'],
    'fax'=>$row['fax'],
    'registered_address'=>$row['registered_address'],
    'production_address'=>$row['production_address']
);
echo json_encode($array);
mysqli_close($conn);