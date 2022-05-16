<?php
function dump($dump) {
    echo "<pre>";
    var_export($dump);
    echo "</pre>";
}

function remove_scripts($vstup) {
    return preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $vstup);
}

function magic_string($dbspojeni, $vstup) {
    $prom = trim($vstup);
    $prom = remove_scripts($prom);
    $prom = mysqli_real_escape_string($dbspojeni, $prom);
    
    return $prom;
}

function hlaska($text) {
    $_SESSION["hlaska"] = $text;
}

function prectiHlasky() {
    if (isset($_SESSION["hlaska"])) {
        $hlaska = $_SESSION["hlaska"];
        unset($_SESSION['hlaska']);
        return $hlaska;
    }
    
    return null; 
}
?>