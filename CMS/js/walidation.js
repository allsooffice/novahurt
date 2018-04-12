    $(document).ready(function() {
    //sprawdzanie inputow
    $(".text-input, .text-input-short, textarea").on("blur" ,function(){
        
        if($(this).val().length < 1)
            {
                var elId = $(this).attr('id');
                if(elId != 'important' && elId != 'next')
                {
                $(this).removeClass("input-ok");
                $(this).addClass("input-error");
                $(".error-place").fadeIn();
                }
            }
        else
            {
                $(this).removeClass("input-error");
                $(this).addClass("input-ok");
                $(".error-place").fadeOut();
            }
    });
//ustawianie ceny kolejnej sztuki
 $("#max").on("change keyup" ,function(){
if($(this).val() > 1)
    {
        $(".next-item").fadeIn();
    }
     else
    {
        $(".next-item").fadeOut();
        $("#next").val("");
    }
    });   
    }); 

$(".btn").on("click" ,function(){
        var id = $("#art_id").val();
        var nazwa = $("#product").val();
        var detal = $("#detal").val();
        var hurt = $("#hurt").val();
        var przelew = $("#przelew").val();
        var pobranie = $("#pobranie").val();
        var ubezpieczenie = $("#ubezpieczenie").val();
        var max = $("#max").val();
        var karton = $("#karton").val();
        var waga = $("#waga").val();
        var kolor = $("#kolor").val();
        var material = $("#material").val();
        var dzial = $("#dzial:checked").val();
        var producent = $("#producent:checked").val();
        var short1 = $("#short1").val();
        var short2 = $("#short2").val();
        var short3 = $("#short3").val();
        var t1 = $("#t1").val();
        var t2 = $("#t2").val();
        var t3 = $("#t3").val();
        var t4 = $("#t4").val();
        var t5 = $("#t5").val();
        var t6 = $("#t6").val();
        var t7 = $("#t7").val();
        var t8 = $("#t8").val();
        var t9 = $("#t9").val();
        var t10 = $("#t10").val();
        var t11 = $("#t11").val();
        var wiev = $("#wiev:checked").val();
        var next = $("#next").val();
        var important = $("#important").val();
        var cena_zakupu = $("#cena_zakupu").val();
        var crossed_price = $("#crossed").val();
        var last_name = $("#last_name").val();
        if(nazwa.length < 1 || detal.length < 1 || hurt.length < 1 || przelew.length < 1 || pobranie.length < 1 || ubezpieczenie.length < 1 || max.length < 1 || karton.length < 1 || waga.length < 1 || kolor.length < 1 || material.length < 1 || dzial.length < 1 || producent < 1 || short1.length < 1 || short2.length < 1 || short3.length < 1 || t1.length < 1 || t2.length < 1 || t3.length < 1 || t4.length < 1 || t5.length < 1 || t6.length < 1 || t7.length < 1 || t8.length < 1 || t9.length < 1 || t10.length < 1 || t11.length < 1 || wiev.length < 1 )
        {
			  $(".error-place").fadeIn();
        }
    
        else
        {
            var url = "php/add_adv.php?id=" + id + "&nazwa=" + nazwa + "&detal=" + detal + "&hurt=" + hurt + "&przelew=" + przelew + "&pobranie=" + pobranie + "&ubezpieczenie=" + ubezpieczenie + "&max=" + max + "&karton=" + karton + "&waga=" + waga + "&kolor=" + kolor + "&material=" + material + "&dzial=" + dzial + "&producent=" + producent + "&short1=" + short1 + "&short2=" + short2 + "&short3=" + short3 + "&t1=" + t1 + "&t2=" + t2 + "&t3=" + t3 + "&t4=" + t4 + "&t5=" + t5 + "&t6=" + t6 + "&t7=" + t7 + "&t8=" + t8 + "&t9=" + t9 + "&t10=" + t10 + "&t11=" + t11 + "&wyswietlac=" + wiev + "&next=" + next + "&important=" + important + "&cena_zakupu=" + cena_zakupu + "&crossed_price=" + crossed_price + "&last_name=" + last_name;
            $.get(url, function(){
					//ulozenie kolejnosci zdjec
					$.ajax({
					url: 'php/replace_img.php',
					data: $("form").serialize(),
					type: 'POST',
					success: function() 
					{
						$(".box").fadeIn();
					}
				});
            
    }); 
        }
    });
//Okno Potwierdzenie usunięcia
$(".span-delete-item a").click(function(){
	$(".delete-confirm").fadeIn();
});
//Anulowanie usuwania
$("#delete-false").click(function(){
	$(".delete-confirm").fadeOut();
});
//Potwierdzenie usuwania
$("#delete-true").click(function(){
	var id = $("#delete-true").attr("product");
	var url = "php/delete_product.php?id=" + id;
	$.get(url, function(){
		window.history.back();
	});
});