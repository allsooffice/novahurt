<!DOCTYPE HTML>
<?php
session_start();
include('db_connect.php');
$data = date('d.m.y H:i');

if(isset($_POST['pos_id']))
{
    $order = $_POST['order_id'];
    $session = $_POST['session_id'];
    $kwota = $_POST['amount'];
    $status = $_POST['response_code'];
    if($status == '20')
    {
       $status = 'Transakcja zainicjowana'; 
    }
    if($status == '30')
    {
       $status = 'Zapłacono'; 
    }
    if($status == '35')
    {
       $status = 'Zapłacono'; 
    }
    if($status == '40')
    {
       $status = '<span style="color: red;">Transakcja odrzucona</span>';
    }
    if($status == '21')
    {
       $status = '<span style="color: red;">Błąd technichniczny</span>';
    }
    $fdp_id = $_POST['transaction_id'];
    $hash_platnosci_karta = $_POST['cc_number_hash'];
    $bin_karty = $_POST['bin'];
    $typ_karty = $_POST['card_type'];
    $kod_autoryzacji = $_POST['auth_code'];
    $wygenerowany_klucz = $_POST['controlData'];
    $kwota = $kwota / 100;
    
    $product = $mysqli->query("SELECT * FROM sell WHERE id = '$order'");
    while ($dane_zam=mysqli_fetch_array($product) ) 
    {
      $imie = $dane_zam['customer'];
      $nazwisko = $dane_zam['nazwisko'];
      $kod_pocztowy = $dane_zam['kod_pocztowy'];
      $miejscowosc = $dane_zam['miejscowosc'];
      $ulica = $dane_zam['ulica'];
      $numer_budynku = $dane_zam['numer_budynku'];
      $numer_lokalu = $dane_zam['numer_lokalu'];
      $sposob_dostawy = $dane_zam['sposob_dostawy'];
      $sposob_platnosci = $dane_zam['sposob_platnosci'];
      $ubezpieczenie = $dane_zam['ubezpieczenie'];
      $dokument = $dane_zam['dokument'];
      $ankieta = $dane_zam['ankieta'];
      $dodatkowe = $dane_zam['dodatkowe'];
      $suma_zamowienia = $dane_zam['suma_zamowienia'];
      $cena_dostawy = $dane_zam['cena_dostawy'];
      $data_zam = $dane_zam['data'];
      $sygnatura = $dane_zam['sygnatura'];
      if($numer_lokalu != '')
      {
          $numer_lokalu = ' / '.$numer_lokalu;
      }
      $email = $dane_zam['mail'];
      $telefon = $dane_zam['telefon'];
      $zakup_produktow = $suma_zamowienia - $cena_dostawy - $ubezpieczenie;
	 }
   
       


}

else
{
    header('Location: index.php#start'); 
}

?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Dziękujemy za zakupy - NOVA HURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, vova, hurt, novahurt, zascianki" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->

</head>

<body>
    <?php
    include('parts/head.php');
    ?>
 
    <div id="tresc_informator"><div class="tytuly">Dziękujemy za zakupy w naszym sklepie!</div><a name="start"></a>
    <div id="odbior_content">
        
        Dziekujemy za dokonanie płatności<br>
        Na adres mailowy: <?php
        echo $email;
        ?> zostało wysłane potwierdzenie zamówienia.<br><br>
        
       
       	 <?php
        	 if($sposob_dostawy == 'Odbiór osobisty')
		 {
			 echo 'Zapraszamy po odbiór w dniach:<br>
                pon - pt (w godz. 8:00 - 17:00).<br><br>
                            Adres:<br>
                        15-521 Zaścianki<br>
                ul. Szosa Baranowicka 56A <br>
                    Infolinia : 53 77 00 674<br><br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d711.7838815064855!2d23.2381065518273!3d53.125523634633005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ffedf9ad3b51d%3A0xf8400e5eaf830269!2sBaranowicka+56%2C+16-030+Za%C5%9Bcianki!5e0!3m2!1spl!2spl!4v1460381714898" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe><br><br><br>';
			 }
				 else
				 {
					 echo 'Towar zostanie wysłany do 24 godz (w dni robocze).<br><br>';
				 }
		 
         ?>  
          W razie pytań zapraszamy do kontkatu:<br>
        email: info@novahurt.pl<br>
        infolinia: 782 70 00 94
        
            
    </div>
    </div>
        
    
        
        <div style="clear:both"></div>
        <div id="dolmenu">
            
            
            <a href="#">
            <div id="menu_pkh">Panel kontrahenta<br>hurtowego</div>
            </a>
            <a href="dane.html#16">
            <div id="menu_faq">FAQ</div>
            </a>
            <a href="dane.html#10">
            <div id="menu_reklamacje">reklamacje</div>
            </a>
            <a href="dane.html#11">
            <div id="menu_zwroty">zwroty</div>
            </a>
        <div style="clear:both"></div>
            
            <a href="dane.html#3">
            <div id="menu_kontakt">
                <div class="tittle">kontakt</div> 
                <img src="jpg/kontakt.jpg" width="" height="" align="center"/>
            </div>
            </a> 
                
            <a href="dane.html#2">
            <div id="menu_dlaczego">
                <div class="tittle">dlaczego my?</div> 
                <img src="jpg/dlaczego.jpg" width="562" height="" align="center"/>
            </div>
            </a>    
            
            <div style="clear:both"></div>
            
            <a href="dane.html#14">
            <div class="menu_4"><div class="tittle">dostawa</div>
                <img src="jpg/dostawa.jpg" width="180" height="130" align=""/>
            </div>
            </a>
            
            <a href="dane.html#6">
            <div class="menu_4"><div class="tittle">płatności</div>
                <img src="jpg/platnosci.jpg" width="180" height="130" align=""/>
            </div>
            </a>    
            
            <a href="dane.html#1">
            <div class="menu_4"><div class="tittle">o nas</div>
                <img src="jpg/onas.jpg" width="180" height="130" align=""/>
            </div>
            </a>
            
            <a href="dane.html#9">
            <div class="menu_4"><div class="tittle">regulamin</div>
                <img src="jpg/regulamin.jpg" width="180" height="130" align=""/>
            </div>
            </a>
            
            <a href="dane.html#4">
            <div class="menu_4"><div class="tittle">gdzie jesteśmy</div>
                <img src="jpg/map.png" width="160" height="130" align=""/>
            </div>
            </a>    
            
            <a href="https://www.facebook.com/novahurtpl/" target="_blank">
            <div class="menu_4"><div class="tittle">dołącz do nas</div>
                <img src="jpg/facebook.png" width="145" height="130" align=""/>
            </div>
            </a>
            <div style="clear:both"></div>
            
            
            
            
        </div>
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
</html>