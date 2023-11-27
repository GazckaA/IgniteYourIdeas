<?php
session_start();



class User{

    /*--------------------------------------------------------------
    # LOG IN
    --------------------------------------------------------------*/
    public static function login($username, $password){
        //conexion a db
        include 'db.php';

        // Sanitizar los datos
        $sanitizedUsername = mysqli_real_escape_string($mysqli, $username);
        $sanitizedPassword = mysqli_real_escape_string($mysqli, $password);

        // Consulta preparada para obtener el hash de la contraseña almacenado en la base de datos
        $stmt = $mysqli->prepare("SELECT password FROM users WHERE LOWER(username) = LOWER(?) OR LOWER(email) = LOWER(?)");
        if (!$stmt) {
            $_SESSION['error'] = "Error en inicio de sesión: por favor intente de nuevo.";
        }
        $stmt->bind_param("ss", $sanitizedUsername, $sanitizedUsername);
        if (!$stmt->execute()) {
            $_SESSION['error'] = "Error en inicio de sesión: por favor intente de nuevo.";
        }
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();
        $mysqli->close();

        // Verifica si se encontró un usuario y la contraseña coincide
        if (password_verify($sanitizedPassword, $hashedPassword)) {
            // Usuario autenticado con éxito
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $sanitizedUsername;
            header("Location: ../index.php"); // Redirigir a la página de bienvenida o a donde desees
            $stmt->close();
            $mysqli->close();
            exit();
        } else {
            // Usuario no autenticado, mostrar mensaje de error
            $_SESSION['error'] = "Nombre de usuario o contraseña incorrectos.";
            header("Location: ../login.php"); // Redirigir de nuevo al formulario de inicio de sesión
            $stmt->close();
            $mysqli->close();
            exit();
        }
    }

    /*--------------------------------------------------------------
    # REGISTRO
    --------------------------------------------------------------*/
    public static function register($name, $lastname, $username, $email, $password){
        //conexion a db
        include 'db.php';

        // Sanitizar los datos
        $sanitizedName = mysqli_real_escape_string($mysqli, $name);
        $sanitizedLastname = mysqli_real_escape_string($mysqli, $lastname);
        $sanitizedUsername = mysqli_real_escape_string($mysqli, $username);
        $sanitizedEmail = mysqli_real_escape_string($mysqli, $email);

        // Encriptar la contraseña
        $sanitizedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Consulta preparada
        $stmt = $mysqli->prepare("INSERT INTO users (name, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $sanitizedName, $sanitizedLastname, $sanitizedUsername, $sanitizedEmail, $sanitizedPassword);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontraron resultados
        if ($stmt->affected_rows > 0) {
            // Usuario registrado con éxito
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $sanitizedUsername;
            header("Location: ../index.php"); // Redirigir a la página de bienvenida o a donde desees
            $stmt->close();
            $mysqli->close();
            exit();
        } else {
            // Usuario no registrado, mostrar mensaje de error
            $_SESSION['error'] = "Error en el registro";
            header("Location: ../register.php"); // Redirigir de nuevo al formulario de registro
            $stmt->close();
            $mysqli->close();
            exit();
        }
    }

};
?>
