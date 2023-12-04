<?php

phpinfo();

// Configurar la zona horaria a la que deseas ajustar la fecha
date_default_timezone_set('Etc/GMT+8');

// Obtener la fecha y hora actual con el nombre del mes en formato legible
$fechaActual = date('Y F d');

// Obtener la hora actual en formato legible
$horaActual = date('H:i:s');

//Juntar fecha y hora
$fechaHoraActual = $fechaActual . " @: " . $horaActual." (GMT+8)";

// Mostrar fecha y hora
echo $fechaHoraActual;

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
    ];

    // Opciones de conexión con autenticación
    $options = [
        'authMechanism' => 'SCRAM-SHA-256',
        'authSource' => 'admin',
    ];

    // Conectar a MongoDB con autenticación
    $mongo = new MongoDB\Driver\Manager(
        "mongodb://{$mongoDBHost}:{$mongoDBPort}",
        $authentication,
        $options
    );

    // // Crear un objeto con un campo de timestamp actual
    // $document = [
    //     'username' => 'PruebaEvento',
    //     'image'=> 'assets/img/gallery/user.jpg'
    // ];

    // // Seleccionar la base de datos y la colección
    // $bulk = new MongoDB\Driver\BulkWrite();
    // $bulk->insert($document);

    // $mongo->executeBulkWrite("{$mongoDBName}.{$collectionName}", $bulk);

    // Seleccionar la base de datos y la colección
    $query = new MongoDB\Driver\Query([]);
    $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);

    // Recorrer los documentos y mostrarlos
    foreach ($cursor as $document) {
        echo nl2br(json_encode($document, JSON_PRETTY_PRINT));
        echo nl2br("\n\n\n\n");
    }

    // echo nl2br("\n\n\n\n");
    // echo 'Ultimo registro:';
    // echo nl2br("\n");
    // // Seleccionar la base de datos y la colección
    // $query = new MongoDB\Driver\Query([], ['sort' => ['_id' => -1], 'limit' => 1]);
    // $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);

    // // Recorrer los documentos y mostrarlos
    // foreach ($cursor as $document) {
    //     echo "ID: " . $document->_id . "\n";
    // }


    // //borrar
    // $delRec = new MongoDB\Driver\BulkWrite;
    // $delRec->delete([]);
    // $result = $mongo->executeBulkWrite("{$mongoDBName}.{$collectionName}", $delRec); 
    // echo $result->getDeletedCount(), " document(s) deleted", "\n";

} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Error de conexión: " . $e->getMessage() . "\n";
}

?>
