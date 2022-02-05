<?php
 include('../config/db.php');
 $code=$_GET['code'];

 $sql=mysqli_query($connection, "DELETE FROM add_subject WHERE code='$code'");

echo "<script> alert('Subject Deleted Successfully'); window.location='all_subjects.php'</script> ";

?>