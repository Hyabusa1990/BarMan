<?php
if (!defined("WERDICHLEGALGERUFEN")) {
    echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
    exit();
}
class NAVI
{
    public static function GET_NAVI()
    {
        echo "            <!-- Sidebar -->\n";
        echo "        <ul class=\"navbar-nav bg-gradient-primary sidebar sidebar-dark accordion\" id=\"accordionSidebar\">\n";
        echo "\n";
        echo "            <!-- Sidebar - Brand -->\n";
        echo "            <a class=\"sidebar-brand d-flex align-items-center justify-content-center\" href=\"index.html\">\n";
        echo "                <div class=\"sidebar-brand-icon rotate-n-15\">\n";
        echo "                    <i class=\"fas fa-cocktail\"></i>\n";
        echo "                </div>\n";
        echo "                <div class=\"sidebar-brand-text mx-3\">BarMan</div>\n";
        echo "            </a>\n";
        echo "\n";
        echo "            <!-- Divider -->\n";
        echo "            <hr class=\"sidebar-divider my-0\"><br>\n";
        echo "\n";
        echo "<div class=\"text-center d-none d-md-inline\"><a href=\"create.php?NOTSTOP=1\" class=\"btn btn-danger btn-icon-split\"><span class=\"icon text-white-50\"><i class=\"fas fa-times-circle\"></i></span><span class=\"text\">STOPP</span></a></div>\n";
        echo "        </ul>\n";
        echo "        <!-- End of Sidebar -->";
    }
}
?>
