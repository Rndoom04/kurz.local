<?php
    // Získej autory z databáze
    $navrat = mysqli_query($dbspojeni, "SELECT id, jmeno FROM autori ORDER BY jmeno ASC;");
    $radek = mysqli_fetch_all($navrat);
    $autori_form = [];
    foreach($radek as $zaznam) {
        $id_autora = $zaznam[0];
        $jmeno_autora = $zaznam[1];
        
        $autori_form[$id_autora] = $jmeno_autora;
    }

    // Zpracuj formulář
    if (isset($_POST['token']) && $_POST['token'] == "admin_filmy_form") {
        $nazev_filmu = magic_string($dbspojeni, $_POST["nazev_filmu"]);
        $autorID = (int)magic_string($dbspojeni, $_POST["autor"]);
        $popis = magic_string($dbspojeni, $_POST["popis"]);
        $zanr = magic_string($dbspojeni, $_POST["zanr"]); // Nějaké ID
        $datum_vydani = (int)magic_string($dbspojeni, $_POST["datum_vydani"]);
        
        
        if (array_key_exists($zanr, $zanry_filmu)) {
            if (!empty($nazev_filmu) && strlen($nazev_filmu) >= 5) {
                if ($datum_vydani >= 1900 && $datum_vydani <= date("Y", time())) {
                    if (!empty($popis) && strlen($popis) >= 20) {
                        $navrat = mysqli_query($dbspojeni, "INSERT INTO filmy (id, autorID, jmeno, popis, zanrID, datum_vydani, datum_pridani) VALUES (NULL, '$autorID', '$nazev_filmu', '$popis', '$zanr', '$datum_vydani', NULL);");
                        if ($navrat) {
                            // Vložilo se to do db
                            hlaska("Film byl úspěšně přidán.");
                            Header("Refresh:0");
                            die();
                        } else {
                            // Nevložilo se to do db, něco špatně
                            echo "Nastal problém s vkládáním dat do databáze.";
                        }
                    } else {
                        echo "Popis filmu je příliš krátký. Je zapotřebí alespoň 20 znaků.";
                    }
                } else {
                    echo "Rok vydání je špatný. Musí být větší  nebo rovno 1900, popřípadě menší než ".date("Y", time()).".";
                }
            } else {
                echo "Název filmu je příliš krátký. Je zapotřebí alespoň 5 znaků.";
            }
        } else {
            echo "Zvolený žánr neexistuje.";
        }
        
        
        
        die();
    }
?>

<div class="admin-form">
    <form method="POST" action="">
        <input type="hidden" name="token" value="admin_filmy_form">
        
        <label><strong>Autor:</strong></label>
        <select name="autor">
            <?php
            foreach($autori_form as $key=>$value) {
                ?>
                    <option value="<?=$key;?>"><?=$value;?></option>
                <?php
            }
            ?>
        </select>

        <label><strong>Název filmu:</strong></label>
        <input type="text" name="nazev_filmu" placeholder="Vložte název filmu" value=""><br>

        <label><strong>Popis:</strong></label>
        <textarea name="popis" placeholder="Popis filmu."></textarea>
        
        <label><strong>Žánr:</strong></label>
        <select name="zanr">
            <?php
            foreach($zanry_filmu as $key=>$value) {
                ?>
                    <option value="<?=$key;?>"><?=$value;?></option>
                <?php
            }
            ?>
        </select>

        <label><strong>Datum vydání:</strong></label>
        <input type="number" name="datum_vydani"><br>

        <div class="text-right">
            <button class="btn btn-primary">Přidat film</button>
        </div>
    </form>
</div>