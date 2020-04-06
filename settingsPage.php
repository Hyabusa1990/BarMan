<!DOCTYPE html>
<html lang="de">

<head>

  <?php
      define("WERDICHLEGALGERUFEN", 1);
      require_once "settings.php";
      require_once "model/mod-header.php";
      require_once "model/mod-navi.php";
      require_once "model/mod-bottle.php";


      HEADER::GET_HEADER();

      if(isset($_GET)){
        if(isset($_GET["uptBot"])){
            MBottle::update_bottle($_GET['uptBot'], $_GET['name'], $_GET['multi']);
            echo "            <div class=\"alert alert-success\" role=\"alert\">\n";
            echo "              Flasche gespeichert!\n";
            echo "            </div>";
        }
        else if(isset($_GET["addBot"])){
            MBottle::add_bottle($_GET['name'], $_GET['multi']);
            echo "            <div class=\"alert alert-success\" role=\"alert\">\n";
            echo "              Flasche gespeichert!\n";
            echo "            </div>";
        }
        else if(isset($_GET["bottle1"])){
            MBottle::save_bottle($_GET);
        }
      }
  ?>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

     <?php
        NAVI::GET_NAVI();
     ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Flaschen Verwaltung</h1>

              <?php
              if(isset($_GET["editBot"])){
                MBottle::get_bottleList($_GET['editBot']);
              }
              else{
                MBottle::get_bottlePortSelect();
                MBottle::get_bottleList();
              }

              ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Loading Box -->

</body>

</html>

