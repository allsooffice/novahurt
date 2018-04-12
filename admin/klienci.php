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
    $liczenie = $mysqli->query("SELECT * FROM klienci");
                
                    $liczba_wierszy = mysqli_num_rows($liczenie);
    ?>
    <div id= "wyszukiwarka">
    <form method="post">
     Szukaj: <br>
        <input id="search_input" type="text" name="search" placeholder="Imię, nazwisko lub sygnatura"/>
     <input type="submit" value="Szukaj" />
    </form>
    </div>   
        
        
        <div class="tytul">Klienci<?php echo' (' .$liczba_wierszy. ')'; ?> </div><a name="start"></a>
            
            
            <form method="post">
            
            <div id= "list_contener">
            <div id= "transakcje_hurtowe_lista">
                
                <table border="1">
                <tr>
                    <td>ID</td>  <td>Imię</td>	<td>Nazwisko</td> <td>Ulica</td>    <td>Nr budynku</td>   <td>Nr lokalu</td> <td>Kod pocztowy</td>    <td>Miejscowość</td> <td>Email</td> <td>Telefon</td>  <td>Newsletter</td>
                </tr>
                
                
                <?php
            $rezultat = $mysqli->query("SELECT * FROM klienci");
                
                while ($produkt=mysqli_fetch_array($rezultat) ){
                    
                

    
                echo '<tr>';
                echo '<td>';
                echo $produkt['id'];
                echo '</td>';
                echo '<td>';
                echo '<a href = "klient.php?id=' . $produkt['id'] . '">' .$produkt['imie'].'</a>';
                echo '</td>';
                echo '<td>';
                echo $produkt['nazwisko'];
                echo '</td>';
                echo '<td>';
                echo $produkt['ulica'];
                echo '</td>';
                echo '<td>';
                echo $produkt['nr_budynku'];
                echo '</td>';
                echo '<td>';
                echo $produkt['nr_mieszkania'];
                echo '</td>';
                echo '<td>';
                echo $produkt['kod_pocztowy'];
                echo '</td>';
                echo '<td>';
                echo $produkt['miejscowosc'];
                echo '</td>';
                echo '<td>';
                echo $produkt['email'];
                echo '</td>';
                echo '<td>';
                echo $produkt['telefon'];
                echo '</td>';
                echo '<td>';
                echo $produkt['newsletter'];
                echo '</td>';
                echo '</tr>';
                
            
                }
            
                
            ?>
             </table>  
                </div>
                <div style="clear:both"></div>
             
        
        
        
     
       
            
        
        </div> 
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    
    
    
    


</body>


</html>