<?php
session_start();

// Verzování
$production = false;

if ($production) {
    $verze = "1.1";
} else {
    $verze = time();
}

// Funkce
require_once("scripts.php");

// Databáze
define("SQL_HOST", "localhost");
define("SQL_DBNAME", "kurzKozel");
define("SQL_USERNAME", "kurz");
define("SQL_PASSWORD", "I873Sc!Khb/wG6hU");

$dbspojeni = @mysqli_connect(SQL_HOST, SQL_USERNAME, SQL_PASSWORD, SQL_DBNAME);
if (!$dbspojeni) {
    //throw new Exception(mysqli_connect_error(), mysqli_connect_errno());
    echo "Chyba spojeni s databazi."; die();
}
mysqli_query($dbspojeni, "SET NAMES utf8");

// Administrátor
$admin_id = null;
$jmeno_admina = null;
if (isset($_SESSION["adminID"])) {
    $admin_id = (int)$_SESSION["adminID"];
    $navrat = mysqli_query($dbspojeni, "SELECT * FROM admin WHERE id=$admin_id;");
    $radek = mysqli_fetch_assoc($navrat);

    $jmeno_admina = $radek['jmeno'];
}


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

// Přečti hlášky
$hlaska = prectiHlasky();


// Autoři - národnosti
$dotaz = mysqli_query($dbspojeni, "SELECT * FROM narodnosti_autoru;");
$narodnosti_autoru_temp = mysqli_fetch_all($dotaz, MYSQLI_ASSOC);
$narodnosti_autoru = [];
foreach($narodnosti_autoru_temp as $zaznam) {
    $zaznam_id = $zaznam["id"];
    $narodnost = $zaznam['narodnost'];
    
    $narodnosti_autoru[$zaznam_id] = $narodnost;
}

// Filmy žánry
$dotaz = mysqli_query($dbspojeni, "SELECT * FROM zanry_filmu;");
$zanry_filmu_temp = mysqli_fetch_all($dotaz, MYSQLI_ASSOC);
$zanry_filmu = [];
foreach($zanry_filmu_temp as $zaznam) {
    $zaznam_id = $zaznam["id"];
    $zanr = $zaznam['zanr'];
    
    $zanry_filmu[$zaznam_id] = $zanr;
}

// Mime type whitelist fotek
$photo_whitelist = [
    "image/jpg",
    "image/jpeg",
    "image/png"
];
?>