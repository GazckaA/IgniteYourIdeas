<?php
    session_start();

    //if get is set
    if(isset($_GET) && isset($_GET['token']) && $_GET['token'] != ""){
        //conexion a db
        include 'db.php';

        // Sanitizar los datos
        $sanitizedToken = mysqli_real_escape_string($mysqli, $_GET['token']);

        // Consulta preparada
        $stmt = $mysqli->prepare("SELECT username FROM users WHERE token = ?");
        $stmt->bind_param("s", $sanitizedToken);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->fetch();
        $stmt->close();

        // Verificar si se encontraron resultados
        if (isset($username)) {
            // Usuario registrado con éxito

            //update token to null
            $stmt = $mysqli->prepare("UPDATE users SET token = NULL WHERE token = ?");
            $stmt->bind_param("s", $sanitizedToken);
            $stmt->execute();
            $mysqli->close();

            //iniciar sesion
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: ../index.php"); // Redirigir a la página de bienvenida o a donde desees
            exit();
        } else {
            // Usuario no registrado, mostrar mensaje de error
            $_SESSION['error'] = "Invalid token!";
            header("Location: ../login.php"); // Redirigir de nuevo al formulario de registro
            exit();
        }
    }else{
        // Usuario no registrado, mostrar mensaje de error
        $_SESSION['error'] = "Not allowed there!";
        header("Location: ../login.php"); // Redirigir de nuevo al formulario de registro
        $stmt->close();
        $mysqli->close();
        exit();
    }

    header("Location: ../index.php");
?>