<?php require_once("./modules/int.php"); ?>

<!DOCTYPE html>
<html>
    <head>
        <?php require_once("./modules/head.php"); ?>
    </head>

    <body>
        <header>
            <?php require_once("./modules/menu.php"); ?>
        </header>

        <div class="container-fluid">
            <div class="homepage-hlavicka text-center mb-3">
                <div class="container my-auto relative h100p">
                    <div class="content">
                        <h1>Objev krásu filmů</h1>
                        <p>Kurz tvorby webových stránek pro <strong>Denis Kozel</strong></p>
                        
                        <div class="row mb-2">
                            <div class="col-3"></div>
                            <div class="col-3 text-center">
                                <h3>199 Kč <sup class="small">/měsíc</sup></h3>
                                <p>Zrušení je možné kdykoli.</p>
                                <a href="#" class="btn-registrovat-se">Zaregistrovat se</a>
                            </div>
                            <div class="col-3 text-center">
                                <h3><sup class="stroke small">2 388 Kč</sup> 1 590 Kč <sup class="small">/rok</sup></h3>
                                <p>Ušetříte 33 %.*</p>
                                <a href="#" class="btn-registrovat-se">Získat slevu</a>
                            </div>
                            <div class="col-3"></div>
                        </div>
                        
                        <p class="prodejni-info">*Sleva je vypočítána jako rozdíl mezi roční cenou zaplacenou předem a dvanáctinásobkem měsíční ceny (199 Kč).</p>
                    </div>
                </div>
            </div>
            
            <main>
                <?php require_once("./modules/hlasky.php"); ?>
                <?php require_once("./view/homepage.php"); ?>
            </main>
        </div>

        <?php require_once("./modules/footer.php"); ?>
    </body>
</html>