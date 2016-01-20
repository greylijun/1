<?php
include("../../utils/conn.php"); 
$array = array();
$sql = "SELECT row_id,theme,sub_question,sub_time FROM `t_feedback`  where sub_answer=''";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
	$enter_data = array(
    'theme'=>$row['theme'],                       
    'sub_question'=>$row['sub_question'],  
	'sub_time'=>$row['sub_time'],
	'row_id'=>$row['row_id'],     
);
array_push($array,$enter_data);
}
echo json_encode($array);
mysqli_close($conn);

?>



