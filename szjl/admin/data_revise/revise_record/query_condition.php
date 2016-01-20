<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/13
 * Time: 9:25
 */
include "../../../utils/conn.php";
$enter_name =array();
$area=$_GET['area'];
$sql ="select `enterprise_name` from `t_enterprise_info` where `review_status` ='通过审核'";
if($area != "全市"){
    $sql .= " and `region`='{$area}'";
}
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $enter_name[] = $row['enterprise_name'];
}
echo json_encode($enter_name);
mysqli_close($conn);
