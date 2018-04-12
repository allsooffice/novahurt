<?php
include('../../db_connect.php');

if (isset($_GET['id']))
{
    $id= $_GET['id'];
    $zmien = "UPDATE kontrahenci SET status = 'Zweryfikowano' WHERE id = $id";
                        // wykonanie dodawania do bazy
                        $wynik = $mysqli->query($zmien);
        
    
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
                <a href="http://www.novahurt.pl" target="_blank"><img src="http://novahurt.pl/pkh/jpg/email.jpg" width="" height="" align=""/></a>
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
    


    header('Location: ../kontrahenci.php#start');
            
}





?>