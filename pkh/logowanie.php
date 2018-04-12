<!DOCTYPE HTML>

<?php
session_start();
$poprawne = true;
$dodano = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/dodano.gif"> </a>';
$nie_dodano = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/pusty.jpg"></a>';
if (isset($_POST['kod']))
{

$klucz = "PKHNVT2017$";
$podany_kod = strip_tags($_POST['kod']);

//sprawdzanie czy jest więcej niż 1 znak
if(strlen($podany_kod)<=1)
{
    $poprawne = false;
    $_SESSION['e_kod'] = "Pole jest puste";
}
    
if ($podany_kod != $klucz) 
{
    $poprawne = false;
    $_SESSION['e_kod'] = "Błędne hasło";
    
}
    
    if ($poprawne==true)
    {
    
        if ($podany_kod == $klucz)
            {
                $_SESSION['zalogowany'] = true;
            include('db_connect.php');
            $id_klienta = $_SESSION['id_klienta'];
            $usuwanie = "DELETE FROM koszyk WHERE id_klienta = '$id_klienta'";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);

                header('Location: index.php#start');
            }

    }

}

        
    ?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>logowanie do panelu kontrahenta hurtowego - NOVA HURT</title>
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
                    if (isset($_SESSION['koszykZero']))
                        {
                        echo $_SESSION['koszykZero'];
                        unset($_SESSION['koszykZero']);
                        }
                    else
                    {
                        echo $_SESSION['koszyk'];
                        unset($_SESSION['koszyk']);
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
        <div class="tytuly_green">Logowanie do Panelu Kontrahenta Hurtowego</div>
        <h3>Minimalna cena zakupów w panelu hurtowym została zniesiona.</h3>
        <h3>W celu uzyskania nowego hasła prosimy się zarejestrować</h3>
            <div class="logowanie_pkh">
            <form method="post">
            Podaj hasło klienta hurtowego aby się zalogować:<br><br>
            <input class="formularz" type="password" name="kod"/>
                
                <?php
                            if (isset($_SESSION['e_kod']))
                            {
                                echo '<div class="error">'. $_SESSION['e_kod'].'</div>';
                                unset ($_SESSION['e_kod']);    
                            }
                            ?>
                
                <br><br>
                
            <input id="rejestracja_przycisk" type="submit" value="ZALOGUJ"/>
            </form>
            </div>
            <div class="logowanie_pkh">
            Jesli nie posadasz hasła, zarejestruj się za pomocą formularza:<br>
                <a href="rejestracja_kontrahenta.php#start">
                    <div id="logowanie_guzik">REJESTRACJA</div>
                
            </a>
            </div>
        
            
        </div>
        
    
        
        <div style="clear:both"></div>
        
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
</html>