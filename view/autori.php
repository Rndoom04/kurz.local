<?php
$dotaz = mysqli_query($dbspojeni, "SELECT * FROM autori;");
$autori = mysqli_fetch_all($dotaz, MYSQLI_ASSOC);
?>

<h1>Autoři filmů</h1>

<div class="autori">
    <?php
    if (!empty($autori)) {
        foreach($autori as $autor) {
            $narodnost_key = $autor['narodnostID'];
            ?>
            <div class="autor card">
                <div class="row">
                    <div class="col-2 my-auto">
                        <img src="https://www.kollertslavomir.cz/photo/600x600;;Foto autora" class="rounded img-fluid">
                    </div>
                    <div class="col-8 my-auto">
                        <h2><a href="autor.php?autor=<?=$autor['id'];?>"><?=$autor['jmeno'];?></a> <small><?=$narodnosti_autoru[$narodnost_key];?></small></h2>
                        <p><?=$autor['bio'];?></p>
                        <p class="small">Datum narození: <?= date("j.n.Y", strtotime($autor['datum_narozeni']));?></p>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <p>Žádný autor nebyl nalezen.</p>
        <?php
    }
    ?>
</div>