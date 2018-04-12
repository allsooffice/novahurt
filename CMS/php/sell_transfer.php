<?php
include('db_connect.php');
$data = date("Y-m-d");
if(isset($_GET['id']))
{			
$where = 'WHERE';
if(isset($_GET['move']))
{
$move = $_GET['move'];
	for($i=0;$i<count($_GET['id']);$i++)
	{
		if($i == 0)
			{
			$where .= ' id = '.$_GET['id'][$i];
			}
		else
			{
			$where .= ' OR id = '.$_GET['id'][$i]; 
			}
	}
$licznik = "UPDATE sell SET status = '$move' $where";
// wykonanie dodawania do bazy
$licze = $mysqli->query($licznik);
	echo '<p><i style="color: forestgreen;" class="icon-ok"></i>Zamówienia zostały przeniesione.</p>';
}

if(isset($_GET['message']))
{
$mail_to_send = '';   
$pobieranie = $mysqli->query("SELECT * FROM sell $where");
while ($produkt=mysqli_fetch_array($pobieranie))
{
   $order_id = $produkt['id'];
   $mail_to_send = $produkt['mail'];
	if($_GET['message'] == 'wysylka')
	{
		echo '<p><i style="color: forestgreen;" class="icon-ok"></i>Wiadomości z informacją o wysyłce zostały wysłane.</p>';
      include('../parts/emails/send-information.php');
	}
	
	else if($_GET['message'] == 'wplata')
	{
		echo '<p><i style="color: forestgreen;" class="icon-ok"></i>Wiadomości z informacją o nieudanej wpłacie zostały wysłane.</p>';
      include('../parts/emails/payment-error-information.php');
	}
}
}
 
}
?>




