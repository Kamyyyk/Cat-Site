<?php
session_start();
if (!isset($_SESSION['zalogowany'])) {
    header('Location: index.php');
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
    <?php
    echo "<p> Witaj ".$_SESSION['user'];
    echo "<p>Twoje pieniądze: ".$_SESSION['money']."$"."<br/>"."<br/>";
    echo  '[<a href="logout.php"> Wyloguj się</a>] </p>';
    ?>

</body>
</html>
