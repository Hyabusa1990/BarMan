<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    class CCocktails
    {
        public function get_cocktails()
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);
            $cocktails = array();

            $statement = $pdo->prepare("SELECT * FROM cocktails;");
            $statement->execute(/*array('Max', 'Mustermann')*/);
            while($row = $statement->fetch()) {
                $cocktails[] = $row;
            }
            return $cocktails;
        }
    }
?>