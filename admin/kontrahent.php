<!DOCTYPE HTML>

<?php
session_start();

if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php#start');  
}

include('../db_connect.php');



if (isset($_GET['id']))
{
    $id= $_GET['id'];
     $rezultat = $mysqli->query("SELECT * FROM kontrahenci WHERE id = $id");
$produkt=mysqli_fetch_array($rezultat);
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
 

        
        
        
        <div class="tytul">Szczegóły: <?php echo $produkt['nazwa_firmy'];?></div><a name="start"></a>
        <div style="clear:both"></div>
        
         <div style="clear:both"></div>
        <div id="content_szczegoly">
        <table>
            <tr>
                
                <td>ID:</td> <td><?php  echo $produkt['id']; ?></td>
            </tr>
            <tr>
                <td>Nazwa firmy:</td> <td><?php  echo $produkt['nazwa_firmy']; ?></td>
            </tr>
            <tr>   
               <td>Nip:</td> <td><?php  echo $produkt['nip']; ?></td>
            </tr>
            <tr>   
               <td>Ulica:</td> <td><?php  echo $produkt['ulica']; ?></td>
            </tr>
            <tr>   
               <td>Nr budynku:</td> <td><?php  echo $produkt['nr_budynku']; ?></td>
            </tr>
            <tr>  
               <td>Nr lokalu:</td> <td><?php  echo $produkt['nr_lokalu']; ?></td>
            </tr>
            <tr>   
               <td>Kod pocztowy:</td> <td><?php  echo $produkt['kod_pocztowy']; ?></td>
            </tr>
            <tr>   
               <td>Miejscowość:</td> <td><?php  echo $produkt['miejscowosc']; ?></td>
            </tr>
            <tr>   
                <td>Email:</td> <td><a href="mailto:<?php echo $produkt['email']; ?>"><?php echo $produkt['email']; ?></a></td>
            </tr>
            <tr>   
               <td>Telefon:</td> <td><?php  echo $produkt['tel']; ?></td>
            </tr>
            <tr>   
               <td>Newsletter:</td> <td><?php  echo $produkt['newsletter']; ?></td>
            </tr>
            <tr>   
               <td>Status:</td> <td><?php  echo $produkt['status']; ?></td>
            </tr>
            <tr>   
               <td>Usuń kontrahenta</td><td>
                <?php 
                echo '<a href = "edit/delete.php?id=' . $produkt['id'] . '">';
                echo 'Usuń';    
                echo '</a>';  ?></td>
            </tr> 
        </table>
         </div>  
        <a href = "kontrahenci.php#start"><div id="powrot">Powrót do listy kontrahentów</div></a>  
                
               
          
 
        
        
            
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>


</html>