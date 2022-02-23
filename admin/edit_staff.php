<?php
session_start();
//error_reporting();
include '../config/db.php';
include '../functions.php';
if(isset($_SESSION['user_name']) && isAdmin($connection, $_SESSION['user_name'])){
?>
<?php 
require_once('../config/db.php');
$staff=$_GET["staff_username"];
$query = mysqli_query($connection, "SELECT * FROM tbl_teacher WHERE staff_username='$staff'");
$rowCount = mysqli_num_rows($query);
if($rowCount < 1){
    echo "<script>alert('Invalid Staff');</script>";
    echo "<script>window.location.href='teacher_panel.php'</script>";
}
while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
  $firstname=$row["fName"];
  $middlename=$row["mName"];
  $lastname=$row["lName"];
  $gender=$row["gender"];
  $dob=$row["dob"];
  $phone=$row["phone"];
  $email=$row["email"];
  $address=$row["address"];
  $class=$row["class"];
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
                        <h4 class="page-title">Edit Staff's Profile</h4>
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
                <center>
                    <a href="./view_teacher.php?staff_username=<?php echo $staff;?>">
                        <h1><?php echo $staff; ?></h1>
                    </a>
                </center>
                <div class="row">
                    <div class="col-md-8" style="margin: 0 auto;">
                        <div class="card">
                            <form class="form-horizontal" action="process_edit_staff.php" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Student Info</h4>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3">Passport</label>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="file" name="passport" class="form-control" accept=".jpg,.png,.jpeg">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-end control-label col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="fname" id="fname" 
                                            value="<?php echo $firstname; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="mname" class="col-sm-3 text-end control-label col-form-label">Middle Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="mname" id="mname" 
                                            value="<?php echo $middlename; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lname" class="col-sm-3 text-end control-label col-form-label">Last
                                            Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="lname" id="lname" 
                                            value="<?php echo $lastname; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3">Staff Gender</label>
                                        <div class="col-md-9">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input"
                                                    id="customControlValidation1" 
                                                    name="gender" 
                                                    value="male"
                                                    <?php if(strtolower($gender)=="male") echo "checked"; ?>
                                                    required>
                                                <label class="form-check-label mb-0" for="customControlValidation1">Male</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input"
                                                    id="customControlValidation2"
                                                    name="gender" 
                                                    value="female"
                                                    <?php if(strtolower($gender)=="female") echo "checked"; ?>
                                                    required>
                                                <label class="form-check-label mb-0" for="customControlValidation2">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        
                                        <label for="dob" class="col-sm-3 text-end control-label col-form-label">Date of Birth <small class="text-muted">dd/mm/yyyy</small></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control date-inputmask" name="dob" id="dob" 
                                            value="<?php echo $dob; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3 text-end control-label col-form-label">Phone No.</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="phone" id="phone" 
                                            value="<?php echo $phone; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 text-end control-label col-form-label">Email Address</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="email" id="email" 
                                            value="<?php echo $email; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-end control-label col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="address"><?php echo $address; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="class" class="col-sm-3 text-end control-label col-form-label">Class</label>
                                        <div class="col-sm-9">
                                              <select name="class" style="width: 70%;" id="class" required>
                                                <option value="">Select class</option>
                                                <?php 
                                                $query = mysqli_query($connection, "SELECT class_name FROM tbl_class");
                                                
                                                while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                ?>
                                                <option value="<?php echo $row['class_name']; ?>" 
                                                    <?php if($class == $row['class_name']) echo "selected"; ?> >
                                                    <?php echo $row['class_name']; ?></option>
                                                <?php
                                                } //while ends here                                                            
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 text-end control-label col-form-label">Reset Password</label>
                                        <div class="col-sm-9">
                                            <a href="reset_password.php?staff_username=<?php echo $_GET['staff_username']; ?>"><h5>Reset</h5></a>
                                        </div>
                                    </div>

                                </div>
                                <input type="text" name="staff_username" value="<?php echo $_GET['staff_username']; ?>" hidden />
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" name="update_staff" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </div>
                            </form>
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