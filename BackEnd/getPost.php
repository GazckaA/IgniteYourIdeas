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
            $reviews = $document->reviews;
        }

        $temp = "";
        $prettyTags = "";
        foreach ($tags as $tag) {
            $temp .= $tag . ",";
            $prettyTags .= "<a href='search.php?query=".$tag."'>#" . $tag . "</a>, ";
        }
        $tags = substr($temp ,0, strlen($temp)-1);
        $prettyTags = substr($prettyTags ,0, strlen($prettyTags)-2);

        $echoTestimonials = "";

        $stars = [
            0 => '',
            1 => '<i class="bi bi-star-fill"></i>',
            2 => '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>',
            3 => '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>',
            4 => '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>',
            5 => '<i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>'
        ];

        $count = 0;
        $prom = 0;

        foreach ($reviews as $review) {
            $count++;
            $prom += $review->rating;
            $echoTestimonials .= '<div class="swiper-slide">
            <div class="testimonial-item">
              <div class="stars">
                '.$stars[$review->rating].'
              </div>
              <p>
                '.$review->review.'
              </p>
              <div class="profile mt-auto">
                <h3>'.$review->username.'</h3>
              </div>
            </div>
          </div><!-- End testimonial item -->';
        }

        if($echoTestimonials == "")$echoTestimonials = '<div class="col-12 text-center"><h2>NO REVIEWS YET</h2></div>';

    }catch (MongoDB\Driver\Exception\Exception $e) {
        echo "Conexion error: please try again.";
    }
    

}

?>
