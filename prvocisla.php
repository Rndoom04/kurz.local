<?php require_once("./modules/int.php"); ?>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    
    table td { padding: 8px; }
</style>

<h1>Prvočísla</h1>
<?php
    /* true/false */
    function jePrvocislo($testovaneCislo) {
        $pocetDeleni = 0;
        
        for($i=1; $i<$testovaneCislo; $i++) {
            if ($testovaneCislo % $i == 0) {
                $pocetDeleni++;
            }
        }
        
        if ($pocetDeleni <= 2) {
            // Je prvočíslo
            return true;
        } else {
            // Není prvočíslo
            return false;
        }
    }

    /* array */
    function generujPrvocisla($pocetPrvocisel) {
        $prvocisla = [];
        $cislo = 1;
        
        while(count($prvocisla) < $pocetPrvocisel) {
            if (jePrvocislo($cislo) == true) {
                // True = je to prvočíslo
                $prvocisla[] = $cislo;
            }
            
            $cislo++;
        }
        
        
        
        return $prvocisla;
    }
    
    
    
    $prvocisla = generujPrvocisla(200);

    
    // Vypiš prvky
    $prvku = 0;
    $prvku_na_radek = 15;
    $posledni_cislice = 0;
    $bg_color = "#FFFFFF";
    $pocty = [
        "modre" => 0,
        "zelene" => 0,
        "cervene" => 0,
        "bile" => 0
    ];
    
    echo "<table>";
        foreach($prvocisla as $prvocislo) {
            if ($prvku == 0) { echo "<tr>"; }

            // Zjištění, posledního čísla (končí 1 = červená, 3 = modrá)
            $string_prvocislo = (string)$prvocislo;
            $posledni_cislice = $string_prvocislo[strlen($string_prvocislo)-1];
            
            /* Podmínka barev */
            if ($posledni_cislice == 1) {
                $bg_color = "#CC0000";
                $pocty["cervene"]++;
            } elseif ($posledni_cislice == 3) {
                $bg_color = "#1ba1e2";
                $pocty["modre"]++;
            } elseif ($prvocislo >= 100 && $prvocislo <= 200) {
                $bg_color = "#00FF00";
                $pocty["zelene"]++;
            } else {
                $bg_color = "#FFFFFF";
                $pocty["bile"]++;
            }
            
            echo "<td style='background-color:".$bg_color.";'>".$prvocislo."</td>";
            
            $prvku++;
            if ($prvku == $prvku_na_radek) {
                echo "</tr>";
                $prvku = 0;
            }
        }
    echo "</table>";
    
    dump($pocty);
    
    die();
?>
