<?php

//if get is set and id is set
if(isset($_GET['query'])){
    //get id
    $userQuery = $_GET['query'];

    // Configuración de la conexión a MongoDB
    $mongoDBHost = '64.227.106.157';  // Reemplaza con la dirección IP de tu droplet
    $mongoDBPort = 27017;  // Puerto por defecto de MongoDB
    $mongoDBName = 'Archives';  // Reemplaza con el nombre de tu base de datos
    $collectionName = 'BlogEntrees';  // Reemplaza con el nombre de tu colección
    $username = 'admin';  // Reemplaza con tu nombre de usuario
    $password = '8d95d9cfd76d7171e7c5781a577ae2f52426d9f06bb6f65a';  // Reemplaza con tu contraseña

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
        $query = new MongoDB\Driver\Query(['$or'=> [['title' => new MongoDB\BSON\Regex('^'.$userQuery, 'i')],['tags' => new MongoDB\BSON\Regex('^'.$userQuery, 'i')],['author' => new MongoDB\BSON\Regex('^'.$userQuery, 'i')]]], ['sort' => ['_id' => -1], 'limit' => 20]);
        $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);

        $echo = "";
        $authors = array();
        // Recorrer los documentos y mostrarlos
        foreach ($cursor as $document) {
            $echo .= '<div class="col-xl-3 col-lg-4 col-md-6">
            <div class="gallery-item h-100" style="aspect-ratio: 1 / 1; ">
              <img src="'.$document->image.'" class="img-fluid" alt="" style="object-fit: cover;min-height: 100%; min-width:100%;">
              <div class="gallery-links d-flex justify-content-center" style="align-items:center;">
                <div class="row m-0">
                  <div class="col-12">
                    <a href="post.php?id='.$document->_id.'"><h4>'.$document->title.'</h4></a>
                  </div>
                  <div class="col-12 text-end">
                    <a href="profile.php?username='.$document->author.'"><strong>-@'.$document->author.'</strong></a>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Gallery Item -->';
          $authors[] = $document->author;
        }

        $collectionName = 'users';  // Reemplaza con el nombre de tu colección
        $query = new MongoDB\Driver\Query(['username' => new MongoDB\BSON\Regex('^'.$userQuery, 'i')]);
        $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);

        foreach($cursor as $document){
            $authors[] = $document->username;
        }

        $authors = array_unique($authors);

        $echoUsers = "";
        foreach($authors as $author){
            $query = new MongoDB\Driver\Query(['username' => $author], ['sort' => ['_id' => -1], 'limit' => 1]);
            $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);
            foreach($cursor as $document){
                $echoUsers .= '<div class="col-xl-2 col-lg-3 col-md-4">
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
        }

        if($echo == ""){
            if($authors == array()){
                echo '<!-- ======= End Page Header ======= -->
                <div class="page-header d-flex align-items-center">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h2>No results for: <strong>'.$userQuery.'</strong></h2>
            
                    </div>
                    </div>
                </div>
                </div><!-- End Page Header -->';
            }
            else{
                echo '<!-- ======= End Page Header ======= -->
                <div class="page-header d-flex align-items-center">
                  <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                      <div class="col-lg-6 text-center">
                        <h2>Results for: <strong>'.$userQuery.'</strong></h2>
            
                      </div>
                    </div>
                  </div>
                </div><!-- End Page Header -->
                <!-- ======= Gallery Section ======= -->
                <section id="gallery" class="gallery mb-5">
                  <div class="container-fluid">
            
                    <div class="container">
                        <div class="section-header">
                        <h2>USERS</h2>
                        <p>Connect with others</p>
                        </div>
                    </div>
            
                    <div class="row gy-4 justify-content-center">';
                echo $echoUsers; //usuarios
                echo '</div>
            </div>
        </section><!-- End Gallery Section -->';
            }
        }
        else{

            echo '<!-- ======= End Page Header ======= -->
            <div class="page-header d-flex align-items-center">
              <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                  <div class="col-lg-6 text-center">
                    <h2>Results for: <strong>'.$userQuery.'</strong></h2>
        
                  </div>
                </div>
              </div>
            </div><!-- End Page Header -->
        
            <!-- ======= Gallery Section ======= -->
            <section id="gallery" class="gallery">
              <div class="container-fluid">
        
                <div class="container">
                    <div class="section-header">
                    <h2>POSTS</h2>
                    <p>Community\'s most recent thoughts</p>
                    </div>
                </div>
        
                <div class="row gy-4 justify-content-center"><!-- contenedor de posts-->';
            echo $echo; //posts
            echo '</div>

            </div>
          </section><!-- End Gallery Section -->
      
          <!-- ======= Gallery Section ======= -->
          <section id="gallery" class="gallery mb-5">
            <div class="container-fluid">
      
              <div class="container">
                  <div class="section-header">
                  <h2>USERS</h2>
                  <p>Connect with others</p>
                  </div>
              </div>
      
              <div class="row gy-4 justify-content-center">';
            echo $echoUsers; //usuarios
            echo '</div>
            </div>
        </section><!-- End Gallery Section -->';

        }
    

}else{
    echo "<script>alert('There is no search query!'); window.location.href='index.php';</script>";
}

?>
