<?php 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../assets/PHPMailer/Exception.php';
require '../assets/PHPMailer/PHPMailer.php';
require '../assets/PHPMailer/SMTP.php';



function sendVerificationEmail($name, $email, $token){
    $mail = new PHPMailer(true);
    try{
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.privateemail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'admin@igniteyourideas.me';                     //SMTP username
        $mail->Password   = 'codxa1-Ridtuv';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('admin@igniteyourideas.me', 'Ignite Your Ideas');
        $mail->addAddress($email, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Verify your account - Ignite Your Ideas';
        $mail->Body    = '<h1>Hello '.$name.'!</h1></br><h3>Verify your account to be able to log in.</h3></br><p>Click on the following link to verify your account: <a href="https://www.igniteyourideas.me/BackEnd/verify.php?token='.$token.'">VERIFY</a></p>';

        $mail->send();
    }
    catch (Exception $e){
        $_SESSION['error'] = "Registration error";
        header("Location: ../register.php"); // Redirigir de nuevo al formulario de registro
        exit();
    }
} 

function sendResetEmail($name, $email, $token){
    $mail = new PHPMailer(true);
    try{
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.privateemail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'admin@igniteyourideas.me';                     //SMTP username
        $mail->Password   = 'codxa1-Ridtuv';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('admin@igniteyourideas.me', 'Ignite Your Ideas');
        $mail->addAddress($email, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset password - Ignite Your Ideas';
        $mail->Body    = '<h1>Hello '.$name.'!</h1></br><h3>You requested a password reset.</h3></br><p>Click on the following link to reset your password: <a href="https://www.igniteyourideas.me/resetPassword.php?email='.$email.'&token='.$token.'">RESET PASSWORD</a></p>';

        $mail->send();
    }
    catch (Exception $e){
        $_SESSION['error'] = "Failed to send email";
        header("Location: ../requestEmail.php"); // Redirigir de nuevo al formulario de registro
        exit();
    }
} 
?>