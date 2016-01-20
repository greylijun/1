<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/20
 * Time: 9:07
 */
include "../../utils/conn.php";
$year = array();
$sql =$conn->query("select `limit_year` from `t_limit_summary` group by `limit_year` order by `limit_year` asc");
while($row = mysqli_fetch_array($sql)){
    $year[] = $row['limit_year'];
}
echo json_encode($year);
mysqli_close($conn);
