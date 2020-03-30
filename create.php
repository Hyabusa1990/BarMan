
  <?php
      define("WERDICHLEGALGERUFEN", 1);
      require_once "settings.php";
      require_once "control/con-cocktails.php";

      if(isset($_GET["ID"])){
          $cock = new CCocktails();


          $rec = $cock->get_cocktailReciep($_GET["ID"]);

          foreach($rec as $bottle){
            usleep(($bottle["ammount"] * $bottle["multi"] * 1) * 10000);
          }
          //exec(GPIO-FILEPATH . "BarMan-gpio.py $pin $time")
          //exec("ping -n 5 127.0.0.1");
          echo "Cocktail Erstellt! Guten Genuss";
      }
      else{
          echo "FEHLER - KEIN COCKTAIL AUSGEWAEHLT";
      }
  ?>


