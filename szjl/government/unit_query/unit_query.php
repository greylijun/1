<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/10
 * Time: 11:22
 */
include "../../utils/conn.php";
$enter_name = $_POST["keys"];
$sql = $conn->query("select `organization_code` from `t_enterprise_info` where `enterprise_name`='{$enter_name}'");
$row = mysqli_fetch_array($sql);
if($row["organization_code"] == ""){
    echo "10000";
}else{
    session_start();
    if(isset($_SESSION["organization_code"])){
        unset($_SESSION['organization_code']);
    }
    $_SESSION["organization_code"] = $row["organization_code"];
    echo "10010";
}

mysqli_close($conn);