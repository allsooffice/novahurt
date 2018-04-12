//-------------FUNKCJE-------------------

//-----Po załadowaniu strony
$(document).ready(function(){

    $(".display-list").load("php/finished_table.php", CheckCheckbox);
});
$(".selected-payment").change(function(){
    $(".display-list").html('<img src="gif/loading.gif"/>');
    var payment = $(".selected-payment").val();
    $(".display-list").load("php/finished_table.php?payment="+payment, CheckCheckbox);
	$('.menu-option').fadeOut();
	$("#select-all").text("Zaznacz wszystkie");
});


$("#select-all").click(function(){
		if($(this).text() == 'Odznacz wszystkie')
			{
				$('.check-order').prop('checked', false);
				$(this).text("Zaznacz wszystkie");
				$('.menu-option').fadeOut();
			}
	else{
    	$('.check-order').prop('checked', true);
		$(this).text("Odznacz wszystkie");
	}
});

function CheckCheckbox()
{
	$('.check-order').click(function(){
	if($('.check-order').is(':checked'))
		{
		$('.menu-option').fadeIn();
		}
	else
		{
		$('.menu-option').fadeOut();	
		}

});
}
//pobranie id zaznaczonych zamowien po kliknieciu export
	$('#export').click(function(){
	$('.box').fadeIn();
	$('.popup').fadeIn();
	$('#confirm').click(function(){
	var i = 0;
	var l = 0;
	var quantityCheckbox = $('.check-order').length;
	var link = '';
	while (i < quantityCheckbox) {
		var box = $('.check-order')[i];
		if(box.checked == true)
			{
				if(i == 0)
					{
						link += 'id['+l+']=' + box.name;
						l++;
					}
				else
					{	
						link += '&id['+l+']=' + box.name;
						l++;
					}
			}
    i++;
    
}
if($('.export-transfer-checkbox').is(':checked'))
		{
		var moveTo = $('#export-moveTo').val();
		link += '&move=' + moveTo;
		}
	
if($('.export-message-checkbox').is(':checked'))
		{
		var message = $('#export-choosen-message').val();
		link += '&message=' + message;
		}      
	$(".selected-items").load("php/xml_creator.php?"+link);
	$(".selected-items").load("php/sell_transfer.php?"+link);
	$('.download').fadeIn();
	$('.popup').fadeOut();
	$('#close-download').click(function(){
	$('.box').fadeOut();
	$('.download').fadeOut();
   $(".display-list").load("php/order_table.php", CheckCheckbox);
});
	});
});

$('#transfer').click(function(){
	$('.popup').fadeOut();
	$('.box').fadeIn();
	$('.transfer').fadeIn();
	$('.transfer h3').text('Czy na pewno przenieść zaznaczone zamówienia?');
	$('.transfer-checkbox').prop('checked', true);
	$('.message-checkbox').prop('checked', true);
	$('#close-transfer').click(function(){
		$('.box').fadeOut();
		$('.transfer').fadeOut();
	});
});

$('#send-message').click(function(){
   $('.message-checkbox').prop('checked', true);
	$('.popup').fadeOut();
	$('.box').fadeIn();
	$('.transfer').fadeIn();
	$('.transfer h3').text('Wyślij wiadomość');
	$('.transfer-checkbox').prop('checked', false);
	$('#close-transfer').click(function(){
		$('.box').fadeOut();
		$('.transfer').fadeOut();
	});
});

//wyslanie id zamowien do maila lub zmiany kategorii

$('#confirm-transfer').click(function(){
var i = 0;
var l = 0;
var quantityCheckbox = $('.check-order').length;
var link = '';
while (i < quantityCheckbox) {
	var box = $('.check-order')[i];
	if(box.checked == true)
		{
			if(i == 0)
				{
					link += 'id['+l+']=' + box.name;
					l++;
				}
			else
				{	
					link += '&id['+l+']=' + box.name;
					l++;
				}
		}
 i++;
}
if($('.transfer-checkbox').is(':checked'))
		{
		var moveTo = $('#moveTo').val();
		link += '&move=' + moveTo;
		}
	
if($('.message-checkbox').is(':checked'))
		{
		var message = $('#choosen-message').val();
		link += '&message=' + message;
		}
$(".selected-items").load("php/sell_transfer.php?"+link);
$('.transfered').fadeIn();
$('.transfer').fadeOut();
	$('#exit-transfer').click(function(){
		$(".display-list").load("php/order_table.php", CheckCheckbox);
		$('.box').fadeOut();
		$('.menu-option').fadeOut();
		$('.transfered').fadeOut();
	})
});

//wyłączenie popupa
$('#close-box').click(function(){
	$('.box').fadeOut();
});
