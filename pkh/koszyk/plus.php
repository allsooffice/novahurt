<?php
include('../db_connect.php');

if (isset($_GET['id']))
{
    $id= $_GET['id'];
    $mniej = "UPDATE koszyk SET ilosc = ilosc+1 WHERE id = $id";
                        // wykonanie dodawania do bazy
                        $wynik = $mysqli->query($mniej);
                
    


    header('Location: ../koszyk.php#start');
            
}





?>