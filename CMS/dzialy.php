<!DOCTYPE HTML>
<?php
session_start();
$data = date("Y-m-d H:i:s");
$_SESSION['user_session_id'] = session_id();
if($_SESSION['zalogowany'] != true)
{
   header('Location: index.php');
}
else
{
include('php/db_connect.php');
   if(isset($_GET['choosen']))
   {
      if($_GET['choosen'] == 'meble_biurowe')
      {
         $dzial = 'Meble biurowe';
      }
      
      if($_GET['choosen'] == 'agd')
      {
         $dzial = 'AGD';
      }
      
      if($_GET['choosen'] == 'stoly_krzesla')
      {
         $dzial = 'Stoły / Krzesła';
      }
      
      if($_GET['choosen'] == 'dzieciece')
      {
         $dzial = 'Artykuły dziecięce';
      }
   }
   else
   {
      $dzial = 'Meble biurowe';
   }
}


?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Działy - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link href="style/uploading_img.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style/loading.css"/>
	<link href="fontello/css/fontello.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>

<body>
  <?php
            include('parts/log_out.php');
      ?>
   <div class="box">
       <div class="popup">
           <h1>Zmiany zostały zapisane</h1>
           <ul>
               <li>Lista prduktów</li>
               <li id="close">Zamknij</li>
           </ul>
       </div>
   </div>
    <div class="wrapper">
       
        <div class="menu">
          
           <h2><i class="icon-menu"></i> Menu</h2>
           <?php
            include('parts/menu.php');
            ?>
            
        </div>
        <div class="content">
                     <ol class="filters">
              <div class="filters-front">Filtry</div>
               <li>Kategoria:
                  <form method="GET" id="category-form">
                   <select id="category" class="selected-order" name="choosen">
                       <option value="meble_biurowe"><?php echo $dzial; ?></option>
                       <option value="meble_biurowe">Meble biurowe</option>
                       <option value="agd">AGD</option>
                       <option value="stoly_krzesla">Stoły Krzesła</option>
                       <option value="dzieciece">Artykuły Dziecięce</option>
                   </select>
                  </form>
               </li>
            </ol>
            <h1>Lista produktów:</h1>
            <form method="post" action="php/replace_category.php">
            <ul class="table">
               <?php
            $i = 1;
            $pobieranie = $mysqli->query("SELECT * FROM produkty WHERE wyswietlac <> 'archiwum' AND dzial = '$dzial' ORDER BY category_place");
            while ($produkt=mysqli_fetch_array($pobieranie) )
            {
             $id = $produkt['id'];
            $pobieranie_obrazu = $mysqli->query("SELECT * FROM images WHERE article_id = '$id' AND place = '1' LIMIT 1");
            while ($obraz=mysqli_fetch_array($pobieranie_obrazu) )
            {
                $obrazek = $obraz['image_src'];
            }
                
                if($i % 2 == 0)
                {
                   echo '
                <li class="row-first">
                    <input type="hidden" name="element[]" value="'.$produkt['id'].'" />
                    <div class="column-img" style="background-image: url(../products_img/'.$obrazek.');"></div>
                    <div class="column-name">'.$produkt['model'].'</div>
                    <div class="column-status">Wyświetlać: '.$produkt['wyswietlac'].'</div>
                    <div class="column-price">Cena detal:<br> '.$produkt['cena'].' zł</div>
                    <div class="column-price">Cena hurt:<br> '.$produkt['cena_pkh'].' zł</div>
                    <div class="column-price">Przesyłka przelew:<br> '.$produkt['dostawa_od'].' zł</div>
                    <div class="column-price">Przesyłka pobranie:<br> '.$produkt['dostawa_pobranie'].' zł</div>
                    <div class="column-price">Ubezpieczenie:<br> '.$produkt['ubezpieczenie'].' zł</div>
                    <div class="column-price">Wyświetleń:<br> '.$produkt['wyswietlen'].'</div>
                    <div class="column-price">Sprzedano:<br> o</div>
                    <div class="column-edit"><a href="edycja_produktu.php?id='.$produkt['id'].'">Edycja</a></div>
                    <div style="clear: both;"></div>
                </li>';
                }
                else
                {
                    echo '
                <li class="row-second">
                    <input type="hidden" name="element[]" value="'.$produkt['id'].'" />
                    <div class="column-img" style="background-image: url(../products_img/'.$obrazek.');"></div>
                    <div class="column-name">'.$produkt['model'].'</div>
                    <div class="column-status">Wyświetlać: '.$produkt['wyswietlac'].'</div>
                    <div class="column-price">Cena detal:<br> '.$produkt['cena'].' zł</div>
                    <div class="column-price">Cena hurt:<br> '.$produkt['cena_pkh'].' zł</div>
                    <div class="column-price">Przesyłka przelew:<br> '.$produkt['dostawa_od'].' zł</div>
                    <div class="column-price">Przesyłka pobranie:<br> '.$produkt['dostawa_pobranie'].' zł</div>
                    <div class="column-price">Ubezpieczenie:<br> '.$produkt['ubezpieczenie'].' zł</div>
                    <div class="column-price">Wyświetleń:<br> '.$produkt['wyswietlen'].'</div>
                    <div class="column-price">Sprzedano:<br> o</div>
                    <div class="column-edit"><a href="edycja_produktu.php?id='.$produkt['id'].'">Edycja</a></div>
                    <div style="clear: both;"></div>
                </li>';
                }
                $i++;
            }
            
            ?>
                
            </ul>
            </form>
        </div>
        
        <div style="clear: both;"></div>
        

        
    </div>
</body>
<script src="js/menu.js"></script>
<script src="js/category-list.js"></script>
<script>
		$("#cat-article").parent().addClass("menu-active");
		$("#cat-article").addClass("active-color");
</script>
</html>