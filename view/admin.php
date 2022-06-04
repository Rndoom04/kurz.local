<h1>Admin</h1>

<?php
if (!empty($admin_id)) {
    // Jsem přihlášený
    ?>
        <div class="adminLayout">
            <div class="levyPanel">
                <nav class="adminMenu">
                    <ul>
                        <li><a href="/admin.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                        <li><a href="/admin.php?page=autori"><i class="fa-solid fa-users"></i> Autoři</a></li>
                        <li><a href="/admin.php?page=filmy"><i class="fa-solid fa-clapperboard"></i> Filmy</a></li>
                        <li><a href="/logout.php"><i class="fa-solid fa-right-from-bracket"></i> Odhlásit se</a></li>
                    </ul>
                </nav>
            </div>
            <div class="pravyPanel">
                <?php
                $page = isset($_GET["page"])?$_GET["page"]:null;
                
                if ($page == "autori") { include("admin/admin_autori.php"); }
                elseif ($page == "filmy") { include("admin/admin_filmy.php"); }
                elseif ($page == "autor_editace") { include("admin/admin_autor_editace.php"); }
                elseif ($page == "film_editace") { include("admin/admin_film_editace.php"); }
                else {
                    include("admin/admin_homepage.php");
                }           
                ?>
            </div>
        </div>

    <?php
} else {
    // Nejsem přihlášený - chci formulář
    if (isset($_POST['akce']) && $_POST['akce'] == "login") {
        $email = isset($_POST["email"])?$_POST["email"]:null;
        $heslo = isset($_POST["heslo"])?$_POST["heslo"]:null;     

        // Escape
        $email = trim(mysqli_real_escape_string($dbspojeni, $email));
        $heslo = mysqli_real_escape_string($dbspojeni, $heslo); // Plain text : heslo123
        
        $heslo_hashed = sha1($heslo);
        
        if (!empty($email)) {
            if (!empty($heslo)) {
                // Přihlašovací logika
                $navrat = mysqli_query($dbspojeni, "SELECT id FROM admin WHERE email='$email' AND passwd='$heslo_hashed';");
                $radek = mysqli_fetch_assoc($navrat);
                
                if (isset($radek["id"])) {
                    // Login je OK
                    $idUzivatele = $radek["id"];
                    
                    //setcookie("adminID", $idUzivatele);
                    $_SESSION["adminID"] = $idUzivatele;
                    Header("Refresh:0");
                    die();
                } else {
                    // Login je NOK
                    echo "Uživatelské jméno nebo heslo je špatné.";
                }
            } else {
                echo "Heslo nebylo vyplněno.";
            }
        } else {
            echo "E-mail nebyl vyplněn.";
        }
    }
    
    ?>
    <div class="admin-login-form">
        <form method="POST" action="">
            <input type="hidden" name="akce" value="login">

            <label><strong>E-mail:</strong></label>
            <input type="text" name="email" placeholder="Vložte e-mail" value="<?php echo isset($_POST['email'])?$_POST['email']:null; ?>"><br>

            <label><strong>Heslo:</strong></label>
            <input type="password" name="heslo" placeholder="Vložte heslo"><br>

            <div class="text-right">
                <button class="btn btn-primary">Přihlásit se</button>
            </div>
        </form>
    </div>
    <?php
}
?>