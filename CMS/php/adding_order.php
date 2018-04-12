<?php
session_start();
include('db_connect.php');
$order_id = $_GET['order_id'];
$customer = strip_tags($_GET['customer']);
$method = $_GET['platnosc'];
$total = $_GET['total'];
$data = date('Y-m-d H:i:s');
$city = strip_tags($_GET['city']);
$shop = $_GET['shop'];

$dodawanie = "insert into orders (id, data, customer, method, order_number, total_price, city, shop) values ('', '$data', '$customer', '$method', '$order_id', '$total', '$city', '$shop')";
// wykonanie dodawania do bazy
$wynik = $mysqli->query($dodawanie);

$licznik = "UPDATE order_number SET number = number+1 WHERE id = 1";
                 // wykonanie dodawania do bazy
                 $licze = $mysqli->query($licznik);
?>




