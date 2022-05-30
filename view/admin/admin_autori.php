<?php    
    if (isset($_POST['token']) && $_POST['token'] == "admin_autori_form") {
        $jmeno = magic_string($dbspojeni, $_POST["jmeno"]);
        $datum_narozeni = magic_string($dbspojeni, $_POST["datum_narozeni"]);
        $narodnost = magic_string($dbspojeni, $_POST["narodnost"]);
        $bio = magic_string($dbspojeni, $_POST["bio"]);
        
        $navrat = mysqli_query($dbspojeni, "INSERT INTO autori (id, jmeno, datum_narozeni, narodnostID, bio, datum_zalozeni) VALUES (NULL, '$jmeno', '$datum_narozeni', '$narodnost', '$bio', NULL);");
        
        if ($navrat) {
            // Vložilo se to do db
            hlaska("Autor byl úspěšně přidán.");
            Header("Refresh:0");
            die();
        } else {
            // Nevložilo se to do db, něco špatně
            echo "Nastal problém s vkládáním dat do databáze.";
        }
        
        die();
    }
    
    // Výpis autorů
    $dotaz = mysqli_query($dbspojeni, "SELECT * FROM autori;");
    $autori = mysqli_fetch_all($dotaz, MYSQLI_ASSOC);
?>

<div class="admin-form">
    <form method="POST" action="">
        <input type="hidden" name="token" value="admin_autori_form">

        <label><strong>Jméno autora:</strong></label>
        <input type="text" name="jmeno" placeholder="Vložte jméno autora" value=""><br>

        <label><strong>Datum narození:</strong></label>
        <input type="date" name="datum_narozeni"><br>

        <label><strong>Národnost:</strong></label>
        <select name="narodnost">
            <?php
            foreach($narodnosti_autoru as $key=>$value) {
                ?>
                    <option value="<?=$key;?>"><?=$value;?></option>
                <?php
            }
            ?>
        </select>

        <label><strong>Bio:</strong></label>
        <textarea name="bio" placeholder="Zadejte bio autora."></textarea>

        <div class="text-right">
            <button class="btn btn-primary">Přidat autora</button>
        </div>
    </form>
    
    <hr>
    <h3>Výpis</h3>
    <table class="adminTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Jméno</th>
                <th class="text-right">Akce</th>
            </tr>
        </thead>
        
        <tbody>
            <?php
            foreach ($autori as $autor) { ?>
                <tr>
                    <td><?=$autor['id'];?></td>
                    <td><?=$autor['jmeno'];?></td>
                    <td class="text-right">
                        <a href="admin.php?page=autor_editace&autorID=<?=$autor['id'];?>">Editovat</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>