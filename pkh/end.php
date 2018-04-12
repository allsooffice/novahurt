<!DOCTYPE HTML>
<?php
session_start();
include('db_connect.php');
$data = date('d.m.y H:i');
$id_klienta = $_SESSION['id_klienta'];
$product = $mysqli->query("SELECT * FROM sell WHERE session_id = '$id_klienta' AND status = 'koszyk'");
$duble = mysqli_num_rows($product);
while ($dane_zam=mysqli_fetch_array($product) ) 
{
  $id = $dane_zam['id'];
  $data = $dane_zam['data'];
  $email = $dane_zam['mail'];
  $status = $dane_zam['status'];
  $sygnatura = $dane_zam['sygnatura'];
  $customer = $dane_zam['customer'];
}
if($duble == 0)
{
   header('Location: index.php#start'); 
}

if($status == 'koszyk')
{
    $dodawanie = "UPDATE sell SET status = 'Nowe' WHERE session_id = '$id_klienta' AND status = 'koszyk'";
    // wykonanie dodawania do bazy
    $wynik = $mysqli->query($dodawanie);
    
    $edit = "UPDATE card SET session_id = '$sygnatura' WHERE session_id = '$id_klienta'";
    // wykonanie dodawania do bazy
    $zmiana = $mysqli->query($edit);
    include('parts/email.php');
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
    Na adres mailowy: <?php
        echo $email;
        ?> zostało wysłane potwierdzenie zamówienia.<br><br>
    <?php
		 if($sposob_platnosci == 'Przy pobraniu kurierowi')
		 {
			 echo 'Towar zostanie wysłany do 24 godz (w dni robocze).<br><br>';
			 
		 }
		 else if($sposob_platnosci == 'Przelew na konto')
		 {
			 echo 'Aby sfinalizować zkupy, należy dokonać płatności na konto:<br>
        <b>POLTRADE EXPERT</b><br>
        ul. Wilcza 6<br>
        15-509 Sobolewo<br>
        Nr konta: 68 1140 2004 0000 3502 7644 1716<br>
        Bank : mBank<br>                           
        Tytuł pprzelewu: '.$sygnatura.'<br>
        Do zapłaty: '.$suma_zamowienia.'.00 zł<br><br>  ';
		 }
		 
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