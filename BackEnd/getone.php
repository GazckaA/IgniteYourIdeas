<?php

//if not loggedin
if(!isset($_SESSION['loggedin'])){
    header("Location: landing.php");
    exit();
}
else{
    //include db
    include 'db.php';

    // santiza user en session
    $sanitizedUsername = mysqli_real_escape_string($mysqli, $_SESSION['username']);

    // Consulta preparada 
    $stmt = $mysqli->prepare("SELECT name, description,birthdate, token, email FROM users WHERE username = ?");
    $stmt->bind_param("s", $sanitizedUsername);
    $stmt->execute();
    $stmt->bind_result($name, $description, $birthdate, $token, $email);
    $stmt->fetch();
    $stmt->close();

    // Verificar si se encontraron resultados
    if (isset($name)) {
        // Usuario encontrado
        //si token es null
        if($token != null){
            echo '<div class="modal fade show d-block" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel" style="color: black">Welcome '.$name.'!</h5>
                </div>
                <div class="modal-body" style="color: black">
                  Please verify your email address. An email has been sent to '.$email.'. Click on the link in that email to continue.</br>
                  Please check your spam/junk folder. 
                </div>
                <div class="modal-footer">
                    <form action="BackEnd/controller.php" method="post">
                        <input type="hidden" name="email" value="'.$email.'">
                        <input type="hidden" name="operation" value="resendVerifyEmail">
                        <button type="submit" class="btn btn-dark">Resend Email</button>
                    </form>
                </div>
              </div>
            </div>
          </div>';
        }
        else if($description == NULL || $birthdate == NULL){
            echo '<script>alert("Welcome '.$name.'! We dont have some of your info. Please complete in your profile.");</script>';
        }
    } else {
        // Usuario no registrado, mostrar mensaje de error
        header("Location: landing.php"); // Redirigir landing
        exit();
    }
}
?>