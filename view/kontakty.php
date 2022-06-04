<?php
if (isset($_POST['token']) && $_POST['token'] == "kontaktni_formular") {
    $jmeno = isset($_POST['jmeno'])?$_POST['jmeno']:null;
    $email = isset($_POST['email'])?$_POST['email']:null;
    $text = isset($_POST['text'])?$_POST['text']:null;
    
    if (!empty($jmeno) && strlen($jmeno) >= 5) {
        if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (!empty($text) && strlen($text) >= 20) {
                $dotaz = mysqli_query($dbspojeni, "INSERT INTO kontakty (id, email, jmeno, vzkaz) VALUES (null, '$email', '$jmeno', '$text');");
                if ($dotaz) {
                    hlaska("Zpráva byla úspěšně odeslána. Děkujeme za kontaktování.");
                    Header("Location: /kontakty.php?sent=1");
                    die();
                } else {
                    hlaska("Zprávu se nezdařilo odeslat. Nastala interní chyba.");
                }
            } else {
                hlaska("Zpráva je příliš krátká.");
            }
        } else {
            hlaska("E-mail je příliš krátký nebo není ve tvaru e-mailu.");
        }
    } else {
        hlaska("Jméno je příliš krátké.");
    }
    
    Header("Location: /kontakty.php?err=1");
    die();
}
?>

<h1>Kontaktujte nás</h1>
<div class="admin-login-form">
        <form method="POST" action="">
            <input type="hidden" name="token" value="kontaktni_formular">

            <label><strong>E-mail:</strong></label>
            <input type="text" name="email" placeholder="Vložte e-mail"><br>

            <label><strong>Jméno:</strong></label>
            <input type="text" name="jmeno" placeholder="Vložte své jméno"><br>

            <label><strong>Text:</strong></label>
            <textarea name="text" rows="6"></textarea>

            <div class="text-right">
                <button class="btn btn-primary">Odeslat zprávu</button>
            </div>
        </form>
    </div>