<?php
  require_once("islemler.php");
  $islem = new Islemler();
  
  if ($_SESSION["giris"] != sha1(md5("var"))){
    header("Location: cikis.php");
  }

  if(isset($_GET["csv"])){
    $mesaj = $islem->ogrenciler_csv();
    echo "<script> alert('$mesaj') </script>";
  }

  if(isset($_GET["silinecek"])){
    $okul_no = $_GET["silinecek"];
   
    $mesaj = $islem->kayit_sil($okul_no);
    
    echo "<script> alert('$mesaj') </script>";     
      
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Öğrenci Tablosu</title>
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
          <i class="bi bi-journal-text"></i><span>Veri Girişi</span><i class="bi bi-chevron-down ms-auto"></i>
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
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link " data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tablolar</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="ogrenci_tablosu.php" class="active">
              <i class="bi bi-circle"></i><span>Öğrenci Tablosu</span>
            </a>
          </li>
          <li>
            <a href="not_tablosu.php">
              <i class="bi bi-circle"></i><span>Not Tablosu</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->
   
      <li class="nav-item">
        <a class="nav-link collapsed" href="profil.php">
          <i class="bi bi-person"></i>
          <span>Profil</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="cikis.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Çıkış Yap</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Tablolar</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Ana Sayfa</a></li>
          <li class="breadcrumb-item">Tablolar</li>
          <li class="breadcrumb-item active">Öğrenci Tablosu</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">      
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Öğrenciler</h5>             
              <!-- Bordered Table -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Soyad</th>
                    <th scope="col">TC Kimlik No</th>
                    <th scope="col">Bölüm</th>              
                    <th scope="col">Sınıf</th>
                    <th scope="col">Okul No</th>
                    <th scope="col">Cinsiyet</th>
                    <th scope="col">Doğum Tarihi</th>
                    <th scope="col">İşlem</th>
                  </tr>
                </thead>
                <tbody>     
                  <?php 
                    foreach($islem->ogrenci_tablosu() as $row){
                      echo
                      "<tr>
                          <td>".$row['id']."</td>
                          <td>".$row['ad']."</td>
                          <td>".$row['soyad']."</td>
                          <td>".$row['tckimlik']."</td>
                          <td>".$row['bolum']."</td>
                          <td>".$row['sinif']."</td>
                          <td>".$row['okul_no']."</td>
                          <td>".$row['cinsiyet']."</td>
                          <td>".$row['dogum_tarihi']."</td>                  
                          <td><a href='ogrenci_tablosu.php?silinecek=".$row['okul_no']."' class='btn btn-danger btn-sm'>Kaydı Sil</a></td>
                      </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
              <a href="ogrenci_tablosu.php?csv=''" class="btn btn-primary"><i class="bi bi-folder"></i> CSV Dosyasına Aktar</a>
              <!-- End Bordered Table -->

            </div>
          </div>        
    
      </div>
    </section>

  </main><!-- End #main -->

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