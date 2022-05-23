<h1>Autor</h1>

<?php
$idAutora = (isset($_GET["autor"]))?(int)$_GET["autor"]:null;
$idAutora = (int)magic_string($dbspojeni, $idAutora);
if ($idAutora < 0) { $idAutora = 0; }

dump($idAutora);
?>