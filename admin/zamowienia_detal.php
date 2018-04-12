<!DOCTYPE HTML>

<?php
session_start();
if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php#start');  
}

include('../db_connect.php');

include('head.php');
if (isset($_POST['search']))
{
    $szukana = $_POST['search'];
  $liczenie = $mysqli->query("SELECT * FROM zamowienie WHERE dane_klienta LIKE '%$szukana%' OR sygnatura LIKE '%$szukana%' AND rodzaj = 'detal'");
                
                    $liczba_wierszy = mysqli_num_rows($liczenie); 
    unset($szukana);
    unset($rezultat);
}
   else
   {
    $liczenie = $mysqli->query("SELECT * FROM zamowienie WHERE rodzaj = 'detal'");
                
                    $liczba_wierszy = mysqli_num_rows($liczenie);
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

        <div class="tytul">Zamówienia detaliczne<?php echo' (' .$liczba_wierszy. ')'; ?> </div><a name="start"></a>
    
        <div id= "wyszukiwarka">
            <form method="post">
             Szukaj: <br>
                <input id="search_input" type="text" name="search" placeholder="Imię, nazwisko lub sygnatura"/>
             <input type="submit" value="Szukaj" />
             <input type="submit" value="Wszystkie" name="reset"/>
            </form>
        </div>
    
    
            
            
            <form method="post">
            
            <div id= "list_contener">
                
                <div id= "transakcje_hurtowe_lista">
                
                <table border="1">
                <tr>
                    <td>ID</td>
                    <td>Dane klienta</td>	<td>Produkt</td> <td>Cena zakupów</td>    <td>Przesyłka</td>   <td>Sposób płatności</td> <td>Data zamówienia</td>    <td>Dodatkowe indormacje</td> <td>Dokument zakupu</td> <td>Sygnatura</td>  <td>Status</td>
                </tr>
                
                
                <?php
                    
            if (isset($_POST['search']))
            {
                $szukana = $_POST['search'];
              $rezultat = $mysqli->query("SELECT * FROM zamowienie WHERE dane_klienta LIKE '%$szukana%' OR sygnatura LIKE '%$szukana%' AND rodzaj = 'detal' ORDER BY id DESC");

                unset($szukana);
                
            }
               else 
               {
                    
            $rezultat = $mysqli->query("SELECT * FROM zamowienie WHERE rodzaj = 'detal' ORDER BY id DESC");
               }
                while ($produkt=mysqli_fetch_array($rezultat) ){
                
                    if ($produkt['status'] == 'nowe')
                {
                    $_SESSION['weryfikacja'] = 1;
                }
                
                    if (strlen($produkt['dodatkowe']) == 0)
                {
                    $dodatkowe_informacje = 'brak';
                }
                    
                    if (strlen($produkt['dodatkowe']) > 0)
                {
                    $dodatkowe_informacje = '<a href = "zamowienie_hurtowe.php?id=' . $produkt['id'] . '" target="_blank" >zobacz szczegóły</a>';
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
                echo $dodatkowe_informacje;
                echo '</a>';
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
                    echo '<a href="edit/status_zamowienie_detal.php?id='. $produkt['id'] .'">' .$produkt['status']. '</a>';
                }
                    else
                    {
                        echo '<div id="zielony">Przyjęte</div>';
                    }
                
                echo '</td>';
                echo '<div style="clear:both"></div>';
                
                echo '</tr>';
                unset ($_SESSION['weryfikacja']);
                }
                echo '</table>'
                
                
  
                
            ?>
                </table> 
                </div>
                </div> 
             
        
        
        
     
       
            
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    
    
    
    


</body>


</html>