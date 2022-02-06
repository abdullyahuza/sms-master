<pre>
<?php
session_start();
error_reporting();
include '../config/db.php';
$msg="";

if(isset($_POST['upload_students'])){
	//get the file ready for processing
	$students_file = $_FILES["students_file"]["tmp_name"];

	if ($_FILES["students_file"]["size"] > 0) { //check file size
		$csv_file = fopen($students_file,"r");   //opne it as csv file

		$students_in_db = array(); //array to keep all users id from DB.
        $query_students = "SELECT adNo FROM tbl_student"; //query user_id only
        $query_result =  mysqli_query($connection, $query_students);

        while($row = mysqli_fetch_array($query_result)){
            array_push($students_in_db, $row['adNo']);  //populate the array; $users_in_db
        }

        //read CSV file        
        if($csv_file != FALSE){
            $csv_students = array();   //array to keep users from our csv file
            while(($data = fgetcsv($csv_file, 1000, ",")) !== FALSE){
                $num = count($data);
                $student = array();    //array to store user -> 1 user per array
                for($c=0; $c < $num; $c++){
                    // echo $data[$c] . "<br/>\n";
                    array_push($student, $data[$c]);
                }
                array_push($csv_students, $student);  //populate $csv_users array with every $user
            }
        }else{
            echo "The selected file has no records.";
        }

        $students_adNo = array(); //store users id only for comparison
        for($i=0; $i < count($csv_students); $i++){
            array_push($students_adNo, $csv_students[$i][0]);

            $adNo = mysqli_real_escape_string($connection, $csv_students[$i][0]);
            $fname = mysqli_real_escape_string($connection, $csv_students[$i][1]);
            $mname = mysqli_real_escape_string($connection, $csv_students[$i][2]);
            $lname = mysqli_real_escape_string($connection, $csv_students[$i][3]);
            $gender = $csv_students[$i][4];
            $dob = $csv_students[$i][5];
            $gname = mysqli_real_escape_string($connection, $csv_students[$i][6]);
            $moname = mysqli_real_escape_string($connection, $csv_students[$i][7]);
            $grelation = $csv_students[$i][8];
            $gphone = $csv_students[$i][9];
            $cadmitted = $csv_students[$i][10];
            $cclass = $csv_students[$i][11];
            $address = $csv_students[$i][12];
            $yadmitted = $csv_students[$i][13];

            if(in_array($csv_students[$i][0], $students_in_db)){
                
                //update student
                $queryUpdate = "UPDATE `tbl_student` SET 
                `fName` = '$fname',
                `mName` = '$mname',
                `lName` = '$lname',
                `gender` = '$gender',
                `dob` = '$dob',
                `gName` = '$gname',
                `mothersName` = '$moname',
                `gRelation` = '$grelation',
                `gPhone` = '$gphone',
                `cAdmitted` = '$cadmitted',
                `cClass` = '$cclass',
                `address` = '$address',
                `yAdmitted` = '$yadmitted'
                WHERE adNo='$adNo';";
                mysqli_query($connection, $queryUpdate);//run the update
            }else{
                
                //insertion here

                $query = "
                    INSERT INTO tbl_student (adNo, fName, mName, lName, gender, dob, gName, mothersName, gRelation, gPhone, cAdmitted, cClass, address, yAdmitted) 
                    VALUES('$adNo', '$fname', '$mname', '$lname', '$gender', '$dob','$gname','$moname','$grelation','$gphone','$cadmitted','$cclass','$address','$yadmitted');";
                mysqli_query($connection, $query);//run query

            }
        }
        fclose($csv_file);
        echo "<script> alert('Sudents updated successfully!'); window.location='upload_students.php' </script>";       
	}else{
		echo "<script> alert('An Error Occured!'); window.location='upload_students.php' </script>";
	}
}else{
	echo "<script> window.location='upload_students.php' </script>";
}

?>
</pre>