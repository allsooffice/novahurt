<?php
$db_server = 'localhost';
$db_user = 'root';
$db_pass = 'bobola20';
$db_name = 'novahurt';

$mysqli = new mysqli($db_server,$db_user,$db_pass,$db_name);
$mysqli ->set_charset("utf8");


if (mysqli_connect_errno() )
{
    echo 'Błąd bazy danych';
}

?>