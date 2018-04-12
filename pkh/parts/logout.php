<?php
include('../db_connect.php');
session_start();
$id_klienta = $_SESSION['id_klienta'];
unset($_SESSION['zalogowany']);

$_SESSION['zalogowany'] = false;

 $usuwanie = "DELETE FROM card WHERE session_id = '$id_klienta'";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);
header('Location: ../../index.php#start');
?>