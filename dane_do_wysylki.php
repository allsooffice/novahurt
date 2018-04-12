<!DOCTYPE HTML>

<?php
session_start();
include('db_connect.php');
$client_id = $_SESSION['id_klienta'];
$data = date('d.m.y H:i');
if (isset($_POST['imie']))
{
	$imie = strip_tags($_POST['imie']);
    $nazwisko = strip_tags($_POST['nazwisko']);
    $ulica = strip_tags($_POST['ulica']);
    $nr_budynku = strip_tags($_POST['nr_budynku']);
    $nr_mieszkania = strip_tags($_POST['nr_mieszkania']);
    $kod_pocztowy = strip_tags($_POST['kod_pocztowy']);
    $miejscowosc = strip_tags($_POST['miejscowosc']);
    $email = strip_tags($_POST['email']);
    $telefon = strip_tags($_POST['telefon']);
    $dokument = strip_tags($_POST['dokument']);
    $dodatkowe = strip_tags($_POST['dodatkowe']);
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    $news = ($_POST['news']);
    $poprawne = true;
    
    
    if(strlen($imie)<=1)
    {
        $poprawne = false;
        $_SESSION['e_imie'] = "Uzupełnij to pole.";
    }
    
    if(strlen($nazwisko)<=1)
    {
        $poprawne = false;
        $_SESSION['e_nazwisko'] = "Uzupełnij to pole.";
    }
    
    if(strlen($ulica)<=1)
    {
        $poprawne = false;
        $_SESSION['e_ulica'] = "Uzupełnij to pole.";
    }
    
    if(strlen($nr_budynku)<1)
    {
        $poprawne = false;
        $_SESSION['e_nr_budynku'] = "Uzupełnij to pole.";
    }
    
    if(strlen($kod_pocztowy)<6 || strlen($_POST['kod_pocztowy'])>6 )
    {
        $poprawne = false;
        $_SESSION['e_kod_pocztowy'] = "Błędny kod pocztowy.";
    }
    
    if(strlen($miejscowosc)<=2)
    {
        $poprawne = false;
        $_SESSION['e_miejscowosc'] = "Uzupełnij to pole.";
    }
    
    if(strlen($email)<=5)
    {
        $poprawne = false;
        $_SESSION['e_email'] = "Uzupełnij to pole.";
    }
    
    
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$poprawne=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail.";
		}
    
    if(strlen($email)<=6)
    {
        $poprawne = false;
        $_SESSION['e_email'] = "Uzupełnij to pole.";
    }
    
    if(strlen($telefon)<9)
    {
        $poprawne = false;
        $_SESSION['e_telefon'] = "Uzupełnij to pole.";
    }
    
    if (!isset($_POST['pdo']))
		{
			$poprawne=false;
			$_SESSION['e_pdo']="Potwierdź akceptację regulaminu.";
		}
    
    //zapamiętaj treść wypełnionych pól
    
    $_SESSION['up_imie'] = $_POST['imie'];
    $_SESSION['up_nazwisko'] = $_POST['nazwisko'];
    $_SESSION['up_ulica'] = $_POST['ulica'];
    $_SESSION['up_nr_budynku'] = $_POST['nr_budynku'];
    $_SESSION['up_nr_mieszkania'] = $_POST['nr_mieszkania'];
    $_SESSION['up_kod_pocztowy'] = $_POST['kod_pocztowy'];
    $_SESSION['up_miejscowosc'] = $_POST['miejscowosc'];
    $_SESSION['up_email'] = $_POST['email'];
    $_SESSION['up_telefon'] = $_POST['telefon'];
    $_SESSION['up_dodatkowe'] = $_POST['dodatkowe'];
    if (isset($_POST['pdo'])) $_POST['up_pdo'] = true;
    
    if ($poprawne==true)
    {
    $dodawanie = "UPDATE sell SET data = '$data', customer = '$imie', nazwisko = '$nazwisko', dokument = '$dokument', dodatkowe = '$dodatkowe', mail = '$email', newsletter = '$news', kod_pocztowy = '$kod_pocztowy', miejscowosc = '$miejscowosc', ulica = '$ulica', numer_budynku = '$nr_budynku', numer_lokalu = '$nr_mieszkania', telefon = '$telefon' WHERE session_id = '$client_id' AND status = 'koszyk'";
    // wykonanie dodawania do bazy
    $wynik = $mysqli->query($dodawanie);
    
    $product = $mysqli->query("SELECT * FROM sell WHERE session_id = '$client_id' AND status = 'koszyk'");
        while ($dane_zam=mysqli_fetch_array($product) ) 
        {
          $sposob_dostawy = $dane_zam['sposob_dostawy'];
          $sposob_platnosci = $dane_zam['sposob_platnosci'];
          $id_transakcji = $dane_zam['id'];
        }
        $nr = date('d-m');
        $sygnatura = 'NVT/'.$id_transakcji.'/'.$nr;
        $nadawanie = "UPDATE sell SET sygnatura = '$sygnatura' WHERE session_id = '$client_id' AND status = 'koszyk'";
        // wykonanie dodawania do bazy
        $symbol = $mysqli->query($nadawanie);
        
        $id_do_koszyka = "UPDATE card SET order_id = '$id_transakcji' WHERE session_id = '$client_id'";
        // wykonanie dodawania do bazy
        $wprowadz = $mysqli->query($id_do_koszyka);

        if($sposob_platnosci == 'Przy pobraniu kurierowi' || $sposob_platnosci == 'Przelew na konto' || $sposob_platnosci == 'Kartą lub gotówką przy odbiorze')
        {
            header('Location: podsumowanie.php#start');
        }
        if($sposob_platnosci == 'Szybki przelew internetowy' || $sposob_platnosci == 'Karta płatnicza')
        {
            header('Location: payment_send.php#start');
        }
    
        }

    

    
    //ustawienie zmiennych sesyjnych
    $_SESSION['imie'] = $_POST['imie'];
    $_SESSION['nazwisko'] = $_POST['nazwisko'];
    $_SESSION['ulica'] = $_POST['ulica'];
    $_SESSION['nr_budynku'] = $_POST['nr_budynku'];
    $_SESSION['nr_mieszkania'] = $_POST['nr_mieszkania'];
    $_SESSION['kod_pocztowy'] = $_POST['kod_pocztowy'];
    $_SESSION['miejscowosc'] = $_POST['miejscowosc'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['telefon'] = $_POST['telefon'];
    $_SESSION['dokument'] = $_POST['dokument'];
    $_SESSION['dodatkowe'] = $_POST['dodatkowe'];
    

    

}

     
$product = $mysqli->query("SELECT * FROM sell WHERE session_id = '$client_id' AND status = 'koszyk'");
   while ($dane_zam=mysqli_fetch_array($product) ) 
   {
      $sposob_dostawy = $dane_zam['sposob_dostawy'];
   }

?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Dane do wysyłki - NOVA HURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, vova, hurt, novahurt, zascianki" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->
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

<body>
    <?php
    include('parts/head.php');
    ?>
 
        <form method="post">    
    <div id="tresc_informator"><a name="start"></a>
      <?php
			 
       if ($sposob_dostawy == 'Odbiór osobisty')
		 {
			 echo '<div class="tytuly">3/4 dane do rezerwacji</div>';
		 }
		 else
		 {
			 echo '<div class="tytuly">3/4 dane do wysyłki</div>';
		 }
			 ?>
        
        <div id="tresc_rejestracja">
           <?php
       if ($sposob_dostawy == 'Odbiór osobisty')
		 {
			 echo '<h3>Dane do rezerwacji</h3>';
		 }
		 else
		 {
			 echo '<h3>Dane do wysyłki:</h3>';
		 }
			 ?>
            
    
            
            
           
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
          <div id="rejestracja_contener_l">
                
                Imię: <i class="required">*</i>
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="imie" value="<?php
                            if (isset($_SESSION['up_imie']))
                            {
                                echo $_SESSION['up_imie'];
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_imie']))
                            {
                                echo '<div class="error">'. $_SESSION['e_imie'].'</div>';
                                unset ($_SESSION['e_imie']);    
                            }
                            ?>
                            
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                Nazwisko: <i class="required">*</i>
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="nazwisko" value="<?php
                            if (isset($_SESSION['up_nazwisko']))
                            {
                                echo $_SESSION['up_nazwisko'];
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_nazwisko']))
                            {
                                echo '<div class="error">'. $_SESSION['e_nazwisko'].'</div>';
                                unset ($_SESSION['e_nazwisko']);    
                            }
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                Ulica: <i class="required">*</i>
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="ulica" value="<?php
                            if (isset($_SESSION['up_ulica']))
                            {
                                echo $_SESSION['up_ulica'];
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_ulica']))
                            {
                                echo '<div class="error">'. $_SESSION['e_ulica'].'</div>';
                                unset ($_SESSION['e_ulica']);    
                            }
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                Numer budynku: <i class="required">*</i>
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="nr_budynku" value="<?php
                            if (isset($_SESSION['up_nr_budynku']))
                            {
                                echo $_SESSION['up_nr_budynku'];
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_nr_budynku']))
                            {
                                echo '<div class="error">'. $_SESSION['e_nr_budynku'].'</div>';
                                unset ($_SESSION['e_nr_budynku']);    
                            }
                         ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                Numer lokalu:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="nr_mieszkania" value="<?php
                            if (isset($_SESSION['up_nr_mieszkania']))
                            {
                                echo $_SESSION['up_nr_mieszkania'];
                            }
                            ?>"/>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                Kod pocztowy: <i class="required">*</i>
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="kod_pocztowy" value="<?php
                            if (isset($_SESSION['up_kod_pocztowy']))
                            {
                                echo $_SESSION['up_kod_pocztowy'];
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_kod_pocztowy']))
                            {
                                echo '<div class="error">'. $_SESSION['e_kod_pocztowy'].'</div>';
                                unset ($_SESSION['e_kod_pocztowy']);    
                            }
                         ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                Miejscowość: <i class="required">*</i>
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="miejscowosc" value="<?php
                            if (isset($_SESSION['up_miejscowosc']))
                            {
                                echo $_SESSION['up_miejscowosc'];
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_miejscowosc']))
                            {
                                echo '<div class="error">'. $_SESSION['e_miejscowosc'].'</div>';
                                unset ($_SESSION['e_miejscowosc']);    
                            }
                         ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
                
            <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                Adres e-mail: <i class="required">*</i>
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="email" value="<?php
                            if (isset($_SESSION['up_email']))
                            {
                                echo $_SESSION['up_email'];
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_email']))
                            {
                                echo '<div class="error">'. $_SESSION['e_email'].'</div>';
                                unset ($_SESSION['e_email']);    
                            }
                         ?>
                    
                </div>
        </div>      
        <div style="clear:both"></div> 
            
        <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                Numer telefonu: <i class="required">*</i>
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="telefon" value="<?php
                            if (isset($_SESSION['up_telefon']))
                            {
                                echo $_SESSION['up_telefon'];
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_telefon']))
                            {
                                echo '<div class="error">'. $_SESSION['e_telefon'].'</div>';
                                unset ($_SESSION['e_telefon']);    
                            }
                         ?>
                    
                </div>
        </div>      
        <div style="clear:both"></div>    
            
            <div id="rejestracja_contener_wiersz">  
                <div id="rejestracja_contener_l">
                Dokument zakupu: <i class="required">*</i>
                </div>
                <div id="rejestracja_contener_p">
            <select id="dane_do_wysylki_wysuwane" name="dokument">
                        <option>Paragon</option>
                        <option>Faktura</option>
               </select>
                </div>
            </div>    
          <div style="clear:both"></div>
          
        <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                Dodatkowe informacje:
                <div class="koszyk_mala_czcionka">
                (Np dane do faktury, inny adres wysyłki, uwagi dot. transakcji)
                </div>
            </div>
            <div id="rejestracja_contener_p">
                <textarea id="dane_do_wysylki_wiadomosc" name="dodatkowe" ><?php
                            if (isset($_SESSION['up_dodatkowe']))
                            {
                                echo $_SESSION['up_dodatkowe'];
                            }
                            ?></textarea>
            </div>
        </div> 
            <div style="clear:both"></div>
    </div>
            <div id="rejestracja_czekbox";>
                   <i class="required">*</i> - Pola wymagane<br>
                    <label>
                    <input checked type="checkbox" name="news" <?php
                    if (isset($_SESSION['fr_regulamin']))
                    {
                        echo "checked";
                        unset($_SESSION['fr_regulamin']);
                    }
                        ?>/> Chcę zaprenumerować newsletter NOVAHURT.pl (nowości i promocje sklepowe)
                    </label>
                <br>
                <label>
                    <input type="checkbox" name="pdo" <?php
                    if (isset($_SESSION['fr_regulamin']))
                    {
                        echo "checked";
                    }
                           ?>/> Akceptuję <a href="dane.php#11" target="_blank">regulamin sklepu NOVAHURT.pl</a>
                    
                    <?php
                            if (isset($_SESSION['e_pdo']))
                            {
                                echo '<div class="error">'. $_SESSION['e_pdo'].'</div>';
                                unset ($_SESSION['e_pdo']);    
                            }
                            ?>
                    
              </label>
                <div id="dane_do_wysylki_nawigacja">
                    
                    <a href="opcje_dostawy.php#start">
            <div id="wstecz_guzik_do_wysylki">WSTECZ</div>
                    </a>
                    
                <input id="dalej_guzik_do_wysylki" type="submit" value="DALEJ"/>
                </div>
       
        </div>
            
        </div>
        
    
			</form> 
        
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