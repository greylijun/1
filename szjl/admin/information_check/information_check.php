<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/12/3
 * Time: 10:58
 */
include "../../utils/conn.php";
$array = array();
//审核通过单位
$sqlForEnter = " select count(`review_status`) as `num` from `t_enterprise_info`where `review_status`='通过审核'";
$resultForEnter = mysqli_query($conn,$sqlForEnter);
if($resultForEnter){
    $rowForEnter = mysqli_fetch_array($resultForEnter);
    $pass_review = $rowForEnter['num'];
}

//审核未通过单位
$sqlForEnter2 = " select count(`review_status`) as `num` from `t_enterprise_info`where `review_status`='未通过审核'";
$resultForEnter2 = mysqli_query($conn,$sqlForEnter2);
if($resultForEnter2){
    $rowForEnter2 = mysqli_fetch_array($resultForEnter2);
    $no_pass_review = $rowForEnter2['num'];
}

//未审核单位
$sqlForEnter3 = " select count(`review_status`) as `num` from `t_enterprise_info`where `review_status`='未审核'";
$resultForEnter3 = mysqli_query($conn,$sqlForEnter3);
if($resultForEnter3){
    $rowForEnter3 = mysqli_fetch_array($resultForEnter3);
    $no_review = $rowForEnter3['num'];
}

//已注册单位
$sqlForRegister = "select count(`organization_code`) as `register_num` from `t_enterprise_info` where `organization_code` != '' group by `organization_code`";
$resultForRegister = mysqli_query($conn,$sqlForRegister);
while($rowForRegister = mysqli_fetch_array($resultForRegister)){
    $enterForRegister[] = $rowForRegister['register_num'];
}
$register=array_sum($enterForRegister);
$enter_num = array(
    'pass_review'=>$pass_review,               //审核通过单位
    'no_pass_review'=>$no_pass_review,         //审核未通过单位
    'no_review'=>$no_review,                   //未审核单位
    'register'=>$register                      //已注册单位
);

//限额审核概况
$sqlForLimit = "select count(`a`.`enter_tsn`) as `enter_num` from (select `enter_tsn` from `t_tech_limit_fill` where `limit_year`=year(CURRENT_DATE ) group by `enter_tsn`,`limit_year`) as `a`";
$resultForLimit = mysqli_query($conn,$sqlForLimit);
if($resultForLimit){
    $rowForLimit = mysqli_fetch_array($resultForLimit);
}
$Limit_commit = $rowForLimit['enter_num'];  //今年已提交单位
$Limit_no_commit = $register-$Limit_commit; //今年未提交单位

//未通过审核单位
$sqlForLimitState = $conn->query("select count(`a`.`audit_state`) as `state_num` from (select `audit_state` from `t_tech_limit_fill` where `audit_state`='未通过审核' group by `enter_tsn`) as `a`");
$rowForLimitState = mysqli_fetch_array($sqlForLimitState);
$limit_no_pass = $rowForLimitState['state_num'];

//通过审核单位
$sqlForLimitState2 = $conn->query("select count(`a`.`audit_state`) as `state_num` from (select `audit_state` from `t_tech_limit_fill` where `audit_state`='通过审核' group by `enter_tsn`) as `a`");
$rowForLimitState2 = mysqli_fetch_array($sqlForLimitState2);
$limit_pass = $rowForLimitState2['state_num'];

//未审核单位
$sqlForLimitState3 = $conn->query("select count(`a`.`audit_state`) as `state_num` from (select `audit_state` from `t_tech_limit_fill` where `audit_state`='未审核' group by `enter_tsn`) as `a`");
$rowForLimitState3 = mysqli_fetch_array($sqlForLimitState3);
$limit_no_review = $rowForLimitState3['state_num'];

$limit_state = array(
    'Limit_commit'=>$Limit_commit,                //今年已提交单位
    'Limit_no_commit'=>$Limit_no_commit,          //今年未提交单位
    'limit_no_pass'=>$limit_no_pass,              //未通过审核单位
    'limit_pass'=>$limit_pass,                    //通过审核单位
    'limit_no_review'=>$limit_no_review           //未审核单位
);

//企业提出意见
$sqlForFeed = $conn->query("select count(`sub_question`) as `question_num` from `t_feedback`");
$rowForFeed = mysqli_fetch_array($sqlForFeed);
$feed_commit = $rowForFeed['question_num'];

//已回复意见
$sqlForFeed2 = $conn->query("select count(`sub_answer`) as `answer_num` from `t_feedback` where `sub_answer` != ''");
$rowForFeed2 = mysqli_fetch_array($sqlForFeed2);
$feed_answer = $rowForFeed2['answer_num'];

//未回复意见
$sqlForFeed3 = $conn->query("select count(`sub_answer`) as `answer_no_num` from `t_feedback` where `sub_answer`= ''");
$rowForFeed3 = mysqli_fetch_array($sqlForFeed3);
$feed_no_answer = $rowForFeed3['answer_no_num'];

$feed = array(
    'question_num'=>$feed_commit,             //企业提出意见
    'answer_num'=>$feed_answer,               //已回复意见
    'answer_no_num'=>$feed_no_answer          //未回复意见
);


//未审核数据的天数
$sqlForData = $conn->query("select count(`a`.`import_time`) from (select date(`import_time`) as `import_time` from `t_daily_data` where `verification_state`='未审核' group by date(`import_time`))  as `a`");
$rowForData = mysqli_fetch_array($sqlForData);
$no_verification = $rowForData['count(`a`.`import_time`)'];

//通过审核数据的天数
$sqlForData2 = $conn->query("select count(`a`.`import_time`) from (select date(`import_time`) as `import_time` from `t_daily_data` where `verification_state`='通过审核' group by date(`import_time`))  as `a`");
$rowForData2 = mysqli_fetch_array($sqlForData2);
$pass_verification = $rowForData2['count(`a`.`import_time`)'];

//未通过审核数据的天数
$sqlForData3 = $conn->query("select count(`a`.`import_time`) from (select date(`import_time`) as `import_time` from `t_daily_data` where `verification_state`='未通过审核' group by date(`import_time`))  as `a`");
$rowForData3 = mysqli_fetch_array($sqlForData3);
$no_pass_verification = $rowForData3['count(`a`.`import_time`)'];

$data_state = array(
    'no_verification'=>$no_verification,                  //未审核数据的天数
    'pass_verification'=>$pass_verification,              //通过审核数据的天数
    'no_pass_verification'=>$no_pass_verification         //未通过审核数据的天数
);
array_push($array,$enter_num,$limit_state,$feed,$data_state);
echo json_encode($array);
mysqli_close($conn);