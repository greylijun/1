<?php
/**
 * Created by PhpStorm.
 * User: LiJun
 * Date: 2015/11/2
 * Time: 14:20
 */
$conn = @mysqli_connect('localhost','root','sudawl','szjl') or die ('Could not connect to MYSQL:'.mysqli_connect_error());
mysqli_set_charset($conn,'utf8');
?>