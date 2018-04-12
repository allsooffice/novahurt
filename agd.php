<!DOCTYPE HTML>

<?php
session_start();
include('db_connect.php');
?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>AGD - NOVA HURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, vova, hurt, novahurt, zascianki" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->
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
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=382875065504143&ev=PageView&noscript=1"
/></noscript>
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
        <div id="tresc_informator"><a name="start"></a>
            <div class="tytuly">agd</div>
            
            <?php
               $rezultat = $mysqli->query("SELECT * FROM produkty WHERE dzial = 'AGD' AND wyswietlac <> 'Nie' AND wyswietlac <> 'Archiwum' ORDER BY category_place");
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
               
                <div style="clear:both"></div>
                
                      
        </div>
                
                    
               
        
        
        <?php
    include('parts/bottom_menu.php');
    ?>
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
</html>