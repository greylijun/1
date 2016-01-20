<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2016/1/20
 * Time: 11:25
 */

include "../../utils/conn.php";

$path_num = $_POST['path_num'];

$delete = "delete from `t_collecting_point` where `path_number`='{$path_num}'";
if(mysqli_query($conn,$delete)){
    echo '8006';
}else{
    echo '8007';
}

mysqli_close($conn);