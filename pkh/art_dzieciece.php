<!DOCTYPE HTML>

<?php
session_start();
include('db_connect.php');
?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>artykuły dziecięce - NOVA HURT</title>
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
            <div class="tytuly">artykuły dziecięce</div>
            
            <?php
               $rezultat = $mysqli->query("SELECT * FROM produkty WHERE dzial = 'Artykuły dziecięce' AND wyswietlac <> 'Nie' AND wyswietlac <> 'Archiwum' ORDER BY category_place");
                while ($produkt=mysqli_fetch_array($rezultat) ){
						 $id = $produkt['id'];
						 $pobieranie_obrazu = $mysqli->query("SELECT * FROM images WHERE article_id = '$id' AND place = '1' LIMIT 1");
							while ($obraz=mysqli_fetch_array($pobieranie_obrazu) )
							{
								 $obrazek = $obraz['image_src'];
							}

                        echo '<a href = "produkt/przedmiot.php?id=' . $produkt['id'] . '#start">';
                        echo '<div class="ramka_produkt_dzialy">';
                        echo '<div class="tittle">' . $produkt['model'] . '</div>';
                        echo '<div class="ramka_produkt_foto" style="background-image: url(products_img/'.$obrazek.');"></div>';
                        
                        if($produkt['wyswietlac'] == 'Promocja')
                        {
                           echo '<div class="produkt_promo">';
                           echo '<div class="proname" style="background-color: #0066cc;">Promocja</div><span class="big_price"> '. $produkt['cena'] . '</span> zł';
                           echo '</div>'; 
                           echo '</div>'; 
                        }
                    
                        if($produkt['wyswietlac'] == 'Wyprzedaż')
                        {
                           echo '<div class="produkt_wyprzedaz">';
                           echo '<div class="proname" style="background-color: red;">Wyprzedaż</div><span class="big_price"> '. $produkt['cena'] . '</span> zł';
                           echo '</div>'; 
                           echo '</div>'; 
                        }
                    
                        if($produkt['wyswietlac'] == 'II gatunek')
                        {
                           echo '<div class="produkt_wyprzedaz">';
                           echo '<div class="proname" style="background-color: #0099cc;">II gatunek</div><span class="big_price"> '. $produkt['cena'] . '</span> zł';
                           echo '</div>'; 
                           echo '</div>'; 
                        }
                    
                        if($produkt['wyswietlac'] == 'Super cena!')
                        {
                           echo '<div class="produkt_wyprzedaz">';
                           echo '<div class="proname" style="background-color: #99cc00;">Super cena!</div><span class="big_price"> '. $produkt['cena'] . '</span> zł';
                           echo '</div>'; 
                           echo '</div>'; 
                        }
                    
                        if($produkt['wyswietlac'] == 'Tak')
                        {
                           echo '<div class="tittle2">Cena detaliczna:<br><span class="big_price"> '. $produkt['cena'] . '</span> zł</div>';
                        echo '</div>';
                        }
                        echo '</a>';
                    
                }
            ?>
               
                <div style="clear:both"></div>
                
                      
        </div>
                
                    
               
        
        
        <?php
    include('parts/bottom_menu.php');
    ?>
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
</html>