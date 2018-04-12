<?php
session_start();
include('db_connect.php');
if(isset($_GET['help']))
{
    $where = $_GET['help'];
}
else
{
    $where = '';
}
echo '<ul>';
$pobieranie = $mysqli->query("SELECT * FROM produkty WHERE model LIKE '%$where%' ORDER BY id DESC LIMIT 12");
                while ($produkt=mysqli_fetch_array($pobieranie) )
                {
                    echo '
                    <li name="'.$produkt['model'].'">'.$produkt['model'].'</li>';
                }

echo '</ul>';
?>




