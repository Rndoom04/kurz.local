<?php
    $filmID = isset($_GET["filmID"])?$_GET["filmID"]:null;
    $filmID = (int)magic_string($dbspojeni, $filmID);

    // Získej film z databáze
    $navrat = mysqli_query($dbspojeni, "SELECT * FROM filmy WHERE id=$filmID;");
    $film = mysqli_fetch_assoc($navrat);
    
    $navrat = mysqli_query($dbspojeni, "SELECT id, jmeno FROM autori ORDER BY id DESC");
    $_autori = mysqli_fetch_all($navrat, MYSQLI_ASSOC);
    $autori_form = [];
    foreach($_autori as $autor) {
        $autorID = $autor['id'];
        $autorJmeno = $autor['jmeno'];
        
        $autori_form[$autorID] = $autorJmeno;
    }
    
    

    // Zpracuj formulář
    if (isset($_POST['token']) && $_POST['token'] == "admin_filmy_form_editace") {
        dump($_POST);
        
        $filmIDForm = magic_string($dbspojeni, $_POST["filmID"]);
        $nazev_filmu = magic_string($dbspojeni, $_POST["nazev_filmu"]);
        $autorID = (int)magic_string($dbspojeni, $_POST["autor"]);
        $popis = magic_string($dbspojeni, $_POST["popis"]);
        $zanr = magic_string($dbspojeni, $_POST["zanr"]); // Nějaké ID
        $datum_vydani = (int)magic_string($dbspojeni, $_POST["datum_vydani"]);
        
        $navrat = mysqli_query($dbspojeni, "SELECT id FROM filmy WHERE id=$filmIDForm;");
        $filmtest = mysqli_fetch_assoc($navrat);
        
        
        if (isset($filmtest["id"]) && $filmtest["id"] == $filmIDForm) {
            if (array_key_exists($zanr, $zanry_filmu)) {
                if (!empty($nazev_filmu) && strlen($nazev_filmu) >= 5) {
                    if ($datum_vydani >= 1900 && $datum_vydani <= date("Y", time())) {
                        if (!empty($popis) && strlen($popis) >= 20) {
                            $navrat = mysqli_query($dbspojeni, "UPDATE filmy SET jmeno='$nazev_filmu', autorID='$autorID', popis='$popis', zanrID='$zanr', datum_vydani='$datum_vydani' WHERE id=$filmIDForm");
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
        }
        die();
    }
    
    // Výpis filmů
    $dotaz = mysqli_query($dbspojeni, "SELECT * FROM filmy;");
    $filmy = mysqli_fetch_all($dotaz, MYSQLI_ASSOC);
?>

<div class="admin-form">
    <form method="POST" action="">
        <input type="hidden" name="token" value="admin_filmy_form_editace">
        <input type="hidden" name="filmID" value="<?=$filmID;?>">
        
        <label><strong>Autor:</strong></label>
        <select name="autor">
            <?php
            foreach($autori_form as $key=>$value) {
                if ($key == $film['autorID']) {
                    ?>
                        <option value="<?=$key;?>" selected><?=$value;?></option>
                    <?php
                } else {
                    ?>
                        <option value="<?=$key;?>"><?=$value;?></option>
                    <?php
                }
            }
            ?>
        </select>

        <label><strong>Název filmu:</strong></label>
        <input type="text" name="nazev_filmu" placeholder="Vložte název filmu" value="<?=isset($film['jmeno'])?$film['jmeno']:null;?>"><br>

        <label><strong>Popis:</strong></label>
        <textarea name="popis" placeholder="Popis filmu."><?=isset($film['popis'])?$film['popis']:null;?></textarea>
        
        <label><strong>Žánr:</strong></label>
        <select name="zanr">
            <?php
            foreach($zanry_filmu as $key=>$value) {
                if ($key == $film['zanrID']) {
                    ?>
                        <option value="<?=$key;?>" selected><?=$value;?></option>
                    <?php
                } else {
                    ?>
                        <option value="<?=$key;?>"><?=$value;?></option>
                    <?php
                }
            }
            ?>
        </select>

        <label><strong>Datum vydání:</strong></label>
        <input type="number" name="datum_vydani" value="<?=isset($film['datum_vydani'])?$film['datum_vydani']:null;?>"><br>

        <div class="text-right">
            <button class="btn btn-primary">Uložit změny</button>
        </div>
    </form>
</div>