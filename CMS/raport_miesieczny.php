<!DOCTYPE HTML>
<?php
session_start();
if($_SESSION['zalogowany'] != true)
{
   header('Location: index.php');
}
$data = date("Y-m-d H:i:s");
include('php/db_connect.php');
//usuwanie pustych ogloszen
?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Raport miesięczny - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link href="style/sold.css" rel="stylesheet" type="text/css" />
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
               <li>miesiąc:
                   <select class="selected-mounth">
                      <?php
                        $pobieranie = $mysqli->query("SELECT DISTINCT data FROM closed_sold ORDER BY data DESC");
                        while ($produkt=mysqli_fetch_array($pobieranie))
                        {
                           $miesiac = date("m.Y",strtotime($produkt['data']));
                           echo '<option value="'.$miesiac.'">'.$miesiac.'</option>';
                        }
                        ?>
                   </select>
               </li>
               <li>sprzedaż:
                   <select class="selected-shop">
                       <option value="all">Wszystko</option>
                       <option value="allegro">Allegro</option>
                       <option value="olx">Hurtownia / OLX</option>
                       <option value="poza">Poza Allegro</option>
                       <option value="facebook">Facebook</option>
                   </select>
               </li>
               <li>sortuj:
                   <select class="selected-order">
                       <option value="name">Alfabetycznie</option>
                       <option value="sold-asc">liczba sprzedanych rosnąco</option>
                       <option value="sold-desc">liczba sprzedanych malejąco</option>
                       <option value="profit-asc">zysk rosnąco</option>
                       <option value="profit-desc">zysk malejąco</option>
                   </select>
               </li>
            </ol>
            <h1 style="margin-top: 15px;">Raport za miesiąc <span id="mounth-name"></span></h1>
            <div class="display-list">
            </div>
        </div>
            
        <div style="clear: both;"></div>
        

        
    </div>
</body>
<script src="js/menu.js"></script>
<script src="js/raport-list.js"></script>
<script>
		$("#mounth-raport").parent().addClass("menu-active");
		$("#mounth-raport").addClass("active-color");
</script>
</html>