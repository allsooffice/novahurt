<!DOCTYPE HTML>
<?php
$data = date("m")-1;
include('db_connect.php');
//usuwanie pustych ogloszen
$where = "WHERE status = 'koszyk' AND telefon <> ''";

$pobieranie = $mysqli->query("SELECT * FROM sell $where ORDER BY id DESC");
$liczba_wierszy = mysqli_num_rows($pobieranie);
?>
<h2 style="margin-top: 15px;">Niesfinalizowane (<?php echo $liczba_wierszy ?>)</h2>
                <table style="font-size: 13px;">
                    <tr>
                        <th>Sygnatura</th>
                        <th>Produkt</th>
                        <th>Kupujący</th>
                        <th>E-mail</th>
                        <th>Płatność</th>
                        <th>Status płatności</th>
                        <th>Data transakcji</th>
                        <th>Kwota transakcji</th>
                    </tr>
                    <?php
						 $i = 1;
                    $pobieranie = $mysqli->query("SELECT * FROM sell $where ORDER BY id DESC");
                    while ($produkt=mysqli_fetch_array($pobieranie))
                    {
							  $sygnatura = $produkt['sygnatura'];
							  $id_transakcji = $produkt['id'];
							  $status_platnosci = $produkt['payment_status'];
							  $session_id = $produkt['session_id'];
							  if($status_platnosci == '')
							  {
								  $status_platnosci = '<i class="icon-money-1" style="color: orange; font-size: 22px;" title="Płatność poza systemem PolCard"></i>';
							  }
							  
							  else if($status_platnosci == 'Opłacone')
							  {
								  $status_platnosci = '<i class="icon-money-1" style="color: forestgreen; font-size: 22px;" title="Wpłata zaksięgowana"></i>';
							  }
							  
							  else if($status_platnosci == 'Nieopłacone')
							  {
								  $status_platnosci = '<i class="icon-money-1" style="color: red; font-size: 22px;" title="Nieopłacone"></i>';
							  }
							  if($i % 2 == 0)
							  {
                        echo '
                        <tr>';
							  }
								 else
								 {
									echo '
                        <tr class="second">'; 
								 }
                        echo '<td><label><input type="checkbox" class="check-order" name="'.$id_transakcji.'"/> '.$produkt['sygnatura'].'</labeL></td><td class="sold-products">';
                        $pobieranie_produktu = $mysqli->query("SELECT * FROM card where session_id = '$session_id'");
                    while ($lista_produkt=mysqli_fetch_array($pobieranie_produktu))
                    {
							  $id_produktu = $lista_produkt['id_produktu'];
							  $sztuk = $lista_produkt['quantity'];
							  $pobieranie_nazwy_produktu = $mysqli->query("SELECT * FROM produkty where id = '$id_produktu'");
                    while ($nazwa_produktu=mysqli_fetch_array($pobieranie_nazwy_produktu))
                    {
							  echo '&#9679; '.$nazwa_produktu['model'].' x '.$sztuk.'</br>';
						  }
							  
						  }
                        echo '</td><td class="sold-customer">'.$produkt['customer'].' '.$produkt['nazwisko'].'<br>'.$produkt['kod_pocztowy'].' '.$produkt['miejscowosc'].'<br>'.$produkt['ulica'].' '.$produkt['numer_budynku'].'';
							  if($produkt['numer_lokalu'] != '')
							  {
								  echo ' / '.$produkt['numer_lokalu'];
							  }
							  echo '<br>tel: '.$produkt['telefon'].'<a class="delet-order"><i class="icon-trash" title="Usuń" order="'.$produkt['id'].'" session="'.$produkt['session_id'].'"></i></a></td>
                        <td class="sold-email">'.$produkt['mail'].'</td>
                        <td>'.$produkt['sposob_platnosci'].'</td>
                        <td>'.$status_platnosci.'</td>
                        <td>'.$produkt['data'].'</td>
                        <td>'.$produkt['suma_zamowienia'].'.00 zł</td>
                        </tr>
                        ';
							  $i++;
                    }
                    ?>

                </table>
                <?php
   if($liczba_wierszy < 1)
                     {
                        echo '<h2>Brak nowych transakcji</h2>';
                     }
?>