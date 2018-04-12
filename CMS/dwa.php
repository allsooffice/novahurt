<!DOCTYPE HTML>
<?php
session_start();
$data = date("Y-m-d H:i");
$_SESSION['user_session_id'] = session_id();
$_SESSION['article_id'] = 1;
include('php/db_connect.php');
if(isset($_POST['element']))
{   $i = 1;
    foreach ($_POST['element'] as $id)
    {

    echo $id.'<br>';
    $i++;
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
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style/loading.css"/>
	<link href="fontello/css/fontello.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>


<form method="post" >
 
<ul>
<li><input type="hidden" name="element[]" value="21" />cos1</li>
<li><input type="hidden" name="element[]" value="22" />cos2</li>
<li><input type="hidden" name="element[]" value="23" />cos3</li>
<li><input type="hidden" name="element[]" value="24" />cos4</li>

</ul>
<input type="submit">
</form>
<body>
    <div class="wrapper">
        <div class="menu">
           <h2><i class="icon-menu"></i> Menu</h2>
            <ul id="menu-list">
                <li><i class="icon-plus"></i> Artykuły</li>
                    <div class="menu-hidden">
                        <div id="new-article" class="links">&#9679; Nowy</div>
                        <div id="edit-article" class="links">&#9679; Edytuj</div>
                        <div class="links">&#9679; Archiwum</div>
                    </div>
                
                <li><i class="icon-plus"></i>Statystyki</li>
                    <div class="menu-hidden">
                        <div class="links">&#9679; Nowy</div>
                        <div class="links">&#9679; Edytuj</div>
                        <div class="links">&#9679; Archiwum</div>
                    </div>
                
                <li><i class="icon-plus"></i>Ustawienia</li>
            </ul>
        </div>
        <!-- <div class="content">
            <h1>Dodaj artykuł</h1>
            <div class="add-image-place">
                <div class="image-place">
                 
                </div>
            
                <form id="add-image-form" action="php/upload_img.php" method="post">
                    <input type="file" id="add-image" name="file" multiple>
                    <label class="add-image-label" for="add-image"><i class="icon-plus"></i>Dodaj obraz</label>
                </form>
                <div style="clear: both;"></div>
            </div>
            <i class="fa fa-refresh ld ld-spin"></i>
        </div> -->
        <div class="pokaz"></div>
        <div style="clear: both;"></div>
        

        
    </div>
</body>
<script src="js/menu.js"></script>
</html>