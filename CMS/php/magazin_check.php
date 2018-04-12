<!DOCTYPE HTML>
<?php
include('db_connect.php');
//usuwanie pustych ogloszen

$order = $_GET['order'];
$pobieranie = $mysqli->query("SELECT * FROM magazyn WHERE order_id = $order");
$liczba_wierszy = mysqli_num_rows($pobieranie);

if($liczba_wierszy > 0)
{
 while ($produkt=mysqli_fetch_array($pobieranie) )
 {
$originalDate = $produkt['data_pakowania'];
$newDate = date("H:i d-m-Y", strtotime($originalDate));
	 
	 
	echo '<div class="row first">
			<div class="number first">Numer zamówienia</div>
			<div class="date first">Data pakowania</div>
			<div class="quantity first">Liczba paczek</div>
			<div class="packed first">Pakował</div>
		 </div>
		 <div class="row">
			<div class="number listing">'.$produkt['order_id'].'</div>
			<div class="date listing">'.$newDate.'</div>
			<div class="quantity listing">'.$produkt['liczba_paczek'].'</div>
			<div class="packed listing">'.$produkt['zapakowal'].'</div>
		 </div>';
	}
}
else
{
	echo '<div class="error" style="display: block;">
	Nie ma takiego zamówienia
	</div>';
}

           
					 


?>