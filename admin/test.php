<?php 
$query = mysqli_query($connection, "SELECT subject_code FROM tbl_subject");

while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
?>
<option value="<?php echo $row['subject_code']; ?>">
  <?php echo $row['subject_code']; ?>  
</option>
<?php
} //while ends here                                                            
?>

<?php 
    include('../functions.php');
    include('../config/db.php');
    
    $row=1;
    if(($handle=fopen("../addstudents.csv","r"))!==FALSE){
        while(($data=fgetcsv($handle,1000,","))!==FALSE){
            $num=count($data);
            echo"<p>$num fields in line $row: <br/></p>\n";
            $row++;
            for($c=0;$c<$num;$c++){
                echo $data[$c]."<br/>\n";
            }
        }

        fclose($handle);
    }
    

 ?>