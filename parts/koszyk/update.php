<?php
include('../../db_connect.php');

if (isset($_GET['id']))
{
    $id = $_GET['id'];
    $quantity= $_GET['quantity'];
    $mniej = "UPDATE card SET quantity = '$quantity' WHERE id = '$id'";
                        // wykonanie dodawania do bazy
                        $wynik = $mysqli->query($mniej);
}





?>