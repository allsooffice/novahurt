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
    $liczenie = $mysqli->query("SELECT * FROM kontrahenci");
                
                    $liczba_wierszy = mysqli_num_rows($liczenie);
    ?>
 

        
        
        
        <div class="tytul">Kontrahenci<?php echo' (' .$liczba_wierszy. ')'; ?> </div><a name="start"></a>
            
            
            <form method="post">
            
            <div id= "lista_kontrahenci">
                
                <table border="1">
                <tr>
                    <td>ID</td>  <td>Nazwa firmy</td>	<td>Nip</td> <td>ulica</td>    <td>Nr budynku</td>   <td>Nr lokalu</td> <td>Kod pocztowy</td>    <td>Miejscowość</td>    <td>Data rejestracji</td> <td>Telefon</td>  <td>Status</td>
                </tr>
                
                <?php
            $rezultat = $mysqli->query("SELECT * FROM kontrahenci");
                
                while ($produkt=mysqli_fetch_array($rezultat) ){
                    
                if ($produkt['status'] == 'nowy')
                {
                    $_SESSION['weryfikacja'] = 1;
                }

    
                echo '<tr>';
                echo '<td>';
                echo $produkt['id'];
                echo '</td>';
                echo '<td>';
                echo '<a href = "kontrahent.php?id=' . $produkt['id'] . '">' .$produkt['nazwa_firmy'].'</a>';
                echo '</td>';
                echo '<td>';
                echo $produkt['nip'];
                echo '</td>';
                echo '<td>';
                echo $produkt['ulica'];
                echo '</td>';
                echo '<td>';
                echo $produkt['nr_budynku'];
                echo '</td>';
                echo '<td>';
                echo $produkt['nr_lokalu'];
                echo '</td>';
                echo '<td>';
                echo $produkt['kod_pocztowy'];
                echo '</td>';
                echo '<td>';
                echo $produkt['miejscowosc'];
                echo '</td>';
                echo '<td>';
                echo $produkt['data'];
                echo '</td>';
                echo '<td>';
                echo $produkt['tel'];
                echo '</td>';
                echo '<td>';
                if (@$_SESSION['weryfikacja'] == 1)
                {
                    echo '<a href = "edit/status.php?id=' . $produkt['id'] . '" title="kliknij aby zatwierdzić"><div class="red">' .$produkt['status']. '</div></a>';
                }
                    else
                    {
                        echo '<div id="zielony">Zweryfikowano</div>';
                    }
                
                echo '</td>';
                echo '</tr>';
                echo '<div style="clear:both"></div>';
                unset ($_SESSION['weryfikacja']);
            
                }
  
                
            ?>
                </table>   
                <div style="clear:both"></div>
             
        
        
        
     
       
            
        
        
        
        
    </div> 
    <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    


</body>


</html>