<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    require_once __ROOT__."/control/con-receipt.php";
    require_once __ROOT__."/control/con-settings.php";

    class MReceipt
    {

        public static function get_receiptList()
        {
                $receipts = CReceipt::get_receipts();

                echo "<div class=\"row\">\n";
                echo "    <div class=\"card shadow m-9 col-xl-9 col-lg-9 col-sm-9 mb-4\">\n";
                echo "      <div class=\"card-body\">\n";
                echo "          <h4>Flaschen</h4>";
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
                    echo "                    <td>" . utf8_encode($receipt["name"]) . "</td>\n";
                    echo "                    <td>" . utf8_encode($receipt["des"]) . "</td>\n";
                    echo "                    <td><img height=\"75\" src=\"data:image;base64, " .base64_encode($receipt["picture"])."\"/></td>\n";
                    if(CReceipt::check_receiptPosi($receipt["ID"]) > 0){
                        if($receipt['selected']){
                             echo "                    <td><a href=\"receipt.php?unCheckRec=" . $receipt["ID"] . "\"><i class=\"fas fa-check-square\"></i></a></td>\n";
                        }
                        else{
                             echo "                    <td><a href=\"receipt.php?checkRec=" . $receipt["ID"] . "\"><i class=\"fas fa-square\"></i></a></td>\n";
                        }
                    }
                    else{
                             MReceipt::uncheck_receipt($receipt["ID"]);
                             echo "                    <td><div class=\"btn btn-danger btn-circle btn-sm\"><i class=\"fas fa-times\"></i></div></td>\n";
                    }
                    echo "                    <td><a href=\"bottle.php?editRec=" . $receipt["ID"] . "\"><i class=\"fas fa-edit\"></i></a></td>\n";
                    echo "                </tr>\n";
                }
                echo "            </table>";
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
    }
?>

