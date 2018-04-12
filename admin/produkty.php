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
    $liczenie = $mysqli->query("SELECT * FROM produkty");
                
                    $liczba_wierszy = mysqli_num_rows($liczenie);
    ?>
 

        
        
        
        <div class="tytul">Produkty<?php echo' (' .$liczba_wierszy. ')'; ?> </div><a name="start"></a>
        <?php    
                if (isset($_SESSION['udana_edycja']))
                    {
                    echo $_SESSION['udana_edycja'];
                    unset($_SESSION['udana_edycja']);
                    }
                    
                    if (isset($_SESSION['usuniete']))
                    {
                    echo $_SESSION['usuniete'];
                    unset($_SESSION['usuniete']);
                    }
    
       ?>     
            <form method="post">
        <div id="produkty_lista">     
             <table border="1">
                <tr>
                    <td>ID</td>  <td>Obraz</td>	<td>Nazwa</td> <td>Cena detal</td>    <td>Cena hurt</td>   <td>Przesyłka</td><td>Wyświetleń</td><td>Kupiono</td>    <td>Widoczny?</td><td>Edycja</td>
                </tr>
                <?php
                 
                 
                 
            $rezultat = $mysqli->query("SELECT * FROM produkty");
                 
                
                while ($produkt=mysqli_fetch_array($rezultat) )
                {
                  $model = $produkt['model'];  
                $kupione = $mysqli->query("SELECT * FROM zamowienie WHERE produkt_sztuk LIKE '%$model%'");
                $liczba_kupionych = mysqli_num_rows($kupione);
                    
               echo '<tr>';
               echo '<td>' . $produkt['id'] . '</td>';
               echo '<td><img src="' . $produkt['obraz'] . '" width="" height="70" align="center"/></td>';
                if($produkt['wyswietlac'] == 'Nie')
                {
                   echo '<td><a style="color: red;" href = "../produkt/przedmiot.php?id=' . $produkt['id'] . '#start" target="_blank" title="Otwórz kartę produktu">' . $produkt['model'] . '</a></td>'; 
                }
                    else
                    {
                       echo '<td><a href = "../produkt/przedmiot.php?id=' . $produkt['id'] . '#start" target="_blank" title="Otwórz kartę produktu">' . $produkt['model'] . '</a></td>'; 
                    }
               
               echo '<td>' . $produkt['cena'] . ' zł</td>';
               echo '<td>' . $produkt['cena_pkh'] . ' zł</td>';
               echo '<td>' . $produkt['dostawa_od'] . ' / ' . $produkt['dostawa_pobranie'] . ' / ' . $produkt['ubezpieczenie'] .'</td>';
               echo '<td>' . $produkt['wyswietlen'] . '</td>';
               echo '<td>' . $liczba_kupionych . '</td>';
                if($produkt['wyswietlac'] == 'Nie')
                {
                   echo '<td style="color: red;">' . $produkt['wyswietlac'] . '</td>';
                }
                    else
                    {
                       echo '<td>' . $produkt['wyswietlac'] . '</td>';
                    }
               
               echo '<td><a href = "edytuj_produkt.php?id=' . $produkt['id'] . '" title="Edytuj">';
               echo 'Edytuj';    
               echo '</a>';
               echo '</td>';
               echo '</tr>';
                
            
                }
            ?>
            </table>
        </div>      
                <div style="clear:both"></div>
             
        
        
        
     
       
            
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>


</html>