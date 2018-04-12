<?php
session_start();
$art_id = $_SESSION['article_id'];
include('db_connect.php');

echo '<form method="post" action="php/replace_img.php">
      <ul id="list">';

    $liczenie = $mysqli->query("SELECT * FROM images WHERE article_id = '$art_id' ORDER BY place");
                    {
                    $liczba_wierszy = mysqli_num_rows($liczenie);
                    $i = 1;
                    }
$pobieranie = $mysqli->query("SELECT * FROM images WHERE article_id = '$art_id' ORDER BY place");
        while ($produkt=mysqli_fetch_array($pobieranie) )
        {
           if($i == '2')
           {
            echo '<li id="img'.$produkt['id'].'" style="border: 2px solid red; box-sizing: border-box;">';
            echo '<input type="hidden" name="element[]" value="'.$produkt['id'].'" />';
            echo '<div class="added-img" style="background-image: url(../products_img/'.$produkt['image_src'].')"><div class="trash-img" onclick="trash('.$produkt['id'].')"><i class="icon-trash"></i></div>
            <div id="load'.$produkt['id'].'" class="UnLoad"></div>'; 
           }
           else
           {
            echo '<li id="img'.$produkt['id'].'">';
            echo '<input type="hidden" name="element[]" value="'.$produkt['id'].'" />';
            echo '<div class="added-img" style="background-image: url(../products_img/'.$produkt['image_src'].')"><div class="trash-img" onclick="trash('.$produkt['id'].')"><i class="icon-trash"></i></div>
            <div id="load'.$produkt['id'].'" class="UnLoad"></div>';
           }

            if($liczba_wierszy == $i && !isset($_SESSION['error']))
            {
               echo '<div id="load'.$produkt['id'].'" class="loading"></div>';  
            }
             echo '</div></li>';
            $i++;
        }
 echo '</ul>';   
 echo '</form>';    
?>




