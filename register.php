<?php

session_start();
if(isset($_SESSION['loggedin'])){
    header("Location: index.php");
    exit();
}

//si hay error
if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    //alerta
    echo "<script>alert('$error');</script>";
    unset($_SESSION['error']);
}

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sign Up</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.min.css">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- AOS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <!-- Custom CSS for login & register-->
    <link rel="stylesheet" href="assets/css/Landing-Page---Parallax-Background---Logo-Heading-ButtonGIF.css">
    <link rel="stylesheet" href="assets/css/Login-with-overlay-image.css">

    <style>
    body {
      background-image: url("assets/img/i2.jpg");
      font-family: var(--font-default);
      color: var(--color-default);
      background-color: #000;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>
</head>

<body ><div id="main-wrapper" class="container mb-3">
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card border-0 my-2 my-lg-0">
                <div class="card-body p-0">
                    <div class="row no-gutters">
                        <div class="col-lg-6 d-none d-lg-inline-block" >
                            <div class="account-block rounded" >
                                <div class="overlay" ></div>
                                <div class="account-testimonial" >
                                    <img style="width: 75%" id="logoimage1" src="assets/img/Drills4You%20logo%20fini.png" data-aos="fade" data-aos-duration="2500" data-aos-delay="700">
                                    <h4 class="text-white mt-4 mb-1" data-aos="fade" data-aos-duration="2500" data-aos-delay="1300">ARE YOU READY?</h4>
                                    <p class="lead text-white" id="quote" data-aos="fade" data-aos-duration="2500" data-aos-delay="1300"></p>
                                    <strong data-aos="fade" data-aos-duration="2500" data-aos-delay="1300"><p id="author"></p></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-1 p-lg-5">
                                <div class="mb-4">
                                    <h1 class="h4 font-weight-bold text-theme text-center">SIGN <br class="d-block d-md-none">UP</h1>
                                </div>
                                <form autocomplete="off" id="register" action="BackEnd/controller.php" method="POST">
                                    <input type="hidden" name="operation" value="register">
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                        <label for="name">Name <b class="req">*</b></label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" id="last" name="lastname" placeholder="Last name">
                                        <label for="last">Last name</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" id="username" name="username" placeholder="username" maxlength="25" required>
                                        <label for="username">Username <b class="req">*</b></label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                        <label for="email">Email address <b class="req">*</b></label>
                                    </div>
                                    <div class="form-floating input-group mb-2">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" required>
                                        <label for="password">Password <b class="req">*</b></label>  
                                        <button class="btn btn-outline-secondary toggle-password" type="button" target="#password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="form-floating input-group mb-2">
                                        <input type="password" class="form-control" id="confirm" placeholder="Password" autocomplete="off" required>
                                        <label for="confirm">Confirm your password <b class="req">*</b></label>
                                        <button class="btn btn-outline-secondary toggle-password" type="button" target="#confirm">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-12">
                                            <button type="submit" form="register" class="btn btn-primary " data-bss-hover-animate="pulse" id="button1"><img style="width: 20px;height: 20px;transform: rotate(270deg) translateX(2px);" src="assets/img/arrowwhite.gif"><span><strong>READY!</strong></span><img style="width: 20px;height: 20px;transform: rotate(90deg) translateX(-2px);" src="assets/img/arrowwhite.gif"></button>
                                        </div>
                                    </div>                                    
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->

            <p class="text-muted text-center mt-3 mb-0">Already have an account? <a href="login.php" class="text-light ml-1" style="text-decoration: underline;">Log In</a></p>
            

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
    <script>
        $(document).ready(function(){
            $("#register").submit(function(e){
                if(!($("#password").hasClass("is-valid") && $("#confirm").hasClass("is-valid"))){
                    e.preventDefault();
                    alert("Password is not ready! Make sure it has at least 8 characters and that both passwords match.");
                    return;
                }
            });
            //on change password
            $("#password").keyup(function(){
                //si esta vacio
                if($("#password").val() == "" && $("#confirm").val() == ""){
                    $("#password").removeClass("is-valid");
                    $("#password").removeClass("is-invalid");
                    $("#confirm").removeClass("is-valid");
                    $("#confirm").removeClass("is-invalid");
                    return;
                }
                //si no tiene por lo menos 8 caracteres
                if($("#password").val().length < 8){
                    $("#password").removeClass("is-valid");
                    $("#password").addClass("is-invalid");
                }else{
                    $("#password").removeClass("is-invalid");
                    $("#password").addClass("is-valid");
                }
                if($("#password").val() != $("#confirm").val()){
                    $("#confirm").removeClass("is-valid");
                    $("#confirm").addClass("is-invalid");
                }else{
                    $("#confirm").removeClass("is-invalid");
                    $("#confirm").addClass("is-valid");
                }
            });
            $("#confirm").keyup(function(){ 
                if($("#password").val() != $("#confirm").val()){
                    $("#confirm").removeClass("is-valid");
                    $("#confirm").addClass("is-invalid");
                }else{
                    $("#confirm").removeClass("is-invalid");
                    $("#confirm").addClass("is-valid");
                }
                if($("#password").val().length < 8){
                    $("#password").removeClass("is-valid");
                    $("#password").addClass("is-invalid");
                }else{
                    $("#password").removeClass("is-invalid");
                    $("#password").addClass("is-valid");
                }
            });
        });
    </script>
</body>

</html>