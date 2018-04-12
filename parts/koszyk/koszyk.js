$(document).ready(function(){
    //var quantity = $("#card_quantity").val();
    //var piece = $("#piece_price_3").val();
    //sumProduct(quantity, piece);
    var inCard = $("#products_in_card").val();
    var sum = 0;
    var kwota = 0;
    for (var x=1; x <= inCard; x++)
    {
        var product = $("#product_sum_"+x).val();
        var kwota = parseInt(kwota) + parseInt(product);
    }
    $("#sum").text(kwota);
});

$(".product_quantity").on("change keyup" ,function(){
    var wartosc = $(this).val();
    var number = $(this).attr('name');
    var cardProductId = $(this).attr('id');
    var piece = $("#piece_price_"+number).val();
    if(wartosc < 1)
        {
          $(this).val('1');
          var wartosc = $(this).val();
          sumProduct(wartosc, piece, number);
        }
    else
        {
          $("#kup_przycisk").attr('type', 'submit');
          sumProduct(wartosc, piece, number);
          var url = "parts/koszyk/update.php?id=" + cardProductId + "&quantity="+ wartosc;
          $.get(url);
        }
});

function sumProduct(quantity, piece, number)
{
    var quantity = quantity;
    var number = number;
    var piece = piece;
    var orderSum = quantity * piece;
    $("#product_sum_"+number).val(orderSum);
    sumOrder()
}

function sumOrder()
{
    var inCard = $("#products_in_card").val();
    var sum = 0;
    var kwota = 0;
    for (var x=1; x <= inCard; x++)
    {
        var product = $("#product_sum_"+x).val();
        var kwota = parseInt(kwota) + parseInt(product);
    }
    $("#sum").text(kwota);
}