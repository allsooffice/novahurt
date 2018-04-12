<?php
session_start();
include('db_connect.php');
$i = 1;

$pobieranie = $mysqli->query("SELECT * FROM kontrahenci ORDER BY id DESC");
                $liczba_wierszy = mysqli_num_rows($pobieranie);
                if($liczba_wierszy > 0)
                {
                while ($produkt=mysqli_fetch_array($pobieranie) )
                {
                    if($i % 2 == 0)
                    {
                        echo '<div id="o-row-'.$produkt['id'].'" class="order-row">';
                    }
                    else
                    {
                        echo '<div id="o-row-'.$produkt['id'].'" class="order-row second">';
                    }
                    echo'
                    <div class="order-col id">
                        '.$i.'
                    </div>
                    <div class="order-col date">
                        '.$produkt['data'].'
                    </div>
                    <div class="order-col cust">
                        '.$produkt['nazwa_firmy'].'<br>
                        NIP: '.$produkt['nip'].'<br>
                        '.$produkt['kod_pocztowy'].' 
                        '.$produkt['miejscowosc'].'<br>
                        '.$produkt['ulica'].' 
                        '.$produkt['nr_budynku'];
						 if($produkt['nr_lokalu'] != '')
						 {
							 echo ' / '.$produkt['nr_lokalu'];
						 }
                    echo '</div>
                    <div class="order-col payment">
                        tel: '.$produkt['tel'].'<br>
                        <a href="mailto:'.$produkt['email'].'">'.$produkt['email'].'</a>
                    </div>';
						 if($produkt['status'] == 'nowy')
						 {
							 echo '<div class="order-col price new">';
						 }
						 
						 if($produkt['status'] == '<i class="icon-cancel"></i>Nieuznany')
						 {
							 echo '<div class="order-col price delete">';
						 }
						 mysq
						 else
						 {
							 echo '<div class="order-col price accepted">';
						 }
                    
                        echo $produkt['status'].'
                    </div>
                    <div class="order-col products">
							  '.$produkt['data'].'
						  </div>
                    <div class="order-col edit">
                        <span class="edit-button" id="'.$produkt['id'].'"><i class="icon-help"></i></span>
                    </div>
                    <div id="row-id-'.$produkt['id'].'" class="edit-menu">
                          <ol>
                              <li class="accept-order" name="'.$produkt['id'].'">Akceptuj</li>
                              <li class="delete-order" name="'.$produkt['id'].'">Odrzuć</li>
                          </ol>
                    </div>
                </div>';
                $i++;
                }
                }
else
{
    echo '<div class="no-records">Brak podobnych zamówień</div>';
}


?>




