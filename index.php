<?php
session_start();
if (isset($_SESSION['zalogowany']) && (isset($_SESSION['zalogowany']) == true )) {
    header('Location: gra.php');
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl";>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
    <title>Strona testowa jakiejś gry, z logowaniem :o</title>
    <link rel="stylesheet" href="styles/view.css">
</head>


<body>
<div class = "hello">
    <h1>Witaj na stronie gry która może kiedyś będzie o kotach. Zaloguj się aby przejśc dalej</h1>
</div>

<div class="login">
    <form action="login.php" method="post">
        <label>Login: <br/> <input type="text" name="login"> <br/></label>
        <label>Hasło: <br/> <input type="password" name="password"> <br/> </label>
        <input type="submit" value="Zaloguj się"> <br/>
    </form>
    <form action='register.php' method="post">
        <input type="submit" value="Zarejestruj się"> <br/>
    </form>
    <?php
    if(isset($_SESSION['blad']))
        echo $_SESSION['blad'];
    ?>

</div>

</body>

</html>


