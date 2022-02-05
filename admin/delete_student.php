<?php
 include('../config/db.php');
 $adNo=$_GET['adNo'];

 $sql=mysqli_query($connection, "DELETE FROM tbl_student WHERE adNo='$adNo'");

 $passport = str_replace("/","_", $adNo).".JPG";
 if(file_exists($passport)){
    unlink("../images/passports/".$passport);
 }

echo "<script> alert('Student Deleted Successfully'); window.location='student_panel.php'</script> ";

?>