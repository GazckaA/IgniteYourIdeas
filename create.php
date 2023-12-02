<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php include 'BackEnd/getPost.php'; if(isset($title))echo $title; else echo "Title" ?></title>
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

  <!-- TextEditor -->
  <link rel="stylesheet" href="assets/css/textEditor.css">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

  <!-- =======================================================
  * Template Name: PhotoFolio
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="background-image: url(assets/img/i2.jpg);">
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
            <h2 id="title"><?php if(isset($title))echo $title; else echo "Title" ?></h2>

            <a class="cta-btn rounded-pill" onclick="<?php if(isset($id))echo 'update()'; else echo 'save()'?>" >Save</a>

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

                <div class="gallery">
                  <div class="gallery-item h-100">
                  <img src="<?php if(isset($image))echo $image; else echo 'assets/img/gallery/gallery-2.jpg?v='.time();?>" class="img-fluid" alt="" id="portada">
                  <div class="gallery-links d-flex align-items-center justify-content-center">
                    <a onclick="addMainImgLink()" class="details-link" ><i class="bi bi-link"></i></a>
                    <a class="details-link" data-bs-toggle="dropdown" ><i class="bi bi-upload"></i></a>
                    <a class="dropdown-menu dropdown-menu-end">
                      <input type="file" id="inputArchivo" onchange="uploadMainImg()" accept="image/*" class="m-1">
                    </a>

                  </div>
                </div>

              </div>

            </div>

            </div>
          </div>

        </div>
        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8">
            <div class="portfolio-description">
              
            <div class="container p-0 my-2" >
                  <div class="toolbar rounded-top" >
                      <div class="head">
                          <input type="text" placeholder="Filename" value="<?php if(isset($title))echo $title; else echo 'Title'?>" id="filename" maxlength="155" >
                          <input type="text" placeholder="Tags" value="<?php if(isset($tags))echo $tags; else echo 'Tags'?>" id="tags" maxlength="155" >
                          <select onchange="formatDoc('formatBlock', this.value); this.selectedIndex=0;">
                              <option value="" selected="" hidden="" disabled="">Format</option>
                              <option value="h1">Heading 1</option>
                              <option value="h2">Heading 2</option>
                              <option value="h3">Heading 3</option>
                              <option value="h4">Heading 4</option>
                              <option value="h5">Heading 5</option>
                              <option value="h6">Heading 6</option>
                              <option value="p">Paragraph</option>
                          </select>
                          <select onchange="formatDoc('fontSize', this.value); this.selectedIndex=0;">
                              <option value="" selected="" hidden="" disabled="">Font size</option>
                              <option value="1">Extra small</option>
                              <option value="2">Small</option>
                              <option value="3">Regular</option>
                              <option value="4">Medium</option>
                              <option value="5">Large</option>
                              <option value="6">Extra Large</option>
                              <option value="7">Big</option>
                          </select>
                          <div class="color">
                              <span style="color: black;">Color</span>
                              <input type="color" oninput="formatDoc('foreColor', this.value); this.value='#000000';">
                          </div>
                          <div class="color">
                              <span style="color: black;">Background</span>
                              <input type="color" oninput="formatDoc('hiliteColor', this.value); this.value='#000000';">
                          </div>
                          <div class="color" style="background: #5bd9a9;border: black;" onclick="<?php if(isset($id))echo 'update()'; else echo 'save()'?>">
                              <span style="color: black;" >Save</span>
                          </div>
                          <div class="color" style="background: red;border: black;" onclick="delete()">
                              <span style="color: white;" data-bs-toggle="modal">Delete</span>
                          </div>
                      </div>
                      <div class="btn-toolbar">
                          <button onclick="formatDoc('undo')"><i class='bx bx-undo' ></i></button>
                          <button onclick="formatDoc('redo')"><i class='bx bx-redo' ></i></button>
                          <button onclick="formatDoc('bold')"><i class='bx bx-bold'></i></button>
                          <button onclick="formatDoc('underline')"><i class='bx bx-underline' ></i></button>
                          <button onclick="formatDoc('italic')"><i class='bx bx-italic' ></i></button>
                          <button onclick="formatDoc('strikeThrough')"><i class='bx bx-strikethrough' ></i></button>
                          <button onclick="formatDoc('justifyLeft')"><i class='bx bx-align-left' ></i></button>
                          <button onclick="formatDoc('justifyCenter')"><i class='bx bx-align-middle' ></i></button>
                          <button onclick="formatDoc('justifyRight')"><i class='bx bx-align-right' ></i></button>
                          <button onclick="formatDoc('justifyFull')"><i class='bx bx-align-justify' ></i></button>
                          <button onclick="formatDoc('insertOrderedList')"><i class='bx bx-list-ol' ></i></button>
                          <button onclick="formatDoc('insertUnorderedList')"><i class='bx bx-list-ul' ></i></button>
                          <button onclick="addLink()"><i class='bx bx-link' ></i></button>
                          <button onclick="formatDoc('unlink')"><i class='bx bx-unlink' ></i></button>
                          <button onclick="addImage()"><i class='bx bx-images' ></i></button>
                          <button data-bs-toggle="dropdown" ><i class="bx bx-images"></i></button>
                          <a class="dropdown-menu dropdown-menu-end">
                            <input type="file" id="imgText" accept="image/*" class="m-1" onchange="imgText()">
                          </a>
                          <button id="show-code" data-active="false">&lt;/&gt;</button>
                      </div>
                  </div>
                  <div id="content" contenteditable="true" spellcheck="false" >
                      <?php if(isset($content))echo $content; else echo 'Lorem, ipsum.'?>
                  </div>
              </div>

              </div>
            </div>

          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>Author information:</h3>
              <ul>
                <li><strong>Name:</strong> <span id="name"><?php if(isset($authorName))echo $authorName; else echo $name;?></span></li>
                <li><strong>Post date:</strong> <span id="postdate"></span></li>
                <li><strong>Username:</strong> <span id="author"><?php if(isset($author))echo $author; else echo $username?></span></li>
                <li >
                  <form action="profile.php" method="get" id="gotoprofile">
                    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                  </form>
                  <button class="btn btn-visit" type="submit" form="gotoprofile" disabled>
                      GO TO PROFILE
                  </button>
                </li>
                <li>
                  <button type="submit" class="btn btn-visit" style="background-color: black;" disabled>
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
  <script src="assets/js/jquery.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>

  <!-- TextEditor -->
  <script src="assets/js/texteditor.js?v=<?php echo time(); ?>"></script>
</body>

</html>