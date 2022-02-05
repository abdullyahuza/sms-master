<?php 
	include('../config/db.php');

	if(isset($_POST['update_staff'])){

		$staff = $_POST['staff_username'];
		$firstname=mysqli_real_escape_string($connection, $_POST["fname"]);
		$middlename=mysqli_real_escape_string($connection, $_POST["mname"]);
		$lastname=mysqli_real_escape_string($connection, $_POST["lname"]);
		$gender=$_POST["gender"];
		$dob=$_POST["dob"];
		$email=$_POST["email"];
		$phone=$_POST["phone"];
		$address=$_POST["address"];
		$class=$_POST["class"];
		//get passport

		if ($_FILES["passport"]["size"] > 0) {
			
			$location = "../images/staff/";

            $rename = $staff.'.'.'JPG';
			$passport = $_FILES["passport"]["tmp_name"];
            move_uploaded_file($passport,$location.$rename);
		}

		$sql = "UPDATE tbl_teacher SET 
		fName='$firstname',
		mName='$middlename', 
		lName='$lastname', 
		gender='$gender', 
		dob='$dob',
		phone='$phone',
		email='$email',
		address='$address',
		class='$class'
		WHERE staff_username='$staff';";
		
		if(mysqli_query($connection, $sql)){
			echo "<script> alert('Staff updated!'); window.location='view_teacher.php?staff_username=$staff' </script>";
		}

	}else{
		echo "There was an error Error";
	}
 ?>