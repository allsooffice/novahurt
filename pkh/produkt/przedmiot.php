<!DOCTYPE HTML>
<?php
session_start();
include "../db_connect.php";
$_SESSION['id_klienta'] = session_id();
$client_id = $_SESSION['id_klienta'];
include "../parts/koszyk_liczba.php";
if (isset($_GET['id']))
{
    $id= $_GET['id'];
    $rezultat = $mysqli->query("SELECT * FROM produkty WHERE id = $id AND wyswietlac <> 'Nie' LIMIT 1");
    $liczba_hasel = mysqli_num_rows($rezultat); 
    if($liczba_hasel < 1)
    {
      header('Location: ../index.php#start');
    }
    while ($produkt=mysqli_fetch_array($rezultat) ) {
      $model = $produkt['model'];
      $opis_1 = $produkt['opis_1'];
      $opis_2 = $produkt['opis_2'];
      $opis_3 = $produkt['opis_3'];
      $gabaryt = $produkt['gabaryt'];
      $kolor = $produkt['kolor'];
      $producent = $produkt['producent'];
      $cena = $produkt['cena_pkh'];
      $cena_pkh = $produkt['cena_pkh'];
      $dostawa = $produkt['dostawa_od'];
      $kolejna_sztuka = $produkt['kolejna_sztuka'];
      $pobranie = $produkt['dostawa_pobranie'];
      $material = $produkt['material'];
      $waga = $produkt['waga'];
      $wymiary_kartonu = $produkt['wymiary_kartonu'];
      $cecha_1 = $produkt['cecha_1'];
      $cecha_2 = $produkt['cecha_2'];
      $cecha_3 = $produkt['cecha_3'];
      $cecha_4 = $produkt['cecha_4'];
      $cecha_5 = $produkt['cecha_5'];
      $cecha_6 = $produkt['cecha_6'];
      $cecha_7 = $produkt['cecha_7'];
      $cecha_8 = $produkt['cecha_8'];
      $cecha_9 = $produkt['cecha_9'];
      $cecha_10 = $produkt['cecha_10'];
      $cecha_11 = $produkt['cecha_11'];
      $sztuk_w_paczce = $produkt['sztuk_w_paczce'];
      $brak = $produkt['brak'];  
    } 
    $wymiary = $mysqli->query("SELECT * FROM images WHERE article_id = $id AND place = '2' LIMIT 1");
    
    while ($obraz_wymiar=mysqli_fetch_array($wymiary) )
    {
        $wym = $obraz_wymiar['image_src'];
    }
    
//licznik ładowania strony
$licznik = true;

if (isset($licznik))
{
    
    $licznik = "UPDATE produkty SET wyswietlen = wyswietlen+1 WHERE id = $id";
                        // wykonanie dodawania do bazy
                        $licze = $mysqli->query($licznik);
  
}
unset($licznik);    
    
}


if (isset($_POST['do_koszyka']))
{
    $quantity = $_POST['quantity'];
    
     //sprawdzenie czy niema dubli
    
    $dubel = $mysqli->query("SELECT id FROM card WHERE id_produktu='$id' AND session_id='$client_id'");

    if (!$dubel) throw new Exception($mysqli->error);

    $ile_takich_produktow = $dubel->num_rows;
    
    if($ile_takich_produktow>0)
    {
        
        $_SESSION['e_kosz']="Ten produkt już jest w koszyku.";
    }
    
    else
    {
        
       $dodawanie = "insert into card (id, id_produktu, session_id, quantity, piece_price) values ('', '$id', '$client_id', '$quantity', '$cena')";
            // wykonanie dodawania do bazy
            $wynik = $mysqli->query($dodawanie);
                //sprawdzenie czy powiodło się dodawanie 
        
        $_SESSION['wyswietl'] = true;
       unset($_SESSION['koszykZero']);
    include "../parts/koszyk_liczba.php";
    }
  
}

?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title><?php echo $model;- 'NOVAHURT'?> </title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, vova, hurt, novahurt, zascianki" />
	<link href="../style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link href="fontello/fontello-c8f9e93e/css/fontello.css" rel="stylesheet" type="text/css" />
    <script src="../../../CMS/js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="../CMS/js/jquery-ui.js"></script>
    <script>
    function exitIt()
        {
            window.location.href = "../index.php#content_produkt";
        }
        
    </script>

</head>

<body>
    
    <?php
    if (isset($_SESSION['wyswietl'])){
        echo '<div id="bxm" class="box">
        <div class="add-cont">
            <h2>Produkt '.$model.' dodano do koszyka</h2>
            <ol>
                <li onclick="exitIt()">Kontynuuj zakupy</li>
                <li><a href="../koszyk.php#start">Koszyk</a></li>
            </ol>
        </div>
    </div>';
        
        unset($_SESSION['wyswietl']);

    }
    ?>
    
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
						<li><a href="../art_dzieciece.php#start">ARTYKUŁY DZIECIĘCE</a></li>
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
            <a href="index.php"><img src="../jpg/slajder.gif" width="" height="" align="" /></a>
        </div>
    


        <div id="content_dzialy">
            
            <a href="../meble_biurowe.php#start">
            <div id="dzial_biurowe">
                <div class="tittle">meble biurowe</div>
                
            </div>
            </a>
                
            
            <a href="../art_dzieciece.php#start">
            <div id="dzial_dzieciece">
                <div class="tittle">artykuły dziecięce</div>
                
            </div>
            </a>
                
            <a href="../stoly_krzesla.php#start">
            <div id="dzial_sk">
                <div class="tittle">stoły krzesła</div>
                
            </div>
            </a>
               
             <a href="../agd.php#start">
            <div id="dzial_sk"  style="background-image: url(../../jpg/agd.jpg);">
                <div class="tittle">AGD</div>
                
            </div>
            </a>
                
            <a href="../pkh/logowanie.php#start">
            <div id="dzial_pk">
                <div id="tittle_pk">panel kontrahenta hurtowego</div>
             
            </div> 
            </a>
        </div>  
        <div style="clear:both"></div>
 
        <div id="contener_produkt"><a name="start"></a>
            <div class="tytuly"><?php echo $model ?></div>
            <?php echo '<div class = "error_big">' . $brak . '</div>' ?>
               
               <div class="produkt_opis_dol">
              <div class="galeria">
                  <ol>
                      <div class="prev"><i class="icon-angle-circled-left"></i></div>
                    <?php
                    $galeria = $mysqli->query("SELECT * FROM images WHERE article_id = '$id' AND place <> '2' ORDER BY place ");
                    $i = 1;
                    while ($galeria_img=mysqli_fetch_array($galeria) )
                    {
                        if ($i == 1)
                        {
                           echo '<li id="'.$i.'" class="visible-image" style="background-image: url(../../products_img/'.$galeria_img['image_src'].');"><div class="img-loader"></div></li>'; 
                        }
                        else
                        {
                          echo '<li id="'.$i.'" style="background-image: url(../../products_img/'.$galeria_img['image_src'].');"><div class="img-loader"></div></li>';   
                        }
                        
                        
                       $i++; 
                    }
                    ?>  
                      <div class="next"><i class=" icon-angle-circled-right"></i></div>
                      <div style="clear: both;"></div>
                  </ol>
              </div>
                <div class="thumbs">
                    <ul>
                       <?php
                        
                    $galeria = $mysqli->query("SELECT * FROM images WHERE article_id = '$id' AND place <> '2' ORDER BY place ");
                    $i = 1;
                    while ($galeria_img=mysqli_fetch_array($galeria) )
                    {
                        if($i == 1)
                        {
                           echo '<li id="tmb'.$i.'" name="'.$i.'" class="running" style="background-image: url(../../products_img/'.$galeria_img['image_src'].');"></li>';
                        }
                        else
                        {
                          echo '<li id="tmb'.$i.'" name="'.$i.'" style="background-image: url(../../products_img/'.$galeria_img['image_src'].');"></li>';  
                        }
                        $i++;
                    }
                        
                    ?> 
                    </ul>             
                </div>               
                 <div style="clear: both;"></div>           
                            
                <div class="product-left">
                    <div class="produkt_prawa">
                        Opis:<br>
                            <ul>
                            <li>Kolor: <?php echo $kolor; ?></li>
                            <li>Producent: <?php echo $producent; ?></li>
                            <li><?php echo $opis_3; ?></li>
                            </ul>
                        </div>
                        <div class="produkt_prawa" style="border-top: none;">
                        
                        <table>
                            <tr>
                                <td>Dostawa:</td>
                                <?php if($sztuk_w_paczce > 1)
                                 {
                                    echo '<td>Pierwsza sztuka</td>';
                                 }
                               else
                               {
                                  echo '<td>Sztuka</td>';
                               }
                               ?>
                                <?php if($sztuk_w_paczce > 1)
                                 {
                                    echo '<td>Kolejna sztuka</td>';
                                 } ?>
                                <td>Max w paczce</td>
                            </tr>
                            <tr>
                                <td>Przesyłka kurierska</td>
                                <td><?php echo $dostawa; ?> zł</td>
                                <?php if($sztuk_w_paczce > 1)
                                 {
                                    echo '<td> '.$kolejna_sztuka. ' zł</td>';
                                 } ?>
                                <td><?php echo $sztuk_w_paczce; ?> szt</td>
                            </tr>
                            <tr>
                                <td>Przesyłka kurierska pobraniowa</td>
                                <td><?php echo $pobranie; ?> zł</td>
                                <?php if($sztuk_w_paczce > 1)
                                 {
                                   echo '<td> '.$kolejna_sztuka. ' zł</td>';
                                 } ?>
                                <td><?php echo $sztuk_w_paczce; ?> szt</td>
                            </tr>
                        </table>

                        </div>
                        <div style="clear: both"></div>
                </div>
                <div class="product-right">
                <div class="produkt_prawa" style="font-size: 24px; text-align: right;">
                        <?php $c = number_format ($cena_pkh,2,',','')?>
                      Cena hurtowa: <b><?php echo $c; ?></b> zł (z VAT)
                </div>
                <div class="card">
                        <form method="post">
                          Sztuk:
                          <div class="quantity-error">Nirpoprawna liczba</div>
                           <input type="number" id="quantity" name="quantity" value="1" min="1"/>
                            <input id="kup_przycisk" type="submit" value="&#8629; DO KOSZYKA" name="do_koszyka"/>
                            <?php
                            if (isset($_SESSION['e_kosz']))
                            {
                             echo '<div class="zielony_2">' . $_SESSION['e_kosz'] . '</div>';
                            unset($_SESSION['e_kosz']);
                            }

                            echo '<br>';    
                            if (isset($_SESSION['koszyk']))
                                {
                                echo $_SESSION['koszyk'];
                                unset($_SESSION['koszyk']);
                                }

                            ?>
                        </form>
                   </div>
                   <div class="produkt_prawa" style="text-align: right; border-top: none;">
                        Wysyłka: <span style="color: green;">natychmiast</span>
                    </div>
                    
                        
                </div>  
<div style="clear: both"></div>
                </div>                   
                                
                <div style="clear:both"></div>
                <div class="produkt_tabela_wymiary">
                    
                    <h3>Najważniejsze cechy:</h3>
                    <ul>
                    <li><?php echo $cecha_1; ?></li>
                    <li><?php echo $cecha_2; ?></li>
                    <li><?php echo $cecha_3; ?></li>
                    <li><?php echo $cecha_4; ?></li>
                    <li><?php echo $cecha_5; ?></li>
                    <li><?php echo $cecha_6; ?></li>
                    <li><?php echo $cecha_7; ?></li>
                    <li><?php echo $cecha_8; ?></li>
                    <li><?php echo $cecha_9; ?></li>
                    <li><?php echo $cecha_10; ?></li>
                    <li><?php echo $cecha_11; ?></li>
                    
                    </ul>

                </div>
                <div class="produkt_tabela_wymiary">
                    <h3>Specyfikacja:</h3><br>
                    <div id="produkty_tabela_wymiary_lewa">
                        Materiał:
                    </div>
                    <div id="produkty_tabela_wymiary_prawa">
                        <?php echo $material; ?>
                    </div>
                    
                    <div id="produkty_tabela_wymiary_lewa">
                        Waga:
                    </div>
                    <div id="produkty_tabela_wymiary_prawa">
                        <?php echo $waga; ?> kg 
                    </div>
                    
                    <div id="produkty_tabela_wymiary_lewa">
                        Wymiary kartonu:
                    </div>
                    <div id="produkty_tabela_wymiary_prawa">
                        <?php echo $wymiary_kartonu; ?> (cm)
                    </div>

                </div>
                <div style="clear:both"></div>    
                
            
                <div class="produkt_opis_dol">
                    
                    <h3>Wymiary:</h3>
                    <img src="../../products_img/<?php echo $wym; ?>" width="900" height="" align=""/>
                </div>
            
            
                
                    
            
        </div>
                   
                    
          <div style="clear:both"></div>          
               
        
        
        <div id="dolmenu">
            
            
            <a href="../pkh/logowanie.php#start">
            <div id="menu_pkh">Panel kontrahenta<br>hurtowego</div>
            </a>
            <a href="../dane.php#16">
            <div id="menu_faq">FAQ</div>
            </a>
            <a href="../dane.php#10">
            <div id="menu_reklamacje">reklamacje</div>
            </a>
            <a href="../dane.php#11">
            <div id="menu_zwroty">zwroty</div>
            </a>
        <div style="clear:both"></div>
            
            <a href="../dane.php#3">
            <div id="menu_kontakt">
                <div class="tittle">kontakt</div> 
                <img src="../jpg/kontakt.jpg" width="" height="" align="center"/>
            </div>
            </a> 
                
            <a href="../dane.php#2">
            <div id="menu_dlaczego">
                <div class="tittle">dlaczego my?</div> 
                <img src="../jpg/dlaczego.jpg" width="562" height="" align="center"/>
            </div>
            </a>    
            
            <div style="clear:both"></div>
            
            <a href="../dane.php#14">
            <div class="menu_4"><div class="tittle">dostawa</div>
                <img src="../jpg/dostawa.jpg" width="180" height="130" align=""/>
            </div>
            </a>
            
            <a href="../dane.php#6">
            <div class="menu_4"><div class="tittle">płatności</div>
                <img src="../jpg/platnosci.jpg" width="180" height="130" align=""/>
            </div>
            </a>    
            
            <a href="../dane.php#1">
            <div class="menu_4"><div class="tittle">o nas</div>
                <img src="../jpg/onas.jpg" width="180" height="130" align=""/>
            </div>
            </a>
            
            <a href="../dane.php#9">
            <div class="menu_4"><div class="tittle">regulamin</div>
                <img src="../jpg/regulamin.jpg" width="180" height="130" align=""/>
            </div>
            </a>
            
            <a href="../dane.php#4">
            <div class="menu_4"><div class="tittle">gdzie jesteśmy</div>
                <img src="../jpg/map.png" width="160" height="130" align=""/>
            </div>
            </a>    
            
            <a href="https://www.facebook.com/novahurtpl/" target="_blank">
            <div class="menu_4"><div class="tittle">dołącz do nas</div>
                <img src="../jpg/facebook.png" width="145" height="130" align=""/>
            </div>
            </a>
            <div style="clear:both"></div>
            
            
            
            
        </div>
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    </div>
    


</body>
<script src="js/slider.js"></script>
<script src="js/card.js"></script>
</html>