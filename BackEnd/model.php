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
            $_SESSION['error'] = "Log in error: please try again.";
            header("Location: ../login.php"); // Redirigir de nuevo al formulario de inicio de sesión
            exit();
        }
        $stmt->bind_param("ss", $sanitizedUsername, $sanitizedUsername);
        if (!$stmt->execute()) {
            $_SESSION['error'] = "Log in error: please try again.";
            header("Location: ../login.php"); // Redirigir de nuevo al formulario de inicio de sesión
            exit();
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
            exit();
        } else {
            // Usuario no autenticado, mostrar mensaje de error
            $_SESSION['error'] = "Incorrect username or password.";
            header("Location: ../login.php"); // Redirigir de nuevo al formulario de inicio de sesión
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
        $token = bin2hex(random_bytes(50));

        include 'mail.php';
        sendVerificationEmail($sanitizedName, $sanitizedEmail, $token);

        // Encriptar la contraseña
        $sanitizedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Consulta preparada
        $stmt = $mysqli->prepare("INSERT INTO users (name, lastname, username, email, password, token) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $sanitizedName, $sanitizedLastname, $sanitizedUsername, $sanitizedEmail, $sanitizedPassword, $token);
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
            $_SESSION['error'] = "Registration failed! Please try again.";
            header("Location: ../register.php"); // Redirigir de nuevo al formulario de registro
            $stmt->close();
            $mysqli->close();
            exit();
        }
    }

    /*--------------------------------------------------------------
    # SEND RESET EMAIL
    --------------------------------------------------------------*/
    public static function sendResetEmail($username){
        //conexion a db
        include 'db.php';

        // Sanitizar los datos
        $sanitizedUsername = mysqli_real_escape_string($mysqli, $username);

        // Consulta preparada para obtener el hash de la contraseña almacenado en la base de datos
        $stmt = $mysqli->prepare("SELECT name, email FROM users WHERE LOWER(username) = LOWER(?) OR LOWER(email) = LOWER(?)");
        if (!$stmt) {
            $_SESSION['error'] = "Error: please try again.";
            header("Location: ../requestEmail.php"); // Redirigir de nuevo al formulario de inicio de sesión
            exit();
        }
        $stmt->bind_param("ss", $sanitizedUsername, $sanitizedUsername);
        if (!$stmt->execute()) {
            $_SESSION['error'] = "Error: please try again.";
            header("Location: ../requestEmail.php"); // Redirigir de nuevo al formulario de inicio de sesión
            exit();
        }
        $stmt->bind_result($name, $email);
        $stmt->fetch();
        $stmt->close();

        // Verifica si se encontró un usuario
        if (isset($name, $email)) {

            // Usuario encontrado
            $token = bin2hex(random_bytes(50));

            //update token
            $stmt = $mysqli->prepare("UPDATE users SET token = ? WHERE email = ?");
            if (!$stmt) {
                $_SESSION['error'] = "Error: please try again.";
                header("Location: ../requestEmail.php"); // Redirigir de nuevo al formulario de inicio de sesión
                exit();
            }
            $stmt->bind_param("ss", $token, $email);
            if (!$stmt->execute()) {
                $_SESSION['error'] = "Error: please try again.";
                header("Location: ../requestEmail.php"); // Redirigir de nuevo al formulario de inicio de sesión
                exit();
            }
            $stmt->close();
            $mysqli->close();

            include 'mail.php';
            sendResetEmail($name, $email, $token);

            $_SESSION['error'] = "Check your email for a link to reset your password.";
            header("Location: ../requestEmail.php"); // Redirigir a la página de inicio de sesión
            exit();
        } else {
            $mysqli->close();
            // Usuario no encontrado, mostrar mensaje de error
            $_SESSION['error'] = "No account found with that username or email.";
            header("Location: ../requestEmail.php"); // Redirigir de nuevo al formulario de inicio de sesión
            exit();
        }
    }

    /*--------------------------------------------------------------
    # RESEND VERIFY EMAIL
    --------------------------------------------------------------*/
    public static function resendVerifyEmail($email){
        //conexion a db
        include 'db.php';

        // Sanitizar los datos
        $sanitizedEmail = mysqli_real_escape_string($mysqli, $email);

        // Consulta preparada para obtener el hash de la contraseña almacenado en la base de datos
        $stmt = $mysqli->prepare("SELECT name FROM users WHERE LOWER(email) = LOWER(?)");
        $stmt->bind_param("s", $sanitizedEmail);
        $stmt->execute();
        $stmt->bind_result($name);
        $stmt->fetch();
        $stmt->close();

        // Verifica si se encontró un usuario
        if (isset($name)) {

            //update user token
            $token = bin2hex(random_bytes(50));
            $stmt = $mysqli->prepare("UPDATE users SET token = ? WHERE email = ?");
            $stmt->bind_param("ss", $token, $sanitizedEmail);
            $stmt->execute();
            $stmt->close();

            // Usuario encontrado
            include 'mail.php';
            sendVerificationEmail($name, $sanitizedEmail, $token);

            $_SESSION['error'] = "Check your email for a link to verify your account.";
            header("Location: ../index.php"); // Redirigir a la página de inicio de sesión
            exit();
        }
    }


    /*--------------------------------------------------------------
    # RESET PASSWORD FROM EMAIL
    --------------------------------------------------------------*/
    public static function resetPass($username, $password){
        //conexion a db
        include 'db.php';

        // Sanitizar los datos
        $sanitizedUsername = mysqli_real_escape_string($mysqli, $username);

        // Encriptar la contraseña
        $sanitizedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Consulta preparada
        $stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $sanitizedPassword, $sanitizedUsername);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontraron resultados
        if ($stmt->affected_rows > 0) {
            // Usuario registrado con éxito
            header("Location: ../login.php"); // Redirigir a la página de bienvenida o a donde desees
            $stmt->close();
            $mysqli->close();
            exit();
        } else {
            // Usuario no registrado, mostrar mensaje de error
            $_SESSION['error'] = "Password reset failed! Please request another link.";
            header("Location: ../login.php"); // Redirigir de nuevo al formulario de registro
            $stmt->close();
            $mysqli->close();
            exit();
        }
    }

    /*--------------------------------------------------------------
    # CHANGE PASSWORD
    --------------------------------------------------------------*/
    public static function changePass($username, $password, $newPassword){
        //conexion a db
        include 'db.php';

        // Sanitizar los datos
        $sanitizedUsername = mysqli_real_escape_string($mysqli, $username);
        $sanitizedPassword = $password;
        $sanitizedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Consulta preparada para obtener el hash de la contraseña almacenado en la base de datos
        $stmt = $mysqli->prepare("SELECT password FROM users WHERE LOWER(username) = LOWER(?)");
        $stmt->bind_param("s", $sanitizedUsername);
        $stmt->execute();
        $stmt->bind_result($hashedPassword);
        $stmt->fetch();
        $stmt->close();

        // Verifica si se encontró un usuario y la contraseña coincide
        if (password_verify($sanitizedPassword, $hashedPassword)) {
            // Usuario autenticado con éxito

            // Consulta preparada
            $stmt = $mysqli->prepare("UPDATE users SET password = ? WHERE username = ?");
            $stmt->bind_param("ss", $sanitizedNewPassword, $sanitizedUsername);
            $stmt->execute();
            $result = $stmt->get_result();

            // Verificar si se encontraron resultados
            if ($stmt->affected_rows > 0) {
                // Usuario registrado con éxito
                session_destroy();
                header("Location: ../landing.php"); // Redirigir a la página de bienvenida o a donde desees
                $stmt->close();
                $mysqli->close();
                exit();
            } else {
                // Usuario no registrado, mostrar mensaje de error
                $_SESSION['error'] = "Password change failed! Please try again.";
                header("Location: ../changePassword.php"); // Redirigir de nuevo al formulario de registro
                $stmt->close();
                $mysqli->close();
                exit();
            }
        }else{
            // Usuario no autenticado, mostrar mensaje de error
            $_SESSION['error'] = "Incorrect password.";
            header("Location: ../changePassword.php"); // Redirigir de nuevo al formulario de inicio de sesión
            $stmt->close();
            $mysqli->close();
            exit();
        }
    }

    /*--------------------------------------------------------------
    # SAVE
    --------------------------------------------------------------*/
    public static function save($title, $author, $tags, $date, $image, $content, $authorName){
        // Configuración de la conexión a MongoDB
        $mongoDBHost = '64.227.106.157';  // Reemplaza con la dirección IP de tu droplet
        $mongoDBPort = 27017;  // Puerto por defecto de MongoDB
        $mongoDBName = 'Archives';  // Reemplaza con el nombre de tu base de datos
        $collectionName = 'BlogEntrees';  // Reemplaza con el nombre de tu colección
        $username = 'admin';  // Reemplaza con tu nombre de usuario
        $password = '8d95d9cfd76d7171e7c5781a577ae2f52426d9f06bb6f65a';  // Reemplaza con tu contraseña

        try {
            // Configuración de autenticación
            $authentication = [
                'username' => $username,
                'password' => $password,
            ];// Opciones de conexión con autenticación
            $options = [
                'authMechanism' => 'SCRAM-SHA-256',
                'authSource' => 'admin',
            ];// Conectar a MongoDB con autenticación
            $mongo = new MongoDB\Driver\Manager(
                "mongodb://{$mongoDBHost}:{$mongoDBPort}",
                $authentication,
                $options
            );
        
            // Crear un objeto con un campo de timestamp actual
            $document = [
                'title' => $title,
                'author' => $author,
                'authorName' => $authorName,
                'date' => $date,
                'tags' => $tags,
                'image'=> $image,
                'content' => $content,
                'reviews'=> []
            ];
        
            // Seleccionar la base de datos y la colección
            $bulk = new MongoDB\Driver\BulkWrite();
            $bulk->insert($document);
        
            $mongo->executeBulkWrite("{$mongoDBName}.{$collectionName}", $bulk);

            // Seleccionar la base de datos y la colección
            $query = new MongoDB\Driver\Query([], ['sort' => ['_id' => -1], 'limit' => 1]);
            $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);

            // Recorrer los documentos y mostrarlos
            foreach ($cursor as $document) {
                echo $document->_id;
                exit();
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "false";
            exit();
        }
    }

};
?>
