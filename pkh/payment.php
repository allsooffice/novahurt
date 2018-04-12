<!DOCTYPE html>
<?php
session_start();
$_SESSION['id_klienta'] = session_id();
$sesja = $_SESSION['id_klienta'];
$ip = $_SERVER['REMOTE_ADDR'];
echo $ip;

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<form  method="post" action="payment_send.php"> 

<input type='text' name='pos_id' value="75384561"> 
<input type='text' name='order_id' value="0001"> 
<input type='text' name='session_id' value="<?php echo $sesja ?>"> 
<input type="text" name="amount" value="100"> 
<input type='text' name='currency' value="PLN">
<input type='text' name='test' value="Y">
<input type='text' name='language' value="pl">
<input type='text' name='client_ip' value="<?php echo $ip ?>">
<input type='text' name='street' value="Testowa ">
<input type='text' name='street_n1' value="12">
<input type='text' name='street_n2' value="23">
<input type='text' name='addr2' value="adres2">
<input type='text' name='addr3' value="adres3">
<input type='text' name='city' value="Białystok">
<input type='text' name='postcode' value="01-152">
<input type='text' name='country' value="PL">
<input type='text' name='email' value="pr@novahurt.pl">
<input type='text' name='ba_firstname' value="Jan">
<input type='text' name='ba_lastname' value="Kowalski">
<input type='text' name='controlData' value=""> 
<input class="button" type="submit" value="Place">

</form>

</body>
</html>