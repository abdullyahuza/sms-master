<?php
 include('../config/db.php');
 $session=$_GET['session'];
 $table = str_replace('/','_',$session);
 $table = "sesh".$table;

 $sql=mysqli_query($connection, "DELETE FROM session WHERE session='$session'");
 $sql2=mysqli_query($connection, "DROP TABLE ".$table.";");

echo "<script> alert('Session Deleted Successfully'); window.location='all_sessions.php'</script> ";

?>