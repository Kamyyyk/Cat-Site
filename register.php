<?php
session_start();
if (isset($_POST['email'])) {
    $everything_ok = true;

    $nick = $_POST['nick'];

    //Sprawdzenie długości nicku
    if ((strlen($nick) < 3) || (strlen($nick) > 20)) {
        $everything_ok = false;
        $_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków";
    }

    if (ctype_alnum($nick) == false) {
        $everything_ok = false;
        $_SESSION['e_nick'] = "Nick może się składać tylko z liter i cyfr";
    }

    //Sprawdzenie poprawności emaila
    $email = $_POST['email'];
    $emailg = filter_var($email,FILTER_SANITIZE_EMAIL);
    if ((filter_var($emailg,FILTER_VALIDATE_EMAIL)==false) || ($emailg != $email)){
        $everything_ok = false;
        $_SESSION['e_email'] = "Podaj poprawny adres email!";
    }

    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ((strlen($pass1) < 3) || (strlen($pass1) > 20)) {
        $everything_ok = false;
        $_SESSION['e_pass'] = "Hasło musi posiadać od 3 do 20 znaków";

    }
    $hashpass = password_hash($pass1, PASSWORD_DEFAULT);

    if ($pass1 != $pass2) {
        $everything_ok = false;
        $_SESSION['e_pass'] = "Podane hasła nie zgadzają sie ze sobą";
    }

    if(!isset($_POST['rules'])) {
        $everything_ok = false;
        $_SESSION['e_rules'] = "Zaakceptuj regulamin";
    }

    if($everything_ok = true) {
        echo "wszystko działa";
    }

}
?>

    <!DOCTYPE HTML>
    <html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
        <title>Strona testowa jakiejś gry, z logowaniem :o</title>
        <link rel="stylesheet" href="styles/zarejestru.css">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>


    <body>
    <div class = "hello">
        <h1>Strona rejestracji</h1>
    </div>

    <div class="register">
        <form  method="post">
            <label>Nick: <br/> <input type="text" name="nick"> <br/></label>
            <?php
            if (isset($_SESSION['e_nick'])) {
                echo  $_SESSION['e_nick'].'<br/>';
                unset($_SESSION['e_nick']);
            }
            ?>
            <label>E-mail: <br/> <input type="text" name="email"> <br/> </label>
            <?php
            if (isset($_SESSION['e_email'])) {
                echo  $_SESSION['e_email'].'<br/>';
                unset($_SESSION['e_email']);unset($_SESSION['e_email']);
            }
            ?>
            <label>Hasło: <br/> <input type="password" name="pass1"> <br/> </label>
            <?php
            if (isset($_SESSION['e_pass'])) {
                echo  $_SESSION['e_pass'].'<br/>';
                unset($_SESSION['e_pass']);
            }
            ?>
            <label>Powtórz hasło <br/> <input type="password" name="pass2"> <br/> </label>
            <?php
            if (isset($_SESSION['e_pass'])) {
                echo  $_SESSION['e_pass'].'<br/>';
                unset($_SESSION['e_pass']);
            }
            ?>
            <label>Zaakceptuj regulamin <input type="checkbox" name="rules"> <br/></label>
            <?php
            if (isset($_SESSION['e_rules'])) {
                echo  $_SESSION['e_rules'].'<br/>';
                unset($_SESSION['e_rules']);
            }
            ?>
            <div class="g-recaptcha" data-sitekey="6LdHQHcaAAAAALM6VRfCaerRAoPdZOQGDAzSqG4Q"></div>
            <br/>
            <input type="submit" value="Zarejestruj się" />
        </form>
    </div>
    </body>
    </html>

