<?php
include('../config/db.php'); 
include('../functions.php');

//get the username
$staff = $_GET['staff_username'];

//get staff lastname
$sql = "SELECT lName FROM tbl_teacher WHERE staff_username='$staff'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result);
$lastname = make_hash($row['lName']);

//update reset staff pasword
$sql1 = "UPDATE tbl_teacher SET password='$lastname' WHERE staff_username='$staff'";

if(mysqli_query($connection, $sql1)){
			echo "<script> alert('Password Reset Sucsessful!'); window.location='view_teacher.php?staff_username=$staff' </script>";
}
 ?>