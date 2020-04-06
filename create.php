
  <?php
      define("WERDICHLEGALGERUFEN", 1);
      require_once "settings.php";
      require_once "control/con-cocktails.php";
      require_once "control/con-settings.php";

      if(isset($_GET["ID"]))
      {
          $cock = new CCocktails();


          $rec = $cock->get_cocktailReciep($_GET["ID"]);

          foreach($rec as $bottle){
            //exec(GPIO-FILEPATH . "BarMan-gpio.py $bottle['port']");
            usleep(($bottle["ammount"] * $bottle["multi"] * CSettings::get_setting('defaultTime')) * 1000000);
            //exec(GPIO-FILEPATH . "BarMan-gpio.py");
          }
          echo "Cocktail Erstellt! Guten Genuss";
      }
      else if(isset($_GET['CLEAN']))
      {
          $port = 1;
          if(CSettings::get_setting('cleanPortLast') == 1)
          {
            $port = CSettings::get_setting('countPorts');
          }
          //exec(GPIO-FILEPATH . "BarMan-gpio.py $port");
          usleep((CSettings::get_setting('cleanAmmount') * CSettings::get_setting('defaultTime')) * 1000000);
          //exec(GPIO-FILEPATH . "BarMan-gpio.py");
          echo "BarMan gereinigt!";
      }
      else if(isset($_GET['MESSURE']))
      {
            if(isset($_GET["START"]))
            {
                $port = $_GET["START"];
                //exec(GPIO-FILEPATH . "BarMan-gpio.py $port");
            }
            else
            {
               //exec(GPIO-FILEPATH . "BarMan-gpio.py");
            }
      }
      else if(isset($_GET["NOTSTOP"]))
      {
           //exec(GPIO-FILEPATH . "BarMan-gpio.py");
           header("Location: index.php");
      }
      else
      {
          //exec(GPIO-FILEPATH . "BarMan-gpio.py");
          echo "FEHLER - KEIN COCKTAIL AUSGEWAEHLT";
      }
  ?>


