<!DOCTYPE HTML>

<?php
session_start();
include('db_connect.php');

$id_klienta = $_SESSION['id_klienta'];

            $imie = $_SESSION['imie'];
            $nazwisko = $_SESSION['nazwisko'];
            $produkt_sztuk = $_SESSION['p_s'];
            $cena_towarow = $_SESSION['cena_towarow'];
            $telefon = $_SESSION['telefon'];
            $email = $_SESSION['email'];
            $dokument = $_SESSION['dokument'];
            $data = date('Y-m-d H:i:s');
            $dodatkowe = $_SESSION['dodatkowe'];
            $placi = $_SESSION['placi'];
            $ankieta = $_SESSION['ankieta'];

        $dodawanie = "insert into zamowienie (id, dane_klienta, produkt_sztuk, produkt_cena, przesylka, przesylka_cena, platnosc, czas, session_id, dodatkowe, dokument, rodzaj, sygnatura, nazwa_firmy, nip, status, email, komentarz, ubezpieczenie, ankieta) values ('', '$imie $nazwisko<br> tel: $telefon<br> email: $email', '$produkt_sztuk', '$cena_towarow zł', 'Odbiór osobisty', 'Przy odbiorze', '$placi', '$data', '$id_klienta', '$dodatkowe', '$dokument', 'detal', '' , '', '', 'nowe', '$email', '', '0', '$ankieta')";        

            // wykonanie dodawania do bazy
            $wynik = $mysqli->query($dodawanie);
                //sprawdzenie czy powiodło się dodawanie
                
                    if ($_SESSION['first_time'] == true)
                        {       
                        include('parts/email.php');
                        $_SESSION['first_time'] = false;
                        }
               

     
 

?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Zapraszamy po odbior - NOVA HURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, vova, hurt, novahurt, zascianki" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->

</head>

<body>
    <?php
    include('parts/head.php');
    ?>
 
    <div id="tresc_informator"><a name="start"></a>
    <div id="odbior_content">
        <h3>Dziękujemy za zakupy w naszym sklepie!</h3><br>
        
        Na adres mailowy: <?php
    echo $_SESSION['email'];
    unset($_SESSION['email']);
    ?> zostało wysłane potwierdzenie zamówienia.<br>
        Zapraszamy po odbiór w dniach:<br>
                pon - pt (w godz. 9:00 - 17:00).<br><br>
                            Adres:<br>
                        15-521 Zaścianki<br>
                ul. Szosa Baranowicka 56A <br>
                    Infolinia : 53 77 00 674<br><br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d711.7838815064855!2d23.2381065518273!3d53.125523634633005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ffedf9ad3b51d%3A0xf8400e5eaf830269!2sBaranowicka+56%2C+16-030+Za%C5%9Bcianki!5e0!3m2!1spl!2spl!4v1460381714898" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        
            
    </div>
    </div>
        
    
        
        <div style="clear:both"></div>
        <div id="dolmenu">
            
            
            <a href="pkh/logowanie.php#start">
            <div id="menu_pkh">Panel kontrahenta<br>hurtowego</div>
            </a>
            <a href="dane.php#16">
            <div id="menu_faq">FAQ</div>
            </a>
            <a href="dane.php#10">
            <div id="menu_reklamacje">reklamacje</div>
            </a>
            <a href="dane.php#11">
            <div id="menu_zwroty">zwroty</div>
            </a>
        <div style="clear:both"></div>
            
            <a href="dane.php#3">
            <div id="menu_kontakt">
                <div class="tittle">kontakt</div> 
                <img src="jpg/kontakt.jpg" width="" height="" align="center"/>
            </div>
            </a> 
                
            <a href="dane.php#2">
            <div id="menu_dlaczego">
                <div class="tittle">dlaczego my?</div> 
                <img src="jpg/dlaczego.jpg" width="562" height="" align="center"/>
            </div>
            </a>    
            
            <div style="clear:both"></div>
            
            <a href="dane.php#14">
            <div class="menu_4"><div class="tittle">dostawa</div>
                <img src="jpg/dostawa.jpg" width="180" height="130" align=""/>
            </div>
            </a>
            
            <a href="dane.php#6">
            <div class="menu_4"><div class="tittle">płatności</div>
                <img src="jpg/platnosci.jpg" width="180" height="130" align=""/>
            </div>
            </a>    
            
            <a href="dane.php#1">
            <div class="menu_4"><div class="tittle">o nas</div>
                <img src="jpg/onas.jpg" width="180" height="130" align=""/>
            </div>
            </a>
            
            <a href="dane.php#9">
            <div class="menu_4"><div class="tittle">regulamin</div>
                <img src="jpg/regulamin.jpg" width="180" height="130" align=""/>
            </div>
            </a>
            
            <a href="dane.php#4">
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