<?php
session_start();
include('db_connect.php');
$where = $_GET['order'];
$pobieranie = $mysqli->query("SELECT * FROM orders WHERE order_number = '$where'");
                $liczba_wierszy = mysqli_num_rows($pobieranie);

                if($liczba_wierszy < 1)
                {
                  echo 'Nie ma takiego zamówienia - sprawdź numer';
                }
$mysqli->close();
?>




