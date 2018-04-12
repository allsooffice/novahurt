<?php
include('db_connect.php');
$order_id = $_GET['order_id'];
$product = $_GET['product'];
$quantity = $_GET['quantity'];
$price = $_GET['price'];

$pobieranie = $mysqli->query("SELECT * FROM produkty WHERE model = '$product' LIMIT 1");
                while ($produkt=mysqli_fetch_array($pobieranie) )
                {
                    $cena_zakupu = $produkt['cena_zakupu'];    
                }

$dodawanie = "insert into sold_products (id, order_id, product, quantity, price, cena_zakupu) values ('', '$order_id', '$product', '$quantity', '$price', '$cena_zakupu')";
// wykonanie dodawania do bazy
$wynik = $mysqli->query($dodawanie);


?>




