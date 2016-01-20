<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/9
 * Time: 14:13
 */
include "../../../utils/conn.php";
session_start();
$organization_code = $_SESSION['organization_code'];
$sqlForTsn = $conn->query("select `tsn` from `t_enterprise_info` where `organization_code`='{$organization_code}' and `review_status`='通过审核'");
$rowForTsn = mysqli_fetch_array($sqlForTsn);
$enter_tsn = $rowForTsn['tsn'];

$sql = "select `energy_big_type`,`enter_tsn` from `t_collecting_point` as `a` left join `t_energy_small_type` as `b` on `a`.`energy_small_tsn`=`b`.`tsn` where `enter_tsn`='{$enter_tsn}' group by `energy_big_type`";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $type[] = $row['energy_big_type'];
}
echo json_encode($type);
mysqli_close($conn);