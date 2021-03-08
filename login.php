<?php
session_start();
if (!isset($_POST['login']) || (!isset($_POST['password']))) {
    header('Location: index.php');
    exit();
}




require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);



$connect = new mysqli($host, $db_user,$db_password,$db_name);

    if ($connect->connect_errno != 0) {
        echo "Błąd." . $connect->connect_errno;
    } else {
        $login = $_POST['login'];
        $password = $_POST['password'];
        //Ustawienie encji dla loginu
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");


        if ($result = @$connect->query(
            sprintf("SELECT * FROM users WHERE uzytkownik = '%s'",
                mysqli_real_escape_string($connect, $login)))) {
            $how_many_users = $result->num_rows;

            if ($how_many_users > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['haslo'])) {
                    $_SESSION['zalogowany'] = true;
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['user'] = $row['uzytkownik'];
                    $_SESSION['money'] = $row['pieniadze'];
                    unset($_SESSION['blad']);
                    $result->free_result();
                    header('Location:gra.php');
                } else {
                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    header('Location: index.php');
                }
            } else {
                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: index.php');
            }
        }
        $connect->close();
    }


/*
try {
    $connect = new mysqli($host, $db_user,$db_password,$db_name);
    //Jeśli nie udało się nawiązać połączenia z bazą
    if($connect->connect_errno!=0) {
        throw new Exception(mysqli_connect_errno());
        //Jeśli udało sie nawiązać połączenie z bazą
    } else {
        //wczytaj wartości
        $login = $_POST['login'];
        $password = $_POST['password'];

    }

    if($result = $connect->query(
        sprintf("SELECT * FROM users WHERE uzytkownik = %s", mysqli_real_escape_string($connect,$login)))) {
        $how_many_users = $result->num_rows;
        if ($how_many_users > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['haslo'])) {
                $_SESSION['zalogowany'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['uzytkownik'] = $row['uzytkownik'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['pieniadze'] = $row['pieniadze'];
                unset($_SESSION['blad']);
                $result-> free_result();
                header('Location: gra.php');
           }  else {
                $_SESSION['blad'] = '<span "style= color:red"> Niepoprawny login lub hasło! </span>';
                header('Location: index.php');
            }
        } else {
            $_SESSION['blad'] = '<span "style= color:red"> Niepoprawny login lub hasło! </span>';
            header('Location: index.php');
        }
    } else {
        throw new Exception($connect->error);
    }
    $connect->close();
} catch (Exception $e) {
    echo '<span "style=color:red"> Błąd serwera... </span>';
    echo '<br/> Informacja deweloperska';
}
*/


