<?php
    require_once("islemler.php");
    $islem = new Islemler();
  
    if ($_SESSION["giris"] != sha1(md5("var"))){
    header("Location: cikis.php");
    }

    if(isset($_POST["email"])){
    
    $unvan = $_POST["unvan"];
    $adres = $_POST["adres"];
    $telefon = $_POST["telefon"];
    $email = $_POST["email"];
    
    $mesaj = $islem->bilgileri_guncelle($unvan, $adres, $telefon, $email);
    
    echo "<script> alert('$mesaj') </script>";
    echo "<script> window.location.href='cikis.php' </script>";    
      
    }

    if(isset($_POST["eski_sifre"])){
    $email = $_SESSION["kullanici"][5];
    $eski_sifre = $_POST["eski_sifre"];
    $yeni_sifre = $_POST["yeni_sifre"];
    $yeni_sifre_tekrar = $_POST["yeni_sifre_tekrar"];
    if ( $yeni_sifre == $yeni_sifre_tekrar){
        if( $eski_sifre != $yeni_sifre){
            $mesaj = $islem->sifre_degistirme($email, $eski_sifre, $yeni_sifre);
            echo "<script> alert('$mesaj') </script>";
            echo "<script> window.location.href='cikis.php' </script>";
        }
        else{
            echo "<script> alert('Eski Şifre İle Yenisi Aynı Olamaz!') </script>";  
        }
    }
    else{   
        echo "<script> alert('Yeni Şifre İle Tekrarı Uyuşmuyor!') </script>";  
    }   
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Profil</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Karayel Üniversitesi</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION["kullanici"][0]." ".$_SESSION["kullanici"][1] ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $_SESSION["kullanici"][0]." ".$_SESSION["kullanici"][1] ?></h6>
              <span><?php echo $_SESSION["kullanici"][2]?></span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="profil.php">
                <i class="bi bi-person"></i>
                <span>Profil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="cikis.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Çıkış Yap</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Veri Girme</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="ogrenci_kayit.php">
              <i class="bi bi-circle"></i><span>Öğrenci Kaydı</span>
            </a>
          </li>
          <li>
            <a href="not_girme.php">
              <i class="bi bi-circle"></i><span>Not Girme</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tablolar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="ogrenci_tablosu.php">
              <i class="bi bi-circle"></i><span>Öğrenci Tablosu</span>
            </a>
          </li>
          <li>
            <a href="not_tablosu.php">
              <i class="bi bi-circle"></i><span>Not Tablosu</span>
            </a>
          </li>
        </ul>
      </li>
   
      <li class="nav-item">
        <a class="nav-link collapsed" href="profil.php" class="active">
          <i class="bi bi-person"></i>
          <span>Profil</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="cikis.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Çıkış Yap</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Ana Sayfa</a></li>
          <li class="breadcrumb-item active">Profil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <h2><?php echo $_SESSION["kullanici"][0]."  ". $_SESSION["kullanici"][1] ?></h2>
              <h3><?php echo $_SESSION["kullanici"][2]?></h3>

            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Kişisel Bilgiler</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Bilgileri Düzenle</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Şifre Değiştir</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">Profil Detayı</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Ad</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION["kullanici"][0] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Soyad</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION["kullanici"][1] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Ünvan</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION["kullanici"][2] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Adres</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION["kullanici"][3] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telefon</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION["kullanici"][4] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $_SESSION["kullanici"][5] ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="" method="POST">
                    
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Ad</label>
                      <div class="col-md-8 col-lg-9">
                        <input readonly name="ad" type="text" class="form-control" id="ad" value="<?php echo $_SESSION["kullanici"][0] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Soyad</label>
                      <div class="col-md-8 col-lg-9">
                        <input readonly name="soyad" type="text" class="form-control" id="soyad" value="<?php echo $_SESSION["kullanici"][1] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Ünvan</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="unvan" type="text" class="form-control" id="unvan" value="<?php echo $_SESSION["kullanici"][2] ?>">
                      </div>
                    </div>
                 
                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Adres</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="adres" type="text" class="form-control" id="adres" value="<?php echo $_SESSION["kullanici"][3] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Telefon</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="telefon" type="text" class="form-control" id="telefon" value="<?php echo $_SESSION["kullanici"][4] ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input readonly name="email" type="email" class="form-control" id="email" value="<?php echo $_SESSION["kullanici"][5] ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="" method="POST">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Eski Şifre</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="eski_sifre" type="password" class="form-control" id="eski_sifre">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Yeni Şifre</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="yeni_sifre" type="password" class="form-control" id="yeni_sifre">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Yeni Şifre Tekrar</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="yeni_sifre_tekrar" type="password" class="form-control" id="yeni_sifre_tekrar">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Şifreyi Değiştir</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; 2022 <strong><span>Karayel Üniversitesi</span></strong>. Tüm Haklar Saklıdır
    </div>
    
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>