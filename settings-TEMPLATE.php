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
    define("DB", "barman-db");
    define("DBUSER", "root");
    define("DBPW", "");

    /*
    *
    * GPIO Vars
    *
    */
    define("GPIOFILEPATH", "C:\TEST\BarMan-gpio.py");

    define("__ROOT__", dirname(__FILE__));

    define("DEBUG", 0);
?>