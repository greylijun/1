<?php
function CheckUserType($UserType,$UserTypeQuery,$UnitTsn){
	if($UserType==$UserTypeQuery){
		if($UserTypeQuery=="用能单位"){
			include "../utils/conn.php";
			$sql_tsn = $conn->query("select `tsn`,`review_status` from t_enterprise_info where tsn = '".$UnitTsn."'");
			$result_tsn = mysqli_fetch_array($sql_tsn);
			if($result_tsn["review_status"]==""){
				$_SESSION["enter_tsn"] = $UnitTsn;
				echo "TsnError";
			}else{
				if($result_tsn["review_status"]=="未审核"){
					echo "UserWarning";
				}else if($result_tsn["review_status"]=="未通过审核"){
					echo "UserError";
				}else{
					$_SESSION["enter_tsn"] = $UnitTsn;
					echo "UserSuccess";
				}
			}
		}else if($UserTypeQuery=="监管机构"){
            $_SESSION["reg_num"] = $UnitTsn;
			echo "SupervisionSuccess";
		}else if($UserTypeQuery=="管理员"){
            $_SESSION["admin_tsn"] = $UnitTsn;
			echo "AdminSuccess";
		}else if($UserTypeQuery=="政府部门"){
            $_SESSION['government_tsn'] = $UnitTsn;
			echo "GovernmentSuccess";
		}
	}else{
		echo "UserTypeError";
	}
}
include "../utils/conn.php";
session_start();
$user_name = $_POST["user_name"];
$user_pwd = md5($_POST["user_pwd"]);
$authcode = $_POST["authcode"];
$user_type = $_POST["user_type"];
$login_type = $_POST['login_type'];

if($authcode != $_SESSION['authcode']){
	echo "AuthcodeError";
}else{
    if($user_type == "用能单位") {
        if($login_type == "组织机构代码"){
            $sql = $conn->query("select `tsn`,`enterprise_name`,`enter_password`,`license_registration_number`,`organization_code`,`contact_number` from `t_enterprise_info` where `organization_code`='" . $user_name . "' and `enter_password`='" . $user_pwd . "'");
        }else if($login_type == "营业执照号"){
            $sql = $conn->query("select `tsn`,`enterprise_name`,`enter_password`,`license_registration_number`,`organization_code`,`contact_number` from `t_enterprise_info` where `license_registration_number`='" . $user_name . "' and `enter_password`='" . $user_pwd . "'");
        }else if($login_type == "联系人手机号"){
            $sql = $conn->query("select `tsn`,`enterprise_name`,`enter_password`,`license_registration_number`,`organization_code`,`contact_number` from `t_enterprise_info` where `contact_number`='" . $user_name . "' and `enter_password`='" . $user_pwd . "'");
        }
        $result = mysqli_fetch_array($sql);
        if ($result["enterprise_name"] == "") {
            echo "UserNameError";
        } else {
            CheckUserType($user_type, "用能单位", $result["tsn"]);
        }
    }else{
        $sql = $conn->query("select `user_name`,`user_pwd`,`tsn`,`user_type` from t_user where user_name='".$user_name."' and user_pwd='".$user_pwd."'");
        $result = mysqli_fetch_array($sql);
        if ($result["user_name"] == "") {
            echo "UserNameError";
        } else {
            CheckUserType($user_type, $result["user_type"], $result["tsn"]);
        }
    }
}

mysqli_close($conn);

