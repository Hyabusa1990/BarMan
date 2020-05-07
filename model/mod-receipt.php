<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    require_once __ROOT__."/control/con-receipt.php";
    require_once __ROOT__."/control/con-settings.php";
    require_once __ROOT__."/control/con-bottle.php";

    class MReceipt
    {

        public static function get_receiptList()
        {
                $receipts = CReceipt::get_receipts();

                echo "<div class=\"row\">\n";
                echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
                echo "      <div class=\"card-body\">\n";
                echo "          <h4>Cocktail Rezepte</h4>";
                echo "            <table class=\"table table-striped\">\n";
                echo "                <tr>\n";
                echo "                    <th>Name</th>\n";
                echo "                    <th>Beschreibung</th>\n";
                echo "                    <th>Bild</th>\n";
                echo "                    <th>w&auml;hlbar</th>\n";
                echo "                    <th>Bearbeiten</th>\n";
                echo "                </tr>\n";
                foreach($receipts as $receipt){
                    echo "                <tr>\n";
                    echo "                    <td>" . $receipt["name"] . "</td>\n";
                    echo "                    <td>" . $receipt["des"] . "</td>\n";
                    echo "                    <td><img height=\"75\" src=\"data:image;base64, " . base64_encode($receipt["picture"]) . "\"/></td>\n";
                    if(CReceipt::check_receiptPosi($receipt["ID"]) > 0){
                        if($receipt['selected']){
                             echo "                    <td><a href=\"receipt.php?unCheckRec=" . $receipt["ID"] . "\" class=\"btn btn-success btn-circle btn-sm\"><i class=\"fas fa-check\"></i></a></td>\n";
                        }
                        else{
                             echo "                    <td><a href=\"receipt.php?checkRec=" . $receipt["ID"] . "\" class=\"btn btn-success btn-circle btn-sm\"></a></td>\n";
                        }
                    }
                    else{
                             MReceipt::uncheck_receipt($receipt["ID"]);
                             $bottles = CReceipt::get_receiptNotBottle($receipt["ID"]);
                             $buffer = "Es fehlen folgende Flaschen:";
                             foreach($bottles as $bot){
                                $buffer = $buffer ." [$bot]";
                             }
                             echo "                    <td><div class=\"btn btn-danger btn-circle btn-sm\"><i class=\"fas fa-times\" data-toggle=\"tooltip\" title=\"$buffer\"></i></div></td>\n";
                    }
                    echo "                    <td><a href=\"receipt.php?editRec=" . $receipt["ID"] . "\" class=\"btn btn-primary btn-icon-split btn-sm\"><span class=\"icon text-white-50\"><i class=\"fas fa-edit\"></i></span><span class=\"text\">Bearbeiten</span></a><br>";
                    echo "                          <a href=\"#\" data-href=\"receipt.php?delRec=" . $receipt["ID"] . "\" data-toggle=\"modal\" data-target=\"#confirm-delete\" class=\"btn btn-danger btn-icon-split btn-sm\"><span class=\"icon text-white-50\"><i class=\"fas fa-trash\"></i></span><span class=\"text\">L&ouml;schen</span></a><br>\n";
                    echo "                    <a href=\"export.php?ID=" . $receipt["ID"] . "\" class=\"btn btn-info btn-icon-split btn-sm\"><span class=\"icon text-white-50\"><i class=\"fas fa-download\"></i></span><span class=\"text\">Exportieren</span></a></td>";
                    echo "                </tr>\n";
                }
                echo "            </table>";
                echo "      </div>\n";
                echo "    </div>\n";
                echo "</div>\n";
        }

        public static function get_receiptCreate()
        {
                $anzPort = CSettings::get_setting("countPorts");
                $bottles = CBottle::get_bottles();
                echo "<div class=\"row\">\n";
                echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
                echo "      <div class=\"card-body\">\n";
                echo "<form class=\"form-horizontal\" enctype=\"multipart/form-data\" action=\"receipt.php?newRec=1\" method=\"post\">\n";
                echo "<fieldset>\n";
                echo "\n";
                echo "<!-- Form Name -->\n";
                echo "<legend>Neues Rezept erstellen</legend>\n";
                echo "\n";
                echo " <!-- Text input-->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"name\">Name des Cocktails</label>\n";
                echo "    <div class=\"col-md-7\">\n";
                echo "    <input id=\"name\" name=\"name\" type=\"text\" placeholder=\"Name\" class=\"form-control input-md\" required=\"\">\n";
                echo "\n";
                echo "    </div>\n";
                echo "</div>\n";
                echo "\n";
                echo "<!-- Textarea -->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"des\">Beschreibung</label>\n";
                echo "    <div class=\"col-md-7\">\n";
                echo "        <textarea class=\"form-control\" id=\"des\" name=\"des\"></textarea>\n";
                echo "    </div>\n";
                echo "</div>\n";
                echo "\n";
                echo "<!-- File Button -->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"picture\">Bild</label>\n";
                echo "    <div class=\"col-md-4\">\n";
                echo "        <input id=\"picture\" name=\"picture\" class=\"input-file\" type=\"file\" accept=\"image/gif, image/jpeg, image/png\">\n";
                echo "    </div>\n";
                echo "</div>";
                echo "<!-- Select Basic -->\n";
                for($i = 1; $i <= $anzPort; $i++){
                    echo "<div class=\"form-group\">\n";
                    echo "    <label class=\"col-md-4 control-label\" for=\"bottle$i\">Zutat $i</label>\n";
                    echo "    <div class=\"col-md-7\">\n";
                    echo "        <select id=\"bottle$i\" name=\"bottle$i\" class=\"form-control\">\n";
                    echo "            <option selected value=\"0\">-- LEER --</option>\n";
                    foreach($bottles as $bottle){
                        echo "            <option value=\"" . $bottle['ID'] . "\">" . $bottle["name"] . "</option>\n";
                    }
                    echo "        </select>\n";
                    echo "    <label class=\"col-md-4 control-label\" for=\"ammount$i\">M&auml;nge in ml f&uuml;r Zutat $i</label>\n";
                    echo "          <input type=\"number\" class=\"form-control\" step=\"1\" name=\"ammount$i\" id=\"ammount$i\" value=\"10\">";
                    echo "    </div>\n";
                    echo "</div>\n";
                    echo "<hr>";

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

        public static function get_receiptEdit($pRecID)
        {
                $anzPort = CSettings::get_setting("countPorts");
                $bottles = CBottle::get_bottles();
                $cocktail = CReceipt::get_cocktail($pRecID);
                $receipts = CReceipt::get_receiptFromCocktail($pRecID);

                echo "<div class=\"row\">\n";
                echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
                echo "      <div class=\"card-body\">\n";
                echo "<form class=\"form-horizontal\" enctype=\"multipart/form-data\" action=\"receipt.php?uptRec=" . $pRecID . "\" method=\"post\">\n";
                echo "<fieldset>\n";
                echo "\n";
                echo "<!-- Form Name -->\n";
                echo "<legend>Rezept - " . $cocktail["name"] . " - bearbeiten</legend>\n";
                echo "\n";
                echo " <!-- Text input-->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"name\">Name des Cocktails</label>\n";
                echo "    <div class=\"col-md-7\">\n";
                echo "    <input id=\"name\" name=\"name\" type=\"text\" placeholder=\"Name\" class=\"form-control input-md\" required=\"\" value=\"" . $cocktail["name"] . "\">\n";
                echo "\n";
                echo "    </div>\n";
                echo "</div>\n";
                echo "\n";
                echo "<!-- Textarea -->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"des\">Beschreibung</label>\n";
                echo "    <div class=\"col-md-7\">\n";
                echo "        <textarea class=\"form-control\" id=\"des\" name=\"des\">" . $cocktail["des"] . "</textarea>\n";
                echo "    </div>\n";
                echo "</div>\n";
                echo "\n";
                echo "<!-- File Button -->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"picture\">Bild</label>\n";
                echo "    <div class=\"col-md-4\">\n";
                echo "<img height=\"75\" src=\"data:image;base64, " . base64_encode($cocktail["picture"]) . "\"/>\n";
                echo "        <input id=\"picture\" name=\"picture\" class=\"input-file\" type=\"file\" accept=\"image/gif, image/jpeg, image/png\">\n";
                echo "    </div>\n";
                echo "</div>";
                echo "<!-- Select Basic -->\n";
                for($i = 1; $i <= $anzPort; $i++){
                    echo "<div class=\"form-group\">\n";
                    echo "    <label class=\"col-md-4 control-label\" for=\"bottle$i\">Zutat $i</label>\n";
                    echo "    <div class=\"col-md-7\">\n";
                    echo "        <select id=\"bottle$i\" name=\"bottle$i\" class=\"form-control\">\n";
                    echo "            <option selected value=\"0\">-- LEER --</option>\n";
                    $ammount = 10;
                    foreach($bottles as $bottle){
                        $inPOS = 0;

                        foreach($receipts as $rec){
                            if($rec["bottles_ID"] == $bottle['ID'] && $rec["order"] == $i){
                                $inPOS = 1;
                                $ammount = $rec["ammount"];
                            }
                        }

                        if($inPOS){
                            echo "            <option value=\"" . $bottle['ID'] . "\" selected>" . $bottle["name"] . "</option>\n";
                        }
                        else{
                            echo "            <option value=\"" . $bottle['ID'] . "\">" . $bottle["name"] . "</option>\n";
                        }
                    }
                    echo "        </select>\n";
                    echo "    <label class=\"col-md-4 control-label\" for=\"ammount$i\">M&auml;nge in ml f&uuml;r Zutat $i</label>\n";
                    echo "          <input type=\"number\" class=\"form-control\" step=\"1\" name=\"ammount$i\" id=\"ammount$i\" value=\"" . $ammount . "\">";
                    echo "    </div>\n";
                    echo "</div>\n";
                    echo "<hr>";

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

        public static function get_receiptImport()
        {
                echo "<div class=\"row\">\n";
                echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
                echo "      <div class=\"card-body\">\n";
                echo "<form class=\"form-horizontal\" enctype=\"multipart/form-data\" action=\"receipt.php?impRec=1\" method=\"post\">\n";
                echo "<fieldset>\n";
                echo "\n";
                echo "<!-- Form Name -->\n";
                echo "<legend>Rezept importieren</legend>\n";
                echo "\n";
                echo "<!-- File Button -->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"importFile\">JSON Datei</label>\n";
                echo "    <div class=\"col-md-4\">\n";
                echo "        <input id=\"importFile\" name=\"importFile\" class=\"input-file\" type=\"file\" accept=\"application/JSON\">\n";
                echo "    </div>\n";
                echo "</div>";
                echo "<!-- Button -->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"\"></label>\n";
                echo "    <div class=\"col-md-4\">\n";
                echo "        <input type=\"submit\" value=\"Importieren\" class=\"btn btn-primary\">\n";
                echo "    </div>\n";
                echo "</div>\n";
                echo "\n";
                echo "</fieldset>\n";
                echo "</form>";
                echo "      </div>\n";
                echo "    </div>\n";
                echo "</div>\n";
        }

        public static function get_importEdit($pJSONData)
        {
                $bottles = CBottle::get_bottles();
                $data = json_decode($pJSONData, TRUE);

                echo "<div class=\"row\">\n";
                echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
                echo "      <div class=\"card-body\">\n";
                echo "<form class=\"form-horizontal\" enctype=\"multipart/form-data\" action=\"receipt.php?newImpRec=1\" method=\"post\">\n";
                echo "<fieldset>\n";
                echo "\n";
                echo "<!-- Form Name -->\n";
                echo "<legend>Rezept - " . $data["name"] . " - importieren</legend>\n";
                echo "\n";
                echo " <!-- Text input-->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"name\">Name des Cocktails</label>\n";
                echo "    <div class=\"col-md-7\">\n";
                echo "    <input id=\"name\" name=\"name\" type=\"text\" placeholder=\"Name\" class=\"form-control input-md\" required=\"\" value=\"" . $data["name"] . "\">\n";
                echo "\n";
                echo "    </div>\n";
                echo "</div>\n";
                echo "\n";
                echo "<!-- Textarea -->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"des\">Beschreibung</label>\n";
                echo "    <div class=\"col-md-7\">\n";
                echo "        <textarea class=\"form-control\" id=\"des\" name=\"des\">" . $data["des"] . "</textarea>\n";
                echo "    </div>\n";
                echo "</div>\n";
                echo "\n";
                echo "<!-- File Button -->\n";
                echo "<div class=\"form-group\">\n";
                echo "    <label class=\"col-md-4 control-label\" for=\"picture\">Bild</label>\n";
                echo "    <div class=\"col-md-4\">\n";
                echo "<img height=\"75\" src=\"data:image;base64, " . $data["picture"] . "\"/>\n";
                echo "        <input id=\"picture\" name=\"picture\" type=\"hidden\" value=\"" . $data["picture"] . "\">\n";
                echo "    </div>\n";
                echo "</div>";
                echo "        <input id=\"countPorts\" name=\"countPorts\" type=\"hidden\" value=\"" . count($data["bottles"]) . "\">\n";
                echo "<!-- Select Basic -->\n";
                for($i = 1; $i <= count($data["bottles"]); $i++){
                    echo "<div class=\"form-group\">\n";
                    echo "    <label class=\"col-md-4 control-label\" for=\"bottle$i\">Zutat $i</label>\n";
                    echo "    <div class=\"col-md-7\">\n";
                    echo "        <select id=\"bottle$i\" name=\"bottle$i\" class=\"form-control\">\n";
                    $ammount = $data["bottles"][$i-1]["ammount"];
                    $exist = 0;
                    foreach($bottles as $bottle){
                        $inPOS = 0;

                        if($data["bottles"][$i-1]["botName"] == $bottle['name'] && $data["bottles"][$i-1]["order"] == $i){
                            $inPOS = 1;
                            $exist = 1;
                        }

                        if($inPOS){
                            echo "            <option value=\"" . $bottle['ID'] . "\" selected>" . $bottle["name"] . "</option>\n";
                        }
                        else{
                            echo "            <option value=\"" . $bottle['ID'] . "\">" . $bottle["name"] . "</option>\n";
                        }
                    }
                    if(!$exist)
                    {
                        echo "            <option selected value=\"0\">" . $data["bottles"][$i-1]["botName"] . "</option>\n";
                    }
                    echo "        </select>\n";
                    echo "    <label class=\"col-md-4 control-label\" for=\"ammount$i\">M&auml;nge in ml f&uuml;r Zutat $i</label>\n";
                    echo "          <input type=\"number\" class=\"form-control\" step=\"1\" name=\"ammount$i\" id=\"ammount$i\" value=\"" . $ammount . "\">";

                    echo "    </div>\n";
                    echo "</div>\n";
                    if(!$exist){
                        echo "<input id=\"multi$i\" name=\"multi$i\" type=\"hidden\" value=\"" . $data["bottles"][$i-1]["multi"] . "\">\n";
                        echo "<input id=\"botName$i\" name=\"botName$i\" type=\"hidden\" value=\"" . $data["bottles"][$i-1]["botName"] . "\">\n";
                        echo "<div class=\"btn btn-warning btn-icon-split\">\n";
                        echo "    <span class=\"icon text-white-50\">\n";
                        echo "        <i class=\"fas fa-exclamation-triangle\"></i>\n";
                        echo "    </span>\n";
                        echo "    <span class=\"text\">Flasche nicht vorhanden! Wird angelegt</span>\n";
                        echo "</div>";
                    }
                    echo "<hr>";

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

        public static function check_receipt($pID){
            if(CReceipt::check_receiptPosi($pID) > 0){
                CReceipt::check_receipt($pID);
              }
        }

        public static function uncheck_receipt($pID){
            CReceipt::uncheck_receipt($pID);
        }

        public static function add_receipt($pPOST, $pFILE){
            $imgData = addslashes(file_get_contents("./cocktail.png"));
            if (count($pFILE) > 0) {
                if (is_uploaded_file($pFILE['picture']['tmp_name'])) {
                    $imgData = addslashes(file_get_contents($pFILE['picture']['tmp_name']));
                }
            }
            $cID = CReceipt::add_coctail($pPOST["name"], $pPOST["des"], $imgData);

            $anzPort = CSettings::get_setting("countPorts");
            for($i = 1; $i <= $anzPort; $i++){
                if(isset($pPOST["bottle$i"])){
                    if($pPOST["bottle$i"] > 0){
                        CReceipt::update_receiptIng($cID, $pPOST["bottle$i"], $pPOST["ammount$i"], $i);
                    }
                }
            }
        }

        public static function import_receipt($pPOST){
            $cID = CReceipt::add_coctail($pPOST["name"], $pPOST["des"], addslashes(base64_decode($pPOST["picture"])));

            $anzPort = $pPOST["countPorts"];
            for($i = 1; $i <= $anzPort; $i++){
                if(isset($pPOST["bottle$i"])){
                    if($pPOST["bottle$i"] > 0){
                        CReceipt::update_receiptIng($cID, $pPOST["bottle$i"], $pPOST["ammount$i"], $i);
                    }
                    else{
                        $bID = CBottle::save_bottle($pPOST["botName$i"], $pPOST["multi$i"]);
                        CReceipt::update_receiptIng($cID, $bID, $pPOST["ammount$i"], $i);
                    }
                }
            }
        }

        public static function update_receipt($pID, $pPOST, $pFILE){
            $imgData = NULL;
            if (count($pFILE) > 0) {
                if (is_uploaded_file($pFILE['picture']['tmp_name'])) {
                    $imgData = addslashes(file_get_contents($pFILE['picture']['tmp_name']));
                }
            }
            CReceipt::update_coctail($pID, $pPOST["name"], $pPOST["des"], $imgData);
            CReceipt::clear_receiptIng($pID);

            $anzPort = CSettings::get_setting("countPorts");
            for($i = 1; $i <= $anzPort; $i++){
                if(isset($pPOST["bottle$i"])){
                    if($pPOST["bottle$i"] > 0){
                        CReceipt::update_receiptIng($pID, $pPOST["bottle$i"], $pPOST["ammount$i"], $i);
                    }
                }
            }
        }

        public static function delete_receipt($pID){
            CReceipt::delete_receipt($pID);
        }
    }
?>

