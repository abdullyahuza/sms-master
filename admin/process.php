<?php
session_start();
include '../config/db.php';
$msg="";

if(isset($_POST['submit'])){
  
$_SESSION['user_name'] = $_POST['username'];
$password = $_POST['pass'];


if($_SESSION['email']&&$password){
  
  $sql= mysqli_query($connection,"SELECT * FROM admin WHERE user_name='".$_SESSION['user_name']."'");
  
  $numrows=(mysqli_num_rows($sql));
  
  if($numrows !=0)
  {
    
    while($row=mysqli_fetch_array($sql))
      {
        
      $dbuser=$row["user_name"];
      $dbpass=$row["password"];
      /* $_SESSION['user']=$row["user_id"];
      $_SESSION['user_name']=$row["user_name"];*/

    
      }
      
    if($_SESSION['user_name']==$dbuser)
    {
      
      if($password==$dbpass)
      {
      
        header("location: dashboard.php");
      
      }else{
        
         $msg="<p class='alert alert-danger'>Incorrect password</p>";
      
      }
      
      
    }else{
      
     $msg="<p class='alert alert-danger'>Invalid Username</p>";
      
      }
  }else {

      $msg="<p class='alert alert-danger'>Invalid username or password</p>";  
      
    
  }
  
  
}
}
?>