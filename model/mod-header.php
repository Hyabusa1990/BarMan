<?php
    if (!defined("WERDICHLEGALGERUFEN")) {
        echo ("YOU CANNOT DISPLAY THIS FILE DIRECTLY");
        exit();
    }
    class HEADER
    {
        public static function GET_HEADER()
        {
            print "<meta charset=\"utf-8\">\n";
            print "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n";
            print "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\n";
            print "<meta name=\"description\" content=\"\">\n";
            print "<meta name=\"author\" content=\"\">\n";
            print "\n";
            print "<title>BarMan</title>\n";
            print "\n";
            print "<!-- Custom fonts for this template-->\n";
            print "<link href=\"vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">\n";
            print "<link href=\"https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i\" rel=\"stylesheet\">\n";
            print "\n";
            print "<!-- Custom styles for this template-->\n";
            print "<link href=\"css/sb-admin-2.min.css\" rel=\"stylesheet\">";
        }
    }
?>