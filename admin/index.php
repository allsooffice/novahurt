<!DOCTYPE HTML>

<?php
session_start();
$poprawne = true;

$klucz = "patryk1993";

if (isset($_POST['haslo']))
{

$podane_haslo = strip_tags($_POST['haslo']);
    
if ($podane_haslo != $klucz) 
{
    $poprawne = false;
    $_SESSION['e_haslo'] = "Błędne hasło.";
    
}
    if ($poprawne==true)
    {
    
        if ($podane_haslo == $klucz)
            {
            $_SESSION['zalogowany'] = true;
            header('Location: admin.php');
            }

    }
    
}
?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Administracja - NOVAHURT</title>
	<meta name="description" content="Hurtownia Towarów Wielobranżowych Białystok" />
	<meta name="keywords" content="" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->

</head>

<body>
   <div id="contener">
 

   
       

       <div id="logowanie"> 
        Logowanie
            
        <form method="post"> 
            <input class="formularz_logowanie" type="password" name="haslo" placeholder="Hasło" autofocus/><br>
            
                <?php
                            if (isset($_SESSION['e_haslo']))
                            {
                                echo '<div class="error">'. $_SESSION['e_haslo'].'</div>';
                                unset ($_SESSION['e_haslo']);    
                            }
                            ?>
            <input id="logowanie_admin"  type="submit" value="ZALOGUJ"/>
        </form>   
        
            
        
        
    </div>
       
    </div> 
    
    <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div> 
    


</body>


</html>