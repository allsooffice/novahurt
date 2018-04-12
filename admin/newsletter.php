<!DOCTYPE HTML>
<?php
session_start();
include('../db_connect.php');

// calkowita liczba uzytkownikow

$pobieranie_user = $mysqli->query("SELECT * FROM klienci WHERE newsletter = 'on'");
$num_rows_uzytkownicy = mysqli_num_rows($pobieranie_user);


$maile = $mysqli->query("SELECT * FROM klienci WHERE newsletter = 'on'");
               
                while ($produkt=mysqli_fetch_array($maile) )
                {
                    @$m .= $produkt['email'].', ';
                }
                 
if(isset ($_POST['odbiorcy']))
{
        $odbiorcy = explode(", ", $_POST['odbiorcy']);
        $subj = $_POST['temat'];
        //$message = nl2br($_POST['tresc']);  
        $message1 = '<div>
  <div>
      <a href="http:www.novahurt.pl#content_produkt" style="display: block; text-decoration: none;">
       <img src="http://www.novahurt.pl/newsletter/logo.jpg" alt="logo" width="10%;" style="margin-left: 3%; margin-top: 2%; float: left;">
      </a>
      <h1 style="float: left; margin-left: 50px; margin-top: 40px;">www.novahurt.pl NAJLEPSZE CENY W POLSCE</h1>
      <div style="clear: both"</div>
   </div>
    <div class="content" style="width: 90%; padding: 5%; background-color: #F3F3F3">';
       
       
        $products = '';
       $message2 = '<div style="clear: both"</div>
    </div>
    <div style="text-align: center; color: silver;">
          <a href="http:www.novahurt.pl#content_produkt" style="display: block; text-decoration: none; color: silver;">
           <p>www.novahurt.pl</p>
        </a>
        ';
    
    $maile = $mysqli->query("SELECT * FROM produkty WHERE wyswietlac <> 'Nie' AND id <> '2'");
               
                while ($produkt=mysqli_fetch_array($maile) )
                {
                    $tytul = $produkt['model'];
                    if(strlen($tytul) > 15)
                    {
                        $tytul = substr($tytul,0,15) . '...';
                    }
                    $products .= '<a href="http:www.novahurt.pl#content_produkt" style="display: block; text-decoration: none;">
        <div class="product" style="border: 1px solid silver; width: 15%; height: auto; border-radius: 4px; float: left; margin-left: 10px; margin-bottom: 15px; padding: 5px;">
            <div class="image" style="display: block; overflow: hidden;">
                <img src="'.$produkt['obraz'].'" alt="'.$produkt['model'].'" style="width: 100%; height auto;">
            </div>
            <div class="product-name" style="text-align: center; font-size: 20px; color: #696969; font-weight: bold; text-decoration: none;">'.$produkt['cena'].' zł</div>
        </div>
       </a>';
                }
    
    
    
        $message = $message1.$products.$message2;
     
        $nadawca = 'info@novahurt.pl';
            
    
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From: novahurt.pl <".$nadawca.">\r\n";
        $headers .= "X-Sender: <".$nadawca.">";
          
        $i=0;
 
        while (isset($odbiorcy[$i]) && $odbiorcy[$i]!='')
        {            
        $dol = '<a href="http://www.novahurt.pl/unsuscribe.php?hbyyzcw='.$odbiorcy[$i].'" style="display: block; text-decoration: none; color: silver;">wyłącz subskrypcję</a></div>
    </div>';
        
        $message .= $dol;
        mail($odbiorcy[$i], $subj, $message, $headers);
            
        $dodawanie_obrazu = "insert into newsletter (id, email, temat) values ('', '$odbiorcy[$i]', '$subj')";
            // wykonanie dodawania do bazy
        $wynik_dodawania = $mysqli->query($dodawanie_obrazu);
            
        $i++;
        $wyslano = $i;
        }
    
    
}

?>

<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Admin - ForAnimal.pl</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="fonts/fontello-0fc123dc/css/fontello.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet"> 
    <link rel="Shortcut icon" href="favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    

</head>

<body>
      <?php include('head.php'); ?>
       <div class="content">
        
       
        <div class="zawartosc" id="con">
           <div class="center">
              <?php 
               if (isset($wyslano))
               {
                   echo 'Wysłano '.$wyslano.' wiadomości.';
               }
               ?>
               <form method="post">
                <h3 class="newsletter-h3">Klienci z zaznaczonym newsletterem: <?php echo $num_rows_uzytkownicy; ?></h3>
                   <i class="newsleter-i">adresy email odseparowane przecinkami</i><br>
                    <textarea class="newsletter-emails" name="odbiorcy"><?php echo $m; ?></textarea>
                <h3 class="newsletter-h3">Temat:</h3>
                    <input type="text" class="newsletter-temat" name="temat">
                <h3 class="newsletter-h3">Treść:</h3>
                    <textarea id="input-tresc" class="newsletter-tresc" name="tresc"></textarea>
                <br>
                    <input class="newsletter-send" type="submit" value="Wyślij"/>
               </form>
           </div>
        <div style="clear: both;"></div>
    </div>
    <div style="clear:both;"></div>    
</body>
</html>