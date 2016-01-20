<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/19
 * Time: 9:44
 */

include "../../utils/conn.php";
$array = array();
$InsertResourceType = $_GET['InsertResourceType'];

$sql = "select `energy_small_name` from `t_energy_small_type` where `energy_big_type`='{$InsertResourceType}'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $array[] = $row['energy_small_name'];
}

echo json_encode($array);
mysqli_close($conn);