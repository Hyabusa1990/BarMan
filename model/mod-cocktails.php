<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }

    require_once __ROOT__."/control/con-cocktails.php";

    class MCocktails
    {
        public function get_cocktails()
        {
            $coc = new CCocktails();
            $buffer = $coc->get_cocktailsSelected();
            foreach($buffer as $cocktail){
                echo "    <div class=\"card shadow m-1 col-xl-2 col-lg-3 col-sm-6 cocktail\" id=\"" . $cocktail["ID"] . "\">\n";
                echo "    <div class=\"card-header py-3\">\n";
                echo "        <h6 class=\"m-0 font-weight-bold text-primary\">".utf8_encode($cocktail["name"])."</h6>\n";
                echo "    </div>\n";
                echo "    <div class=\"card-body\">\n";
                echo "    <a href=\"#\">\n";
                echo "    <img class=\"card-img-top\" src=\"data:image;base64, " .base64_encode($cocktail["picture"])."\"/>\n";
                echo utf8_encode($cocktail["des"]) ;
                echo "    </a>\n";
                echo "    </div>\n";
                echo "    </div>";
            }
        }
    }
?>

