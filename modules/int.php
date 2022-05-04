<?php
// Verzování
$production = false;

if ($production) {
    $verze = "1.1";
} else {
    $verze = time();
}

// Funkce
require_once("scripts.php");


// Hlavní menu
$menu = [
    [
        "link" => "/",
        "name" => "Domů",
        "tooltip" => "Domů tooltip"
    ],
    [
        "link" => "/filmy.php",
        "name" => "Filmy",
        "tooltip" => "Filmy tooltip"
    ],
    [
        "link" => "/autori.php",
        "name" => "Autoři",
        "tooltip" => "Autoři tooltip"
    ],
    [
        "link" => "/o-nas.php",
        "name" => "O nás",
        "tooltip" => "O nás tooltip"
    ],
    [
        "link" => "/kontakty.php",
        "name" => "Kontakty",
        "tooltip" => "Kontakty tooltip"
    ]
];
?>