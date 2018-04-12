            <?php $oplata = $cena_podsumowanie * 100; 
            include('email.php');

?>
           <form method="get" action="https://sklep.przelewy24.pl/zakup.php">
            <input type="hidden" name="z24_id_sprzedawcy" value="48046">
            <input type="hidden" name="z24_nazwa" value="<?php echo $_POST['tytul_platnosci'] ?>">
            <input type="hidden" name="z24_crc" value="da0bb415"> 
            <input type="hidden" name="z24_return_url" value="http://novahurt.pl/index.php#start"> 
            <input type="hidden" name="z24_language" value="pl"> 
            <input type="hidden" name="z24_kwota" value="<?php echo $oplata ?>"> 
            <input type="hidden" name="z24_opis" value="<?php echo $_SESSION['dodatkowe'] ?>"> 
            <input type="hidden" name="k24_nazwa" value="<?php echo $_SESSION['imie'] .' '. $_SESSION['nazwisko'] ?>"> 
            <input type="hidden" name="k24_email" value="<?php echo $_SESSION['email']?>">
            <input type="hidden" name="k24_phone" value="<?php echo $_SESSION['telefon']?>">
            <input type="hidden" name="k24_kraj" value="Polska">
            <input type="hidden" name="k24_kod" value="<?php echo $_SESSION['kod_pocztowy']?>">
            <input type="hidden" name="k24_miasto" value="<?php echo $_SESSION['miejscowosc']?>">
            <input type="hidden" name="k24_ulica" value="<?php echo $_SESSION['ulica']?>">
            <input type="hidden" name="k24_numer_dom" value="<?php echo $_SESSION['nr_budynku']?>">
            <input type="hidden" name="k24_numer_lok" value="<?php echo $_SESSION['nr_mieszkania']?>">
    
                
                
            <input id="dalej_guzik_do_wysylki" type="submit" name="place" value="PŁACĘ"/>
            </form>