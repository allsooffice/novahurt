<?php
include('../../db_connect.php');

if (isset($_GET['id']))
{
    $id= $_GET['id'];
    $usuwanie = "DELETE FROM produkty WHERE id = $id";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);
                
    

    $_SESSION['usuniete'] = '<div id="zielony">Produkt został usunięty</div>';
    header('Location: ../produkty.php#start');
            
}





?>