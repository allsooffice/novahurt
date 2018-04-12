<?php

$_SESSION['id_klienta'] = session_id();
include "koszyk_liczba_parter.php";
@$produkt_id = $_SESSION['produkt_id'];


if (isset($_POST['do_koszyka']))
{
    $id_sesji = $_SESSION['id_klienta'];
    
    
    $dodawanie = "insert into koszyk (id, ilosc, foto, id_klienta, model, cena_za_szt, max_w_paczce, gabaryt) values ('', '$ilosc', '$obraz_1', '$id_sesji', '$model', '$cena', '$sztuk_w_paczce', '$gabaryt')";
            // wykonanie dodawania do bazy
            $wynik = $mysqli->query($dodawanie);
                //sprawdzenie czy powiodło się dodawanie
        
    
    
}

?>


<div id="contener">
        <div id="panel">
            <div id="tele_ico"></div> 
            <div id="nr">782 70 00 94</div>
            <div id="mail_ico"></div> 
            <div id="nr"><a href="mailto:info@novahurt.pl">info@novahurt.pl</a> <a style="margin-left: 10px" href="https://www.facebook.com/novahurtpl/" target="_blank"><img src="jpg/facebook.png" width="20" height="20" align=""/></a></div>
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
				<li><a href="index.php">STRONA GŁÓWNA</a></li>
				<li><a href="#">PRODUKTY</a>
					<ul>
						<li><a href="meble_biurowe.php#start">MEBLE BIUROWE</a></li>
						<li><a href="art_dzieciece.php#start">ARTYKUŁY DZIECIĘCE</a></li>
						<li><a href="stoly_krzesla.php#start">STOŁY KRZESŁA</a></li>
						<li><a href="stoly_krzesla.php#start">AGD</a></li>
					</ul>
				</li>
				<li><a href="dane.php#1">O NAS</a>
				</li>
            <li><a href="dane.php#4">GDZIE JESTEŚMY</a>
				</li>
            <li><a href="dane.php#9">PŁATNOŚĆ</a>
				</li>
            <li><a href="dane.php#3">KONTAKT</a>
            <li><a href="informator.php#start">INFORMATOR</a>
            </li>
			</ol>
        </div>
        <div style="clear:both"></div>
        <div id="slider">
            <a href="index.php"><img src="../jpg/front.jpg" width="" height="" align="" /></a>
        </div>
    


        <div id="content_dzialy">
            
            <a href="meble_biurowe.php#start">
            <div id="dzial_biurowe">
                <div class="tittle">meble biurowe</div>
            </div>
            </a>
                
            
            <a href="art_dzieciece.php#start">
            <div id="dzial_dzieciece">
                <div class="tittle">artykuły dziecięce</div>
                
            </div>
            </a>
                
            <a href="stoly_krzesla.php#start">
            <div id="dzial_sk">
                <div class="tittle">stoły krzesła</div>
                
            </div>
            </a>
               
            <a href="agd.php#start">
            <div id="dzial_sk"  style="background-image: url(../jpg/agd.jpg);">
                <div class="tittle">AGD</div>
                
            </div>
            </a>
                
            <a href="pkh/logowanie.php#start">
            <div id="dzial_pk">
                <div id="tittle_pk">panel kontrahenta hurtowego</div>
             
            </div> 
            </a>
        </div>  
        <div style="clear:both"></div>