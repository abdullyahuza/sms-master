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
                        <h4 class="page-title">Subject's Info</h4>
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

                <div class="row">
                    <div class="col-sm-10" style="margin: 0 auto;">
                       <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $_GET['code']; ?> Overview</h5>
                                <div class="table-responsive">
                                    <div id="zero_config_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm" >
                                                <table id="zero_config" class="table table-striped table-bordered dataTable">
                                                    <thead>
                                                        <tr role="row">
                                                            <th width="10%">SN</th>
                                                            <th class="sorting_asc" tabindex="0" aria-controls="zero_config" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" width="15%">Subject Code</th>
                                                            <th width="15%">Class</th>
                                                            <th width="10%">Term</th>
                                                            <th width="10%">Session</th>
                                                            <th width="10%">Teacher</th>
                                                            <th width="10%">Delete</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                    require_once('../config/db.php');
                                                    $code = $_GET['code'];
                                                    $sql = mysqli_query($connection,"SELECT * FROM tbl_subject WHERE subject_code LIKE '$code%'" );
                                                    $i=1;
                                                    while ($row=mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
                                                    ?>
                                                        <tr role="row" class="odd">
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $row["subject_code"]; ?></td>      
                                                            <td><?php echo $row["class"]; ?></td>      
                                                            <td><?php echo $row["term"]; ?></td>      
                                                            <td><?php echo $row["session"]; ?></td>      
                                                            <td><?php echo $row["staff_username"]; ?></td>      
                                                            <td>
                                                                <center>
                                                                    <a href="delete_subject_code.php?code=<?php echo $row["subject_code"]; ?>" class="btn btn-danger btn-sm">
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
                                                            <th>Subject Code</th>
                                                            <th>Class</th>
                                                            <th>Term</th>
                                                            <th>Session</th>
                                                            <th>Teacher</th>
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
            </div><!-- fluid container -->
        </div>  
    </div>

    <?php include '../includes/footer.php'; ?>
    <?php
    }else{
        header("Location: ../error/403.php");
    }
    ?>