<?php
$idFilmu = (isset($_GET["film"]))?(int)$_GET["film"]:null;
$idFilmu = (int)magic_string($dbspojeni, $idFilmu);
if ($idFilmu < 0) { $idFilmu = 0; }

$navrat = mysqli_query($dbspojeni, "SELECT filmy.*, zanry_filmu.zanr as 'zanrFilmu', autori.jmeno as 'jmenoAutora'
    FROM `filmy`
    LEFT JOIN zanry_filmu
    ON filmy.zanrID = zanry_filmu.id
    LEFT JOIN autori
    ON filmy.autorID = autori.id
    WHERE filmy.id=".$idFilmu.";");
$film = mysqli_fetch_assoc($navrat);

if (!empty($film)) {
    // Data nalezena, zpracuj, vykresli
    ?>
        <h1><?=$film['jmeno'];?></h1>
        <ul class="filmy-hlavicka">
            <?php if (isset($film['jmenoAutora']) && !empty($film['jmenoAutora'])) { ?>
                <li>Autor: <a href="autor.php?autor=<?=$film['autorID'];?>"><?=$film['jmenoAutora'];?></a></li>
            <?php } ?>
                
            <?php if (isset($film['zanrFilmu']) && !empty($film['zanrFilmu'])) { ?>
                <li>Žánr: <?=$film['zanrFilmu'];?></li>
            <?php } ?>
                
            <li>Datum vydání filmu: <?=$film['datum_vydani'];?></li>
            <li>Zvěřejněno: <?=date("j.n.Y", strtotime($film['datum_pridani']));?></li>
        </ul>
        <p><?=$film['popis'];?></p>
    <?php
} else {
    // Data nenalezena
    hlaska("Hledaný film nebyl nalezen.");
    Header("Location: /filmy.php");
    die();
}
?>