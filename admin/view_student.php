<?php
session_start();
//error_reporting();
include '../config/db.php';
include '../functions.php';
if(isset($_SESSION['user_name']) && isAdmin($connection, $_SESSION['user_name'])){
?>

<?php include '../includes/head.php'; ?>
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
        <?php include './includes/admin-nav.php'; ?>
        <!-- Sidebar -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <?php include './includes/admin_sidebar.php'; ?>
            </div>
        </aside>
        
        <!-- Main Dashboard -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Student's Profile</h4>
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
                              $gender=$row["gender"];
                              $dob=$row["dob"];
                              $gname=$row["gName"];
                              $moname=$row["mothersName"];
                              $grelation=$row["gRelation"];
                              $gphone=$row["gPhone"];
                              $cadmitted=$row["cAdmitted"];
                              $cclass=$row["cClass"];
                              $yadmitted=$row["yAdmitted"];
                              $address=$row["address"];
                              $passport = '';
                            } 
                                if(checkPassport($adNo,'../images/passports/') != FALSE){
                                    $passport = checkPassport($adNo,'../images/passports/');
                                }else{
                                    $passport = 'icon.png';
                                }
                            ?>
                                <center>
                                    <div>
                                        <img style="background-color: white;" class="profileImage" src="../images/passports/<?php echo $passport; ?>" alt="No Passport">
                                    </div>
                                </center>
                                <br>
                                <table class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr role="row">
                                            <th colspan="2">
                                                <center><?php echo $adNo;?> Information</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="10%">Firstname</td>
                                            <td><?php echo $firstname; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Middlename</td>
                                            <td><?php echo $middlename; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Surname</td>
                                            <td><?php echo $lastname; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Gender</td>
                                            <td><?php echo $gender; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Date of Birth</td>
                                            <td><?php echo $dob; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Guardian</td>
                                            <td><?php echo $gname ?></td>
                                        </tr>

                                        <tr>
                                            <td>Guardian relation</td>
                                            <td><?php echo $grelation; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Guardian Phone</td>
                                            <td><?php echo $gphone; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Mother's name</td>
                                            <td><?php echo $moname; ?></td>
                                        </tr>


                                        <tr>
                                            <td>Class Admitted</td>
                                            <td><?php echo $cadmitted; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Current Class</td>
                                            <td><?php echo $cclass; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Year Admitted</td>
                                            <td><?php echo $yadmitted; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Address</td>
                                            <td style="font-size:0.7rem;"><?php echo $address; ?></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>
                                                <center>
                                                    <a href="edit_student.php?adNo=<?php echo $adNo; ?>" class="btn btn-success btn-xs">
                                                        Edit this student
                                                    </a>
                                                </center>
                                            </th>

                                            <th>
                                                <center>
                                                    <a href="delete_student.php?adNo=<?php echo $adNo; ?>" class="btn btn-danger btn-xs">
                                                        Delete this student
                                                    </a>
                                                </center>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- fluid container -->
        </div>  
    </div>

    <?php include '../includes/footer.php'; ?>
    <?php
    }else{
        header("Location: ../error/403.php");
    }
    ?>