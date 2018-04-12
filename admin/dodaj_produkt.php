<!DOCTYPE HTML>

<?php
session_start();

if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php#start');  
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
    $cena_ubezpieczenie = $_POST['cena_ubezpieczenie'];
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
    
    if($wyswietlac == $_SESSION['wybierz'])
    {
        $poprawne = false;
        $_SESSION['e_wyswietlac'] = "Wyświetlać?";
    }
   

    $_SESSION['zapamietaj_model'] = $_POST['model'];
    $_SESSION['zapamietaj_dzial'] = $_POST['dzial'];
    $_SESSION['zapamietaj_kolor'] = $_POST['kolor'];
    $_SESSION['zapamietaj_cena'] = $_POST['cena'];
    $_SESSION['zapamietaj_producent'] = $_POST['producent'];
    $_SESSION['zapamietaj_zoom_1'] = $_POST['zoom_1'];
    $_SESSION['zapamietaj_zoom_2'] = $_POST['zoom_2'];
    $_SESSION['zapamietaj_zoom_3'] = $_POST['zoom_3'];
    $_SESSION['zapamietaj_zoom_4'] = $_POST['zoom_4'];
    $_SESSION['zapamietaj_cena_dostawa'] = $_POST['cena_dostawa'];
    $_SESSION['zapamietaj_cena_dostawa_pobranie'] = $_POST['cena_dostawa_pobranie'];
    $_SESSION['zapamietaj_cena_ubezpieczenie'] = $_POST['cena_ubezpieczenie'];
    $_SESSION['zapamietaj_opis_krotki_1'] = $_POST['opis_krotki_1'];
    $_SESSION['zapamietaj_opis_krotki_2'] = $_POST['opis_krotki_2'];
    $_SESSION['zapamietaj_opis_krotki_3'] = $_POST['opis_krotki_3'];
    $_SESSION['zapamietaj_material'] = $_POST['material'];
    $_SESSION['zapamietaj_waga'] = $_POST['waga'];
    $_SESSION['zapamietaj_wymiary_kartonu'] = $_POST['wymiary_kartonu'];
    $_SESSION['zapamietaj_wymiary_obraz'] = $_POST['wymiary_obraz'];
    $_SESSION['zapamietaj_cecha_1'] = $_POST['cecha_1'];
    $_SESSION['zapamietaj_cecha_2'] = $_POST['cecha_2'];
    $_SESSION['zapamietaj_cecha_3'] = $_POST['cecha_3'];
    $_SESSION['zapamietaj_cecha_4'] = $_POST['cecha_4'];
    $_SESSION['zapamietaj_cecha_5'] = $_POST['cecha_5'];
    $_SESSION['zapamietaj_cecha_6'] = $_POST['cecha_6'];
    $_SESSION['zapamietaj_cecha_7'] = $_POST['cecha_7'];
    $_SESSION['zapamietaj_cecha_8'] = $_POST['cecha_8'];
    $_SESSION['zapamietaj_cecha_9'] = $_POST['cecha_9'];
    $_SESSION['zapamietaj_cecha_10'] = $_POST['cecha_10'];
    $_SESSION['zapamietaj_cecha_11'] = $_POST['cecha_11'];
    $_SESSION['zapamietaj_dzial'] = $_POST['dzial'];
    $_SESSION['zapamietaj_producent'] = $_POST['producent'];
    $_SESSION['zapamietaj_sztuk_w_paczce'] = $_POST['sztuk_w_paczce'];
    $_SESSION['zapamietaj_galeria'] = $_POST['galeria'];
    $_SESSION['zapamietaj_brak'] = $_POST['brak'];
    $_SESSION['zapamietaj_gabaryt'] = $_POST['gabaryt'];
    $_SESSION['zapamietaj_cena_pkh'] = $_POST['cena_pkh'];
    $_SESSION['zapamietaj_wyswietlac'] = $_POST['wyswietlac'];
    
    
    
    if($poprawne == true)
      
    {    
        include('../db_connect.php');
        
        $dodawanie = "insert into produkty (id, model, dzial, gabaryt, opis_1, opis_2, opis_3, kolor, producent, cena, cena_pkh, dostawa_od, dostawa_pobranie, ubezpieczenie, obraz, obraz_2, obraz_3, obraz_4, material, waga, wymiary_kartonu, cecha_1, cecha_2, cecha_3, cecha_4, cecha_5, cecha_6, cecha_7, cecha_8, cecha_9, cecha_10, cecha_11, wymiary_obraz, sztuk_w_paczce, galeria, brak, wyswietlac) values ('', '$model', '$dzial', '$gabaryt', '$opis_krotki_1', '$opis_krotki_2', '$opis_krotki_3', '$kolor', '$producent', '$cena', '$cena_pkh', '$dostawa_od', '$dostawa_od_pobranie', '$ubezpieczenie', '$zoom_1', '$zoom_2', '$zoom_3', '$zoom_4', '$material', '$waga', '$wymiary_kartonu', '$cecha_1', '$cecha_2', '$cecha_3', '$cecha_4', '$cecha_5', '$cecha_6', '$cecha_7', '$cecha_8', '$cecha_9', '$cecha_10', '$cecha_11', '$wymiary_obraz', '$sztuk_w_paczce', '$galeria', '$brak', '$wyswietlac')";
            // wykonanie dodawania do bazy
        $wynik = $mysqli->query($dodawanie);
       
        
    header('Location: produkty.php#start');    
    $_SESSION['udana_edycja'] = '<div id="zielony">Dodano <b>'. $model .'</b> do produktów :)</div>';
  
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
        <h2>Dodawanie produktu</h2>
            <form method="post">
             <table>
                 <tr>
                     <td>
                Model:
                     </td>
                     <td>
                    <input class="formularz_edycja" type="text" name="model" placeholder="MODEL" value="<?php
                            if (isset($_SESSION['zapamietaj_model']))
                            {
                                echo $_SESSION['zapamietaj_model'];
                                unset($_SESSION['zapamietaj_model']);
                            }
                            ?>"/>
                   
                
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
                   <input class="formularz_edycja_cena" type="text" name="cena" placeholder="Cena" value="<?php
                            if (isset($_SESSION['zapamietaj_cena']))
                            {
                                echo $_SESSION['zapamietaj_cena'];
                                unset($_SESSION['zapamietaj_cena']);
                            }
                            ?>"/>
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
                   <input class="formularz_edycja_cena" type="text" name="cena_pkh" placeholder="Cena hurt" value="<?php
                            if (isset($_SESSION['zapamietaj_cena_pkh']))
                            {
                                echo $_SESSION['zapamietaj_cena_pkh'];
                                unset($_SESSION['zapamietaj_cena_pkh']);
                            }
                            ?>"/>
        
                
                
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Kolor:   
                 </td>
                 <td>
                   <input class="formularz_edycja" type="text" name="kolor" placeholder="Kolor" value="<?php
                            if (isset($_SESSION['zapamietaj_kolor']))
                            {
                                echo $_SESSION['zapamietaj_kolor'];
                                unset($_SESSION['zapamietaj_kolor']);
                            }
                            ?>"/>
                
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
                  Cena dostawy (płatne z góry):   
                 </td>
                 <td>
                   <input class="formularz_edycja_cena" type="text" name="cena_dostawa" value="<?php
                            if (isset($_SESSION['zapamietaj_cena_dostawa']))
                            {
                                echo $_SESSION['zapamietaj_cena_dostawa'];
                                unset($_SESSION['zapamietaj_cena_dostawa']);
                            }
                            ?>"/>
                
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
                  Cena dostawy (pobranie):   
                 </td>
                 <td>
                   <input class="formularz_edycja_cena" type="text" name="cena_dostawa_pobranie" value="<?php
                            if (isset($_SESSION['zapamietaj_cena_dostawa_pobranie']))
                            {
                                echo $_SESSION['zapamietaj_cena_dostawa_pobranie'];
                                unset($_SESSION['zapamietaj_cena_dostawa_pobranie']);
                            }
                            ?>"/>
                
                <?php
                if (isset($_SESSION['e_cena_dostawa_pobranie']))
                {
                    echo '<div class="error">'. $_SESSION['e_cena_dostawa_pobranie'].'</div>';
                    unset ($_SESSION['e_cena_dostawa_pobranie']);    
                }
                ?>
                
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Cena ubezpieczenia:   
                 </td>
                 <td>
                   <input class="formularz_edycja_cena" type="text" name="cena_ubezpieczenie" value="<?php
                            if (isset($_SESSION['zapamietaj_cena_dostawa_pobranie']))
                            {
                                echo $_SESSION['zapamietaj_cena_ubezpieczenie'];
                                unset($_SESSION['zapamietaj_cena_ubezpieczenie']);
                            }
                            ?>"/>
                
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
                   <input class="formularz_edycja_cena" type="text" name="sztuk_w_paczce" value="<?php
                            if (isset($_SESSION['zapamietaj_sztuk_w_paczce']))
                            {
                                echo $_SESSION['zapamietaj_sztuk_w_paczce'];
                                unset($_SESSION['zapamietaj_sztuk_w_paczce']);
                            }
                            ?>"/>
                 </td>
                 </tr>
                 
                 <tr>
                 <td>
                  Gabaryt:   
                 </td>
                 <td>
                   <select class="wybor" name="gabaryt">
                        
                            <?php
                            if (isset($_SESSION['zapamietaj_gabaryt']))
                {
                    echo '<option>'.$_SESSION['zapamietaj_gabaryt'].'</option>';    
                }
                            
                            else
                              {
                                echo '<option>';
                            echo $_SESSION['wybierz'];
                              }
                            ?>
                            
                       
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
                            if (isset($_SESSION['zapamietaj_dzial']))
                {
                    echo '<option>'.$_SESSION['zapamietaj_dzial'].'</option>';    
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
                            if (isset($_SESSION['zapamietaj_producent']))
                {
                    echo '<option>'.$_SESSION['zapamietaj_producent'].'</option>';    
                }
                            
                            else
                              {
                                echo '<option>';
                            echo $_SESSION['wybierz'];
                              }
                            ?>
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
                   
                
                <input class="formularz_edycja" type="text" name="material" value="<?php
                            if (isset($_SESSION['zapamietaj_material']))
                            {
                                echo $_SESSION['zapamietaj_material'];
                                unset($_SESSION['zapamietaj_material']);
                            }
                            ?>"/>
                
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
                   
                
                <input class="formularz_edycja_cena" type="text" name="waga"value="<?php
                            if (isset($_SESSION['zapamietaj_waga']))
                            {
                                echo $_SESSION['zapamietaj_waga'];
                                unset($_SESSION['zapamietaj_waga']);
                            }
                            ?>"/>
                
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
                   
                
                <input class="formularz_edycja_wymiary" type="text" name="wymiary_kartonu" value="<?php
                            if (isset($_SESSION['zapamietaj_wymiary_kartonu']))
                            {
                                echo $_SESSION['zapamietaj_wymiary_kartonu'];
                                unset($_SESSION['zapamietaj_wymiary_kartonu']);
                            }
                            ?>"/>
                 </td>
                 </tr>

                <tr>
                 <td>
                  Informacja specjalna:   
                 </td>
                 <td>
                   
                
                <input class="formularz_edycja" type="text" name="brak" value="<?php
                            if (isset($_SESSION['zapamietaj_brak']))
                            {
                                echo $_SESSION['zapamietaj_brak'];
                                unset($_SESSION['zapamietaj_brak']);
                            }
                            ?>"/>
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
    
                    
                    <input class="formularz_edycja" type="text" name="opis_krotki_1" value="<?php
                            if (isset($_SESSION['zapamietaj_opis_krotki_1']))
                            {
                                echo $_SESSION['zapamietaj_opis_krotki_1'];
                                unset($_SESSION['zapamietaj_opis_krotki_1']);
                            }
                            ?>"/><br>
                           
                   
                    <input class="formularz_edycja" type="text" name="opis_krotki_2" value="<?php
                            if (isset($_SESSION['zapamietaj_opis_krotki_2']))
                            {
                                echo $_SESSION['zapamietaj_opis_krotki_2'];
                                unset($_SESSION['zapamietaj_opis_krotki_2']);
                            }
                            ?>"/><br>
                    
                    <input class="formularz_edycja" type="text" name="opis_krotki_3" value="<?php
                            if (isset($_SESSION['zapamietaj_opis_krotki_3']))
                            {
                                echo $_SESSION['zapamietaj_opis_krotki_3'];
                                unset($_SESSION['zapamietaj_opis_krotki_3']);
                            }
                            ?>"/><br>
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
                            if (isset($_SESSION['zapamietaj_cecha_1']))
                            {
                                echo $_SESSION['zapamietaj_cecha_1'];
                                unset($_SESSION['zapamietaj_cecha_1']);
                            }
                            ?></textarea><br>
                    2:<br>
                       <textarea class="formularz_2" type="text" name="cecha_2"><?php
                            if (isset($_SESSION['zapamietaj_cecha_2']))
                            {
                                echo $_SESSION['zapamietaj_cecha_2'];
                                unset($_SESSION['zapamietaj_cecha_2']);
                            }
                            ?></textarea><br>
                    3:<br>
                       <textarea class="formularz_2" type="text" name="cecha_3"><?php
                            if (isset($_SESSION['zapamietaj_cecha_3']))
                            {
                                echo $_SESSION['zapamietaj_cecha_3'];
                                unset($_SESSION['zapamietaj_cecha_3']);
                            }
                            ?></textarea><br>
                    4:<br>
                       <textarea class="formularz_2" type="text" name="cecha_4"><?php
                            if (isset($_SESSION['zapamietaj_cecha_4']))
                            {
                                echo $_SESSION['zapamietaj_cecha_4'];
                                unset($_SESSION['zapamietaj_cecha_4']);
                            }
                            ?></textarea><br>
                    5:<br>
                       <textarea class="formularz_2" type="text" name="cecha_5"><?php
                            if (isset($_SESSION['zapamietaj_cecha_5']))
                            {
                                echo $_SESSION['zapamietaj_cecha_5'];
                                unset($_SESSION['zapamietaj_cecha_5']);
                            }
                            ?></textarea><br>
                    6:<br>
                       <textarea class="formularz_2" type="text" name="cecha_6"><?php
                            if (isset($_SESSION['zapamietaj_cecha_6']))
                            {
                                echo $_SESSION['zapamietaj_cecha_6'];
                                unset($_SESSION['zapamietaj_cecha_6']);
                            }
                            ?></textarea><br>
                    7:<br>
                       <textarea class="formularz_2" type="text" name="cecha_7"><?php
                            if (isset($_SESSION['zapamietaj_cecha_7']))
                            {
                                echo $_SESSION['zapamietaj_cecha_7'];
                                unset($_SESSION['zapamietaj_cecha_7']);
                            }
                            ?></textarea><br>
                    8:<br>
                       <textarea class="formularz_2" type="text" name="cecha_8"><?php
                            if (isset($_SESSION['zapamietaj_cecha_8']))
                            {
                                echo $_SESSION['zapamietaj_cecha_8'];
                                unset($_SESSION['zapamietaj_cecha_8']);
                            }
                            ?></textarea><br>
                    9:<br>
                       <textarea class="formularz_2" type="text" name="cecha_9"><?php
                            if (isset($_SESSION['zapamietaj_cecha_9']))
                            {
                                echo $_SESSION['zapamietaj_cecha_9'];
                                unset($_SESSION['zapamietaj_cecha_9']);
                            }
                            ?></textarea><br>
                    10:<br>
                       <textarea class="formularz_2" type="text" name="cecha_10"><?php
                            if (isset($_SESSION['zapamietaj_cecha_10']))
                            {
                                echo $_SESSION['zapamietaj_cecha_10'];
                                unset($_SESSION['zapamietaj_cecha_10']);
                            }
                            ?></textarea><br>
                    11:<br>
                       <textarea class="formularz_2" type="text" name="cecha_11"><?php
                            if (isset($_SESSION['zapamietaj_cecha_11']))
                            {
                                echo $_SESSION['zapamietaj_cecha_11'];
                                unset($_SESSION['zapamietaj_cecha_11']);
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
                   <input class="formularz_edycja" type="text" name="zoom_1" value="<?php
                            if (isset($_SESSION['zapamietaj_zoom_1']))
                            {
                                echo $_SESSION['zapamietaj_zoom_1'];
                                unset($_SESSION['zapamietaj_zoom_1']);
                            }
                            ?>"><br>
                
                <?php
                if (isset($_SESSION['e_zoom_1']))
                {
                    echo '<div class="error">'. $_SESSION['e_zoom_1'].'</div>';
                    unset ($_SESSION['e_zoom_1']);    
                }
                ?>
                
                    2:
                    <input class="formularz_edycja" type="text" name="zoom_2"value="<?php
                            if (isset($_SESSION['zapamietaj_zoom_2']))
                            {
                                echo $_SESSION['zapamietaj_zoom_2'];
                                unset($_SESSION['zapamietaj_zoom_2']);
                            }
                            ?>"><br>
                
                <?php
                if (isset($_SESSION['e_zoom_2']))
                {
                    echo '<div class="error">'. $_SESSION['e_zoom_2'].'</div>';
                    unset ($_SESSION['e_zoom_2']);    
                }
                ?>
                
                    3:
                    <input class="formularz_edycja" type="text" name="zoom_3" value="<?php
                            if (isset($_SESSION['zapamietaj_zoom_3']))
                            {
                                echo $_SESSION['zapamietaj_zoom_3'];
                                unset($_SESSION['zapamietaj_zoom_3']);
                            }
                            ?>"><br>
                
                <?php
                if (isset($_SESSION['e_zoom_3']))
                {
                    echo '<div class="error">'. $_SESSION['e_zoom_3'].'</div>';
                    unset ($_SESSION['e_zoom_3']);    
                }
                ?>
                
                    4:
                    <input class="formularz_edycja" type="text" name="zoom_4" value="<?php
                            if (isset($_SESSION['zapamietaj_zoom_4']))
                            {
                                echo $_SESSION['zapamietaj_zoom_4'];
                                unset($_SESSION['zapamietaj_zoom_4']);
                            }
                            ?>"><br>
                
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
                   <input class="formularz_edycja" type="text" name="wymiary_obraz" value="<?php
                            if (isset($_SESSION['zapamietaj_wymiary_obraz']))
                            {
                                echo $_SESSION['zapamietaj_wymiary_obraz'];
                                unset($_SESSION['zapamietaj_wymiary_obraz']);
                            }
                            ?>"><br> 
                 </td>
                 </tr>
    
                <tr>
                 <td>
                  Galeria:   
                 </td>
                 <td>
                    <textarea class="formularz_2" type="text" name="galeria"><?php
                            if (isset($_SESSION['zapamietaj_galeria']))
                            {
                                echo $_SESSION['zapamietaj_galeria'];
                                unset($_SESSION['zapamietaj_galeria']);
                            }
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
                     
                   <?php
                
                if (isset($_SESSION['e_producent']))
                {
                    echo '<div class="error">'. $_SESSION['e_producent'].'</div>';
                    unset ($_SESSION['e_producent']);    
                }
                ?>
                
                      <select class="wybor" name="wyswietlac">
                        <?php
                            if (isset($_SESSION['zapamietaj_producent']))
                {
                    echo '<option>'.$_SESSION['zapamietaj_producent'].'</option>';    
                }
                            
                            else
                              {
                                echo '<option>';
                            echo $_SESSION['wybierz'];
                              }
                            ?>
                        <option>Tak</option>
                        <option>Nie</option>

                     </select>
                 </td>
                 </tr>
    
                
            
            
         
            
          </table>     
        <input type="submit" value="Dodaj" name="aktualizuj"/>
            </form>
        </div>
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
    
    
    


</body>
</html>