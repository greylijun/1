<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/13
 * Time: 9:17
 */
include "../../utils/conn.php";
$area = $_GET['area'];
$array = array();
$sql = "select `region`,`industry_type`,`grade_table`,`grade_table`,`path_number`,`enterprise_name`,`energy_big_type`,`standard_equ_fold`,`standard_equ_discount`,`energy_unit` from   (`t_collecting_point` as `a` inner join  `t_enterprise_info` as `b` on `a`.`enter_tsn` = `b`.`tsn`) inner join `t_energy_small_type` as `c` on `a`.`energy_small_tsn`=`c`.`tsn` where `b`.`review_status`='通过审核'";
if($area != "全市"){
    $sql .=" and `region`='{$area}'";
}

$result = mysqli_query($conn,$sql);
if($result){
    $divNum = 0;
    while($row=mysqli_fetch_array($result)){
        $divNum++;
        $temp = array(
            'id' => $divNum,
            'region'=>$row['region'],
            'industry'=>$row['industry_type'],
            'name'=>$row['enterprise_name'],
            'point'=>$row['path_number'],
            'source_type'=>$row['energy_big_type'],
            'grade_table'=>$row['grade_table'],
            'grade'=>$row['grade_table'],
            'equ_fold'=>$row['standard_equ_fold'],
            'equ_discount'=>$row['standard_equ_discount'],
            'energy_unit'=>$row['energy_unit']
        );
        array_push($array,$temp);
    }
}
echo json_encode($array);
mysqli_close($conn);