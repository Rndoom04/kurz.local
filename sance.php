<?php require_once("./modules/int.php"); ?>

<h1>Šance</h1>
<?php
    $pocet_tazeni = 100; // Součet střed a pátků
    $cisla = [];

    for ($i = 0; $i < $pocet_tazeni; $i++) {
        $tazena_cisla = [5, 8, 24];
        for ($p = 1; $p <= 6; $p++) {
            do {
                $cislo = rand(1, 49);
            } while (in_array($cislo, $tazena_cisla));
            
            $tazena_cisla[] = $cislo;
        }
        
        // Konec daného tažení
        foreach($tazena_cisla as $cislo) {
            if (array_key_exists($cislo, $cisla)) {
                $cisla[$cislo]++;
            } else {
                $cisla[$cislo] = 1;
            }
        }
    }

    ksort($cisla);
    
    // Zápis do souboru
    $soubor = "./dokumenty/cisla.csv";
    $stream = fopen($soubor, "w");
    foreach($cisla as $cislo=>$pocet) {
        fwrite($stream, $cislo.";".$pocet."\n");
    }
    fclose($stream);
    
    echo "Konec";
    die();
?>