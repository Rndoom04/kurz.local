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
    $prom = remove_scripts($prom); // Remove javascript
    $prom = strip_tags($prom); // Remove HTML & PHP scripts
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

function spocitejVek($datum_narozeni) {
    // Datum narození - 1965-10-16 (má mu být 56) || pokud už datum byl, tak 57
    $vek = null;
    
    // Data o narození
    $rok_narozeni = (int)date("Y", strtotime($datum_narozeni)); // 1965
    $mesic_narozeni = (int)date("m", strtotime($datum_narozeni)); // 10
    $den_narozeni = (int)date("d", strtotime($datum_narozeni)); // 16
    
    // Aktuálně
    $aktualni_rok = (int)date("Y", time()); // 2022
    $aktualni_mesic = (int)date("m", time()); // 5
    $aktualni_den = (int)date("d", time()); // 26
    
    // Výpočet
    $vek = ($aktualni_rok-$rok_narozeni)-1; // 56
    if ($mesic_narozeni <= $aktualni_mesic) {
        if ($den_narozeni <= $aktualni_den) {
            $vek++; // 57
        }
    }
    
    return (int)$vek;
}

function getKoncovkaSouboru($soubor) {
    $exploded = explode(".", $soubor);
    $pocet_prvku = count($exploded); // 3
    return $exploded[$pocet_prvku-1];
}

function getKoncovkaSouboruMimeType($type) {
    if ($type == "image/jpeg") { return "jpg"; }
    elseif ($type == "image/jpg") { return "jpg"; }
    elseif ($type == "image/png") { return "png"; }
    
    return null;
}
?>