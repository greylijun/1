<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/19
 * Time: 10:20
 */
include "../../utils/conn.php";
$temp = array();
$InsertSpecificResourceType = $_GET['InsertSpecificResourceType'];

$sql = "select `standard_equ_fold`,`standard_equ_discount` from `t_energy_small_type` where `energy_small_name`='{$InsertSpecificResourceType}'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $temp = array(
        'standard_equ_fold'=>$row['standard_equ_fold'],
        'standard_equ_discount'=>$row['standard_equ_discount']
    );
}
echo json_encode($temp);
mysqli_close($conn);