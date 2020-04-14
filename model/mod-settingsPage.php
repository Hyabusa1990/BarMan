<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    require_once __ROOT__."/control/con-settings.php";

    class MSettings
    {
        public static function get_ammounCard(){
            echo "<div class=\"row\">\n";
            echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
            echo "      <div class=\"card-body\">\n";
            echo "          <h2>Standardzeit einstellen</h2>\n";
            echo "<form class=\"form-inline\" action=\"settingsPage.php\" method=\"GET\" >\n";
            echo "      <input type=\"hidden\" name=\"setSet\" value=\"defaultTime\">\n";
            echo "    <div class=\"form-group mx-sm-3 mb-2\">\n";
            echo "          <label for=\"valueTime\">Standardzeit f&uuml;r Wasser in Sekunden f&uuml;r 1ml:&nbsp;</label>\n";
            echo "        <input type=\"number\" class=\"form-control\" step=any name=\"valueTime\" id=\"valueTime\" value=\"" . CSettings::get_setting("defaultTime") . "\">\n";
            echo "    </div>\n";
            echo "    <input type=\"submit\" value=\"Speichern\" class=\"btn btn-primary mb-2\"></input>\n";
            echo "</form>";
            echo "<hr>\n";
            echo "<h3>Stoppuhr</h3><p>Flasche mit entsprechendem Inhalt an Position 1 anschlie&szlig;en</p>\n";
            echo "<button onclick=\"stoppuhr.start(10);\" class=\"btn btn-info\">Start 10ml</button>\n";
            echo "<button onclick=\"stoppuhr.start(20);\" class=\"btn btn-info\">Start 20ml</button>\n";
            echo "<button onclick=\"stoppuhr.start(50);\" class=\"btn btn-info\">Start 50ml</button>\n";
            echo "<button onclick=\"stoppuhr.start(100);\" class=\"btn btn-info\">Start 100ml</button>\n";
            echo "<button onclick=\"stoppuhr.start(250);\" class=\"btn btn-info\">Start 250ml</button><br><br>\n";
            echo "<button onclick=\"stoppuhr.stop();\" class=\"btn btn-danger\">Stop</button>";
            echo "<hr>\n";
            echo "      </div>\n";
            echo "    </div>\n";
            echo "</div>\n";
        }

        public static function get_bottleCard(){
            echo "<div class=\"row\">\n";
            echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
            echo "      <div class=\"card-body\">\n";
            echo "          <h2>Anzahl Flaschen</h2>\n";
            echo "<form class=\"form-inline\" action=\"settingsPage.php\" method=\"GET\" >\n";
            echo "      <input type=\"hidden\" name=\"setSet\" value=\"countPorts\">\n";
            echo "    <div class=\"form-group mx-sm-3 mb-2\">\n";
            echo "          <label for=\"valueTime\">Anzahl Flaschen:&nbsp;</label>\n";
            echo "        <input type=\"number\" class=\"form-control\" step=\"1\" min=\"1\" name=\"valueTime\" id=\"valueTime\" value=\"" . CSettings::get_setting("countPorts") . "\">\n";
            echo "    </div>\n";
            echo "    <input type=\"submit\" value=\"Speichern\" class=\"btn btn-primary mb-2\"></input>\n";
            echo "</form>";
            echo "      </div>\n";
            echo "    </div>\n";
            echo "</div>\n";
        }

         public static function get_cleanCard(){
            echo "<div class=\"row\">\n";
            echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
            echo "      <div class=\"card-body\">\n";
            echo "          <h2>Reinigen</h2>\n";;
            echo "    <div class=\"form-group mx-sm-3 mb-2\">\n";
            echo "          <label for=\"cleanPort\">Flasche:&nbsp;</label>\n";
            echo "        <input type=\"number\" class=\"form-control\" step=\"1\" min=\"1\" max=\"" . CSettings::get_setting("countPorts") . "\" name=\"cleanPort\" id=\"cleanPort\" value=\"1\">\n";
            echo "    </div>\n";
            echo "<button onclick=\"clean.start(10);\" class=\"btn btn-info\">Reinigen 10ml</button>\n";
            echo "<button onclick=\"clean.start(20);\" class=\"btn btn-info\">Reinigen 20ml</button>\n";
            echo "<button onclick=\"clean.start(50);\" class=\"btn btn-info\">Reinigen 50ml</button>\n";
            echo "<button onclick=\"clean.start(100);\" class=\"btn btn-info\">Reinigen 100ml</button>\n";
            echo "<button onclick=\"clean.start(250);\" class=\"btn btn-info\">Reinigen 250ml</button><br><br>\n";
            echo "<button onclick=\"clean.stop();\" class=\"btn btn-danger\">Stop</button>";
            echo "      </div>\n";
            echo "    </div>\n";
            echo "</div>\n";
        }

        public static function update_setting($pKey, $pValue)
        {
              CSettings::set_setting($pKey, $pValue);
        }
    }
?>

