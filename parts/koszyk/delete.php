<?php
include('../../db_connect.php');

if (isset($_GET['id']))
{
    $id= $_GET['id'];
    $usuwanie = "DELETE FROM card WHERE id = $id";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);
                
    


    header('Location: ../../koszyk.php#start');
            
}





?>