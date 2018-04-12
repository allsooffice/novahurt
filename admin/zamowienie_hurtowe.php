<!DOCTYPE HTML>

<?php
session_start();

if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php#start');  
}

include('../db_connect.php');
$data = date('Y-m-d H:i:s');


if (isset($_GET['id']))
{
    $id= $_GET['id'];
     $rezultat = $mysqli->query("SELECT * FROM zamowienie WHERE id = $id");
$produkt=mysqli_fetch_array($rezultat);
    
    if (isset($_POST['komentarz_tresc']))
    {
        $tresc = $produkt['komentarz'].'<br>'.$_POST['komentarz_tresc'];
        $zmien = "UPDATE zamowienie SET komentarz='$tresc' WHERE id = $id";
                        // wykonanie dodawania do bazy
                        $wynik = $mysqli->query($zmien);
        unset($tresc);
    }
    
}
?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Administracja - NOVAHURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->

</head>

<body>
    <?php
    include('head.php');
    ?>
 

        
        
        
        <div class="tytul">Szczegóły: <?php echo $produkt['sygnatura'];?></div><a name="start"></a>
        <div style="clear:both"></div>
        
         <div style="clear:both"></div>
        <div id="content_szczegoly">
        <table>
            <tr>
                
                <td>ID:</td> <td><?php  echo $produkt['id']; ?></td>
            </tr>
            <tr>
                <td>Dane kontrahenta:</td> <td><?php  echo $produkt['dane_klienta']; ?></td>
            </tr>
            <tr>   
               <td>Produkt:</td> <td><?php  echo $produkt['produkt_sztuk']; ?></td>
            </tr>
            <tr>   
               <td>Cena:</td> <td><?php  echo $produkt['produkt_cena']; ?></td>
            </tr>
            <tr>   
               <td>Przesyłka:</td> <td><?php  echo $produkt['przesylka']; ?></td>
            </tr>
            <tr>  
               <td>Koszt presyłki:</td> <td><?php  echo $produkt['przesylka_cena']; ?></td>
            </tr>
            <tr>   
               <td>Rodzaj płatności:</td> <td><?php  echo $produkt['platnosc']; ?></td>
            </tr>
            <tr>   
               <td>Data:</td> <td><?php  echo $produkt['czas']; ?></td>
            </tr>
            <tr>   
                <td>Dodatkowe informacje:</td> <td><?php echo $produkt['dodatkowe']; ?></td>
            </tr>
            <tr>   
               <td>Dokument zakupu:</td> <td><?php  echo $produkt['dokument']; ?></td>
            </tr>
            <tr>   
               <td>Do zapłaty:</td> <td><?php  
                $suma_zakupow = $produkt['produkt_cena'] + $produkt['przesylka_cena'];
                echo $suma_zakupow; ?> zł</td>
            </tr>
            <tr>   
               <td>Status:</td> <td><?php  echo $produkt['status']; ?></td>
            </tr>
            <tr>   
               <td>Komentarze:</td> <td>
                <?php  echo $produkt['komentarz']; ?>
                <form method="post">
                <textarea class="formularz_2" type="text" name="komentarz_tresc"><?php  echo $data; ?> - </textarea>
                <br>
                <input type="submit" value="Dodaj" name="dodaj_komentarz"/>
                </form>
                </td>
            </tr>
            <tr>   
               <td>Anuluj zamówienie:</td><td>
                <?php 
                echo '<a href = "edit/delete_order.php?id=' . $produkt['id'] . '">';
                echo 'Anuluj';    
                echo '</a>';  ?></td>
            </tr> 
        </table>
         </div>  
        <a href = "zamowienia_detal.php#start"><div id="powrot">Powrót do listy transakcji</div></a>  
                
               
          
 
        
        
            
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>


</html>