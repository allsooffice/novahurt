<!DOCTYPE HTML>

<?php
session_start();
if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php#start');  
}

include('../db_connect.php');


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
    $liczenie = $mysqli->query("SELECT * FROM zamowienie WHERE rodzaj = 'hurt'");
                
                    $liczba_wierszy = mysqli_num_rows($liczenie);
    ?>
 

        
        
        
        <div class="tytul">Transakcje Hurtowe<?php echo' (' .$liczba_wierszy. ')'; ?> </div><a name="start"></a>
            
            
            <div id="transakcje_hurtowe_lista">
            <table border="1">
                <tr>
                    <td>ID</td>  <td>Dane kontahenta</td>	<td>Zakupy</td> <td>Cena zakupów</td>    <td>Przesyłka</td>   <td>Sposób płatności</td> <td>Czas zamówienia</td>    <td>Dodatkowe informacje</td> <td>Dokument zakupu</td>    <td>Sygnatura</td>  <td>Status</td>
                </tr>
            
            
                <?php
            $rezultat = $mysqli->query("SELECT * FROM zamowienie WHERE rodzaj = 'hurt'");
                
                while ($produkt=mysqli_fetch_array($rezultat) ){
                
                    if ($produkt['status'] == 'nowe')
                {
                    $_SESSION['weryfikacja'] = 1;
                }
                

             echo '<tr>';
                echo '<td>';
                echo $produkt['id'];
                echo '</td>';
                echo '<td>';
                echo '<a href = "zamowienie_hurtowe.php?id=' . $produkt['id'] . '">' .substr($produkt['dane_klienta'], 0, 24).'</a>';
                echo '</td>';
                echo '<td>';
                echo $produkt['produkt_sztuk'];
                echo '</td>';
                echo '<td>';
                echo $produkt['produkt_cena'];
                echo '</td>';
                echo '<td>';
                echo $produkt['przesylka'];
                echo '</td>';
                echo '<td>';
                echo $produkt['platnosc'];
                echo '</td>';
                echo '<td>';
                echo $produkt['czas'];
                echo '</td>';
                echo '<td>';
                echo $produkt['dodatkowe'];
                echo '</td>';
                echo '<td>';
                echo $produkt['dokument'];
                echo '</td>';
                echo '<td>';
                echo $produkt['sygnatura'];
                echo '</td>';
                echo '<td>';
                if (@$_SESSION['weryfikacja'] == 1)
                {
                    echo '<a href = "edit/status_zamowienie.php?id='. $produkt['id'] .'">' .$produkt['status']. '</a>';
                }
                    else
                    {
                        echo '<div id="zielony">Przyjęte</div>';
                    }
                
                echo '</td>';
                echo '</tr>';
                echo '<div style="clear:both"></div>';
                unset ($_SESSION['weryfikacja']);
            
                }
            
                
  
                
            ?>
                </table>
    </div>
                
             
        
        
        
     
       
            
        
        
        
        
  
    <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    
    


</body>


</html>