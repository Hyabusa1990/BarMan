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

        public static function get_cocktail($pID)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);
            $cocktail = "";

            $statement = $pdo->prepare("SELECT * FROM `cocktails` WHERE ID = :ID;");
            $statement->execute(array(":ID" => $pID));
            while($row = $statement->fetch()) {
                $cocktail = $row;
            }
            return $cocktail;
        }

        public static function get_receiptFromCocktail($pID)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);
            $receipe = array();

            $statement = $pdo->prepare("SELECT * FROM `recipe` WHERE `cocktails_ID` = :ID;");
            $statement->execute(array(":ID" => $pID));
            while($row = $statement->fetch()) {
                $receipe[] = $row;
            }
            return $receipe;
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

        public static function add_coctail($pName, $pDes, $pImg)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' . DB . ';charset=utf8', DBUSER, DBPW);

            if(is_null($pImg)){
                $statement = $pdo->prepare("INSERT INTO `cocktails` (`name`, `des`, `selected`) VALUES (:NAME, :DES, b'0');");
            }
            else{
                $statement = $pdo->prepare("INSERT INTO `cocktails` (`name`, `des`, `picture`, `selected`) VALUES (:NAME, :DES, '$pImg', b'0');");
            }
            $statement->execute(array(":NAME" => $pName, ":DES" => $pDes));

            return $pdo->lastInsertId();
        }

        public static function update_receiptIng($pCoctailID, $pBottleID, $pAmmoun, $pOrder)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);
            $statement = $pdo->prepare("DELETE FROM `recipe` WHERE `recipe`.`cocktails_ID` = :COCKID;");
            $statement->execute(array(":COCKID" => $pCoctailID));
            $statement = $pdo->prepare("INSERT INTO `recipe` (`cocktails_ID`, `bottles_ID`, `ammount`, `order`) VALUES (:COCKID, :BOTID, :AMMO, :ORDER);");
            $statement->execute(array(":COCKID" => $pCoctailID, ":BOTID" => $pBottleID, ":AMMO" => $pAmmoun, ":ORDER" => $pOrder));
        }

        public static function update_coctail($pID, $pName, $pDes, $pImg)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' . DB . ';charset=utf8', DBUSER, DBPW);
            if(is_null($pImg)){
                $statement = $pdo->prepare("UPDATE `cocktails` SET `name`=:NAME ,`des`=:DES WHERE `ID` = :ID");
            }
            else{
                $statement = $pdo->prepare("UPDATE `cocktails` SET `name`=:NAME ,`des`=:DES ,`picture`='$pImg' WHERE `ID` = :ID");
            }
            $statement->execute(array(":ID" => $pID, ":NAME" => $pName, ":DES" => $pDes));
        }

        public static function delete_receipt($pID)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW);

            $statement = $pdo->prepare("DELETE FROM `cocktails` WHERE `cocktails`.`ID` = :ID");
            $statement->execute(array(":ID" => $pID));
        }

    }
?>