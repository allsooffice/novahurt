<?php
include('db_connect.php');
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $model = $_GET['nazwa'];
    $producent = $_GET['producent'];
    $dzial = $_GET['dzial'];
    $detal = $_GET['detal'];
    $hurt = $_GET['hurt'];
    $short1 = $_GET['short1'];
    $short2 = $_GET['short2'];
    $short3 = $_GET['short3'];
    $przelew = $_GET['przelew'];
    $pobranie = $_GET['pobranie'];
    $ubezpieczenie = $_GET['ubezpieczenie'];
    $waga = $_GET['waga'];
    $material = $_GET['material'];
    $kolor = $_GET['kolor'];
    $karton = $_GET['karton'];
    $wyswietlac = $_GET['wyswietlac'];
    $max = $_GET['max'];
    $next = $_GET['next'];
    $important = $_GET['important'];
    $t1 = $_GET['t1'];
    $t2 = $_GET['t2'];
    $t3 = $_GET['t3'];
    $t4 = $_GET['t4'];
    $t5 = $_GET['t5'];
    $t6 = $_GET['t6'];
    $t7 = $_GET['t7'];
    $t8 = $_GET['t8'];
    $t9 = $_GET['t9'];
    $t10 = $_GET['t10'];
    $t11 = $_GET['t11'];
    $cena_zakupu = $_GET['cena_zakupu'];
    $crossed_price = $_GET['crossed_price'];
    $last_name = $_GET['last_name'];
    
    $dodawanie = "UPDATE produkty SET model = '$model', dzial = '$dzial', gabaryt = '0', opis_1 = '$short1', opis_2='$short2', opis_3='$short3', kolor='$kolor', producent = '$producent', cena='$detal', cena_pkh = '$hurt', dostawa_od = '$przelew', obraz_2 = '-', obraz_3 = '-', obraz_4 = '-', material = '$material', waga = '$waga', wymiary_kartonu = '$karton', cecha_1 = '$t1', cecha_2 = '$t2', cecha_3 = '$t3', cecha_4 = '$t4', cecha_5 = '$t5', cecha_6 = '$t6', cecha_7 = '$t7', cecha_8 = '$t8', cecha_9 = '$t9', cecha_10 = '$t10', cecha_11 = '$t11', sztuk_w_paczce = '$max', brak = '$important', wyswietlac = '$wyswietlac', dostawa_pobranie='$pobranie', ubezpieczenie='$ubezpieczenie', wyswietlen='0', kolejna_sztuka = '$next', cena_zakupu = '$cena_zakupu', crossed_price = '$crossed_price' WHERE id = $id";
    // wykonanie dodawania do bazy
    $wynik = $mysqli->query($dodawanie);
	
	if($last_name != $model)
	{
		$update = "UPDATE sold_products SET product = '$model' WHERE product = '$last_name' AND status <> 'zamkniety'";
		 // wykonanie dodawania do bazy
		 $now = $mysqli->query($update);
	}
	
}
?> 