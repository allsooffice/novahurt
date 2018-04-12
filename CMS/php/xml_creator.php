<?php
include('db_connect.php');
$data = date("Y-m-d");
$xml = '<?xml version="1.0" encoding="UTF-8"?>
<transactions>
';
if(isset($_GET['id']))
{			$where = 'WHERE';
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

 $pobieranie = $mysqli->query("SELECT * FROM sell $where");
                    while ($produkt=mysqli_fetch_array($pobieranie))
                    {
							  $sygnatura = $produkt['sygnatura'];
							  $sposob_platnosci = $produkt['sposob_platnosci'];
							  if($sposob_platnosci == 'Przy pobraniu kurierowi')
							  {
								  $delivery = 'Przesyłka kurierska pobraniowa';
								  $payment = 'Przy odbiorze (za pobraniem)';
							  }
							  else
							  {
								  $delivery = 'Przesyłka kurierska';
								  $payment = 'Płatność elektroniczna';
							  }
$xml .= '
 <transaction>
  <parentId/>
  <Id>'.$produkt['id'].'</Id>
  <Name>';
							  
$pobieranie_produktu = $mysqli->query("SELECT * FROM card where session_id = '$sygnatura'");
while ($lista_produkt=mysqli_fetch_array($pobieranie_produktu))
{
$id_produktu = $lista_produkt['id_produktu'];
$sztuk = $lista_produkt['quantity'];
$pobieranie_nazwy_produktu = $mysqli->query("SELECT * FROM produkty where id = '$id_produktu'");
while ($nazwa_produktu=mysqli_fetch_array($pobieranie_nazwy_produktu))
{
	$xml .= ''.$nazwa_produktu['model'].' x '.$sztuk.', ';
}

}
  $xml .= '</Name>
  <OrderId>'.$produkt['id'].'</OrderId>
  <CustomerLogin>'.$produkt['customer'].' '.$produkt['nazwisko'].'</CustomerLogin>
  <CustomerEmail>'.$produkt['mail'].'</CustomerEmail>
  <CustomerName>'.$produkt['customer'].' '.$produkt['nazwisko'].'</CustomerName>
  <CustomerPhone>'.$produkt['telefon'].'</CustomerPhone>
  <CustomerAddress>'.$produkt['ulica'].' '.$produkt['numer_budynku'].'5/31</CustomerAddress>
  <CustomerZip>'.$produkt['kod_pocztowy'].'</CustomerZip>
  <CustomerCity>'.$produkt['miejscowosc'].'</CustomerCity>
  <CustomerCountryCode>PL</CustomerCountryCode>
  <CustomerCountryName>Polska</CustomerCountryName>
  <RecipientName>'.$produkt['customer'].' '.$produkt['nazwisko'].'</RecipientName>
  <RecipientCompanyName/>
  <RecipientPhone>'.$produkt['telefon'].'</RecipientPhone>
  <RecipientAddress>'.$produkt['ulica'].' '.$produkt['numer_budynku'].'</RecipientAddress>
  <RecipientZip>'.$produkt['kod_pocztowy'].'</RecipientZip>
  <RecipientCity>'.$produkt['miejscowosc'].'</RecipientCity>
  <RecipientCountryCode>PL</RecipientCountryCode>
  <RecipientCountryName>Polska</RecipientCountryName>
  <InvoiceName/>
  <InvoiceCompanyName/>
  <InvoiceAddress/>
  <InvoiceZip/>
  <InvoiceCity/>
  <InvoiceCountryCode/>
  <InvoiceCountryName/>
  <VAT-ID/>
  <Total>'.$produkt['suma_zamowienia'].'</Total>
  <Currency>PLN</Currency>
  <ExchangeRate>1</ExchangeRate>
  <SellDate>'.$data.'</SellDate>
  <DeliveryCost>0</DeliveryCost>
  <DeliveryType>'.$delivery.'</DeliveryType>
  <PaymentType>'.$payment.'</PaymentType>
  <SellerId>42751817</SellerId>
  <positions>
   <position>
    <transactionId>'.$sygnatura.'</transactionId>
    <Name/>
    <Quantity>1</Quantity>
    <Price>'.$produkt['suma_zamowienia'].'</Price>
    <OfferName>Novahurt.pl</OfferName>
    <Signature/>
   </position>
  </positions>
 </transaction>
 ';
						  }

 $xml .= '</transactions>';
 
 //tworzenie i zapisywanie pliku
$noweDane = $sygnatura;
$fp = fopen("../download/zamowienia.xml", "w");
fputs($fp, $xml);
fclose($fp);
}
?>




