<?php
session_start();
$art_id = $_SESSION['article_id'];
include('db_connect.php');
if(isset($_FILES['file']))
{
    $error = false;
        for($i=0;$i<count($_FILES['file']['size']);$i++)
        {
             //pobieranie unikalnego id zdjecia
             $rezultat = $mysqli->query("SELECT * FROM image_id");
             while ($produkt=mysqli_fetch_array($rezultat) )
             {
               $img_id = $produkt['image_id'];
             }
             //pobranie rozszerzenia
             $nazwa = $_FILES['file']['name'][$i];
             $rozszerzenie = end(explode(".", $nazwa));
             if($rozszerzenie != 'jpg' && $rozszerzenie != 'png' && $rozszerzenie != 'jpeg' && $rozszerzenie != 'gif')
                {
                    $error = true;
                    $_SESSION['error'] = '<div class="error-info">Plik który chcesz dodać nie jest obrazem.</div>';
                }
            if($error == false)
            {
                 unset($_SESSION['error']);
                 $rozszerzenie = '.'.$rozszerzenie;
                 $file = '../../products_img/'.$img_id.$rozszerzenie;
                 //przenoszenie pliku do folderu
                 move_uploaded_file($_FILES['file']['tmp_name'][$i],$file);
                 //zwiększenie w bazie id zdjec
                 $licznik = "UPDATE image_id SET image_id = image_id+1 WHERE id = 1";
                 // wykonanie dodawania do bazy
                 $licze = $mysqli->query($licznik);
                 //dodawanie do bazy informacji o zdjeciach i kolejnosci
                 $nazwa_pliku = $img_id.$rozszerzenie;
                 $place = $i + 1;
                 $dodawanie_obrazu = "insert into images (id, image_src, article_id, place) values ('', '$nazwa_pliku', '$art_id', $place)";
                 // wykonanie dodawania do bazy
                 $wynik_dodawania = $mysqli->query($dodawanie_obrazu);
            }
        } 
}
if(isset($_SESSION['error']))
{
    echo $_SESSION['error'];  
}
?> 