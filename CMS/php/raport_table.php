<!DOCTYPE HTML>
<?php
include('db_connect.php');
$pobieranie = $mysqli->query("SELECT DISTINCT data FROM closed_sold ORDER BY data DESC LIMIT 1");
while ($produkt=mysqli_fetch_array($pobieranie))
{
	$month = date("m",strtotime($produkt['data']));
	$year = date("Y",strtotime($produkt['data']));
}

$m = $month;
$y = $year;
//usuwanie pustych ogloszen
$where = "WHERE MONTH(data) = '$m' AND YEAR(data) = '$y'";
if(isset($_GET['mounth']))
{
	$month_and_year = explode(".", $_GET['mounth']);
	$m = $month_and_year[0];
	$y = $month_and_year[1];
   $where = "WHERE MONTH(data) = '$m' AND YEAR(data) = '$y'";
}

if(isset($_GET['shop']))
{
    if($_GET['shop'] == 'allegro')
    {
        $where .= " AND allegro > 0";
    }
    if($_GET['shop'] == 'olx')
    {
        $where .= " AND olx > 0";
    }
    if($_GET['shop'] == 'poza')
    {
        $where .= " AND poza > 0";
    }
	if($_GET['shop'] == 'facebook')
    {
        $where .= " AND facebook > 0";
    }
}

if(isset($_GET['order']))
{
    if($_GET['order'] == 'name')
    {
        $where .= " ORDER BY product ASC";
    }
    if($_GET['order'] == 'sold-asc')
    {
        $where .= " ORDER BY quantity ASC";
    }
    if($_GET['order'] == 'sold-desc')
    {
        $where .= " ORDER BY quantity DESC";
    }
    if($_GET['order'] == 'profit-asc')
    {
        $where .= " ORDER BY zysk_brutto ASC";
    }
    if($_GET['order'] == 'profit-desc')
    {
        $where .= " ORDER BY zysk_brutto DESC";
    }

}
?>
                <table>
                    <tr>
                        <th>Produkt</th>
                        <th>Sztuk</th>
                        <th>Allegro</th>
                        <th>NOVA HURT</th>
                        <th>Poza Allegro</th>
                        <th>Facebook</th>
                        <th>Sprzedaż</th>
                        <th>Zakup</th>
                        <th>Zysk brutto</th>
                    </tr>
                    <?php
                    $total_quantity = 0;
                    $total_allegro = 0;
                    $total_olx = 0;
                    $total_poza = 0;
                    $total_facebook = 0;
                    $total_zakup = 0;
                    $total_sprzedaz = 0;
                    $total_zysk = 0;
                    $pobieranie = $mysqli->query("SELECT * FROM closed_sold $where");
                    while ($produkt=mysqli_fetch_array($pobieranie))
                    {
                        if($_GET['shop'] == 'allegro')
                        {
                          $quantity = $produkt['allegro'];
                          $allegro = $produkt['allegro'];
                          $olx = 0;
                          $poza = 0;
                          $facebook = 0;
                          $sprzedaz = $produkt['sprzedaz_allegro'];
                          $zakup = $produkt['zakup_allegro'];
                          $zysk = $sprzedaz - $zakup;
                        }
                        if($_GET['shop'] == 'olx')
                        {
                          $quantity = $produkt['olx'];
                          $allegro = 0;
                          $olx = $produkt['olx'];
                          $poza = 0;
                          $facebook = 0;
                          $sprzedaz = $produkt['sprzedaz_olx'];
                          $zakup = $produkt['zakup_olx'];
                          $zysk = $sprzedaz - $zakup;
                        }
                        if($_GET['shop'] == 'poza')
                        {
                          $quantity = $produkt['poza'];
                          $allegro = 0;
                          $olx = 0;
                          $poza = $produkt['poza'];
                          $facebook = 0;
                          $sprzedaz = $produkt['sprzedaz_poza'];
                          $zakup = $produkt['zakup_poza'];
                          $zysk = $sprzedaz - $zakup;
                        }
							  
							  if($_GET['shop'] == 'facebook')
                        {
                          $quantity = $produkt['facebook'];
                          $allegro = 0;
                          $olx = 0;
                          $poza = 0;
								  $facebook = $produkt['facebook'];
                          $sprzedaz = $produkt['sprzedaz_facebook'];
                          $zakup = $produkt['zakup_facebook'];
                          $zysk = $sprzedaz - $zakup;
                        }
							  
                        if($_GET['shop'] == 'all')
                        {
                          $quantity = $produkt['allegro'] + $produkt['olx'] + $produkt['poza'];
                          $allegro = $produkt['allegro'];
                          $olx = $produkt['olx'];
                          $poza = $produkt['poza'];
                          $facebook = $produkt['facebook'];
                          $sprzedaz = $produkt['sprzedaz_poza'] + $produkt['sprzedaz_olx'] + $produkt['sprzedaz_allegro'] + $produkt['sprzedaz_facebook'];
                          $zakup = $produkt['zakup_allegro'] + $produkt['zakup_olx'] + $produkt['zakup_poza'] + $produkt['zakup_facebook'];
                          $zysk = $sprzedaz - $zakup;
                        }
                        echo '
                        <tr>
                        <td>'.$produkt['product'].'</td>
                        <td>'.$quantity.'</td>
                        <td>'.$allegro.'</td>
                        <td>'.$olx.'</td>
                        <td>'.$poza.'</td>
                        <td>'.$facebook.'</td>
                        <td>'.$sprzedaz.'</td>
                        <td>'.$zakup.'</td>
                        <td>'.$zysk.'</td>
                        </tr>
                        ';
                        $total_quantity = $total_quantity + $quantity;
                        $total_allegro = $total_allegro + $allegro;
                        $total_olx = $total_olx + $olx;
                        $total_poza = $total_poza + $poza;
                        $total_facebook = $total_facebook + $facebook;
                        $total_sprzedaz = $total_sprzedaz + $sprzedaz;
                        $total_zakup = $total_zakup + $zakup;
                        $total_zysk = $total_zysk + $zysk;
                    }
                    ?>
                    
                    <tr>
                        <th>Suma</th>
                        <th><?php echo $total_quantity; ?></th>
                        <th><?php echo $total_allegro; ?></th>
                        <th><?php echo $total_olx; ?></th>
                        <th><?php echo $total_poza; ?></th>
                        <th><?php echo $total_facebook; ?></th>
                        <th><?php echo $total_sprzedaz; ?></th>
                        <th><?php echo $total_zakup; ?></th>
                        <th><?php echo $total_zysk; ?></th>
                    </tr>
                </table>