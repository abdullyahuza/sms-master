<?php
 include('../config/db.php');
 $code=$_GET['code'];

 $sql=mysqli_query($connection, "DELETE FROM tbl_subject WHERE subject_code='$code'");

echo "<script> alert('Subject Deleted Successfully'); window.location='create_subjects.php'</script> ";

?>