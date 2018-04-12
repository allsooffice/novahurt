    $(document).ready(function() {
    //Menu otwieranie zamykanie
    $("#menu-list li").on("click" ,function(){
    $(this).next().slideToggle("slow");
    var klasa = $("i", this).attr("class");
    if(klasa == 'icon-minus')
        {
            $("i", this).removeClass();
            $("i", this).addClass("icon-plus");  
        }
    else
        {
            $("i", this).removeClass();
            $("i", this).addClass("icon-minus");
        }
    });
    // koniec menu
    // Nawigacja
    $(".links").click(function(){
    var id = $(this).attr("id");
    $(".links").removeClass("active");
    $(this).addClass("active");
     
    });
    // wyswietlanie dodanych obrazow w sesji
    $(".image-place").load("php/img_display.php", function(){
                $(".loading").hide();
                sort();
    	});
//zamykanie popupa
         $("#close").on("click" ,function(){
             $(".box").fadeOut();
  });   
    });  
