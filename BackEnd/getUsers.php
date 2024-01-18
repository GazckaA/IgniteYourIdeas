<?php 

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
$query = new MongoDB\Driver\Query([],[ 'limit' => 10]);
$cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);


// Recorrer los documentos y mostrarlos
foreach ($cursor as $document) {
    echo '<div class="col-xl-2 col-lg-3 col-md-4">
    <div class="gallery-item h-100 rounded-circle" style="aspect-ratio: 1 / 1; ">
      <img src="'.str_replace("\\", "", $document->image).'" class="img-fluid" alt="" style="min-width:100%; min-height: 100%; object-fit: cover">
      <div class="gallery-links d-flex justify-content-center" style="align-items:center;">
        <div class="row m-0">
          <div class="col-12">
            <a href="profile.php?username='.$document->username.'"><h3><strong>@'.$document->username.'</strong></h3></a>
          </div>
        </div>
      </div>
    </div>
  </div><!-- End Gallery Item -->';
}

?>