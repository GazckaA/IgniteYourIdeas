<?php

session_start();


//if error
if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
    echo "<script>alert('$error');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php include 'BackEnd/getProfile.php'; echo '@'.$pusername;?></title>
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
<?php include 'BackEnd/getone.php'; ?>
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
          <li><a href="create.php" class="me-0 me-lg-2">Create</a></li>'; 
          else echo '<li><a href="connect.php" class="me-0 me-lg-2">Connect</a></li>';?>
          <li class="dropdown active d-xxl-none me-0 me-lg-2"><a href="#"><span>Profile</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <?php if($pusername != $username) echo '<li>
                <form action="profile.php" method="get">
                    <input type="hidden" name="username" value="'. $_SESSION['username'].'">
                    <button class="btn btn-link mx-2" type="submit">
                      MY PROFILE
                    </button>
                  </form>
              </li>'?>
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
                  <?php if($pusername != $username)echo '<form action="profile.php" method="get">
                    <input type="hidden" name="username" value="'.$_SESSION['username'].'">
                    <button class="btn btn-link mx-2" type="submit">
                      MY PROFILE
                    </button>
                  </form>'?>
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
            <h2>@<?php echo $pusername?></h2>
            <p><?php echo $pdescription;?></p>

            <?php if($prole == $role || $role == 'admin'){ echo '<a class="cta-btn" href="editProfile.php?username='. $pusername.'">'; if($pdescription == null || $pbirthdate == null || $plastname == null)echo 'COMPLETE PROFILE'; else echo 'EDIT PROFILE'; echo '</a>'; }?>

          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row gy-4 justify-content-center">
          <div class="col-lg-4">
            <img src="<?php if(isset($image))echo $image; ?>" class="img-fluid rounded" alt="">
          </div>
          <div class="col-lg-5 content">
            <h2>More about me:</h2>
            <div class="row">
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Name:</strong> <?php echo $pname ?></li>
                  <?php if($plastname != null)echo '<li><i class="bi bi-chevron-right"></i> <strong>Last Name:</strong> '.$plastname.'</li>' ?> 
                  <?php 
                  if($pbirthdate != null) {
                    $formattedDate = date("F j, Y", strtotime($pbirthdate));
                    echo '<li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong>'.$formattedDate.'</li><li><i class="bi bi-chevron-right"></i> <strong>Age:</strong>'. getAge($pbirthdate).'</li>';
                  }
                  ?>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <?php echo $pemail?></li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Role:</strong> <?php echo $prole?></li>
                  <?php if($prole != 'reader')'<li><i class="bi bi-chevron-right"></i> <strong>Posts:</strong> ' .$pposts . '</li>'?>
                  <li><i class="bi bi-chevron-right"></i> <strong>Since:</strong> <?php echo $pcreatedat?> (UTC+00:00)</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

        <?php include 'BackEnd/getPosts.php'; userPosts($pusername, $prole); ?>

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
  <script src="assets/js/main.js"></script>

</body>

</html>