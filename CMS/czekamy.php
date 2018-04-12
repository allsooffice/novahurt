<!DOCTYPE HTML>
<?php
session_start();
if($_SESSION['zalogowany'] != true)
{
   header('Location: index.php');
}
$data = date("Y-m-d H:i:s");
include('php/db_connect.php');
?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Czekamy - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link href="style/sold.css" rel="stylesheet" type="text/css" />
	<link href="style/sprzedane.css" rel="stylesheet" type="text/css" />
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
    <div class="box">
		 <div class="popup">
			 <h3>Czy na pewno wyeksportować zaznaczone zamówienia?</h3>
			  <p>Po potwierdzeniu zostanie wyganerowany plik xml.</p>
			  <p>
			  <label>
			  <input type="checkbox" class="export-transfer-checkbox" checked>
			  Przenieś zaznaczone zamówiena do zakładki
			  </label>
			  <select id="export-moveTo">
			  	<option value="Zakończone">Zakończone</option>
			  	<option value="Czekamy">Czekamy</option>
			  </select>
			  </p>
			  <p>
			  <label>
			  <input type="checkbox" class="export-message-checkbox" checked>
			  Wyślij kupującemu maila z
			  </label>
			  <select id="export-choosen-message">
			  	<option value="wysylka">Informacją o wysyłce</option>
			  	<option value="wplata">Informacją o nieudanej wpłacie</option>
			  </select>
			  </p>
			  <input class="confirm-btn" type="button" id="confirm" value="Tak"/>
			  <input class="confirm-btn" type="button" id="close-box" value="Nie"/>
		 </div>
		 <div class="download">
			 <h2>Plik xml do pobrania:</h2>
			 <a href="download/zamowienia.xml" download title="Kliknij aby pobrać">
			 <i class="icon-download"></i>Pobierz</a>
			 <div class="selected-items">
			  	
			  </div>
			 <input class="confirm-btn" type="button" id="close-download" value="Zamknij" title="Zamknij okno"/>
		 </div>
		 <div class="transfer">
			 <h3>Czy na pewno przenieść zaznaczone zamówienia?</h3>
			 <p>
			  <label>
			  <input type="checkbox" class="transfer-checkbox">
			  Przenieś zaznaczone zamówiena do zakładki
			  </label>
			  <select id="moveTo">
			  	<option value="Zakończone">Zakończone</option>
			  	<option value="Czekamy">Czekamy</option>
			  </select>
			 </p>
			 <p>
			  <label>
			  <input type="checkbox" class="message-checkbox">
			  Wyślij kupującemu maila z
			  </label>
			  <select id="choosen-message">
			  	<option value="wysylka">Informacją o wysyłce</option>
			  	<option value="wplata">Informacją o nieudanej wpłacie</option>
			  </select>
			  </p>
			  <input class="confirm-btn" type="button" id="confirm-transfer" value="Tak"/>
			  <input class="confirm-btn" type="button" id="close-transfer" value="Nie"/>
		 </div>
		 <div class="transfered">
		    <h3>Potwierdzenie</h3>
			 <div class="selected-items">
			  	
			  </div>
			 <input class="confirm-btn" type="button" id="exit-transfer" value="Zamknij" title="Zamknij okno"/>
		 </div>
	</div>  
        <div class="menu">
          
           <h2><i class="icon-menu"></i> Menu</h2>
           <?php
            include('parts/menu.php');
            ?>
            
        </div>
        
        <div class="menu-option">
           <h2><i class="icon-file-code"></i> Opcje</h2>
            <ul>
            	<li id="select-all">Zaznacz wszystkie</li>
            	<li id="export">Eksport danych</li>
            	<li id="transfer">Przenieś</li>
            	<li id="send-message">Wyślij wiadomość</li>
            </ul>
        </div>
        
        <div class="content">
            
            <ol class="filters">
              <div class="filters-front">Filtry</div>
               <li>Płatność:
                   <select class="selected-payment">
                       <option value="all">Wszystko</option>
                       <option value="polcard">PolCard</option>
                       <option value="przelew">Przelew na konto</option>
                       <option value="pobranie">Pobranie</option>
                   </select>
               </li>
            </ol>
            <div class="display-list">
            </div>
        </div>
            
        <div style="clear: both;"></div>
        

        
    </div>
</body>
<script src="js/menu.js"></script>
<script src="js/waiting-list.js"></script>
<script>
		$("#wait").parent().addClass("menu-active");
		$("#wait").addClass("active-color");
</script>
</html>