<?php
include("../../../utils/conn.php"); 
$array = array();
$sql = "SELECT row_id,theme,sub_question,sub_answer,sub_time,Upd_date FROM t_feedback where sub_answer!='' ";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
	$enter_data = array(
	'row_id'=>$row['row_id'],
    'theme'=>$row['theme'],                       
    'sub_question'=>$row['sub_question'], 
	'sub_answer'=>$row['sub_answer'],
	'sub_time'=>$row['sub_time'],
	'Upd_date'=>$row['Upd_date']
);
array_push($array,$enter_data);
}
echo json_encode($array);
mysqli_close($conn);

?>


