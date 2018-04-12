<?php
session_start();
include('db_connect.php');
if(isset($_GET['customer']))
{
	$where = str_replace("'", '', $_GET['customer']);
   $where = strip_tags($_GET['customer']);
}
else
{
    $where = '';
}
$i = 0;


$ileDni = 30 * 24 * 60 * 60; //30 dni w sekundach
$odKiedy = time() - $ileDni; //Data w formacie unixowym "30 dni temu"

$pobieranie = $mysqli->query("SELECT * FROM orders WHERE customer LIKE '%$where%' AND data >= SUBDATE(NOW(), INTERVAL 30 DAY) ORDER BY id DESC");
                $liczba_wierszy = mysqli_num_rows($pobieranie);
                if($liczba_wierszy > 0)
                {
                while ($produkt=mysqli_fetch_array($pobieranie) )
                {
                    if($i % 2 == 0)
                    {
                        echo '<div id="o-row-'.$produkt['order_number'].'" class="order-row">';
                    }
                    else
                    {
                        echo '<div id="o-row-'.$produkt['order_number'].'" class="order-row second">';
                    }
                    echo'
                    
                    <div class="order-col id">
                        E'.$produkt['order_number'].'
                    </div>
                    <div class="order-col date">
                        '.$produkt['data'].'
                    </div>
                    <div class="order-col cust">
                        '.$produkt['customer'].'
                    </div>
                    <div class="order-col payment">
                        '.$produkt['city'].'
                    </div>
                    <div class="order-col price">
                        '.$produkt['total_price'].' zł
                    </div>
                    <div class="order-col products">';
                    $order = $produkt['order_number'];
                    $produkty = $mysqli->query("SELECT * FROM sold_products WHERE order_id = '$order' ");
                    while ($show=mysqli_fetch_array($produkty) )
                    {
                        echo '&#9679; '.$show['product'].' x '.$show['quantity'].' ('.$show['price'].' PLN)</br>';
                    }
                    echo'</div>
                    <div class="order-col edit">
                        <span class="edit-button" id="'.$produkt['order_number'].'"><i class="icon-trash"></i></span>
                    </div>
                    <div id="row-id-'.$produkt['order_number'].'" class="edit-menu">
                          <ol>
                              <li class="delete-order" name="'.$produkt['order_number'].'">Usuń</li>
                              <li class="dont-delete" name="'.$produkt['order_number'].'">Anuluj</li>
                          </ol>
                    </div>
                </div>';
                $i++;
                }
                }
else
{
    echo '<div class="no-records">Brak podobnych zamówień</div>';
}


?>




