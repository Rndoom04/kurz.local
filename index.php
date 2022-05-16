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

        <div class="container">
            <main>
                <?php require_once("./modules/hlasky.php"); ?>
                <?php require_once("./view/homepage.php"); ?>
            </main>
        </div>

        <?php require_once("./modules/footer.php"); ?>
    </body>
</html>