<?php
session_start();
//error_reporting();
include '../config/db.php';
include '../functions.php';
if(isset($_SESSION['staff_username'])){
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>SMS Master</title>
    <link href="../assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <link href="../dist/css/datatables.min.css" rel="stylesheet">
    <link href="../dist/css/custom.css" rel="stylesheet">
</head>

<body>
    <!-- preloader -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <!-- main -->
    <div id="main-wrapper">
        <?php include './includes/staff_nav.php'; ?>
        <!-- Sidebar -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <?php include './includes/staff_sidebar.php'; ?>
            </div>
        </aside>
        
        <!-- Main Dashboard -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Student's Scores</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-md-10" style="margin: 0 auto;">
                        <div class="card">
                            <div class="card-body">
                            <?php 
                            require_once('../config/db.php');
                            $adNo=$_GET["adNo"];
                            $query = mysqli_query($connection, "SELECT * FROM tbl_student WHERE adNo='$adNo'");
                            $rowCount = mysqli_num_rows($query);
                            if($rowCount < 1){
                                echo "<script>alert('Invalid Student');</script>";
                                echo "<script>window.location.href='student_panel.php'</script>";
                            }
                            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                              $firstname=$row["fName"];
                              $middlename=$row["mName"];
                              $lastname=$row["lName"];
                              
                            } 
                                
                            ?>
                                <table class="table table-striped table-bordered dataTable">
                                    <form action="./pdf/" method="GET">
                                    <thead>
                                        <tr role="row">
                                            <th colspan="4">
                                                <center><b><?php echo $adNo;?> Scores</b></center>
                                                <input type="text" name="adNo" id="adNo" value="<?php echo $adNo; ?>" hidden>
                                                <input type="text" name="class" id="class" value="<?php echo $_GET['class']; ?>" hidden>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="10%">Name</td>
                                            <td width="35%"><?php echo $firstname." ".$middlename." ".$lastname; ?></td>
                                            <td width="30%">
                                                <select name="session" style="width: 90%;" id="session" required>
                                                    <option value="">Select session</option>
                                                    <?php 
                                                    $query = mysqli_query($connection, "SELECT session FROM session");
                                                    
                                                    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                    ?>
                                                    <option value="<?php echo $row['session']; ?>">
                                                      <?php echo $row['session']; ?></option>
                                                    <?php
                                                    } //while ends here                                                            
                                                    ?>
                                                </select>
                                            </td>
                                            <td width="30%">
                                                <select name="term" style="width: 100%;" id="term" required>
                                                    <option value="">Select term</option>
                                                    <?php 
                                                    $query = mysqli_query($connection, "SELECT * FROM tbl_term");
                                                    
                                                    while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                    ?>
                                                    <option value="<?php echo $row['term_id']; ?>">
                                                      <?php echo $row['term']; ?></option>
                                                    <?php
                                                    } //while ends here                                                            
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <th>SN</th>
                                                    <th>Subject code</th>
                                                    <th>Name</th>
                                                    <th>CA1</th>
                                                    <th>CA2</th>
                                                    <th>Exams</th>
                                                    <th>Total</th>
                                                </thead>
                                                <tbody id="scores">
                                                                     
                                                </tbody>
                                            </table>
                                        </tr>

                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">
                                                <center>
                                                    <button type="submit" name="print_result" class="btn btn-success btn-sm" disabled>
                                                        Print Result
                                                    </button>
                                                </center>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </form>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- fluid container -->
        </div>  
    </div>
    <script type="text/javascript" src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          var adNo = $('#adNo').val();
          var cClass = $('#class').val();
          $('#session').change(function(){
            var session = $(this).val();
            $('#term').change(function(){
              var term = $(this).val();
              if(session != '' && term != ''){
                  $.ajax({
                      url:"get_result.php",
                      method:"POST",
                      data:{class:cClass,term:term,session:session,adNo:adNo},
                      success:function(data){
                          // alert(term);
                           $('#scores').html(data);
                      }
                 });
              }
            });
          });
          

        });
    </script>
    <?php include '../includes/footer.php'; ?>
    <?php
    }else{
        header("Location: ../error/403.php");
    }
    ?>