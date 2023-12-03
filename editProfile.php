<?php

session_start();


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

<body >
<?php include 'BackEnd/getone.php'; if($pusername != $username && $role != 'admin') echo '<script>alert("Not allowed!"); window.location.href = "profile.php?username='.$pusername.'" </script>';?>
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

            <a class="cta-btn m-2" onclick="save()">SAVE</a>
            <a class="cta-btn m-2" style="background: black;" href="changePassword.php">CHANGE PASSWORD</a>
            <a class="cta-btn m-2" style="background: red;" onclick="deleteUser()">DELETE</a>

          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row gy-4 justify-content-center">
          <div class="col-lg-4">
            
            <div class="gallery">
              <div class="gallery-item">
                <img src="<?php if(isset($image))echo str_replace("\\", "", $image);?>" class="img-fluid" comp="<?php if(isset($image))echo $image;?>" alt="" id="portada">
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
          <div class="col-lg-5 content">
            <h2>More about me:</h2>
            <div class="row">
              <div class="col-12">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Role:</strong> <select class="form-select form-select-sm" id="role" onchange="adminPass()"><option <?php if($prole == 'reader')echo "selected='selected'";?>>reader</option><option <?php if($prole == 'author')echo "selected='selected'";?>>author</option><option <?php if($prole == 'admin')echo "selected='selected'";?>>admin</option></select> </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>Name:</strong> <input type="text" class="form-control form-control-sm" placeholder="<?php echo $pname ?>" value="<?php echo $pname ?>" id="name"> </li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Last Name:</strong> <input type="text" class="form-control form-control-sm" placeholder="<?php echo $plastname ?>" value="<?php echo $plastname?>" id="lastname"> </li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <input type="date" class="form-control form-control-sm" placeholder="<?php echo $pbirthdate ?>" value="<?php echo $pbirthdate ?>" id="birthdate"> </li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Username:</strong> <input type="text" class="form-control form-control-sm" placeholder="<?php echo $pusername ?>" value="<?php echo $pusername?>" id="username"> </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul style="height: 100%;">
                  <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong> <input type="email" class="form-control form-control-sm" placeholder="<?php echo $pemail ?>" value="<?php echo $pemail?>" id="email"> </li>
                  <li><i class="bi bi-chevron-right"></i> <strong>Description:</strong> </li>
                  <li style="height: 50%;"><textarea class="form-control form-control-sm"placeholder="<?php echo $pdescription ?>" style="height: 100%;" id="description"></textarea></li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

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
  <script src="assets/js/main.js"></script>

  <script>

    $(document).ready(function(){
      $('#description').val('<?php echo $pdescription?>');
    });

    function addMainImgLink() {
        const url = prompt('Insert url');
        if(url === null) return;
        $('#portada').attr('src', url);
        //clear input file
        $('#inputArchivo').val('');
    }

    function uploadMainImg() {
        var inputArchivo = document.getElementById('inputArchivo');
        var vistaPrevia = document.getElementById('portada');
        if (inputArchivo.files && inputArchivo.files[0]) {
            var lector = new FileReader();
            lector.onload = function (e) {
                vistaPrevia.src = e.target.result;
            };
            lector.readAsDataURL(inputArchivo.files[0]);
        }
        //clear input file
        $('#inputArchivo').val('');
    }

    function save(){
      if(checkInputs()){
        let name = $('#name').val();
        if(name == "")name = $('#name').attr('placeholder');
        let lastname = $('#lastname').val();
        if(lastname == "")lastname = $('#lastname').attr('placeholder');
        let birthdate = $('#birthdate').val();
        if(birthdate == "")birthdate = $('#birthdate').attr('placeholder');
        let username = $('#username').val();
        if(username == "")username = $('#username').attr('placeholder');
        let email = $('#email').val(); 
        if(email == "")email = $('#email').attr('placeholder');
        let description = $('#description').val();
        if(description == "")description = $('#description').attr('placeholder');
        let image = $('#portada').attr('src');
        if(image == $('#portada').attr('comp'))image = null;
        let role = $('#role').val();
        $.ajax({
          url: 'BackEnd/controller.php',
          type: 'POST',
          data: {'operation': 'update',
                'name': name, 
                'lastname': lastname, 
                'birthdate': birthdate, 
                'username': username, 
                'email': email, 
                'description': description,
                'origin': '<?php echo $pusername?>',
                'image': image, 
                'role': role},
          success: function(data){
            cambio = data.substring(2);
            if(cambio == 'success'){
              window.location.href = 'profile.php?username=<?php echo $pusername?>';
            }
            else alert('Error updating profile');
          }
        });
      }
      else window.location.href = 'profile.php?username=<?php echo $pusername?>';
    }

    function checkInputs(){
      let bool = false;
      $('.form-control-sm').each(function(){
        if($(this).val() != $(this).attr('placeholder') && $(this).val() != "")bool = true;
      });
      if(bool)return true;
      if($('#portada').attr('src') != $('#portada').attr('comp'))return true;
      return false;
    }

    function deleteUser(){
      const url = prompt('Type your password to confirm');
      if(url === null) return;
      $.ajax({
        url: 'BackEnd/controller.php',
        type: 'POST',
        data: {'operation': 'deleteUser',
              'username': '<?php echo $pusername?>',
              'password': url}
      });
      window.location.href = 'profile.php?username=<?php echo $pusername?>';
    }

    function adminPass(){
      if($('#role').val() != 'admin')return;
      const url = prompt('Type ADMIN password to confirm');
      if(url === null) {
        $('#role').html(`<option <?php if($prole == 'reader')echo "selected='selected'";?> >reader</option><option <?php if($prole == 'author')echo "selected='selected'";?>>author</option><option <?php if($prole == 'admin')echo "selected='selected'";?>>admin</option>`);
        return;
      }
      $.ajax({
        url: 'BackEnd/controller.php',
        type: 'POST',
        data: {'operation': 'adminPass',
              'password': url},
        success: function(data){
          cambio = data.substring(1);
          if(cambio != 'success'){
            alert('Incorrect ADMIN password');
            $('#role').html(`<option <?php if($prole == 'reader')echo "selected='selected'";?> >reader</option><option <?php if($prole == 'author')echo "selected='selected'";?>>author</option><option <?php if($prole == 'admin')echo "selected='selected'";?>>admin</option>`);
          }
        }
      });
    }
  </script>

</body>

</html>