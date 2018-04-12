<?php
include('db_connect.php');
$numer = $mysqli->query("SELECT number FROM order_number WHERE id = 1 ");
while ($pokaz=mysqli_fetch_array($numer) )
{
$new_number = $pokaz['number'];

}
echo '<input type="hidden" id="order-id" value="'.$new_number.'">';
?>