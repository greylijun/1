<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/5
 * Time: 19:50
 */
include "../../../utils/conn.php";

$sqlSum = $conn->query("select count(`tsn`) from `t_enterprise_info` where `review_status`='通过审核'");
$rowSum = mysqli_fetch_array($sqlSum);

$sql = $conn->query("select count(`tsn`) from `t_enterprise_info` where `region` = '姑苏区' and `review_status`='通过审核'");
$row = mysqli_fetch_array($sql);

$sqlForY = $conn->query("select count(`tsn`) from `t_enterprise_info` where `region` = '园区' and `review_status`='通过审核'");
$rowForY = mysqli_fetch_array($sqlForY);

$sqlForG = $conn->query("select count(`tsn`) from `t_enterprise_info` where `region` = '高新区' and `review_status`='通过审核'");
$rowForG = mysqli_fetch_array($sqlForG);

$sqlForW = $conn->query("select count(`tsn`) from `t_enterprise_info` where `region` = '吴中区' and `review_status`='通过审核'");
$rowForW = mysqli_fetch_array($sqlForW);

$sqlForX = $conn->query("select count(`tsn`) from `t_enterprise_info` where `region` = '相城区' and `review_status`='通过审核'");
$rowForX = mysqli_fetch_array($sqlForX);

$sqlForWJ = $conn->query("select count(`tsn`) from `t_enterprise_info` where `region` = '吴江区' and `review_status`='通过审核'");
$rowForWJ = mysqli_fetch_array($sqlForWJ);

$sqlForK = $conn->query("select count(`tsn`) from `t_enterprise_info` where `region` = '昆山市' and `review_status`='通过审核'");
$rowForK = mysqli_fetch_array($sqlForK);

$sqlForC = $conn->query("select count(`tsn`) from `t_enterprise_info` where `region` = '常熟市' and `review_status`='通过审核'");
$rowForC = mysqli_fetch_array($sqlForC);

$sqlForZ = $conn->query("select count(`tsn`) from `t_enterprise_info` where `region` = '张家港市' and `review_status`='通过审核'");
$rowForZ = mysqli_fetch_array($sqlForZ);

$sqlForT = $conn->query("select count(`tsn`) from `t_enterprise_info` where `region` = '太仓市' and `review_status`='通过审核'");
$rowForT = mysqli_fetch_array($sqlForT);

$array = array(
    'total' => $rowSum[0],             //总数
    'GSQ_num' => $row[0],              //姑苏区用能单位数量
    'YQ_num'  => $rowForY[0],          //园区用能单位数量
    'GXQ_num' => $rowForG[0],          //高新区用能单位数量
    'WZQ_num' => $rowForW[0],          //吴中区
    'XCQ_num' => $rowForX[0],          //相城区
    'WJQ_num' => $rowForWJ[0],         //吴江区
    'KSS_num' => $rowForK[0],          //昆山市
    'CSS_num' => $rowForC[0],          //常熟市
    'ZJGS_num'=> $rowForZ[0],          //张家港市
    'TCS_num' => $rowForT[0]           //太仓市
);
echo json_encode($array);