<h1>Film</h1>

<?php
$idFilmu = (isset($_GET["film"]))?(int)$_GET["film"]:null;
$idFilmu = (int)magic_string($dbspojeni, $idFilmu);
if ($idFilmu < 0) { $idFilmu = 0; }

dump($idFilmu);
?>