<?php 
	include('../config/db.php');
	
	if(!empty($_POST)){
		
		$class = $_POST['class'];
		$session = $_POST['session'];
		
		$output = "<option value=''>Select code</option>";

		$sql = "SELECT subject_code FROM tbl_subject WHERE class='$class' AND session ='$session' ORDER BY subject_code";
		$result = mysqli_query($connection,$sql);
		
		$subjectsArr = array();
		
		while($row = mysqli_fetch_assoc($result)){
			array_push($subjectsArr, $row);
		}

		if(count($subjectsArr)>0){
			foreach($subjectsArr as $subject){
				$output .= "
					<option value='".$subject['subject_code']."'>
						".$subject['subject_code']."
					</option>
				";
			}
			echo $output;
		}
		else{
			echo "No results Yet.";
		}

	}
	else{
		echo "There was an error.";
	}
?>