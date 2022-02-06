<pre>
<?php 
include('../config/db.php');
include('../functions.php');
$code = $_POST['code'];
$class = $_POST['class'];
$session = $_POST['session'];
$result = $_FILES["result"]["tmp_name"];
$term = substr($code, -1);
$term = (($term == 'F') ? 1 : ($term == 'S')) ? 2 : 3;
$table = "sesh".str_replace('/', '_', $session);

//get subject name
$mainCode = substr($code,0, -3);
$sql1 = mysqli_query($connection, "SELECT subject_name FROM add_subject WHERE code = '$mainCode' LIMIT 1");
$row = mysqli_fetch_assoc($sql1);
$subject = $row['subject_name'];

if(isset($_POST['upload_result'])){

	if ($_FILES["result"]["size"] > 0) { //check file size
		$csv_file = fopen($result,"r");   //open it as csv file

		$csv_results = array();   //array to keep result from our csv file

		while(($data = fgetcsv($csv_file, 1000, ",")) !== FALSE){
		    $num = count($data);
		    $result = array();    //array to store result -> 1 result per array
		    for($c=0; $c < $num; $c++){
		        array_push($result, $data[$c]);
		    }
		    array_push($csv_results, $result);  //populate $csv_users array with every $user
		}
		//insertion here
		for ($i=0; $i < count($csv_results); $i++) { 
			$adNo = $csv_results[$i][0];
			$ca1 = floatval($csv_results[$i][1]);
			$ca2 = floatval($csv_results[$i][2]);
			$exams = floatval($csv_results[$i][3]);
			$total = floatval($ca1+$ca2+$exams);

			//check if record is in table for update
			if(isExist($connection, $table, $session, $code, $term, $adNo)){
				$queryUpdate = "UPDATE `$table` SET 
				`ca1` = '$ca1',
				`ca2` = '$ca2',
				`exams` = '$exams',
				`total` = '$total'
				WHERE session='$session'AND subject_code='$code' AND term='$term' AND adNo='$adNo';";
				mysqli_query($connection, $queryUpdate);//run the update							
			}
			else{
				$query = "
				    INSERT INTO $table (session, subject_code, subject_name, class, term, adNo, ca1, ca2, exams, total) 
				    VALUES('$session','$code','$subject','$class','$term','$adNo','$ca1','$ca2','$exams','$total');";
				mysqli_query($connection, $query);//run query
			}

		}
		echo "<script> alert('Result uploaded successfully!'); window.location='upload_result.php' </script>";
	}
	else{
		echo "There was an error";
	}
	fclose($csv_file);
}

?>
<pre>