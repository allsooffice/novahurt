<?php
session_start();
include('db_connect.php');
if(isset($_GET['id']))
{
$id = $_GET['id'];
echo '<ol>';
$total_price = '0';
$pobieranie = $mysqli->query("SELECT * FROM sold_products WHERE order_id = '$id' ORDER BY id DESC");
                while ($produkt=mysqli_fetch_array($pobieranie) )
                {
                    echo'
                    <li id="list'.$produkt['id'].'"><input type="text" class="form-input product" placeholder="'.$produkt['product'].'" disabled>
                    <input type="number" class="form-input quantity" value="'.$produkt['quantity'].'" disabled>
                    <input id="all-price" type="text" class="form-input quantity" value="'.$produkt['price'].'" disabled> PLN
                    <i onclick="trash('.$produkt['id'].')" class="icon-minus delete-new" title="Usuń"></i></li>';
                    $total_price += $produkt['price'];
                    
                }
echo '<input id="calculate" type="hidden" value="'.$total_price.'">';
echo '</ol>';
}



?>




