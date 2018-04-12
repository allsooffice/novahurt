<!DOCTYPE HTML>

<?php
include('db_connect.php');
session_start();
if (isset($_POST['imie']))
{
    
    $imie = strip_tags($_POST['imie']);
    $nazwisko = strip_tags($_POST['nazwisko']);
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
    $_SESSION['up_email'] = $_POST['email'];
    $_SESSION['up_telefon'] = $_POST['telefon'];
    $_SESSION['up_dodatkowe'] = $_POST['dodatkowe'];
    if (isset($_POST['pdo'])) $_POST['up_pdo'] = true;
    
    if ($poprawne==true)
    {
            //sprawdzanie czy klient jest juz w bazie
        $dubel_email = $_POST['email'];
        $dubel = $mysqli->query("SELECT email FROM klienci WHERE email='$dubel_email'");

        if (!$dubel) throw new Exception($mysqli->error);

        $ile_takich_maili = $dubel->num_rows;

        if($ile_takich_maili==0)
        { 

            $dodawanie = "insert into klienci (id, imie, nazwisko, ulica, nr_budynku, nr_mieszkania, kod_pocztowy, miejscowosc, email, telefon, dokument, dodatkowe, newsletter, nazwa_firmy, nip) values ('', '$imie', '$nazwisko', '-', '-', '-', '-', '-', '$email', '$telefon', '$dokument', '$dodatkowe', '$news', '-', '-')";
            // wykonanie dodawania do bazy
            $wynik = $mysqli->query($dodawanie);
                //sprawdzenie czy powiodło się dodawanie
        }
                     $_SESSION['imie'] = $_POST['imie'];
                    $_SESSION['nazwisko'] = $_POST['nazwisko'];
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['telefon'] = $_POST['telefon'];
                    $_SESSION['dodatkowe'] = $_POST['dodatkowe'];
                    $_SESSION['dokument'] = $_POST['dokument'];
                    if (isset($_POST['pdo'])) $_POST['up_pdo'] = true;
                    
                    
                    header('Location: odbior.php#start');
                    
       
    
    $mysqli->close();
    
    }

    
 
    

}

     
 

?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Odbiór osobisty - NOVA HURT</title>
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
        <div class="tytuly">odbiór osobisty</div>
        <div id="tresc_rejestracja">
            <h3>Dane do rezerwacji produktu:</h3>
        <form method="post">    
    
            
            
           
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
          <div id="rejestracja_contener_l">
                
                Imię:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="imie" value="<?php
                            if (isset($_SESSION['up_imie']))
                            {
                                echo $_SESSION['up_imie'];
                                unset($_SESSION['up_imie']);
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
                
                Nazwisko:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="nazwisko" value="<?php
                            if (isset($_SESSION['up_nazwisko']))
                            {
                                echo $_SESSION['up_nazwisko'];
                                unset($_SESSION['up_nazwisko']);
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
                Adres e-mail:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="email" value="<?php
                            if (isset($_SESSION['up_email']))
                            {
                                echo $_SESSION['up_email'];
                                unset($_SESSION['up_email']);
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
                Numer telefonu:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="telefon" value="<?php
                            if (isset($_SESSION['up_telefon']))
                            {
                                echo $_SESSION['up_telefon'];
                                unset($_SESSION['up_telefon']);
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
                Dokument zakupu:
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
                                unset($_SESSION['up_dodatkowe']);
                            }
                            ?></textarea>
            </div>
        </div> 
            <div style="clear:both"></div>
    </div>
            <div id="rejestracja_czekbox";>
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
                        unset($_SESSION['fr_regulamin']);
                    }
                           ?>/> Akceptuję <a href="dane.php#11">regulamin sklepu NOVAHURT.pl</a>
                    
                    <?php
                            if (isset($_SESSION['e_pdo']))
                            {
                                echo '<div class="error">'. $_SESSION['e_pdo'].'</div>';
                                unset ($_SESSION['e_pdo']);    
                            }
                            ?>
                    
              </label>
                <div id="dane_do_wysylki_nawigacja">
                    
                    <a href="javascript:history.back()">
            <div id="wstecz_guzik_do_wysylki">WSTECZ</div>
                    </a>
                    
                <input id="dalej_guzik_do_wysylki" type="submit" value="DALEJ"/>
                </div>
            </form> 
       
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