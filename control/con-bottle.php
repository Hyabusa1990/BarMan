<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    class CBottle
    {
        public static function get_bottles()
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $bottles = array();

            $statement = $pdo->prepare("SELECT * FROM `bottle` ORDER BY `name` ASC;");
            $statement->execute();
            while($row = $statement->fetch()) {
                $bottles[] = $row;
            }
            return $bottles;
        }

        public static function get_bottle($pID)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $bottle = array();

            $statement = $pdo->prepare("SELECT * FROM `bottle` WHERE `ID` = :ID;");
            $statement->execute(array("ID" => $pID));
            while($row = $statement->fetch()) {
                $bottle = $row;
            }
            return $bottle;
        }

        /*public static function get_bottleFromName($pName)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $bottle = NULL;

            $statement = $pdo->prepare("SELECT * FROM `bottle` WHERE `name` LIKE :NAME;");
            $statement->execute(array("NAME" => $pName));
            while($row = $statement->fetch()) {
                $bottle = $row;
            }
            return $bottle;
        } */

        public static function release_bottlePos()
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            $statement = $pdo->prepare("UPDATE `bottle` SET `port`= 0;");
            $statement->execute();
        }

        public static function save_bottlePos($pID, $pPort)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            $statement = $pdo->prepare("UPDATE `bottle` SET `port`= :PORT WHERE `ID` = :ID;");
            $statement->execute(array(":PORT" => $pPort, ":ID" => $pID));
        }

        public static function update_bottle($pID, $pName, $pMulti)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            $statement = $pdo->prepare("UPDATE `bottle` SET `name` = :NAME, `multi` = :MULTI WHERE `bottle`.`ID` = :ID;");
            $statement->execute(array(":NAME" => $pName, ":ID" => $pID, ':MULTI' => $pMulti));
        }

        public static function save_bottle($pName, $pMulti)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $statement = $pdo->prepare("INSERT INTO `bottle` (`name`, `multi`, `port`) VALUES (:NAME, :MULTI, '0');");
            $statement->execute(array(":NAME" => $pName, ":MULTI" => $pMulti));
            return $pdo->lastInsertId();
        }

        public static function delelte_bottle($pID)
        {
            try{
                $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $pdo->prepare("DELETE FROM `bottle` WHERE `bottle`.`ID` = :ID;");
                $statement->execute(array(":ID" => $pID));
                return array("STATUS"=>"OK", "MSG"=>"");
            }
            catch (PDOException $e){
                return array("STATUS"=>"ERROR", "MSG"=>$e->getMessage());
            }

        }
    }
?>