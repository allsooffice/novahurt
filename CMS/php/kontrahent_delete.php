<?php
session_start();
include('db_connect.php');
if(isset($_GET['custid']))
{
	//WYSYŁANIE MAILA Z ODMOWĄ
			$id = $_GET['custid'];
		$rezultat = $mysqli->query("SELECT * FROM kontrahenci WHERE id = '$id'");
                
                while ($zamowienie=mysqli_fetch_array($rezultat) ){
                 $email = $zamowienie['email'];  
                }
    
        $to = $email;
        
        $subj = "Odmowa przyznania dostępu do Panelu Kontrahenta Hurtowego - NOVA HURT";
    
        $message = '
        
        <center><table border="1" style="background-color:#99cc00;border-collapse:collapse;border:1px solid #99cc00;color:#FFFFFF;width:100%" cellpadding="25" cellspacing="3">
            <tr>
                <td><h1><b><center>Nie uzyskałeś dostępu do panelu</center></b></h1></td>
            </tr>
            <tr>
                <td>
                <center>
                <font size="4">Dziękujemy za rejestracje i wybór naszej hurtowni.<br>
                Niestety po weryfikacji Państwa firmy nie jestesmy w stanie przyznac dostepu do panelu z powodu:<br>
						Do panelu dostep uzyskają tylko przedsiębiorstwa prowadzące sprzedaż produktów podobnych do wystepujących w naszej gamie. <br><br>
                Zapraszamy do zakupu detalicznego na <a href="http://www.novahurt.pl">novahurt.pl</a><br>
					 Pozdrawiamy - zespół <b>NOVAHURT</b>.pl</font>
                <br>
                <br>
                <br>
                Jeśli mają państwo jakieś pytania zapraszamy do kontaktu!<br>
                <br>
                </center>
                </td>
            </tr>
        </table></center>
        ';
        
        
    
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "From:NOVA HURT <powiedomienia@novahurt.pl>\r\n";
        $headers .= "X-Sender: <powiedomienia@novahurt.pl>";
        
        mail($to, $subj, $message, $headers);
	

	$status = '<i class="icon-cancel"></i>Nieuznany';
	$id = $_GET['custid'];
	$licznik = "UPDATE kontrahenci SET status = '$status' WHERE id = $id";
	  // wykonanie dodawania do bazy
	$licze = $mysqli->query($licznik);
}

?>




