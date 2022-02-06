<?php
session_start();
//error_reporting();
include '../config/db.php';
include '../functions.php';
if(isset($_SESSION['user_name']) && isAdmin($connection, $_SESSION['user_name'])){

    $msg="";

    if (isset($_POST['done'])) {
    $code = $_POST['subject'];
    $class=$_POST['class'];
    $teacher=$_POST['teacher'];
    $term=$_POST['term'];  
    $session=$_POST['session'];
    
    // subject code: first 3 letters of subject name + first letter of class + first letter of term - session 
    $ccode = substr(trim($class),0,1).substr(trim($class),-1);
    $tcode = substr(trim($term),0,1);
    $code = strtoupper($code.$ccode.$tcode);

    $sql = "INSERT INTO `tbl_subject` (`class`, `subject_code`, `staff_username`, `term`, `session`) 
        VALUES ('$class', '$code', '$teacher', '$term', '$session');";

    $query = mysqli_query($connection,$sql);  
     
     if($query){
        $msg="<p class='alert alert-success'>Subject Added.</p>";
     }else{
        $msg="<p class='alert alert-danger'>Something is wrong</p>";
     }
    }
?>

<?php include './includes/head.php'; ?>
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
        <?php include './includes/nav.php'; ?>
        <!-- Sidebar -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <div class="scroll-sidebar">
                <?php include'admin_sidebar.php'; ?>
            </div>
        </aside>
        
        <!-- Main Dashboard -->
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Subjects Panel</h4>
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
                <!-- row -->
                <div class="row">
                    <div class="col-lg-10" style="margin:0 auto;">
                        <div class="card">
                            <div class="card-header"><span class="fa fa-pen"></span>Create Subjects</div>
                            <div class="card-body">
                                <div class="table-responsive" style="margin:0 auto;">
                                    <table class="table table-bordered" style="font-size: 14px;">
                                        <thead>
                                            <tr style="background-color: #eee;">
                                              <th>Subject</th>
                                              <th>Class</th>
                                              <th>Term</th>
                                              <th>Session</th>
                                              <th>Teacher</th>
                                              <th>Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                  <td>
                                                      <select name="subject" class="" style="width: 90px;" required>
                                                        <option value="">Select Subject</option>
                                                        <?php 
                                                        $query = mysqli_query($connection, "SELECT * FROM add_subject ORDER BY subject_name");
                                                        
                                                        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                                  $subject_name=$row["subject_name"];
                                                        ?>
                                                        <option value="<?php echo $row['code']; ?>"><?php echo $row['subject_name']; ?></option>
                                                        <?php
                                                        } //while ends here                                                            
                                                        ?>
                                                    </select>
                                                  </td>

                                                  <td>
                                                      <select name="class" class="" style="width: 90px;" required>
                                                        <option value="">Select Class</option>
                                                        <?php 
                                                        $query = mysqli_query($connection, "SELECT * FROM tbl_class");
                                                        
                                                        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                                  $class_name=$row["class_name"];
                                                        ?>
                                                        <option value="<?php echo $row['class_name']; ?>"><?php echo $row['class_name']; ?></option>
                                                        <?php
                                                        } //while ends here                                                            
                                                        ?>
                                                    </select>
                                                  </td>

                                                  <td>
                                                      <select name="term" class="" style="width: 90px;" required>
                                                        <option value="">Select Class</option>
                                                        <?php 
                                                        $query = mysqli_query($connection, "SELECT * FROM tbl_term");
                                                        
                                                        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                                  $term=$row["term"];
                                                        ?>
                                                        <option value="<?php echo $row['term']; ?>"><?php echo $row['term']; ?></option>
                                                        <?php
                                                        } //while ends here                                                            
                                                        ?>
                                                  </td>

                                                  <td>
                                                      <select name="session" class="" style="width: 90px;" required>
                                                        <option value="">Select Class</option>
                                                        <?php 
                                                        $query = mysqli_query($connection, "SELECT * FROM session");
                                                        
                                                        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                            $session = $row["session"];
                                                        ?>
                                                        <option value="<?php echo $row['session']; ?>"><?php echo $row['session']; ?></option>
                                                        <?php
                                                        } //while ends here                                                            
                                                        ?>
                                                  </td>

                                                  <td>
                                                      <select name="teacher" class="" style="width: 90px;" required>
                                                        <option value="">Select Class</option>
                                                        <?php 
                                                        $query = mysqli_query($connection, "SELECT * FROM tbl_teacher ORDER BY fName");
                                                        
                                                        while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                            $teacher = $row["name"];
                                                        ?>
                                                        <option value="<?php echo $row['staff_username']; ?>">
                                                            <?php echo $row['fName']." ".$row['lName'];?>
                                                                
                                                            </option>
                                                        <?php
                                                        } //while ends here                                                            
                                                        ?>
                                                  </td>
                                                  <td>
                                                      <button type="submit" name="done" class="btn btn-info btn-sm">
                                                          Add Subject
                                                      </button>
                                                  </td>
                                              </form>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php echo $msg; ?>
                        </div>
                    </div>
                </div><!-- create subject ends here -->

                <div class="row">
                    <div class="col-sm-8" style="margin: 0 auto;">
                       <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Subjects Overview</h5>
                                <div class="table-responsive">
                                    <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="zero_config" class="table table-striped table-bordered dataTable">
                                                    <thead>
                                                        <tr role="row">
                                                            <th width="10%;">SN</th>
                                                            <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" width="15%">Subject Code</th>
                                                            <th width="15%">Class</th>
                                                            <th width="15%">Session</th>
                                                            <th width="15%">View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    require_once('../config/db.php');
                                                    $sql = mysqli_query($connection,"SELECT subject_code,class,session FROM tbl_subject" );
                                                    $i=1;
                                                    while ($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
                                                    ?>
                                                        <tr role="row" class="odd">
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row["subject_code"]; ?></td>
                                                            <td><?php echo $row["class"]; ?></td>
                                                            <td><?php echo $row["session"]; ?></td>
                                                            <td>
                                                                <center>
                                                                    <a href="view_subjects.php?code=<?php echo $row["subject_code"]; ?>" class="btn btn-info btn-xs">View</a>
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
                                                            <th rowspan="1" colspan="1">SN</th>
                                                            <th rowspan="1" colspan="1">Subject Code</th>
                                                            <th rowspan="1" colspan="1">Class</th>
                                                            <th rowspan="1" colspan="1">Sesion</th>
                                                            <th rowspan="1" colspan="1">View</th>
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