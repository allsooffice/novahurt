<!DOCTYPE HTML>

<?php
include('db_connect.php');
session_start();
$id_klienta = $_SESSION['id_klienta'];
$ip = $_SERVER['REMOTE_ADDR'];
$product = $mysqli->query("SELECT * FROM sell WHERE session_id = '$id_klienta' AND status = 'koszyk'");
$duble = mysqli_num_rows($product);
if($duble == 0)
{
   header('Location: index.php#start'); 
}
else
{
while ($dane_zam=mysqli_fetch_array($product) ) 
{
  $id_zakupu = $dane_zam['id'];
  $imie = $dane_zam['customer'];
  $nazwisko = $dane_zam['nazwisko'];
  $sposob_dostawy = $dane_zam['sposob_dostawy'];
  $sposob_platnosci = $dane_zam['sposob_platnosci'];
  $cena_dostawy = $dane_zam['cena_dostawy'];
  $ubezpieczenie = $dane_zam['ubezpieczenie'];
  $email = $dane_zam['mail'];
  $ulica = $dane_zam['ulica'];
  $kod_pocztowy = $dane_zam['kod_pocztowy'];
  $miejscowosc = $dane_zam['miejscowosc'];
  $numer_budynku = $dane_zam['numer_budynku'];
  $numer_lokalu = $dane_zam['numer_lokalu'];
  $ubezpieczenie_kwota = $ubezpieczenie;
  if($ubezpieczenie == '0')
  {
      $ubezpieczenie = 'Nie wybrano';
  }
    else
    {
      $ubezpieczenie = $ubezpieczenie.' zł';
    }

}
    

    
}
    

    
  
    



     
 

?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>rejestracja - NOVA HURT</title>
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
        <div class="tytuly">Podsumowanie</div>
        <div id="tresc_rejestracja">
            <h3>Dane do wysyłki:</h3>
           
    
            
            
           
            <div style="clear:both"></div>
            
            <div id="podsumowanie_contener_wiersz">
          <div id="podsumowanie_contener_l">
                
                Imię:
                </div>
                <div id="podsumowanie_contener_p">
                            <?php
                            echo $_SESSION['imie'];
                            
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="podsumowanie_contener_wiersz">
            <div id="podsumowanie_contener_l">
                
                Nazwisko:
                </div>
                <div id="podsumowanie_contener_p">
                    <?php
                            echo $_SESSION['nazwisko'];
                            
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="podsumowanie_contener_wiersz">
            <div id="podsumowanie_contener_l">
                
                Ulica:
                </div>
                <div id="podsumowanie_contener_p">
                   <?php
                            echo $_SESSION['ulica'];
                            
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="podsumowanie_contener_wiersz">
            <div id="podsumowanie_contener_l">
                
                Numer budynku:
                </div>
                <div id="podsumowanie_contener_p">
                    <?php
                            echo $_SESSION['nr_budynku'];
                            
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="podsumowanie_contener_wiersz">
            <div id="podsumowanie_contener_l">
                
                Numer lokalu:
                </div>
                <div id="podsumowanie_contener_p">
                    <?php
                            echo $_SESSION['nr_mieszkania'];
                            
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="podsumowanie_contener_wiersz">
            <div id="podsumowanie_contener_l">
                
                Kod pocztowy:
                </div>
                <div id="podsumowanie_contener_p">
                    <?php
                            echo $_SESSION['kod_pocztowy'];
                            
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="podsumowanie_contener_wiersz">
            <div id="podsumowanie_contener_l">
                
                Miejscowość:
                </div>
                <div id="podsumowanie_contener_p">
                    <?php
                            echo $_SESSION['miejscowosc'];
                            
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
                
            <div id="podsumowanie_contener_wiersz">
            <div id="podsumowanie_contener_l">
                Adres e-mail:
                </div>
                <div id="podsumowanie_contener_p">
                    <?php
                            echo $_SESSION['email'];
                            
                            ?>
                    
                </div>
        </div>      
        <div style="clear:both"></div> 
            
        <div id="podsumowanie_contener_wiersz">
            <div id="podsumowanie_contener_l">
                Numer telefonu:
                </div>
                <div id="podsumowanie_contener_p">
                    <?php
                            echo $_SESSION['telefon'];
                            
                            ?>
                    
                </div>
        </div>      
        <div style="clear:both"></div>    
            
            <div id="podsumowanie_contener_wiersz">  
                <div id="podsumowanie_contener_l">
                Dokument zakupu:
                </div>
                <div id="podsumowanie_contener_p">
            <?php
                echo $_SESSION['dokument'];
                            
                            ?>
                </div>
            </div>    
          <div style="clear:both"></div>
          
        <div id="podsumowanie_contener_wiersz">
            <div id="podsumowanie_contener_l">
                
                Dodatkowe informacje:
                
            </div>
            <div id="podsumowanie_contener_p">
                <?php
                    echo $_SESSION['dodatkowe'];
                            
                            ?>
            </div>
        </div> 
            </div>
            <div style="clear:both"></div>
            <h3>Lista zakupów:</h3>
            <div id= "podsumowanie_ramka">
                            <?php
            $total_product_price  = 0;        
            $koszyk = $mysqli->query("SELECT * FROM card WHERE session_id = '$id_klienta'");
            $liczba_wierszy = mysqli_num_rows($koszyk);
                if($liczba_wierszy < 1)
                {
                echo '<h1>Brak produktów w koszyku</h1>';
                }
                else
                {
                $i = 1;
                while ($card=mysqli_fetch_array($koszyk) ){
                    $product_id = $card['id_produktu'];
                    $quantity = $card['quantity'];
                    $card_id = $card['id'];
            $rezultat = $mysqli->query("SELECT * FROM produkty WHERE id = '$product_id'");
                
                while ($produkt=mysqli_fetch_array($rezultat) ){
                    
                    $foto = $mysqli->query("SELECT * FROM images WHERE article_id = '$product_id' AND place = '1'");
                
                while ($obraz=mysqli_fetch_array($foto) ){
                echo '<div id= "koszyk_tabela_foto_lista" style="background-image: url(products_img/'. $obraz['image_src'] .');">';
                echo '</div>';
                }
                echo '<div id= "koszyk_tabela_model_lista">';
                echo $produkt['model'].' x '.$quantity;
                echo '</div>';
                echo '<div id= "koszyk_tabela_za_sztuke_lista" >';
                echo 'Cena: '.$quantity * $produkt['cena'].' zł';
                echo '<input type="hidden" id="piece_price_'.$i.'" value="'.$produkt['cena'].'"/></div>';
                echo '</div>';
                echo '<div style="clear:both"></div>';
                $product_price = $quantity * $produkt['cena'];
                echo '<input type="hidden" value="'.$product_price.'" id="product_sum_'.$i.'"/>';
                
                }
                $total_product_price = $total_product_price + $product_price;
                }
                
                    
                }
                echo '<p class="order_pos">Dostawa: '.$sposob_dostawy.' '.$cena_dostawy.' zł<br></p>';
                echo '<p class="order_pos">Ubezpieczenie przesyłki: '.$ubezpieczenie.'<br></p>';
                $total_order = $total_product_price + $cena_dostawy + $ubezpieczenie_kwota;
                echo '<p class="order_sum">Suma zamówienia: '.$total_order. ' zł</p>';
            ?>
            </div>
            <div style="clear:both"></div>
    </div>
           <form method="post" action="https://vpos.polcard.com.pl/vpos/ecom/service.htm">
            <div id="podsumowanie_zamowienia">
                   
        
                <div id="dane_do_wysylki_nawigacja">
                    
                    <a href="dane_do_wysylki.php#start">
            <div id="wstecz_guzik_do_wysylki">WSTECZ</div>
                    </a>
             <input id="confirm_button" type="submit" style="font-size: 17px;" value="Płacę"/>
                </div>
      
       
        </div>
               <?php
                $order_price_to_sell = $total_order * 100;
                $salt = '15C5F19F23DF2DB35514B3850D0547BF883383CB8B3A48263802421B34776391';
                if($numer_lokalu != '')
                {
                  $params = 'pos_id=75384561&order_id='.$id_zakupu.'&session_id='.$id_klienta.'&amount='.$order_price_to_sell.'&currency=PLN&test=N&language=pl&client_ip='.$ip.'&street='.$ulica.'&street_n1='.$numer_budynku.'&street_n2='.$numer_lokalu.'&city='.$miejscowosc.'&postcode='.$kod_pocztowy.'&country=PL&email='.$email.'&ba_firstname='.$imie.'&ba_lastname='.$nazwisko;
                }
               else
               {
                $params = 'pos_id=75384561&order_id='.$id_zakupu.'&session_id='.$id_klienta.'&amount='.$order_price_to_sell.'&currency=PLN&test=N&language=pl&client_ip='.$ip.'&street='.$ulica.'&street_n1='.$numer_budynku.'&city='.$miejscowosc.'&postcode='.$kod_pocztowy.'&country=PL&email='.$email.'&ba_firstname='.$imie.'&ba_lastname='.$nazwisko;
               }
                $hexLenght = strlen($salt);
                $saltBin = "";
                for ($x = 1; $x <= $hexLenght/2; $x++) {
                $saltBin .= (pack("H*", substr($salt,2 * $x - 2,2)));
                }
                $key = hash("sha256", $params.$saltBin); 
                 
               ?>
                <input type="hidden" name='pos_id' value="75384561"> 
                <input type="hidden" name='order_id' value="<?php echo $id_zakupu ?>"> 
                <input type="hidden" name='session_id' value="<?php echo $id_klienta ?>"> 
                <input type="hidden" name="amount" value="<?php echo $order_price_to_sell ?>"> 
                <input type="hidden" name='currency' value="PLN">
                <input type="hidden" name='test' value="N">
                <input type="hidden" name='language' value="pl">
                <input type="hidden" name='client_ip' value="<?php echo $ip ?>">
                <input type="hidden" name='street' value="<?php echo $ulica ?>">
                <input type="hidden" name='street_n1' value="<?php echo $numer_budynku ?>">
                <?php
                    if($numer_lokalu != '')
                    {
                        echo '<input type="text" name="street_n2" value="'.$numer_lokalu.'">';
                    }
                ?>
                <input type="hidden" name='city' value="<?php echo $miejscowosc ?>">
                <input type="hidden" name='postcode' value="<?php echo $kod_pocztowy ?>">
                <input type="hidden" name='country' value="PL">
                <input type="hidden" name='email' value="<?php echo $email ?>">
                <input type="hidden" name='ba_firstname' value="<?php echo $imie ?>">
                <input type="hidden" name='ba_lastname' value="<?php echo $nazwisko ?>">
                <input type="hidden" name='controlData' value="<?php echo $key ?>"> 
            </form>
        </div>
        
    
        
        <div style="clear:both"></div>
        
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
</html>