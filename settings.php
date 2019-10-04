<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    /*
    *
    * Database Vars
    *
    */
    define("DBHOST", "localhost");
    define("DB", "barman");
    define("DBUSER", "BarMan");
    define("DBPW", "BarMan");

    /*
    *
    * GPIO Vars
    *
    */
    define("GPIO-FILEPATH", "C:\TEST");

    define("__ROOT__", dirname(__FILE__));
?>