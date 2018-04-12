<!DOCTYPE HTML>
<?php
session_start();
if(isset($_POST['password']))
{
   $password = 'Lugano2016$';
   $user_password = $_POST['password'];
   if($user_password == $password)
   {
		$_SESSION['zalogowany'] = true;
		header('Location: lista_produktow.php');
   }
   else
   {
      $error = 'Błąd logowania';
   }
}

?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/login.css" rel="stylesheet" type="text/css" />
	<link href="fontello/css/fontello.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <div class="login">
        <form method="post">
         <input class="password" type="password" name="password" placeholder="Hasło"><br/>
         <input class="log" type="submit" value="Zaloguj">
        </form>
        <h3 class="error">
        <?php if(isset($error)) {echo $error; unset($error);} ?>
        </h3>
        </div>
    </div>
</body>

</html>