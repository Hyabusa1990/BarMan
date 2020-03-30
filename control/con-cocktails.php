<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    class CCocktails
    {
        public function get_cocktailsSelected()
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);
            $cocktails = array();

            $statement = $pdo->prepare("SELECT * FROM `cocktails` WHERE `selected` = 1 ORDER BY `name` ASC;");
            $statement->execute(/*array('Max', 'Mustermann')*/);
            while($row = $statement->fetch()) {
                $cocktails[] = $row;
            }
            return $cocktails;
        }

        public function get_cocktails()
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);
            $cocktails = array();

            $statement = $pdo->prepare("SELECT * FROM `cocktails` ORDER BY `name` ASC;");
            $statement->execute(/*array('Max', 'Mustermann')*/);
            while($row = $statement->fetch()) {
                $cocktails[] = $row;
            }
            return $cocktails;
        }

        public function get_cocktailReciep($pID)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);
            $cocktails = array();

            $statement = $pdo->prepare("SELECT `recipe`.`ammount` AS ammount, `bottle`.`multi` AS multi, `bottle`.`port` AS port FROM `recipe` LEFT JOIN `bottle` ON `recipe`.`bottles_ID` = `bottle`.`ID` WHERE `recipe`.`cocktails_ID` = :ID ORDER BY `recipe`.`order` ASC;");
            $statement->execute(array(':ID' => $pID));
            while($row = $statement->fetch()) {
                $cocktails[] = $row;
            }
            return $cocktails;
        }
    }
?>