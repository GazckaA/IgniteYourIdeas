﻿<?php 

function allPosts(){
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
  $query = new MongoDB\Driver\Query([],['limit' => 20]);
  $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);
  // Configuración de la conexión a MongoDB
  // Recorrer los documentos y mostrarlos
  foreach ($cursor as $document) {
    echo '<div class="col-xl-3 col-lg-4 col-md-6">
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
  }
}

function lastsPosts(){
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
  $query = new MongoDB\Driver\Query([],['limit' => 5, 'sort' => ['_id' => -1]]);
  $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);
  // Configuración de la conexión a MongoDB
  // Recorrer los documentos y mostrarlos
  foreach ($cursor as $document) {
    echo '<div class="blog-slider__item swiper-slide" style="aspect-ratio: 1 / 1; ">
    <div class="blog-slider__img"><img src="'.$document->image.'"></div>
    <div class="blog-slider__content"><span class="blog-slider__code">'.$document->date.'</span>
        <div class="blog-slider__title">
            <p style="color: black;">'.$document->author.'</p>
        </div>
        <div class="blog-slider__text">
            <p style="color: black;">'.$document->title.'</p>
        </div><a href="post.php?id='.$document->_id.'"><button class="btn btn-dark " data-bss-hover-animate="pulse" id="button1" type="button"><img style="width: 20px;height: 20px;transform: rotate(270deg) translateX(2px);" src="assets/img/arrowwhite.gif"><span><strong>READ MORE</strong></span><img style="width: 20px;height: 20px;transform: rotate(90deg) translateX(-2px);" src="assets/img/arrowwhite.gif"></button></a>
    </div>
</div>';
  }
}

function userPosts($pusername, $prole){
  if($prole == 'reader')return;
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
  $query = new MongoDB\Driver\Query(["author" => $pusername],['limit' => 6]);
  $cursor = $mongo->executeQuery("{$mongoDBName}.{$collectionName}", $query);
  // Configuración de la conexión a MongoDB
  // Recorrer los documentos y mostrarlos
  $echo = "";
  $reviews = [];
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
  </div><!-- End Gallery Item -->
  ';
    $reviews[] = $document->reviews;
  }

  if ($echo == ""){
    echo '<div class="col-12 text-center">
    <h3>No posts yet</h3>';
  }else{
    echo '<!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery mb-2">
      <div class="container-fluid">
      <div class="container">
    <div class="section-header">
    <h2>Posts</h2>
    <p>@'.$pusername.'\'s most recent thoughts</p>
    </div>
</div>

<div class="row gy-4 justify-content-center">';
    echo $echo;
    echo '</div>

    </div>
  </section><!-- End Gallery Section -->';

    $echo = "";
    foreach ($reviews as $review) {
      foreach ($review as $r) {
        $echo .= '<div class="swiper-slide">
        <div class="testimonial-item">
          <div class="stars">
            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
          </div>
          <p>
            '.$review->content.'
          </p>
          <div class="profile mt-auto">
            <h3>'.$review->author.'</h3>
          </div>
        </div>
      </div><!-- End testimonial item -->';
      }
    }

    if ($echo != ""){
       echo '<!-- ======= Testimonials Section ======= -->
       <section id="testimonials" class="testimonials mb-4">
         <div class="container">
   
           <div class="section-header">
             <h2>Testimonials</h2>
             <p>What they are saying</p>
           </div>
   
           <div class="slides-3 swiper">
             <div class="swiper-wrapper">';
        echo $echo;
        echo '</div>
        <div class="swiper-pagination"></div>
      </div>

    </div>
  </section><!-- End Testimonials Section -->';
    }

  }

  
}

?>