<?php
session_start();
include('db_connect.php');

if (isset($_GET['id']))
{
    $img_id = $_GET['id'];
    
    $rezultat = $mysqli->query("SELECT * FROM images WHERE id = '$img_id' ");
                
    while ($produkt=mysqli_fetch_array($rezultat) ){
                    $nazwa_obrazu = $produkt['image_src'];
                } 
    
    $usuwanie = "DELETE FROM images WHERE id = $img_id";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);
    // liczenie dodanych zdjec - usowanie
                           
    $file= $nazwa_obrazu;
    $katalog = "../../products_img/";
if (file_exists($katalog.$file)) 
  unlink($katalog.$file);
              
}

?>