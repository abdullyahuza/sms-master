<?php 
	include('../config/db.php');

	if(isset($_POST['update_student'])){

		$adNo = $_POST['adNo'];
		$firstname=mysqli_real_escape_string($connection, $_POST["fname"]);
		$middlename=mysqli_real_escape_string($connection, $_POST["mname"]);
		$lastname=mysqli_real_escape_string($connection, $_POST["lname"]);
		$gender=$_POST["gender"];
		$dob=$_POST["dob"];
		$gname=$_POST["gname"];
		$moname=mysqli_real_escape_string($connection, $_POST["moname"]);
		$grelation=$_POST["grelation"];
		$gphone=$_POST["gphone"];
		$cadmitted=$_POST["cadmitted"];
		$cclass=$_POST["cclass"];
		$yadmitted=$_POST["yadmitted"];
		$address=$_POST["address"];
		//get passport

		if ($_FILES["passport"]["size"] > 0) {
			
			$adNo_ = str_replace('/','_',$adNo);
			$location = "../images/passports/";

			$passport = $_FILES["passport"]["tmp_name"];
			$extension = pathinfo($_FILES["passport"]["name"], PATHINFO_EXTENSION);
			if($extension == "jpg" OR $extension == "JPG"){
            	$rename = $adNo_."."."JPG";
			}else{
            	$rename = $adNo_."."."PNG";
			}
            move_uploaded_file($passport,$location.$rename);
		}

		$sql = "UPDATE tbl_student SET 
		fName='$firstname',
		mName='$middlename', 
		lName='$lastname', 
		gender='$gender', 
		dob='$dob', 
		gName='$gname',
		mothersName='$moname',
		gRelation='$grelation',
		gPhone='$gphone',
		cAdmitted='$cadmitted',
		cClass='$cclass',
		yAdmitted='$yadmitted',
		address='$address'
		WHERE adNo='$adNo';";
		
		if(mysqli_query($connection, $sql)){
			echo "<script> alert('Student updated!'); window.location='view_student.php?adNo=$adNo'</script>";
		}

	}else{
		echo "There was an error Error";
	}
 ?>