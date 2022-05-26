<?php
$dotaz = mysqli_query($dbspojeni, "SELECT * FROM filmy;");
$filmy = mysqli_fetch_all($dotaz, MYSQLI_ASSOC);
?>

<h1>Databáze filmů</h1>

<div class="filmy">
    <?php
    if (!empty($filmy)) {
        foreach($filmy as $film) {
            $zanr_key = $film['zanrID'];
            ?>
            <div class="film card">
                <div class="row">
                    <div class="col-2 my-auto">
                        <img src="https://www.kollertslavomir.cz/photo/600x800;;Foto autora" class="img-fluid">
                    </div>
                    <div class="col-8 my-auto">
                        <h2><a href="film.php?film=<?=$film['id'];?>"><?=$film['jmeno'];?></a> <small><?=$zanry_filmu[$zanr_key];?></small></h2>
                        <p><?=$film['popis'];?></p>
                        <p class="small">Datum vydání: <?=$film['datum_vydani'];?></p>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <p>Žádný film nebyl nalezen.</p>
        <?php
    }
    ?>
</div>