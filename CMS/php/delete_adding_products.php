<?php
include('db_connect.php');
$id = $_GET['id'];

    $usuwanie = "DELETE FROM sold_products WHERE id = $id";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);
?>