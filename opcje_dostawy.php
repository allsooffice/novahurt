<!DOCTYPE HTML>

<?php
session_start();
$_SESSION['id_klienta'] = session_id();
$client_id = $_SESSION['id_klienta'];
include('db_connect.php');
//przeliczanie paczek
$koszyk = $mysqli->query("SELECT * FROM card WHERE session_id = '$client_id'");
//PRODUKTY W KOSZYKU
$kurier = 0;
$kurier_express = 0;
$pobranie = 0;
$pobranie_express = 0;
$ubezpieczenie = 0;
$final_order_price = 0;
$final_kurier = 0;
$final_pobranie = 0;
$paczki = 0;
$next = false;
while ($w_koszyku=mysqli_fetch_array($koszyk) ) 
    {
        $id_produktu = $w_koszyku['id_produktu'];
        $product_quantity = $w_koszyku['quantity'];
    //INFO O POSZCZEGOLNYM PRODUKCIE
        $product = $mysqli->query("SELECT * FROM produkty WHERE id = '$id_produktu'");
        while ($dane_produkt=mysqli_fetch_array($product) ) 
        {
          $platnosc_z_gory = $dane_produkt['dostawa_od'];  
          $platnosc_pobranie = $dane_produkt['dostawa_pobranie'];
          $ubezpieczenie_przesylki = $dane_produkt['ubezpieczenie'];
          $kolejna_sztuka = $dane_produkt['kolejna_sztuka'];
          $sztuk_w_paczce = $dane_produkt['sztuk_w_paczce'];
          $cena = $dane_produkt['cena'];
          $product_price = $cena * $product_quantity;
            
            
                if($sztuk_w_paczce == 1)
        {
            $kurier = $kurier + $platnosc_z_gory * $product_quantity;
            $pobranie = $pobranie + $platnosc_pobranie * $product_quantity;
            $kurier_express = $kurier + 7;
            $pobranie_express = $pobranie + 7;
            $ubezpieczenie = $ubezpieczenie + $ubezpieczenie_przesylki * $product_quantity;
        }
        else
        {
            
            $i = 1;
            $paczka = 1;
            
            while ($i <= $product_quantity) 
            {

                    if($paczka == 1)
                    {
                      $kurier = $kurier + $platnosc_z_gory;
                      $kurier_express = $kurier + 7;
                      $pobranie = $pobranie + $platnosc_pobranie;
                      $pobranie_express = $pobranie + 7;
                      $ubezpieczenie = $ubezpieczenie + $ubezpieczenie_przesylki;
                      $paczka++;
                    }
                    
                    else if($paczka > 1 && $paczka < $sztuk_w_paczce)
                    {
                      $kurier = $kurier + $kolejna_sztuka;
                      $kurier_express = $kurier + 7;
                      $pobranie = $pobranie + $kolejna_sztuka;
                      $pobranie_express = $pobranie + 7;
                      $paczka++;
                    }
                    
                    else if($paczka == $sztuk_w_paczce)
                    {
                      $kurier = $kurier + $kolejna_sztuka;
                      $kurier_express = $kurier + 7;
                      $pobranie = $pobranie + $kolejna_sztuka;
                      $pobranie_express = $pobranie + 7;
                      $paczka = 1;
                    }

                $i++;
            }
            
        }    
            
        }    
            $final_order_price = $final_order_price + $product_price; 
            $final_kurier = $final_kurier + $kurier;
            $final_pobranie = $final_pobranie + $pobranie;
    }


if(isset($_POST['dalej']))
{ 
$platnosc = '';
$dostawa = $_POST['opcje_dostawy'];
if($dostawa == $kurier_express)
{
    $sposob_dostawy = 'Kurier Express';
}
if($dostawa == $kurier)
{
    $sposob_dostawy = 'Przesyłka kurierska';
}
if($dostawa == $pobranie)
{
    $sposob_dostawy = 'Przesyłka kurierska pobraniowa';
    $platnosc = 'Przy pobraniu kurierowi';
}
if($dostawa == $pobranie_express)
{
    $sposob_dostawy = 'Przesyłka kurierska pobraniowa Express';
    $platnosc = 'Przy pobraniu kurierowi';
}
if($dostawa == 'osobisty')
{
    $sposob_dostawy = 'Odbiór osobisty';
    $dostawa = 0;
}
$ankieta = $_POST['ankieta'];
	if(isset($_POST['ubezpieczenie']))
	{
			if($_POST['ubezpieczenie'] == 'on')
			{
				$ubezpieczenie_save = $ubezpieczenie;
			}
	}
else
{
   $ubezpieczenie_save = 0; 
}
$total_price = $_POST['send_price'];
 //sprawdzenie czy niema dubli
    
    $dubel = $mysqli->query("SELECT id FROM sell WHERE session_id = '$client_id'");
    if (!$dubel) throw new Exception($mysqli->error);

    $ile_takich_produktow = $dubel->num_rows;
    
    if($ile_takich_produktow>0)
    {
    $dodawanie = "UPDATE sell SET cena_dostawy = '$dostawa', sposob_dostawy = '$sposob_dostawy', sposob_platnosci = '$platnosc', ubezpieczenie = '$ubezpieczenie_save', ankieta = '$ankieta', suma_zamowienia = '$total_price' WHERE session_id = '$client_id'";
    // wykonanie dodawania do bazy
    $wynik = $mysqli->query($dodawanie);
		 if($wynik)
		 {
			$next = true;
		 }
    }
else
{
	$dodawanie = "insert into sell (id, session_id, cena_dostawy, sposob_dostawy, sposob_platnosci, ubezpieczenie, ankieta, suma_zamowienia, status) values ('', '$client_id', '$dostawa', '$sposob_dostawy', '$platnosc', '$ubezpieczenie_save', '$ankieta', '$total_price', 'koszyk')";    
	// wykonanie dodawania do bazy
	$wynik = $mysqli->query($dodawanie);
	//sprawdzenie czy powiodło się dodawanie
	 if($wynik)
	 {
		$next = true;
	 }
}



if($next == true){
if($sposob_dostawy == 'Przesyłka kurierska' || $sposob_dostawy == 'Odbiór osobisty' || $sposob_dostawy == 'Kurier Express')
{
    header('Location: metoda_platnosci.php#start');
}
if($sposob_dostawy == 'Przesyłka kurierska pobraniowa' || $sposob_dostawy == 'Przesyłka kurierska pobraniowa Express')
{
    header('Location: dane_do_wysylki.php#start'); 
}
}

}
?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Twoje zakupy - NOVA HURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, nova, hurt, novahurt, zascianki" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->
    <script type="text/javascript" src="CMS/js/jquery-3.2.1.slim.min.js"></script>
    <!--RCORD VISITORS-->
<script type="text/javascript">
    window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', 'f718feff702552bc5da8cef86b01767fd4ec3c4e');
</script>
</head>
<script>
        
</script>
    <?php
    include('parts/head.php');
    ?>
    <div id="tresc_informator"><a name="start"></a>
        <form method="post">
        <div class="tytuly">1/4 Wybierz opcje dostawy</div>
           Dostawa:
        <div id="opcje_dostawy">
            <input type="hidden" id="order_cost" value="<?php echo $final_order_price ?>">
            <select id="sposob" class="rozwijany" name="opcje_dostawy">
                        <option value="select">Wybierz</option>
                        <option value="<?php echo $kurier_express ?>">Kurier Express: <?php echo $kurier_express ?> zł - przesyłka priorytetowa</option>
                        <option value="<?php echo $kurier ?>">Przsyłka kurerska <?php echo $kurier ?> zł</option>
                        <option value="<?php echo $pobranie_express ?>">Przesyłka kurierska pobraniowa Express: <?php echo $pobranie_express ?> zł - przesyłka priorytetowa</option>
                        <option value="<?php echo $pobranie ?>">Przesyłka kurierska pobraniowa: <?php echo $pobranie ?> zł</option>
                        <option value="osobisty">Odbiór osobisty: 0 zł</option>
            </select><br><br>
            Skąd dowiedziałeś się o naszym sklepie?<br>
            <select class="rozwijany" id="ask" name="ankieta">
                <option value="choose">Wybierz</option>
                <option>z OLX</option>
                <option>Allegro</option>
                <option>z Facebooka</option>
                <option>Kupowałem (am) tu wcześniej</option>
                <option>Od znajomych</option>
                <option>Inne</option>
            </select>
            <br><br>
            <label style="cursor: pointer; display: none;" id="costs">
            <input id="saveControl" name="ubezpieczenie" type="checkbox" /> Ubezpieczenie przesyłki: <?php echo $ubezpieczenie ?> zł<br>
            <i style="font-size: 16px;">W przypadku uszkodzenia przesyłki podczas transportu<br> zostanie ona bezzwłocznie wymieniona na nową.</i></label><br><br>
            <h2 id="order" style="color: forestgreen;"></h2>
           <input type="hidden" id="ube" value="<?php echo $ubezpieczenie ?>"/>
            <div style="clear:both"></div>

        </div>
        <div id="zamowienie_l">
            <a href="koszyk.php#start">
            <div id="wstecz_guzik">WSTECZ</div>
            </a>
            </div>
        <div id="zamowienie_p">
            <input type="hidden" id="total_input" value="" name="send_price">
            <input id="zamowienie_przycisk_2" type="button" name="dalej" value="DALEJ"/>
        </form>    
        </div>
        </div>  
        <div style="clear:both"></div>
        
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
  <script>
    function sumOrder(towar, przesylka, ubezpieczenie)
      {
          var totalCost = parseInt(towar) + parseInt(przesylka) + parseInt(ubezpieczenie);
          $("#order").text('Suma zamówienia: '+totalCost+' zł');
          $("#total_input").val(totalCost);
      }      
      
    $("#saveControl").on("click" ,function(){
        var towar = $('#order_cost').val();
        var przesylka = $('#sposob').val();
        var ubezpieczenie = $('#ube').val();
            if($(this).is(':checked'))
            {
            sumOrder(towar, przesylka, ubezpieczenie);
            }
            else
            {
               sumOrder(towar, przesylka, 0);
            }
    });
      
    $("#sposob").on("change" ,function(){
    var towar = $('#order_cost').val();
    var przesylka = $('#sposob').val();
    var ubezpieczenie = 0;
    if(przesylka == 'select')
        {
          $('#costs').fadeOut();
          $('#saveControl').prop('checked', false);
        }
    else if(przesylka == 'osobisty')
        {
          $('#costs').fadeOut();
          $('#saveControl').prop('checked', false);
          sumOrder(towar, 0, 0);
        }
    else
        {
          $('#costs').fadeIn();
          sumOrder(towar, przesylka, ubezpieczenie);
        }
    });
      
    $("select").on("change" ,function(){
        var przesylka = $('#sposob').val();
        var shop = $('#ask').val();
        if(shop == 'choose' || przesylka == 'select')
        {
            
          $("#zamowienie_przycisk_2").attr('type', 'button');
        }
        else
        {
            
          $("#zamowienie_przycisk_2").attr('type', 'submit');  
        }
    });
      
    $("#zamowienie_przycisk_2").on("click" ,function(){
        var typ = $("#zamowienie_przycisk_2").attr('type');
        if(typ = 'button')
            {
              $("#order").text('Uzupełnij wszystkie pola formularza');  
            }
    });

</script>      
</html>