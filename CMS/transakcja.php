<!DOCTYPE HTML>
<?php
session_start();
if($_SESSION['zalogowany'] != true)
{
   header('Location: index.php');
}

if(isset($_GET['transaction']))
{
   $transaction = $_GET['transaction'];
   include('php/db_connect.php');
   
}
?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Transakcja - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style/loading.css"/>
	<link href="fontello/css/fontello.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>

<body>
  <?php
            include('parts/log_out.php');
      ?>
    <div class="wrapper">
        <div class="menu">
          
           <h2><i class="icon-menu"></i> Menu</h2>
           <?php
            include('parts/menu.php');
            ?>
            
        </div>
        
        <div class="content">
        <?php
$product = $mysqli->query("SELECT * FROM sell WHERE id = '$transaction'");
    while ($dane_zam=mysqli_fetch_array($product) ) 
    {
      $imie = $dane_zam['customer'];
      $nazwisko = $dane_zam['nazwisko'];
      $kod_pocztowy = $dane_zam['kod_pocztowy'];
      $miejscowosc = $dane_zam['miejscowosc'];
      $ulica = $dane_zam['ulica'];
      $numer_budynku = $dane_zam['numer_budynku'];
      $numer_lokalu = $dane_zam['numer_lokalu'];
      $sposob_dostawy = $dane_zam['sposob_dostawy'];
      $sposob_platnosci = $dane_zam['sposob_platnosci'];
      $status_platnosci = $dane_zam['payment_status'];
      $ubezpieczenie = $dane_zam['ubezpieczenie'];
      $dokument = $dane_zam['dokument'];
      $ankieta = $dane_zam['ankieta'];
      $dodatkowe = $dane_zam['dodatkowe'];
      $suma_zamowienia = $dane_zam['suma_zamowienia'];
      $cena_dostawy = $dane_zam['cena_dostawy'];
      $data_zam = $dane_zam['data'];
      $sygnatura = $dane_zam['sygnatura'];
      if($numer_lokalu != '')
      {
          $numer_lokalu = ' / '.$numer_lokalu;
      }
      $email = $dane_zam['mail'];
      $telefon = $dane_zam['telefon'];
      $zakup_produktow = $suma_zamowienia - $cena_dostawy - $ubezpieczenie;
    }
    
       echo
        '<table style="border-collapse: collapse; border: 1px solid black;">
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Zamówienie: </td><td style="border: 1px solid black; padding: 5px;">'.$sygnatura.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Data zamówienia: </td><td style="border: 1px solid black; padding: 5px;">'.$data_zam.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Adres dostawy: </td><td style="border: 1px solid black; padding: 5px;">'.$imie.' '.$nazwisko.'</br>'.$kod_pocztowy.' '.$miejscowosc.'<br>'.$ulica.' '.$numer_budynku.' '.$numer_lokalu.'</br>tel. '.$telefon.'<br>email: '.$email.'</td>
            </tr>
            <tr style="border: 1px solid black;"><td style="border: 1px solid black; padding: 5px;">Sprzedaż: </td><td style="border: 1px solid black; padding: 5px;">';
            $produkty = $mysqli->query("SELECT * FROM card WHERE order_id = '$transaction'");
            while ($wypisz=mysqli_fetch_array($produkty) ) 
            {
              $id_produktu = $wypisz['id_produktu'];
              $sztuk = $wypisz['quantity'];
              $piece_price = $wypisz['piece_price'];
              $product_name = $mysqli->query("SELECT * FROM produkty WHERE id = '$id_produktu'");
            while ($model=mysqli_fetch_array($product_name) ) 
            {
                echo $model['model'].' x '.$sztuk.' ['.$piece_price.' zł / szt.]<br>';
            }
            }
            echo '</td></tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Cena zakupów: </td><td style="border: 1px solid black; padding: 5px;">'.$zakup_produktow.'.00 zł</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Koszt dostawy: </td><td style="border: 1px solid black; padding: 5px;">'.$cena_dostawy.'.00 zł</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Ubezpieczenie przesyłki: </td><td style="border: 1px solid black; padding: 5px;">'.$ubezpieczenie.'.00 zł</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Sposób dostawy: </td><td style="border: 1px solid black; padding: 5px;">'.$sposob_dostawy.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Sposób płatności: </td><td style="border: 1px solid black; padding: 5px;">'.$sposob_platnosci.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Do zapłaty: </td><td style="border: 1px solid black; padding: 5px;">'.$suma_zamowienia.'.00 zł</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Status płatności: </td><td style="border: 1px solid black; padding: 5px;">'.$status_platnosci.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Skąd wie: </td><td style="border: 1px solid black; padding: 5px;">'.$ankieta.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Dokument zakupu: </td><td style="border: 1px solid black; padding: 5px;">'.$dokument.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Dodatkowe informacje: </td><td style="border: 1px solid black; padding: 5px;">'.$dodatkowe.'</td>
            </tr>
            
        </table>';
           ?>
        </div>
            
        <div style="clear: both;"></div>
        

        
    </div>
</body>
<script src="js/menu.js"></script>

</html>