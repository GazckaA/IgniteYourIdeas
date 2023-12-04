<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php include 'BackEnd/getPost.php'; if(isset($title))echo $title; else echo "Nothing to see here";?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.min.css">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


  <style>
    body {
      background-image: url("assets/img/i2.jpg");
      font-family: var(--font-default);
      color: var(--color-default);
      background-color: #000;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>

  <!-- =======================================================
  * Template Name: PhotoFolio
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
<?php include 'BackEnd/getone.php';  ?>
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center  me-auto me-lg-0">
        <img src="assets/img/Drills4You logo fini.png" alt="">
      </a>

      <nav id="navbar" class="navbar me-1">
        <ul>
          <li><a href="index.php">Contemplate</a></li>
          <?php if($role != 'reader') echo '<li><a href="connect.php">Connect</a></li>
          <li><a href="create.php">Create</a></li>'; 
          else echo '<li><a href="connect.php" >Connect</a></li>';?>
          <li><a class="me-0 me-lg-2 active">Post</a></li>
          <li class="dropdown d-xxl-none me-0 me-lg-2"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li>
                <form action="profile.php" method="get">
                    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                    <button class="btn btn-link mx-2" type="submit">
                      MY PROFILE
                    </button>
                  </form>
              </li>
              <li>
                <form action="index.php" method="post">
                    <input type="hidden" name="operation" value="logout">
                    <button type="submit" class="btn btn-link mx-2">
                        CLOSE SESSION
                    </button>
                  </form>
              </li>
            </ul>
          </li>
          <li><form class="d-flex m-2 m-xxl-0" action="search.php" method="GET">
                <input class="form-control me-sm-2" type="search" placeholder="Search" name="query" required>
                <button class="btn btn-outline-light-sm my-2 my-sm-0" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form></li>
          <li class="nav-item dropdown d-none d-xxl-block">
            <a class="nav-link dropdown-toggle me-0 me-lg-2 active" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="bi bi-person-circle dropdown-indicator"></i></a>
                <div class="dropdown-menu dropdown-menu-end">
                  <form action="profile.php" method="get">
                    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                    <button class="btn btn-link mx-2" type="submit">
                      MY PROFILE
                    </button>
                  </form>
                  <form action="index.php" method="post">
                    <input type="hidden" name="operation" value="logout">
                    <button type="submit" class="btn btn-link mx-2">
                        CLOSE SESSION
                    </button>
                  </form>
                </div>
          </li>
        </ul>
      </nav><!-- .navbar -->
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= End Page Header ======= -->
    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2><?php if(isset($title))echo $title; else echo "<script>alert('Nothing to see here');window.location.href = 'index.php';</script>"?></h2>
            <p><?php echo $prettyTags;?></p>

            <?php if(isset($author)&& isset($username) && $author == $username) echo '<a class="cta-btn rounded-pill" href="create.php?id='.$id.'">Edit post</a>'?>

          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

    <!-- ======= Gallery Single Section ======= -->
    <section id="gallery-single" class="gallery-single">
      <div class="container">

        <div class="position-relative h-100">
          <div class="slides-1 portfolio-details-slider swiper">
            <div class="swiper-wrapper align-items-center">

              <div class="swiper-slide">
                <img src="<?php if(isset($image))echo $image;else echo 'assets/img/gallery/gallery-2.jpg'?>" alt="" class="rounded">
              </div>

            </div>
          </div>

        </div>

        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8">
            <div class="portfolio-description">
              <?php if(isset($content))echo $content?>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>Author information:</h3>
              <ul>
                <li><strong>Name:</strong> <span><?php if(isset($authorName))echo $authorName?></span></li>
                <li><strong>Post date:</strong> <span><?php if(isset($date))echo $date?></span></li>
                <li><strong>Username:</strong> <a>@<?php if(isset($author))echo $author?></a></li>
                <li >
                  <form action="profile.php" method="get" id="gotoprofile">
                    <input type="hidden" name="username" value="<?php if(isset($author)) echo $author ?>">
                  </form>
                  <button class="btn btn-visit" type="submit" form="gotoprofile">
                      GO TO PROFILE
                  </button>
                </li>
                <li>
                  <button type="button" class="btn btn-visit" style="background-color: black;"data-bs-toggle="modal" data-bs-target="#review">
                      REVIEW POST
                  </button>
                </li>
              </ul>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Gallery Single Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials mb-4">
      <div class="container">

        <div class="section-header">
          <h2>REVIEWS</h2>
          <p>What they are saying? <?php if(isset($count) && isset($prom) && $count > 0) echo '('.$prom/$count.' based on '.$count.' reviews)';?></p>
        </div>

        <div class="slides-3 swiper">
          <div class="swiper-wrapper">

            <?php if(isset($echoTestimonials))echo $echoTestimonials;?>

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer d-none">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>PhotoFolio</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <!-- Modal -->
  <div class="modal fade" id="review" tabindex="-1" aria-labelledby="review" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="review">REVIEW</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <h4 class="text-center mx-0 mx-md-2 my-2">
            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
          </h4>
          <form action="BackEnd/controller.php" method="POST" id="reviewForm"> 
            <input type="hidden" name="operation" value="review">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>">
            <input type="hidden" name="rating" id="rating" value="0">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Review:</label>
              <textarea type="text" class="form-control" id="recipient-name" name="review" required style="height: 40vh;"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
          <button type="submit" class="btn btn-success"  form="reviewForm">SAVE</button>
        </div>
      </div>
    </div>
  </div>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader">
    <div class="line"></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/jquery.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>

  <!-- Rating -->
  <script>
    var rating_data = 0;

    $(document).on('click', '.submit_star', function(){

      rating_data = $(this).data('rating');
      
      $('#rating').val(rating_data);

    });
    $(document).on('mouseenter', '.submit_star', function(){

      var rating = $(this).data('rating');

      reset_background();

      for(var count = 1; count <= rating; count++)
      {

          $('#submit_star_'+count).addClass('text-warning');

      }

    }); 
    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }
    $(document).on('mouseleave', '.submit_star', function(){

      reset_background();

      for(var count = 1; count <= rating_data; count++)
      {

          $('#submit_star_'+count).removeClass('star-light');

          $('#submit_star_'+count).addClass('text-warning');
      }

    });
  </script>
</body>

</html>