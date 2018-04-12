<?php
session_start();
include('db_connect.php');
$order_id = $_GET['order'];
$paczki = $_GET['pack'];
$magazynier = $_GET['magazynier'];
$data = date('Y-m-d H:i:s');

$pobieranie = $mysqli->query("SELECT * FROM magazyn WHERE order_id = '$order_id'");
    $liczba_wierszy = mysqli_num_rows($pobieranie);
    if($liczba_wierszy > 0)
    {
       echo 'To zamówienie jest już wprowadzone';
    }
else
   {
   $dodawanie = "insert into magazyn (id, data_pakowania, order_id, liczba_paczek, zapakowal) values ('', '$data', '$order_id', '$paczki', '$magazynier')";
   // wykonanie dodawania do bazy
   $wynik = $mysqli->query($dodawanie);
   echo '<i class="icon-ok"></i>Zamówienie dodano pomyślnie';
   }
?>




