<?php
session_start();
//error_reporting();
include '../config/db.php';
include '../functions.php';
if(isset($_SESSION['staff_username'])){
?>
<?php $msg=''; ?>
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
                        <h4 class="page-title">Upload Panel</h4>
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
                    <div class="col-md-8" style="margin: 0 auto;">
                        <div class="card">
                            <form class="form-horizontal" action="process_upload_result.php" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Upload Result</h4>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-3">CSV file</label>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="file" name="result" class="form-control" accept=".csv" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive" style="margin:0 auto;">
                                        <table class="table table-bordered" style="font-size: 14px;">
                                            <thead>
                                                <tr style="background-color: #eee;">
                                                  <th width="30%">Class</th>
                                                  <th width="30%">Session</th>
                                                  <th width="30%">Subject Code</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="class" style="width: 70%;" id="class" required>
                                                          <?php 
                                                          
                                                          $staff = $_SESSION['staff_username'];
                                                          $class = getClass($connection, $staff);

                                                          $query = mysqli_query($connection, "SELECT class_name FROM tbl_class WHERE class_name='$class'");
                                                          
                                                          while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
                                                          ?>
                                                          <option value="<?php echo $row['class_name']; ?>" selected>
                                                            <?php echo $row['class_name']; ?></option>
                                                          <?php
                                                          } //while ends here                                                            
                                                          ?>
                                                      </select>
                                                    </td>
                                                    
                                                    <td>
                                                        <select name="session" style="width: 70%;" id="session" required>
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

                                                    <td>
                                                        <select name="code" style="width: 70%;" id="code" required>
                                                          
                                                        </select>
                                                    </td>


                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>  

                                    <div class="border-top">
                                        <div class="card-body">
                                            <button type="submit" name="upload_result" class="btn btn-primary btn-block">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php echo $msg; ?>
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
                                        <li>Typo's - One error may lead to upload failure.</li>
                                        <li>Spaces - not allowed, before and after any value.</li>
                                    </ul>
                                </p>
                                <p>
                                    For the upload to be successful:
                                    <ul>
                                        <li> select the subject code base on class subject.</li>
                                        <li>And last select the session.</li>
                                        <li>Term is selected base on subject code.</li>
                                    </ul>
                                </p>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div><!--  -->
        </div>  
    </div>
    <script type="text/javascript" src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function(){
                
            var sclass = $('#class').val();
            $('#session').change(function(){
                var ssession = $(this).val();
                if(sclass != '' && ssession != ''){
                  //get the subjects
                  $.ajax({
                      url:"get_subjects.php",
                      method:"POST",
                      data:{class: sclass, session: ssession},
                      success:function(data){
                          // alert(term);
                          console.log(data);
                           $('#code').html(data);
                      }
                  });
                }
            }); //ende
            
        });

    </script>
    <?php include '../includes/footer.php'; ?>
    <?php
    }else{
        header("Location: ../error/403.php");
    }
    ?>