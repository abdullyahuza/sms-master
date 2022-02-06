<?php
session_start();
//error_reporting();
include '../config/db.php';
include '../functions.php';
if(isset($_SESSION['user_name']) && isAdmin($connection, $_SESSION['user_name'])){
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
                        <h4 class="page-title">Dashboard</h4>
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
                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                               <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                               <h6 class="text-white">
                                    <a href="student_panel.php" style="color: white;">Students</a>
                                </h6>
                            </div>
                            <div class="panel-footer no-boder bg-color-blue">
                                <h3 class=" text-center" style="color: #39C;" >
                                    <?php 
                                    include('../config/db.php');
                                    $sql="SELECT COUNT(*) AS total FROM tbl_student WHERE adNo IS NOT NULL";
                                    $result = mysqli_query($connection,$sql);
                                    $count=mysqli_fetch_assoc($result);
                                    $count = intval($count['total']);
                                    echo $count;
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                                <h6 class="text-white"><a href="teacher_panel.php" style="color: white;">Teachers</a></h6>
                            </div>
                            <div class="panel-footer no-boder bg-color-blue">
                                <h3 class=" text-center" style="color: #39C;" >
                                    <?php 
                                    $sql="SELECT COUNT(*) AS total FROM tbl_teacher WHERE staff_username IS NOT NULL";
                                    $result = mysqli_query($connection,$sql);
                                    $count=mysqli_fetch_assoc($result);
                                    $count = intval($count['total']);
                                    echo $count;
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                               <h1 class="font-light text-white"><i class="fas fa-table"></i></h1>
                               <h6 class="text-white">
                                    <a href="all_subjects.php" style="color: white;">Subjects</a>
                                </h6>
                            </div>
                            <div class="panel-footer no-boder bg-color-blue">
                                <h3 class=" text-center" style="color: #39C;" >
                                    <?php 
                                    include('../config/db.php');
                                    $sql="SELECT COUNT(*) AS total FROM tbl_subject WHERE subject_code IS NOT NULL";
                                    $result = mysqli_query($connection,$sql);
                                    $count=mysqli_fetch_assoc($result);
                                    $count = intval($count['total']);
                                    echo $count;
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white"><i class="fas fa-university"></i></h1>
                                <h6 class="text-white"><a href="all_classes.php" style="color: white;">Classes</a></h6>
                            </div>
                            <div class="panel-footer no-boder bg-color-blue">
                                <h3 class=" text-center" style="color: #39C;" >
                                    <?php 
                                    $sql="SELECT COUNT(*) AS total FROM tbl_class WHERE class_name IS NOT NULL";
                                    $result = mysqli_query($connection,$sql);
                                    $count=mysqli_fetch_assoc($result);
                                    $count = intval($count['total']);
                                    echo $count;
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!-- Column -->
                    <div class="col-md-6 col-lg-2 col-xlg-3">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white"><i class="fas fa-moon"></i></h1>
                                <h6 class="text-white"><a href="all_sessions.php" style="color: white;">Sessions</a></h6>
                            </div>
                            <div class="panel-footer no-boder bg-color-blue">
                                <h3 class=" text-center" style="color: #39C;" >
                                    <?php 
                                    $sql="SELECT COUNT(*) AS total FROM session WHERE session IS NOT NULL";
                                    $result = mysqli_query($connection,$sql);
                                    $count=mysqli_fetch_assoc($result);
                                    $count = intval($count['total']);
                                    echo $count;
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>    
    </div>

    <?php include './includes/footer.php'; ?>
<?php
}else{
    header("Location: ../error/403.php");
}
?>