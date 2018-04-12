<?php
if(isset($_POST['name']))
{
    include('db_connect.php');
    $name = $_POST['name'];
    $dodawanie = "INSERT INTO `magazynierzy` (`id`, `name`) VALUES (NULL, '$name')";
    //wykonanie dodawania do bazy
    $wynik = $mysqli->query($dodawanie);
    echo $name;
    
}

if(isset($_POST['delete']))
{
    $id = $_POST['delete'];
    include('db_connect.php');
    $usuwanie = "DELETE FROM magazynierzy WHERE id = $id";
    // wykonanie usuwania z bazy
    $wynik = $mysqli->query($usuwanie);    
}

if(isset($_GET['show_list']))
{
    include('db_connect.php');
    $pobieranie = $mysqli->query("SELECT * FROM magazynierzy");
    $i = 1;
     while ($produkt=mysqli_fetch_array($pobieranie) )
     {
    echo '
    <tr>
        <td>'.$i.'</td>
        <td>'.$produkt['name'].'</td>
        <td><i name="'.$produkt['id'].'" class="icon-trash"></i></td>
    </tr>';
         $i++;
    }
}
