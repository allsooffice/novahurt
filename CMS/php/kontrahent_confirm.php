<?php
session_start();
include('db_connect.php');
if(isset($_GET['custid']))
{
	$status = '<i class="icon-ok"></i>Zaakceptowany - hasło wysłane';
	$id = $_GET['custid'];
	$licznik = "UPDATE kontrahenci SET status = '$status' WHERE id = $id";
	  // wykonanie dodawania do bazy
	$licze = $mysqli->query($licznik);
	//WYSYŁANIE MAILA Z HASŁEM
	$rezultat = $mysqli->query("SELECT * FROM kontrahenci WHERE id = '$id'");
                
                while ($zamowienie=mysqli_fetch_array($rezultat) ){
                 $email = $zamowienie['email'];  
                }
    
        $to = $email;
        
        $subj = "Hasło do Panelu Kontrahenta Hurtowego - NOVA HURT";
    
        $message = '
        
        <center><table border="1" style="background-color:#99cc00;border-collapse:collapse;border:1px solid #99cc00;color:#FFFFFF;width:100%" cellpadding="25" cellspacing="3">
            <tr>
                <td><h1><b><center>Hasło do Panelu Kontrahenta Hurtowego</center></b></h1></td>
            </tr>
            <tr>
                <td>
                <center>
                <font size="4">Dziękujemy za rejestracje i wybór naszej hurtowni.<br>
                Hasło do panelu: <b>PKHNVT2017$</b><br>
                <a href="http://novahurt.pl/pkh/logowanie.php#start" target="_blank">Link do logowania</a><br><br>
                Prosimy nie odpowiadac na tą wiadomość.<br><br>
                Życzymy udenej współpracy - zespół <b>NOVAHURT</b>.pl</font>
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
}

?>




