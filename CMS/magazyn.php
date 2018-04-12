<!DOCTYPE HTML>
<?php
session_start();
$data = date("Y-m-d H:i:s");
$_SESSION['user_session_id'] = session_id();
include('php/db_connect.php');

?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>MAGAZYN - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link href="style/magazyn.css" rel="stylesheet" type="text/css" />
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
        <div class="content">
            <h1>MAGAZYN:</h1>
            <div class="new">
            <p>E</p><input id="order-number" type="number" class="form-input order-number" placeholder="Numer zamówienia"><br>
            <span class="order-errors"></span>
            <i class="icon-minus"></i>
            <input id="pack" type="number" class="form-input pack-quantity" placeholder="Paczki" min="1">
            <i class="icon-plus"></i><br>
            <select id="magazynier">
               <option value="select">Wybierz</option>
               <?php
                $pobieranie = $mysqli->query("SELECT * FROM magazynierzy");
                while ($produkt=mysqli_fetch_array($pobieranie) )
                {
                    echo '<option value="select">'.$produkt['name'].'</option>';
                }
                ?>
            </select>          
            <button id="add-order" class="btn confirm" title="Dodaj zamówienie">Dodaj</button>
            <span class="insert-error"></span>
            <span class="order-complete"></span>
            </div>

        </div>
        <div style="clear: both;"></div>  
    </div>
</body>
<script src="js/menu.js"></script>
<script src="js/magazyn.js"></script>
</html>