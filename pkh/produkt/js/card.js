$("#quantity").on("change keyup" ,function(){
    var wartosc = $(this).val();
    if(wartosc < 1)
        {
          $("#quantity").css("border", "1px solid red");
          $(".quantity-error").fadeIn();
          $("#kup_przycisk").attr('type', 'button');
        }
    else
        {
          $("#quantity").css("border", "1px solid #5f5f5f");
          $(".quantity-error").fadeOut();
          $("#kup_przycisk").attr('type', 'submit');
        }
    });