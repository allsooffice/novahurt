<!DOCTYPE HTML>

<?php
session_start();
include('db_connect.php');
$_SESSION['id_klienta'] = session_id();
$client_id = $_SESSION['id_klienta'];

//przeliczanie paczek
$koszyk = $mysqli->query("SELECT * FROM card WHERE session_id = '$client_id'");
//PRODUKTY W KOSZYKU
$kurier = 0;
$pobranie = 0;
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
          $cena = $dane_produkt['cena_pkh'];
          $product_price = $cena * $product_quantity;
            
            
                if($sztuk_w_paczce == 1)
        {
            $kurier = $kurier + $platnosc_z_gory * $product_quantity;
            $pobranie = $pobranie + $platnosc_pobranie * $product_quantity;
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
                      $pobranie = $pobranie + $platnosc_pobranie;
                      $ubezpieczenie = $ubezpieczenie + $ubezpieczenie_przesylki;
                      $paczka++;
                    }
                    
                    else if($paczka > 1 && $paczka < $sztuk_w_paczce)
                    {
                      $kurier = $kurier + $kolejna_sztuka;
                      $pobranie = $pobranie + $kolejna_sztuka;
                      $paczka++;
                    }
                    
                    else if($paczka == $sztuk_w_paczce)
                    {
                      $kurier = $kurier + $kolejna_sztuka;
                      $pobranie = $pobranie + $kolejna_sztuka;
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
if($dostawa == $kurier)
{
    $sposob_dostawy = 'Kurier 24h';
}
if($dostawa == $pobranie)
{
    $sposob_dostawy = 'Przesyłka kurierska pobraniowa';
    $platnosc = 'Przy pobraniu kurierowi';
}
if($dostawa == 'osobisty')
{
    $sposob_dostawy = 'Odbiór osobisty';
    $dostawa = 0;
}
$ankieta = $_POST['ankieta'];
if($_POST['ubezpieczenie'] == 'on')
{
   $ubezpieczenie_save = $ubezpieczenie;
}
else
{
   $ubezpieczenie_save = 0; 
}
$total_price = $_POST['send_price'];
//sprawdzanie czy klient ma juz zamowienie


$orders = $mysqli->query("SELECT * FROM sell WHERE session_id = '$client_id' AND status = 'koszyk'");
$duble = mysqli_num_rows($orders);

if($duble == 0)
{
$dodawanie = "insert into sell (id, session_id, customer, cena_dostawy, sposob_dostawy, sposob_platnosci, ubezpieczenie, ankieta, dokument, dodatkowe, mail, newsletter, status, suma_zamowienia) values ('', '$client_id', '', '$dostawa', '$sposob_dostawy', '$platnosc', '$ubezpieczenie_save', '$ankieta', '', '', '', '', 'koszyk', '$total_price')";    
// wykonanie dodawania do bazy
$wynik = $mysqli->query($dodawanie);
//sprawdzenie czy powiodło się dodawanie
$next = true;
}

else if($duble > 0)
{ 
$dodawanie = "UPDATE sell SET cena_dostawy = '$dostawa', sposob_dostawy = '$sposob_dostawy', ubezpieczenie = '$ubezpieczenie_save', ankieta = '$ankieta', sposob_platnosci = '$platnosc', suma_zamowienia = '$total_price' WHERE session_id = '$client_id' AND status = 'koszyk'";
// wykonanie dodawania do bazy
$wynik = $mysqli->query($dodawanie);
$next = true;
}    
if($next == true){
if($dostawa == $kurier || $dostawa == 'osobisty')
{
    header('Location: metoda_platnosci.php#start');
}
if($dostawa == $pobranie)
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
    <script type="text/javascript" src="../CMS/js/jquery-3.2.1.slim.min.js"></script>
</head>
<script>
        
</script>
    <?php
    include('parts/head.php');
    ?>
    <div id="tresc_informator"><a name="start"></a>
        <form method="post">
        <div class="tytuly">1/4 Wybierz opcje dostawy</div>
        <div id="opcje_dostawy">
            <input type="hidden" id="order_cost" value="<?php echo $final_order_price ?>">
            <select id="sposob" class="rozwijany" name="opcje_dostawy">
               
                        <option value="select">Wybierz</option>
                        <option value="<?php echo $kurier ?>">Kurier 24h: <?php echo $kurier ?> zł</option>
                        <option value="<?php echo $pobranie ?>">Przesyłka kurierska pobraniowa: <?php echo $pobranie ?> zł</option>
                        <option value="osobisty">Odbiór osobisty: 0 zł</option>
            </select><br><br>
            Zakup:<br>
            <select class="rozwijany" id="ask" name="ankieta">
                <option>PANEL KONTRAHENTA HURTOWEGO</option>
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