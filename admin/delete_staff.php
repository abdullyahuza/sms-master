<?php
 include('../config/db.php');
 $staff_username=$_GET['staff_username'];

 $sql=mysqli_query($connection, "DELETE FROM tbl_teacher WHERE staff_username='$staff_username'");

 $passport = str_replace("/","_", $staff_username).".JPG";
 if(file_exists($passport)){
    unlink("../images/staff/".$passport);
 }

echo "<script> alert('Staff Deleted Successfully'); window.location='teacher_panel.php'</script> ";

?>