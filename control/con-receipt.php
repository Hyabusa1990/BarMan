<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    class CReceipt
    {
        public static function get_receipts()
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);
            $receipts = array();

            $statement = $pdo->prepare("SELECT * FROM `cocktails` ORDER BY `name` ASC;");
            $statement->execute();
            while($row = $statement->fetch()) {
                $receipts[] = $row;
            }
            return $receipts;
        }

        public static function check_receipt($pID)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);

            $statement = $pdo->prepare("UPDATE `cocktails` SET `selected`= 1 WHERE `ID` = :ID;");
            $statement->execute(array(":ID" => $pID));
        }

        public static function uncheck_receipt($pID)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);

            $statement = $pdo->prepare("UPDATE `cocktails` SET `selected`= 0 WHERE `ID` = :ID;");
            $statement->execute(array(":ID" => $pID));
        }

        public static function check_receiptPosi($pID)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);

            $pos = 0;
            $statement = $pdo->prepare("SELECT IFNULL(MIN(`bottle`.`port`),0) AS Port FROM `recipe` JOIN `bottle` ON `bottle`.`ID` = `recipe`.`bottles_ID` WHERE `recipe`.`cocktails_ID` = :ID;");
            $statement->execute(array(":ID" => $pID));
            while($row = $statement->fetch()) {
                $pos = $row["Port"];
            }

            return $pos;
        }


    }
?>