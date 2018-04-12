<!DOCTYPE HTML>

<?php
include('db_connect.php');
session_start();
$id_klienta = $_SESSION['id_klienta'];
$poprawne = true;

if(isset($_SESSION['ubezpieczenie']))
{
    $cena_podsumowanie = $_SESSION['cena_towarow'] + $_SESSION['koszt_przesylki'] + $_SESSION['ubezpieczenie'];
    $ubezpieczenie = $_SESSION['ubezpieczenie'];
}
else
{
    $ubezpieczenie = 0;
    $cena_podsumowanie = $_SESSION['cena_towarow'] + $_SESSION['koszt_przesylki'];
}

    



        
            
            $imie = $_SESSION['imie'];
            $nazwisko = $_SESSION['nazwisko'];
            $nr_budynku = $_SESSION['nr_budynku'];
            $nr_mieszkania = $_SESSION['nr_mieszkania'];
            $kod_pocztowy = $_SESSION['kod_pocztowy'];
            $ulica = $_SESSION['ulica'];
            $miejscowosc = $_SESSION['miejscowosc'];
            $produkt_sztuk = $_SESSION['p_s'];
            $cena_towarow = $_SESSION['cena_towarow'];
            $koszt_przesylki = $_SESSION['koszt_przesylki'];
            $placi = $_SESSION['placi'];
            $przesylka = $_SESSION['przesylka_baza'];
            $telefon = $_SESSION['telefon'];
            $email = $_SESSION['email'];
            $dokument = $_SESSION['dokument'];
            $data = date('Y-m-d H:i:s');
            $dodatkowe = $_SESSION['dodatkowe'];
            $ankieta = $_SESSION['ankieta'];
            
      
if ($_SESSION['first_time'] == true)
{

          $dodawanie = "insert into zamowienie (id, dane_klienta, produkt_sztuk, produkt_cena, przesylka, przesylka_cena, platnosc, czas, session_id, dodatkowe, dokument, rodzaj, sygnatura, nazwa_firmy, nip, status, email, komentarz, ubezpieczenie, ankieta) values ('', '$imie $nazwisko<br> ul. $ulica $nr_budynku/$nr_mieszkania<br> $kod_pocztowy $miejscowosc<br> tel: $telefon<br> email: $email', '$produkt_sztuk', '$cena_towarow zł', '$przesylka', '$koszt_przesylki zł', '$placi', '$data', '$id_klienta', '$dodatkowe', '$dokument', 'detal', '' , '', '', 'nowe', '$email', '', '$ubezpieczenie', '$ankieta')";
            // wykonanie dodawania do bazy
            $wynik = $mysqli->query($dodawanie);
                //sprawdzenie czy powiodło się dodawanie
                if($wynik)      
                {
                $_SESSION['first_time'] = false;
                include('parts/email.php');
                }
        
                    else           { echo 'Błąd podczas dodawania';
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
            <h3>Dane klienta:</h3>
           
    
            
            
           
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
             $rezultat = $mysqli->query("SELECT * FROM koszyk WHERE id_klienta = '$id_klienta'");
                
                while ($produkt=mysqli_fetch_array($rezultat) ){
    
                echo '<div id= "koszyk_tabela_foto_lista">';
                echo '<img src="' . $produkt['foto'] . '" width="" height="98">';
                echo '</div>';
                echo '<div id= "koszyk_tabela_model_lista">';
                echo $produkt['model'];
                echo '</div>';
                echo '<div id= "koszyk_tabela_sztuk_lista">';
                echo '<div class= "koszyk_tabela_sztuk_wybor">';
                echo '</div>';
                echo '<div class= "koszyk_tabela_sztuk_wybor">';
                    echo $produkt['ilosc'];
                    echo ' szt';
                echo '</div>';
                echo '<div class= "koszyk_tabela_sztuk_wybor">';
                echo '</div>';
                echo '</div>';
                echo '<div style="clear:both"></div>';
                                    }
                
                echo 'Do zapłaty: ';
                echo $cena_podsumowanie;
                echo ' zł';
                
                ?>
            </div>
            <div style="clear:both"></div>
    </div>
            <div id="rejestracja_czekbox";>
                   
        
                <div id="dane_do_wysylki_nawigacja">
                    
                    <a href="javascript:history.back()">
            <div id="wstecz_guzik_do_wysylki">WSTECZ</div>
                    </a>
            
                </div>
                       <?php $oplata = $cena_podsumowanie * 100; 
            

?>
           <form method="get" action="https://sklep.przelewy24.pl/zakup.php">
               <input type="hidden" name="z24_id_sprzedawcy" value="48046">
            <input type="hidden" name="z24_nazwa" value="nvt-p24">
            <input type="hidden" name="z24_crc" value="da0bb415"> 
            <input type="hidden" name="z24_return_url" value="http://novahurt.pl/metoda_platnosci.php#start"> 
            <input type="hidden" name="z24_language" value="pl"> 
            <input type="hidden" name="z24_kwota" value="<?php echo $oplata ?>"> 
            <input type="hidden" name="z24_opis" value="<?php echo $_SESSION['dodatkowe'] ?>"> 
            <input type="hidden" name="k24_nazwa" value="<?php echo $_SESSION['imie'] .' '. $_SESSION['nazwisko'] ?>"> 
            <input type="hidden" name="k24_email" value="<?php echo $_SESSION['email']?>">
            <input type="hidden" name="k24_phone" value="<?php echo $_SESSION['telefon']?>">
            <input type="hidden" name="k24_kraj" value="Polska">
            <input type="hidden" name="k24_kod" value="<?php echo $_SESSION['kod_pocztowy']?>">
            <input type="hidden" name="k24_miasto" value="<?php echo $_SESSION['miejscowosc']?>">
            <input type="hidden" name="k24_ulica" value="<?php echo $_SESSION['ulica']?>">
            <input type="hidden" name="k24_numer_dom" value="<?php echo $_SESSION['nr_budynku']?>">
            <input type="hidden" name="k24_numer_lok" value="<?php echo $_SESSION['nr_mieszkania']?>">
    
                
                
            <input id="dalej_guzik_do_wysylki" type="submit" name="place" value="PŁACĘ"/>
            </form>
       
        </div>
            
        </div>
        
    
        
        <div style="clear:both"></div>
        
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
</html>