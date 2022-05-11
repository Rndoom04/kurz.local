<?php
    $narodnost = [
        "ceska" => "Česká",
        "slovenska" => "Slovenská",
        "ceskoslovenska" => "Československá",
        "polska" => "Polská",
        "madarska" => "Maďarská",
        "americka" => "Americká",
    ];
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
            foreach($narodnost as $key=>$value) {
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
</div>