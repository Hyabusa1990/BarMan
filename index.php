<!DOCTYPE html>
<html lang="de">

<head>

  <?php
      define("WERDICHLEGALGERUFEN", 1);
      require_once "settings.php";
      require_once "model/mod-header.php";
      require_once "model/mod-naviCocktails.php";
      require_once "model/mod-cocktails.php";


      HEADER::GET_HEADER();
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
          <h1 class="h3 mb-4 text-gray-800">BarMan</h1>
          <div class="row">

            <?php
              $cock = new MCocktails();
              $cock->get_cocktails();
            ?>
            <!-- Modal -->
               <div class="modal fade" id="empModalCreate" role="dialog">
                <div class="modal-dialog modal-dialog-centered">

                 <!-- Modal content-->
                 <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Cocktail wird erstellt</h4>
                  </div>
                  <div class="modal-body">

                  </div>
                  <div class="modal-footer">
                      <a href="create.php?NOTSTOP=1" class="btn btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-times-circle"></i></span><span class="text">STOPP</span></a>
                  </div>
                 </div>
                </div>
               </div>
               <!-- Modal -->
               <div class="modal fade" id="empModalFinish" role="dialog">
                <div class="modal-dialog modal-dialog-centered">

                 <!-- Modal content-->
                 <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Fertig</h4>
                  </div>
                  <div class="modal-body">

                  </div>
                  <div class="modal-footer">
                  </div>
                 </div>
                </div>
               </div>
          </div>

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
  <script>
        $(document).ready(function(){

         $('.cocktail').click(function(){
           var id = this.id;

           // AJAX request
           $.ajax({
            url: 'create.php',
            type: 'get',
            data: {ID: id},
            beforeSend: function(){
              // Add response in Modal body
              $('.modal-body').html("<i class=\"fa fa-glass-martini-alt fa-spin fa-3x fa-fw\"></i>");
              $('.modal-title').html("Cocktail wird erstellt");
              $('#empModalCreate').modal({backdrop: "static", keyboard: false});

              // Display Modal
              $('#empModalCreate').modal('show');
            },
            success: function(response){
              // Add response in Modal body
              //$('#empModal').modal({backdrop: true, keyboard: true})
              $('#empModalCreate').modal('hide');
              $('.modal-body').html(response);
              $('.modal-title').html("Fertig");
              $('.modal-footer').html("<button type=\"button\" class=\"btn btn-success\" data-dismiss=\"modal\">Close</button>");

              // Display Modal
              $('#empModalFinish').modal('show');
            }
          });
         });
        });
  </script>

</body>

</html>

