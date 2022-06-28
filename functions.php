<?php
    
function getPasswordAdmin($dbconn, $admin){
    $sql = "SELECT password FROM admin WHERE user_name='$admin';";
    $result = $dbconn->query($sql);
    $row = mysqli_fetch_assoc($result); 
    $password = $row['password'];

    return $password;
}

function getPassword($dbconn, $staff){
    $sql = "SELECT password FROM tbl_teacher WHERE staff_username='$staff';";
    $result = $dbconn->query($sql);
    $row = mysqli_fetch_assoc($result); 
    $password = $row['password'];

    return $password;
}

function getClass($dbconn, $staff){
    $sql = "SELECT class FROM tbl_teacher WHERE staff_username='$staff';";
    $result = $dbconn->query($sql);
    $row = mysqli_fetch_assoc($result); 
    $class = $row['class'];

    return $class;
}

function getTitle($dbconn, $code){
    //remove class and term
    $code = substr($code, 0,-3);

    $sql = "SELECT subject_name FROM add_subject WHERE code='$code';";
    $result = $dbconn->query($sql);
    $row = mysqli_fetch_assoc($result); 
    $title = $row['subject_name'];

    return $title;
}

function checkPassport($adNo, $path){
    $adNo = str_replace('/','_',$adNo);

    if(file_exists($path.$adNo.".JPG")){
        $ext = pathinfo($path.$adNo.".JPG", PATHINFO_EXTENSION);
        return $adNo.".".$ext;
    }
    else if(file_exists($path.$adNo.".PNG")){
        $ext = pathinfo($path.$adNo.".PNG", PATHINFO_EXTENSION);
        return $adNo.".".$ext;   
    }
    return false;
}

function checkStaffPassport($staff, $path){

    if(file_exists($path.$staff.".JPG")){
        $ext = pathinfo($path.$staff.".JPG", PATHINFO_EXTENSION);
        return $staff.".".$ext;   
    }
    else if(file_exists($path.$staff.".PNG")){
        $ext = pathinfo($path.$staff.".PNG", PATHINFO_EXTENSION);
        return $staff.".".$ext;
    }
    return false;
}

function isExist($dbconn, $table, $session, $code, $term, $adNo){
    $sql = "SELECT COUNT(*) AS total FROM $table WHERE session='$session' AND subject_code='$code' AND term='$term' AND adNo='$adNo'";
    $result = $dbconn->query($sql);
    $count=mysqli_fetch_assoc($result);
    $status = intval($count['total']);
    
    return $status > 0 ? true : false;  
}

function isAdmin($dbconn, $username){
    $sql = "SELECT isAdmin FROM admin WHERE user_name='$username';";
    $result = $dbconn->query($sql);
    $row = mysqli_fetch_assoc($result); 
    $status = $row['isAdmin'];

    return $status; 
}

//grades: A B C D E F 
//range: 75 - 100  |  70 - 74  |  65 - 69  |  60 - 64  |  55 - 59  
function getGrade($score){
    if($score < 0 || $score > 100 ){
        return "Invalid";
    }
    else if($score < 30){
        return "F";
    }
    else if($score>=30 && $score<=39){
        return "E";
    }
    else if($score>=40 && $score<=49){
        return "D";
    }
    else if($score>=50 && $score<=59){
        return "C";
    }
    else if($score>=50 && $score<=69){
        return "B";
    }
    else{
        return "A";
    }

}

//return CA1 total
function totalCA1($arr){
    $total = 0;
    if(count($arr)>0){
        foreach($arr as $sub){
            $total += $sub['ca1'];
        }
        if($total <= (count($arr) * 20)){
            return round($total,2);
        }
        else{
            return "Invalid";
        }

    }else{
        return 0;
    }
}

//return CA2 total
function totalCA2($arr){
    $total = 0;
    if(count($arr)>0){
        foreach($arr as $sub){
            $total += $sub['ca2'];
        }
        if($total <= (count($arr) * 20)){
            return round($total,2);
        }
        else{
            return "Invalid";
        }

    }else{
        return 0;
    }
}

//return exams total
function totalExams($arr){
    $total = 0;
    if(count($arr)>0){
        foreach($arr as $sub){
            $total += $sub['exams'];
        }
        if($total <= (count($arr) * 60)){
            return round($total,2);
        }
        else{
            return "Invalid";
        }

    }else{
        return 0;
    }
}

//return CA1 total
function totalMarks($arr){
    $total = 0;
    if(count($arr)>0){
        foreach($arr as $sub){
            $total += $sub['total'];
        }
        if($total <= (count($arr) * 100)){
            return round($total,2);
        }
        else{
            return "Invalid";
        }

    }else{
        return 0;
    }
}

function getOverallGrade($totalScore, $grandTotal){
    if($totalScore != 'Invalid'){
        if($totalScore > 0 && $totalScore <= $grandTotal){
            $to_hundred = ($totalScore/$grandTotal) * 100;
            return getGrade(intval($to_hundred));
        }
        else{
            return 'Invalid';
        }
    }
    else{
        return 'Invalid';
    }
}

function totalPercent($totalScore, $grandTotal){
    if($totalScore > 0 && $totalScore <= $grandTotal){
        $to_hundred = ($totalScore/$grandTotal) * 100;
        return round($to_hundred,0);
    }
    else{
        return 'Invalid';
    }
}

function getMaxAdNo($dbconn,$year){
    $sql = "SELECT MAX(adNo) as adNo FROM tbl_student WHERE yAdmitted='$year'";
    $result = $dbconn->query($sql);
    $row=mysqli_fetch_array($result);
    $maxAdNo = $row['adNo'];

    //strip name/year from the adno
    $maxAdNo = substr($maxAdNo,6);
    //convert to interger
    $maxAdNo = intval($maxAdNo);
    return $maxAdNo;
}

function genAdno($dbconn, $year){
    $num = rand(1,1000);    //1-9, 10-99, 100-999

    $lastAdNo = getMaxAdNo($dbconn, $year);
    $num = $lastAdNo + 1;

    if($num<10){
        $num='000'.$num;   
    }
    else if($num >= 10 && $num <= 99){
        $num='00'.$num;   
    }
    else{
        $num = '0'.$num;
    }
    return "TB/".substr($year,-2)."/".$num;
}

function make_hash($string) {
    try {
        return password_hash($string, PASSWORD_BCRYPT);
    } catch (Exception $e) {
        $this->$e->getMessage();
        return false;
    }
}

function un_hash($string, $hash) {
    try {
        if (password_verify($string, $hash)) {
            return true;
        } else {
            return false;
        }
    } catch(Exception $e) {
        $this->$e->getMessage();
        return false;
    }
}

//check existance in db
function itExist($dbconn, $table, $column, $value){
    $sql = "SELECT $column FROM $table WHERE $column='$value';";
    $result = $dbconn->query($sql);
    $status = mysqli_num_rows($result) > 0 ? true : false;
    return $status;
}
 ?>