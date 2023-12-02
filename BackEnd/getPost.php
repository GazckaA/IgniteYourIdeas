<?php

//if get is set and id is set
if(isset($_GET['id'])){
    //get id
    $id = $_GET['id'];

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
        // Seleccionar la base de datos y la colección
        $query = new MongoDB\Driver\Query(['_id' =>new MongoDB\BSON\ObjectID($id)], ['sort' => ['_id' => -1], 'limit' => 1]);
        $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);

        // Recorrer los documentos y mostrarlos
        foreach ($cursor as $document) {
            $ide = $document->_id;
            $title = $document->title;
            $content = $document->content;
            $date = $document->date;
            $author = $document->author;
            $tags = $document->tags;
            $image = $document->image;
            $authorName = $document->authorName;
        }

    }catch (MongoDB\Driver\Exception\Exception $e) {
        echo "Conexion error: please try again.";
    }
    

}

?>
