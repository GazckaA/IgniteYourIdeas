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
        echo '<script>alert("User not found!");window.location.href = "index.php"</script>';
        exit();
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