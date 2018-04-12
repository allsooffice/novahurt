<!DOCTYPE HTML>
<?php
session_start();
if($_SESSION['zalogowany'] != true)
{
   header('Location: index.php');
}
?>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Dodaj / usuń magazyniera - Panel Administracyjny</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style/loading.css"/>
	<link href="fontello/css/fontello.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<style>
        input{
            width: 350px;
            margin-left: auto;
            margin-right: auto;
            height: 40px;
            font-size: 18px;
        }
        table.blueTable {
          border: 1px solid #1C6EA4;
          background-color: #EEEEEE;
          width: 400px;
          text-align: left;
            margin-left: auto;
            margin-right: auto;
            margin-top: 40px;
            text-align: center;
        }
        table.blueTable td, table.blueTable th {
          border: 1px solid #AAAAAA;
          padding: 3px 0px;
        }
        table.blueTable tbody td {
          font-size: 18px;
        }
        table.blueTable tr:nth-child(even) {
          background: #D0E4F5;
        }
        table.blueTable thead {
          background: #1C6EA4;
          background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
          background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
          background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
          border-bottom: 2px solid #444444;
        }
        table.blueTable thead th {
          font-size: 15px;
          font-weight: bold;
          color: #FFFFFF;
          border-left: 2px solid #D0E4F5;
        }
        table.blueTable thead th:first-child {
          border-left: none;
        }
        td i:hover{
            cursor: pointer;
            color: red;
        }
    </style>
</head>
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
            <h1>Dodaj / usuń magazyniera:</h1>
            <input type="text" id="name" name="name" placeholder="Imię">
            <button class="btn" id="add">Dodaj</button>
            <table class="blueTable">
                <thead>
                    <tr>
                        <th>LP</th>
                        <th>Imię</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-list">
                </tbody>
            </table>
        </div>
    </div>
</body>
<script src="js/menu.js"></script>
<script src="js/magazynierzy.js"></script>
<script>
		$("#add-mag").parent().addClass("menu-active");
		$("#add-mag").addClass("active-color");
</script>
</html>