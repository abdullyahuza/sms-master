<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        
        <style type="text/css">
            body{
                
            }
            .links{
                min-height:100vh;
                transition: 0.5s;
                transition-timing-function: ease-in;
                background-color: black;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
    </head>
    <body style="background-color: #1F262D;">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="links">
            <div class="row">
                
                <img class="col-8" style="margin: 0 auto; width: 200px;" src="./assets/images/logo.png" />    
                
                <div class="col-8 mt-3" style="margin: 0 auto;">
                    <a href="./admin" class="btn btn-primary btn-lg btn-rounded btn-block mb-3">Admin</a>
                </div>

                <div class="col-8" style="margin: 0 auto;">
                    <a href="./staff" class="btn btn-success btn-lg btn-rounded btn-block">Staff</a>
                </div>

            </div>    
        </div>
        

        <div class="row justify-content-start">
        </div>


        
        <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="./assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="./assets/extra-libs/sparkline/sparkline.js"></script>
        <!--Wave Effects -->
        <script src="./dist/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="./dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="./dist/js/custom.min.js"></script>
        <!-- this page js -->
        <script src="./assets/libs/toastr/build/toastr.min.js"></script>
    </body>
        
</html>