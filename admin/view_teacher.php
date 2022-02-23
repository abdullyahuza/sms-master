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
                        <h4 class="page-title">Staff's Profile</h4>
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
                            $staff_username=$_GET["staff_username"];
                            $query = mysqli_query($connection, "SELECT * FROM tbl_teacher WHERE staff_username='$staff_username'");
                            $rowCount = mysqli_num_rows($query);
                            if($rowCount < 1){
                                echo "<script>alert('Invalid Staff');</script>";
                                echo "<script>window.location.href='teacher_panel.php'</script>";
                            }
                            while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                              $firstname=$row["fName"];
                              $middlename=$row["mName"];
                              $lastname=$row["lName"];
                              $phone=$row["phone"];
                              $email=$row["email"];
                              $address=$row["address"];
                              $gender=$row["gender"];
                              $dob=$row["dob"];
                              $class=$row["class"];
                              $passport = '';
                            } 
                                if(checkStaffPassport($staff_username,'../images/staff/') != FALSE){
                                    $passport = checkPassport($staff_username,'../images/staff/');
                                }else{
                                    $passport = 'icon.png';
                                }
                            ?>
                                <center>
                                    <div>
                                        <img class="profileImage" src="../images/staff/<?php echo $passport; ?>" alt="No Passport">
                                    </div>
                                </center>
                                <br>
                                <table class="table table-striped table-bordered dataTable">
                                    <thead>
                                        <tr role="row">
                                            <th colspan="2">
                                                <center><?php echo $staff_username;?> Information</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="15%">Firstname</td>
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
                                            <td>Phone</td>
                                            <td><?php echo $phone; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Email</td>
                                            <td style="font-size: 0.7rem;"><?php echo $email; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Address</td>
                                            <td><?php echo $address; ?></td>
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
                                            <td>Class</td>
                                            <td><?php echo $class; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Taking</td>
                                            <td>
                                                <?php
                                                $staff_username = $_GET['staff_username'];
                                                $query = mysqli_query($connection, "SELECT * FROM tbl_subject WHERE staff_username='$staff_username'");
                                                $taking = array();
                                                while($r = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                 array_push($taking, $r['subject_code']);
                                                }
                                                echo implode(', ', $taking);
                                                ?>    
                                            </td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>
                                                <center>
                                                    <a href="edit_staff.php?staff_username=<?php echo $staff_username; ?>" class="btn btn-success btn-xs">
                                                        update Staff
                                                    </a>
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="delete_staff.php?staff_username=<?php echo $staff_username; ?>" class="btn btn-danger btn-xs">
                                                        Delete staff
                                                    </a>
                                                </center>
                                            </td>
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