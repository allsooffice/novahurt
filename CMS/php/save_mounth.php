<?php
session_start();
include('db_connect.php');
if(isset($_POST['product']))
{
$dzien = date('d');
$miesiac = date('m')-1;
	if($miesiac == '00')
	{
		$miesiac = '12';
		$rok = date('Y')-1;
	}
	else
	{
		$rok = date('Y');
	}
$data = $rok.'-'.$miesiac.'-'.$dzien;
    for($i=0;$i<count($_POST['product']);$i++)
    {
        //pobieranie danych z pól
        $product = $_POST['product'][$i];
        $quantity = $_POST['quantity'][$i];
        $buy_price = $_POST['buy_price'][$i];
        $sold_allegro = $_POST['sold_allegro'][$i];
        $sold_olx = $_POST['sold_olx'][$i];
        $sold_poza = $_POST['sold_poza'][$i];
        $sold_facebook = $_POST['sold_facebook'][$i];
        $product_sold = $_POST['product_sold'][$i];
        $product_buy = $_POST['product_buy'][$i];
        $profit = $_POST['profit'][$i];
        @$zakup_allegro = $_POST['zakup_allegro'][$i];
        @$zakup_olx = $_POST['zakup_olx'][$i];
        @$zakup_poza = $_POST['zakup_poza'][$i];
        @$zakup_facebook = $_POST['zakup_facebook'][$i];
        @$sprzedaz_allegro = $_POST['sprzedaz_allegro'][$i];
        @$sprzedaz_olx = $_POST['sprzedaz_olx'][$i];
        @$sprzedaz_poza = $_POST['sprzedaz_poza'][$i];
        @$sprzedaz_facebook = $_POST['sprzedaz_facebook'][$i];
        
        $dodawanie = "insert into closed_sold (id, data, product, quantity, one_piece_price, allegro, olx, poza, facebook, sprzedaz, zakup, zysk_brutto, zakup_allegro, zakup_olx, zakup_poza, zakup_facebook, sprzedaz_allegro, sprzedaz_olx, sprzedaz_poza, sprzedaz_facebook) values ('', '$data', '$product', '$quantity', '$buy_price', '$sold_allegro', '$sold_olx', '$sold_poza', '$sold_facebook', '$product_sold', '$product_buy', '$profit', '$zakup_allegro', '$zakup_olx', '$zakup_poza', '$zakup_facebook', '$sprzedaz_allegro', '$sprzedaz_olx', '$sprzedaz_poza', '$sprzedaz_facebook')";
        // wykonanie dodawania do bazy
        $wynik = $mysqli->query($dodawanie);
    }
	
	$licznik = "UPDATE sold_products SET status = 'zamkniety' WHERE status <> 'zamkniety' ";
     //wykonanie dodawania do bazy
   $licze = $mysqli->query($licznik);
   $zamowienia = "UPDATE orders SET status = 'zamkniety' WHERE status <> 'zamkniety' ";
     //wykonanie dodawania do bazy
   $update = $mysqli->query($zamowienia);

    
    if($miesiac == '01')
    {
        $mounth = 'styczeń';
    }
    if($miesiac == '02')
    {
        $mounth = 'luty';
    }
    if($miesiac == '03')
    {
        $mounth = 'marzec';
    }
    if($miesiac == '04')
    {
        $mounth = 'kwiecień';
    }
    if($miesiac == '05')
    {
        $mounth = 'maj';
    }
    if($miesiac == '06')
    {
        $mounth = 'czerwiec';
    }
    if($miesiac == '07')
    {
        $mounth = 'lipiec';
    }
    if($miesiac == '08')
    {
        $mounth = 'sierpień';
    }
    if($miesiac == '09')
    {
        $mounth = 'wrzesień';
    }
    if($miesiac == '10')
    {
        $mounth = 'październik';
    }
    if($miesiac == '11')
    {
        $mounth = 'listopad';
    }
    if($miesiac == '12')
    {
        $mounth = 'grudzień';
    }
}

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Sprzedaz - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="../style/style.css" rel="stylesheet" type="text/css" />
	<link href="../style/sold.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style/loading.css"/>
	<link href="../fontello/css/fontello.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<script src="../js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>

<body>
   <div class="box">
       <div class="popup">
           <h1>Zmiany zostały zapisane</h1>
           <ul>
               <li>Lista prduktów</li>
               <li id="close">Zamknij</li>
           </ul>
       </div>
   </div>
    <div class="wrapper">
       
        <div class="menu">
          
           <h2><i class="icon-menu"></i> Menu</h2>
           <?php
            include('../parts/menu.php');
            ?>
            
        </div>
        <div class="content">
            <h1>Raport na miesiąc <?php echo $mounth; ?> utworzony pomyślnie :)</h1>
            <h3>Teraz możesz przejść do:</h3>
            <ul>
                <li><a href="../raport_miesieczny.php">Raportów miesięcznych</a></li>
                <li><a href="../lista_produktow.php">Listy produktów</a></li>
            </ul>
        </div>
        
        <div style="clear: both;"></div>
        

        
    </div>
</body>
<script src="../js/menu.js"></script>
</html>