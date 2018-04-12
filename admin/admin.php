<!DOCTYPE HTML>

<?php
session_start();

if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php#start');  
}


?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Administracja - NOVAHURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->

</head>

<body>
    <?php
    include('head.php');
    ?>
    <div id="index_contener">
        
        <a href="kontrahenci.php#start" title="Przejdź do listy kontrahentów hurtowych">
        <div class="index_button">
            Lista Kontrahentów Hurtowych
        </div>
        </a>
        
        <a href="transakcje_hurtowe.php#start" title="Przejdź do listy transakcji hurtowych">
        <div class="index_button">
            Lista Transakcji Hurtowych
        </div>
        </a>    
        
        <a href="klienci.php#start" title="Przejdź do listy klientów detalicznych">
        <div class="index_button">
            Lista Klientów Detalicznych
        </div>
        </a>
        
        <a href="zamowienia_detal.php#start" title="Przejdź do listy zamówień detalicznych">
        <div class="index_button">
            Lista Zamówień Detalicznych
        </div>
        </a>
        
        <a href="produkty.php#start" title="Przejdź do listy produktów">
        <div class="index_button">
            Lista produktów
        </div>
        </a>
        
        <a href="dodaj_produkt.php" title="Przejdź do listy produktów">
        <div class="index_button" title="Dodaj produkt">
            Dodaj produkt
        </div>
        </a>
            
        <div style="clear:both"></div>
    
        <a href="dodaj_transakcje.php" title="Dodaj zamówienie klienta">
        <div class="index_button" title="Dodaj produkt">
            Dodaj zamówienie
        </div>
        </a>
        <div class="index_button"></div>
        <div class="index_button"></div>
        
        <a href="newsletter.php" title="Wyślij newsletter">
        <div class="index_button">
           Wyślij newsletter 
        </div>
        </a>
        <a href="https://secure.przelewy24.pl/panel/sprzedawca.php" target="_blank">
        <div class="index_button">
        Przelewy    
        <img src="jpg/przelewy.jpg" width="145" height="" align=""/>    
        </div>
        </a>
        
            
        <a href="http://kurier.k-ex.pl/" target="_blank" title="Zamów kuriera">
        <div class="index_button">
            Zamów kuriera
            <img src="jpg/k_ex.jpg" width="145" height="" align=""/>
        </div>
        </a>
      <?php
      include('../db_connect.php');  
    $rezultat = $mysqli->query("SELECT * FROM statystyki WHERE id=1 LIMIT 1");
                
    while ($produkt=mysqli_fetch_array($rezultat) ) {
      $wejscia = $produkt['enter_index'];
    }
       ?>
        <div style="clear:both"></div>
        <div id="stats">
            
                    Wejść na strone główną: 
                   
                    <?php echo $wejscia; ?>
                  
        </div>
    </div>

   
        
        
       
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    
    
    


</body>


</html>