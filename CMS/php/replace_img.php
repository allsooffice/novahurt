<?php
include('db_connect.php');

if(isset($_POST['element']))
{   $i = 1;
    foreach ($_POST['element'] as $id)
    {
    $licznik = "UPDATE images SET place = '$i' WHERE id = '$id' ";
     //wykonanie dodawania do bazy
    $licze = $mysqli->query($licznik);
    $i++;
    }
}

?>