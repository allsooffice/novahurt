<?php
include('../../db_connect.php');

if (isset($_GET['id']))
{
    $id= $_GET['id'];
    $zmien = "UPDATE zamowienie SET status = 'przyjęte' WHERE id = $id";
                        // wykonanie dodawania do bazy
                        $wynik = $mysqli->query($zmien);
                
    


    header('Location: ../transakcje_hurtowe.php#start');
            
}





?>