<!DOCTYPE html>
<html lang="de">

<head>

  <?php
      define("WERDICHLEGALGERUFEN", 1);
      require_once "settings.php";
      require_once "model/mod-header.php";
      require_once "model/mod-navi.php";
      require_once "model/mod-settingsPage.php";


      HEADER::GET_HEADER();

      if(isset($_GET)){
        if(isset($_GET["setSet"])){
           MSettings::update_setting($_GET["setSet"], $_GET["valueTime"]);
           echo "            <div class=\"alert alert-success\" role=\"alert\">\n";
           echo "              Einstellung gespeichert!\n";
           echo "            </div>";
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
          <h1 class="h3 mb-4 text-gray-800">Einstellungen</h1>

              <?php
                MSettings::get_ammounCard();
                MSettings::get_bottleCard();
                Msettings::get_cleanCard();
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

  <script>
function idset(id, string) {
    document.getElementById(id).value = string;
}

function idget(id) {
    var inputValue = document.getElementById(id).value;
    return inputValue;
}

var clean = (function() {
    var xhttp = new XMLHttpRequest();
    return {
        start: function(pML) {
            var ml = pML;
            var port = idget("cleanPort");
            console.log("Start Reinigen");
            console.log("create.php?CLEAN=" + port + "&AMMOUNT=" + ml);
            xhttp.open("GET", "create.php?CLEAN=" + port + "&AMMOUNT=" + ml, true);
            xhttp.send();
        },
        stop: function() {
            console.log("Stopp Reinigen");
            xhttp.open("GET", "create.php?STOP=1", true);
            xhttp.send();
        },
    }
})();

var stoppuhr = (function() {
    var xhttp = new XMLHttpRequest();
    var stop = 1;
    var secs = 0;
    var msecs = 0;
    var timePerMl = 0;
    var ml = 0;
    return {
        start: function(pML) {
            ml = pML;
            stoppuhr.clear();
            stop = 0;
            xhttp.open("GET", "create.php?MESSURE=1&START=1", true);
            xhttp.send();
        },
        stop: function() {
            stop = 1;
            xhttp.open("GET", "create.php?MESSURE=1&STOP=1", true);
            xhttp.send();
        },
        clear: function() {
            stoppuhr.stop();
            secs = 0;
            msecs = 0;
            stoppuhr.html();
        },
        timer: function() {
            if (stop === 0) {
                msecs++;
                if (msecs === 10) {
                    secs ++;
                    msecs = 0;
                }
                stoppuhr.html();
            }
        },
        html: function() {
            timePerMl = (secs*1000+msecs) / ml;
            idset("valueTime", (timePerMl / 1000).toFixed(2));
            //idset("timer", secs + "." + msecs);
        }
    }
})();
setInterval(stoppuhr.timer, 100);
</script>

  <!-- Loading Box -->

</body>

</html>

