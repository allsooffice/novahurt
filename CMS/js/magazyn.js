$('#order-number').blur(function(){
   var orderNumber = $('#order-number').val();
   if(orderNumber.length < 3)
      {
         $(this).css('border', '1px solid red');
      }
   else{
      $(".order-errors").load("php/checking_orders.php?order="+orderNumber);
      $(this).css('border', '');
      $('.insert-error').text('');
   }
   $(".order-complete").text('');
});

$('.icon-minus').click(function(){
   var pack = $('#pack').val();
   if(pack > 1)
      {
         var update = --pack;
         $('#pack').val(update);
      }
});

$('.icon-plus').click(function(){
   var pack = $('#pack').val();
   if(pack == '')
      {
         pack = 0;
      }
   var update = ++pack;
   $('#pack').val(update);
});

$('#add-order').click(function(){
   var orderNumber = $('#order-number').val();
   var pack = $('#pack').val();
   var magazynier = $('#magazynier').val();
   var validation = true;
   if(orderNumber.length < 3)
   {
      validation = false;
      var error = 'Sprwdź numer zamówienia.';
   }
   if(pack < 1)
   {
      validation = false;
      var error = 'Sprwdź liczbę paczek.';
   }
   if(magazynier == 'select')
   {
      validation = false;
      var error = 'Zaznacz kto pakuje paczkę.';
   }
   
   if(validation == true)
   {
      $(".order-complete").load("php/packing_information.php?order="+orderNumber+"&pack="+pack+"&magazynier="+magazynier);
      $('#order-number').val('');
      $('#pack').val('');
      $('#magazynier').val('select');
   }
   else
   {
      $('.insert-error').text(error);
   }
});
