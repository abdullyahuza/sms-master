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
                        <h4 class="page-title">Class Result</h4>
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
                            $class=$_GET["class"];
                            $query = mysqli_query($connection, "SELECT * FROM tbl_class WHERE class_name='$class'");
                            $rowCount = mysqli_num_rows($query);
                            if($rowCount < 1){
                                echo "<script>alert('Invalid Student');</script>";
                                echo "<script>window.location.href='student_panel.php'</script>";
                            } 
                                
                            ?>
                                <table class="table table-striped table-bordered dataTable">
                                    <form action="./pdf/class.php" method="GET">
                                    <thead>
                                        <tr role="row">
                                            <th colspan="4">
                                                <center><h3><?php echo $_GET['class'];?> Result</h3></center>
                                                <input type="text" name="class" id="class" value="<?php echo $_GET['class']; ?>" hidden>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="30%">
                                                <select name="session" style="width: 60%;" id="session" required>
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
                                                <select name="term" style="width: 70%;" id="term" required>
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
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3">
                                                <center>
                                                    <button type="submit" name="print_entire" class="btn btn-success btn-sm">
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
    <?php include '../includes/footer.php'; ?>
    <?php
    }else{
        header("Location: ../error/403.php");
    }
    ?>