
<?php
    //sprawdzenie ile jest rzeczy w koszyku
      $klient = $_SESSION['id_klienta'];
    $dubel = $mysqli->query("SELECT * FROM koszyk WHERE id_klienta = '$klient'");

    if (!$dubel) throw new Exception($mysqli->error);

    $ile_takich_produktow = $dubel->num_rows;

    if($ile_takich_produktow == 0)
    {
        
        $_SESSION['koszykZero'] = '<a href="../koszyk.php#start"><img src="../jpg/koszyk/pusty.jpg" width="35"> Koszyk</a>';
    }
    
    if($ile_takich_produktow == 1)
    {
        
        $_SESSION['koszyk'] = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/1.jpg" width="35"></a>';
    }

    if($ile_takich_produktow == 2)
    {
        
        $_SESSION['koszyk'] = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/2.jpg" width="35"></a>';
    }

     if($ile_takich_produktow == 3)
    {
        
        $_SESSION['koszyk'] = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/3.jpg" width="35"></a>';
    }

if($ile_takich_produktow == 4)
    {
        
        $_SESSION['koszyk'] = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/4.jpg" width="35"></a>';
    }

if($ile_takich_produktow == 5)
    {
        
        $_SESSION['koszyk'] = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/5.jpg" width="35"></a>';
    }

if($ile_takich_produktow == 6)
    {
        
        $_SESSION['koszyk'] = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/6.jpg" width="35"></a>';
    }

if($ile_takich_produktow == 7)
    {
        
        $_SESSION['koszyk'] = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/7.jpg" width="35"></a>';
    }

if($ile_takich_produktow == 8)
    {
        
        $_SESSION['koszyk'] = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/8.jpg" width="35"></a>';
    }

if($ile_takich_produktow == 9)
    {
        
        $_SESSION['koszyk'] = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/9.jpg" width="35"></a>';
    }

if($ile_takich_produktow > 9)
    {
        
        $_SESSION['koszyk'] = '<a href="../koszyk.php#start"> Koszyk <img src="../jpg/koszyk/9plus.jpg" width="35"></a>';
    }
?>