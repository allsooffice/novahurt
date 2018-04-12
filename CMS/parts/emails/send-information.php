 <?php  
$product = $mysqli->query("SELECT * FROM sell WHERE id = '$order_id'");
    while ($dane_zam=mysqli_fetch_array($product) ) 
    {
      $imie = $dane_zam['customer'];
      $sygnatura = $dane_zam['sygnatura'];
    }

//MAIL DO KLIENTA
   
   $subj_client = 'Zamówienie '.$sygnatura.' jest w trakcie realizacji - NOVA HURT';
	 $message_client ='
            
            <center><table border="1" style="background-color:#99cc00;border-collapse:collapse;border:1px solid #99cc00;color:#FFFFFF;width:100%" cellpadding="25" cellspacing="3">
            <tr>
                <td><h1><b><center>Witaj '.$imie.'! </center></b></h1>
                <center>Pragniemy poinformować, że zamowienie jest w trakcie realizacji i lada moment przekażemy je kurierowi!</center>
                </td>
            </tr>
           
        <tr><td>
        <br>
        <center>
        <b>Dane do przelewu:</b><br>
            POLTRADE EXPERT<br>
            ul. Wilcza 6<br>
            15-509 Sobolewo<br>
            Bank : mBank<br>
            Nr konta: 68 1140 2004 0000 3502 7644 1716<br>
            Tytuł pprzelewu: ' . $sygnatura . '<br><br>
            
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
        
        mail($mail_to_send, $subj_client, $message_client, $headers_client);
?>