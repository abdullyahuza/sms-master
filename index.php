<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="./dist/css/style.min.css" rel="stylesheet" />
        <link href="./assets/libs/toastr/build/toastr.min.css" rel="stylesheet" />
        <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.ico">
        <style type="text/css">

            .main{

            }
            .links{
                min-height:90vh;
                transition: 0.5s;
                transition-timing-function: ease-in;
                background-color: #1F262D;;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .footer {
              position: fixed;
              left: 0;
              bottom: 0;
              width: 100%;
              color: white;
              text-align: center;
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
        <div class="main">

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

            <footer class="footer">
                All rights reserved 
                <a href="https://abdullyahuza.github.io" style="color: #dae9e9;" target="_blank">
                    &nbsp;<b>Abdull Yahuza</b>
                </a>
            </footer>
            
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