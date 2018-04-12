<?php
include('db_connect.php');

$data_platnosci = date('d.m.y H:i');
if(isset($_POST['pos_id']))
{
    $order = $_POST['order_id'];
    $session = $_POST['session_id'];
    $kwota = $_POST['amount'];
    $status = $_POST['response_code'];
    $zaplacono = false;
    if($status == '20')
    {
       $status = 'Transakcja zainicjowana';
    }
    if($status == '30')
    {
       $status = '<span style="color: forestgreen;">Zapłacono</span>';
       $zaplacono = true;
    }
    if($status == '35')
    {
       $status = '<span style="color: forestgreen;">Zapłacono</span>';
       $zaplacono = true;
    }
    if($status == '40')
    {
       $status = '<span style="color: red;">Transakcja odrzucona</span>';
    }
    if($status == '21')
    {
       $status = '<span style="color: red;">Błąd technichniczny</span>';
    }
    $fdp_id = $_POST['transaction_id'];
    $hash_platnosci_karta = $_POST['cc_number_hash'];
    $bin_karty = $_POST['bin'];
    $typ_karty = $_POST['card_type'];
    $kod_autoryzacji = $_POST['auth_code'];
    $wygenerowany_klucz = $_POST['controlData'];
    $kwota = $kwota / 100;
    
    $product = $mysqli->query("SELECT * FROM sell WHERE id = '$order'");
    while ($dane_zam=mysqli_fetch_array($product) ) 
    {
      $imie = $dane_zam['customer'];
      $nazwisko = $dane_zam['nazwisko'];
      $kod_pocztowy = $dane_zam['kod_pocztowy'];
      $miejscowosc = $dane_zam['miejscowosc'];
      $ulica = $dane_zam['ulica'];
      $numer_budynku = $dane_zam['numer_budynku'];
      $numer_lokalu = $dane_zam['numer_lokalu'];
      $sposob_dostawy = $dane_zam['sposob_dostawy'];
      $sposob_platnosci = $dane_zam['sposob_platnosci'];
      $ubezpieczenie = $dane_zam['ubezpieczenie'];
      $dokument = $dane_zam['dokument'];
      $ankieta = $dane_zam['ankieta'];
      $dodatkowe = $dane_zam['dodatkowe'];
      $suma_zamowienia = $dane_zam['suma_zamowienia'];
      $cena_dostawy = $dane_zam['cena_dostawy'];
      $data_zam = $dane_zam['data'];
      $sygnatura = $dane_zam['sygnatura'];
      if($numer_lokalu != '')
      {
          $numer_lokalu = ' / '.$numer_lokalu;
      }
      $email = $dane_zam['mail'];
      $telefon = $dane_zam['telefon'];
      $zakup_produktow = $suma_zamowienia - $cena_dostawy - $ubezpieczenie;
    }
    
        $to = 'info@novahurt.pl';
        $subj = 'Nowe zamówienie NOVA HURT - '.$sygnatura;
        $message = 
        '<table style="border-collapse: collapse; border: 1px solid black;">
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Zamówienie: </td><td style="border: 1px solid black; padding: 5px;">'.$sygnatura.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Data zamówienia: </td><td style="border: 1px solid black; padding: 5px;">'.$data_zam.'</td>
            </tr>
				<tr style="border: 1px solid black; font-size: 22px;">
                <td style="border: 1px solid black; padding: 5px;">Sposób płatności: </td><td style="border: 1px solid black; padding: 5px;">'.$sposob_platnosci.'</td>
            </tr>
            <tr style="border: 1px solid black; font-size: 22px;">
                <td style="border: 1px solid black; padding: 5px;">Status płatności: </td><td style="border: 1px solid black; padding: 5px;">'.$status.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Adres dostawy: </td><td style="border: 1px solid black; padding: 5px;">'.$imie.' '.$nazwisko.'</br>'.$kod_pocztowy.' '.$miejscowosc.'<br>'.$ulica.' '.$numer_budynku.' '.$numer_lokalu.'</br>tel. '.$telefon.'<br>email: '.$email.'</td>
            </tr>
            <tr style="border: 1px solid black;"><td style="border: 1px solid black; padding: 5px;">Sprzedaż: </td><td style="border: 1px solid black; padding: 5px;">';
            $produkty = $mysqli->query("SELECT * FROM card WHERE order_id = '$order'");
            while ($wypisz=mysqli_fetch_array($produkty) ) 
            {
              $id_produktu = $wypisz['id_produktu'];
              $sztuk = $wypisz['quantity'];
              $piece_price = $wypisz['piece_price'];
              $product_name = $mysqli->query("SELECT * FROM produkty WHERE id = '$id_produktu'");
            while ($model=mysqli_fetch_array($product_name) ) 
            {
                $message .= $model['model'].' x '.$sztuk.' ['.$piece_price.' zł / szt.]<br>';
            }
            }
            $message .= '</td></tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Cena zakupów: </td><td style="border: 1px solid black; padding: 5px;">'.$zakup_produktow.'.00 zł</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Koszt dostawy: </td><td style="border: 1px solid black; padding: 5px;">'.$cena_dostawy.'.00 zł</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Ubezpieczenie przesyłki: </td><td style="border: 1px solid black; padding: 5px;">'.$ubezpieczenie.'.00 zł</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Sposób dostawy: </td><td style="border: 1px solid black; padding: 5px;">'.$sposob_dostawy.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Do zapłaty: </td><td style="border: 1px solid black; padding: 5px;">'.$kwota.'.00 zł</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Data płatności: </td><td style="border: 1px solid black; padding: 5px;">'.$data_platnosci.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Skąd wie: </td><td style="border: 1px solid black; padding: 5px;">'.$ankieta.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Dokument zakupu: </td><td style="border: 1px solid black; padding: 5px;">'.$dokument.'</td>
            </tr>
            <tr style="border: 1px solid black;">
                <td style="border: 1px solid black; padding: 5px;">Dodatkowe informacje: </td><td style="border: 1px solid black; padding: 5px;">'.$dodatkowe.'</td>
            </tr>
            
        </table>';
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "Reply-to: ". $email ."\r\n";
        $headers .= "From: www.novahurt.pl <powiedomienia@novahurt.pl>\r\n";
        $headers .= "X-Sender: <powiedomienia@novahurt.pl>";
        
        mail($to, $subj, $message, $headers);
   //ZMIANA STATUSU W BAZIE
   if($status == '<span style="color: forestgreen;">Zapłacono</span>')
   {
      $dodawanie = "UPDATE sell SET payment_status = 'Opłacone', status = 'Nowe' WHERE id = '$order'";
      // wykonanie dodawania do bazy
      $wynik = $mysqli->query($dodawanie);
       
      $edit = "UPDATE card SET session_id = '$sygnatura' WHERE order_id = '$order'";
	   // wykonanie dodawania do bazy
	  $zmiana = $mysqli->query($edit);
   }
   else
   {
             
      $dodawanie = "UPDATE sell SET payment_status = 'Nieopłacone' WHERE id = '$order'";
      // wykonanie dodawania do bazy
      $wynik = $mysqli->query($dodawanie);
   }
   
   //MAIL DO KLIENTA
   
   $subj_client = 'Potwierdzenie zamówienia oraz płatności  '.$sygnatura.' - NOVA HURT';
	 $message_client ='
            
            <center><table border="1" style="background-color:#99cc00;border-collapse:collapse;border:1px solid #99cc00;color:#FFFFFF;width:100%" cellpadding="25" cellspacing="3">
            <tr>
                <td><h1><b><center>Dziękujemy za zakupy w naszym sklepie!</center></b></h1></td>
            </tr>
            <tr>
                <td>
                <center>
                Szczegóły zamówienia:<br><br>
                
                
        
        <table border="1" style="background-color:#99cc00;border-collapse:collapse;border:1px solid #99cc00;color:#FFFFFF;width:50%" cellpadding="25" cellspacing="3">
        <tr>
            <td>Sygnatura: </td>	<td>'. $sygnatura . '</td>
        </tr>
        <tr>
            <td>Data: </td>	<td>'. $data_zam . '</td>
        </tr>
        <tr>
            <td>Adres dostawy:</td>	<td>'.$imie.' '.$nazwisko.'</br>'.$kod_pocztowy.' '.$miejscowosc.'<br>'.$ulica.' '.$numer_budynku.' '.$numer_lokalu.'</br>tel. '.$telefon.'<br>email: '.$email.'</td>
        </tr>
        <tr>
            <td>Zakupy: </td>	<td>';
	 
	 $produkty = $mysqli->query("SELECT * FROM card WHERE order_id = '$order'");
            while ($wypisz=mysqli_fetch_array($produkty) ) 
            {
              $id_produktu = $wypisz['id_produktu'];
              $sztuk = $wypisz['quantity'];
              $piece_price = $wypisz['piece_price'];
              $product_name = $mysqli->query("SELECT * FROM produkty WHERE id = '$id_produktu'");
            while ($model=mysqli_fetch_array($product_name) ) 
            {
                $message .= $model['model'].' x '.$sztuk.' ['.$piece_price.'.00 zł / szt.]<br>';
            }
            }
	 $message_client .= '

        </tr>
        <tr>
            <td>Cena zakupów: </td>	<td>' . $zakup_produktow . '.00 zł</td>
        </tr>
        <tr>
            <td>Przesyłka: </td>	<td>' . $sposob_dostawy . '</td>
        </tr>
        <tr>
            <td>Ubezpieczenie przesyłki: </td>	<td>' . $ubezpieczenie . '.00 zł</td>
        </tr>
        <tr>
            <td>Koszt przesyłki: </td>	<td>' . $cena_dostawy . '.00 zł</td>
        </tr>
        <tr>
            <td>Rodzaj płatności: </td>	<td>' . $sposob_platnosci . '</td>
        </tr>
        <tr>
            <td>Do zapłaty: </td>	<td>' . $kwota . '.00 zł </td>
        </tr>
		  <tr>
            <td>Status płatnośći: </td>	<td>' . $status . '</td>
        </tr>
        <tr>
            <td>Dokument zakupu: </td>	<td>' . $dokument . '</td>
        </tr>
        <tr>
            <td>Dodatkowe informacje: </td>	<td>' .$dodatkowe. '</td>
        </tr>
        </table>
        <br>
        <b>Dane do przelewu:</b><br>
            POLTRADE EXPERT<br>
            ul. Wilcza 6<br>
            15-509 Sobolewo<br>
            Bank : mBank<br>
            Nr konta: 68 1140 2004 0000 3502 7644 1716<br>
            Tytuł pprzelewu: '  . $sygnatura . '<br><br>
            
        ---------------------------------------- Uwaga ważne !----------------------------------------------<br><br><br>

Nasz sklep istnieje od 2003 roku, jako internetowy od 2016. Codziennie obsługujemy setki klientów, cieszymy się że dołączyli Państwo do tego grona. Dziękujemy za zaufanie i uznanie. Z wielką starannością pakujemy i sprawdzamy wszystkie przedmioty, aby zabezpieczyć je przed ewentualnymi uszkodzeniami, oraz by wyeliminować wszelkie wady powstałe podczas transportu. Monitoring pakowania jest gwarancją na to, że każdy towar opuszczający nasze magazyny jest w idealnym stanie.<br><br>

UWAGA WAŻNE!<br>
Nie otwieraj przesyłki nożem.<br>
Sprawdź zawartość paczki w obecności kuriera
na wypadek uszkodzenia towaru !<br>
Jeżeli wystąpiło uszkodzenie - spisz protokół szkody przy kurierze!<br>
Reklamacja na wypadek uszkodzenia jest uwzględniana tylko na podstawie protokołu spisanego w momencie dostawy.<br> W celach uzyskania informacji o odszkodowaniu za uszkodzoną przesyłkę podczas transportu prosimy kierować do przedstawicieli firmy kurierskiej doręczającej przesyłki.<br><br>


Infolinia GLS: +48 46 814 82 20<br>
Infolinia GEIS: +48 22 212 28 00<br>
Infolinia UPS: +48 22 489 48 77<br><br>
        
        
        
        W razie pytań zapraszamy do kontkatu:<br>
        email: info@novahurt.pl<br>
        infolinia: 782 70 00 94<br>
        Pozdrawiamy - zespół NOVA HURT.pl
                
                </center>
                </td>
            </tr>
        </table></center>
        ';
	 		$headers_client  = 'MIME-Version: 1.0' . "\r\n";
        $headers_client .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers_client .= "Reply-to:info@novahurt.pl" . "\r\n";
        $headers_client .= "From: www.novahurt.pl <powiedomienia@novahurt.pl>\r\n";
        $headers_client .= "X-Sender: <powiedomienia@novahurt.pl>";
        
        mail($email, $subj_client, $message_client, $headers_client);
   
  
}
?>