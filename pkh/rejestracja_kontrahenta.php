<!DOCTYPE HTML>

<?php
session_start();

if (isset($_POST['email']))
{
    $poprawne = true;

    
    $nazwa_firmy = strip_tags($_POST['nazwa_firmy']);
    $nip = strip_tags($_POST['nip']);
    $ulica = strip_tags($_POST['ulica']);
    $nr_budynku = strip_tags($_POST['nr_budynku']);
    $nr_lokalu = strip_tags($_POST['nr_lokalu']);
    $kod_pocztowy = strip_tags($_POST['kod_pocztowy']);
    $miejscowosc = strip_tags($_POST['miejscowosc']);
    $email = strip_tags($_POST['email']);
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    $tel = strip_tags($_POST['tel']);
    $news = $_POST['news'];
    

    //sprawdzanie czy jest więcej niż 1 znak
    if(strlen($nazwa_firmy)<=1)
    {
        $poprawne = false;
        $_SESSION['e_nazwa_firmy'] = "Uzupełnij to pole.";
    }
    
    if(strlen($nip)!=10)
    {
        $poprawne = false;
        $_SESSION['e_nip'] = "NIP ma nieodpowiednią liczbe znaków.";
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
    
    if(strlen($kod_pocztowy)<=1 || strlen($kod_pocztowy)>6 )
    {
        $poprawne = false;
        $_SESSION['e_kod_pocztowy'] = "Uzupełnij to pole.";
    }
    
    if(strlen($miejscowosc)<=1)
    {
        $poprawne = false;
        $_SESSION['e_miejscowosc'] = "Uzupełnij to pole.";
    }
    
    if(strlen($email)<=1)
    {
        $poprawne = false;
        $_SESSION['e_email'] = "Uzupełnij to pole.";
    }
    
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$poprawne=false;
			$_SESSION['e_email']="Podaj poprawny adres e-mail.";
		}
    
    if(strlen($tel)<=8)
    {
        $poprawne = false;
        $_SESSION['e_tel'] = "Uzupełnij to pole.";
    }
    
    if (!isset($_POST['pdo']))
		{
			$poprawne=false;
			$_SESSION['e_pdo']="Potwierdź akceptację przetwarzania danych.";
		}
    
    include "../db_connect.php";
    
    //sprawdzenie czy niema dubli nipów
    
    $dubel = $mysqli->query("SELECT id FROM kontrahenci WHERE nip='$nip'");

    if (!$dubel) throw new Exception($mysqli->error);

    $ile_takich_nipow = $dubel->num_rows;
    
    if($ile_takich_nipow>0)
    {
        $poprawne=false;
        $_SESSION['e_nip']="Istnieje już kontrahent z tym NIP-em.";
    }
    
    //zapamiętaj treść wypełnionych pól
    
    $_SESSION['up_nazwa_firmy'] = $nazwa_firmy;
    $_SESSION['up_nip'] = $nip;
    $_SESSION['up_ulica'] = $ulica;
    $_SESSION['up_nr_budynku'] = $nr_budynku;
    $_SESSION['up_nr_lokalu'] = $nr_lokalu;
    $_SESSION['up_kod_pocztowy'] = $kod_pocztowy;
    $_SESSION['up_miejscowosc'] = $miejscowosc;
    $_SESSION['up_email'] = $email;
    $_SESSION['up_tel'] = $tel;
    if (isset($_POST['pdo'])) $_SESSION['up_pdo'] = true;
    $data = date('Y-m-d H:i:s');
    //dodawanie do bazy
    
    if ($poprawne==true)
    {
            

            $dodawanie = "insert into kontrahenci (id, nazwa_firmy, nip, ulica, nr_budynku, nr_lokalu, kod_pocztowy, miejscowosc, email, tel, data, status, newsletter) values ('', '$nazwa_firmy', '$nip', '$ulica', '$nr_budynku', '$nr_lokalu', '$kod_pocztowy', '$miejscowosc', '$email', '$tel', '$data', 'nowy', '$news')";
            // wykonanie dodawania do bazy
            $wynik = $mysqli->query($dodawanie);
                //sprawdzenie czy powiodło się dodawanie
                if($wynik)      
                {
                    $_SESSION['udanarejestracja']=true;
                    $_SESSION['email1']=$email;
                    $_SESSION['nazwa_firmy1']=$nazwa_firmy;
                    
                    
                    
                    header('Location: rejestracja_kontrahenta_zakonczona.php#start');
                }
        
        else           { echo 'Błąd podczas dodawania';
    }
    
    $mysqli->close();
    
                        }
                        }
        
    ?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>rejestracja kontrahenta hurtowego - NOVA HURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, vova, hurt, novahurt, zascianki" />
	<link href="../style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->

</head>

<body>
    <div id="contener">
        <div id="panel">
            <div id="tele_ico"></div> 
            <div id="nr">782 70 00 94</div>
            <div id="mail_ico"></div> 
            <div id="nr"><a href="mailto:info@novahurt.pl">info@novahurt.pl</a> <a href="https://www.facebook.com/novahurtpl/" target="_blank"><img src="../jpg/facebook.png" width="20" height="20" align=""/></a></div>
            <div id="contener_koszyk">
                    <?php
    
                        if (!isset($_POST['do_koszyka']))
                        {
                         echo $nie_dodano;
                        
                        }
                        
    
                        if (isset($_POST['do_koszyka']))
                        {
                         echo $dodano;
                        
                        }
                    ?>
            </div> 
        </div>
        
                <div id="menu">
            <ol>
				<li><a href="../index.php">STRONA GŁÓWNA</a></li>
				<li><a href="#">PRODUKTY</a>
					<ul>
						<li><a href="../meble_biurowe.php#start">MEBLE BIUROWE</a></li>
						<li><a href="../artykuly_dzieciece.php#start">ARTYKUŁY DZIECIĘCE</a></li>
						<li><a href="../stoly_krzesla.php#start">STOŁY KRZESŁA</a></li>
					</ul>
				</li>
				<li><a href="../dane.php#1">O NAS</a>
				</li>
                <li><a href="../dane.php#4">GDZIE JESTEŚMY</a>
				</li>
				<li><a href="../dane.php#3">KONTAKT</a>
				</li>
                <li><a href="../informator.php#start">INFORMATOR</a>
			</ol>
        </div>
        <div style="clear:both"></div>
        <div id="slider">
            <a href="../index.php"><img src="../jpg/slajder.gif" width="" height="" align="" /></a>
        </div>
    


        <div id="content_dzialy">
            
            <a href="../meble_biurowe.php#start">
            <div id="dzial_biurowe">
                <div class="tittle">meble biurowe</div>
                
            </div>
            </a>
                
            
            <a href="../artykuly_dzieciece.php#start">
            <div id="dzial_dzieciece">
                <div class="tittle">artykuły dziecięce</div>
                
            </div>
            </a>
                
            <a href="../stoly_krzesla.php#start">
            <div id="dzial_sk">
                <div class="tittle">stoły krzesła</div>
                
            </div>
            </a>
                
            <a href="logowanie.php#start">
            <div id="dzial_pk">
                <div id="tittle_pk">panel kontrahenta hurtowego</div>
             
            </div> 
            </a>
        </div>  
        <div style="clear:both"></div>
 
    <div id="tresc_informator"><a name="start"></a>
        <div class="tytuly_green">rejestracja do panelu kontrahenta hurtowego</div>
        <div id="tresc_rejestracja">
            <h4>Aby uzyskać dostęp do Panelu Kontrahenta Hurtowego wypełnij poniższy formularz:</h4>
        <form method="post">    
        <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                Nazwa firmy:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="nazwa_firmy" value="<?php
                            if (isset($_SESSION['up_nazwa_firmy']))
                            {
                                echo $_SESSION['up_nazwa_firmy'];
                                unset($_SESSION['up_nazwa_firmy']);
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_nazwa_firmy']))
                            {
                                echo '<div class="error">'. $_SESSION['e_nazwa_firmy'].'</div>';
                                unset ($_SESSION['e_nazwa_firmy']);    
                            }
                            ?>
                    
                </div>
        </div>
           
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                NIP:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="nip" value="<?php
                            if (isset($_SESSION['up_nip']))
                            {
                                echo $_SESSION['up_nip'];
                                unset($_SESSION['up_nip']);
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_nip']))
                            {
                                echo '<div class="error">'. $_SESSION['e_nip'].'</div>';
                                unset ($_SESSION['e_nip']);    
                            }
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                Ulica:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="ulica" value="<?php
                            if (isset($_SESSION['up_ulica']))
                            {
                                echo $_SESSION['up_ulica'];
                                unset($_SESSION['up_ulica']);
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
                
                Numer budynku:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="nr_budynku" value="<?php
                            if (isset($_SESSION['up_nr_budynku']))
                            {
                                echo $_SESSION['up_nr_budynku'];
                                unset($_SESSION['up_nr_budynku']);
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
                    <input class="formularz" type="text" name="nr_lokalu" value="<?php
                            if (isset($_SESSION['up_nr_lokalu']))
                            {
                                echo $_SESSION['up_nr_lokalu'];
                                unset($_SESSION['up_nr_lokalu']);
                            }
                            ?>"/>
                            
                    
                </div>
            </div>
            <div style="clear:both"></div>
            
            <div id="rejestracja_contener_wiersz">
            <div id="rejestracja_contener_l">
                
                Kod pocztowy:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="kod_pocztowy" value="<?php
                            if (isset($_SESSION['up_kod_pocztowy']))
                            {
                                echo $_SESSION['up_kod_pocztowy'];
                                unset($_SESSION['up_kod_pocztowy']);
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
                
                Miejscowość:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="miejscowosc" value="<?php
                            if (isset($_SESSION['up_miejscowosc']))
                            {
                                echo $_SESSION['up_miejscowosc'];
                                unset($_SESSION['up_miejscowosc']);
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
                
                Adres email:
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
                
                Tel. kontaktowy:
                </div>
                <div id="rejestracja_contener_p">
                    <input class="formularz" type="text" name="tel" value="<?php
                            if (isset($_SESSION['up_tel']))
                            {
                                echo $_SESSION['up_tel'];
                                unset($_SESSION['up_tel']);
                            }
                            ?>"/>
                            <?php
                            if (isset($_SESSION['e_tel']))
                            {
                                echo '<div class="error">'. $_SESSION['e_tel'].'</div>';
                                unset ($_SESSION['e_tel']);    
                            }
                            ?>
                    
                </div>
            </div>
            <div style="clear:both"></div>
                
                    
                
          
    </div>
            <div id="rejestracja_czekbox";>
                    <label>
                    <input checked type="checkbox" name="news" <?php
                    if (isset($_SESSION['up_news']))
                    {
                        echo "checked";
                        unset($_SESSION['up_news']);
                    }
                        ?>/> Chcę zaprenumerować newsletter NOVAHURT.pl (nowości i promocje hurtowe)
                    </label>
                <br>
                <label>
                    <input type="checkbox" name="pdo" <?php
                    if (isset($_SESSION['up_pdo']))
                    {
                        echo "checked";
                        unset($_SESSION['up_pdo']);
                    }
                        ?>/> Wyrażam zgodę na przetwarzanie i przechowywanie moich danych osobowych
                    
                    <?php
                            if (isset($_SESSION['e_pdo']))
                            {
                                echo '<div class="error">'. $_SESSION['e_pdo'].'</div>';
                                unset ($_SESSION['e_pdo']);    
                            }
                            ?>
                    
              </label>
                <br><br>
                <input id="rejestracja_przycisk" type="submit" value="WYŚLIJ ZGŁOSZENIE"/>
                
            </form> 
       
        </div>
            
        </div>
        
    
        
        <div style="clear:both"></div>
        
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
</html>