//filtrowanie listy
$(function(){
   $(".order-listing").load("php/magazyn_display.php?customer=");
})
$("#odbiorca").on("keyup" ,function(){
   $(".order-listing").html('<img width="90px" src="gif/loading.gif"/>');
   var odbiorca = $("#odbiorca").val();
   $(".info-box-error").fadeOut();
   $("#id_zam").val('');
   $(".order-listing").load("php/magazyn_display.php?customer="+odbiorca.replace(" ", "_"));
});

$("#id_zam").on("keyup" ,function(){
   $(".order-listing").html('<img width="90px" src="gif/loading.gif"/>');
   var order = $("#id_zam").val();
   $(".info-box-error").fadeOut();
   $("#odbiorca").val('');
   if(order.length < 4)
      {
         $(".order-listing").load("php/magazyn_display.php?customer=");
      }
   else
      {
         $(".order-listing").load("php/magazyn_display.php?order_id="+order);
      }
});
