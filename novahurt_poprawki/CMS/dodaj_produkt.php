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
           <h1>Produkt dodany</h1>
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
            <h1>Dodaj produkt</h1>
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
            <h3>Nazwa :</h3> <input type="text" id="product" class="text-input" />
            <h3>Cena :</h3><span class="span-align">Detal: <input type="text" id="detal" class="text-input-short"/> zł</span>
            Hurt:<input type="text" id="hurt" class="text-input-short" /> zł
            <h3>Cena dostawy :</h3><span class="span-align" style="margin-right: 22%;">Z góry: <input type="text" id="przelew" class="text-input-short"/> zł</span>
            Pobranie:<input type="text" id="pobranie" class="text-input-short" /> zł
            <h3>Ubezpieczenie :</h3><span class="span-align" style="margin-right: 22%;"><input type="text" id="ubezpieczenie" class="text-input-short"/> zł</span>
            <h3>Sztuk w paczce :</h3><span class="span-align" style="margin-right: 22%;"><input type="number" id="max" class="text-input-short"/></span>
            <div class="next-item" style="display: none;">
             <h3>Kolejna sztuka :</h3><span class="span-align" style="margin-right: 22%;"><input type="text" id="next" class="text-input-short"/></span>   
            </div>
            <h3>Wymiary kartonu :</h3><input type="text" id="karton" class="text-input-short"/> cm
            <h3>Waga :</h3><input type="text" id="waga" class="text-input-short"/> kg
            <h3>Kolor :</h3> <input type="text" id="kolor" class="text-input" />
            <h3>Materiał :</h3> <input type="text" id="material" class="text-input" />
            <h3>Dział :</h3>
              <label><input type="radio" name="cat" id="dzial" value="Artykuły dziecięce"> Artykuły dziecięce</label>
              <label><input type="radio" name="cat" id="dzial" value="Meble biurowe"> Meble biurowe</label>
              <label><input type="radio" name="cat" id="dzial" value="Stoły"> Stoły</label>
              <label><input type="radio" name="cat" id="dzial" value="Krzesła">Krzesła</label>
            <h3>Producent :</h3>
              <label><input id="producent" type="radio" name="gender" value="Lugano"> Lugano</label>
              <label><input id="producent" type="radio" name="gender" value="Bebico"> Bebico</label>
              <label><input id="producent" type="radio" name="gender" value="Hilden"> Hilden</label>
            <h3>Opis krótki :
            #1
            </h3> <input type="text" id="short1" class="text-input" />
            <h3>Opis krótki :
            #2
            </h3> <input type="text" id="short2" class="text-input" />
            <h3>Opis krótki :
            #3
            </h3> <input type="text" id="short3" class="text-input" />
            <h3>Opis szczegółowy :</h3>
            #1
            <textarea id="t1"></textarea>
            #2
            <textarea id="t2"></textarea>
            #3
            <textarea id="t3"></textarea>
            #4
            <textarea id="t4"></textarea>
            #5
            <textarea id="t5"></textarea>
            #6
            <textarea id="t6"></textarea>
            #7
            <textarea id="t7"></textarea>
            #8
            <textarea id="t8"></textarea>
            #9
            <textarea id="t9"></textarea>
            #10
            <textarea id="t10"></textarea>
            #11
            <textarea id="t11"></textarea>
            <h3>Ważna informacja :</h3> <input type="text" id="important" class="text-input" />
            <h3>Wyświetlać :</h3>
              <label><input id="wiev" type="radio" name="visible" value="Tak"> Tak</label>
              <label><input id="wiev" type="radio" name="visible" value="Super cena!"> Super cena!</label>
              <label><input id="wiev" type="radio" name="visible" value="Promocja"> Promocja</label>
              <label><input id="wiev" type="radio" name="visible" value="Wyprzedaż"> Wyprzedaż</label><br>
              <label><input id="wiev" type="radio" name="visible" value="II gatunek"> II gatunek</label>
              <label><input id="wiev" type="radio" name="visible" value="Archiwum"> Archiwum</label><br>
            
              <div class="error-place">Uzupełnij wymagane pola formularza</div>
              <input type="submit" value="Zapisz" class="btn"/>
            </div>
            
        </div>
        
        <div style="clear: both;"></div>
        

        
    </div>
</body>
<script src="js/menu.js"></script>
<script src="js/upload_img.js"></script>
<script src="js/walidation.js"></script>
<script>
		$("#new-article").parent().addClass("menu-active");
		$("#new-article").addClass("active-color");
</script>
</html>