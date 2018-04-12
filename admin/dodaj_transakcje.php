<!DOCTYPE HTML>

<?php
session_start();

if (!isset($_SESSION['zalogowany']))
{
  header('Location: index.php#start');  
}
?>

<html lang="pl">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>dodaj transakcję - NOVA HURT</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href='https://fonts.googleapis.com/css?family=Kanit:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> <!-- Czcionka -->
      <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</head>
    
<script>

    function listen()
    {
        var ciag = $("#model").val();
        if(ciag.length > 2)
            {
            $(".zam-podpowiedz").load("edit/autocomplete.php?fraza="+ciag);
            $(".zam-podpowiedz").fadeIn(600);
            }
        if(ciag.length < 3)
            {
             $(".zam-podpowiedz").fadeOut(600);
            }
    }
    
    function mode(wartosc)
    {
        $(".zam-podpowiedz").fadeOut(600);
        document.getElementById("sztuk").value="1";
        $("#przedmiot").load("edit/autocomplete.php?id="+wartosc);
        $("#przedmiot-cena").load("edit/autocomplete.php?id_cena="+wartosc);
        $(".invisible-przelew").load("edit/autocomplete.php?przelew="+wartosc);
        $(".invisible-pobranie").load("edit/autocomplete.php?pobranie="+wartosc);
        $(".invisible-max").load("edit/autocomplete.php?max="+wartosc);
        $(".invisible-kolejna").load("edit/autocomplete.php?kolejna="+wartosc);
        liczCene();
    }
    
    function przesylkaWybor()
    {
     var wybrana = document.getElementById("przesylka").value;
     var sztuk = document.getElementById("sztuk").value;
     var maxPaczka = new Number(document.getElementById("max-baza").value)
     var kolejna = new Number(document.getElementById("kolejna-baza").value)
     var cenaUbezpieczenia = 6;
     if(wybrana == 'przelew')
         {
             var pierwsza = new Number(document.getElementById("przelew-baza").value);
             var koszt = pierwsza;
             for(var i=1; i<sztuk; i++)
                 {
                     if(i % maxPaczka == 0)
                         {
                             koszt = koszt+pierwsza;
                             koszt = koszt-kolejna;
                             cenaUbezpieczenia = cenaUbezpieczenia + 6;
                         }
                    
                     koszt = koszt+kolejna;
                         
                 }
   
         }
     if(wybrana == 'pobranie')
         {
            var pierwsza = new Number(document.getElementById("pobranie-baza").value);
             var koszt = pierwsza;
             for(var i=1; i<sztuk; i++)
                 {
                     if(i % maxPaczka == 0)
                         {
                             koszt = koszt+pierwsza;
                             koszt = koszt-kolejna;
                             cenaUbezpieczenia = cenaUbezpieczenia + 6;
                         }
                    
                     koszt = koszt+kolejna; 
                 }
            
         }
        document.getElementById("przesylka_cena").value=koszt;
            document.getElementById("wartosc_ub").value = cenaUbezpieczenia;
            if (document.getElementById("ubezpieczenie").checked==true)
                {
                  document.getElementById("ub").innerHTML='<input onclick="liczCene()" id="ubezpieczenie" type="checkbox" checked>Ubezpieczenie '+cenaUbezpieczenia+' zł';  
                }
            else
            {
                document.getElementById("ub").innerHTML='<input onclick="liczCene()" id="ubezpieczenie" type="checkbox">Ubezpieczenie '+cenaUbezpieczenia+' zł';
            }
             
             liczCene();
        
    }
    
    function pusty()
    {
        document.getElementById("sztuk").value="";
        document.getElementById("model").value="";
        document.getElementById("cena").value="";
        document.getElementById("suma").value="";
        document.getElementById("przesylka_cena").value="";
    }
    
        function SumaZamowienia()
    {
      var produkty = new Number(document.getElementById("cena").value);
      var przesylka = new Number(document.getElementById("przesylka_cena").value);
      var ubezpieczenie = new Number(document.getElementById("wartosc_ub").value);
      var cena = produkty + przesylka;
      if (document.getElementById("ubezpieczenie").checked==true)
          {
              cena = cena + ubezpieczenie;
          }
      document.getElementById("suma").value=cena;
   
    }
    
    function liczCene()
    {
      var sztuk = document.getElementById("sztuk").value;
      var cena = document.getElementById("cena_sztuka").value;
      var cena = sztuk * cena;
      document.getElementById("cena").value=cena;
      SumaZamowienia();
      przesylkaWybor();
    }
    
    function NextItem()
    {
        //dodanie inputa z nazwą produktu
        var lista = document.getElementById("sell-list");
        var model = document.getElementById("model").value;
        var sztuk = document.getElementById("sztuk").value;
        var przesylka = document.getElementById("przesylka").value;
        var przesylka_cena = document.getElementById("przesylka_cena").value;
        var cena = new Number(document.getElementById("cena").value);
        var ubezpieczenie = 'ubezpieczenie: nie';
        if (document.getElementById("ubezpieczenie").checked==true)
            {
                var ub = new Number(document.getElementById("wartosc_ub").value)
               ubezpieczenie = 'ubezpieczenie: '+ub;
            }
        var tekst = document.createTextNode(model+" x "+sztuk+" za "+cena+" przesyłka: "+przesylka+" za "+przesylka_cena+" "+ubezpieczenie);
        var Ol = document.createElement("OL");
        var Li = document.createElement("LI");
        lista.appendChild(Ol);
        Ol.appendChild(Li);
        Li.appendChild(tekst);
        
        
            var ostateczna = new Number(document.getElementById("suma_total").value);
            var cenaProdukt = new Number(document.getElementById("suma").value);
            document.getElementById("suma_total").value=cenaProdukt+ostateczna;
        pusty();
    }
    function Przelicz()
    {
        if(document.getElementById("suma").value != "")
            {
        var lista = document.getElementById("sell-list");
        var model = document.getElementById("model").value;
        var sztuk = document.getElementById("sztuk").value;
        var przesylka = document.getElementById("przesylka").value;
        var przesylka_cena = document.getElementById("przesylka_cena").value;
        var cena = new Number(document.getElementById("cena").value);
        var ubezpieczenie = 'ubezpieczenie: nie';
        if (document.getElementById("ubezpieczenie").checked==true)
            {
                var ub = new Number(document.getElementById("wartosc_ub").value)
               ubezpieczenie = 'ubezpieczenie: '+ub;
            }
        var tekst = document.createTextNode(model+" x "+sztuk+" za "+cena+" przesyłka: "+przesylka+" za "+przesylka_cena+" "+ubezpieczenie);
        var Ol = document.createElement("OL");
        var Li = document.createElement("LI");
        lista.appendChild(Ol);
        Ol.appendChild(Li);
        Li.appendChild(tekst);
            }
      $("#przedmiot").fadeOut(600);  
      $("#przedmiot-sztuk").fadeOut(600);  
      $("#przedmiot-cena").fadeOut(600);  
      $("#przedmiot-dostawa").fadeOut(600);  
      $("#przedmiot-suma").fadeOut(600);  
      $("#przesylka").fadeOut(600);  
      $(".zam_button").fadeOut(600);  
      var ostateczna = new Number(document.getElementById("suma_total").value);
      var cenaProdukt = new Number(document.getElementById("suma").value);
      document.getElementById("suma_total").value=cenaProdukt+ostateczna;  
    }

    
    
    </script>

<body>
    <?php
    include('head.php');
    ?>
    <h1>Dodaj zamówienie</h1>
    <div class="add_left">
        <div id="przedmiot">
        <input type="text" onkeyup="listen()" id="model" placeholder="Model" class="zam_input" autocomplete="off" style="width: 280px;" value=""/>
        </div>
        <div class="zam-podpowiedz"></div>
        <div id="przedmiot-sztuk">
        <input onkeyup="liczCene()" onchange="liczCene()" type="number" id="sztuk" placeholder="Szt" class="zam_input" autocomplete="off" style="width: 50px;"/> szt
        </div>
        <div id="przedmiot-cena">
            <input type="text" id="cena" placeholder="Cena za produkty" class="zam_input" autocomplete="off" value="" style="width: 185px;"/> zł
        </div>
        <div style="clear: both;"></div>
        <select onchange="przesylkaWybor()" id="przesylka" class="zam_select">
          <option value="none">Przesyłka</option>
          <option value="przelew">Przelew</option>
          <option value="pobranie">Pobranie</option>
        </select>
        <div id="przedmiot-dostawa">
        Dostawa <input type="text" id="przesylka_cena" placeholder="Cena za przesyłkę" class="zam_input" autocomplete="off" style="width: 200px;"/> zł<br>
        <label id="ub"><input onclick="liczCene()" id="ubezpieczenie" type="checkbox">Ubezpieczenie 6 zł</label>
        <input type="hidden" id="wartosc_ub" value=""/><br>
        </div>
        <div id="przedmiot-suma">
        Suma:
        <input type="text" id="suma" placeholder="Suma zamówienia" class="zam_input" autocomplete="off" style="width: 120px;"/> zł
        </div>
        <div onclick="NextItem()" class="zam_button">Kolejny produkt</div>
        <div id="sell-list"></div>
        <div onclick="Przelicz()" class="zam_button">Zatwierdź</div>
        Całość zamówienia
        <input type="text" id="suma_total" style="width: 120px;" class="zam_input" value="0"/> zł
        
    </div>
    <div class="add_right">
    
        <input type="text" id="imie" placeholder="Imie" class="zam_input" autocomplete="off"/><br>
        <input type="text" id="nazwisko" placeholder="nazwisko" class="zam_input" autocomplete="off"/><br>
        <input type="text" id="pocztowy" placeholder="Kod pocztowy" class="zam_input" autocomplete="off" style="width: 90px;"/>
        <input type="text" id="miejscowosc" placeholder="Miejscowosc" class="zam_input" autocomplete="off" style="width: 200px;"/><br>
        <input type="text" id="ulica" placeholder="Ulica" class="zam_input" autocomplete="off" /><br>
        <input type="text" id="nr_budynku" placeholder="Nr budynku" class="zam_input" autocomplete="off" style="width: 140px;"/> / 
        <input style="width: 140px;" type="text" id="nr_lokalu" placeholder="Nr lokalu" class="zam_input" autocomplete="off"/><br>
        <input type="text" id="telefon" placeholder="Telefon" class="zam_input" autocomplete="off" /><br>
        <input type="text" id="email" placeholder="email" class="zam_input" autocomplete="off" /><br>
        <select name="dokument" class="zam_select">
          <option value="paragon">Paragon</option>
          <option value="faktura">Faktura</option>
        </select>
    
    </div>
    <div style="clear: both;"></div>
    <div class="invisible-przelew"></div>
    <div class="invisible-pobranie"></div>
    <div class="invisible-max"></div>
    <div class="invisible-kolejna"></div>
    <div class="invisible-ubezpieczenie"></div>
    
            
       
        
        
        
        
        
        <div id="stopka">novahurt.pl 2014 &copy; Wszelkie prawa zastrzeżone.</div>
    </div> 
   
    
    
    


</body>
</html>