<?php
session_start();
//error_reporting();
include '../config/db.php';
include '../functions.php';
if(isset($_SESSION['user_name']) && isAdmin($connection, $_SESSION['user_name'])){
?>

<?php $msg=""; include './includes/head.php'; ?>
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
                        <h4 class="page-title">Upload Students</h4>
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
                    <div class="col-md-6" style="margin: 0 auto;">
                        <div class="card" style="height:250px;">
                            <div class="card-header text-light text-center" style="background-color: #1F262D; font-size: 18px;">
                                <span class="fa fa-user"></span> Add Student(s)</div>
                           <div class="card-body">
                               <h5 class="card-title">Select an excel file to upload</h5>
                               <form action="process_students.php" method="post" role="form" enctype="multipart/form-data">
                                       <div class="col-md-9">
                                           <div class="row  ">
                                             <div class="form-group col-md-9 offset-sm-4">
                                               <input type="file" name="students_file" id="students_file" required class="form-control" required accept=".csv,xlsx">
                                             </div>
                                            <?php echo $msg; ?> 
                                           </div>
                                       </div>
                                       <br>
                                       <div class="border-top">
                                           <div class="card-body">
                                               <button type="submit" name="upload_students" class="btn btn-default btn-block">Submit</button>
                                           </div>
                                       </div>
                               </form>
                           </div>
                       </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8" style="margin: 0 auto;">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Important!</strong></h5>
                                <p>
                                    Carefully look at the CSV file and make sure there is no any error(s), errors such:
                                    <ul>
                                        <li>Typo's</li>
                                        <li>Spaces - not allowed, before and after any value.</li>
                                    </ul>
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div><!-- fluid ends here -->

        </div>  
    </div>

    <?php include './includes/footer.php'; ?>
    <?php
    }else{
        header("Location: ../error/403.php");
    }
    ?>