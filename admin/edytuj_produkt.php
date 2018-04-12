<!DOCTYPE HTML>

<?php
session_start();

if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php#start');  
}

include('../db_connect.php');

if (isset($_GET['id']))
{
    $id = $_GET['id'];
     $rezultat = $mysqli->query("SELECT * FROM produkty WHERE id = $id");
    $produkt=mysqli_fetch_array($rezultat);
}
    
    

$_SESSION['wybierz'] = "Wybierz";

if (isset($_POST['model']))
{
    $poprawne = true;
    
    
    $model = $_POST['model'];
    $dzial = $_POST['dzial'];
    $kolor = $_POST['kolor'];
    $cena = $_POST['cena'];
    $producent = $_POST['producent'];
    $zoom_1 = $_POST['zoom_1'];
    $zoom_2 = $_POST['zoom_2'];
    $zoom_3 = $_POST['zoom_3'];
    $zoom_4 = $_POST['zoom_4'];
    $cena_dostawa = $_POST['cena_dostawa'];
    $cena_dostawa_pobranie = $_POST['cena_dostawa_pobranie'];
    $ubezpieczenie = $_POST['cena_ubezpieczenie'];
    $opis_krotki_1 = $_POST['opis_krotki_1'];
    $opis_krotki_2 = $_POST['opis_krotki_2'];
    $opis_krotki_3 = $_POST['opis_krotki_3'];
    $material = $_POST['material'];
    $waga = $_POST['waga'];
    $wymiary_kartonu = $_POST['wymiary_kartonu'];
    $wymiary_obraz = $_POST['wymiary_obraz'];
    $cecha_1 = $_POST['cecha_1'];
    $cecha_2 = $_POST['cecha_2'];
    $cecha_3 = $_POST['cecha_3'];
    $cecha_4 = $_POST['cecha_4'];
    $cecha_5 = $_POST['cecha_5'];
    $cecha_6 = $_POST['cecha_6'];
    $cecha_7 = $_POST['cecha_7'];
    $cecha_8 = $_POST['cecha_8'];
    $cecha_9 = $_POST['cecha_9'];
    $cecha_10 = $_POST['cecha_10'];
    $cecha_11 = $_POST['cecha_11'];
    $dzial = $_POST['dzial'];
    $producent = $_POST['producent'];
    $sztuk_w_paczce = $_POST['sztuk_w_paczce'];
    $galeria = $_POST['galeria'];
    $brak = $_POST['brak'];
    $gabaryt = $_POST['gabaryt'];
    $cena_pkh = $_POST['cena_pkh'];
    $wyswietlac = $_POST['wyswietlac'];
    $cena_zakupu = $_POST['cena_zakupu'];
    
    
    //sprawdzanie czy jest więcej niż 1 znak
    if(strlen($model)<=1)
    {
        $poprawne = false;
        $_SESSION['e_model'] = "Uzupełnij to pole!";
    }
    
    if(strlen($kolor)<=1)
    {
        $poprawne = false;
        $_SESSION['e_kolor'] = "Uzupełnij to pole!";
    }
    
    if(strlen($cena)<=1)
    {
        $poprawne = false;
        $_SESSION['e_cena'] = "Uzupełnij to pole!";
    }
    
    if(strlen($zoom_1)<=1)
    {
        $poprawne = false;
        $_SESSION['e_zoom_1'] = "Uzupełnij to pole!";
    }
    
    if(strlen($zoom_2)<=1)
    {
        $poprawne = false;
        $_SESSION['e_zoom_2'] = "Uzupełnij to pole!";
    }
    
    if(strlen($zoom_3)<=1)
    {
        $poprawne = false;
        $_SESSION['e_zoom_3'] = "Uzupełnij to pole!";
    }
    
    if(strlen($zoom_4)<=1)
    {
        $poprawne = false;
        $_SESSION['e_zoom_4'] = "Uzupełnij to pole!";
    }
    
    if(strlen($cena_dostawa)<1)
    {
        $poprawne = false;
        $_SESSION['e_cena_dostawa'] = "Uzupełnij to pole!";
    }
    
    if(strlen($cena_dostawa_pobranie)<1)
    {
        $poprawne = false;
        $_SESSION['e_cena_dostawa_pobranie'] = "Uzupełnij to pole!";
    }
    
    if(strlen($cena_ubezpieczenie)<1)
    {
        $poprawne = false;
        $_SESSION['e_cena_ubezpieczenie'] = "Uzupełnij to pole!";
    }
    
    if((strlen($opis_krotki_1)<1) || (strlen($opis_krotki_2)<1) || (strlen($opis_krotki_3)<1))
    {
        $poprawne = false;
        $_SESSION['e_opis_krotki'] = "Uzupełnij puste pola!";
    }
    
    if(strlen($material)<1)
    {
        $poprawne = false;
        $_SESSION['e_material'] = "Uzupełnij to pole!";
    }
    
    if(strlen($waga)<1)
    {
        $poprawne = false;
        $_SESSION['e_waga'] = "Uzupełnij to pole!";
    }
    
    if(strlen($wymiary_kartonu)<1)
    {
        $poprawne = false;
        $_SESSION['e_wymiary_kartonu'] = "Uzupełnij to pole!";
    }
    
    if(strlen($wymiary_obraz)<1)
    {
        $poprawne = false;
        $_SESSION['e_wymiary_obraz'] = "Uzupełnij to pole!";
    }
    
    if((strlen($cecha_1)<1) || (strlen($cecha_2)<1) || (strlen($cecha_3)<1) || (strlen($cecha_4)<1) || (strlen($cecha_5)<1) || (strlen($cecha_6)<1) || (strlen($cecha_7)<1) || (strlen($cecha_8)<1) || (strlen($cecha_9)<1) || (strlen($cecha_10)<1))
    {
        $poprawne = false;
        $_SESSION['e_cechy'] = "Jedno, lub więcej pól z cechami jest puste!";
    }
    
    if($dzial == $_SESSION['wybierz'])
    {
        $poprawne = false;
        $_SESSION['e_dzial'] = "Wybierz dział!";
    }
    
    if($producent == $_SESSION['wybierz'])
    {
        $poprawne = false;
        $_SESSION['e_producent'] = "Wybierz producenta!";
    }
   

    if($poprawne = true)
    {
        
    if($wyswietlac == 'Nie')
    {
    $usuwanie = "DELETE FROM koszyk WHERE model = '$model'";
            // wykonanie usuwania z bazy
            $wynik = $mysqli->query($usuwanie);
    }
        
    $dodawanie = "UPDATE produkty SET model = '$model', dzial = '$dzial', gabaryt = '$gabaryt', opis_1 = '$opis_krotki_1', opis_2='$opis_krotki_2', opis_3='$opis_krotki_3', kolor='$kolor', producent='$producent', cena='$cena', cena_pkh='$cena_pkh', dostawa_od='$cena_dostawa', obraz='$zoom_1', obraz_2='$zoom_2', obraz_3='$zoom_3', obraz_4='$zoom_4', material='$material', waga='$waga', wymiary_kartonu='$wymiary_kartonu', cecha_1='$cecha_1', cecha_2='$cecha_2', cecha_3='$cecha_3', cecha_4='$cecha_4', cecha_5='$cecha_5', cecha_6='$cecha_6', cecha_7='$cecha_7', cecha_8='$cecha_8', cecha_9='$cecha_9', cecha_10='$cecha_10', cecha_11='$cecha_11', wymiary_obraz='$wymiary_obraz', sztuk_w_paczce='$sztuk_w_paczce', galeria='$galeria', brak='$brak', wyswietlac='$wyswietlac' , dostawa_pobranie='$cena_dostawa_pobranie', ubezpieczenie='$ubezpieczenie', cena_zakupu = '$cena_zakupu' WHERE id = $id";
    // wykonanie dodawania do bazy
    $wynik = $mysqli->query($dodawanie);    
        
    header('Location: produkty.php#start');    
    $_SESSION['udana_edycja'] = '<div id="zielony">Edycja <b>'. $model .'</b> przebiegła pomyślnie :)</div>';
  
    }
}

?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>meble biurowe - NOVA HURT</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->

</head>

<body>
    <?php
    include('head.php');
    ?>
    
    <div id="ramka_edytuj_produkt">
        <h2>Edycja: <?php echo $produkt['model']; ?></h2>
            <form method="post">
             <table>
                 <tr>
                     <td>
                Model:
                     </td>
                     <td>
                    <input class="formularz_edycja" type="text" name="model" placeholder="MODEL"
                           
                           <?php
                if (isset($produkt['model']))
                {
                    echo 'value="'.$produkt['model'].'"';
                    unset ($produkt['model']);
                }
                  ?>         
                           /><br>
                   
                
                <?php
                if (isset($_SESSION['e_model']))
                {
                    echo '<div class="error">'. $_SESSION['e_model'].'</div>';
                    unset ($_SESSION['e_model']);    
                }
                ?>
                </td>
                </tr>
                
                 <tr>
                 <td>
                  Cena detal:   
                 </td>
                 <td>
                   <input class="formularz_edycja_cena" type="text" name="cena" placeholder="Cena"
                           
                           <?php
                if (isset($produkt['cena']))
                {
                    echo 'value="'.$produkt['cena'].'"';
                    unset ($produkt['cena']); 
                }
                  ?>>zł  
                     <?php
                if (isset($_SESSION['e_cena']))
                {
                    echo '<div class="error">'. $_SESSION['e_cena'].'</div>';
                    unset ($_SESSION['e_cena']);    
                }
                ?>
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Cena hurt:   
                 </td>
                 <td>
                   <input class="formularz_edycja_cena" type="text" name="cena_pkh" placeholder="Cena hurt"
                           
                           <?php
                if (isset($produkt['cena_pkh']))
                {
                    echo 'value="'.$produkt['cena_pkh'].'"';    
                }
                  ?>
                           
                           >zł<br>
        
                
                
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Kolor:   
                 </td>
                 <td>
                   <input class="formularz_edycja" type="text" name="kolor" placeholder="Kolor"
                           
                           <?php
                if (isset($produkt['kolor']))
                {
                    echo 'value="'.$produkt['kolor'].'"';    
                }
                  ?>>
                
                <?php
                if (isset($_SESSION['e_kolor']))
                {
                    echo '<div class="error">'. $_SESSION['e_kolor'].'</div>';
                    unset ($_SESSION['e_kolor']);    
                }
                ?>
                
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Dostawa (płatność z góry):   
                 </td>
                 <td>
                   <input class="formularz_edycja_cena" type="text" name="cena_dostawa"
                           
                           <?php
                if (isset($produkt['dostawa_od']))
                {
                    echo 'value="'.$produkt['dostawa_od'].'"';    
                }
                  ?>>zł<br>
                
                <?php
                if (isset($_SESSION['e_cena_dostawa']))
                {
                    echo '<div class="error">'. $_SESSION['e_cena_dostawa'].'</div>';
                    unset ($_SESSION['e_cena_dostawa']);    
                }
                ?>
                
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Dostawa (pobranie):   
                 </td>
                 <td>
                   <input class="formularz_edycja_cena" type="text" name="cena_dostawa_pobranie"
                           
                           <?php
                if (isset($produkt['dostawa_pobranie']))
                {
                    echo 'value="'.$produkt['dostawa_pobranie'].'"';    
                }
                  ?>>zł<br>
                
                <?php
                if (isset($_SESSION['e_cena_dostawa_pobranie']))
                {
                    echo '<div class="error">'. $_SESSION['e_cena_dostawa_pobranie'].'</div>';
                    unset ($_SESSION['e_cena_dostawa_pobranie']);    
                }
                ?>
                
                 </td>
                 </tr>
                 
                 <td>
                  Ubezpieczenie:   
                 </td>
                 <td>
                   <input class="formularz_edycja_cena" type="text" name="cena_ubezpieczenie"
                           
                           <?php
                if (isset($produkt['ubezpieczenie']))
                {
                    echo 'value="'.$produkt['ubezpieczenie'].'"';    
                }
                  ?>>zł<br>
                
                <?php
                if (isset($_SESSION['e_cena_ubezpieczenie']))
                {
                    echo '<div class="error">'. $_SESSION['e_cena_ubezpieczenie'].'</div>';
                    unset ($_SESSION['e_cena_ubezpieczenie']);    
                }
                ?>
                
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Sztuk w paczce:   
                 </td>
                 <td>
                   <input class="formularz_edycja_cena" type="text" name="sztuk_w_paczce"
                           
                           <?php
                if (isset($produkt['sztuk_w_paczce']))
                {
                    echo 'value="'.$produkt['sztuk_w_paczce'].'"';    
                }
                  ?>>
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Gabaryt:   
                 </td>
                 <td>
                   <select class="wybor" name="gabaryt">
                        
                            <?php
                            if (isset($produkt['gabaryt']))
                {
                    echo '<option>'.$produkt['gabaryt'].'</option>';    
                }
                  
                            
                            
                            ?></option>
                        <option>0</option>
                        <option>1</option>>
                
                    </select><br>
                 0 - normalny<br>
                1 - wielkogabarytowy
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Dział:   
                 </td>
                 <td>
                   <?php
                if (isset($_SESSION['e_dzial']))
                {
                    echo '<div class="error">'. $_SESSION['e_dzial'].'</div>';
                    unset ($_SESSION['e_dzial']);    
                }
                ?>
                
                    <select class="wybor" name="dzial">
                        
                        
                            <?php
                            if (isset($produkt['dzial']))
                {
                    echo '<option>'.$produkt['dzial'].'</option>';    
                }
                  
                            echo '<option>';
                            echo $_SESSION['wybierz'];
                            ?></option>
                        <option>Artykuły dziecięce</option>
                        <option>Meble biurowe</option>
                        <option>Stoły / Krzesła</option>
                
                 </select>
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Producent:   
                 </td>
                 <td>
                   <?php
                
                if (isset($_SESSION['e_producent']))
                {
                    echo '<div class="error">'. $_SESSION['e_producent'].'</div>';
                    unset ($_SESSION['e_producent']);    
                }
                ?>
                
                      <select class="wybor" name="producent">
                        <?php
                          if (isset($produkt['producent']))
                {
                    echo '<option>'.$produkt['producent'].'</option>';    
                }
                         ?> 
                          <option><?php 
                            echo $_SESSION['wybierz'];
                            ?></option>
                        <option>Lugano</option>
                        <option>Bebico</option>
                        <option>Hilden</option>
                     </select>
                 </td>
                 </tr>
        
                <tr>
                 <td>
                  Materiał:   
                 </td>
                 <td>
                   
                
                <input class="formularz_edycja" type="text" name="material"
                           
                       <?php    
                if (isset($produkt['material']))
                {
                    echo 'value="'.$produkt['material'].'"';    
                }
                  ?>><br>
                
                <?php
                if (isset($_SESSION['e_material']))
                {
                    echo '<div class="error">'. $_SESSION['e_material'].'</div>';
                    unset ($_SESSION['e_material']);    
                }
                ?>
                 </td>
                 </tr>
    
                <tr>
                 <td>
                  Waga:   
                 </td>
                 <td>
                   
                
                <input class="formularz_edycja_cena" type="text" name="waga"
                           
                         <?php
                if (isset($produkt['waga']))
                {
                    echo 'value="'.$produkt['waga'].'"';    
                }
                  ?>
                           
                           >kg<br>
                
                <?php
                if (isset($_SESSION['e_waga']))
                {
                    echo '<div class="error">'. $_SESSION['e_waga'].'</div>';
                    unset ($_SESSION['e_waga']);    
                }
                ?>
                 </td>
                 </tr>
    
                <tr>
                 <td>
                  Wymiary kartonu:   
                 </td>
                 <td>
                   
                
                <input class="formularz_edycja_wymiary" type="text" name="wymiary_kartonu"
                           
                           <?php
                if (isset($produkt['wymiary_kartonu']))
                {
                    echo 'value="'.$produkt['wymiary_kartonu'].'"';    
                }
                  ?>
                           
                           >cm<br>
                 </td>
                 </tr>

                <tr>
                 <td>
                  Informacja specjalna:   
                 </td>
                 <td>
                   
                
                <input class="formularz_edycja" type="text" name="brak"
                           
                           <?php
                if (isset($produkt['brak']))
                {
                    echo 'value="'.$produkt['brak'].'"';    
                }
                  ?>>
                 </td>
                 </tr>
    
                <tr>
                 <td>
                  Opis króki:   
                 </td>
                 <td>
                   <?php
                if (isset($_SESSION['e_opis_krotki']))
                {
                    echo '<div class="error">'. $_SESSION['e_opis_krotki'].'</div>';
                    unset ($_SESSION['e_opis_krotki']);    
                }
                ?>
    
                    
                    <input class="formularz_edycja" type="text" name="opis_krotki_1"
                           
                           <?php
                if (isset($produkt['opis_1']))
                {
                    echo 'value="'.$produkt['opis_1'].'"';    
                }
                  ?>><br>
                           
                   
                    <input class="formularz_edycja" type="text" name="opis_krotki_2"
                           
                           <?php
                if (isset($produkt['opis_2']))
                {
                    echo 'value="'.$produkt['opis_2'].'"';    
                }
                  ?>><br>
                    
                    <input class="formularz_edycja" type="text" name="opis_krotki_3"
                           
                           <?php
                if (isset($produkt['opis_3']))
                {
                    echo 'value="'.$produkt['opis_3'].'"';    
                }
                  ?>
                           
                           >
                 </td>
                 </tr>
    
                <tr>
                 <td>
                  Szczegółowy opis::   
                 </td>
                 <td>
                   <?php
                if (isset($_SESSION['e_cechy']))
                {
                    echo '<div class="error">'. $_SESSION['e_cechy'].'</div>';
                    unset ($_SESSION['e_cechy']);    
                }
                ?>
                
                    1:<br>
                       <textarea class="formularz_2" warp="virtual" type="text" name="cecha_1"><?php
                if (isset($produkt['cecha_1']))
                {
                    echo $produkt['cecha_1'];    
                }
                  ?></textarea><br>
                    2:<br>
                       <textarea class="formularz_2" type="text" name="cecha_2"><?php
                if (isset($produkt['cecha_2']))
                {
                    echo $produkt['cecha_2'];    
                }
                  ?></textarea><br>
                    3:<br>
                       <textarea class="formularz_2" type="text" name="cecha_3"><?php
                if (isset($produkt['cecha_3']))
                {
                    echo $produkt['cecha_3'];    
                }
                  ?></textarea><br>
                    4:<br>
                       <textarea class="formularz_2" type="text" name="cecha_4"><?php
                if (isset($produkt['cecha_4']))
                {
                    echo $produkt['cecha_4'];    
                }
                  ?></textarea><br>
                    5:<br>
                       <textarea class="formularz_2" type="text" name="cecha_5"><?php
                if (isset($produkt['cecha_5']))
                {
                    echo $produkt['cecha_5'];    
                }
                  ?></textarea><br>
                    6:<br>
                       <textarea class="formularz_2" type="text" name="cecha_6"><?php
                if (isset($produkt['cecha_6']))
                {
                    echo $produkt['cecha_6'];    
                }
                  ?></textarea><br>
                    7:<br>
                       <textarea class="formularz_2" type="text" name="cecha_7"><?php
                if (isset($produkt['cecha_7']))
                {
                    echo $produkt['cecha_7'];    
                }
                  ?></textarea><br>
                    8:<br>
                       <textarea class="formularz_2" type="text" name="cecha_8"><?php
                if (isset($produkt['cecha_8']))
                {
                    echo $produkt['cecha_8'];    
                }
                  ?></textarea><br>
                    9:<br>
                       <textarea class="formularz_2" type="text" name="cecha_9"><?php
                if (isset($produkt['cecha_9']))
                {
                    echo $produkt['cecha_9'];    
                }
                  ?></textarea><br>
                    10:<br>
                       <textarea class="formularz_2" type="text" name="cecha_10"><?php
                if (isset($produkt['cecha_10']))
                {
                    echo $produkt['cecha_10'];    
                }
                  ?></textarea><br>
                    11:<br>
                       <textarea class="formularz_2" type="text" name="cecha_11"><?php
                if (isset($produkt['cecha_11']))
                {
                    echo $produkt['cecha_11'];    
                }
                  ?></textarea><br>
                 </td>
                 </tr>
                    
                <tr>
                 <td>
                  Zdjęcia ZOOM:   
                 </td>
                 <td>
                     1:
                   <input class="formularz_edycja" type="text" name="zoom_1"
                         
                         <?php
                if (isset($produkt['obraz']))
                {
                    echo 'value="'.$produkt['obraz'].'"';    
                }
                  ?>
                         
                         ><br>
                
                <?php
                if (isset($_SESSION['e_zoom_1']))
                {
                    echo '<div class="error">'. $_SESSION['e_zoom_1'].'</div>';
                    unset ($_SESSION['e_zoom_1']);    
                }
                ?>
                
                    2:
                    <input class="formularz_edycja" type="text" name="zoom_2"
                           
                           <?php
                if (isset($produkt['obraz_2']))
                {
                    echo 'value="'.$produkt['obraz_2'].'"';    
                }
                  ?>
                           
                           > <br>
                
                <?php
                if (isset($_SESSION['e_zoom_2']))
                {
                    echo '<div class="error">'. $_SESSION['e_zoom_2'].'</div>';
                    unset ($_SESSION['e_zoom_2']);    
                }
                ?>
                
                    3:
                    <input class="formularz_edycja" type="text" name="zoom_3"
                                                               
                                                               <?php
                if (isset($produkt['obraz_3']))
                {
                    echo 'value="'.$produkt['obraz_3'].'"';    
                }
                  ?>
                                                               
                                                               ><br>
                
                <?php
                if (isset($_SESSION['e_zoom_3']))
                {
                    echo '<div class="error">'. $_SESSION['e_zoom_3'].'</div>';
                    unset ($_SESSION['e_zoom_3']);    
                }
                ?>
                
                    4:
                    <input class="formularz_edycja" type="text" name="zoom_4"
                           
                           <?php
                if (isset($produkt['obraz_4']))
                {
                    echo 'value="'.$produkt['obraz_4'].'"';    
                }
                  ?>
                           
                           >
                
                <?php
                if (isset($_SESSION['e_zoom_4']))
                {
                    echo '<div class="error">'. $_SESSION['e_zoom_4'].'</div>';
                    unset ($_SESSION['e_zoom_4']);    
                }
                ?>
                 </td>
                 </tr>
    
                <tr>
                 <td>
                  Zdjęcie wymiary:   
                 </td>
                 <td>
                   <input class="formularz_edycja" type="text" name="wymiary_obraz"
                            
                            <?php
                if (isset($produkt['wymiary_obraz']))
                {
                    echo 'value="'.$produkt['wymiary_obraz'].'"';    
                }
                  ?>
                            
                            ><br>  
                 </td>
                 </tr>
                
                   
                <tr>
                 <td>
                  Galeria:   
                 </td>
                 <td>
                    <textarea class="formularz_2" name="galeria"><?php
                            echo $produkt['galeria'];
                            ?></textarea><br> 
                 </td>
                 </tr>      
                            
                 <tr>
                 <td>
                  Wyświetlać?:   
                 </td>
                 <td>
                     
                     <?php
                if (isset($_SESSION['e_wyswietlac']))
                {
                    echo '<div class="error">'. $_SESSION['e_wyswietlac'].'</div>';
                    unset ($_SESSION['e_wyswietlac']);    
                }
                ?>
                     
                
                      <select class="wybor" name="wyswietlac">
                         <?php
                          if (isset($produkt['wyswietlac']))
                {
                    echo '<option>'.$produkt['wyswietlac'].'</option>';    
                }
                         ?> 
                          <option><?php 
                            echo $_SESSION['wybierz'];
                            ?></option>
                        <option>Tak</option>
                        <option>Promocja</option>
                        <option>Wyprzedaż</option>
                        <option>II gatunek</option>
                        <option>Super cena!</option>
                        <option>Nie</option>

                     </select>
                 </td>
                 </tr>
                 <tr>
                 <td>
                  Cena zakupu:   
                 </td>
                 <td>
                   <input class="formularz_edycja_cena" type="text" name="cena_zakupu" placeholder="Cena zakupu"
                           
                           <?php
                if (isset($produkt['cena_zakupu']))
                {
                    echo 'value="'.$produkt['cena_zakupu'].'"';    
                }
                  ?>
                           
                           >zł<br>
        
                
                
                 </td>
                 </tr>
                 
                 
    
                    <tr>
                 <td>
                  Usuń produkt:   
                 </td>
                 <td>
                <?php 
                echo '<a href = "edit/delete_product.php?id=' . $produkt['id'] . '">';
                echo '<img src="../jpg/delete.jpg" width="30" height="" align=""/>';    
                echo '</a>';  ?></td>
                 </tr>
            
            
         
            
          </table>     
        <input type="submit" value="Zapisz" name="aktualizuj"/>
            </form>
        </div>
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
</html>




