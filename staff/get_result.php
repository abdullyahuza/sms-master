<?php 
	include('../config/db.php');
	
	if(!empty($_POST)){
		
		$session = $_POST['session'];
		$table = str_replace("/",'_',$session);
		$table = 'sesh'.$table;
		$adNo = $_POST['adNo'];
		$term = intval($_POST['term']);
		$class = $_POST['class'];
		
		$output = "";

		$sql = "SELECT subject_code,subject_name, ca1,ca2,exams,total FROM $table WHERE adNo='$adNo' AND class='$class' AND session='$session' AND term=$term ";
		$result = mysqli_query($connection,$sql);
		
		$resultArr = array();
		
		while($row = mysqli_fetch_assoc($result)){
			array_push($resultArr, $row);
		}

		if(count($resultArr)>0){
			$i=1;
			foreach($resultArr as $subject){
				$output .= "
					<tr>
						<td>".$i."</td>
						<td>".$subject['subject_code']."</td>
						<td>".$subject['subject_name']."</td>
						<td>".$subject['ca1']."</td>
						<td>".$subject['ca2']."</td>
						<td>".$subject['exams']."</td>
						<td>".$subject['total']."</td>
					</tr>
				";
				$i++;
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