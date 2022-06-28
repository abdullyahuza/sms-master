<?php
session_start();
//error_reporting();
include '../config/db.php';
include '../functions.php';
if(isset($_SESSION['user_name']) && isAdmin($connection, $_SESSION['user_name'])){

    $msg="";

    if (isset($_POST['done'])) {

        $session=$_POST['session'];

        if(!itExist($connection, 'session', 'session', $session)){
            $sql1 = mysqli_query($connection,"INSERT INTO session(session) VALUES('$session')");  
            if($sql1){
               //create session table
               $session = str_replace('/','_',$session);
               $session = "sesh".$session;
               $sessionTable = "CREATE TABLE $session (
               `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
               `session` VARCHAR(20) NOT NULL,
               `subject_code` VARCHAR(15) NOT NULL,
               `subject_name` VARCHAR(50) NOT NULL,
               `class` VARCHAR(50) NOT NULL,
               `term` INT(10) NOT NULL,
               `adNo` VARCHAR(20) NOT NULL,
               `ca1` INT(5),
               `ca2` INT(5),
               `exams` INT(5),
               `total` INT(5),
               FOREIGN KEY (session) REFERENCES session(session),
               FOREIGN KEY (term) REFERENCES tbl_term(term_id),
               FOREIGN KEY (adNo) REFERENCES tbl_student(adNo) ON DELETE CASCADE,
               FOREIGN KEY (subject_code) REFERENCES tbl_subject(subject_code) ON DELETE CASCADE,
               CONSTRAINT  UNIQUE INDEX unique_index (adno,subject_code,class,session,term)
               );";
               
               if (mysqli_query($connection, $sessionTable)) {
                   $msg="<p id='msg' class='alert alert-success'>Session Added.</p>";
               }

            }else{
               $msg="<p class='alert alert-danger'>Something went wrong</p>";
            }
        }
        else{
            $msg="<p class='alert alert-danger'>Already exist</p>";
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
                        <h4 class="page-title">Sessions Panel</h4>
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
                                <h5 class="card-title">Add Session</h5>
                                <?php echo $msg; ?>                                  
                                <form class="form-horizontal" action="" method="post">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="session" id="session"
                                                placeholder="Session Here" required>
                                        </div>
                                    </div>

                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" name="done" class="btn btn-primary btn-block">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>    
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-sm-8" style="margin: 0 auto;">
                       <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Sessions Overview</h5>
                                <div class="table-responsive">
                                    <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm" >
                                                <table id="zero_config" class="table table-striped table-bordered dataTable">
                                                    <thead>
                                                        <tr role="row">
                                                            <th width="1%">SN</th>
                                                            <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" width="10%">Session</th>
                                                            <th width="1%">Session Info</th>
                                                            <th width="1%">Delete</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    require_once('../config/db.php');
                                                    $sql = mysqli_query($connection,"SELECT session FROM session" );
                                                    $i=1;
                                                    while ($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
                                                    ?>
                                                        <tr role="row" class="odd">
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row["session"]; ?></td>      
                                                            <td>
                                                                <center>
                                                                    <a href="" class="btn btn-info btn-sm">
                                                                        Info
                                                                    </a>
                                                                </center>
                                                            </td> 
                                                            <td>
                                                                <center>
                                                                    <a href="delete_session.php?session=<?php echo $row['session']; ?>" class="btn btn-danger btn-sm">
                                                                        Delete
                                                                    </a>
                                                                </center>
                                                            </td>      
                                                        </tr>
                                                    <?php 
                                                    $i++;
                                                    } 
                                                    ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>SN</th>
                                                            <th>Session</th>
                                                            <th>Session Info</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
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