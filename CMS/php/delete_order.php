<?php
include('db_connect.php');
$order_id = $_GET['order_id'];

    $usuwanie = "DELETE FROM sold_products WHERE order_id = '$order_id'";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);

    $usuwanie_order = "DELETE FROM orders WHERE order_number = '$order_id'";
            // wykonanie usuwania z bazy
            $delete = $mysqli->query($usuwanie_order);
?>