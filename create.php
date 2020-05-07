
  <?php
      define("WERDICHLEGALGERUFEN", 1);
      require_once "settings.php";
      require_once "control/con-cocktails.php";
      require_once "control/con-settings.php";

      var_dump(GPIOFILEPATH);

      if(isset($_GET["ID"]))
      {
          $cock = new CCocktails();


          $rec = $cock->get_cocktailReciep($_GET["ID"]);

          foreach($rec as $bottle){
            exec(GPIOFILEPATH . " " . $bottle['port']);
            usleep(($bottle["ammount"] * $bottle["multi"] * CSettings::get_setting('defaultTime')) * 1000000);
            exec(GPIOFILEPATH);
          }
          echo "Cocktail Erstellt! Guten Genuss";
      }
      else if(isset($_GET['CLEAN']))
      {
          $port = $_GET['CLEAN'];
          $ammount = $_GET['AMMOUNT'];
          exec(GPIOFILEPATH . " $port");
          usleep(($ammount * CSettings::get_setting('defaultTime')) * 1000000);
          exec(GPIOFILEPATH);
          echo "BarMan gereinigt!";
      }
      else if(isset($_GET['MESSURE']))
      {
            if(isset($_GET["START"]))
            {
                $port = $_GET["START"];
                exec(GPIOFILEPATH . " $port");
            }
            else
            {
               exec(GPIOFILEPATH);
            }
      }
      else if(isset($_GET["NOTSTOP"]))
      {
           exec(GPIOFILEPATH);
           header("Location: index.php");
      }
      else if(isset($_GET["STOP"]))
      {
           exec(GPIOFILEPATH);
      }
      else
      {
          exec(GPIOFILEPATH);
          echo "FEHLER - KEIN COCKTAIL AUSGEWAEHLT";
      }
  ?>


