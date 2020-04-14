<!DOCTYPE html>
<html lang="de">

<head>

  <?php
      define("WERDICHLEGALGERUFEN", 1);
      require_once "settings.php";
      require_once "model/mod-header.php";
      require_once "model/mod-navi.php";
      require_once "model/mod-receipt.php";


      HEADER::GET_HEADER();

      if(isset($_GET)){
        if(isset($_GET["unCheckRec"])){
           MReceipt::uncheck_receipt($_GET["unCheckRec"]);
        }
        else if(isset($_GET["checkRec"])){
           MReceipt::check_receipt($_GET["checkRec"]);
        }
        else if(isset($_GET["newRec"])){
             if(isset($_POST)){
                 MReceipt::add_receipt($_POST, $_FILES);
                echo "            <div class=\"alert alert-success\" role=\"alert\">\n";
                echo "              Rezept angelegt!\n";
                echo "            </div>";
             }
        }
        else if(isset($_GET["uptRec"])){
             if(isset($_POST)){
                 MReceipt::update_receipt($_GET["uptRec"], $_POST, $_FILES);
                echo "            <div class=\"alert alert-success\" role=\"alert\">\n";
                echo "              Rezept gespeichert!\n";
                echo "            </div>";
             }
        }
        else if(isset($_GET['delRec'])){
            MReceipt::delete_receipt($_GET['delRec']);
            echo "            <div class=\"alert alert-success\" role=\"alert\">\n";
            echo "              Rezept gel&ouml;scht!\n";
            echo "            </div>";
            header( "refresh:1;url=receipt.php" );
            exit;
        }
        else if(isset($_GET["newImpRec"])){
             if(isset($_POST)){
                MReceipt::import_receipt($_POST);
                echo "            <div class=\"alert alert-success\" role=\"alert\">\n";
                echo "              Rezept importiert!\n";
                echo "            </div>";
             }
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
          <h1 class="h3 mb-4 text-gray-800">Cocktail/Rezept Verwaltung</h1>

              <?php
              if(isset($_GET["editRec"])){
                MReceipt::get_receiptEdit($_GET["editRec"]);
              }
              else if(isset($_GET["impRec"])){
                if (count($_FILES) > 0) {
                    if (is_uploaded_file($_FILES['importFile']['tmp_name'])) {
                        $jsonData = file_get_contents($_FILES['importFile']['tmp_name']);
                        MReceipt::get_importEdit($jsonData);
                    }
                }
              }
              else{
                MReceipt::get_receiptList();
                MReceipt::get_receiptImport();
                MReceipt::get_receiptCreate();
              }
              ?>

        </div>
        <!-- /.container-fluid -->

      </div>

      <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Rezept L&ouml;schen
                </div>
                <div class="modal-body">
                    M&ouml;chten Sie das Rezept wirklich l&ouml;schen?
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

