<?php
$db_server = 'sql16.lh.pl';
$db_user = 'serwer13788';
$db_pass = 'Lugano2016$';
$db_name = 'serwer13788_novahurt';

$mysqli = new mysqli($db_server,$db_user,$db_pass,$db_name);
$mysqli ->set_charset("utf8");


if (mysqli_connect_errno() )
{
    echo 'Błąd bazy danych';
}

?>