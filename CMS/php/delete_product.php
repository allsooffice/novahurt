<?php
include('db_connect.php');
$id = $_GET['id'];

    $usuwanie = "DELETE FROM produkty WHERE id = '$id'";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);
//usuwanie zdjęć
    $rezultat = $mysqli->query("SELECT * FROM images WHERE article_id = '$id' ");
                
    while ($produkt=mysqli_fetch_array($rezultat) ){
						$file = $produkt['image_src'];
						$katalog = "../../products_img/";
						if (file_exists($katalog.$file)) 
						unlink($katalog.$file);
                } 
    
    $usuwanie = "DELETE FROM images WHERE article_id = $id";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);                           

?>