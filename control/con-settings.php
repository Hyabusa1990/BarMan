<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    class CSettings
    {
        public static function get_setting($pKey)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $val = "";

            $statement = $pdo->prepare("SELECT * FROM `settings` WHERE `key` LIKE :KEY;");
            $statement->execute(array(':KEY' => $pKey));
            while($row = $statement->fetch()) {
                $val = $row["value"];
            }
            return $val;
        }

        public static function set_setting($pKey, $pValue)
        {
            $pdo = new PDO('mysql:host=' . DBHOST . ';dbname=' .DB, DBUSER, DBPW, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $val = "";

            $statement = $pdo->prepare("REPLACE INTO `settings` (`key`, `value`) VALUES (:KEY, :VAL);");
            $statement->execute(array(':KEY' => $pKey, ':VAL' => $pValue));
        }
    }
?>