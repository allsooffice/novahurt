//-------------FUNKCJE-------------------

//-----Po załadowaniu strony
$(document).ready(function(){
    //wyświetlanie pełnej listy z ostatniego miesiąca
    var mounth = $(".selected-mounth").val();
    var shop = $(".selected-shop").val();
    var order = $(".selected-order").val();
    $(".display-list").load("php/raport_table.php?mounth="+mounth+"&shop="+shop+"&order="+order);
});

$("select").change(function(){
    $(".display-list").html('<img src="gif/loading.gif"/>');
    var mounth = $(".selected-mounth").val();
    var shop = $(".selected-shop").val();
    var order = $(".selected-order").val();
    $("#mounth-name").text(mounth);
    $(".display-list").load("php/raport_table.php?mounth="+mounth+"&shop="+shop+"&order="+order);
});
