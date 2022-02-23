<?php
session_start();
//error_reporting();
include '../config/db.php';
include '../functions.php';

if(isset($_SESSION['staff_username'])){

    $msg="";

    if (isset($_POST['savePass'])) {

        $staff = $_SESSION['staff_username'];
        $cPass=$_POST['cPassword'];
        $nPass=$_POST['nPassword'];
        $cNPass=$_POST['cNPassword'];

        $dbPass = un_hash($cPass, getPassword($connection, $staff));
    
         // if(!$sql1){
         //    $msg="<p class='alert alert-danger'>Something went wrong</p>";
         // }else{
         //    $msg="<p class='alert alert-success'>Subject Added.</p>";
         // }

        //check db pass with inputed password
        if($dbPass == $cPass){
            //check new password
            if($nPass != ''){
                //check confirm new password
                if($cNPass != ''){
                    //check if they are the same
                    if($nPass == $cNPass){
                        //change the password
                        $hashedPass = make_hash($nPass);
                        $sql = "UPDATE tbl_teacher SET password='$hashedPass' WHERE staff_username='$staff'";
                        if(mysqli_query($connection, $sql)){
                            $msg="<p class='alert alert-success'>Password Changed successfully.</p>";
                        }
                        else{
                            $msg="<p class='alert alert-danger'>Something went wrong.</p>";    
                        }
                    }
                    else{
                        $msg="<p class='alert alert-danger'>New & Confirm Password must match.</p>";    
                    }
                }
                else{
                    $msg="<p class='alert alert-danger'>Confirm New password cannot be empty.</p>";    
                }
            }
            else{
                $msg="<p class='alert alert-danger'>New password cannot be empty.</p>";    
            }

        }
        else{
            $msg="<p class='alert alert-danger'>Current password is incorrect.</p>";
        }

    }
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
                        <h4 class="page-title">Change Password</h4>
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
                    <div class="col-sm-6" style="margin: 0 auto;">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Change Password</h5>
                                <?php echo $msg; ?>                                  
                                <form class="form-horizontal" action="" method="post">
                                <div class="card-body">

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="password" class="form-control" name="cPassword" id="cPassword"
                                                placeholder="Current Password" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="password" class="form-control" name="nPassword" id="nPassword"
                                                placeholder="New Password" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="password" class="form-control" name="cNPassword" id="cNPassword"
                                                placeholder="Confirm New Password" required>
                                        </div>
                                    </div>

                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" name="savePass" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>    
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

            </div><!-- fluid end -->
        </div>  
    </div>
    <footer class="footer text-center">
        <center>
            All Rights Reserved <a target="_blank" href="https://abdullyahuza.github.io">Abdull Yahuza</a>.
            <span style="float:right;">SMS Master Version 1.0.0 </span>
        </center>
    </footer>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
        <!--Wave Effects -->
        <script src="../dist/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="../dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="../dist/js/custom.min.js"></script>
        <!-- this page js -->
        <script src="../assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
        <script src="../assets/extra-libs/multicheck/jquery.multicheck.js"></script>
        <script src="../assets/extra-libs/DataTables/datatables.min.js"></script>
        <script>
            /****************************************
             *       Basic Table                   *
             ****************************************/
            $('#zero_config').DataTable();
        </script>

    </body>

</html>
    <?php
    }else{
        header("Location: ../error/403.php");
    }
    ?>