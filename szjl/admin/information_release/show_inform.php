<?php
include("../../utils/conn.php"); 
$array = array();
$sql = "SELECT * FROM `t_inform`";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
	$enter_data = array(
	'row_id'=>$row['row_id'],
    'name'=>$row['name'],                       
    'content'=>$row['content'], 
	'unit'=>$row['unit'],
	'date'=>$row['date']
);
array_push($array,$enter_data);
}
echo json_encode($array);
mysqli_close($conn);

?>