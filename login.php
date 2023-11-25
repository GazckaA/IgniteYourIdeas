<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LogIn</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!-- Boostrap-->
    <link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.min.css">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- Custom CSS for login & register-->
    <link rel="stylesheet" href="assets/css/Landing-Page---Parallax-Background---Logo-Heading-ButtonGIF.css">
    <link rel="stylesheet" href="assets/css/Login-with-overlay-image.css">
</head>

<body><div id="main-wrapper" class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card border-0 ">
                <div class="card-body p-0">
                    <div class="row no-gutters ">
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="mb-4">
                                    <h1 class="h4 font-weight-bold text-theme text-center">LOGIN</h1>
                                </div>
                                <form >
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" placeholder="Username or email">
                                        <label for="floatingInput">Username or email</label>
                                    </div>
                                    <div class="form-floating input-group mb-2">
                                        <input type="password" class="form-control" id="password" placeholder="Password" autocomplete="off" required>
                                        <label for="password">Password</label>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" id="togglePassword" target="#password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-12">
                                            <button class="btn btn-primary " data-bss-hover-animate="pulse" id="button1" type="button"><img style="width: 20px;height: 20px;transform: rotate(270deg) translateX(2px);" src="assets/img/arrowwhite.gif"><span><strong>GO!</strong></span><img style="width: 20px;height: 20px;transform: rotate(90deg) translateX(-2px);" src="assets/img/arrowwhite.gif"></button>
                                        </div>
                                        <div class="col-12">
                                            <a href="#l" class="forgot-link float-right text-light m-2">Forgot password?</a>
                                        </div>
                                    </div>                                    
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6 d-none d-lg-inline-block">
                            <div class="account-block rounded">
                                <div class="overlay "></div>
                                <div class="account-testimonial" >
                                    <img style="width: 75%" id="logoimage1" src="assets/img/Drills4You%20logo%20fini.png" data-aos="fade" data-aos-duration="2000" data-aos-delay="700">
                                    <h4 class="text-white mt-4 mb-1" data-aos="fade" data-aos-duration="2000" data-aos-delay="1300">WELCOME BACK!</h4>
                                    <p class="lead text-white" id="quote" data-aos="fade" data-aos-duration="2000" data-aos-delay="1300"></p>
                                    <strong data-aos="fade" data-aos-duration="2000" data-aos-delay="1300"><p id="author"></p></strong>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

            <p class="text-muted text-center mt-3 mb-0">Don't have an account? <a href="register.php" class="text-light ml-1">Sign Up</a></p>

            <!-- end row -->

        </div>
        <!-- end col -->
    </div>
    <!-- Row -->
</div>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/passwordToggle.js"></script>
    <script src="assets/js/quote.js"></script>
</body>

</html>