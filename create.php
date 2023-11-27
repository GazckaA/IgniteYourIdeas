<?php

session_start();
//if not loggedin
if(!isset($_SESSION['loggedin'])){
    header("Location: landing.php");
    exit();
}  

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Create</title>
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

  <!-- =======================================================
  * Template Name: PhotoFolio
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="background-image: url(assets/img/i2.jpg);">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center  me-auto me-lg-0">
        <img src="assets/img/Drills4You logo fini.png" alt="">
      </a>

      <nav id="navbar" class="navbar me-1">
        <ul>
          <li><a href="index.php">Contemplate</a></li>
          <li><a href="connect.php">Connect</a></li>
          <li><a class="active me-0 me-lg-2">Create</a></li>
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
          <li><form class="d-flex m-2 m-xxl-0">
                <input class="form-control me-sm-2" type="search" placeholder="Search" required>
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
            <h2>Title</h2>

            <a class="cta-btn rounded-pill" id="save">Save</a>

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
                <img src="assets/img/gallery/gallery-8.jpg" alt="" class="rounded">
              </div>

            </div>
          </div>

        </div>

        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8">
            <div class="portfolio-description">
              <h2>This is an example of portfolio detail</h2>
              <p>
                Autem ipsum nam porro corporis rerum. Quis eos dolorem eos itaque inventore commodi labore quia quia. Exercitationem repudiandae officiis neque suscipit non officia eaque itaque enim. Voluptatem officia accusantium nesciunt est omnis tempora consectetur dignissimos. Sequi nulla at esse enim cum deserunt eius.
              </p>
              <p>
                Amet consequatur qui dolore veniam voluptatem voluptatem sit. Non aspernatur atque natus ut cum nam et. Praesentium error dolores rerum minus sequi quia veritatis eum. Eos et doloribus doloremque nesciunt molestiae laboriosam.
              </p>

              <p>
                Impedit ipsum quae et aliquid doloribus et voluptatem quasi. Perspiciatis occaecati earum et magnam animi. Quibusdam non qui ea vitae suscipit vitae sunt. Repudiandae incidunt cumque minus deserunt assumenda tempore. Delectus voluptas necessitatibus est.

              <p>
                Sunt voluptatum sapiente facilis quo odio aut ipsum repellat debitis. Molestiae et autem libero. Explicabo et quod necessitatibus similique quis dolor eum. Numquam eaque praesentium rem et qui nesciunt.
              </p>

            </div>
          </div>

          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>Author information:</h3>
              <ul>
                <li><strong>Name:</strong> <span>Ian</span></li>
                <li><strong>Post date:</strong> <span>01 March, 2022</span></li>
                <li><strong>Username:</strong> <a href="#">@user</a></li>
                <li >
                  <form action="profile.php" method="get" id="gotoprofile">
                    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                  </form>
                  <button class="btn btn-visit" type="submit" form="gotoprofile">
                      GO TO PROFILE
                    </button>
                </li>
                <li>
                  <button type="submit" class="btn btn-visit" style="background-color: black;">
                      REVIEW POST
                  </button>
                </li>
              </ul>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Gallery Single Section -->

    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>

  <script>
    $(document).ready(function() {
      //when save button is pressed

    });
  </script>

</body>

</html>