<?php
include("../../utils/conn.php"); 
session_start();
$enter_tsn = $_SESSION['enter_tsn'];
$sql = "SELECT business_contacts,contact_number,E_mail FROM `t_enterprise_info` where tsn='$enter_tsn '";
$result = mysqli_query($conn,$sql);
if($result){
    $row = mysqli_fetch_array($result);
}
$enter_data = array(
    'username'=>$row['business_contacts'],                       
    'tel'=>$row['contact_number'],    
    'email'=>$row['E_mail'],               
    
);
echo json_encode($enter_data);
mysqli_close($conn);

?>































