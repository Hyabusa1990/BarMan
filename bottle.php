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
            echo "              Flasche angelegt!\n";
            echo "            </div>";
        }
        else if(isset($_GET["delBot"])){
            $stat = MBottle::delete_bottle($_GET["delBot"]);
            if($stat["STATUS"] == "OK"){
                echo "            <div class=\"alert alert-success\" role=\"alert\">\n";
                echo "              Flasche gel&ouml;scht!\n";
                echo "            </div>";
            }
            else{
                if(DEBUG){
                    echo "            <div class=\"alert alert-danger\" role=\"alert\">\n";
                    echo "              " . $stat["MSG"] . "\n";
                    echo "            </div>";
                }
                else{
                    echo "            <div class=\"alert alert-danger\" role=\"alert\">\n";
                    echo "              Flasche wird noch in Rezept verwendet!\n";
                    echo "            </div>";
                }
            }
        }
        else if(isset($_GET["bottle1"])){
            MBottle::save_bottle($_GET);
        }
      }

      MBottle::get_TimerScript();
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
      <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Flasche L&ouml;schen
                </div>
                <div class="modal-body">
                    M&ouml;chten Sie die Flasche wirklich l&ouml;schen?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Abbruch</button>
                    <a class="btn btn-danger btn-ok">L&ouml;schen</a>
                </div>
            </div>
        </div>
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

  <script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
  </script>
  <!-- Loading Box -->

</body>

</html>

