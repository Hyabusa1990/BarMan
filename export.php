<?php

define("WERDICHLEGALGERUFEN", 1);
require_once "settings.php";
require_once __ROOT__."/control/con-receipt.php";
require_once __ROOT__."/control/con-settings.php";


if(isset($_GET["ID"])){
    $cocktail = CReceipt::get_cocktail($_GET["ID"]);
    $receipt = CReceipt::get_receiptFromCocktailForExport($_GET["ID"]);

    $export = array("name" => $cocktail["name"],
        "des" => $cocktail["des"],
        "picture" => base64_encode($cocktail["picture"]),
        "bottles" => $receipt);

    header('Content-disposition: attachment; filename=' . sanitizeFileName($cocktail["name"]) . '.json');
    header('Content-type: application/json');
    $export = utf8ize($export);
    $dump = json_encode($export);
    echo $dump;
}
//header("Location: receipt.php");

/* Use it for json_encode some corrupt UTF-8 chars
 * useful for = malformed utf-8 characters possibly incorrectly encoded by json_encode
 */
function utf8ize( $mixed ) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } elseif (is_string($mixed)) {
        return iconv(mb_detect_encoding($mixed, mb_detect_order(), true), "UTF-8", $mixed);;
    }
    return $mixed;
}

function sanitizeFileName(string $fileName): string
{
    // Remove multiple spaces
    $fileName = preg_replace('/\s+/', ' ', $fileName);

    // Replace spaces with hyphens
    $fileName = preg_replace('/\s/', '-', $fileName);

    // Replace german characters
    $germanReplaceMap = [
        'ä' => 'ae',
        'Ä' => 'Ae',
        'ü' => 'ue',
        'Ü' => 'Ue',
        'ö' => 'oe',
        'Ö' => 'Oe',
        'ß' => 'ss',
    ];
    $fileName = str_replace(array_keys($germanReplaceMap), $germanReplaceMap, $fileName);

    // Remove everything but "normal" characters
    $fileName = preg_replace("([^\w\s\d\-])", '', $fileName);

    // Remove multiple hyphens because of contract and project name connection
    $fileName = preg_replace('/-+/', '-', $fileName);

    return $fileName;
}


?>