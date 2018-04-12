<!DOCTYPE HTML>

<?php
session_start();
$email = $_SESSION['email1'];

if (!isset($_SESSION['udanarejestracja']))
	{
		header('Location: rejestracja_kontrahenta.php#start');
		exit();
    
        
    
        
    
	}
else
	{
        $to = $email;
        $subj = "Potwierdzenie rejestracji NOVA HURT";
        $to2 = 'info@novahurt.pl';
        $subj2 = "Nowa rejestracja do Panelu Kontrahenta Hurtowego";
    
        $message = '
        
        <center><table border="1" style="background-color:#99cc00;border-collapse:collapse;border:1px solid #99cc00;color:#FFFFFF;width:100%" cellpadding="25" cellspacing="3">
            <tr>
                <td><h1><b><center>Dziękujemy za rejestrację!</center></b></h1></td>
            </tr>
            <tr>
                <td>
                <center>
                <font size="4">Po weryfikacji danych otrzymają Państwo hasło do Panelu Kontrahenta Hurtowego.<br>
                Prosimy nie odpowiadac na tą wiadomość.<br><br>
                Pozdrawiamy - zespół <b>NOVAHURT</b>.pl</font>
                <br>
                <br>
                <br>
                <a href="http://www.novahurt.pl" target="_blank"><img src="http://novahurt.pl/pkh/jpg/email.jpg" width="" height="" align=""/></a>
                <br>
                </center>
                </td>
            </tr>
        </table></center>
        ';
    
        $message2 = 'Nowa rejestracja do Panelu Konrahenta Hurtowego.<br> Hasło to: <b>PKHNVT2015$</b><br>
        <a href="http://novahurt.pl/CMS/kontrahenci.php?mail_login=true">Tutaj sprawdzisz szczegóły i akceptujesz zgłoszenie</a>';
        
    
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From: NOVA HURT <info@novahurt.pl>\r\n";
        $headers .= "X-Sender: <powiadomienia@novahurt.pl>";
        
        mail($to, $subj, $message, $headers);
        mail($to2, $subj2, $message2, $headers);
    
		unset($_SESSION['udanarejestracja']);
	}


$nazwa_firmy = $_SESSION['nazwa_firmy1'];
        
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
        <div class="tytuly_green">rejestracja przebiegła pomyślnie!</div>
        <div id="tresc_rejestracja">
            Dziękujemy <b><?php echo $nazwa_firmy ?></b> za rejestracje w naszym serwisie.<br/>
            Po weryfikacji na adres: <b><?php echo $email ?></b> zostanie wysłany indywidualny kod do
            Panelu Kontrahenta Hurtowego<br/><br/>
            Życzymy pomyślnej współpracy<br> - zespół NOVAHURT.pl
        
            
        </div>
        </div>
    
        
        <div style="clear:both"></div>
        
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
</html>