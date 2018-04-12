//-------------FUNKCJE-------------------
//wyswietlanie komunikatu o bledzie
function showError ()
{
    $(".info-box-error").fadeIn();
    setTimeout(function(){
    $(".info-box-error").fadeOut();    
    }, 2500);
}
//komunikat o pomyslnosci
function confirmInfo()
{
    $(".info-box").fadeIn();
    setTimeout(function(){
    $(".info-box").fadeOut();    
    }, 2500);
}
//funkcja wyświetlania produktów w obecnym zamówieniu
function displayAddedProduct()
{
$(".order-listing").html('<img src="gif/loading.gif" width="90px"/>');
var order = $("#order-id").val();
$(".added-products").load("php/adding_product_display.php?id="+order);
}
//funkcja wyświetlająca dodane zamówienia
function displayAllOrders()
{
$(".order-listing").load("php/adding_order_display.php", function()
{
$(".edit-button").on("click" ,function()
{
var rowId = $(this).attr("id");
deleteOrder(rowId);
});
});
}
//funkcja sumowania ceny zamówienia
function calculateOrderCosts()
{
var hidden = parseInt($("#calculate").val());
var oneProductPrice = parseInt($("#all-price").val());
if($("#all-price").val().length < 1)
{
    oneProductPrice = 0;
}
var sum = hidden + oneProductPrice;
$("#total-price").text(sum);
$("#absolute-total").val(sum);
}
//Funkcja dodawania produktu
function addProduct()
{
//numer ID zamówienia
var order = $("#order-id").val();
//Nazwa Produktu
var product = $("#product_name").val();
//ilość produktu
var quantity = $("#product_quantity").val();
//cena produktu
var cena = $("#all-price").val();
var url = "php/adding_product.php?order_id=" + order + "&product="+ product + "&quantity=" + quantity + "&price=" + cena;
$.get(url, function() {
$(".added-products").load("php/adding_product_display.php?id="+order);    
});
var hidden = parseInt($("#calculate").val());
var oneProductPrice = parseInt($("#all-price").val());
var total = oneProductPrice+hidden;
$("#calculate").val(total);

}
//----------Funkcja Czyszczenia Inputów produktu------------------
function clearProductInputs()
{
$("#product_name").val('');
$("#product_quantity").val('');
$("#all-price").val('');    
}
//----------Funkcja Czyszczenia Wszystkich inputów------------------
function clearOrderInputs()
{
$("#product_name").val('');
$("#product_quantity").val('');
$("#odbiorca").val('');
$("#all-price").val('');
$("#miejscowosc").val('');
$(".select-input").val('select');
$("#shop").val('select');
$("#total-price").text('0');    
}
//--------Funkcja dodawania zamówienia ------------------------
function addOrder()
{
$(".order-listing").html('<img src="gif/loading.gif" width="90px"/>');
var order = $("#order-id").val();
var customer = $("#odbiorca").val();
var platnosc = $(".select-input").val();
var city = $("#miejscowosc").val();
var shop = $("#shop").val();
var absoluteTotal = $("#absolute-total").val();
//Nazwa Produktu
var product = $("#product_name").val();
//ilość produktu
var quantity = $("#product_quantity").val();
//cena produktu
var cena = $("#all-price").val();
var url = "php/adding_product.php?order_id=" + order + "&product="+ product + "&quantity=" + quantity + "&price=" + cena;
$.get(url);
var url = "php/adding_order.php?order_id=" + order + "&customer="+ customer + "&platnosc=" + platnosc + "&total=" + absoluteTotal + "&city=" + city + "&shop=" + shop;
$.get(url, function(){
$("#order-id").val(++order);
displayAllOrders();
++order;
confirmInfo();
$(".added-products").load("php/adding_product_display.php?id="+order);
});
}
function deleteOrder(rowId)
{
    $("#row-id-"+rowId).toggle("fast");
    $(".dont-delete").on("click" ,function(){
        var window = $(this).attr("name");
        $("#row-id-"+window).fadeOut("fast");
    });
    $(".delete-order").on("click" ,function(){
        var order = $(this).attr("name");
        var url = "php/delete_order.php?order_id=" + order;
        $.get(url);
        $("#o-row-"+order).fadeOut();
        $("#row-id-"+window).fadeOut("fast");
    });
}
    
    

        //filtrowanie listy odbiorców
        $("#odbiorca").on("keyup" ,function(){
            $(".order-listing").html('<img width="90px" src="gif/loading.gif"/>');
            var odbiorca = $("#odbiorca").val();
            $(".info-box-error").fadeOut();
            $(".order-listing").load("php/adding_order_display.php?customer="+odbiorca.replace(" ", "_"));
            
        });
    
        //autouzupelnienie
        $("#product_name").on("keyup" ,function(){
        $(".info-box-error").fadeOut();
        var productName = $("#product_name").val();
        if(productName.length > 2)
        {
        $(".info-box-error").fadeOut();
        $(".autocomplete").show();    
        $(".autocomplete").load("php/product_autocomplete.php?help="+productName.replace(" ", "_"), function()
            {
                $(".autocomplete > ul > li").click(function(){
                var clickedProductName = $(this).attr("name");
                $("#product_name").val(clickedProductName);
                $(".autocomplete").hide();
            })
            
        });
        
        }
        else
        {
            $(".autocomplete").hide();
        }
            
            
                    
        });

//usuwanie produktu
function trash(numer)  {
        var url = "php/delete_adding_products.php?id=" + numer;
        $.get(url);
        $("#list"+numer).fadeOut(400);
        var order = $("#order-id").val();
        $(".added-products").load("php/adding_product_display.php?id="+order)
    }
//-------------WYWOŁANIE FUNKCJI---------------------------
    
//PRZY ZAŁADOWANIU STRONY
displayAllOrders();
displayAddedProduct();
//Puszczenie inputa z ceną produktu
$("#all-price").on("keyup" ,function()
{
calculateOrderCosts();
});
//Kliknięcie przycisku dodającego kolejny produkt
$("#next-product").click(function(){
//Nazwa Produktu
var product = $("#product_name").val();
//ilość produktu
var quantity = $("#product_quantity").val();
//cena produktu
var cena = $("#all-price").val();
if(product.length < 3 || quantity.length < 1 || cena.length < 1)
{
showError();
}
else
{
addProduct();
clearProductInputs();    
}
})
//Kliknięcie przycisku dodaj zamówienie
$("#add-order").click(function(){
var customer = $("#odbiorca").val();
var platnosc = $(".select-input").val();
var city = $("#miejscowosc").val();
var shop = $("#shop").val();
//Nazwa Produktu
var product = $("#product_name").val();
//ilość produktu
var quantity = $("#product_quantity").val();
//cena produktu
var cena = $("#all-price").val();
if(customer.length < 3 || platnosc == 'select' || city.length < 3 || shop == 'select' || product.length < 3 || quantity.length < 1 || cena.length < 1)
{
   showError();
}
   else
   {
   addOrder();
clearOrderInputs();
   }

});
