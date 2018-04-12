<!DOCTYPE HTML>
<?php
session_start();
if($_SESSION['zalogowany'] != true)
{
   header('Location: index.php');
}
else
{
$data = date("Y-m-d H:i:s");
$_SESSION['user_session_id'] = session_id();
include('php/db_connect.php');
//usuwanie pustych ogloszen
if(isset($_GET['id']))
$art_id = $_GET['id'];
$pobieranie = $mysqli->query("SELECT * FROM produkty WHERE id = '$art_id'");
while ($produkt=mysqli_fetch_array($pobieranie) )
{
  $model = $produkt['model'];
  $detal = $produkt['cena'];
  $hurt = $produkt['cena_pkh'];
  $przelew = $produkt['dostawa_od'];
  $pobranie = $produkt['dostawa_pobranie'];
  $ubezpieczenie = $produkt['ubezpieczenie'];
  $max = $produkt['sztuk_w_paczce'];
  $karton = $produkt['wymiary_kartonu'];
  $waga = $produkt['waga'];
  $kolor = $produkt['kolor'];
  $material = $produkt['material'];
  $dzial = $produkt['dzial'];
  $producent = $produkt['producent'];
  $opis_1 = $produkt['opis_1'];
  $opis_2 = $produkt['opis_2'];
  $opis_3 = $produkt['opis_3'];
  $cecha_1 = $produkt['cecha_1'];
  $cecha_2 = $produkt['cecha_2'];
  $cecha_3 = $produkt['cecha_3'];
  $cecha_4 = $produkt['cecha_4'];
  $cecha_5 = $produkt['cecha_5'];
  $cecha_6 = $produkt['cecha_6'];
  $cecha_7 = $produkt['cecha_7'];
  $cecha_8 = $produkt['cecha_8'];
  $cecha_9 = $produkt['cecha_9'];
  $cecha_10 = $produkt['cecha_10'];
  $cecha_11 = $produkt['cecha_11'];
  $brak = $produkt['brak'];
  $wyswietlac = $produkt['wyswietlac'];
  $next = $produkt['kolejna_sztuka'];
  $cena_zakupu = $produkt['cena_zakupu'];
  $crossed_price = $produkt['crossed_price'];
}
	
//dodawanie id nowego ogloszenia
$dodawanie = "insert into produkty (id, model, dzial, gabaryt, opis_1, opis_2, opis_3, kolor, producent, cena, cena_pkh, dostawa_od, dostawa_pobranie, ubezpieczenie, obraz, obraz_2, obraz_3, obraz_4, material, waga, wymiary_kartonu, cecha_1, cecha_2, cecha_3, cecha_4, cecha_5, cecha_6, cecha_7, cecha_8, cecha_9, cecha_10, cecha_11, wymiary_obraz, sztuk_w_paczce, galeria, brak, wyswietlac) values ('', '$data', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Archiwum')";
// wykonanie dodawania do bazy
$wynik = $mysqli->query($dodawanie);
//pobranie id igloszenia
$pobieranie = $mysqli->query("SELECT id FROM produkty WHERE model = '$data' LIMIT 1");
while ($produkt=mysqli_fetch_array($pobieranie) )
{
  $art_id = $produkt['id'];
}
$_SESSION['article_id'] = $art_id;
	
	
}
?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link href="style/uploading_img.css" rel="stylesheet" type="text/css" />
	<link href="style/add_adv.css" rel="stylesheet" type="text/css" />
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
               <li><a href="lista_produktow.php">Lista prduktów</a></li>
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
                <div class="info1"></div> 
                <div class="info2"></div>
            <h1>Edycja produktu: <?php echo $model ?></h1>
                <div class="info">

                </div>
                <div class="image-place">
                 
                </div>
            <input type="hidden" id="art_id" value="<?php echo $art_id; ?>"/>
            <form id="add-image-form" method="post" action="php/upload_img.php" enctype="multipart/form-data">
                    <input type="file" id="add-image" name="file[]" multiple >
                    <label class="add-image-label" for="add-image"><i class="icon-picture-1"></i>Dodaj obraz</label>
            </form>
            <div style="clear: both;"></div>
            <div class="form">
            <hr>
            <h3>Nazwa :</h3> <input type="text" id="product" class="text-input" value="<?php echo $model ?>"/>
            <hr>
            <h3>Cena :</h3><span class="span-align">Detal: <input type="text" id="detal" class="text-input-short" value="<?php echo $detal ?>"/> zł</span>
            Hurt:<input type="text" id="hurt" class="text-input-short" value="<?php echo $hurt ?>"/> zł
            <hr>
            <h3>Cena dostawy :</h3><span class="span-align" style="margin-right: 22%;">Z góry: <input type="text" id="przelew" class="text-input-short" value="<?php echo $przelew ?>"/> zł</span>
            Pobranie:<input type="text" id="pobranie" class="text-input-short" value="<?php echo $pobranie ?>"/> zł
            <hr>
            <h3>Przekreślona cena :</h3><span class="span-align" style="margin-right: 22%;"><input type="text" id="crossed" class="text-input-short" value="<?php echo $crossed_price ?>"/> zł</span>
            <hr>
            <h3>Ubezpieczenie :</h3><span class="span-align" style="margin-right: 22%;"><input type="text" id="ubezpieczenie" class="text-input-short" value="<?php echo $ubezpieczenie ?>"/> zł</span>
            <hr>
            <h3>Sztuk w paczce :</h3><span class="span-align" style="margin-right: 22%;"><input type="number" id="max" class="text-input-short" value="<?php echo $max ?>"/></span>
            <hr>
            <div class="next-item" <?php if($next == "0") echo 'style="display: none;"' ?> >
             <h3>Kolejna sztuka :</h3><span class="span-align" style="margin-right: 22%;"><input type="text" id="next" class="text-input-short" value="<?php echo $next ?>"/></span>
             <hr>
            </div>
            
            <h3>Wymiary kartonu :</h3><input type="text" id="karton" class="text-input-short" value="<?php echo $karton ?>"/> cm
            <h3>Waga :</h3><input type="text" id="waga" class="text-input-short" value="<?php echo $waga ?>"/> kg
            <h3>Kolor :</h3> <input type="text" id="kolor" class="text-input" value="<?php echo $kolor ?>"/>
            <h3>Materiał :</h3> <input type="text" id="material" class="text-input" value="<?php echo $material ?>"/>
            <hr>
            <h3>Dział :</h3>
              <label><input type="radio" name="cat" id="dzial" value="Artykuły dziecięce" <?php if($dzial == 'Artykuły dziecięce') echo 'checked';?>></inpu> Artykuły dziecięce</label>
              <label><input type="radio" name="cat" id="dzial" value="Meble biurowe" <?php if($dzial == 'Meble biurowe') echo 'checked';?>> Meble biurowe</label>
              <label><input type="radio" name="cat" id="dzial" value="Stoły" <?php if($dzial == 'Stoły') echo 'checked';?>> Stoły</label>
            <label><input type="radio" name="cat" id="dzial" value="Krzesła" <?php if($dzial == 'Krzesła') echo 'checked';?>>Krzesła</label>
              <label><input type="radio" name="cat" id="dzial" value="AGD" <?php if($dzial == 'AGD') echo 'checked';?>> AGD</label>
              <hr>
            <h3>Producent :</h3>
              <label><input id="producent" type="radio" name="gender" value="Lugano" <?php if($producent == 'Lugano') echo 'checked';?>> Lugano</label>
              <label><input id="producent" type="radio" name="gender" value="Bebico" <?php if($producent == 'Bebico') echo 'checked';?>> Bebico</label>
              <label><input id="producent" type="radio" name="gender" value="Hilden" <?php if($producent == 'Hilden') echo 'checked';?>> Hilden</label>
              <hr>
            <h3>Opis krótki :
            #1
            </h3> <input type="text" id="short1" class="text-input" value="<?php echo $opis_1 ?>"/>
            <h3>Opis krótki :
            #2
            </h3> <input type="text" id="short2" class="text-input" value="<?php echo $opis_2 ?>"/>
            <h3>Opis krótki :
            #3
            </h3> <input type="text" id="short3" class="text-input" value="<?php echo $opis_3 ?>"/>
            <hr>
            <h3>Opis szczegółowy :</h3>
            #1
            <textarea id="t1"><?php echo $cecha_1 ?></textarea>
            #2
            <textarea id="t2"><?php echo $cecha_2 ?></textarea>
            #3
            <textarea id="t3"><?php echo $cecha_3 ?></textarea>
            #4
            <textarea id="t4"><?php echo $cecha_4 ?></textarea>
            #5
            <textarea id="t5"><?php echo $cecha_5 ?></textarea>
            #6
            <textarea id="t6"><?php echo $cecha_6 ?></textarea>
            #7
            <textarea id="t7"><?php echo $cecha_7 ?></textarea>
            #8
            <textarea id="t8"><?php echo $cecha_8 ?></textarea>
            #9
            <textarea id="t9"><?php echo $cecha_9 ?></textarea>
            #10
            <textarea id="t10"><?php echo $cecha_10 ?></textarea>
            #11
            <textarea id="t11"><?php echo $cecha_11 ?></textarea>
            <hr>
            <h3>Ważna informacja :</h3> <input type="text" id="important" class="text-input" value="<?php echo $brak ?>"/>
            <hr>
            <h3>Wyświetlać :</h3>
              <label><input id="wiev" type="radio" name="visible" value="Tak" <?php if($wyswietlac == 'Tak') echo 'checked';?>> Tak</label>
              <label><input id="wiev" type="radio" name="visible" value="Super cena!" <?php if($wyswietlac == 'Super cena!') echo 'checked';?>> Super cena!</label>
              <label><input id="wiev" type="radio" name="visible" value="Promocja" <?php if($wyswietlac == 'Promocja') echo 'checked';?>> Promocja</label>
              <label><input id="wiev" type="radio" name="visible" value="Wyprzedaż" <?php if($wyswietlac == 'Wyprzedaż') echo 'checked';?>> Wyprzedaż</label><br>
              <label><input id="wiev" type="radio" name="visible" value="II gatunek" <?php if($wyswietlac == 'II gatunek') echo 'checked';?>> II gatunek</label>
              <label><input id="wiev" type="radio" name="visible" value="Archiwum" <?php if($wyswietlac == 'Archiwum') echo 'checked';?>> Archiwum</label><br>
            
              <div class="error-place">Uzupełnij wymagane pola formularza</div>
              <hr>
              <h3>Cena zakupu :</h3><span class="span-align" style="margin-right: 22%;"><input type="text" id="cena_zakupu" class="text-input-short" value="<?php echo $cena_zakupu ?>"/> zł</span>
              <hr>
              <h3>Usuń produkt :</h3><span class="span-delete-item" style="margin-right: 22%;"><a><i class="icon-trash"></i> Usuń ten produkt</a>
              <div class="delete-confirm">Czy na pewno chcesz usunąć ten produkt?
              	<ol>
              		<li id="delete-true" product="<?php echo $art_id ?>">Tak</li>
              		<li id="delete-false">Nie</li>
              	</ol>
              </div>
              </span>
              <hr>
              <input type="submit" value="Zapisz" class="btn"/>
            </div>
            
        </div>
        
        <div style="clear: both;"></div>
        

        
    </div>
</body>
<script src="js/menu.js"></script>
<script src="js/upload_img.js"></script>
<script src="js/walidation.js"></script>
</html>