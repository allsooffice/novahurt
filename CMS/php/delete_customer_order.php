<?php
include('db_connect.php');
$order_id = $_GET['order_id'];
$session = $_GET['session'];

    $usuwanie = "DELETE FROM sell WHERE id = '$order_id'";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);

    $usuwanie = "DELETE FROM card WHERE session_id = '$session'";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);

?>