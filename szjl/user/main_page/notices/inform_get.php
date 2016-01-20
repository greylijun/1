<?php
include("../../../utils/conn.php"); 
session_start();
$row_id=$_SESSION['row_id'];
$array = array();
$sql = "SELECT * FROM `t_inform` where row_id='$row_id'";
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
unset($_SESSION['row_id']);
echo json_encode($array);
mysqli_close($conn);

?>

