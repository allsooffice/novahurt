<!DOCTYPE HTML>
<?php

include('parts/email.php');

$_SESSION['first_time'] = false;

?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Dane do zapłaty - NOVA HURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, vova, hurt, novahurt, zascianki" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->

</head>

<body>
    <?php
    include('parts/head.php');
    ?>
 
    <div id="tresc_informator"> <div class="tytuly">Dziękujemy za zakupy w naszym sklepie!</div><a name="start"></a>
    <div id="odbior_content">
        Aby sfinalizować zkupy, należy dokonać płatności na konto:<br>
        <b>POLTRADE EXPERT</b><br>
        ul. Wilcza 6<br>
        15-509 Sobolewo<br>
        Nr konta: 68 1140 2004 0000 3502 7644 1716<br>
        Bank : mBank<br>                           
        Tytuł pprzelewu: <?php echo $sygnatura; ?><br>
        Do zapłaty: <?php echo $do_zaplaty;?> zł<br>  
        
        Na adres mailowy: <?php
        echo $_SESSION['email'];
        unset($_SESSION['email']);
        ?> zostało wysłane potwierdzenie zamówienia.<br><br>
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