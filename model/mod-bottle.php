<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    require_once __ROOT__."/control/con-bottle.php";
    require_once __ROOT__."/control/con-settings.php";

    class MBottle
    {
        public static function get_bottlePortSelect()
        {
                $anzPort = CSettings::get_setting("countPorts");
                $bottles = CBottle::get_bottles();
                echo "<div class=\"row\">\n";
                echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
                echo "      <div class=\"card-body\">\n";
                echo "<form class=\"form-horizontal\">\n";
                echo "<fieldset>\n";
                echo "\n";
                echo "<!-- Form Name -->\n";
                echo "<legend>Flaschenzuordnung</legend>\n";
                echo "\n";
                echo "<!-- Select Basic -->\n";
                for($i = 1; $i <= $anzPort; $i++){
                    echo "<div class=\"form-group\">\n";
                    echo "    <label class=\"col-md-4 control-label\" for=\"bottle$i\">Inhalt Flasche $i</label>\n";
                    echo "    <div class=\"col-md-5\">\n";
                    echo "        <select id=\"bottle$i\" name=\"bottle$i\" class=\"form-control\">\n";
                    echo "            <option value=\"0\">-- LEER --</option>\n";
                    foreach($bottles as $bottle){
                        if($bottle["port"] == $i){
                            echo "            <option selected value=\"" . $bottle['ID'] . "\">" . utf8_encode($bottle["name"]) . "</option>\n";
                        }
                        else{
                            echo "            <option value=\"" . $bottle['ID'] . "\">" . utf8_encode($bottle["name"]) . "</option>\n";
                        }
                    }
                    echo "        </select>\n";
                    echo "    </div>\n";
                    echo "</div>\n";
                }
                echo "\n";
                echo "<!-- Button -->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"\"></label>\n";
                echo "    <div class=\"col-md-4\">\n";
                echo "        <input type=\"submit\" value=\"Speichern\" class=\"btn btn-primary\">\n";
                echo "    </div>\n";
                echo "</div>\n";
                echo "\n";
                echo "</fieldset>\n";
                echo "</form>";
                echo "      </div>\n";
                echo "    </div>\n";
                echo "</div>\n";
        }

        public static function get_bottleList($pBotID = 0)
        {
                $bottles = CBottle::get_bottles();

                echo "<div class=\"row\">\n";
                echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
                echo "      <div class=\"card-body\">\n";
                if($pBotID > 0){
                    $bottle = CBottle::get_bottle($pBotID);
                    echo "<form class=\"form-inline\" action=\"bottle.php\" method=\"GET\" >\n";
                    echo "    <div class=\"form-group mb-2\">\n";
                    echo "        <input type=\"hidden\" class=\"form-control\" name=\"uptBot\" id=\"uptBot\" value=\"" . $bottle['ID'] . "\">\n";
                    echo "          <label for=\"name\">Flaschenname:&nbsp;</label>\n";
                    echo "        <input type=\"text\" class=\"form-control\" name=\"name\" id=\"name\" value=\"" . utf8_encode($bottle['name']) . "\">\n";
                    echo "    </div>\n";
                    echo "    <div class=\"form-group mx-sm-3 mb-2\">\n";
                    echo "          <label for=\"multi\">Multiplikator:&nbsp;</label>\n";
                    echo "        <input type=\"number\" class=\"form-control\" step=any name=\"multi\" id=\"multi\" value=\"" . $bottle['multi'] . "\">\n";
                    echo "    </div>\n";
                    echo "    <input type=\"submit\" value=\"Speichern\" class=\"btn btn-primary mb-2\"></input>\n";
                    echo "</form>";
                    echo "<hr>\n";
                }
                else{
                    echo "<form class=\"form-inline\" action=\"bottle.php\" method=\"GET\" >\n";
                    echo "    <div class=\"form-group mb-2\">\n";
                    echo "        <input type=\"hidden\" class=\"form-control\" name=\"addBot\" id=\"addBot\" value=\"1\">\n";
                    echo "          <label for=\"name\">Flaschenname:&nbsp;</label>\n";
                    echo "        <input type=\"text\" class=\"form-control\" name=\"name\" id=\"name\" placeholder=\"name\">\n";
                    echo "    </div>\n";
                    echo "    <div class=\"form-group mx-sm-3 mb-2\">\n";
                    echo "          <label for=\"multi\">Multiplikator:&nbsp;</label>\n";
                    echo "        <input type=\"number\" class=\"form-control\" step=any name=\"multi\" id=\"multi\" value=\"1.0\">\n";
                    echo "    </div>\n";
                    echo "    <input type=\"submit\" value=\"Hinzuf&uuml;gen\" class=\"btn btn-primary mb-2\"></input>\n";
                    echo "</form>";
                }
                echo "<hr>\n";
                echo "<h3>Multiplikator Messen</h3><p>Flasche mit entsprechendem Inhalt an Position 1 anschlie&szlig;en</p>\n";
                echo "<button onclick=\"stoppuhr.start(10);\" class=\"btn btn-info\">Start 10ml</button>\n";
                echo "<button onclick=\"stoppuhr.start(20);\" class=\"btn btn-info\">Start 20ml</button>\n";
                echo "<button onclick=\"stoppuhr.start(50);\" class=\"btn btn-info\">Start 50ml</button>\n";
                echo "<button onclick=\"stoppuhr.start(100);\" class=\"btn btn-info\">Start 100ml</button>\n";
                echo "<button onclick=\"stoppuhr.start(250);\" class=\"btn btn-info\">Start 250ml</button><br><br>\n";
                echo "<button onclick=\"stoppuhr.stop();\" class=\"btn btn-danger\">Stop</button>";
                echo "<hr>\n";
                echo "          <h4>Flaschen</h4>";
                echo "            <table class=\"table table-striped\">\n";
                echo "                <tr>\n";
                echo "                    <th>Name</th>\n";
                echo "                    <th>Multiplikator</th>\n";
                echo "                    <th>Bearbeiten</th>\n";
                echo "                </tr>\n";
                foreach($bottles as $bottle){
                    echo "                <tr>\n";
                    echo "                    <td>" . utf8_encode($bottle["name"]) . "</td>\n";
                    echo "                    <td>" . $bottle["multi"] . "</td>\n";
//                    echo "                    <td><a href=\"bottle.php?editBot=" . $bottle["ID"] . "\"><i class=\"fas fa-edit\"></i></a></td>\n";
                    echo "                    <td><a href=\"bottle.php?editBot=" . $bottle["ID"] . "\" class=\"btn btn-primary btn-icon-split btn-sm\"><span class=\"icon text-white-50\"><i class=\"fas fa-edit\"></i></span><span class=\"text\">Bearbeiten</span></a><br>";
                    echo "                          <a href=\"#\" data-href=\"bottle.php?delBot=" . $bottle["ID"] . "\" data-toggle=\"modal\" data-target=\"#confirm-delete\" class=\"btn btn-danger btn-icon-split btn-sm\"><span class=\"icon text-white-50\"><i class=\"fas fa-trash\"></i></span><span class=\"text\">L&ouml;schen</span></a></td>\n";
                    echo "                </tr>\n";
                }
                echo "            </table>";
                echo "      </div>\n";
                echo "    </div>\n";
                echo "</div>\n";
        }

        public static function get_TimerScript(){
            $defaultTime = CSettings::get_setting("defaultTime");
            echo "<script>\n";
            echo "function idset(id, string) {\n";
            echo "    document.getElementById(id).value = string;\n";
            echo "}\n";
            echo "\n";
            echo "var stoppuhr = (function() {\n";
            echo "    var xhttp = new XMLHttpRequest();\n";
            echo "    var stop = 1;\n";
            echo "    var secs = 0;\n";
            echo "    var msecs = 0;\n";
            echo "    var timePerMl = 0;\n";
            echo "    var ml = 0;\n";
            echo "    return {\n";
            echo "        start: function(pML) {\n";
            echo "            ml = pML;\n";
            echo "            stoppuhr.clear();\n";
            echo "            stop = 0;\n";
            echo "            xhttp.open(\"GET\", \"create.php?MESSURE=1&START=1\", true);\n";
            echo "            xhttp.send();\n";
            echo "        },\n";
            echo "        stop: function() {\n";
            echo "            stop = 1;\n";
            echo "            xhttp.open(\"GET\", \"create.php?MESSURE=1&STOP=1\", true);\n";
            echo "            xhttp.send();\n";
            echo "        },\n";
            echo "        clear: function() {\n";
            echo "            stoppuhr.stop();\n";
            echo "            secs = 0;\n";
            echo "            msecs = 0;\n";
            echo "            stoppuhr.html();\n";
            echo "        },\n";
            echo "        timer: function() {\n";
            echo "            if (stop === 0) {\n";
            echo "                msecs++;\n";
            echo "                if (msecs === 10) {\n";
            echo "                    secs ++;\n";
            echo "                    msecs = 0;\n";
            echo "                }\n";
            echo "                stoppuhr.html();\n";
            echo "            }\n";
            echo "        },\n";
            echo "        html: function() {\n";
            echo "            timePerMl = ((secs*10+msecs) / (ml * 10 * " . $defaultTime ."));\n";
            echo "            idset(\"multi\", (timePerMl).toFixed(2));\n";
            echo "            //idset(\"multi\", secs + \".\" + msecs);\n";
            echo "        }\n";
            echo "    }\n";
            echo "})();\n";
            echo "setInterval(stoppuhr.timer, 100);\n";
            echo "</script>";
        }

        public static function save_bottle($pGET)
        {
            $anzPort = CSettings::get_setting("countPorts");
            CBottle::release_bottlePos();
            for($i = 1; $i <= $anzPort; $i++){
                if(isset($pGET["bottle$i"])){
                    CBottle::save_bottlePos($pGET["bottle$i"], $i);
                }
            }
        }

        public static function add_bottle($pName, $pMulti)
        {
            CBottle::save_bottle($pName, $pMulti);
        }

        public static function update_bottle($pID, $pName, $pMulti)
        {
            CBottle::update_bottle($pID, $pName, $pMulti);
        }

        public static function delete_bottle($pID){
            return CBottle::delelte_bottle($pID);
        }
    }
?>

