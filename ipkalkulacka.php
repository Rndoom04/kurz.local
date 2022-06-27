<?php
require_once("./modules/int.php");

function bin2dec($bin, $pocetBitu) {
    // Vstup: 11000000.10101000.11000001.00000100
    // Vstup pocetBitu: 32
    // Výstup: 192.168.193.4
    
    $_ip_bin = explode(".", $bin);
    $_ip_dec = [];
    foreach($_ip_bin as $prvek) {
        $_ip_dec[] = bindec($prvek);
    }
   
    return join(".", $_ip_dec);
}

function dec2bin($dec, $pocetBitu) {
    // Vstup: 192.168.193.4
    // Vstup pocetBitu: 32
    // Výstup: 11000000.10101000.11000001.00000100
    
    $_ip_dec = explode(".", $dec);
    $_ip_bin = [];
    foreach($_ip_dec as $prvek) {
        $_ip_bin[] = (string)str_pad(decbin($prvek), $pocetBitu/4, "0", STR_PAD_LEFT);
    }
    return join(".", $_ip_bin);
}
?>





<?php
    // Konstanty
    $pocetBitu = 32;

    // Zadání
    $ip = ["dec" => "192.168.193.4", "bin" => null];
    $maska = ['bitu' => 18, "dec" => null, "bin" => null];
    
    // Výpočty
    $ip['bin'] = dec2bin($ip['dec'], $pocetBitu); // 11000000.10101000.11000001.00000100
    
    if (!empty($maska['bitu'])) {
        $_maska_bin = "";
        $_maska_bin = str_pad($_maska_bin, $maska['bitu'], "1", STR_PAD_BOTH);
        $_maska_bin = str_pad($_maska_bin, $pocetBitu, "0", STR_PAD_RIGHT);
        $maska['bin'] = join(".", str_split($_maska_bin, 8)); // 11111111.11111111.11000000.00000000
        $maska['dec'] = bin2dec($maska['bin'], $pocetBitu); // 255.255.192.0
    }
    
    dump($ip);
    dump($maska);
    die();
?>