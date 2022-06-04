<?php
    $autorID = isset($_GET["autorID"])?$_GET["autorID"]:null;
    $autorID = magic_string($dbspojeni, $autorID);
    
    $autorExists = false;
    if (!empty($autorID)) {
        // Autor pravděpodobně existuje
        $navrat = mysqli_query($dbspojeni, "SELECT autori.*, narodnosti_autoru.narodnost as 'narodnostAutora'
            FROM autori
            LEFT JOIN narodnosti_autoru
            ON autori.narodnostID = narodnosti_autoru.id
            WHERE autori.id=".$autorID);
        $autor = mysqli_fetch_assoc($navrat);
        
        if (!empty($autor)) { $autorExists = true; }
    }
    
    if (!$autorExists) {
        hlaska("Autor nebyl nalezen.");
        Header("Location: /admin.php?page=autori");
        die();
    }
    
    
    
    
    if (isset($_POST['token']) && $_POST['token'] == "admin_autori_form_editace") {
        $idAutoraForm = magic_string($dbspojeni, $_POST["autorID"]);
        $jmeno = magic_string($dbspojeni, $_POST["jmeno"]);
        $datum_narozeni = magic_string($dbspojeni, $_POST["datum_narozeni"]);
        $narodnost = magic_string($dbspojeni, $_POST["narodnost"]);
        $bio = magic_string($dbspojeni, $_POST["bio"]);
        
        $navrat = mysqli_query($dbspojeni, "UPDATE autori SET jmeno='$jmeno', datum_narozeni='$datum_narozeni', bio='$bio', narodnostID='$narodnost' WHERE id=$idAutoraForm;");
        
        if ($navrat) {
            // Vložilo se to do db
            hlaska("Autor byl úspěšně upraven.");
            Header("Refresh:0");
            die();
        } else {
            // Nevložilo se to do db, něco špatně
            echo "Nastal problém s editací autora.";
        }
        
        die();
    }
?>

<div class="admin-form">
    <form method="POST" action="">
        <input type="hidden" name="token" value="admin_autori_form_editace">
        <input type="hidden" name="autorID" value="<?=$autor['id'];?>">

        <label><strong>Jméno autora:</strong></label>
        <input type="text" name="jmeno" placeholder="Vložte jméno autora" value="<?=isset($autor['jmeno'])?$autor['jmeno']:null;?>"><br>

        <label><strong>Datum narození:</strong></label>
        <input type="date" name="datum_narozeni" value="<?=isset($autor['datum_narozeni'])?$autor['datum_narozeni']:null;?>"><br>

        <label><strong>Národnost:</strong></label>
        <select name="narodnost">
            <?php
            foreach($narodnosti_autoru as $key=>$value) {
                if ($key == $autor['narodnostID']) {
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

        <label><strong>Bio:</strong></label>
        <textarea name="bio" placeholder="Zadejte bio autora."><?=isset($autor['bio'])?$autor['bio']:null;?></textarea>

        <div class="text-right">
            <button class="btn btn-primary">Uložit změny</button>
        </div>
    </form>
</div>