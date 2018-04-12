<!DOCTYPE HTML>
<?php
session_start();
if($_SESSION['zalogowany'] != true)
{
   header('Location: index.php');
}
$data = date("Y-m-d H:i:s");
include('php/db_connect.php');
?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Niesfinalizowane - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link href="style/sold.css" rel="stylesheet" type="text/css" />
	<link href="style/sprzedane.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style/loading.css"/>
	<link href="fontello/css/fontello.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>
<style>
	h1{
		margin-top: 20px;
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
            <div class="display-list">
            </div>
        </div>
            
        <div style="clear: both;"></div>
        

        
    </div>
</body>
<script src="js/menu.js"></script>
<script src="js/unfinished-order-list.js"></script>
<script>
		$("#unfinished").addClass("active-color");
		$("#unfinished").parent().addClass("menu-active");
</script>
</html>