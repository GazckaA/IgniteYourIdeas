<?php

//if theres no get method and there is no username in get
if(!isset($_GET['username'])){
    echo '<script>alert("Nothing to see here!");window.location.href = "index.php"</script>';
    exit();
}
else{
    //include db
    include 'db.php';

    // santiza user en session
    $sanitizedUsername = mysqli_real_escape_string($mysqli, $_GET['username']);

    // Consulta preparada 
    $stmt = $mysqli->prepare("SELECT role, username, name, lastname, email, description, birthdate, createdat, posts FROM users WHERE username = ?");
    $stmt->bind_param("s", $sanitizedUsername);
    $stmt->execute();
    $stmt->bind_result($prole, $pusername, $pname, $plastname, $pemail, $pdescription, $pbirthdate, $pcreatedat, $pposts);
    $stmt->fetch();
    $stmt->close();

    // Verificar si se encontraron resultados
    if (!isset($pname)){
        // Usuario no registrado, mostrar mensaje de error
        $_SESSION['error'] = 'Usuario no encontrado';
        header('Location: index.php');
        exit();
    }

    // Configuración de la conexión a MongoDB
    $mongoDBHost = '64.23.157.97';  // Reemplaza con la dirección IP de tu droplet
    $mongoDBPort = 27017;  // Puerto por defecto de MongoDB
    $mongoDBName = 'Archives';  // Reemplaza con el nombre de tu base de datos
    $collectionName = 'users';  // Reemplaza con el nombre de tu colección
    $username = 'admin';  // Reemplaza con tu nombre de usuario
    $password = 'f789389b6e55189def67a1af52ce996238ce41485f0a67b2';  // Reemplaza con tu contraseña

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

    // Seleccionar la base de datos y la colección
    $query = new MongoDB\Driver\Query(['username' => $pusername], [ 'limit' => 1]);
    $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);

    // Recorrer los documentos y mostrarlos
    foreach ($cursor as $document) {
        $image = $document->image;
    }
}

//funcion para obtener anos desde una fecha
function getAge($date){
    $dob = new DateTime($date);
    $now = new DateTime();
    $difference = $now->diff($dob);
    $age = $difference->y;
    return $age;
}
?>