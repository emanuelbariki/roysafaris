

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Shared on THEMELOCK.COM - Dastyle - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="account-body accountbg">

        <!-- Register page -->
        <div class="container">
            <div class="row vh-100 d-flex justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <a href="index.html" class="logo logo-admin">
                                            <img src="assets/images/logo-sm.png" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 font-weight-semibold text-white font-18">Roy Safaris LTD Admin</h4>   
                                        <p class="text-muted  mb-0">Sign in to continue to App.</p>  
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal auth-form my-4" method="POST" action="{{ route('do.login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">Username</label>
                                            <div class="input-group mb-3">                                                                                         
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                                            </div>                                    
                                        </div><!--end form-group--> 
            
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>                                            
                                            <div class="input-group mb-3">                                  
                                                <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
                                            </div>                               
                                        </div><!--end form-group--> 
            
                                        <div class="form-group row mt-4">
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-switch switch-success">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitchSuccess2">
                                                    <label class="custom-control-label text-muted" for="customSwitchSuccess2">Remember me</label>
                                                </div>
                                            </div><!--end col--> 
                                            <div class="col-sm-6 text-right">
                                                <a href="auth-recover-pw.html" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>                                    
                                            </div><!--end col--> 
                                        </div><!--end form-group--> 
            
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                            </div><!--end col--> 
                                        </div> <!--end form-group-->                           
                                    </form><!--end form-->
                                    <div class="m-3 text-center text-muted">
                                        <p class="">Don't have an account ?  <a href="auth-register.html" class="text-primary ml-2">Free Resister</a></p>
                                    </div>
                                    <div class="account-social">
                                        <h6 class="my-4">Or Login With</h6>
                                    </div>
                                    <div class="btn-group btn-block">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Facebook</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Twitter</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Google</button>
                                    </div>
                                </div><!--end card-body-->
                                <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">Mannatthemes © 2020</span>                                            
                                </div>
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
        <!-- End Register page -->

        


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <script src="assets/js/simplebar.min.js"></script>

        
    </body>

</html>