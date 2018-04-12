<!DOCTYPE HTML>
<?php
session_start();
if($_SESSION['zalogowany'] != true)
{
   header('Location: index.php');
}
$data = date("Y-m-d H:i:s");
$_SESSION['user_session_id'] = session_id();
include('php/db_connect.php');



$usuwanie = "DELETE FROM magazyn WHERE data_pakowania < SUBDATE(NOW(), INTERVAL 60 DAY)";
// wykonanie usuwania z bazy
$wynik = $mysqli->query($usuwanie);

?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Weryfikacja pakowania - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style/loading.css"/>
	<link href="fontello/css/fontello.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>
<style>
	input
	{
		margin-top: 10px;
		height: 30px;
		padding: 2px;
		font-size: 22px;
		width: 150px;
	}
	
	.list
	{
		margin-top: 30px;
		border: 1px solid #38B0DE;
		box-sizing: border-box;
		padding: 5px;
		width: 825px;
		margin-left: auto;
		margin-right: auto;
		border-radius: 4px;
		font-size: 20px;
	}
	.row:after
	{
		content: '';
		display: block;
		clear: both;
	}
	.row > div
	{
		float: left;
	}
	
	.number
	{
		width: 200px;
	}
	
	.date
	{
		width: 200px;
	}
	
	.quantity
	{
		width: 200px;
	}
	
	.packed
	{
		width: 200px;
	}
	
	.error
	{
		background-color: crimson;
		color: #ffffff;
		width: 300px;
		box-sizing: border-box;
		padding: 4px;
		margin: 10px auto;
		border-radius: 4px;
	}
	
	.first
	{
		background-color: #38B0DE;
		color: #ffffff;
		padding: 2px;
		box-sizing: border-box;
	}
	
	.listing
	{
		margin: 10px 0;
		background-color: #f9f9f9;
		padding: 2px 0;
		box-sizing: border-box;
	}
</style>
<body>
     <?php
            include('parts/log_out.php');
      ?>
    <div class="wrapper">
       
        <div class="menu">
          
           <h2><i class="icon-menu"></i> Menu</h2>
           <?php
            include('parts/menu.php');
            ?>
            
        </div>
        <div class="content">
            <h1>Weryfikacja pakowania:</h1>
					Numer zamówienia:<br><input type="text" placeholder="Numer zamówienia">
				 <button class="btn" type="button">Szukaj</button>
				 <div class="list">
					Podaj numer zamówienia którego szukasz.
				 </div>
		 </div>
    </div>
</body>
<script src="js/menu.js"></script>
<script>
	$(".btn").click(function(){
		var input = $("input").val();
		if(input.length < 4)
			{
				$(".list").html('<div class="error">Za mało znaków</div>');
			}
		else
			{
				$(".list").load("php/magazin_check.php?order="+input);
			}
	});
</script>
<script>
		$("#mag-wer").parent().addClass("menu-active");
		$("#mag-wer").addClass("active-color");
</script>
</html>