<?php require_once("./modules/int.php"); ?>

<h1>Soubory</h1>
<?php
    $soubor = "./dokumenty/soubor.txt";
    
    // Zápis
    if (file_exists($soubor)) {
        echo "<p>Soubor existuje.</p>";
        $stream = fopen($soubor, "a");
        if (filesize($soubor) > 0) {
            fwrite($stream, "\n".time());
        } else {
            fwrite($stream, time());
        }
        fclose($stream);
    } else {
        echo "<p>Soubor neexistuje, nebo je prázdný.</p>";
    }
    
    //Čtení
    if (file_exists($soubor) && filesize($soubor) > 0) {
        echo "<p>Soubor existuje.</p>";
        $stream = fopen($soubor, "r");
        $data = fread($stream, filesize($soubor));
        fclose($stream);
        
        // Zpracuj data
        dump($data);
    } else {
        echo "<p>Soubor neexistuje, nebo je prázdný.</p>";
    }
    
    echo "Konec";
    die();
?>