<!DOCTYPE HTML>
<?php
session_start();
if(isset($_GET['mail_login']))
{
	if($_GET['mail_login'] == true)
	{
		$_SESSION['zalogowany'] = true;
	}
}

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
	<title>Weryfikacja kontrahentów - Panel Administracyjny</title>
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
<style>
	.accepted
	{
		color: forestgreen;
	}
	
	.new
	{
		background-color: darkorange;
		color: #fff;
	}
	
	.delete
	{
		color: darkred;
	}
	
	.id-first, .id
	{
		width: 50px;
	}
	
	.date-first, .date
	{
		width: 100px;
	}
	
	.cust-first, .cust
	{
		width: 200px;
		padding: 5px;
		box-sizing: border-box;
	}
	
	.city-first, .payment
	{
		width: 280px;
	}
	
	.price-first, .price
	{
		width: 100px;
	}
	
	.products-first, .products
	{
		width: 100px;
		text-align: center;
	}
	
	.edit-first, .edit
	{
		width: 75px;
		text-align: center;
	}
</style>
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
    s        
        </div>
        <div class="content">
            <h1>Kontrahenci:</h1>

            <div class="order-list">
               <div class="order-row">
                    <div class="order-col id-first">
                        L.P
                    </div>
                    <div class="order-col date-first">
                        Data rejestracji
                    </div>
                    <div class="order-col cust-first">
                        Kontrahent
                    </div>
                    <div class="order-col city-first">
                        Kontakt
                    </div>
                    <div class="order-col price-first">
                        Status
                    </div>
                    <div class="order-col products-first">
                        Data modyfikacji
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
<script src="js/kontrahenci.js"></script>
<script>
		$("#kontrahenci-wer").parent().addClass("menu-active");
		$("#kontrahenci-wer").addClass("active-color");
</script>
</html>