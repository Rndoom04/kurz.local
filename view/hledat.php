<?php
$_hledany_vyraz = isset($_GET["search"])?$_GET["search"]:null;
$_hledany_vyraz = magic_string($dbspojeni, $_hledany_vyraz);

if (!empty($_hledany_vyraz) && strlen($_hledany_vyraz) >= 3) {
    // Konverze řetězce
    $hledany_vyraz = [];
    $hledany_vyraz[0] = str_replace("-", " ", $_hledany_vyraz);
    $hledany_vyraz[1] = str_replace(" ", "-", $_hledany_vyraz);
    
    // Můžeme hledat
    $query = "SELECT filmy.*, autori.jmeno 'jmenoAutora'
        FROM filmy
        LEFT JOIN autori
        ON autori.id = filmy.autorID
        WHERE
        filmy.jmeno LIKE '%".$hledany_vyraz[0]."%' OR
        filmy.jmeno LIKE '%".$hledany_vyraz[1]."%' OR
        filmy.popis LIKE '%".$hledany_vyraz[0]."%' OR
        filmy.popis LIKE '%".$hledany_vyraz[1]."%' OR
        autori.jmeno LIKE '%".$hledany_vyraz[0]."%' OR
        autori.jmeno LIKE '%".$hledany_vyraz[1]."%';";
    $dotaz = mysqli_query($dbspojeni, $query);
    $filmy = mysqli_fetch_all($dotaz, MYSQLI_ASSOC);
} else {
    // Uživatel nic nehledá
    hlaska("Hledaný výraz je příliš krátký. Upřesněte hledání.");
    Header("Location: /filmy.php");
    die();
}
?>

<h1>Výsledek hledání</h1>

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