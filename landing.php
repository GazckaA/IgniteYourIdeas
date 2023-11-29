<?php

session_start();
//si hay sesion activa
if(isset($_SESSION['loggedin'])){
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>IgniteYourIdeas</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Landing-Page---Parallax-Background---Logo-Heading-ButtonGIF.css">
</head>
<body >
    <div>
        <div id="box-2" ><img data-aos="fade" data-aos-duration="2500" data-aos-delay="700" id="logoimage1" src="assets/img/Drills4You%20logo%20fini.png">
            <h1 data-aos="fade" data-aos-duration="2000" data-aos-delay="700" id="heading1" >WORDS THAT CONNECT, <br class="d-block d-md-none">IDEAS THAT IGNITE</h1>
            <div class="row m-0 mb-5" data-aos="fade" data-aos-duration="2500" data-aos-delay="1300" >
                <div class="col-12 ">
                    <a href="register.php"><button class="btn btn-primary " data-bss-hover-animate="pulse" id="button1" type="button"><img style="width: 20px;height: 20px;transform: rotate(270deg) translateX(2px);" src="assets/img/arrowwhite.gif"><span><strong>YOUR JOURNEY BEGINS HERE</strong></span><img style="width: 20px;height: 20px;transform: rotate(90deg) translateX(-2px);" src="assets/img/arrowwhite.gif"></button></a>
                </div>
                <div class="col-12 ">
                    <a href="login.php"><button class="btn text-dark" data-bss-hover-animate="pulse" id="button2" type="button"><img style="width: 20px;height: 20px;transform: rotate(270deg) translateX(2px);" src="assets/img/arrowwhite.gif"><span><strong>CONTINUE YOUR JOURNEY</strong></span><img style="width: 20px;height: 20px;transform: rotate(90deg) translateX(-2px);" src="assets/img/arrowwhite.gif"></button></a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script>
        //on mouse over button2
        $("#button2").mouseover(function(){
            $("#button2").removeClass("text-dark");
        });
        //on mouse out button2
        $("#button2").mouseout(function(){
            $("#button2").addClass("text-dark");
        });
    </script>
</body>
</html>