<?php
session_start();
//error_reporting();
include '../config/db.php';
include '../functions.php';
if(isset($_SESSION['user_name']) && isAdmin($connection, $_SESSION['user_name'])){

    $msg="";

    if (isset($_POST['Admit'])) {

    $year = date('Y');
    $adNo = genAdno($connection, $year);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $class = $_POST['class'];

    $sql= "INSERT INTO tbl_student(adNo,fName,lName,cAdmitted,cClass,yAdmitted) 
            VALUES('$adNo','$fname','$lname','$class','$class','$year')";
       
     if(mysqli_query($connection,$sql)){
        
        $msg="<p id='msg' class='alert alert-success'>Admission Successful.</p>";

     }else{
        $msg="<p class='alert alert-danger'>Something went wrong</p>";
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
                        <h4 class="page-title">Admission</h4>
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
                    <div class="col-md-6" style="margin: 0 auto;">
                        <div class="card">
                            <form class="form-horizontal" action="" method="post">
                                <div class="card-body">
                                    <h5 class="card-title"><strong>Generate Admission Number</strong></h5>
                                    <?php echo $msg; ?>
                                    <!-- <br/> -->
                                    <center><b>Admission No.: <span id='adNo'></span></b></center>
                                    <br/>
                                    
                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name Here">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-end control-label col-form-label">Last
                                            Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name Here">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="class" class="col-sm-3 text-end control-label col-form-label">Class</label>
                                        <div class="col-sm-9">
                                              <select name="class" style="width: 100%;" id="class" required>
                                                <option value="">Select class</option>
                                                <?php 
                                                $query = mysqli_query($connection, "SELECT class_name FROM tbl_class");
                                                
                                                while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                ?>
                                                <option value="<?php echo $row['class_name']; ?>">
                                                    <?php echo $row['class_name']; ?>        
                                                </option>
                                                <?php
                                                } //while ends here                                                            
                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="border-top">
                                        <div class="card-body">
                                            <button id='Generate' class="btn btn-info btn-sm text-white">Generate</button>
                                            <button type="submit" name="Admit" class="btn btn-success btn-sm" style="float: right;">Admit</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>       
                </div>

                
            </div><!-- fluid ends here -->

        </div>  
    </div>
    <script type="text/javascript" src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#Generate').on('click',function(e){
                e.preventDefault();
                $.ajax({
                    url:"generate_adNo.php",
                    method:"post",
                    success:function(data){
                        console.log(data);
                        $('#adNo').html(data);
                    }
                });
            })
        });
    </script>
    <?php include '../includes/footer.php'; ?>
    <?php
    }else{
        header("Location: ../error/403.php");
    }
    ?>