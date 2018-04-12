<?php
include('../../db_connect.php');

if(isset($_GET['fraza']))
{
$fraza = $_GET['fraza'];
$pobieranie = $mysqli->query("SELECT * FROM produkty WHERE model LIKE '$fraza%' LIMIT 4");
    $liczba_hasel = mysqli_num_rows($pobieranie);

    if($liczba_hasel > 0)
    {
        
while ($produkt=mysqli_fetch_array($pobieranie) ){
    $slowo = $produkt['model'];
    $licze = $mysqli->query("SELECT * FROM produkty WHERE model LIKE '%$slowo%'");
    $liczba_wierszy = mysqli_num_rows($licze);
            if($liczba_wierszy > 0)
            {
            echo '<ol>';
            echo '<li onclick="mode('.$produkt['id'].')">'.$produkt['model'].'</li>';
            echo '</ol>'; 
            }
            
           }
        
    }
    
   
}

if(isset($_GET['id']))
{
$id = $_GET['id'];

    $pobieranie = $mysqli->query("SELECT * FROM produkty WHERE id = '$id'");
    while ($produkt=mysqli_fetch_array($pobieranie) ){
    
            echo '<input onkeyup="listen()" type="text" id="model" placeholder="Model" class="zam_input" autocomplete="off" style="width: 280px;" value="'.$produkt['model'].'"/> <div class="clear" onclick="pusty()">clear</div>';
           
    }
    }

if(isset($_GET['id_cena']))
{
$id = $_GET['id_cena'];

    $pobieranie = $mysqli->query("SELECT * FROM produkty WHERE id = '$id'");
    while ($produkt=mysqli_fetch_array($pobieranie) ){
    
            echo '<input type="text" id="cena" placeholder="Cena za produkty" class="zam_input" autocomplete="off" value="'.$produkt['cena'].'" style="width: 185px;"/> zł
            <input type="hidden" id="cena_sztuka" value="'.$produkt['cena'].'">
            ';
           
    }
    }

if(isset($_GET['przelew']))
{
$id = $_GET['przelew'];

    $pobieranie = $mysqli->query("SELECT * FROM produkty WHERE id = '$id'");
    while ($produkt=mysqli_fetch_array($pobieranie) ){
    
            echo '<input type="text" id="przelew-baza" value="'.$produkt['dostawa_od'].'"/>';
           
    }
    }

if(isset($_GET['pobranie']))
{
$id = $_GET['pobranie'];

    $pobieranie = $mysqli->query("SELECT * FROM produkty WHERE id = '$id'");
    while ($produkt=mysqli_fetch_array($pobieranie) ){
    
            echo '<input type="text" id="pobranie-baza" value="'.$produkt['dostawa_pobranie'].'"/>';
           
    }
    }

if(isset($_GET['max']))
{
$id = $_GET['max'];

    $pobieranie = $mysqli->query("SELECT * FROM produkty WHERE id = '$id'");
    while ($produkt=mysqli_fetch_array($pobieranie) ){
    
            echo '<input type="text" id="max-baza" value="'.$produkt['sztuk_w_paczce'].'"/>';
           
    }
    }

if(isset($_GET['kolejna']))
{
$id = $_GET['kolejna'];

    $pobieranie = $mysqli->query("SELECT * FROM produkty WHERE id = '$id'");
    while ($produkt=mysqli_fetch_array($pobieranie) ){
    
            echo '<input type="text" id="kolejna-baza" value="'.$produkt['kolejna_sztuka'].'"/>';
           
    }
    }
    
   


?>