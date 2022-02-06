<?php

    function checkPassport($adNo, $path){
        $adNo = str_replace('/','_',$adNo);

        if(file_exists($path.$adNo.".PNG")){
            return true;
        }
        return false;
    }

    function checkStaffPassport($staff, $path){

        if(file_exists($path.$staff.".PNG")){
            return true;
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

    function genAdno($year){
        $num = rand(1,1000);    //1-9, 10-99, 100-999
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
 ?>