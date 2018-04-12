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
       $status = '<span style="color: forestgreen;">Zapłacono</span>'; 
    }
    if($status == '35')
    {
       $status = '<span style="color: forestgreen;">Zapłacono</span>'; 
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
      $sygnatura = $dane_zam['sygnatura'];
    }
	 //include('parts/email.php');
	 $dodawanie = "UPDATE sell SET payment_status = 'Nieopłacone' WHERE id = '$order' ";
	 // wykonanie dodawania do bazy
	 $wynik = $mysqli->query($dodawanie);

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
	<title>Błąd płatności - NOVA HURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, vova, hurt, novahurt, zascianki" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->

</head>

<body>
    <?php
    include('parts/head.php');
    ?>
 
    <div id="tresc_informator"><div class="tytuly">Nieudana próba płatności!</div><a name="start"></a>
    <div id="odbior_content">
        
        Podczas płatności wystąpił błąd:<br>
        <?php echo $status; ?>
        <br>
        <br>
        
        Poniższy link przekieruje do ponownego wyboru sposobu dostawy oraz płatności.<br>
        <a href="opcje_dostawy.php#start">Wybierz inną opcję dostawy lub płatności</a><br>
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