<!DOCTYPE HTML>

<?php
session_start();
include('db_connect.php');

$_SESSION['kupuje']=true;
$delete_ico = '<img src="jpg/delete.jpg" width="30" height="" align=""/>';
$id_klienta = $_SESSION['id_klienta'];
if (isset($_POST['dalej']))
{
   if($_POST['price'] != '')
   {
     header('Location: opcje_dostawy.php#start');
   }
   else
   {
      $error = 'Aby przejsć dalej dodaj produkt do koszyka';
   }
}

?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Koszyk - NOVAHURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="bebico, zabawki, bujaczki, huśtawki, sklep, online, dla dzieci, artykuły, produkty, dziecięce, lugano, meble, hurtownia, sklep, internetowy, on line, 0n-line, e-sklep, stoly, stoły, fotele, biurowe, białystok, bialystok, tanio, kupie, nova, hurt, novahurt, zascianki" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->
    <script type="text/javascript" src="CMS/js/jquery-3.2.1.slim.min.js"></script>
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
 
    <div id="tresc_informator">
        
        <div class="tytuly">Koszyk</div><a name="start"></a>
            
            
            <form method="post">
            <div id= "koszyk_ramka">
            <div id= "koszyk_tabela_foto">
               </div>
               <div id= "koszyk_tabela_model">
               Model:
               </div>
               <div id= "koszyk_tabela_sztuk">
               Sztuk:
               </div>
               <div id= "koszyk_tabela_za_sztuke">
               Cena za sztukę:
               </div>
               <div id= "koszyk_tabela_max_w_paczce">
               Maksymalnie w paczce:
               </div>
                <div id= "koszyk_tabela_usun">
               
               </div>
            <div style="clear:both"></div>
               
                <?php
            $koszyk = $mysqli->query("SELECT * FROM card WHERE session_id = '$id_klienta'");
            $liczba_wierszy = mysqli_num_rows($koszyk);
                if($liczba_wierszy < 1)
                {
                echo '<h1>Brak produktów w koszyku</h1>';
                }
                else
                {
                $i = 1;
                while ($card=mysqli_fetch_array($koszyk) ){
                    $product_id = $card['id_produktu'];
                    $quantity = $card['quantity'];
                    $card_id = $card['id'];
                    
            $rezultat = $mysqli->query("SELECT * FROM produkty WHERE id = '$product_id'");
                
                while ($produkt=mysqli_fetch_array($rezultat) ){
                    
                    $foto = $mysqli->query("SELECT * FROM images WHERE article_id = '$product_id' AND place = '1'");
                
                while ($obraz=mysqli_fetch_array($foto) ){
                echo '<div id= "koszyk_tabela_foto_lista" style="background-image: url(products_img/'. $obraz['image_src'] .');">';
                echo '</div>';
                }
                echo '<div id= "koszyk_tabela_model_lista">';
                echo $produkt['model'];
                echo '</div>';
                echo '<div id= "koszyk_tabela_sztuk_lista">';
                echo '<input class="product_quantity" name="'.$i.'" type="number" value="'.$quantity.'" min="1" id="'.$card_id.'"/>';
                echo '</div>';
                echo '<div id= "koszyk_tabela_za_sztuke_lista">';
                echo $produkt['cena'];
                echo '<input type="hidden" id="piece_price_'.$i.'" value="'.$produkt['cena'].'"/></div>';
                echo '<div id= "koszyk_tabela_max_w_paczce_lista">';
                echo $produkt['sztuk_w_paczce'];
                echo '</div>';
                echo '<div id= "koszyk_tabela_usun_lista">';
                echo '<a href = "parts/koszyk/delete.php?id=' . $card_id . '">';
                echo $delete_ico;    
                echo '</a>';    
                echo '</div>';
                echo '<div style="clear:both"></div>';
                $product_price = $quantity * $produkt['cena'];
                echo '<input type="hidden" value="'.$product_price.'" id="product_sum_'.$i.'"/>';
                }
                    $last = $i;
                    $i++;
                }
                echo '<input name="price" type="hidden" value="'.$last.'" id="products_in_card"/>';
                }
            ?>
         
                <div style="clear:both"></div>
              
             Suma zamówienia: <span id="sum"></span> zł   
            </div>
            <div class="koszyk_pod_l">
                <a href="index.php#start2"><div id="koszyk_guzik_1">Kontynuuj zakupy</div></a>
            </div>
            <div class="koszyk_pod_p">
            <input id="dalej_guzik_koszyk" name="dalej" type="submit" value="Do kasy"/> 
            
            </form>
            
            </div>
            <div style="clear:both"></div> 
          
 
        </div>  
        <div style="clear:both"></div>
        
        
        
     
        </div>
            
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
<script type="text/javascript" src="parts/koszyk/koszyk.js"></script>

</html>