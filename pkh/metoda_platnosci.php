<!DOCTYPE HTML>

<?php
session_start();
include('db_connect.php');
$client_id = $_SESSION['id_klienta'];
	$product = $mysqli->query("SELECT * FROM sell WHERE session_id = '$client_id' AND status = 'koszyk'");
while ($dane_zam=mysqli_fetch_array($product) ) 
{
  $sposob_dostawy = $dane_zam['sposob_dostawy'];
}
if(isset($_POST['dalej']))
{
   $platnosc = $_POST['platnosc'];
    if($platnosc == 'przelew')
    {
      $platnosc = 'Przelew na konto';
    }
    if($platnosc == 'polcard')
    {
      $platnosc = 'Szybki przelew internetowy';
    }
    if($platnosc == 'karta')
    {
      $platnosc = 'Karta płatnicza';
    }
	if($platnosc == 'odbior')
    {
      $platnosc = 'Kartą lub gotówką przy odbiorze';
    }
   $dodawanie = "UPDATE sell SET sposob_platnosci = '$platnosc', payment_status = '' WHERE session_id = '$client_id'";
// wykonanie dodawania do bazy
    $wynik = $mysqli->query($dodawanie);

   header('Location: dane_do_wysylki.php#start');

}
?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Metoda płatności - NOVA HURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, nova, hurt, novahurt, zascianki" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->
    <script type="text/javascript" src="../CMS/js/jquery-3.2.1.slim.min.js"></script>
</head>

<body>
    <?php
    include('parts/head.php');
    ?>
 
    <div id="tresc_informator"><a name="start"></a>
        <form method="post">
        <div class="tytuly">2/4 Wybierz metode płatności</div>
        <div id="opcje_dostawy">
            <ul class="options">
             <?php
              if($sposob_dostawy == 'Odbiór osobisty')
						{
							echo '<li style="background-image: url(../jpg/odbior.png);" id="odbior" class="piece unactive">
							 <div class="choosen"></div>
							 <p>Kartą lub gotówka przy odbiorze</p>
							 </li>';
						}
					?>
               <li style="background-image: url(../jpg/mbank.jpg);" id="przelew" class="piece unactive">
                <div class="choosen"></div>
                <p>Przelew na konto</p>
                </li>
                <li style="background-image: url(../jpg/polcard.png);" id="polcard" class="piece unactive">
                <div class="choosen"></div>
                <p>Szybki przelew internetowy</p>
                </li>
                <li style="background-image: url(../jpg/karty.jpg);" id="karta" class="piece unactive">
                <div class="choosen"></div>
                <p>Karta płatnicza</p>
                </li>
              
            </ul>
        <input type="hidden" value="" id="wybrany" name="platnosc"/>
        <div style="clear: both;"></div> 
        </div>
        <div id="zamowienie_l">
            <a href="opcje_dostawy.php#start">
            <div id="wstecz_guzik">WSTECZ</div>
            </a>
            </div>
        <div id="zamowienie_p">
            
            <input id="zamowienie_przycisk_2" type="button" name="dalej" value="DALEJ"/>
        </form>    
        </div>
        </div>  
        <div style="clear:both"></div>
        
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
<script>
$("ul li").on("click" ,function(){
    $(".choosen").fadeOut();
    $("ul li").removeClass('active');
    $("ul li").addClass('unactive');
    var platnosc = $(this).attr('id');
    $('#wybrany').val(platnosc);
    $(this).removeClass('unactive');
    $(this).addClass('active');
    $(this).children(".choosen").fadeIn();
    $("#zamowienie_przycisk_2").attr('type', 'submit');
});
</script>
</html>