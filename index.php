<!DOCTYPE HTML>
<?php
session_start();
include('db_connect.php');

//licznik ładowania strony
$staty = true;

    if (isset($staty))
    {

        $licznik = "UPDATE statystyki SET enter_index = enter_index+1 WHERE id = 1";
                            // wykonanie dodawania do bazy
                            $licze = $mysqli->query($licznik);

    }
    unset($staty); 

?>
<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>NOVA HURT - Hurtownia Towarów Wielobranżowych</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych. Najlepsze ceny w Polsce! krzesła, stoły, fotele biurowe, artykuły dziecięce. Sprzedaż hurtowa i detaliczna." />
	<meta name="keywords" content="hurtownia, bialystok, białstok, zaścianki, bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, vova, hurt, novahurt, zascianki" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="Shortcut icon" href="favicon.ico" />
    <!-- Facebook Pixel Code -->

<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '382875065504143');
  fbq('track', 'PageView');
</script>

<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=382875065504143&ev=PageView&noscript=1"
/></noscript>

<!-- End Facebook Pixel Code -->
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'dc064794f997497e380db55bbff735832ea0fc85';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
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
 
        <div id="produkty">
          
            <div class="tytuly">najpopularniejsze produkty</div><a name="start2"></a>
            <div id="content_teksty">
                <div class="podzial" style="height: 220px;">
                        <img src="jpg/mbak_przelew.jpg" width="90" height="90" align=""/><br>
                    <b>DANE DO PRZELEWU:</b><br><br>
                        <b>POLTRADE EXPERT</b><br>
                        Nr konta: 68 1140 2004 0000 3502 7644 1716
                    </div>
                    
 
                    <div class="podzial">
                        <img src="jpg/telefon.png" width="90" height="80" align=""/><br>infolinia: 782 70 00 94<br><a href="mailto:info@novahurt.pl">info@novahurt.pl</a> 
                    </div>
                    
                    <div class="podzial">
                       
                        <img src="jpg/polska.jpg" width="140" height="130" align=""/><br>
                    </div>
                    
                    <div class="podzial">
                        <img src="jpg/b.jpg" width="110" height="80" align=""/><br>Nie przepłacaj!
                    </div>
                    
                    <div class="podzial">
                        <img src="jpg/k.jpg" width="70" height="60" align=""/><br>Tylko zaufani kontrahenci mają dostęp do cen hurtowych
                    </div>
                    <div class="podzial">
                        <img src="jpg/a.jpg" width="110" height="80" align=""/><br>Dostęp do produktów 24h
                    </div>
                    
                    <div class="podzial">
                        <img src="jpg/h.jpg" width="110" height="80" align=""/><br>Zwiększ swój zysk - współpracuj z najlepszymi
                    </div>
                    <div class="podzial">
                        <img src="jpg/i.jpg" width="70" height="60" align=""/><br>Jeśli znajdziesz nasz produkt taniej, oddamy Ci podwójną różnice ceny!
                    </div>
           
                    <div class="podzial">
                        <img src="jpg/gwarancja.jpg" width="170" height="130" align=""/><br>
                        
                    </div>
                    <div class="podzial">
                        <img src="jpg/j.jpg" width="90" height="80" align=""/><br>Wysyłka do 24h lub odbiór osobisty
                    </div>
                    
                    
                    <div class="podzial">
                        <img src="jpg/d.jpg" width="110" height="80" align=""/><br>Towar zawsze na stanie magazynu
                    </div>
                    <div class="podzial">
                        <img src="jpg/g.jpg" width="80" height="60" align=""/><br>Towar najwyższej jakości i sprawdzonych marek
                    </div>
                    
                    <div class="podzial">
                        <img src="jpg/e.jpg" width="90" height="60" align=""/><br>Przelicz to dobrze, współpraca z nami się opłaca!
                    </div>
                    <div class="podzial">
                        <img src="jpg/f.jpg" width="90" height="60" align=""/><br>Dołącz do grona kontrahentów i zyskuj więcej!
                    </div>
                
                    <div class="podzial">
                        <img src="jpg/c.jpg" width="110" height="80" align=""/><br>Tylko wyselekcjonowane produkty
                    </div>
            </div>  
            <div id="content_produkt">

            <?php
                $rezultat = $mysqli->query("SELECT * FROM produkty WHERE wyswietlac <> 'Nie' AND wyswietlac <> 'Archiwum' ORDER BY place");
                while ($produkt=mysqli_fetch_array($rezultat) ){
						 $id = $produkt['id'];
						 $pobieranie_obrazu = $mysqli->query("SELECT * FROM images WHERE article_id = '$id' AND place = '1' LIMIT 1");
							while ($obraz=mysqli_fetch_array($pobieranie_obrazu) )
							{
								 $obrazek = $obraz['image_src'];
							}

                        echo '<a href = "produkt/przedmiot.php?id=' . $produkt['id'] . '#start">';
                        echo '<div class="ramka_produkt">';
                        echo '<div class="tittle">' . $produkt['model'] . '</div>';
                        echo '<div class="ramka_produkt_foto" style="background-image: url(products_img/'.$obrazek.');">';
                        if($produkt['crossed_price'] != 0)
                        {
                           echo '<div class="crossed-price">'.$produkt['crossed_price'].' zł</div>';
                        }
                        echo '</div>';
                   
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
                
                
                    
                </div>
            
                <div style="clear:both"></div>
            
            </div>         
    
        
        <div style="clear:both"></div>
        <?php
    include('parts/bottom_menu.php');
    ?>
        
        
        
     
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.
            <div class="powered"><a href="http://www.mojawitryna.com">Powered by mojawitryna.com</a></div>
    </div>
    </div> 
    
    </div>
    


</body>
</html>