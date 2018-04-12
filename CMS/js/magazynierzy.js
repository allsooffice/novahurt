$(document).ready(function(){
   /*Wyświetlanie listy magazynierów po załadowaniu strony*/
    showList();
});

/*Dodawanie magazynierów*/
$('#add').click(function(){
    var name = $('#name').val();
    if(name.length > 0){
        $.post( "php/dodaj_usun_magazyniera.php", { name: name }, function(){
            $('#name').val('');
            showList();
        });
    }
});
/*Funkcja wyświetlająca liste magazynierów*/
function showList()
{
    $(".table-list").load("php/dodaj_usun_magazyniera.php?show_list=true", function(){
        deleteIt();
    });
}
/*Usuwanie magazynierów*/
function deleteIt()
{
    $('.icon-trash').click(function(){
        var id = $(this).attr('name');
        $.post( "php/dodaj_usun_magazyniera.php", { delete: id }, function(){
        showList();
        });
    }); 
}