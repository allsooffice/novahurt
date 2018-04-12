<?php
include('../../db_connect.php');

if (isset($_GET['id']))
{
    $id= $_GET['id'];
    $usuwanie = "DELETE FROM zamowienie WHERE id = $id";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);
                
    


    header('Location: ../zamowienia_detal.php#start');
            
}





?>