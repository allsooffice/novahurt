<!DOCTYPE HTML>
<?php
session_start();
if($_SESSION['zalogowany'] != true)
{
   header('Location: index.php');
}
$data = date("Y-m-d H:i:s");
$_SESSION['user_session_id'] = session_id();
include('php/db_connect.php');
$mounth = date("m");

//usuwanie pustych ogloszen
?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Sprzedaz - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link href="style/sold.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style/loading.css"/>
	<link href="fontello/css/fontello.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>

<body>
  <?php
            include('parts/log_out.php');
      ?>
    <div class="wrapper">
       
        <div class="menu">
          
           <h2><i class="icon-menu"></i> Menu</h2>
           <?php
            include('parts/menu.php');
            ?>
            
        </div>
        <div class="content">
            <h1>Sprzedaż produktów:</h1>
            <form method="post" action="php/save_mounth.php" enctype="multipart/form-data">
            <table>
            

              <tr>
                  <th>Produkt</th>
                  <th>Sztuk</th>
                  <th>Zakup 1 szt.</th>
                  <th>Allegro</th>
                  <th>Olx / Hurtownia</th>
                  <th>Poza Allegro</th>
                  <th>Facebook</th>
                  <th>Sprzedaż</th>
                  <th>Zakup</th>
                  <th>Zysk brutto</th>
              </tr>
               <?php
            $suma_zysk = 0;
            $wszystkie_przedmioty = 0;
            $wszystkie_allegro = 0;
            $wszystkie_olx = 0;
            $wszystkie_poza = 0;
            $wszystkie_facebook = 0;
            $suma_calkowita_zakupu = 0;
            $suma_calkowita_obrot = 0;
            $produkt_nazwa = $mysqli->query("SELECT * FROM produkty ORDER BY model");
            while ($nazwa=mysqli_fetch_array($produkt_nazwa) )
            {
            $sztuk = 0;
            $cena = 0;
            $cena_zakupu = 0;
            $allegro = 0;
            $olx = 0;
            $poza = 0;
            $facebook = 0;
            $nazwa_produktu = $nazwa['model'];
            $procent_allegro = 0;
            $procent_olx = 0;
            $procent_poza = 0;
            $procent_facebook = 0;
            $suma_ceny_zakupu = 0;
            //podzial na sprzedaz
            $cena_zakupu_zamowienia_allegro = 0;
            $sprzedaz_zamowienia_allegro = 0;
            $cena_zakupu_zamowienia_olx = 0;
            $sprzedaz_zamowienia_olx = 0;
            $cena_zakupu_zamowienia_poza = 0;
            $sprzedaz_zamowienia_poza = 0;
				$cena_zakupu_zamowienia_facebook = 0;
            $sprzedaz_zamowienia_facebook = 0;
            $pobieranie = $mysqli->query("SELECT * FROM sold_products WHERE status <> 'zamkniety' AND product = '$nazwa_produktu'");
            while ($produkt=mysqli_fetch_array($pobieranie))
            {
            $sztuk_w_zamowieniu = $produkt['quantity'];
            $cena_zakupu_w_zamowieniu = $produkt['cena_zakupu'] * $produkt['quantity'];
            $cena_zakupu_zamowienia = $sztuk_w_zamowieniu * $produkt['cena_zakupu'];
            $cena_sprzedazy_zamowienia = $produkt['price'];
            $zysk_z_zamowienia = $cena_sprzedazy_zamowienia - $cena_zakupu_zamowienia;
            $suma_ceny_zakupu = $suma_ceny_zakupu + $cena_zakupu_zamowienia;
            //--------------
            $sztuk = $sztuk + $produkt['quantity'];
            $cena = $cena + $produkt['price'];
            $id_zamowienia = $produkt['order_id'];
            $skad = $mysqli->query("SELECT * FROM orders WHERE status <> 'zamkniety' AND order_number = '$id_zamowienia'");
            while ($sklep=mysqli_fetch_array($skad))
            {
                
                if($sklep['shop'] == 'Allegro')
                {
                  $allegro = $allegro + $sztuk_w_zamowieniu;
                  $cena_zakupu_zamowienia_allegro = $cena_zakupu_zamowienia_allegro + $cena_zakupu_w_zamowieniu;
                  $sprzedaz_zamowienia_allegro = $sprzedaz_zamowienia_allegro + $cena_sprzedazy_zamowienia;
                  
                }
                if($sklep['shop'] == 'Hurtownia / OLX')
                {
                  $olx = $olx + $sztuk_w_zamowieniu;
                  $cena_zakupu_zamowienia_olx = $cena_zakupu_zamowienia_olx + $cena_zakupu_w_zamowieniu;
                  $sprzedaz_zamowienia_olx = $sprzedaz_zamowienia_olx + $cena_sprzedazy_zamowienia;
                }
                if($sklep['shop'] == 'Poza Allegro')
                {
                  $poza = $poza + $sztuk_w_zamowieniu;
                  $cena_zakupu_zamowienia_poza = $cena_zakupu_zamowienia_poza + $cena_zakupu_w_zamowieniu;
                  $sprzedaz_zamowienia_poza = $sprzedaz_zamowienia_poza + $cena_sprzedazy_zamowienia;
                }
					
					if($sklep['shop'] == 'Facebook')
                {
                  $facebook = $facebook + $sztuk_w_zamowieniu;
                  $cena_zakupu_zamowienia_facebook = $cena_zakupu_zamowienia_facebook + $cena_zakupu_w_zamowieniu;
                  $sprzedaz_zamowienia_facebook = $sprzedaz_zamowienia_facebook + $cena_sprzedazy_zamowienia;
                }
                
            }
            
                if($allegro > 0)
                  {
                  $procent_allegro = round(($allegro / $sztuk) * 100, 1);
                  }
                    else
                    {
                        $procent_allegro = 0;
                    }
                if($olx > 0)
                  {
                  $procent_olx = round(($olx / $sztuk) * 100, 1);
                  }
                    else
                    {
                      $procent_olx = 0;  
                    }
                if($poza > 0)
                    {
                  $procent_poza = round(($poza / $sztuk) * 100, 1);
                    }
					if($facebook > 0)
                    {
                  $procent_facebook = round(($facebook / $sztuk) * 100, 1);
                    }
					  else
					  {
						 $procent_poza = 0;  
					  }
            
            }
            if($sztuk != 0)
            {
              
            
            echo '<tr><td>'.$nazwa_produktu .'</td><td>'.$sztuk .'</td><td>'.$nazwa['cena_zakupu'] .'</td><td style="background-color: #ff6600; color: white;">'.$allegro .' szt.<br>'.$procent_allegro .'%</td><td style="background-color: #cc3300; color: white;">'.$olx .' szt.<br>'.$procent_olx .'%</td><td style="background-color: #ffcc66;">'.$poza .' szt.<br>'.$procent_poza .'%</td><td style="background-color: #3b5998; color: #ffffff;">'.$facebook .' szt.<br>'.$procent_facebook .'%</td><td>'.$cena .'</td><td>'.$suma_ceny_zakupu.'</td>';
            $cena_zakupu = $nazwa['cena_zakupu'];
            $zysk = $cena - $suma_ceny_zakupu;
            $suma_zysk = $suma_zysk + $zysk;
            $suma_zysk_number = number_format($suma_zysk, 0, ',', ' ');
            $wszystkie_przedmioty = $wszystkie_przedmioty + $sztuk;
            $wszystkie_przedmioty_number = number_format($wszystkie_przedmioty, 0, ',', ' ');
            $wszystkie_allegro = $wszystkie_allegro + $allegro;
            $wszystkie_olx = $wszystkie_olx + $olx;
            $wszystkie_poza = $wszystkie_poza + $poza;
            $wszystkie_facebook = $wszystkie_facebook + $facebook;
            $wszystkie_allegro_procent = round(($wszystkie_allegro / $wszystkie_przedmioty) * 100);
            $wszystkie_olx_procent = round(($wszystkie_olx / $wszystkie_przedmioty) * 100);
            $wszystkie_poza_procent = round(($wszystkie_poza / $wszystkie_przedmioty) * 100);
            $wszystkie_facebook_procent = round(($wszystkie_facebook / $wszystkie_przedmioty) * 100);
            $suma_calkowita_zakupu = $suma_calkowita_zakupu + $suma_ceny_zakupu;
            $suma_zakupu_number = number_format($suma_calkowita_zakupu, 0, ',', ' ');
            $suma_calkowita_obrot = $suma_calkowita_obrot + $cena;
            $suma_calkowita_number = number_format($suma_calkowita_obrot, 0, ',', ' ');
            
            echo '<td style="background-color: #99cc66;">'.$zysk.'</td></tr>';
            //dodawanie do bazy raportu miesięcznego
            
            echo '<input type="hidden" id="product" name="product[]" value="'.$nazwa_produktu .'">';
            echo '<input type="hidden" id="product" name="quantity[]" value="'.$sztuk .'">';
            echo '<input type="hidden" id="product" name="buy_price[]" value="'.$nazwa['cena_zakupu'] .'">';
            echo '<input type="hidden" id="product" name="sold_allegro[]" value="'.$allegro .'">';
            echo '<input type="hidden" id="product" name="sold_olx[]" value="'.$olx .'">';
            echo '<input type="hidden" id="product" name="sold_poza[]" value="'.$poza .'">';
            echo '<input type="hidden" id="product" name="sold_facebook[]" value="'.$facebook .'">';
            echo '<input type="hidden" id="product" name="product_sold[]" value="'.$cena .'">';
            echo '<input type="hidden" id="product" name="product_buy[]" value="'.$suma_ceny_zakupu.'">';
            echo '<input type="hidden" id="product" name="profit[]" value="'.$zysk .'">';
            echo '<input type="hidden" id="product" name="zakup_allegro[]" value="'.$cena_zakupu_zamowienia_allegro.'">';
            echo '<input type="hidden" id="product" name="zakup_olx[]" value="'.$cena_zakupu_zamowienia_olx.'">';
            echo '<input type="hidden" id="product" name="zakup_poza[]" value="'.$cena_zakupu_zamowienia_poza.'">';
            echo '<input type="hidden" id="product" name="zakup_facebook[]" value="'.$cena_zakupu_zamowienia_facebook.'">';
            echo '<input type="hidden" id="product" name="sprzedaz_allegro[]" value="'.$sprzedaz_zamowienia_allegro.'">';
            echo '<input type="hidden" id="product" name="sprzedaz_olx[]" value="'.$sprzedaz_zamowienia_olx.'">';
            echo '<input type="hidden" id="product" name="sprzedaz_poza[]" value="'.$sprzedaz_zamowienia_poza.'">';
            echo '<input type="hidden" id="product" name="sprzedaz_facebook[]" value="'.$sprzedaz_zamowienia_facebook.'">';
            }
            
            }
            
            echo '<tr>
                  <th>SUMA:</th>
                  <th>'.$wszystkie_przedmioty_number.'</th>
                  <th>-</th>
                  <th>'.$wszystkie_allegro.'<br>'.$wszystkie_allegro_procent.'%</th>
                  <th>'.$wszystkie_olx.'<br>'.$wszystkie_olx_procent.'%</th>
                  <th>'.$wszystkie_poza.'<br>'.$wszystkie_poza_procent.'%</th>
                  <th>'.$wszystkie_facebook.'<br>'.$wszystkie_facebook_procent.'%</th>
                  <th>'.$suma_calkowita_number.'</th>
                  <th>'.$suma_zakupu_number.'</th>
                  <th>'.$suma_zysk_number.'</th>
              </tr>';
            ?>
                
            </table>
            <input class="confirm-btn" id="generate-raport" type="button" name="Tak" value="Raport miesięczny"/>
            <div class="box">
                <div class="popup">
                   <h3>Czy na pewno wygenerować raport?</h3>
                    <p>Po potwierdzeniu zostaną usunięte wszystkie poszczególne zamówienia.</p>
                    <input class="confirm-btn" type="submit" value="Tak"/>
                    <input class="confirm-btn" type="button" id="close-box" value="Nie"/>
                </div>
            </div>
            
            </form>
        </div>
        
        <div style="clear: both;"></div>
        

        
    </div>
</body>
<script src="js/menu.js"></script>
<script>
    $("#generate-raport").on("click" ,function(){
        $(".box").fadeIn();
    });
    $("#close-box").on("click" ,function(){
        $(".box").fadeOut();
    });
</script>
<script>
		$("#actual-raport").parent().addClass("menu-active");
		$("#actual-raport").addClass("active-color");
</script>
</html>