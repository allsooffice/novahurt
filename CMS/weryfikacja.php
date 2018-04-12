<!DOCTYPE HTML>
<?php
session_start();
if($_SESSION['zalogowany'] != true)
{
   header('Location: index.php');
}
$data = date("Y-m-d H:i:s");
$_SESSION['user_session_id'] = session_id();
include('php/db_connect.php');


 $usuwanie = "DELETE FROM orders WHERE data < SUBDATE(NOW(), INTERVAL 60 DAY) AND status = 'zamkniety'";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);
 $usuwanie_zakupow = "DELETE FROM sold_products WHERE create_time < SUBDATE(NOW(), INTERVAL 60 DAY) AND status = 'zamkniety'";
            // wykonanie usuwania z bazy
            $wynik_zakupow = $mysqli->query($usuwanie_zakupow);

?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Weryfikacja zamówień - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link href="style/weryfikacja.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style/loading.css"/>
	<link href="fontello/css/fontello.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>

<body>
     <?php
            include('parts/log_out.php');
      ?>
    <div class="wrapper">
       
        <div class="menu">
          
           <h2><i class="icon-menu"></i> Menu</h2>
           <?php
            include('parts/menu.php');
            ?>
            
        </div>
        <div class="content">
            <h1>Weryfikacja zamówień:</h1>
            <div class="new">
            <input id="odbiorca" type="text" class="form-input name" placeholder="Odbiorca">
            <select class="select-input">
              <option value="select">Płatność</option>
              <option value="przelew">Przelew</option>
              <option value="pobranie">Pobranie</option>
              <option value="karta">Karta</option>
              <option value="gotówka">Gotówka</option>
            </select>
            <br>
            <input id="miejscowosc" type="text" class="form-input city-input" placeholder="Miejscowość">
            <select id="shop" class="select-input place">
              <option value="select">Sprzedaż</option>
              <option value="Allegro">Allegro</option>
              <option value="Hurtownia / OLX">Hurtownia / OLX</option>
              <option value="Poza Allegro">Poza Allegro</option>
              <option value="Facebook">Facebook</option>
            </select>
            <br>
            <input id="product_name" type="text" class="form-input product" placeholder="Produkt">
            <div class="autocomplete product">
            </div>
            <input id="product_quantity" type="text" class="form-input quantity" placeholder="Sztuk">
            <input id="all-price" type="text" class="form-input quantity" placeholder="Cena"> PLN
            <input type="hidden" id="absolute-total" value="">
            <i id="next-product" class="icon-plus add-new" title="Dodaj kolejny produkt"></i><br>
            <div class="added-products">
            </div>
            <div class="total">
                Suma: <span id="total-price">0</span> PLN
            </div>
            
            <button id="add-order" class="btn confirm" title="Dodaj zamówienie">Dodaj</button>
            </div>
            <div class="order-list">
               <div class="order-row">
                    <div class="order-col id-first">
                        Numer
                    </div>
                    <div class="order-col date-first">
                        Data
                    </div>
                    <div class="order-col cust-first">
                        Odbiorca
                    </div>
                    <div class="order-col city-first">
                        Miejscowość
                    </div>
                    <div class="order-col price-first">
                        Kwota
                    </div>
                    <div class="order-col products-first">
                        Produkt
                    </div>
                    <div class="order-col edit-first">
                        
                    </div>
                </div>
                <div class="order-listing">
                </div>
            </div>
        </div>
        <div style="clear: both;"></div>
        <div class="order-number-taker">
            <?php
                $numer = $mysqli->query("SELECT number FROM order_number WHERE id = 1 ");
                while ($pokaz=mysqli_fetch_array($numer) )
                {
                $new_number = $pokaz['number'];

                }
                echo '<input type="hidden" id="order-id" value="'.$new_number.'">';
            ?>
        </div>

    <div class="info-box">
            Zamówienie dodane
    </div>
    <div class="info-box-error">
            Sprawdź formularz
    </div>    
    </div>
</body>
<script src="js/menu.js"></script>
<script src="js/weryfikacja.js"></script>
<script src="js/weryfikacja-edit.js"></script>
<script>
		$("#order-wer").parent().addClass("menu-active");
		$("#order-wer").addClass("active-color");
</script>
</html>