<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/10
 * Time: 15:57
 */
include "../../utils/conn.php";
$tsn = array();
$name = array();
$region = array();
$address = array();
$code = array();
$image = array();
$last_total = array();
$num = array();
$sqlForEnergy = $conn->query("select `a`.`tsn`,`a`.`region`,`a`.`production_address`,`a`.`enterprise_name`,`a`.`organization_code`,`a`.`unit_image_path`,sum(`daily_equival_value`) as `total` from `t_enterprise_info` as `a` left join (select * from `t_daily_data` where substr(`import_time`,1,7)= substr((date_sub(now(),interval 1 month)),1,7)) as `b` on `a`.`tsn`=`b`.`enter_tsn` where `a`.`review_status`='通过审核' group by `a`.`tsn` order by `total` desc limit 5");
while($rowForEnergy = mysqli_fetch_array($sqlForEnergy)){
    $tsn[] = $rowForEnergy['tsn'];
    $name[] = $rowForEnergy['enterprise_name'];
    $region[] = $rowForEnergy['region'];
    $address[] = $rowForEnergy['production_address'];
    $code[] = $rowForEnergy['organization_code'];
    $image[] = $rowForEnergy['unit_image_path'];
    $last_total[] = $rowForEnergy['total']*1;
}

for($i=0;$i<count($tsn);$i++) {
    $sql = $conn->query("select count(`path_number`) as `point_num` from `t_collecting_point` where `enter_tsn`='$tsn[$i]'");
    $row = mysqli_fetch_array($sql);
    $num[] = $row['point_num'];
}
$data = array();
for($a=0;$a<count($tsn);$a++){
    $temp = array(
        'tsn' => $tsn[$a],
        'name'=> $name[$a],
        'region' => $region[$a],
        'address'=> $address[$a],
        'image' => $image[$a],
        'org_code' => $code[$a],
        'last_total'=>$last_total[$a],
        'num' => $num[$a]
    );
    array_push($data,$temp);
}

echo json_encode($data);
mysqli_close($conn);


