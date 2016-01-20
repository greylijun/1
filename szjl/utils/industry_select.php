<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/14
 * Time: 14:36
 */

include "conn.php";
$industry_type = $_GET['industry_type'];
$array = array();
$sql = "select `second_industry` from `t_industry_type` where `first_industry`='{$industry_type}'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $temp = array(
      'second_industry'=>$row['second_industry']
    );
    array_push($array,$temp);
}

echo json_encode($array);
mysqli_close($conn);