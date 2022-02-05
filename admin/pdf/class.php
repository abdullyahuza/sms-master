<?php 
//includes
include('../../config/db.php');
include('../../functions.php');
require './fpdf184/fpdf.php';
require './rotation.php';


if(isset($_GET['print_entire'])){

	class PDF extends PDF_Rotate {
		/*Header*/
		function Header(){
	        //watermark
	        $this->SetFont('Arial','B',50);
	        $this->SetTextColor(241,176,174);
	        $this->RotatedText(35,190,'T  &  B     A C A D E M Y',50);
	        $this->RotatedText(45,250,'T  &  B     A C A D E M Y',50);
	        
	        //logo
	        $this->Image('logo.jpeg',5,3,-800);
			$this->SetY(10);
			// Select Arial bold 15
		    $this->SetFont('Arial','B',30);
		    // Move to the right
		    $this->Cell(80);
		    // Framed title
	        $this->SetTextColor(41,22,111);
		    $this->Cell(30,-4,'T  &  B     A C A D E M Y',0,0,'C');
			
			//passport
		}

		function Passport($passport){

			$this->Image($passport,176,3,30,32);

		    // Line break
		    $this->Ln();

		    $this->Cell(80);
		    $this->SetFont('Arial','',11);
		    $this->Cell(30,18,'No. 18 Nuhu Aliyu Street Rigasa Kaduna.',0,0,'C');	

	        // Line break
	        $this->Ln(14);

	        $this->Cell(80);
	        $this->SetFont('Arial','',11);
	        $this->Cell(30,0,'08099999999 | 09088888888',0,0,'C');       
	    
		    $this->Ln(6);
		}

		function RotatedText($x, $y, $txt, $angle)
	    {
	        //Text rotated around its origin
	        $this->Rotate($angle,$x,$y);
	        $this->Text($x,$y,$txt);
	        $this->Rotate(0);
	    }

	    //session cell
	    function SessionCell($text){
            $this->SetFont('Arial','',12);
            $w = $this->GetStringWidth($text)+8;
            $this->SetX((210-$w)/2);
            $this->SetDrawColor(41,22,111);
            $this->SetFillColor(241,176,174);
            $this->SetTextColor(41,22,111);
            $this->SetLineWidth(0.5);
            $this->Cell($w,7,$text,1,1,'C',true);
            $this->Ln(0);
            // Save ordinate
            $this->y0 = $this->GetY();
		}

		//class cell
		function ClassCell($class){
			$this->Ln(0);
	        $this->SetFont('Arial','',12);
	        $w = $this->GetStringWidth($class)+8;
	        $this->SetX((210-$w)/2);
	        $this->SetTextColor(41,22,111);
	        $this->SetLineWidth(0.3);
	        $this->Cell($w,7,$class,1,1,'C');
	        $this->Ln(5);
	        // Save ordinate
	        $this->y0 = $this->GetY();
		}

		function Biodata($name, $fname, $adNo, $mname, $address, $dob){
	        $this->SetX(5);
	        $this->SetFont('Arial','',11);
	        $this->Cell(33,5,'Name of student', 0, 0);
	        $this->SetFont('Courier','B',11);
	        $this->Cell(88,5,': '.$name, 0, 0);
	        $this->SetFont('Arial','',11);
	        $this->Cell(30,5,'Admission No.', 0, 0);
	        $this->SetFont('Courier','B',11);
	        $this->Cell(40,5,': '.$adNo, 0, 1);

	        $this->SetX(5);
	        $this->SetFont('Arial','',11);
	        $this->Cell(33,5,"Father's name", 0, 0);
	        $this->SetFont('Courier','B',11);
	        $this->Cell(88,5,': '.$fname, 0, 0);
	        $this->SetFont('Arial','',11);
	        $this->Cell(30,5,"Mother's name", 0, 0);
	        $this->SetFont('Courier','B',11);
	        $this->Cell(40,5,": ".$mname, 0, 1);

	        $this->SetX(5);
	        $this->SetFont('Arial','',11);
	        $this->Cell(33,5,"Address", 0, 0);
	        $this->SetFont('Courier','B',11);
	        $this->Cell(88,5,': '.$address, 0, 0);
	        $this->SetFont('Arial','',11);
	        $this->Cell(30,5,"Date of birth", 0, 0);
	        $this->SetFont('Courier','B',11);
	        $this->Cell(40,5,": ".$dob, 0, 1);

	        $this->Line(5,63,205,63);
	        $this->Ln();
		}

		//Result header
		function ResultHeader($term){
		        
	        $this->SetX(5);
	        $this->SetFont("Arial",'B',10);
	        $this->SetDrawColor(41,22,111);
	        $this->SetFillColor(241,176,174);
	        $this->SetTextColor(41,22,111);
	        $this->Cell(60,8,'Scholastic Areas',1,0,'L',true);
	        $this->Cell(140,8,$term.' Exams (100)',1,0,'C',true);
	        $this->Ln();

	        $this->SetX(5);
	        $this->SetFont("Arial",'B',10);
	        $this->Cell(60,8,'Subjects',1,0,'L');
	        $this->Cell(20,8,'CA1 (20)',1,0,'C');
	        $this->Cell(20,8,'CA2 (20)',1,0,'C');
	        $this->Cell(30,8,'Exams (60)',1,0,'C');
	        $this->Cell(40,8,'Total Marks (100)',1,0,'C');
	        $this->Cell(30,8,'Grade',1,0,'C');
	        $this->Ln();
		}

		//Subject
		function Subject($subject, $firstCA, $secondCA, $exams, $total, $grade){
	        $this->SetX(5);
	        $this->SetFont("Arial",'',10);
	        $this->Cell(60,7,$subject,1,0,'L');
	        $this->Cell(20,7,$firstCA,1,0,'C');
	        $this->Cell(20,7,$secondCA,1,0,'C');
	        $this->Cell(30,7,$exams,1,0,'C');
	        $this->Cell(40,7,$total,1,0,'C');
	        $this->Cell(30,7,$grade,1,0,'C');
	        $this->Ln();        
		}

		//Total score
		function TotalScore($totalCA1, $totalCA2, $totalExams, $totalMarks){
	        $this->SetX(5);
	        $this->SetFont("Arial", "B", 10);
	        $this->Cell(60,7,'Total score',1,0,'L');
	        $this->Cell(20,7,$totalCA1,1,0,'C');
	        $this->Cell(20,7,$totalCA2,1,0,'C');
	        $this->Cell(30,7,$totalExams,1,0,'C');
	        $this->Cell(40,7,$totalMarks,1,0,'C');
	        $this->Cell(30,7,'',1,0,'C');
	        $this->Ln();
    	}

    	//Overall grade
    	function OverallGrade($ca1Grade,$ca2Grade,$examsGrade,$MarksGrade){
	        $this->SetX(5);
	        $this->SetFont("Arial", "B", 10);
	        $this->Cell(60,7,'Overall Grade',1,0,'L');
	        $this->Cell(20,7,$ca1Grade,1,0,'C');
	        $this->Cell(20,7,$ca2Grade,1,0,'C');
	        $this->Cell(30,7,$examsGrade,1,0,'C');
	        $this->Cell(40,7,$MarksGrade,1,0,'C');
	        $this->Cell(30,7,'',1,0,'C');
	        $this->Ln();
	    }

	    //Total percent
	    function TotalPercent($ca1Percent,$ca2Percent,$examsPercent,$MarksPercent){
	        $this->SetX(5);
	        $this->SetFont("Arial", "B", 10);
	        $this->Cell(60,7,'Total Percentage',1,0,'L');
	        $this->Cell(20,7,$ca1Percent.'%',1,0,'C');
	        $this->Cell(20,7,$ca2Percent.'%',1,0,'C');
	        $this->Cell(30,7,$examsPercent.'%',1,0,'C');
	        $this->Cell(40,7,$MarksPercent.'%',1,0,'C');
	        $this->Cell(30,7,'',1,0,'C');
	        $this->Ln();
	    }

	    //scholastic area
	    function CoScholasticArea(){
	        $this->Ln();
	        $this->SetX(5);
	        $this->SetFont("Arial",'B',10);
	        $this->Cell(52,6,'Effectiveness Domain',1,0,'C');
	        $this->Cell(33,6,'This Term Report',1,0,'C');
	        $this->Cell(10,6,'',0,0,'C');
	        $this->SetFont("Arial",'B',7);
	        $this->Cell(105,6,'Effectiveness Grading Scale: Grades are awarded on 3 points grading scale as follows',1,1,'C');
	        // $this->Cell(33,8,'This Term Report',1,1,'C');

	        //Attentivenes
	        $this->SetX(5);
	        $this->SetFont("Arial",'',10);
	        $this->Cell(52,6,'Attentiveness',1,0,'L');
	        $this->Cell(33,6,'',1,0,'C');
	        $this->Cell(10,6,'',0,0,'C');
	        $this->Cell(30,6,'Grade',1,0,'L');
	        $this->SetFont("Arial",'B',10);
	        $this->Cell(25,6,'A',1,0,'C');
	        $this->Cell(25,6,'B',1,0,'C');
	        $this->Cell(25,6,'C',1,1,'C');

	        //Attendance
	        $this->SetX(5);
	        $this->SetFont("Arial",'',10);
	        $this->Cell(52,6,'Class Attendance',1,0,'L');
	        $this->Cell(33,6,'',1,0,'C');
	        $this->Cell(10,6,'',0,0,'C');
	        $this->Cell(30,6,'Description',1,0,'L');
	        $this->Cell(25,6,'Excellent',1,0,'C');
	        $this->Cell(25,6,'Very Good',1,0,'C');
	        $this->Cell(25,6,'Good',1,1,'C');
	        
	        
	        
	        //Neatness
	        $this->SetX(5);
	        $this->SetFont("Arial",'',10);
	        $this->Cell(52,6,'Neatness',1,0,'L');
	        $this->Cell(33,6,'',1,0,'C');
	        $this->Cell(10,6,'',0,0,'C');
	        $this->SetFont("Arial",'B',8);
	        $this->Cell(105,6,"Class teacher's remark",0,1,'C');
	        
	        
	        //punctuality
	        $this->SetX(5);
	        $this->SetFont("Arial",'',10);
	        $this->Cell(52,6,'Punctuality',1,0,'L');
	        $this->Cell(33,6,'',1,0,'C');
	        $this->Cell(10,6,'',0,0,'C');
	        $this->Cell(105,6,"",0,1,'L');


	        //politeness
	        $this->SetX(5);
	        $this->SetFont("Arial",'',10);
	        $this->Cell(52,6,'Politeness',1,0,'L');
	        $this->Cell(33,6,'',1,0,'C');
	        $this->Cell(10,6,'',0,0,'C');
	        $this->Cell(105,6,"",0,1,'L');

	        //Honesty
	        //Attentivenes
	        $this->SetX(5);
	        $this->SetFont("Arial",'',10);
	        $this->Cell(52,6,'Honesty',1,0,'L');
	        $this->Cell(33,6,'',1,0,'C');
	        $this->Cell(10,6,'',0,0,'C');
	        $this->Cell(105,6,"",0,1,'L');

	        $this->Ln();
	        $this->SetX(5);
	        $this->SetFont("Arial",'B',10);
	        $this->Cell(200,6,'Scholastic grade scale: Grades are awarded on a 9 points grading scale as follows (%)',1,1,'C');

	        $this->SetX(5);
	        $this->Cell(20,6,'Grade',1,0,'L');
	        $this->SetFont("Arial",'B',10);
	        $this->Cell(30,6,'A',1,0,'C');
	        $this->Cell(30,6,'B',1,0,'C');
	        $this->Cell(30,6,'C',1,0,'C');
	        $this->Cell(30,6,'D',1,0,'C');
	        $this->Cell(30,6,'E',1,0,'C');
	        $this->Cell(30,6,'F',1,1,'C');
	        
	        $this->SetX(5);
	        $this->SetFont("Arial",'B',8);
	        $this->Cell(20,6,'Marks range',1,0,'L');
	        $this->SetFont("Arial",'',10);
	        $this->Cell(30,6,'70 - 100',1,0,'C');
	        $this->Cell(30,6,'60 - 69',1,0,'C');
	        $this->Cell(30,6,'50 - 59',1,0,'C');
	        $this->Cell(30,6,'40 - 49',1,0,'C');
	        $this->Cell(30,6,'30 - 39',1,0,'C');
	        $this->Cell(30,6,'0 - 29',1,1,'C');

	        $this->SetX(5);
	        $this->SetFont("Arial",'B',8);
	        $this->Cell(20,6,'Description',1,0,'L');
	        $this->SetFont("Arial",'',10);
	        $this->Cell(30,6,'Excellent',1,0,'C');
	        $this->Cell(30,6,'Very Good',1,0,'C');
	        $this->Cell(30,6,'Good',1,0,'C');
	        $this->Cell(30,6,'Fair',1,0,'C');
	        $this->Cell(30,6,'Poor',1,0,'C');
	        $this->Cell(30,6,'Very Poor',1,1,'C');
	        // $this->Ln();
    	}

    	function Signature(){
    		// Go to 1.5 cm from bottom
	        // $this->SetAutoPageBreak(false);
	        $this->SetY(-10);
	        // Select Arial italic 8
	        $this->SetFont('Arial','I',8);
	        $this->Line(5,285,205,285);  
	        $this->SetX(5);
	        $this->Cell(66,5,'Class teacher signature',0,0,'C');
	        $this->Cell(66,5,'Principal',0,0,'C');
	        $this->Cell(66,5,'Management',0,1,'C');
	        // Print centered page number
	        // $this->Cell(0,0,'Page '.$this->PageNo(),0,0,'C');
    	} 

    	//footer
    	function Footer(){
	        // Go to 1.5 cm from bottom
	        // $this->SetAutoPageBreak(false);
	        $this->SetY(-10);
	        // Select Arial italic 8
	        $this->SetFont('Arial','I',8);
	        $this->Line(5,285,205,285);  
	        $this->SetX(5);
	        $this->Cell(66,5,'Class teacher signature',0,0,'C');
	        $this->Cell(66,5,'Principal',0,0,'C');
	        $this->Cell(66,5,'Management',0,1,'C');
	        // Print centered page number
	        // $this->Cell(0,0,'Page '.$this->PageNo(),0,0,'C');
    	}


	}/*class ends here*/

	//get class
	$class = $_GET['class'];
	$session = $_GET['session'];
	$term = $_GET['term'];


	//get all student's adno that are in selected class
	$adno_query = "SELECT adNo FROM tbl_student WHERE cClass='jss 1'";
	$adno_result= mysqli_query($connection,$adno_query);

	$adnoArr = array();
	
	while($row = mysqli_fetch_assoc($adno_result)){
		array_push($adnoArr, $row['adNo']);
	}

	$pdf = new PDF();
	$pdf->SetTitle("T & B RESULT SLIP");
	// $pdf->Footer();

	foreach($adnoArr as $adNo){
		//student Biodata
		$query = mysqli_query($connection, "SELECT * FROM tbl_student WHERE adNo='$adNo'");
		$row = mysqli_fetch_assoc($query);
		$sname= $row['fName']." ".$row['mName']." ".$row['lName'];
		$sfname= $row['gName'];
		$smname= $row['mothersName'];
		$saddress= $row['address'];
		$sdob= $row['dob'];

		if(file_exists("../../images/passports/".str_replace("/","_",$adNo).".JPG")){
			$passport = "../../images/passports/".str_replace("/","_",$adNo).".JPG";
		}
		else{
			$passport = "../../images/avatar.png";	
		}

		//term to string
		$termString = (($term == '1') ? 'First Term' : ($term == '2')) ? 'Second Term' : 'Third Term';

		//get student result base on adNo, term, session and class
		$table = str_replace("/",'_',$session);
		$table = 'sesh'.$table;
		$result_sql = "SELECT subject_name,ca1,ca2,exams,total FROM $table WHERE adNo='$adNo' AND class='$class' AND session='$session' AND term=$term ";
		$result = mysqli_query($connection,$result_sql);

		$resultArr = array();
		
		while($row = mysqli_fetch_assoc($result)){
			array_push($resultArr, $row);
		}

		$pdf->AddPage();
		$pdf->Passport($passport);
		$pdf->SessionCell("STUDENT TERM REPORT SLIP ".$session." SESSION");
		$pdf->ClassCell(strtoupper($class));
		$pdf->Biodata($sname,$sfname,$adNo,$smname,$saddress,$sdob);
		$pdf->ResultHeader($termString);
		if(count($resultArr)>0){
			foreach($resultArr as $subject){
				$pdf->Subject($subject['subject_name'],$subject['ca1'],$subject['ca2'],$subject['exams'],$subject['total'],getGrade($subject['total']));	
			}
		}
		$pdf->TotalScore(totalCA1($resultArr),totalCA2($resultArr),totalExams($resultArr),totalMarks($resultArr));

		$ca1Grade = getOverallGrade(totalCA1($resultArr), count($resultArr)*20);
		$ca2Grade = getOverallGrade(totalCA2($resultArr), count($resultArr)*20);
		$examsGrade = getOverallGrade(totalExams($resultArr), count($resultArr)*60);
		$marksGrade = getOverallGrade(totalMarks($resultArr), count($resultArr)*100);

		$ca1Percent = totalPercent(totalCA1($resultArr), count($resultArr)*20);
		$ca2Percent = totalPercent(totalCA2($resultArr), count($resultArr)*20);
		$examsPercent = totalPercent(totalExams($resultArr), count($resultArr)*60);
		$marksPercent = totalPercent(totalMarks($resultArr), count($resultArr)*100);

		$pdf->OverallGrade($ca1Grade,$ca2Grade,$examsGrade,$marksGrade);
		$pdf->TotalPercent($ca1Percent,$ca2Percent,$examsPercent,$marksPercent);
		$pdf->CoScholasticArea();
	}
	

	$pdf->Output();
}
else{
	echo "Something is wrong...";
}

?>