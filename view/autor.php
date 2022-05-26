<?php
$idAutora = (isset($_GET["autor"]))?(int)$_GET["autor"]:null;
$idAutora = (int)magic_string($dbspojeni, $idAutora);
if ($idAutora < 0) { $idAutora = 0; }

$navrat = mysqli_query($dbspojeni, "SELECT autori.*, narodnosti_autoru.narodnost as 'narodnostAutora'
    FROM autori
    LEFT JOIN narodnosti_autoru
    ON autori.narodnostID = narodnosti_autoru.id
    WHERE autori.id=".$idAutora);
$autor = mysqli_fetch_assoc($navrat);

if (!empty($autor)) {
    // Data nalezena, zpracuj, vykresli
    ?>
        <h1><?=$autor['jmeno'];?></h1>
        <ul class="filmy-hlavicka">                
            <?php if (isset($autor['narodnostAutora']) && !empty($autor['narodnostAutora'])) { ?>
                <li>Národnost: <?=$autor['narodnostAutora'];?></li>
            <?php } ?>
                
            <li>Datum narození: <?=date("j.n.Y", strtotime($autor['datum_narozeni']));?></li>
            <li>Věk: <?=spocitejVek($autor['datum_narozeni']); ?> let</li>
        </ul>
        <p><?=$autor['bio'];?></p>
        
        <?php        
        $dotaz = mysqli_query($dbspojeni, "SELECT * FROM filmy WHERE autorID=".$idAutora." ORDER BY id DESC;");
        $filmy = mysqli_fetch_all($dotaz, MYSQLI_ASSOC);
        
        if (!empty($filmy)) {?>
            <hr>
            <h2 class="text-center">Autorovy filmy</h2>
            <?php
                foreach($filmy as $film) {
                    $zanr_key = $film['zanrID'];
                    ?>
                    <div class="film card mb-2">
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
            ?>
        <?php } ?>
    <?php
} else {
    // Data nenalezena
    hlaska("Hledaný autor nebyl nalezen.");
    Header("Location: /autori.php");
    die();
}
?>