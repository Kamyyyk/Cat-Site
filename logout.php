<?php
session_start();
//Po kliknięicu wyloguj sesja zostanie zamknięta a użytkownik wróci na stronę logowania
session_unset();
header('Location: index.php');
?>
